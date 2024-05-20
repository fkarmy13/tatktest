<?php 
//Запуск сессии для передачи сообщений
session_start();
//Подключение к файлу с БД
require_once('db.php');
//Переменная с id авторизованного пользователя
$id_user = $_SESSION['user']['id_user'];
//Запрос для проверки прохождения теста пользователем
$check_user = mysqli_query($conn, "SELECT * From `result` WHERE id_test = '5' AND id_user = '$id_user'");
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
    header('Location: /resourse/user/testy/test_5.php');
} else {
    //Проверка на прохождение теста
    if ($res == 0) {
        $vsp1 = array(169, 177, 185, 233);
        $vsp2 = array(193, 201, 209, 217, 225, 241);
        $napor1 = array(170, 178, 186, 210, 218, 226, 234, 242);
        $napor2 = array(194, 202);
        $obid1 = array(171, 179, 187, 195, 203, 227);
        $obid2 = array(211, 219, 235, 243);
        $neust1 = array(172, 180, 188, 196, 204, 228, 244);
        $neust2 = array(212, 220, 236);
        $besk1 = array(173, 181, 189, 197, 205, 213, 221); 
        $besk2 = array(229, 237, 245);
        $mstit1 = array(174, 190, 206, 230, 238);
        $mstit2 = array(182, 198, 214, 222, 246);
        $neterp1 = array(175, 191, 207, 223, 231);
        $neterp2 = array(183, 199, 215, 239, 247);
        $podoz1 = array(176, 192, 200, 216, 224, 232, 240);
        $podoz2 = array(184, 208, 248);
        $n_vsp = 0;
        $n_napor = 0;
        $n_obid = 0;
        $n_neust = 0;
        $n_besk = 0;
        $n_mstit = 0;
        $n_neterp = 0;
        $n_podoz = 0;
        //Цикл прохождения по каждому ответу
        For ($i=169; $i<249; $i++){
            $r = $_POST[$i];
            //Внесение ответа в БД
            $sql = "INSERT INTO `answer` (id_question, id_test, id_user, answer) VALUES ('$i', '5', '$id_user', '$r')";
            $conn -> query($sql);
            
            
            //Условия записи ответов для результата 
            //Цикл прохождения по массивам
            if ($r == 'Да') {
                //Цикл прохождения по массивам
                for ($n1 = 0; $n1 < count($vsp1); $n1++) {
                    if ($i==$vsp1[$n1])
                        $n_vsp++;
                    }
                for ($n1 = 0; $n1 < count($napor1); $n1++) {
                    if ($i==$napor1[$n1])
                        $n_napor++;
                    }
                for ($n1 = 0; $n1 < count($obid1); $n1++) {
                    if ($i==$obid1[$n1])
                        $n_obid++;
                    }
                for ($n1 = 0; $n1 < count($neust1); $n1++) {
                    if ($i==$neust1[$n1])
                        $n_neust++;
                    }
                for ($n1 = 0; $n1 < count($besk1); $n1++) {
                    if ($i==$besk1[$n1])
                        $n_besk++;
                    }
                for ($n1 = 0; $n1 < count($mstit1); $n1++) {
                    if ($i==$mstit1[$n1])
                        $n_mstit++;
                    }
                for ($n1 = 0; $n1 < count($neterp1); $n1++) {
                    if ($i==$neterp1[$n1])
                        $n_neterp++;
                    }
                for ($n1 = 0; $n1 < count($podoz1); $n1++) {
                    if ($i==$podoz1[$n1])
                        $n_podoz++;
                    }
            } else {
                //Цикл прохождения по массивам
                for ($n1 = 0; $n1 < count($vsp2); $n1++) {
                    if ($i==$vsp2[$n1])
                        $n_vsp++;
                    }
                for ($n1 = 0; $n1 < count($napor2); $n1++) {
                    if ($i==$napor2[$n1])
                        $n_napor++;
                    }
                for ($n1 = 0; $n1 < count($obid2); $n1++) {
                    if ($i==$obid2[$n1])
                        $n_obid++;
                    }
                for ($n1 = 0; $n1 < count($neust2); $n1++) {
                    if ($i==$neust2[$n1])
                        $n_neust++;
                    }
                for ($n1 = 0; $n1 < count($besk2); $n1++) {
                    if ($i==$besk2[$n1])
                        $n_besk++;
                    }
                for ($n1 = 0; $n1 < count($mstit2); $n1++) {
                    if ($i==$mstit2[$n1])
                        $n_mstit++;
                    }
                for ($n1 = 0; $n1 < count($neterp2); $n1++) {
                    if ($i==$neterp2[$n1])
                        $n_neterp++;
                    }
                for ($n1 = 0; $n1 < count($podoz2); $n1++) {
                    if ($i==$podoz2[$n1])
                        $n_podoz++;
                    }
            }
            
            
            


        } 
        $positiv = $n_napor + $n_neust;
        $negativ =  $n_neterp + $n_mstit;
        $obsh =  $n_besk + $n_vsp + $n_obid;

        //Условия по выводу результата
        //if ($vraj >= 17 AND $vraj <= 25) {
            //$res_vraj = "норма";}
        //else {
            //$res_vraj = "отклонение от нормы";}
        //if ($agres >= 3 AND $agres <= 10) {
            //$res_agres = "норма";}
        //else {
            //$res_agres = "отклонение от нормы";}
        //Условия по выводу результата
        if ($positiv == 0) {
            $positiv_result = 'не выражена';
        } elseif ($positiv <= 6.6) {
            $positiv_result = 'выражена слабо';
        } elseif ($positiv > 6.6 and $positiv <= 13.33){
            $positiv_result = 'выражена средне';
        } elseif ($positiv > 13.33 and $positiv <= 20) {
            $positiv_result = 'сильно выражена';
        }
            $result_positiv = 'Позитивная агрессивность '.$positiv_result.' ('.$positiv.').'.' Поведение, которое помогает человеку добиться желаемой цели, но при этом наносит незначительный дискомфорт другим. К позитивной агрессивности относятся такие качества как: напористость, наступательность, неуступчивость. Эти качества помогают обладателю в достижении цели, но не во всех ситуациях они необходимы.';
        if ($negativ == 0) {
            $negativ_result = 'не выражена';
        } elseif ($negativ <= 6.6) {
            $negativ_result = 'выражена слабо';
        } elseif ($negativ > 6.6 and $negativ <= 13.33){
            $negativ_result = 'выражена средне';
        } elseif ($negativ > 13.33 and $negativ <= 20) {
            $negativ_result = 'сильно выражена';
        }
        $result_negativ = 'Негативная агрессинвость '.$negativ_result.' ('.$negativ.').'.' Поведение человека, которое вызывает психологический дискомфорт у других людей. К негативной агрессивности относятся такие качества, как: мстительность, нетерпимость к мнению других.';
        if ($obsh == 0) {
            $obsh_result = 'не выражен';
        } elseif ($obsh <= 9.99) {
            $obsh_result = 'выражен слабо';
        } elseif ($obsh > 9.99 and $obsh <= 19.99){
            $obsh_result = 'выражен средне';
        } elseif ($obsh > 19.99 and $obsh <= 30) {
            $obsh_result = 'сильно выражен';
        }
        $result_obsh = 'Обощенный показатель конфликтности '.$obsh_result.' ('.$obsh.').'.' Черта характера, способствующая частоте возникновения конфликта и вступления в них человека.';
        
            $result = $result_positiv.' '.$result_negativ.' '.$result_obsh.' ';
            //Внесение результата в БД
            $sql = "INSERT INTO `result` (id_test, id_user, result, data_mdy, years) VALUES ('5', '$id_user', '$result', '$date_today', '$year')";
            $conn -> query($sql);
    } else {
        //Если пользователь проходил тест, то тоже самое, но обновление данных в БД
        $vsp1 = array(169, 177, 185, 233);
        $vsp2 = array(193, 201, 209, 217, 225, 241);
        $napor1 = array(170, 178, 186, 210, 218, 226, 234, 242);
        $napor2 = array(194, 202);
        $obid1 = array(171, 179, 187, 195, 203, 227);
        $obid2 = array(211, 219, 235, 243);
        $neust1 = array(172, 180, 188, 196, 204, 228, 244);
        $neust2 = array(212, 220, 236);
        $besk1 = array(173, 181, 189, 197, 205, 213, 221); 
        $besk2 = array(229, 237, 245);
        $mstit1 = array(174, 190, 206, 230, 238);
        $mstit2 = array(182, 198, 214, 222, 246);
        $neterp1 = array(175, 191, 207, 223, 231);
        $neterp2 = array(183, 199, 215, 239, 247);
        $podoz1 = array(176, 192, 200, 216, 224, 232, 240);
        $podoz2 = array(184, 208, 248);
        $n_vsp = 0;
        $n_napor = 0;
        $n_obid = 0;
        $n_neust = 0;
        $n_besk = 0;
        $n_mstit = 0;
        $n_neterp = 0;
        $n_podoz = 0;
        //Цикл прохождения по каждому ответу
        For ($i=169; $i<249; $i++){
            $r = $_POST[$i];
            $sql = "UPDATE `answer` SET answer = '$r' WHERE id_user = '$id_user'AND id_test = '5' AND id_question = '$i'";
            $conn -> query($sql);
            
            
            //Условия записи ответов для результата 
            //Цикл прохождения по массивам
            if ($r == 'Да') {
                //Цикл прохождения по массивам
                for ($n1 = 0; $n1 < count($vsp1); $n1++) {
                    if ($i==$vsp1[$n1])
                        $n_vsp++;
                    }
                for ($n1 = 0; $n1 < count($napor1); $n1++) {
                    if ($i==$napor1[$n1])
                        $n_napor++;
                    }
                for ($n1 = 0; $n1 < count($obid1); $n1++) {
                    if ($i==$obid1[$n1])
                        $n_obid++;
                    }
                for ($n1 = 0; $n1 < count($neust1); $n1++) {
                    if ($i==$neust1[$n1])
                        $n_neust++;
                    }
                for ($n1 = 0; $n1 < count($besk1); $n1++) {
                    if ($i==$besk1[$n1])
                        $n_besk++;
                    }
                for ($n1 = 0; $n1 < count($mstit1); $n1++) {
                    if ($i==$mstit1[$n1])
                        $n_mstit++;
                    }
                for ($n1 = 0; $n1 < count($neterp1); $n1++) {
                    if ($i==$neterp1[$n1])
                        $n_neterp++;
                    }
                for ($n1 = 0; $n1 < count($podoz1); $n1++) {
                    if ($i==$podoz1[$n1])
                        $n_podoz++;
                    }
            } else {
                //Цикл прохождения по массивам
                for ($n1 = 0; $n1 < count($vsp2); $n1++) {
                    if ($i==$vsp2[$n1])
                        $n_vsp++;
                    }
                for ($n1 = 0; $n1 < count($napor2); $n1++) {
                    if ($i==$napor2[$n1])
                        $n_napor++;
                    }
                for ($n1 = 0; $n1 < count($obid2); $n1++) {
                    if ($i==$obid2[$n1])
                        $n_obid++;
                    }
                for ($n1 = 0; $n1 < count($neust2); $n1++) {
                    if ($i==$neust2[$n1])
                        $n_neust++;
                    }
                for ($n1 = 0; $n1 < count($besk2); $n1++) {
                    if ($i==$besk2[$n1])
                        $n_besk++;
                    }
                for ($n1 = 0; $n1 < count($mstit2); $n1++) {
                    if ($i==$mstit2[$n1])
                        $n_mstit++;
                    }
                for ($n1 = 0; $n1 < count($neterp2); $n1++) {
                    if ($i==$neterp2[$n1])
                        $n_neterp++;
                    }
                for ($n1 = 0; $n1 < count($podoz2); $n1++) {
                    if ($i==$podoz2[$n1])
                        $n_podoz++;
                    }
            }
            
            
            


        } 
        $positiv = $n_napor + $n_neust;
        $negativ =  $n_neterp + $n_mstit;
        $obsh =  $n_besk + $n_vsp + $n_obid;

        //Условия по выводу результата
        //if ($vraj >= 17 AND $vraj <= 25) {
            //$res_vraj = "норма";}
        //else {
            //$res_vraj = "отклонение от нормы";}
        //if ($agres >= 3 AND $agres <= 10) {
            //$res_agres = "норма";}
        //else {
            //$res_agres = "отклонение от нормы";}
        //Условия по выводу результата
        if ($positiv == 0) {
            $positiv_result = 'не выражена';
        } elseif ($positiv <= 6.6) {
            $positiv_result = 'выражена слабо';
        } elseif ($positiv > 6.6 and $positiv <= 13.33){
            $positiv_result = 'выражена средне';
        } elseif ($positiv > 13.33 and $positiv <= 20) {
            $positiv_result = 'сильно выражена';
        }
            $result_positiv = 'Позитивная агрессивность '.$positiv_result.' ('.$positiv.').'.' Поведение, которое помогает человеку добиться желаемой цели, но при этом наносит незначительный дискомфорт другим. К позитивной агрессивности относятся такие качества как: напористость, наступательность, неуступчивость. Эти качества помогают обладателю в достижении цели, но не во всех ситуациях они необходимы.';
        if ($negativ == 0) {
            $negativ_result = 'не выражена';
        } elseif ($negativ <= 6.6) {
            $negativ_result = 'выражена слабо';
        } elseif ($negativ > 6.6 and $negativ <= 13.33){
            $negativ_result = 'выражена средне';
        } elseif ($negativ > 13.33 and $negativ <= 20) {
            $negativ_result = 'сильно выражена';
        }
        $result_negativ = 'Негативная агрессинвость '.$negativ_result.' ('.$negativ.').'.' Поведение человека, которое вызывает психологический дискомфорт у других людей. К негативной агрессивности относятся такие качества, как: мстительность, нетерпимость к мнению других.';
        if ($obsh == 0) {
            $obsh_result = 'не выражен';
        } elseif ($obsh <= 9.99) {
            $obsh_result = 'выражен слабо';
        } elseif ($obsh > 9.99 and $obsh <= 19.99){
            $obsh_result = 'выражен средне';
        } elseif ($obsh > 19.99 and $obsh <= 30) {
            $obsh_result = 'сильно выражен';
        }
        $result_obsh = 'Обощенный показатель конфликтности '.$obsh_result.' ('.$obsh.').'.' Черта характера, способствующая частоте возникновения конфликта и вступления в них человека.';
        
            $result = $result_positiv.' '.$result_negativ.' '.$result_obsh.' ';
            $sql = "UPDATE `result` SET  result = '$result', data_mdy = '$date_today', years = '$year' WHERE id_test = '5' AND id_user = '$id_user'";
            $conn -> query($sql);
    }
    $re = mysqli_query($conn, "SELECT * FROM `result` WHERE id_test = '5' AND id_user='$id_user'");
    $q = mysqli_fetch_assoc($re); 
    //Редирект
    header('Location: /resourse/user/testy/process/result_5.php');
}
?>
