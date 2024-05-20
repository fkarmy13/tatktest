<?php 
//Подключение к файлу с БД

require_once('process/db.php');
//Запуск сессии для получения сообщений
session_start();
//Запрос в БД для вывода теста
$result1 = mysqli_query($conn, "SELECT * FROM `test` WHERE id_test = '3'");
$test = mysqli_fetch_assoc($result1);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="/resourse/css/test.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Тест</title>
</head>
<body>
    <div class="card">
        <!--Вывод ошибок/сообщений-->
        <div class="errors">
            <?php 
                if ($_SESSION['message']) {
                    echo '<p>'.$_SESSION['message'].'</p>';
                }
                unset($_SESSION['message']);
            ?>
        </div>
        <!--Форма ответов и передачи данных в файл result-->
        <form action="process/log_3.php" method="POST">
            <div class="cards">
                <?php
                    $n = 0;
                    For ($i=1; $i<45; $i++) {
                        $r = $_POST[$i];
                        $res = mysqli_query($conn, "SELECT * FROM `question` WHERE id_test = '3' AND num_question = '$i'");
                        $q = mysqli_fetch_assoc($res);?>
                        <div class="question">
                            <p><?=$q['num_question'].'. '.$q['question']?></p>
                        </div>
                        <div class="radiobtn">
                            <input type="radio" class="option-input radio" name="<?=$q['id_question']?>" value="-3" >не согласен полностью </input>
                            <input type="radio" class="option-input radio" name="<?=$q['id_question']?>" value="-2" >не согласен частично </input>
                            <input type="radio" class="option-input radio" name="<?=$q['id_question']?>" value="-1" >скорее не согласен, чем согласен </input>
                            <input type="radio" class="option-input radio" name="<?=$q['id_question']?>" value="+1" >скорее согласен, чем не согласен </input>
                            <input type="radio" class="option-input radio" name="<?=$q['id_question']?>" value="+2" >согласен частично </input>
                            <input type="radio" class="option-input radio" name="<?=$q['id_question']?>" value="+3" >согласен полностью </input>
                        </div>
                        <?php
                    }
                ?>
            </div>
            <div class="btn">
                <button class="button" role="button" type="submit">ОТПРАВИТЬ</button>
            </div>
        </form>
    </div>
</body>
</html>