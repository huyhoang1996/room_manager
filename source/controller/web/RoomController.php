<?php
namespace controller\web;
require "model/Room.php";
use model\Room;
class RoomController
{
    private $data = array();
    public function regedis($function) {
        switch($function) {
            case 'index' :
                $this->index();
            break;
            case 'list_data' :
                $this->list_data();
            break;
            case 'add_room' :
                $this->add_room();
            break;
            case 'update_room' :
                $this->update_room();
            break;
            case 'delete_room' :
                $this->delete_room();
            break;
            default :
                echo "invalidate function";
            break;
        }
    }
    public function index(){
        $room = new Room;
        $data = $room->all();
        $this->view('front/room.php',$data);
    }
    public function list_data(){
        $room = new Room;
        $data = $room->all();
        $this->view('admin/list.php', $data);
    }
    public function add_room(){
        $room = new Room;
        $this->view('admin/form_room.php');
    }
    public function update_room(){
        $room = new Room;
        $id = $_GET['id'];
        $data = $room->getRoom($id);
        $this->view('admin/form_room.php', $data);
    }
    
    public function delete_room(){
        $room = new Room;
        $id = $_GET['id'];
        $room->deleteRoom($id);
        $data = $room->all();
        $this->view('admin/list.php', $data);
    }

    function view($view,$parram = null){
        $data = $parram;
        require "view/".$view;
    }
}
