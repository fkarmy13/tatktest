<?php 
//Запуск сессии для приема данных пользователя с файла signin
session_start();
if (!$_SESSION['user']) {
  header('Location: ../authorize.php');
}
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
      <h2>Фамилия: <?= $_SESSION['user']['last_name']?></h2>
      <h2>Имя: <?= $_SESSION['user']['first_name']?></h2>
      <h2>Отчество: <?= $_SESSION['user']['pathronymic']?></h2>
      <h2>Группа: <?= $_SESSION['user']['num_group']?></h2>
      <h2>Почта: <?= $_SESSION['user']['email']?></h2>
    </div>
  </div>
</body>
</html>