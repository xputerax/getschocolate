<?php
namespace Models;

class Order extends \Illuminate\Database\Eloquent\Model
{
    
    public $timestamps = false;
    protected $fillable = ['customer_id'];
    
    public function customer()
    {
        //return $this->belongsTo('\Models\Customer', 'customer_id', 'id');
        return $this->hasOne('\Models\Customer', 'id', 'customer_id');
    }
    
    public function invoice()
    {
        //return $this->belongsTo('\Models\Invoice', 'invoice_id', 'id');
        return $this->hasOne('\Models\Invoice', 'order_id', 'id');
    }
    
    public function countUnapprovedOrder()
    {
        return $this->where('approved', 'N')->count();
    }
}