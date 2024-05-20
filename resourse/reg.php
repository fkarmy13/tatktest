<?php
//Запуск сессии для передачи сообщений
session_start();
//Подключение к файлу с БД
require_once('db.php');
$kod_form = $_POST['kod'];
$kod = $_SESSION['kod'];
$last_name = $_SESSION['last_name'];
$first_name = $_SESSION['first_name'];
$pathronymic = $_SESSION['pathronymic'];
$num_group = $_SESSION['num_group'];
$email = $_SESSION['email'];
$pass = $_SESSION['pass'];
$repeat_pass = $_SESSION['repeat_pass'];
echo 'Код с формы: '.$kod_form.' Код передаваемый: '.$kod;
if($kod_form == $kod) {
    $pass = md5($pass);
    $sql = "INSERT INTO `users` (last_name, first_name, pathronymic, num_group, roles, email, pass) VALUES ('$last_name', '$first_name', '$pathronymic', '$num_group', 'user', '$email', '$pass')";
    $conn -> query($sql);
    //Вывод сообщения об успешной регистрации
    $_SESSION['message'] = 'Регистрация прошла успешно';
    //Редирект на страницу авторизации
    header('Location: authorize.php');

} else {
    $_SESSION['message'] = 'Неверный код';
    header('Location: regist.php');
}
?>