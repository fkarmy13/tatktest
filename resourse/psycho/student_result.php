<?php 
//Подключение к файлу с БД
require_once('../db.php');
//Запуск сессии для приема данных пользователя с файла signin
session_start();
if (!$_SESSION['user']) {
  header('Location: ../authorize.php');
}
//$id_user = $_SESSION['user']['id_user'];
$g=$_GET['num_group']; //получение номера группы из group_student_result
$_SESSION['group'] = $g;
$id_test = $_GET['id_test'];
$_SESSION['id_t'] = $id_test;
$res = mysqli_query($conn, "SELECT DISTINCT u.id_user, u.last_name, u.first_name, u.pathronymic, u.num_group, r.result, r.id_test, t.name_test FROM `users` u, `result` r, `test` t WHERE u.id_user=r.id_user AND r.id_test=t.id_test AND u.num_group=$g AND r.id_test=$id_test ORDER BY name_test, last_name");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/list.css">
    <title>Результаты</title>
</head>
<body>
<? include("menu.php"); // подключение меню?>
<div class="card_list" >
  <div class="back">
    <a href="student_group.php">Назад</a>
    
  </div>
  <!--Вывод информации с ранее полученного массива по ключам-->
  <?php
    if (mysqli_num_rows($res) > 0) { //проверка на наличие записей в бд
      while ($result = mysqli_fetch_assoc($res)) {?>
        <div class="card_1">
          <h2>Фамилия:  <?= $result['last_name']?></h2>
          <h2>Имя:  <?= $result['first_name']?></h2>
          <h2>Отчество: <?= $result['pathronymic']?></h2>
          <h2>Группа:  <?= $result['num_group']?></h2>
          <h2>Название теста: <?= $result['name_test']?></h2>
          <h2>Результат: <?= $result['result']?></h2>
          <div class="back">
          <a href='results/test_<?= $result['id_test']?>.php?id_user=<?= $result['id_user']?>'>Посмотреть ответы</a>
          <a href='../../word_user.php?num_group=<?= $g?>&id_test=<?= $id_test?>&id_user=<?= $result['id_user']?>'>Сохранить результат курсанта</a>
      </div>
        </div> 
      <?php } } else { ?>
        <h2>Курсанты данной группы не проходили тестирование.</h2>
      <?php } ?>
</div>
</body>
</html>