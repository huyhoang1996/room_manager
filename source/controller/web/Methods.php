<?php
namespace controller\web;
class Methods
{
    public function view($view,$parram = null){
        $data = $parram;
        require "view/".$view;
    }
}
