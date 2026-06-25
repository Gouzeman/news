<?php
    session_start();
    require_once "../vendor/db.php";

    $email = $_POST['email'];
    $name = $_POST['name'];
    $text = $_POST['text'];

    if(empty($email) || empty($name) || empty($text)) {
        $_SESSION['message'] = 'Заполните все поля';
        $_SESSION['message_type'] = 'error';
        header('Location: ../contacts.php');
        exit;
    }

    $stmt = mysqli_prepare($connect, "INSERT INTO `contacts` (`email`, `name`, `text`, `created_at`) VALUES (?, ?, ?, CURRENT_TIMESTAMP)");
    mysqli_stmt_bind_param($stmt, "sss", $email, $name, $text);
    mysqli_stmt_execute($stmt);

    $_SESSION['message'] = 'Спасибо за обращение! Мы свяжемся с Вами ответным письмом!';
    $_SESSION['message_type'] = 'success';
    header('Location: ../contacts.php');
