<?php

include 'LoginModel.class.php';


class LoginController extends LoginModel
{

    private $name;
    private $password;
    //private $error;

    public function __construct($name, $password)
    {
        $this->name = $name;
        $this->password = $password;
        $this->error = null;
    }

    public function loginUser(){
        if($this->emptyInputUsernameAndPassword() == false)
        {
            $this->error = 'emptyInputUsernameAndPassword';
            return;
        }
        if($this->emptyInputUsername() == false){
            $this->error = 'emptyInputUsername';
            return;
        }
        if($this->emptyInputPassword() == false)
        {
            $this->error = 'emptyInputPassword';
            return;
        }
        
        $this->getUser($this->name, $this->password);
        return;
    }
    

    private function emptyInputUsername()
    {
        if (empty($this->name)) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }

    private function emptyInputPassword()
    {
        if (empty($this->password)) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }

    private function emptyInputUsernameAndPassword()
    {
        if (empty($this->name) && empty($this->password)) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }

    public function getError() {
        return $this->error;
    }
}