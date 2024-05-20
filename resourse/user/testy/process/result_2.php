<?php 
//Запуск сессии для передачи сообщений
session_start();
//Подключение к файлу с БД
require_once('db.php');
//Переменная с id авторизованного пользователя
$id_user = $_SESSION['user']['id_user'];
$re = mysqli_query($conn, "SELECT * FROM `result` WHERE id_test = '2' AND id_user='$id_user'");
//Переменная для вывода названия теста, который не пройден
$res_error = mysqli_query($conn, "SELECT * FROM `test` WHERE id_test = '2'");
$er = mysqli_fetch_assoc($res_error);
//Проверка на прохождение теста
if (mysqli_num_rows($re) > 0) {
  $q = mysqli_fetch_assoc($re); 
} else {
  //Вывод сообщения в файле res
  $_SESSION['message'] = 'Вы не проходили данный тест: '.$er['name_test'];
  //Редирект на данный файл
  header('Location: no_res.php');
}
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
      <h3>Ваш результат</h3>
      <p class="res"><?=$q['result']?></p>
    </div>
  <div>
    <h2>Ваши ответы</h2>
      <?php
        $n = 0;
          For ($i=21; $i<50; $i++){
            $r = $_POST[$i];
            $res = mysqli_query($conn, "SELECT * FROM `question` WHERE id_test = '2' AND id_question = '$i'");
            $q = mysqli_fetch_assoc($res);
            $re = mysqli_query($conn, "SELECT * FROM `answer` WHERE id_test = '2' AND id_user='$id_user' AND id_question= '$i'");
            $q1 = mysqli_fetch_assoc($re); ?>
            <div class="cards">
              <p class="res"><?=$q['num_question'].'. '.$q['question']?></p>
              <p class="res"><?=$q1['answer']?></p></div><?php
            }?>
  </div>
</body>
</html>