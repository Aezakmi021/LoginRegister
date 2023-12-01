<?php

include 'Dbh.class.php';

class SignupModel extends Dbh
{
    protected $error;

    function __construct()
    {
        $this->error = null;
    }

    protected function setUser($name, $password, $email)
    {
        $stmt = $this->connect()->prepare('INSERT INTO users (name, password, email) VALUES (?,?,?)');

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        if (!$stmt->execute(array($name, $hashedPassword, $email))) {
            $stmt = null;
            $this->error = "stmtFailed";
            return;
        }

        $stmt = null;
    }

    protected function checkUser($name, $email)
    {
        $stmt = $this->connect()->prepare("SELECT name FROM users WHERE name = ? OR email = ?");

        if (!$stmt->execute(array($name, $email))) {
            $stmt = null;
            $this->error = "stmtFailed";
            return false;
        }

        if ($stmt->rowCount() > 0) {
            // User with the specified name or email already exists
            return false;
        } else {
            // User with the specified name and email does not exist, so it's not taken
            return true;
        }
    }


}