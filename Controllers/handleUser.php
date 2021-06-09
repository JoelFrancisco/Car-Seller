<?php

require('../Models/Entities/User.php');
require('../Models/Database/Repositories/UserRepository.php');

session_start();
$connection = mysqli_connect('localhost', 'root', '');
$database = mysqli_select_db($connection, 'revenda');

$name = $_POST['name'];
$login = $_POST['login'];
$password = $_POST['password'];
$photo = $_FILES['photo'];

if (isset($_POST['submit_button'])) {
    $user = new User($name, $login, $password, $photo);
    $userRepository = new UserRepository($connection, $database);

    $userRepository->insert($user);
}

?>