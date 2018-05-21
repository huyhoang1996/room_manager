<?php
namespace controller\api;
require "controller/api/ApiController.php";
require "model/User.php";
use controller\api\ApiController;
use model\User;
class ApiUserController extends ApiController
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
