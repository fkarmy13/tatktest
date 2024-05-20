<?php 
//Подключение к файлу с БД
require_once('../db.php');
//Запуск сессии для приема данных пользователя с файла signin
session_start();
if (!$_SESSION['user']) {
  header('Location: ../authorize.php');
}
$g=$_GET['num_group']; //получения номера группы из group_student_list
$res = mysqli_query($conn, "SELECT * FROM `users` WHERE num_group=$g ");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/list.css">
    <title>Курсанты</title>
</head>
<body>
<? include("menu.php"); //подключение меню?>
<div class="card_list" >
  <div class="back">
    <a  href="group_student_list.php">Назад</a>
  </div>
  <?php
    while ($result = mysqli_fetch_assoc($res)) {?>
      <!--Вывод информации с ранее полученного массива по ключам-->
      <div class="card_1">
        <p>ФИО: <?= $result['last_name'].' '.$result['first_name'].' '.$result['pathronymic'].', '.$result['num_group'].' группа, почта: '. $result['email']?></p>
      </div>
    <?php } ?>
</div>
</body>
</html>