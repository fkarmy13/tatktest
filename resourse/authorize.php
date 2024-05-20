<?php
//Запуск сессии для приемки сообщений
 session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/register.css">
    <title>Авторизация</title>
</head>
<body>
    <div>
        <h1>АВТОРИЗАЦИЯ</h1>
        <!--Форма авторизации и передачи данных в файл signin-->
        <form method="POST" action="signin.php">
            <div class="input-container ic1">
                <input class="input" type="email"  placeholder=" " name="email" id="email" >
                <div class="cut"></div>
                <label for="email" class="placeholder">Электронная почта</label>
            </div>
            <div class="input-container ic1">
                <input class="input" type="password"  placeholder=" " name="pass" id="pass">
                <div class="cut"></div>
                <label for="password" class="placeholder">Пароль</label>
            </div>
            <div class="link_a">
                <a class="link" href="register.php">Ещё не зарегистрированы? Перейти на страницу регистрации</a>
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
            <div >
                <button class="glow-on-hover" type="submit" >Войти</button>
            </div>
        </form>
    </div>
</body>
</html>