<?php 
//Подключение к файлу с БД
require_once('../db.php');
//Запросы в БД для вывода тестов
$result1 = mysqli_query($conn, "SELECT * FROM `test`");
$t1 = mysqli_fetch_assoc($result1);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="\resourse\css\cards.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Тесты</title>
</head>
<body>
<? include("menu.php"); ?>
<form action="test.php" method="POST">
    <div class="card">
        <h2>СПИСОК ТЕСТОВ</h2>
        <div class="cards">
        <!--Вывод наименования и описания теста из запроса по ключу-->
        <h2><?=$t1['name_test']?></h2>
        <p><?=$t1['description']?></p>
        <div class="link">
            <a class="link" href="test_1.php">ОТКРЫТЬ</a>
            </div>
        </div>
    </div>
</form>
    
</body>
</html>