<?php
    session_start();
    require_once '../vendor/db.php';

    $per_page = 5;
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $offset = ($page - 1) * $per_page;

    $total = mysqli_fetch_assoc(mysqli_query($connect, "SELECT COUNT(*) as cnt FROM `contacts`"))['cnt'];
    $total_pages = ceil($total / $per_page);

    $contacts = mysqli_query($connect, "SELECT * FROM `contacts` ORDER BY `created_at` DESC LIMIT $per_page OFFSET $offset");

?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="../src/output.css" rel="stylesheet">
    <title>Обращения</title>
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
                <a href="../index.php" class="text-white uppercase text-xl md:text-3xl font-semibold">лого</a>
            </div>
            <!------------------ навигация ---------------->
            <nav class="">
                <ul class="text-white flex justify-between gap-5">
                    <li>
                        <a href="../index.php" class="text-sm md:text-xl font-light ">Домой</a>
                    </li>
                    <li>
                        <a href="../contacts.php" class="text-sm md:text-xl font-light">Контакты</a>
                    </li>
                    <?php if(isset($_SESSION['role']) && $_SESSION['role'] == 1): ?>
                        <li>
                            <a href="../admin/create.php" class="text-sm md:text-xl font-light">Создать</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </nav>
            <!------------------ иконки ---------------->
            <div class="flex gap-2 items-center">
                <?php if(isset($_SESSION['role']) && $_SESSION['role'] == 1): ?>
                    <a href="../admin/messages.php">
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
                    <a href="../vendor/logout.php" class="text-white text-xs md:text-sm">Выйти</a>
                <?php else: ?>
                    <a href="../auth/auth.php" class="text-white text-xs md:text-sm">Войти</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</header>

<!------------------------------------------------>
<!----------------- ТЕЛО СТРАНИЦЫ ---------------->
<!------------------------------------------------>
<main class="flex-1 mt-4">
    <div class="max-w-[1100px] mx-auto">
        <h2 class="text-2xl font-semibold mb-4">Сообщения от пользователей</h2>
        <?php if(mysqli_num_rows($contacts) == 0): ?>
            <p class="text-[#77808c]">Сообщений пока нет</p>
        <?php else: ?>
            <?php while($msg = mysqli_fetch_assoc($contacts)): ?>
                <div class="w-full bg-white flex flex-col p-[24px] mb-[12px] border border-solid border-[#0000001a] rounded-[16px]">
                    <div class="flex justify-between mb-2">
                        <span class="font-semibold"><?= $msg['name'] ?></span>
                        <div class="flex items-center gap-3">
                            <span class="text-[#77808c] text-sm"><?= $msg['created_at'] ?></span>
                            <a href="../vendor/delete_message.php?id=<?= $msg['id'] ?>" class="text-red-500 text-sm">Удалить</a>
                        </div>
                    </div>
                    <span class="text-[#1588e2] text-sm mb-2"><?= $msg['email'] ?></span>
                    <p><?= $msg['text'] ?></p>

                </div>
            <?php endwhile; ?>
        <?php endif; ?>

        <!-------------------------------------------------->
        <!------------------- ПАГИНАЦИЯ -------------------->
        <!-------------------------------------------------->
        <div class="w-full bg-white flex justify-center p-[24px] mb-[12px] border border-solid border-[#0000001a] rounded-[16px]">
            <ul class="flex gap-2 text-[#1588e2]">
                <?php if($page > 1): ?>
                    <li><a href="?page=<?= $page-1 ?>" class="w-[48px] h-[48px] flex items-center justify-center p-[12px] rounded-[3px] mx-[10px] hover:bg-[#0000000d]"><</a></li>
                <?php endif; ?>

                <?php for($i = 1; $i <= $total_pages; $i++): ?>
                    <li>
                        <a href="?page=<?= $i ?>" class="w-[48px] h-[48px] flex items-center justify-center p-[12px] rounded-[3px] hover:bg-[#0000000d] <?= $i == $page ? 'text-black' : '' ?>">
                            <?= $i ?>
                        </a>
                    </li>
                <?php endfor; ?>

                <?php if($page < $total_pages): ?>
                    <li><a href="?page=<?= $page+1 ?>" class="w-[48px] h-[48px] flex items-center justify-center p-[12px] rounded-[3px] mx-[10px] hover:bg-[#0000000d]">></a></li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</main>

<!-------------------------------------------------->
<!------------------ ПОДВАЛ САЙТА ------------------>
<!-------------------------------------------------->
<footer class="bg-[#00204c] h-[100px] ">
    <div class="max-w-[1100px] h-[100%] text-white mx-auto flex justify-between items-center">
        <!------------------ логотип ------------------>
        <a href="../index.php" class="text-white uppercase text-3xl font-semibold">лого</a>
        <!------------------ Навигация ------------------>
        <nav class="">
            <ul class="flex flex-col gap-2">
                <li>
                    <a href="../index.php">Домой</a>
                </li>
                <li>
                    <a href="../contacts.php">Контакты</a>
                </li>
            </ul>
        </nav>
    </div>
</footer>

</body>
</html>