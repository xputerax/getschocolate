<?php
namespace Controllers;

class AdminApi extends Controller
{
    
    protected $input;
    protected $output;
    
    public function __construct($f3, $param)
    {
        
        parent::__construct($f3, $param);
        
        if(\Helpers\Check::is_customer() || \Helpers\Check::is_visitor()){
            $this->output['success'] = false;
            $this->output['message'] = 'You need to log in as admin first';
            
            $this->afterRoute();
        }
        
        unset($param[0]);
        $this->input = $param;
        $this->input['admin_id'] = $_SESSION['admin_id'];
        
    }
    
    public function afterRoute()
    {
        die(json_encode($this->output));
    }
    
    public function renamecategory()
    {
        $category = \Models\Category::find($this->input['category_id']);
        
        if(!$category){
            
            $this->output = [
                'success' => false,
                'message' => 'invalid category id'
            ];
            
            return;
            
        }
        
        if(!empty($this->input['newname'])){
            
            $category->name = $this->input['newname'];
            $category->save();
            
            $this->output = [
                'success' => true,
                'message' => 'Category renamed successfully',
                'data' => $category->toArray()
            ];
            
        } else {
            
            $this->output = [
                'success' => false,
                'message' => 'category name cannot be empty'
            ];
            
        }

    }
    
    public function deletecategory()
    {
        
        $category = \Models\Category::find($this->input['category_id']);
        
        if($category){
            
            $category->delete();
            
            $this->output = [
                'success' => true,
                'message' => 'category deleted'
            ];
            
        } else {
            
            $this->output = [
                'success' => false,
                'message' => 'invalid category id'
            ];
            
        }
        
    }
    
    public function addcategory()
    {
        
        $category = new \Models\Category;
        $category->name = $this->input['category_name'];
        
        if($category->save()){
            
            $this->output = [
                'success' => true,
                'message' => 'category added',
                'data' => $category->toArray()
            ];
            
        } else {

            $this->output = [
                'success' => false,
                'message' => 'failed to add category'
            ];
            
        }
        
    }
    
    public function deleteproduct()
    {
        
        $product = \Models\Product::find($this->input['product_id']);
        
        if(!$product){
            
            $this->output = [
                'success' => false,
                'message' => 'invalid product id'
            ];
            
            return;
            
        }
        
        $this->base->get('db')->transaction(function ($db) use($product) {
            
            //$delcat = $productcategories->delete();
            $delprod = $product->delete();
            
            if($delprod){
                
                $this->output = [
                    'success' => true,
                    'message' => 'product deleted'
                ];
                
            } else {
                
                $this->output = [
                    'success' => false,
                    'message' => 'failed to delete product'
                ];
                
            }
            
        });
        
    }
    
    public function markinvoiceaspaid()
    {
        
        $invoice = \Models\Invoice::find($this->input['invoice_id']);
        
        if($invoice){
            
            $this->base->get('db')->transaction(function($db) use ($invoice){
                
                $invoice->paid = 'Y';
                $invoice->paid_date = $this->input['paid_date'];
                $invoice->save();
                
            });
            
            $this->output = [
                'success' => true,
                'message' => 'Invoice marked as paid'
            ];
            
        } else {
            
            $this->output = [
                'success' => false,
                'message' => 'Invalid invoice ID'
            ];
            
        }
        
    }
    
    public function approveorder()
    {
        
        $order = \Models\Order::find($this->input['order_id']);
        
        if($order){
            
            $this->base->get('db')->transaction(function($db) use($order){
                
                $order->approved = 'Y';
                $order->approval_date = \Carbon\Carbon::now();
                $order->save();
                
                $this->output = [
                    'success' => true,
                    'message' => 'Order Approved',
                    'data' => $order->toArray()
                ];
                
            });

        } else {
            
            $this->output = [
                'success' => false,
                'message' => 'Failed to approve order'
            ];
            
        }
        
    }
    
    public function unapproveorder()
    {
        
        $order = \Models\Order::find($this->input['order_id']);
        
        if($order){
            
            $this->base->get('db')->transaction(function($db) use($order){
                
                $order->approved = 'N';
                $order->approval_date = null;
                $order->save();
                
                $this->output = [
                    'success' => true,
                    'message' => 'Order unapproved'
                ];
                
            });
            
        } else {
            
            $this->output = [
                'success' => false,
                'message' => 'Failed to approve order'
            ];
            
        }

    }
    
    public function cancelorder()
    {
        
        $order = \Models\Order::find($this->input['order_id']);
        
        if($order){
            
            $this->base->get('db')->transaction(function($db) use($order){
                
                $invoice = \Models\Invoice::where('order_id', $order->id)->first();
                $invoiceitems = $invoice->items;
                
                foreach($invoiceitems as $item){
                    
                    /** readd stock **/
                    $product = \Models\Product::find($item->product->id);
                    $product->stock = ($product->stock + $item->quantity);
                    $product->save();
                    
                    /** delete invoice item **/
                    $item->delete();
                    
                }
                
                $invoice->delete();
                $order->delete();
                
            });
            
            $this->output = [
                'success' => true,
                'message' => 'Order cancelled'
            ];
            
        } else {
            
            $this->output = [
                'success' => false,
                'message' => 'Invalid order ID'
            ];
            
        }
        
    }
    
    public function suspendcustomer()
    {
        
        $customer = \Models\Customer::find($this->input['customer_id']);
        
        if($customer){
            
            $customer->active = 'N';
            $customer->save();
            
            $this->output = [
                'success' => true,
                'message' => 'Customer account suspended'
            ];
            
        } else {
            
            $this->output = [
                'success' => false,
                'message' => 'Invalid customer ID'
            ];
            
        }
        
    }
    
    public function unsuspendcustomer()
    {
        
        $customer = \Models\Customer::find($this->input['customer_id']);
        
        if($customer){
            
            $customer->active = 'Y';
            $customer->save();
            
            $this->output = [
                'success' => true,
                'message' => 'Customer account unsuspended'
            ];
            
        } else {
            
            $this->output = [
                'success' => false,
                'message' => 'Invalid customer ID'
            ];
            
        }

    }
    
    
}