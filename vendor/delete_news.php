<?php
    session_start();
    if(!isset($_SESSION['role']) || $_SESSION['role'] != 1) {
        header('Location: ../index.php');
        exit;
    }
    require_once "../vendor/db.php";

    $id = $_GET["id"];

    $stmt = mysqli_prepare($connect, "DELETE FROM `news` WHERE `id` = ?");
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);

    header("location: ../index.php");