<?php
namespace model;
use Connect;
class Room extends Connect
{
    public $table = 'rooms';
    public $name;
    public $id;

    function __construct($id = null,$name = null) 
    {
        parent::__construct();
        $this->id = (int) $id;
        $this->name = $name;
    }
    /**
     * Undocumented function
     *
     * @param array $data
     * @return void
     */
    
    /**
     * Get the value of password
     */ 
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @return  self
     */ 
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    public function all(){
        $sql = "SELECT * FROM $this->table";
        $result = mysqli_query($this->conn,$sql);
        $array = array();
        while ($obj = mysqli_fetch_object($result)){
            $array[]=$obj;
        }
        return $array;;
    }
}
?>