<?php
namespace Libraries\Gateways;

class Billplz
{
    
    private $ch;
    private $host = 'https://billplz-staging.herokuapp.com/api/v3/';
    private $api_key;
    private $collection_id;
    private $sandbox;
    
    public function __construct($api_key = null, $collection_id = null, $sandbox = true)
    {
        
        $this->ch = curl_init();
        $this->api_key = $api_key;
        $this->collection_id = $collection_id;
        $this->sandbox = $sandbox;
        
        if(!$sandbox){
            $this->host = 'https://www.billplz.com/api/v3/';
        }
        
    }
    
    public function create_bill($param)
    {
        $param['collection_id'] = $this->collection_id;
        
        $ch = $this->ch;
        curl_setopt($ch, CURLOPT_URL, $this->host.'/bills');
        curl_setopt($ch, CURLOPT_USERPWD, $this->api_key.':');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $param);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        
        $res = curl_exec($ch);
        
        return $res;
    }
    
    public function checkout($param)
    {
        return $this->create_bill($param);
    }
    
}