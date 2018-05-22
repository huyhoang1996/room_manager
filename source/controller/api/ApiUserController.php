<?php
namespace controller\api;
include_once "model/User.php";
use model\User;
use Connect;
class ApiUserController extends Connect
{
    public function regedis($function) {
        switch($function) {
            case 'login' :
                $this->login();
            break;
            case 'add_user' :
                $this->add_user();
            break;
            case 'update_user' :
                $this->update_user();
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
            $_SESSION['user_id'] = $result->id;
            $_SESSION['is_admin'] = $result->is_admin;
            return $this->setSuccess(200,$result);
        } else {
            $message = 'Username/password doest not marked or this account does not exit';
            return $this->setError(404,$result,$message);
        }
    }
    public function add_user(){
        $data =  $_POST['data'];
        $username = $data['username'];
        $email = $data['email'];
        $phone = $data['phone'];
        $address = $data['address'];
        $password = md5($data['password']);
        $sql = "INSERT INTO users (username, email, phone, address, password) VALUES ('$username', '$email', '$phone', '$address', '$password');";
        $result = mysqli_query($this->conn,$sql);
        if ($result) {
            return $this->setSuccess(200,$result);
        } else {
            $message = 'Error Server';
            return $this->setError(404,$result,$message);
        }
    }
    public function update_user(){
        $data =  $_POST['data'];
        $username = $data['username'];
        $email = $data['email'];
        $phone = $data['phone'];
        $address = $data['address'];
        $password = md5($data['password']);
        $id = $data['id'];
        $sql = "UPDATE users
            SET username = '$username', email = '$email',phone = '$phone',address = '$address',password = '$password'
            WHERE ID = $id;";
        $result = mysqli_query($this->conn,$sql);
        if ($result) {
            return $this->setSuccess(200,$result);
        } else {
            $message = 'Error Server';
            return $this->setError(400,$result,$message);
        }
    }
}

?>
