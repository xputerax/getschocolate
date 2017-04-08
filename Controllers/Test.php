<?php
namespace Controllers;

class Test extends Controller
{
    
    public function index($f3)
    {
        $g = \Omnipay\Omnipay::create('PayPal_Express');
        $p = $g->getDefaultParameters();
        dd($g, $p);
    }
    
    public function test($f3, $param) //$f3, $param)
    {
        dd($f3, $param);
    }
    
}