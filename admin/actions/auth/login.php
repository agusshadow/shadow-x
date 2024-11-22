<?php

require_once "../../../functions/autoload.php";

$userData = $_POST;

echo "<pre>";
print_r($userData);
echo "</pre>";

$login = Auth::login($userData['email'], $userData['password']);

echo "<pre>";
print_r($login);
echo "</pre>";

if ($login) {

    if($login == "user"){ 
        header('location: ../../../index.php');
    }else{
        header('location: ../../index.php?sec=dashboard');
    }
    
} else {
    header('location: ../../../index.php?sec=login');
}

?>
