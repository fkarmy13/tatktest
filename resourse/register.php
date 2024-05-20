<?php
//Запуск сессии для получения сообщений
 session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/register.css">
    <title>Document</title>
</head>
<body>
<div>
    <h1>РЕГИСТРАЦИЯ</h1>
    <!--Форма регистрации и передачи данных в файл register_users-->
    <form method="post" action="register_users.php">
        <div class="input-container ic1">
            <input class="input" type="text" placeholder=" "name="last_name"  />
            <div class="cut"></div>
            <label for="last_name" class="placeholder">Фамилия</label>
        </div>
        <div class="input-container ic1">
            <input class="input" type="text" placeholder=" " name="first_name">
            <div class="cut"></div>
            <label for="first_name" class="placeholder">Имя</label>
        </div>
        <div class="input-container ic1">
            <input class="input" type="text"  placeholder=" " name="pathronymic">
            <div class="cut"></div>
            <label for="pathronymic" class="placeholder">Отчество</label>
        </div>
        <div class="input-container ic1">
            <input class="input" type="text" placeholder=" " name="num_group">
            <div class="cut"></div>
            <label for="num_group" class="placeholder">Группа</label>
        </div>
        <div class="input-container ic1">
            <input class="input" type="email" placeholder=" " name="email">
            <div class="cut"></div>
            <label for="email" class="placeholder">Электронная почта</label>
        </div>
        <div class="input-container ic1">
            <input class="input" type="password"  placeholder=" " name="pass">
            <div class="cut"></div>
            <label for="pass" class="placeholder">Пароль</label>
        </div>
        <div class="input-container ic1">
            <input class="input" type="password" placeholder=" " name="repeat_pass" id="repeat_pass">
            <div class="cut"></div>
            <label for="repeat_pass" class="placeholder">Подтвердите пароль</label>
        </div>
        <div class="link_a">
            <a class="link" href="authorize.php">Зарегистрированы? Перейти на страницу авторизации</a>
        </div>
        <!--Вывод ошибок/сообщений-->
        <div class="errors">
            <?php 
                if ($_SESSION['message']) {
                    echo '<p>'.$_SESSION['message'].'</p>';
                }
                unset($_SESSION['message']);
            ?>
        </div>
        <div>
            <button class="glow-on-hover" type="submit" >ОТПРАВИТЬ</button>
        </div>
    </form>
</div>
</body>
</html>