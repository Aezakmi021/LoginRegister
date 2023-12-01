<?php

include 'Dbh.class.php';

class LoginModel extends Dbh
{

    protected $error;

    public function __construct()
    {
        $this->error = null;
    }

    protected function getUser($name, $password)
    {

        $stmt = $this->connect()->prepare('SELECT password FROM users WHERE name = ? OR email = ?');

        if (!$stmt->execute(array($name, $name))) {
            $stmt = null;
            $this->error = "stmtFailed";
            return;
        }

        if ($stmt->rowCount() == 0) {
            $stmt = null;
            $this->error = "userNotFound";
            return;
        }

        $passwordHashed = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $checkPwd = password_verify($password, $passwordHashed[0]['password']);

        if ($checkPwd == false) {
            $stmt = null;
            $this->error = "wrongPassword";
            return;
        } elseif ($checkPwd == true) {
            $stmt = $this->connect()->prepare('SELECT * FROM users WHERE name = ? OR email = ? AND password = ?');

            if (!$stmt->execute(array($name, $name, $passwordHashed[0]['password']))) {
                $stmt = null;
                $this->error = "stmtFailed";
                return;
            }

            if ($stmt->rowCount() == 0) {
                $stmt = null;
                $this->error = "userNotFound";
                return;
            }

            $user = $stmt->fetchAll(PDO::FETCH_ASSOC);

            session_start();
            $_SESSION['userid'] = $user[0]['id'];
            $_SESSION['username'] = $user[0]['name'];
        }

        $stmt = null;
    }
}