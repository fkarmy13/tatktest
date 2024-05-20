<?php 
//Запуск сессии для передачи сообщений
session_start();
if (!$_SESSION['user']) {
  header('Location: ../../../authorize.php');
}
//Подключение к файлу с БД
require_once('db.php');
$result1 = mysqli_query($conn, "SELECT * FROM `test` WHERE id_test = '1'");
$t1 = mysqli_fetch_assoc($result1);
$result2 = mysqli_query($conn, "SELECT * FROM `test` WHERE id_test = '2'");
$t2 = mysqli_fetch_assoc($result2);
$result3 = mysqli_query($conn, "SELECT * FROM `test` WHERE id_test = '3'");
$t3 = mysqli_fetch_assoc($result3);
$result4 = mysqli_query($conn, "SELECT * FROM `test` WHERE id_test = '4'");
$t4 = mysqli_fetch_assoc($result4);
$result5 = mysqli_query($conn, "SELECT * FROM `test` WHERE id_test = '5'");
$t5 = mysqli_fetch_assoc($result5);
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
    <h2>СПИСОК ТЕСТОВ</h2>
    <div class="cards">
      <!--Вывод наименования и описания теста из запроса по ключу-->
      <h2><?=$t1['name_test']?></h2>
      <p><?=$t1['description']?></p>
      <div class="link">
        <a class="link" href="result_1.php">ОТКРЫТЬ</a>
      </div>
    </div>
    <div class="cards">
      <h2><?=$t2['name_test']?></h2>
      <p><?=$t2['description']?></p>
      <div class="link">
        <a class="link" href="result_2.php">ОТКРЫТЬ</a>
      </div>
    </div>
    <div class="cards">
      <h2><?=$t3['name_test']?></h2>
      <p><?=$t3['description']?></p>
      <div class="link">
        <a class="link"href="result_3.php">ОТКРЫТЬ</a>
      </div>
    </div>
    <div class="cards">
      <h2><?=$t4['name_test']?></h2>
      <p><?=$t4['description']?></p>
      <div class="link">
        <a class="link" href="result_4.php">ОТКРЫТЬ</a>
      </div>
    </div>
    <div class="cards">
      <h2><?=$t5['name_test']?></h2>
      <p><?=$t5['description']?></p>
      <div class="link">
        <a class="link" href="result_5.php">ОТКРЫТЬ</a>
      </div>
    </div>
  </div>
</body>
</html>