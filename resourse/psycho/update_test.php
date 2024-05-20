<?php 
//Подключение к файлу с БД
require_once('../db.php');
//Запуск сессии для приема данных пользователя с файла signin
session_start();
if (!$_SESSION['user']) {
  header('Location: ../authorize.php');
}

$_SESSION['id_test'] = $_GET['id_test'];
$id = $_SESSION['id_test'];



$res = mysqli_query($conn, "SELECT DISTINCT t.id_test, t.name_test, q.id_test, q.num_question, q.question, q.id_question FROM `question` q, `test` t WHERE t.id_test=q.id_test AND t.id_test = $id");
$re = mysqli_query($conn, "SELECT * FROM `test` WHERE id_test = $id");
$r = mysqli_fetch_assoc($re);



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
    <a  href="test.php">Назад</a>
  </div>
  <form action="upd.php" method="POST">
    <div class="card_1">
    <h2><?= $r['name_test']?></h2>
        <table class>
        <tr><th>Номер</th>
        <th>Вопрос</th></tr>
            <?php
            
                while ($result = mysqli_fetch_assoc($res)) {?>
                <!--Вывод информации с ранее полученного массива по ключам-->
                
                

                <tr><td><?= $result['num_question']?></td>
                <td><input class="input_1" type="text" style='width:100%' name="<?= $result['num_question']?>" id="<?= $result['num_question']?>" value="<?= $result['question']?>"></td></tr>

                    
                <?php } ?>
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