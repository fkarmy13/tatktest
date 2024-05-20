<?php 
//Запуск сессии для передачи сообщений
session_start();
//Подключение к файлу с БД
require_once('../db.php');

//Получение внесенных данных пользователем из файла register
$id_user = $_POST['id_user'];
$last_name = $_POST['last_name'];
$first_name = $_POST['first_name'];
$pathronymic = $_POST['pathronymic'];
$num_group = $_POST['num_group'];
$email = $_POST['email'];
$_SESSION['num']=$_POST['num_group'];



//Запрос в БД для проверки зарегистрированного пользователя
$check_user = mysqli_query($conn, "SELECT * From `users` WHERE `email` = '$email'");

//Проверка на пустые поля ввода
if(empty($id_user) ||empty($last_name) || empty($first_name) || empty($pathronymic) || empty($num_group) || empty($email)){
    //Вывод сообщения о пустых полях
    $_SESSION['message'] = 'Вы не заполнили поля';
    $_SESSION['num']=$_POST['num_group'];
    //Редирект на страницу регистрации
    header('Location: update_list.php');
    } else {
        //Внесение данных с register в БД
        $_SESSION['num']=$_POST['num_group'];
        $sql = "UPDATE `users` SET last_name = '$last_name', first_name = '$first_name', pathronymic = '$pathronymic', num_group = '$num_group', email = '$email' WHERE id_user='$id_user'";
        $conn -> query($sql);
        //Редирект на страницу авторизации
        header('Location: up_users.php');
        }
        