<?php
namespace controller\web;
class HomeController
{
    public function regedis($function) {
        switch($function) {
            case 'home' :
                $this->home();
            break;
            case 'login' :
                $this->login();
            break;
            default :
                echo "invalidate function";
            break;
        }
    }

    public function home(){
        $this->view('front/home.php');
    }

    public function login(){
        $this->view('front/login.php');
    }

    function view($view,$parram = null){
        $data = $parram;
        require "view/".$view;
    }
}
