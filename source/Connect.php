<?php
class Connect
{   
    protected $conn;
    public function __construct() {
        $this->conn = new mysqli('localhost:3306','root','8980','dutbook');
    }
}

