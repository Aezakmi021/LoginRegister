<?php

include 'SignupModel.class.php';

class SignupController extends SignupModel
{

    private $name;
    private $password;
    private $confirmPassword;
    private $email;


    public function __construct($name, $password, $confirmPassword, $email)
    {
        $this->name = $name;
        $this->password = $password;
        $this->confirmPassword = $confirmPassword;
        $this->email = $email;
    }

    public function signupUser(){
        if($this->emptyInput() == false){
            $this->error = "emptyInput";
            return;
        }
        if($this->invalidUsername() == false){
            $this->error = "invalidUsername";
            return;
        }
        if($this->invalidEmail() == false){
            $this->error = "invalidEmail";
            return;
        }
        if($this->pwdMatch() == false){
            $this->error = "passwordMatch";
            return;
        }
        if($this->usernameTakenCheck() == false){
            $this->error = "usernameTaken";
            return;
        }


        $this->setUser($this->name, $this->password, $this->email);
    }

    private function emptyInput()
    {
        if (empty($this->name) || empty($this->password) || empty($this->confirmPassword || empty($this->email))) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }

    private function invalidUsername()
    {
        if (!preg_match("/^[a-zA-Z0-9]*$/", $this->name)) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }

    private function invalidEmail()
    {
        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }

    private function pwdMatch()
    {
        if ($this->password !== $this->confirmPassword) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }

    private function usernameTakenCheck()
    {
        if (!$this->checkUser($this->name, $this->email)) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }

    public function getError()
    {
        return $this->error;
    }
}