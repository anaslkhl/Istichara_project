<?php


echo 'hello honey';

$email = trim($_POST['email']) ?? '';
$password = trim($_POST['password']) ?? '';

echo $email . PHP_EOL . $password;