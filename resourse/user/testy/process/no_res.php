<?php 
//Запуск сессии для получения сообщений
session_start();
//Подключение к файлу с БД
require_once('db.php');
//Переменная с id авторизованного пользователя
$id_user = $_SESSION['user']['id_user'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/resourse/css/result.css">
    <title>Результат</title>
</head>
<body>
<? include("../menu.php"); ?>
  <div class="card">
    <div class="cards">
      <h2><?= $_SESSION['user']['first_name'].' '.$_SESSION['user']['pathronymic']?></h2>
    </div>
    <div class="cards">
      <!--Вывод сообщения о непрохождении теста-->
      <div class="errors">
        <?php 
          if ($_SESSION['message']) {
            echo '<p>'.$_SESSION['message'].'</p>';
          }
            unset($_SESSION['message']);
          ?>
      </div>
    </div>
  </div>
</body>
</html>