<?php 
//Запуск сессии для передачи сообщений
session_start();
//Подключение файла с БД
require_once('db.php');
//Получение данных с файла authorize
$email = $_POST['email'];
//Зашифровка полученного пароля для сверки сЮД
$pass = md5($_POST['pass']);
//Запрос в БД для получения проверяемого пользователя
$check_user = mysqli_query($conn, "SELECT * From `users` WHERE `email` = '$email' AND `pass` = '$pass'");
//Проверка на пустые поля
if(empty($email) || empty($pass)){
    //Передача сообшения
    $_SESSION['message'] = 'Вы не заполнили поля';
    //Редирект
    header('Location: authorize.php');
    } else {
        //Проверка на наличие зарегистрированного пользователя
        if (mysqli_num_rows($check_user) > 0) {
            $user = mysqli_fetch_assoc($check_user);
            //Передача данных пользователя в массив
            $_SESSION['user'] = [
                "id_user" => $user['id_user'],
                "last_name" => $user['last_name'],
                "first_name" => $user['first_name'],
                "pathronymic" => $user['pathronymic'],
                "num_group" => $user['num_group'],
                "roles" => $user['roles'],
                "email" => $user['email'],
            ];
            if ($_SESSION['user']['roles'] === 'user') {
                //Редирект после авторизации в профиль для курсантов
                header('Location: user/profile.php');
            } elseif ($_SESSION['user']['roles'] === 'psycho') {
                //Редирект после авторизации в профиль для психолога
                header('Location: psycho/profile.php');
            } 
        } else {
            $_SESSION['message'] = 'Неверный логин или пароль';
            header('Location: authorize.php');
        }
    }