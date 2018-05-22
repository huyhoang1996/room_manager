<?php
Namespace controller;
require "controller/web/UserController.php";
require "controller/web/DashBoardController.php";
require "controller/web/HomeController.php";
require "controller/web/RoomController.php";

require "controller/api/ApiUserController.php";
require "controller/api/ApiScheduleController.php";
require "controller/api/ApiRoomController.php";



Use controller\web\UserController;
Use controller\web\DashBoardController;
Use controller\web\HomeController;
Use controller\web\RoomController;

Use controller\api\ApiUserController;
Use controller\api\ApiScheduleController;
Use controller\api\ApiRoomController;

class Controller
{
    function handleWebRequest($web){
        switch($web){
            case null:
                header("Location: ?web=home");
                exit();
            break;
            case 'home':
                $this->useWebController('HomeController','home');
                exit();
            break;
            case 'room':
                $this->useWebController('RoomController','index');
                exit();
            break;
            case 'update_user':
                $this->useWebController('UserController','update_user');
            exit();
            case 'logout':
                unset($_SESSION['user']);
                unset($_SESSION['user_id']);
                header("Location: ?web=home");
                exit();
            break;
        }

        if (!isset($_SESSION['user'])) {
            switch($web){
                case 'admin':
                    header("Location: ?web=adminlogin");
                break;
                case 'adminlogin':
                    $this->useWebController('UserController','adminlogin');
                break;
                case 'dashboard':
                    header("Location: ?web=admin");
                break;
                case 'login':
                    $this->useWebController('HomeController','login');
                break;
                default:
                    echo $web;
                break;
            }
        } else {
            $user = $_SESSION['user'];
            if ($user->isAdmin()){
                switch($web){
                    case 'admin':
                        $this->useWebController('DashBoardController','home');
                    break;
                    case 'dashboard':
                        $this->useWebController('DashBoardController','home');
                    break;
                    case 'list_data':
                        $this->useWebController('RoomController','list_data');
                    break;
                    case 'add_room':
                        $this->useWebController('RoomController','add_room');
                    break; 
                    case 'update_room':
                        $this->useWebController('RoomController','update_room');
                    break;
                    case 'delete_room':
                        $this->useWebController('RoomController','delete_room');
                    break;
                    case 'list_user':
                        $this->useWebController('UserController','list_user');
                    break;
                    case 'add_user':
                        $this->useWebController('UserController','add_user');
                    break; 
                    case 'update_user':
                        $this->useWebController('UserController','update_user');
                    break;
                    case 'delete_user':
                        $this->useWebController('UserController','delete_user');
                    break;
                    default:
                        echo $web;
                    break;
                } 
            } else {
                switch($web) {
                    case 'admin':
                        echo "Ban khong phai admin";
                    break;
                    case 'dashboard':
                        echo "Ban khong phai admin";
                    break;
                    default:
                        echo $web;
                    break;
                } 
            }
        }
    }

    function handleApiRequest($api){
        switch($api){
            case 'login':
                $this->useApiController('ApiUserController','login');
            break;
            case 'schedule':
                $this->useApiController('ApiScheduleController','store');
            break;
            case 'schedule-show':
                $this->useApiController('ApiScheduleController','show');
            break;
            case 'add_room':
                $this->useApiController('ApiRoomController','add_room');
            break;
            case 'update_room':
                $this->useApiController('ApiRoomController','update_room');
            break;
            case 'add_user':
                $this->useApiController('ApiUserController','add_user');
            break;
            case 'update_user':
                $this->useApiController('ApiUserController','update_user');
            break;
            case 'schedule-detroy':
                $this->useApiController('ApiScheduleController','detroy');
            break;
            case 'schedule-update':
                $this->useApiController('ApiScheduleController','update');
            break;
            default:
                echo $api;
            break;
        }  
    }

    function useWebController($controller,$function){
        switch($controller){
            case 'UserController':
                $control = new UserController;
            break;
            case 'DashBoardController':
                $control = new DashBoardController;
            break;
            case 'HomeController':
                $control = new HomeController;
            break;
            case 'RoomController':
                $control = new RoomController;
            break;
            default:
                echo "invalidate controller";
            break;
        }
        $control->regedis($function);
    }

    function useApiController($controller,$function){
        switch($controller){
            case 'ApiUserController':
                $control = new ApiUserController;
            break;
            case 'ApiScheduleController':
                $control = new ApiScheduleController;
            break;
            case 'ApiRoomController':
                $control = new ApiRoomController;
            break;
            default:
                echo "invalidate controller";
            break;
        }
        $control->regedis($function);
    }

}