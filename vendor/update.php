<?php
    session_start();
    require_once "../vendor/db.php";

    $id = $_POST['id'];
    $theme = $_POST['theme'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $text = $_POST['text'];
    $category = $_POST['category'];

    if($_FILES['image']['name']) {
        $image = $_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'], "../images/" . $image);
    } else {
        $image = $_POST['old_image'];
    }

    if(empty($theme) || empty($title) || empty($description) || empty($text) || empty($category)) {
        $_SESSION['message'] = 'Заполните все поля';
        $_SESSION['message_type'] = 'error';
        header('Location: ../admin/update.php?id=' . $id);
        exit;
    }

    $stmt = mysqli_prepare($connect, "UPDATE `news` SET `theme`=?, `title`=?, `description`=?, `text`=?, `image`=?, `category`=? WHERE `id`=?");
    mysqli_stmt_bind_param($stmt, "ssssssi", $theme, $title, $description, $text, $image, $category, $id);
    mysqli_stmt_execute($stmt);

    header("location: ../index.php");