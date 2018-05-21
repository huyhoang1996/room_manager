<?php
Namespace controller;
require "controller/web/UserController.php";
require "controller/web/DashBoardController.php";
require "controller/web/HomeController.php";
require "controller/api/ApiUserController.php";

Use controller\web\UserController;
Use controller\web\DashBoardController;
Use controller\web\HomeController;

Use controller\api\ApiUserController;
class Controller
{
    function handleWebRequest($web){
        switch($web){
            case null:
                header("Location: ?web=home");
            break;
            case 'home':
                $this->useWebController('HomeController','home');
            break;
            case 'logout':
                unset($_SESSION['user']);
                header("Location: ?web=home");
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
            default:
                echo "invalidate controller";
            break;
        }
        $control->regedis($function);
    }

}