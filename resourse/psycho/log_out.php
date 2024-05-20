<?php
session_start(); //запуск сессии
$_SESSION = array();
unset($_SESSION); // для очистки всех данных сессии
session_destroy(); //очистка
header('Location: ../authorize.php'); //редирект на страницу авторизации