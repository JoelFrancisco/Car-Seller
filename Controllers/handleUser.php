<?php

require_once '../Models/Entities/User.php';
require_once '../Models/Entities/ITable.php';
//require_once $_SERVER['DOCUMENT_ROOT'].'/car-seller/Models/Database/Repositories/UserRepository.php';
require_once '../Models/Database/Repositories/UserRepository.php';

echo $_SERVER['DOCUMENT_ROOT'];

session_start();
// $connection = mysqli_connect('localhost', 'root', '14701470');
// $database = mysqli_select_db($connection, 'revenda');
$connection = new mysqli("localhost", "root", "14701470", "revenda");

$name = $_POST['name'];
$login = $_POST['login'];
$password = $_POST['password'];
$photo = $_FILES['photo'];

if (isset($_POST['insertButton'])) {
    echo $name;
    echo $login;
    echo $password;
    echo $photo;
    echo '<br>';
    $user = new User($name, $login, $password, $photo);

    echo $user->name;
    echo $user->login;
    echo $user->password;
    echo $user->photo;
    echo '<br>';
    //$userRepository = new UserRepository($connection);

    //$userRepository->test();
    //$userRepository->insert($user);
}

$connection -> close();
?>