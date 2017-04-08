<?php
namespace Models;

class CustomerCart extends \Illuminate\Database\Eloquent\Model
{
    
    protected $table = 'customercarts';
    protected $fillable = ['customer_id', 'product_id', 'quantity'];
    public $timestamps = false;
    
    public function customer()
    {
        return $this->hasOne('\Models\Customer', 'id', 'customer_id');
    }
    
    public function product()
    {
        return $this->hasOne('\Models\Product', 'id', 'product_id');
    }
    
}