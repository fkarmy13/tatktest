<?php 
//Подключение к файлу с БД
require_once('../db.php');
//Запуск сессии для приема данных пользователя с файла signin
session_start();
if (!$_SESSION['user']) {
  header('Location: ../authorize.php');
}

$_SESSION['num'] = $_GET['num_group'];
$g = $_SESSION['num'];


$res = mysqli_query($conn, "SELECT * FROM `users` WHERE num_group=$g");
$result1 = mysqli_query($conn, "SELECT * FROM `users` WHERE num_group = $g");
$t1 = mysqli_fetch_assoc($result1);


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
    <a  href="update_user.php">Назад</a>
  </div>
  <form action="update.php" method="POST">
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
        <h2>Введите данные, которые хотите изменить.</h2>
        <table>
        <tr><th>id</th>
        <th>Фамилия</th>
            <th>Имя</th>
            <th>Отчество</th>
            <th>Группа</th>
            <th>Почта</th></t>
        <tr><td><input class="input_1" type="text" name="id_user" id="id" value="<?= $t1['id_user']?>"></td>
        <td><input class="input" type="text" name="last_name" id="last_name" value="<?= $t1['last_name']?>"></td>
                <td><input class="input" type="text" name="first_name" id="first_name" value="<?= $t1['first_name']?>"></td>
                <td><input class="input" type="text" name="pathronymic" id="pathronymic"  value="<?= $t1['pathronymic']?>"></td>
                <td><input class="input" type="text" name="num_group" id="num_group"  value="<?= $g?>"></td>
                <td><input class="input" type="email" name="email" id="email"  value="<?= $t1['email']?>"><td></tr>
        </table>
                    <!--Вывод ошибок/сообщений-->
        <div class="errors">
            <?php 
                if ($_SESSION['message']) {
                    echo '<p>'.$_SESSION['message'].'</p>';
                }
                unset($_SESSION['message']);
            ?>
        </div>
        
        <div class="btn">
                <button class="glow-on-hover" type="submit" >СОХРАНИТЬ</button>
            </div>
    </div>
                </form>
</div>
</body>
</html>