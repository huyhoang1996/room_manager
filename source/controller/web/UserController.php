<?php
namespace controller\web;
include_once "model/User.php";
use model\User;
class UserController
{
    public function regedis($function) {
        switch($function) {
            case 'adminlogin' :
                $this->adminlogin();
            break;
            case 'list_user' :
                $this->list_user();
            break;
            case 'add_user' :
                $this->add_user();
            break;
            case 'update_user' :
                $this->update_user();
            break;
            case 'delete_user' :
                $this->delete_user();
            break;
            default :
                echo "invalidate function";
            break;
        }
    }
    public function adminlogin(){
        $this->view('admin/login.php');
    }
    public function list_user(){
        $user = new User;
        $data = $user->all();
        $this->view('admin/list_user.php', $data);
    }
    public function add_user(){
        $user = new user;
        $this->view('admin/form_user.php');
    }
    public function update_user(){
        $user = new user;
        $id = $_GET['id'];
        $data = $user->get_user($id);
        $this->view('admin/form_user.php', $data);
    }
    
    public function delete_user(){
        $user = new user;
        $id = $_GET['id'];
        $user->delete_user($id);
        $data = $user->all();
        $this->view('admin/list_user.php', $data);
    }

    function view($view,$parram = null){
        $data = $parram;
        require "view/".$view;
    }
}
