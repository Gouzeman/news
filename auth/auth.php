<?php
    session_start();

    if (isset($_SESSION['user_id'])) {
        header('location: ../index.php');
        exit;
    }
?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="../src/output.css" rel="stylesheet">
    <title>Авторизация</title>
</head>
<body class="bg-[#efefef] min-h-screen flex flex-col">

<!-------------------------------------------------->
<!----------------- ТЕЛО СТРАНИЦЫ ------------------>
<!-------------------------------------------------->
<main class="my-auto">
    <div class="mx-auto max-w-[800px]">
        <div class="w-full bg-white flex flex-col  p-[24px] border border-solid border-[#0000001a] rounded-[16px]">
            <h2 class="flex justify-center  text-2xl font-semibold">Авторизация</h2>
            <form action="../vendor/signin.php" method="post" class="flex flex-col gap-5">
                <!------------- поле телефон/e-mail ------------>
                <div class="flex flex-col gap-2">
                    <label for="" class="uppercase text-lg">Логин</label>
                    <input class="border border-[#ccc] border-solid text-base p-[8px]" type="text" name="login" placeholder="Введите логин" maxlength="50">
                </div>
                <!------------- поле пароля ------------>
                <div class="flex flex-col gap-2">
                    <label for="" class="uppercase text-lg">Пароль</label>
                    <input class="border border-[#ccc] border-solid text-base p-[8px]" type="password" name="password" placeholder="Введине пароль" maxlength="50">
                </div>
                <!------------ кнопка отправки сообщеня ------------>
                <button type="submit" class="bg-[#1588e2] rounded-[10px] p-2 mb-2 hover:opacity-[0.8] active:scale-[0.98]">
                    <span class="font-medium text-lg text-white ">Войти</span>
                </button>
                <p class="">У вас нет учётной записи? <a href="./register.php" class="text-[#1588e2] hover:border-b-2">зарегистрироваться</a></p>
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

</body>
</html>