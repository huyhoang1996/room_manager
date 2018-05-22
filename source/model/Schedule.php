<?php
namespace model;
use Connect;
class Schedule extends Connect
{
    public $table = 'schedules';
    public $id;
    public $room_id;
    public $user_id;
    public $event;
    public $begin_at;
    public $end_at;

    function __construct($id = null,$room_id = null,$user_id = null,$event = null,$begin_at = null,$end_at = null) 
    {
        parent::__construct();
        $this->id = (int) $id;
        $this->room_id = $room_id;
        $this->user_id = $user_id;
        $this->event = $event;
        $this->begin_at = $begin_at;
        $this->end_at = $end_at;
    }
    
    public function store($data){
        $room_id = $data['room_id'];
        $user_id = $_SESSION['user']->id;
        $event = $data['event'];
        $begin_at = $data['begin_at'];
        $end_at = $data['end_at'];
        $sql = "INSERT INTO $this->table (room_id, user_id, event,begin_at,end_at) VALUES ('$room_id', '$user_id','$event','$begin_at','$end_at')";
        return mysqli_query($this->conn,$sql);
    }

    public function all(){
        $sql = "SELECT * FROM $this->table";
        $result = mysqli_query($this->conn,$sql);
        $array = array();
        while ($obj = mysqli_fetch_object($result)){
            $array[]=$obj;
        }
        return $array;;
    }
}
?>