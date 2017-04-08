<?php
namespace Controllers;

class Controller
{

    protected $base;
    protected $param;
    protected $page = 1;
    protected $per_page = 15;
    protected $controller;
    protected $messages;
    protected $errors;

    public function __construct($f3, $param)
    {
        if(!isset($_SESSION)){
            @session_start();
        }

        if(isset($_GET['page'])){
            $this->page = $_GET['page'];
        }

        $this->base = $f3;
        unset($param[0]);
        $this->param = $param;
        $this->controller = (new \ReflectionClass($this))->getShortName();

        $this->base->set('messages', $this->messages);
        $this->base->set('errors', $this->errors);
        //dd($this->param);
        //dd($this);
        /*$this->base->set('session', new \Session($onsuspect = null, 'csrf_token', null));

        if(!$this->base->get('SESSION.csrf_token')){
            $this->base->set('SESSION.csrf_token', $this->base->session->csrf());
        }

        if($this->base->VERB == 'POST'){

            if($this->base->get('POST.csrf_token') != $this->base->get('SESSION.csrf_token')){
                $f3->error(403);
            }

            $this->base->set('SESSION.csrf_token', $this->base->session->csrf());

        }*/

    }

    public function beforeRoute()
    {
    }

    public function afterRoute()
    {
    }

    public function logout()
    {
        $_SESSION = [];
        setcookie(session_name(), '', time()-1);
        session_destroy();

        header('Location: '.$this->base->get('URL'));
        die;
    }

}
