<?php
    $connect = mysqli_connect("localhost", "root", "", "nsk-news");
    if(!$connect) {
        die("не удалось подключиться к Базе данных");
    }
