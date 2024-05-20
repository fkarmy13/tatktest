<?php 
//Подключение к файлу с БД
require_once('../db.php');
//Запуск сессии для приема данных пользователя с файла signin
session_start();
if (!$_SESSION['user']) {
  header('Location: ../authorize.php');
}
//$id_user = $_SESSION['user']['id_user'];
$g=$_GET['years']; //получение номера группы из group_student_result
$res = mysqli_query($conn, "SELECT DISTINCT u.id_user, u.last_name, u.first_name, u.pathronymic, u.num_group, r.result,  r.id_test, t.name_test FROM `users` u, `result` r, `test` t WHERE u.id_user=r.id_user AND r.id_test=t.id_test AND r.years=$g ORDER BY num_group, last_name ");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/update.css">
    <title>Результаты</title>
</head>
<body>
<? include("menu.php"); // подключение меню?>
<div class="card_list" >
  <div class="back">
    <a href="result_years.php">Назад</a>
  </div>
  <table>
        <tr>
        <th>Фамилия</th>
            <th>Имя</th>
            <th>Отчество</th>
            <th>Группа</th>
            <th>Тест</th></tr>
  <!--Вывод информации с ранее полученного массива по ключам-->
  <?php
    if (mysqli_num_rows($res) > 0) { //проверка на наличие записей в бд
      while ($result = mysqli_fetch_assoc($res)) { ?>
      <tr>
                <td><?= $result['last_name']?></td>
                <td><?= $result['first_name']?></td>
                <td><?= $result['pathronymic']?></td>
                <td><?= $result['num_group']?></td>
                <td><a href='results/test_<?= $result['id_test']?>.php?id_user=<?= $result['id_user']?>'><?= $result['name_test']?></a><td></tr>
        
        
      <?php } } else { ?>
        <h2>В данный год не проходили тестирование.</h2>
      <?php } ?>
</div>
</body>
</html>