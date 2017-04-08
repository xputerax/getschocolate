<?php
namespace Controllers;

class Hook extends Controller
{
    
    public function billplz()
    {
        //$res = json_encode($_GET);
        $res = json_encode($_POST);
        $res = json_decode($res);
        
        $invoice = \Models\Invoice::find($res->invoice_id)->first();
        $invoice->paid = 'Y';
        $invoice->payment_id = $res->id;
        $invoice->paid_date = \Carbon\Carbon::now();
        $invoice->gateway = 'billplz';
        $invoice->save();
        
    }
    
}