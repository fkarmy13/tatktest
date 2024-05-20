<?php 
//Подключение к файлу с БД
require_once('../db.php');
//Запуск сессии для приема данных пользователя с файла signin
session_start();
if (!$_SESSION['user']) {
  header('Location: ../authorize.php');
}
$_SESSION['id_test'] = $_GET['id_test'];
$id_test = $_SESSION['id_test'];
if (!$id_test) {
    $id_test = $_SESSION['id_t'];
  }

//$id_user = $_SESSION['user']['id_user'];
$res = mysqli_query($conn, "SELECT DISTINCT num_group FROM `users` WHERE num_group IS NOT NULL ORDER BY num_group ");
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
<? include("menu.php"); //подключение меню?>
<div class="card" >
    <div class="cards">
      <!--Вывод информации с ранее полученного массива по ключам-->
      <div class="back">
    <a href="group_student_result.php">Назад</a>
  </div>
        <div class="cards">
            <h2>Выберите группу </h2>
                    <?php
                        while ($result = mysqli_fetch_assoc($res)) {?>
                        <div class="link">
                            <a href='student_result.php?num_group=<?= $result['num_group']?>&id_test=<?= $id_test?>'><?=$result['num_group']?></a>
                        </div>
                    <?php } ?>
        </div>
    
    </div>
</div>
</body>
</html>