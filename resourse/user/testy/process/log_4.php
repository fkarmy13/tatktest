<?php 
//Запуск сессии для передачи сообщений
session_start();
//Подключение к файлу с БД
require_once('db.php');
//Переменная с id авторизованного пользователя
$id_user = $_SESSION['user']['id_user'];
//Запрос для проверки прохождения теста пользователем
$check_user = mysqli_query($conn, "SELECT * From `result` WHERE id_test = '4' AND id_user = '$id_user'");
$res =mysqli_num_rows($check_user);
$date_today = date('Y-m-d');
$year = date('Y');
//Проверка введенных ответов
$res_count = count($_POST);
//Проверка ответов на все вопросы
if ($res_count < 20){
    //Вывод ошибки, если не ответили на все вопросы
    $_SESSION['message'] = 'Вы ответили не на все вопросы';
    //Редирект
    header('Location: /resourse/user/testy/test_4.php');
} else {
    //Переменная номера вопроса в массивах да/нет
    $n = 0;
    //Переменная подсчета а
    $a = 0;
    //Переменная подсчета б
    $b = 0;
    //Проверка на прохождение теста
    if ($res == 0) {
        $fiz1 = array(94, 118, 126, 141, 148, 155, 161);
        $fiz2 = array(102, 110, 134);
        $kos1 = array(95, 111, 127, 135, 149, 156);
        $kos2 = array(103, 119, 142);
        $raz1 = array(96, 112, 120, 136, 143, 150, 157, 165);
        $raz2 = array(104, 128, 162);
        $negat = array(97, 105, 113, 116, 129);
        $obid1 = array(98, 106, 114, 122, 130, 144, 151);
        $obid2 = array(137); 
        $podoz1 = array(99, 107, 115, 123, 131, 138, 145, 152);
        $podoz2 = array(158, 163);
        $verb1 = array(100, 108, 121, 124, 139, 146, 153, 164, 166);
        $verb2 = array(132, 159, 167, 168);
        $chuv = array(101, 109, 117, 125, 133, 140, 147, 154, 160);
        $n_fiz = 0;
        $n_kos = 0;
        $n_raz = 0;
        $n_negat = 0;
        $n_obid = 0;
        $n_podoz = 0;
        $n_verb = 0;
        $n_chuv = 0;
        //Цикл прохождения по каждому ответу
        For ($i=94; $i<169; $i++) {
            $r = $_POST[$i];
            //Внесение ответа в БД
            $sql = "INSERT INTO `answer` (id_question, id_test, id_user, answer) VALUES ('$i', '4', '$id_user', '$r')";
            $conn -> query($sql);
            
            
            //Условия записи ответов для результата 
            //Цикл прохождения по массивам
            if ($r == 'Да') {
                //Цикл прохождения по массивам
                for ($n1 = 0; $n1 < count($fiz1); $n1++) {
                    if ($i==$fiz1[$n1])
                        $n_fiz++;
                    }
                for ($n1 = 0; $n1 < count($kos1); $n1++) {
                    if ($i==$kos1[$n1])
                        $n_kos++;
                    }
                for ($n1 = 0; $n1 < count($raz1); $n1++) {
                    if ($i==$raz1[$n1])
                        $n_raz++;
                    }
                for ($n1 = 0; $n1 < count($negat); $n1++) {
                    if ($i==$negat[$n1])
                        $n_negat++;
                    }
                for ($n1 = 0; $n1 < count($obid1); $n1++) {
                    if ($i==$obid1[$n1])
                        $n_obid++;
                    }
                for ($n1 = 0; $n1 < count($podoz1); $n1++) {
                    if ($i==$podoz1[$n1])
                        $n_podoz++;
                    }
                for ($n1 = 0; $n1 < count($verb1); $n1++) {
                    if ($i==$verb1[$n1])
                        $n_verb++;
                    }
                for ($n1 = 0; $n1 < count($chuv); $n1++) {
                    if ($i==$chuv[$n1])
                        $n_chuv++;
                    }
            } else {
                //Цикл прохождения по массивам
                for ($n1 = 0; $n1 < count($fiz2); $n1++) {
                    if ($i==$fiz2[$n1])
                        $n_fiz++;
                    }
                for ($n1 = 0; $n1 < count($kos2); $n1++) {
                    if ($i==$kos2[$n1])
                        $n_kos++;
                    }
                for ($n1 = 0; $n1 < count($raz2); $n1++) {
                    if ($i==$raz2[$n1])
                        $n_raz++;
                    }
                for ($n1 = 0; $n1 < count($obid2); $n1++) {
                    if ($i==$obid2[$n1])
                        $n_obid++;
                    }
                for ($n1 = 0; $n1 < count($podoz2); $n1++) {
                    if ($i==$podoz2[$n1])
                        $n_podoz++;
                    }
                for ($n1 = 0; $n1 < count($verb2); $n1++) {
                    if ($i==$verb2[$n1])
                        $n_verb++;
                    }
            }
            
            
            


        } 
        $vraj = $n_obid + $n_podoz;
        $agres =  $n_fiz + $n_raz + $n_verb;

        //Условия по выводу результата
        if ($vraj >= 17 AND $vraj <= 25) {
            $res_vraj = "норма";}
        else {
            $res_vraj = "отклонение от нормы";}
        if ($agres >= 3 AND $agres <= 10) {
            $res_agres = "норма";}
        else {
            $res_agres = "отклонение от нормы";}
            $result = 'Враждебность ('.$vraj.') '.$res_vraj.'. Агрессивность ('.$agres.') '.$res_agres;
            //Внесение результата в БД
            $sql = "INSERT INTO `result` (id_test, id_user, result, data_mdy, years) VALUES ('4', '$id_user', '$result', '$date_today', '$year')";
            $conn -> query($sql);
    } else {
        //Если пользователь проходил тест, то тоже самое, но обновление данных в БД
        $fiz1 = array(94, 118, 126, 141, 148, 155, 161);
        $fiz2 = array(102, 110, 134);
        $kos1 = array(95, 111, 127, 135, 149, 156);
        $kos2 = array(103, 119, 142);
        $raz1 = array(96, 112, 120, 136, 143, 150, 157, 165);
        $raz2 = array(104, 128, 162);
        $negat = array(97, 105, 113, 116, 129);
        $obid1 = array(98, 106, 114, 122, 130, 144, 151);
        $obid2 = array(137); 
        $podoz1 = array(99, 107, 115, 123, 131, 138, 145, 152);
        $podoz2 = array(158, 163);
        $verb1 = array(100, 108, 121, 124, 139, 146, 153, 164, 166);
        $verb2 = array(132, 159, 167, 168);
        $chuv = array(101, 109, 117, 125, 133, 140, 147, 154, 160);
        $n_fiz = 0;
        $n_kos = 0;
        $n_raz = 0;
        $n_negat = 0;
        $n_obid = 0;
        $n_podoz = 0;
        $n_verb = 0;
        $n_chuv = 0;
        For ($i=94; $i<169; $i++) {
            $r = $_POST[$i];
            $sql = "UPDATE `answer` SET answer = '$r' WHERE id_user = '$id_user'AND id_test = '4' AND id_question = '$i'";
            $conn -> query($sql);
            
            
            //Условия записи ответов для результата 
            //Цикл прохождения по массивам
            if ($r == 'Да') {
                //Цикл прохождения по массивам
                for ($n1 = 0; $n1 < count($fiz1); $n1++) {
                    if ($i==$fiz1[$n1])
                        $n_fiz++;
                    }
                for ($n1 = 0; $n1 < count($kos1); $n1++) {
                    if ($i==$kos1[$n1])
                        $n_kos++;
                    }
                for ($n1 = 0; $n1 < count($raz1); $n1++) {
                    if ($i==$raz1[$n1])
                        $n_raz++;
                    }
                for ($n1 = 0; $n1 < count($negat); $n1++) {
                    if ($i==$negat[$n1])
                        $n_negat++;
                    }
                for ($n1 = 0; $n1 < count($obid1); $n1++) {
                    if ($i==$obid1[$n1])
                        $n_obid++;
                    }
                for ($n1 = 0; $n1 < count($podoz1); $n1++) {
                    if ($i==$podoz1[$n1])
                        $n_podoz++;
                    }
                for ($n1 = 0; $n1 < count($verb1); $n1++) {
                    if ($i==$verb1[$n1])
                        $n_verb++;
                    }
                for ($n1 = 0; $n1 < count($chuv); $n1++) {
                    if ($i==$chuv[$n1])
                        $n_chuv++;
                    }
            } else {
                //Цикл прохождения по массивам
                for ($n1 = 0; $n1 < count($fiz2); $n1++) {
                    if ($i==$fiz2[$n1])
                        $n_fiz++;
                    }
                for ($n1 = 0; $n1 < count($kos2); $n1++) {
                    if ($i==$kos2[$n1])
                        $n_kos++;
                    }
                for ($n1 = 0; $n1 < count($raz2); $n1++) {
                    if ($i==$raz2[$n1])
                        $n_raz++;
                    }
                for ($n1 = 0; $n1 < count($obid2); $n1++) {
                    if ($i==$obid2[$n1])
                        $n_obid++;
                    }
                for ($n1 = 0; $n1 < count($podoz2); $n1++) {
                    if ($i==$podoz2[$n1])
                        $n_podoz++;
                    }
                for ($n1 = 0; $n1 < count($verb2); $n1++) {
                    if ($i==$verb2[$n1])
                        $n_verb++;
                    }
            }
            
            
            


        } 
        $vraj = $n_obid + $n_podoz;
        $agres =  $n_fiz + $n_raz + $n_verb;

        //Условия по выводу результата
        if ($vraj >= 17 AND $vraj <= 25) {
            $res_vraj = "норма";}
        else {
            $res_vraj = "отклонение от нормы";}
        if ($agres >= 3 AND $agres <= 10) {
            $res_agres = "норма";}
        else {
            $res_agres = "отклонение от нормы";}
            $result = 'Враждебность ('.$vraj.') '.$res_vraj.'. Агрессивность ('.$agres.') '.$res_agres;
            $sql = "UPDATE `result` SET  result = '$result', data_mdy = '$date_today', years = '$year' WHERE id_test = '4' AND id_user = '$id_user'";
            $conn -> query($sql);
    }
    $re = mysqli_query($conn, "SELECT * FROM `result` WHERE id_test = '4' AND id_user='$id_user'");
    $q = mysqli_fetch_assoc($re); 
    //Редирект
    header('Location: /resourse/user/testy/process/result_4.php');
}
?>
