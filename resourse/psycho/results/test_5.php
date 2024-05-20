<?php 
//Запуск сессии для передачи сообщений
session_start();
if (!$_SESSION['user']) {
  header('Location: ../authorize.php');
}
//Подключение к файлу с БД
require_once('../../db.php');
//Переменная с id авторизованного пользователя
$id_user=$_GET['id_user'];
$re = mysqli_query($conn, "SELECT DISTINCT u.last_name, u.first_name, u.pathronymic, r.result, r.id_test, a.answer FROM `users` u, `result` r, `answer` a WHERE u.id_user=r.id_user AND r.id_test=a.id_test AND u.id_user=$id_user AND r.id_test = '5'");

//Переменная для вывода названия теста, который не пройден
$res_error = mysqli_query($conn, "SELECT * FROM `test` WHERE id_test = '5'");
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
  <? include("menu.php"); ?>
  <div class="card">
  <a href='../../../word_user.php?id_user=<?= $id_user?>&id_test=5'>Сохранить результат курсанта</a>
    <div class="cards">
    <h3>Результат курсанта:</h3>
      <h2><?= $q['last_name'].' '.$q['first_name'].' '.$q['pathronymic']?></h2>
      <h3>Результат</h3>
      <p class="res"><?=$q['result']?></p>
    </div>
  <div>
    <h2>Ответы курсанта</h2>
    <?php
        $n = 0;
          For ($i=169; $i<249; $i++){
            $r = $_POST[$i];
            $res = mysqli_query($conn, "SELECT * FROM `question` WHERE id_test = '5' AND id_question = '$i'");
            $q = mysqli_fetch_assoc($res);
            $re = mysqli_query($conn, "SELECT * FROM `answer` WHERE id_test = '5' AND id_user='$id_user' AND id_question= '$i'");
            $q1 = mysqli_fetch_assoc($re); ?>
            <div class="cards">
              <p class="res"><?=$q['num_question'].'. '.$q['question']?></p>
              <p class="res"><?=$q1['answer']?></p></div><?php
            }?>
  </div>
</body>
</html>