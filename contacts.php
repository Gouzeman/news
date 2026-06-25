<?php
    session_start();
    require_once 'vendor/db.php';
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="./src/output.css" rel="stylesheet">
    <title>Контакты</title>
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
            <h2 class="flex justify-center text-2xl font-semibold">Контакты</h2>
            <p class="text-lg mb-[20px]">Если у вас есть новости, которыми вы бы хотели поделиться,то можете позвонить по номеру телефона ниже или отправить сообщение ниже. Далее с вами свяжутся наши редакторы</p>
            <span class="text-lg mb-[20px]">Контактный номер: 8 (123) 456-78-90</span>
            <form action="./vendor/contacts.php" method="post" class="flex flex-col gap-5 mb-2" enctype="multipart/form-data">
                <!------------- поле телефон/e-mail ------------>
                <div class="flex flex-col gap-2">
                    <label for="" class="uppercase text-lg">Ваш email</label>
                    <input class="border border-[#ccc] border-solid text-base p-[8px]" type="email" name="email" placeholder="e-mail" maxlength="255">
                </div>
                <!------------- поле телефон/e-mail ------------>
                <div class="flex flex-col gap-2">
                    <label for="" class="uppercase text-lg">Ваше имя</label>
                    <input class="border border-[#ccc] border-solid text-base p-[8px]" type="text" name="name" placeholder="Имя" maxlength="255">
                </div>
                <!--------------- поле сообщения ---------------->
                <div class="flex flex-col ">
                    <label for="" class="uppercase text-lg">Текст сообщения</label>
                    <textarea class="border border-[#ccc] border-solid p-[10px] " placeholder="Текст сообщения" name="text" maxlength="1000" rows="10"></textarea>
                </div>
                <!------------ кнопка отправки сообщеня ------------>
                <button type="submit" class="bg-[#1588e2] rounded-[10px] p-2 hover:opacity-[0.8] active:scale-[0.98]">
                    <span class="font-medium text-lg text-white ">Отправить</span>
                </button>
                <!------------ оповещение ------------>
                <?php if(isset($_SESSION['message'])): ?>
                    <div class="mt-2 p-3 rounded-lg <?= $_SESSION['message_type'] === 'success' ? 'bg-green-100' : 'bg-red-100' ?>">
                        <p class="text-center <?= $_SESSION['message_type'] === 'success' ? 'text-green-700' : 'text-red-700' ?>">
                            <?php
                            echo $_SESSION['message'];
                            unset($_SESSION['message']);
                            unset($_SESSION['message_type']);
                            ?>
                        </p>
                    </div>
                <?php endif; ?>
            </form>
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