<?php
namespace controller\web;
require "model/Room.php";
use model\Room;
class RoomController
{
    public function regedis($function) {
        switch($function) {
            case 'index' :
                $this->index();
            break;
            default :
                echo "invalidate function";
            break;
        }
    }
    public function index(){
        $room = new Room;
        $data = $room->all();
        var_dump($data );exit();
        $this->view('front/room.php');
    }

    function view($view,$parram = null){
        $data = $parram;
        require "view/".$view;
    }
}
