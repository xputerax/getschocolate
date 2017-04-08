<?php
namespace Models;

class Customer extends \Illuminate\Database\Eloquent\Model
{
    
    public $timestamps = false;
    protected $fillable = ['email', 'password', 'fname', 'lname', 'line_1', 'line_2', 'city', 'state', 'zipcode'];
    
    /*public function info()
    {
        return $this->hasOne('\Models\CustomerInfo', 'customer_id', 'id');
    }*/
    
    public function orders()
    {
        return $this->hasMany('\Models\Order', 'customer_id', 'id');
    }
    
    public function invoices()
    {
        return $this->hasMany('\Models\Invoice', 'customer_id', 'id');
    }
    
}