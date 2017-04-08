<?php
namespace Models;

class Invoice extends \Illuminate\Database\Eloquent\Model
{
    
    public $timestamps = false;
    protected $fillable = ['customer_id', 'order_id'];
    
    public function order()
    {
        //return $this->belongsTo('\Models\Order', 'order_id', 'id');
        return $this->hasOne('\Models\Order', 'id', 'order_id');
    }
    
    public function customer()
    {
        //return $this->belongsTo('\Models\Customer', 'customer_id', 'id');
        return $this->hasOne('\Models\Customer', 'id', 'customer_id');
    }
    
    public function items()
    {
        return $this->hasMany('\Models\InvoiceItem', 'invoice_id', 'id');
    }
    
    public function countPaidInvoice()
    {
        return $this->where('paid', 'Y')->count();
    }
    /*public function getTodaysIncome()
    {
        
        $income = 0;
        
        $invoices = $this->whereRaw('paid=\'Y\' AND day(paid_date) = day(now()) AND month(paid_date) = month(now())')->get();

        foreach($invoices as $invoice){
            
            $invoiceitems = $invoice->items;
            var_dump($invoiceitems);
            die;
        }
        
    }*/
    
}