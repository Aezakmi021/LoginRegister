<?php

$data = json_decode(file_get_contents("php://input"));
    
$name = $data->username;
$password = $data->password;

// Instantiate LoginContr class
include '../classes/LoginController.class.php';
$login = new LoginController($name, $password);

// Running error handlers and user handlers
$login->loginUser();
    
if ($login->getError()) {
     $response = ['error' => $login->getError()];
} else {
    $response = ['success' => 'Logged in successfully'];
}

header('Content-type: application/json');
echo json_encode($response);

