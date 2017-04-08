<?php
namespace Helpers;

class General
{

    public static function generate_random($length = 8)
    {
        $output = "";
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $chars_split = str_split($chars);
        
        for($i=0; $i<$length; $i++){
            $output .= $chars_split[rand(0, (count($chars_split)-1))];
        }
        
        return $output;
    }
    
}