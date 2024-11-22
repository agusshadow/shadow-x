<?php

  $users = [
    ['email' => 'agus-user@hotmail.com', 'name' => 'agus-user', 'password' => 'passwordUser123'],
    ['email' => 'agus-admin@hotmail.com', 'name' => 'agus-admin', 'password' => 'passwordAdmin123'],
    ['email' => 'agus-superadmin@hotmail.com', 'name' => 'agus-superadmin', 'password' => 'passwordSuperadmin123']
  ];
    
  foreach ($users as $user) {
    $hashedPassword = password_hash($user['password'], PASSWORD_DEFAULT);
    echo "Email: {$user['email']} - Name: {$user['name']} - Password Hash: $hashedPassword\n";
  }

?>