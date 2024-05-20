<?php
session_start(); //запуск сессии
$_SESSION = array();
unset($_SESSION); //  для очистки данных сессии
session_destroy(); // удаление сессии
header('Location: ../authorize.php'); //редирект на страницу авторизации