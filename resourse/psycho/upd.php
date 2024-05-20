<?php 
//Подключение к файлу с БД
require_once('../db.php');
//Запуск сессии для приема данных пользователя с файла signin
session_start();
if (!$_SESSION['user']) {
  header('Location: ../authorize.php');
}

$id = $_SESSION['id_test'];

$res_count = count($_POST);
$q = $res_count + 1;



For ($i=1; $i<$q; $i++){
    $r = $_POST[$i];
    $sql = "UPDATE `question` SET question = '$r' WHERE id_test = '$id' AND num_question = '$i'";
    $conn -> query($sql);
}
$res = mysqli_query($conn, "SELECT DISTINCT t.id_test, t.name_test, q.id_test, q.num_question, q.question, q.id_question FROM `question` q, `test` t WHERE t.id_test=q.id_test AND t.id_test = $id");
$re = mysqli_query($conn, "SELECT * FROM `test` WHERE id_test = $id");
$a = mysqli_fetch_assoc($re);
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
    <a  href="update_test.php?id_test=<?= $id?>">Назад</a>
  </div>
  
    <div class="card_1">
    <h2><?= $a['name_test']?></h2>
        <table class>
        <tr><th>Номер</th>
        <th>Вопрос</th></tr>
            <?php
            
                while ($result = mysqli_fetch_assoc($res)) {?>
                <!--Вывод информации с ранее полученного массива по ключам-->
                
                

                <tr><td><?= $result['num_question']?></td>
                <td><?= $result['question']?></td></tr>

                    
                <?php } ?>
        </table>
        
</div>

</body>
</html>