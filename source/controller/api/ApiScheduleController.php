<?php
namespace controller\api;
require "model/Schedule.php";
use model\Schedule;
class ApiScheduleController
{
    public function regedis($function) {
        switch($function) {
            case 'store' :
                $this->store();
            break;
            case 'show' :
                $this->show();
            break;
            case 'detroy' :
                $this->detroy();
            break;
            case 'update' :
                $this->update();
            break;
            default :
                echo "invalidate function";
            break;
        }
    }
    function setSuccess($code,$data,$message = null,$error = null) {
        header('Content-Type: application/json');
        $response = [
            'meta'=> [
                'success' => true,
                'statusCode' => true,
                'message' => $message,
                'errors' => $error,
            ],
            'data' => $data
        ];

        $myJSON = json_encode($response);
        echo $myJSON;
        http_response_code($code);
    }

    function setError($code,$data,$message = null,$error = null) {
        header('Content-Type: application/json');
        $response = [
            'meta'=> [
                'success' => false,
                'statusCode' => $code,
                'message' => $message,
                'errors' => $error,
            ],
            'data' => $data
        ];
        $myJSON = json_encode($response);
        echo $myJSON;
        http_response_code($code);
    }
    
    public function store(){
        $data =  $_POST['data'];
        foreach($data as $event) {
            $shedule = new Schedule();
            $shedule->store($event);
        }
        $data = [];
        $message = 'Store success';
        return $this->setSuccess(200,$data,$message);
    }
    
    public function show(){
        $data =  $_POST['data'];
        if (!isset($data['begin_at'])){
            $result = [];
            return $this->setSuccess(200,$result);
        }
        $shedule = new Schedule();
        $result = $shedule->find($data);
        return $this->setSuccess(200,$result);
    }

    public function detroy(){
        $data =  $_POST['data'];
        $shedule = new Schedule();
        $result = $shedule->detroy($data);
        return $this->setSuccess(200,$result);
    }

    public function update(){
        $data =  $_POST['data'];
        $shedule = new Schedule();
        $result = $shedule->update($data);
        return $this->setSuccess(200,$result);
    }

    
}

?>
