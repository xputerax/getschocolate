<?php
namespace Controllers;

class Api extends Controller
{
    
    protected $input;
    protected $output;
    
    public function __construct($f3, $param)
    {

        parent::__construct($f3, $param);
        
        if(\Helpers\Check::is_admin() || \Helpers\Check::is_visitor()){
            $this->output['success'] = false;
            $this->output['message'] = 'You need to log in as customer first';
            
            $this->afterRoute();
        }
        
        unset($param[0]);
        $this->input = $param;
        $this->input['customer_id'] = $_SESSION['customer_id'];
        
    }
    
    public function afterRoute()
    {
        //var_dump($this->input, $this->output);
        die(json_encode($this->output));
    }
    
    public function test()
    {
        
    }
    
    public function addToCart()
    {
        
        $this->base->get('db')->transaction(function(){

            // update bilangan stock utk product
            $product = \Models\Product::find($this->input['prod_id']);
            
            // check bil. stock cukup or tak
            if($product->stock == '0' || $this->input['quantity'] > $product->stock){
                
                $this->output['success'] = false;
                $this->output['message'] = 'Please enter a correct quantity';               
                return;
            }
            
            $product->stock = ($product->stock - $this->input['quantity']);
            $product->save();

            $cart = new \Models\CustomerCart;
            
            $cartItem = $cart->where('customer_id', $this->input['customer_id'])->where('product_id', $this->input['prod_id']);
            $cartItemExists = ($cartItem->count() > 0);
            
            // item & cust dah wujud, takyah create row baru
            // update quantity yg lama ke
            if($cartItemExists){
                
                $cartItemRes = $cartItem->get()[0];
                $oldQuantity = $cartItemRes->quantity;
                $addQuantity = $this->input['quantity'];
                $newQuantity = ($oldQuantity + $addQuantity);
                
                $cartItem->update(['quantity' => $newQuantity]);
                
            } else {
                
                $cart->customer_id = $this->input['customer_id'];;
                $cart->product_id = $this->input['prod_id'];
                $cart->quantity = $this->input['quantity'];
                $cart->save();

            }
                        
            $this->output['success'] = true;
            $this->output['message'] = 'Item added to cart';
            $this->output['data'] = $product->toArray();
            
        });
        
    }
    
}