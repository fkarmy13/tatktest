<?php 
//Подключение к файлу с БД
require_once('../db.php');
//Запуск сессии для приема данных пользователя с файла signin
session_start();
if (!$_SESSION['user']) {
  header('Location: ../authorize.php');
}
//$id_user = $_SESSION['user']['id_user'];
$res = mysqli_query($conn, "SELECT DISTINCT years FROM `result` WHERE years IS NOT NULL ORDER BY years ");
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
    
        <div class="cards">
            <h2>Выберите год </h2>
                    <?php
                        while ($result = mysqli_fetch_assoc($res)) {?>
                        <div class="link">
                            <a href='years_log.php?years=<?= $result['years']?>'><?=$result['years']?></a>
                        </div>
                    <?php } ?>
        </div>
    
    </div>
</div>
</body>
</html>