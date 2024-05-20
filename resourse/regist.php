<?php
//Запуск сессии для получения сообщений
 //Запуск сессии для передачи сообщений
session_start();
//Подключение к файлу с БД
require_once('db.php');
echo $_SESSION['kod'];
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
    <h1>ПОДТВЕРЖДЕНИЕ РЕГИСТРАЦИИ</h1>
    <!--Форма регистрации и передачи данных в файл register_users-->
    <form method="post" action="reg.php">
        <div class="input-container ic1">
            <input class="input" type="text" placeholder=" "name="kod"  />
            <div class="cut"></div>
            <label for="kod" class="placeholder">Код подтверждения</label>
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