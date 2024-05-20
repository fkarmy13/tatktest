<?php 
//Запуск сессии для передачи сообщений
session_start();
//Подключение к файлу с БД
require_once('db.php');
//Переменная с id авторизованного пользователя
$id_user = $_SESSION['user']['id_user'];
$re = mysqli_query($conn, "SELECT * FROM `result` WHERE id_test = '3' AND id_user='$id_user'");
//Переменная для вывода названия теста, который не пройден
$res_error = mysqli_query($conn, "SELECT * FROM `test` WHERE id_test = '3'");
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
          For ($i=50; $i<94; $i++){
            $r = $_POST[$i];
            $res = mysqli_query($conn, "SELECT * FROM `question` WHERE id_test = '3' AND id_question = '$i'");
            $q = mysqli_fetch_assoc($res);
            $re = mysqli_query($conn, "SELECT * FROM `answer` WHERE id_test = '3' AND id_user='$id_user' AND id_question= '$i'");
            $q1 = mysqli_fetch_assoc($re); ?>
            <?php 
            if ($q1['answer'] == '-3') {
                $p = 'не согласен полностью';
            } elseif ($q1['answer'] == '-2') {
                $p = 'не согласен частично';
            } elseif ($q1['answer'] == '-1') {
                $p = 'скорее не согласен, чем согласен';
            } elseif ($q1['answer'] == '+1') {
                $p = 'скорее согласен, чем не согласен';
            } elseif ($q1['answer'] == '+2') {
                $p = 'согласен частично';
            } else {
                $p = 'согласен полностью';
            }
            ?>
            <div class="cards">
              <p class="res"><?=$q['num_question'].'. '.$q['question']?></p>
              <p class="res"><?=$p?></p></div><?php
            }?>
  </div>
</body>
</html>