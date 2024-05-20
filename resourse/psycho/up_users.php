<?php 
//Подключение к файлу с БД
require_once('../db.php');
//Запуск сессии для приема данных пользователя с файла signin
session_start();
if (!$_SESSION['user']) {
  header('Location: ../authorize.php');
}


$g = $_SESSION['num'];


$res = mysqli_query($conn, "SELECT * FROM `users` WHERE num_group=$g ");
print_r($g);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/update.css">
    <title>Редактирование</title>
</head>
<body>
<? include("menu.php"); //подключение меню?>
<div class="card" >
  <div class="back">
    <a  href="update_list.php?num_group=<?= $g?>">Назад</a>
  </div>
    <div class="card_1">
        <table class>
        <tr><th>id</th>
        <th>Фамилия</th>
            <th>Имя</th>
            <th>Отчество</th>
            <th>Группа</th>
            <th>Почта</th></tr>
            <?php
            
                while ($result = mysqli_fetch_assoc($res)) {?>
                <!--Вывод информации с ранее полученного массива по ключам-->
                
                

                <tr><td><?= $result['id_user']?></td>
                <td><?= $result['last_name']?></td>
                <td><?= $result['first_name']?></td>
                <td><?= $result['pathronymic']?></td>
                <td><?= $result['num_group']?></td>
                <td><?= $result['email']?><td></tr>

                    
                <?php } ?>
        </table>
        
</div>
</body>
</html>