<?php
namespace controller\api;
require "model/User.php";
use model\User;
class ApiUserController
{
    public function regedis($function) {
        switch($function) {
            case 'login' :
                $this->login();
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
    
    public function login(){
        $data =  $_POST['data'];
        $user = new User;
        $result = $user->login($data);
        if ($result) {
            $user = new User($result->id,$result->is_admin,$result->username,$result->email,$result->avatar,$result->phone,$result->address,$result->role_id);
            $_SESSION['user'] = $user;
            return $this->setSuccess(200,$result);
        } else {
            $message = 'Username/password doest not marked or this account does not exit';
            return $this->setError(404,$result,$message);
        }
    }
    
}

?>
