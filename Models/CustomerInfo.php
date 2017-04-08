<?php
namespace Models;

class CustomerInfo extends \Illuminate\Database\Eloquent\Model
{
    
    protected $table = 'customerinfo';
    
    public function customer()
    {
        return $this->hasOne('\Models\Customer', 'id', 'customer_id');
    }
    
}