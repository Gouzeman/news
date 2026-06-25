<?php
    session_start();
?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="../src/output.css" rel="stylesheet">
    <title>Регистрация</title>
</head>
<body class="bg-[#efefef] min-h-screen flex flex-col">

<!-------------------------------------------------->
<!----------------- ТЕЛО СТРАНИЦЫ ------------------>
<!-------------------------------------------------->
<main class="my-auto">
    <div class="mx-auto max-w-[800px]">
        <div class="w-full bg-white flex flex-col  p-[24px] border border-solid border-[#0000001a] rounded-[16px]">
            <h2 class="flex justify-center  text-2xl font-semibold">регистрация</h2>
            <form action="../vendor/signup.php" method="post" class="flex flex-col gap-5 mb-4" enctype="multipart/form-data">
                <!------------- поле телефон/e-mail ------------>
                <div class="flex flex-col gap-2">
                    <label for="" class="uppercase text-lg">email</label>
                    <input class="border border-[#ccc] border-solid text-base p-[8px]" name="email" type="email" placeholder="Введите e-mail" maxlength="50">
                </div>
                <!------------- поле ЛОГИН ------------>
                <div class="flex flex-col gap-2">
                    <label for="" class="uppercase text-lg">Логин</label>
                    <input class="border border-[#ccc] border-solid text-base p-[8px]" name="login" type="text" placeholder="Введите логин" maxlength="50">
                </div>
                <!------------- поле пароля ------------>
                <div class="flex flex-col gap-2">
                    <label for="" class="uppercase text-lg">Пароль</label>
                    <input class="border border-[#ccc] border-solid text-base p-[8px]" type="password" name="password" placeholder="Придумайте пароль" maxlength="50">
                </div>
                <!------------- подтверждение пароля ------------>
                <div class="flex flex-col gap-2">
                    <label for="" class="uppercase text-lg">Подтвердите пароль</label>
                    <input class="border border-[#ccc] border-solid text-base p-[8px]" type="password" name="password_confirm" placeholder="Подтвердите пароль" maxlength="50">
                </div>
                <!------------ КНОПКА ОТПРАВКИ СООБЩЕНИЯ ------------>
                <button type="submit" class="bg-[#1588e2] rounded-[10px] p-2 hover:opacity-[0.8] active:scale-[0.98]">
                    <span class="font-medium text-lg text-white ">Зарегестрироваться</span>
                </button>
                <p >У вас уже есть учётная запись? <a href="./auth.php" class="text-[#1588e2]">Войти</a></p>
                <!------------ оповещение ------------>
                <?php if(isset($_SESSION['message'])): ?>
                    <div class="mt-2 p-3 bg-red-100 rounded-lg">
                        <p class="text-red-700 text-center">
                            <?php
                            echo $_SESSION['message'];
                            unset($_SESSION['message']);
                            ?>
                        </p>
                    </div>
                <?php endif; ?>

            </form>
        </div>
    </div>
</main>

</body>
</html>