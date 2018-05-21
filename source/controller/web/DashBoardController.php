<?php
namespace controller\web;
class DashBoardController
{
    public function regedis($function) {
        switch($function) {
            case 'home' :
                $this->home();
            break;
            default :
                echo "invalidate function";
            break;
        }
    }
    public function home(){
        $this->view('admin/home.php');
    }

    function view($view,$parram = null){
        $data = $parram;
        require "view/".$view;
    }
}
