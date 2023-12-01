<?php

$data = json_decode(file_get_contents("php://input"));

$name = $data->username;
$password = $data->password;
$confirmPassword = $data->confirmPassword;
$email = $data->email;

include '../classes/SignupController.class.php';
$signup = new SignupController($name, $password, $confirmPassword, $email);

// Running error handlers and user handlers
$signup->signupUser();
// Going back to front page

if ($signup->getError()) {
    $response = ['error' => $signup->getError()];
} else {
   $response = ['success' => 'User successfuly created!'];
}

header('Content-type: application/json');
echo json_encode($response);
