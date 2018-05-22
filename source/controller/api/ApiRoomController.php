<?php
namespace controller\api;
use Connect;
class ApiRoomController extends Connect
{
    public function regedis($function) {
        switch($function) {
            case 'add_room' :
                $this->add_room();
            break;
            case 'update_room' :
                $this->update_room();
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
    public function add_room(){
        $data =  $_POST['data'];
        $name = $data['name'];
        $sql = "INSERT INTO rooms (name) VALUES ('$name');";
        $result = mysqli_query($this->conn,$sql);
        if ($result) {
            return $this->setSuccess(200,$result);
        } else {
            $message = 'Error Server';
            return $this->setError(404,$result,$message);
        }
    }
    public function update_room(){
        $data =  $_POST['data'];
        $name = $data['name'];
        $id = $data['id'];
        $sql = "UPDATE rooms
            SET name = '$name'
            WHERE ID = $id;";
        $result = mysqli_query($this->conn,$sql);
        if ($result) {
            return $this->setSuccess(200,$result);
        } else {
            $message = 'Error Server';
            return $this->setError(404,$result,$message);
        }
    }
   
}

?>
