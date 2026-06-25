<?php
    session_start();
    require_once './vendor/db.php';

    $id = $_GET['id'];
    $result = mysqli_query($connect, "SELECT * FROM `news` WHERE `id` = '$id'");
    $news = mysqli_fetch_assoc($result);
?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="./src/output.css" rel="stylesheet">
    <title>Новость-1</title>
</head>
<body class="bg-[#efefef] min-h-screen flex flex-col">
<!------------------------------------------------>
<!------------------ ШАПКА САЙТА ----------------->
<!------------------------------------------------>
<header>
    <div class="bg-[#00204c] h-[55px] mb-4">
        <div class="max-w-[1100px] px-2 mx-auto h-full flex justify-between items-center">
            <!------------------ логотип ---------------->
            <div class="items-center">
                <a href="./index.php" class="text-white uppercase text-xl md:text-3xl font-semibold">лого</a>
            </div>
            <!------------------ навигация ---------------->
            <nav class="">
                <ul class="text-white flex justify-between gap-5">
                    <li>
                        <a href="./index.php" class="text-sm md:text-xl font-light ">Домой</a>
                    </li>
                    <li>
                        <a href="./contacts.php" class="text-sm md:text-xl font-light">Контакты</a>
                    </li>
                    <?php if(isset($_SESSION['role']) && $_SESSION['role'] == 1): ?>
                        <li>
                            <a href="./admin/create.php" class="text-sm md:text-xl font-light">Создать</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </nav>
            <!------------------ иконки ---------------->
            <div class="flex gap-2 items-center">
                <?php if(isset($_SESSION['role']) && $_SESSION['role'] == 1): ?>
                    <a href="./admin/messages.php">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="white" class="h-[22px] w-[22px] md:h-[30px] md:w-[30px]">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0" />
                        </svg>
                    </a>
                <?php endif; ?>
                <a href="#">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="white" class="h-[22px] w-[22px] md:h-[30px] md:w-[30px]">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                    </svg>
                </a>

                <?php if(isset($_SESSION['user_id'])): ?>
                    <a href="./vendor/logout.php" class="text-white text-xs md:text-sm">Выйти</a>
                <?php else: ?>
                    <a href="./auth/auth.php" class="text-white text-xs md:text-sm">Войти</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</header>

<!-------------------------------------------------->
<!----------------- ТЕЛО СТРАНИЦЫ ------------------>
<!-------------------------------------------------->
<main class="flex-1">
    <div class="max-w-[800px] mx-auto ">

        <div class="w-full bg-white flex flex-col p-[24px] mb-[12px] border border-solid border-[#0000001a] rounded-[16px]">
            <!----------------- ЗАГОЛОВОК ---------------->
            <h2 class="text-3xl font-bold mb-[20px]"><?= $news['title']?></h2>
            <p class="text-lg font-normal mb-4"><?= $news['description']?></p>
            <p class="text-[#77808c] text-sm mt-5"><?= $news['created_at']?></p>
            <!----------------- КАРТИНКА ------------------>
            <img src="./images/<?= $news['image'] ?>" alt="" class="py-[15px]">
            <!----------------- ТЕКСТ ------------------>
            <div class="flex flex-col gap-8 font-normal">
                <?php
                    $paragraphs = explode("\n", $news['text']);
                    foreach($paragraphs as $paragraph) {
                        if(trim($paragraph) != '') {
                            echo '<p class="text-lg">' . $paragraph . '</p>';
                        }
                    }
                ?>
            </div>
            <!----------------- ТЕГИ ------------------>
            <div class="flex flex-wrap pt-[25px] gap-[15px] text-[#77808c]" >
                <div class="p-[15px] rounded-[16px] bg-[#f5f5f5] hover:bg-[#0000000d]">
                    <p><a href="#"><?= $news['category']?></a></p>
                </div>

            </div>
        </div>
    </div>
</main>

<!-------------------------------------------------->
<!------------------ ПОДВАЛ САЙТА ------------------>
<!-------------------------------------------------->
<footer class="bg-[#00204c] h-[100px] ">
    <div class="max-w-[1100px] h-[100%] text-white mx-auto flex justify-between items-center">
        <!------------------ логотип ------------------>
        <a href="./index.php" class="text-white uppercase text-3xl font-semibold">лого</a>
        <!------------------ Навигация ------------------>
        <nav class="">
            <ul class="flex flex-col gap-2">
                <li>
                    <a href="./index.php">Домой</a>
                </li>
                <li>
                    <a href="./contacts.php">Контакты</a>
                </li>
            </ul>
        </nav>
    </div>
</footer>

</body>
</html>