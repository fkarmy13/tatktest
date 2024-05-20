<?php 
//Подключение к файлу с БД
require_once('../db.php');
session_start();
if (!$_SESSION['user']) {
  header('Location: ../authorize.php');
}
//Запросы в БД для вывода тестов
$res = mysqli_query($conn, "SELECT * FROM `test`");
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
  <div class="card">
    <h2>СПИСОК ТЕСТОВ</h2>
    <?php while ($result = mysqli_fetch_assoc($res)) {?>
    <div class="cards">
      <!--Вывод наименования и описания теста из запроса по ключу-->
      
        <div class="card_1">
          <h2><?=$result['name_test']?></h2>
          <p><?=$result['description']?></p>
          <div class="link">
            <a class="link" href='testy/test_<?= $result['id_test']?>.php?id_test=<?= $result['id_test']?>'>ОТКРЫТЬ</a>
          </div>
          
        </div> 
        </div>
        <?php } ?>
        
    
    
  </div>
</body>
</html>