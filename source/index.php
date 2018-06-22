<?php 
    require 'autoload.php';
    ob_start();
    session_start();
    $controller = new controller\Controller();
    if(isset($_GET['web'])) {
        $web = $_GET['web'];
        $controller->handleWebRequest($web);
    }
    else {
        if(isset($_GET['api'])) {
            $api = $_GET['api'];
            $controller->handleApiRequest($api);
        } else {
            $controller->handleWebRequest(null);
        }
    }
    ob_end_flush();
?>