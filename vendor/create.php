<?php
    session_start();
    require_once "../vendor/db.php";

    $theme = $_POST['theme'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $text = $_POST['text'];
    $category = $_POST['category'];

    $image = $_FILES['image']['name'];
    move_uploaded_file($_FILES['image']['tmp_name'], "../images/" . $image);

    if(empty($theme) || empty($title) || empty($description) || empty($text) || empty($category)) {
        $_SESSION['message'] = 'Заполните все поля';
        $_SESSION['message_type'] = 'error';
        header('Location: ../admin/create.php');
        exit;
    }

    if(empty($_FILES['image']['name'])) {
        $_SESSION['message'] = 'Добавьте картинку';
        $_SESSION['message_type'] = 'error';
        header('Location: ../admin/create.php');
        exit;
    }

    $stmt = mysqli_prepare($connect, "INSERT INTO `news` (`theme`, `title`, `description`, `text`, `image`, `category`, `created_at`) VALUES (?, ?, ?, ?, ?, ?, CURRENT_TIMESTAMP)");
    mysqli_stmt_bind_param($stmt, "ssssss", $theme, $title, $description, $text, $image, $category);
    mysqli_stmt_execute($stmt);


    $_SESSION['message'] = 'Новость успешно создана!';
    $_SESSION['message_type'] = 'success';

    header('Location: ../admin/create.php');
