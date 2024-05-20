<?php 
//Подключение к файлу с БД
require_once('../db.php');
//Запуск сессии для приема данных пользователя с файла signin
session_start();
if (!$_SESSION['user']) {
  header('Location: ../authorize.php');
}

$id_user = $_SESSION['user']['id_user'];
$res = mysqli_query($conn, "SELECT * FROM `users` WHERE id_user = '$id_user'");
$result = mysqli_fetch_assoc($res);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/register.css">
    <title>Профиль</title>
</head>
<body>
<? include("menu.php"); ?>
  <div class="card" >
    <div class="cards">
      <!--Вывод информации с ранее полученного массива по ключам-->
      <h2>Фамилия: <?= $result['last_name']?></h2>
      <h2>Имя: <?= $result['first_name']?></h2>
      <h2>Отчество: <?= $result['pathronymic']?></h2>

    </div>
  </div>
</body>
</html> 