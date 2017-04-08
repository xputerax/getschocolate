<?php
namespace Helpers;

class Check
{
    
    public static function is_customer()
    {
        return isset($_SESSION['customer_id']);
    }
    
    public static function is_admin()
    {
        return isset($_SESSION['admin_id']);
    }
    
    public static function is_visitor()
    {
        return (!self::is_customer() && !self::is_admin());
    }
    
    public static function is_not_visitor()
    {
        return !self::is_visitor();
    }
    
    public static function can_login($redir_url)
    {
        if(self::is_visitor()){
            die(header('Location: '.\Base::instance()->BASE.'/'.$redir_url));
        }
    }
    
    public static function cannot_login($redir_url)
    {
        if(!self::is_visitor()){
            die(header('Location: '.\Base::instance()->BASE.'/'.$redir_url));
        }
    }
    
    public static function can_customer_login()
    {
        return self::can_login('account/login');
    }
    
    public static function can_admin_login()
    {
        return self::can_login('admin/login');
    }
    
    public static function cannot_customer_login()
    {
        return self::cannot_login('account/');
    }
    
    public static function cannot_admin_login()
    {
        return self::cannot_login('admin/');
    }
    
}