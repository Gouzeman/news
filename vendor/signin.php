<?php
    session_start();
    require_once "./db.php";

    $login = $_POST['login'];
    $password = md5($_POST['password']);

    $check_user = mysqli_query($connect, "SELECT * FROM `users` WHERE `login` = '$login' AND `password` = '$password'");

    if (mysqli_num_rows($check_user) > 0) {

        $user = mysqli_fetch_assoc($check_user);

        $_SESSION['user_id'] = $user['id'];
        $_SESSION['role'] = $user['role'];

        header('Location: ../index.php');

    } else {
        $_SESSION['message'] = 'Неверный логин или пароль';
        $_SESSION['message_type'] = 'error';

        header('Location: ../auth/auth.php');
    }