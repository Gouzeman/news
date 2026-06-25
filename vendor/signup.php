<?php
    session_start();
    require_once "./db.php";

    $email = $_POST['email'];
    $login = $_POST['login'];
    $password = $_POST['password'];
    $password_confirm = $_POST['password_confirm'];

    if(empty($email) || empty($login) || empty($password)) {
        $_SESSION['message'] = 'Заполните все поля';
        $_SESSION['message_type'] = 'error';
        header('Location: ../auth/register.php');
        exit;
    }

    if ($password === $password_confirm) {

        ///хешируем пароль перед отправкой в базу данных
        $password = md5($password);

        $stmt = mysqli_prepare($connect, "INSERT INTO `users` (`email`, `login`, `password`) VALUES (?, ?, ?)");
        mysqli_stmt_bind_param($stmt, "sss", $email, $login, $password);
        mysqli_stmt_execute($stmt);

        $_SESSION['message'] = 'Регистрация прошла успешно!';
        $_SESSION['message_type'] = 'success';
        header('Location: ../auth/auth.php');
    }
    else {
        $_SESSION['message'] = 'Пароли не совпадают';
        $_SESSION['message_type'] = 'error';
        header("Location: ../auth/register.php");
    }