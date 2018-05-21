<?php
namespace model;
require "model/Model.php";
Use model\Model;
class User extends Model
{
    public $table = 'users';
    public $is_admin;
    public $username;
    public $email;
    protected $password;
    public $avatar;
    public $phone;
    public $address;
    public $role_id;
    public $id;

    function __construct($id = null,$is_admin = false,$username = null,
    $email = null,$avatar = null,$phone = null,
    $address = null,$role_id = null,$password = null) 
    {
        parent::__construct();
        $this->id = $id;
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
        $this->avatar = $avatar;
        $this->phone = $phone;
        $this->address = $address;
        $this->role_id = $role_id;
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

    /**
     * Check admin
     */
    public function isAdmin()
    {
        if($this->is_admin == 1) {
            return true;
        }
        return false;
    }

    function login($data=[]){
        $email = $data['email'];
        $password = md5($data['password']);
        $sql = "SELECT id,is_admin,username,email,avatar,phone,address,role_id FROM $this->table WHERE email = '$email' AND password = '$password'";
        $result = mysqli_query($this->conn,$sql);
        $obj = mysqli_fetch_object($result);
        return $obj;
    }

}
?>