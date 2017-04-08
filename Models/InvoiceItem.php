<?php
namespace Models;

class InvoiceItem extends \Illuminate\Database\Eloquent\Model
{
    public $timestamps = false;
    protected $fillable = ['invoice_id', 'product_id', 'quantity'];
    protected $table = 'invoiceitems';
    
    public function invoice()
    {
        return $this->hasOne('\Models\Invoice', 'id', 'invoice_id');
        //return $this->belongsTo('\Models\Invoice', 'invoice_id', 'id');
    }
    
    public function product()
    {
        return $this->hasOne('\Models\Product', 'id', 'product_id');
        //return $this->belongsTo('\Models\Product', 'product_id', 'id');
    }
    
}