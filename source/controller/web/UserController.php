<?php
namespace controller\web;
require "controller/web/Methods.php";
Use controller\web\Methods;
class UserController extends Methods
{
    public function regedis($function) {
        switch($function) {
            case 'adminlogin' :
                $this->adminlogin();
            break;
            default :
                echo "invalidate function";
            break;
        }
    }
    public function adminlogin(){
        $this->view('admin/login.php');
    }
}
