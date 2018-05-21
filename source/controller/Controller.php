<?php
Namespace controller;
require "controller/web/UserController.php";
require "controller/api/ApiUserController.php";
Use controller\web\UserController as UserController;
Use controller\api\ApiUserController as ApiUserController;
class Controller
{
    function handleWebRequest($web){
        if (!isset($_SESSION['user'])) {
            switch($web){
                case null:
                    echo "null function";
                break;
                case 'admin':
                    header("Location: ?web=adminlogin");
                break;
                case 'adminlogin':
                    $this->useWebController('UserController','adminlogin');
                break;
                default:
                    echo $web;
                break;
            }         
        } else {
            $user = $_SESSION['user'];
            if ($user->isAdmin()){
                switch($web){
                    case 'dashboard':
                        echo "ok may la admin";
                    break;   
                    default:
                        echo $web;
                    break;
                } 
            } else {
                switch($web){
                    case 'dashboard':
                        echo "May deo phai admin con cho";
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