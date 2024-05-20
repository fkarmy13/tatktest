<?php 
//Запуск сессии для передачи сообщений
session_start();
//Подключение к файлу с БД
require_once('db.php');
//Переменная с id авторизованного пользователя
$id_user = $_SESSION['user']['id_user'];
//Запрос для проверки прохождения теста пользователем
$check_user = mysqli_query($conn, "SELECT * From `result` WHERE id_test = '3' AND id_user = '$id_user'");
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
    header('Location: /resourse/user/testy/test_1.php');
} else {
    
    //Проверка на прохождение теста
    if ($res == 0) {
        
        $Io_k = 0;
        $Id_k = 0;
        $In_k = 0;
        $Is_k = 0;
        $Ip_k = 0;
        $Im_k = 0;
        $Iz_k = 0;

        //Цикл прохождения по каждому ответу
        For ($i=50; $i<94; $i++) {
            $r = $_POST[$i];
            //Внесение ответа в БД
            $sql = "INSERT INTO `answer` (id_question, id_test, id_user, answer) VALUES ('$i', '3', '$id_user', '$r')";
            $conn -> query($sql);
            //Массивы по ключу расшифровки
            $Io_p = array(51, 53, 60, 61, 62, 64, 65, 66, 68, 69, 71, 74, 76, 78, 80, 81, 83, 85, 86, 88, 91, 93);
            $Io_m = array(50, 52, 54, 55, 56, 57, 58, 59, 63, 67, 70, 72, 73, 75, 77, 79, 82, 84, 87, 89, 90, 92);
            $Id_p = array(61, 64, 76, 81, 85, 86);
            $Id_m = array(50, 54, 55, 63, 75, 92);
            $In_p = array(51, 53, 69, 80, 91, 93);
            $In_m = array(56, 73, 82, 87, 89, 90);
            $Is_p = array(51, 65, 69, 81, 86);
            $Is_m = array(56, 63, 75, 77, 90);
            $Ip_p = array(68, 71, 74, 80, 91);
            $Ip_m = array(50, 58, 59, 73, 79);
            $Im_p = array(53, 76);
            $Im_m = array(55, 87);
            $Iz_p = array(62, 83);
            $Iz_m = array(52, 72);
            //Условия записи ответов для результата 
            for ($n1 = 0; $n1 < count($Io_p); $n1++) {
                if ($i==$Io_p[$n1]) {
                    if ($r == '3+') {
                        $Io_k = $Io_k + 3;
                    }
                    elseif ($r == '2+') {
                        $Io_k = $Io_k + 2;
                    }
                    elseif ($r == '1+') {
                        $Io_k = $Io_k + 1;
                    }
                    print_r($Io_k);
                }
                elseif ($i==$Io_m[$n1]) {
                    if ($r == '3-') {
                        $Io_k = $Io_k - 3;
                    }
                    elseif ($r == '2-') {
                        $Io_k = $Io_k - 2;
                    }
                    elseif ($r == '1-') {
                        $Io_k = $Io_k - 1;
                    }
                }   
                
                elseif ($i==$Id_p[$n1]) {
                    if ($r == '3+') {
                        $Id_k = $Id_k + 3;
                    }
                    elseif ($r == '2+') {
                        $Id_k = $Id_k + 2;
                    }
                    elseif ($r == '1+') {
                        $Id_k = $Id_k + 1;
                    }
                }
                elseif ($i==$Id_m[$n1]) {
                    if ($r == '3-') {
                        $Id_k = $Id_k - 3;
                    }
                    elseif ($r == '2-') {
                        $Id_k = $Id_k - 2;
                    }
                    elseif ($r == '1-') {
                        $Id_k = $Id_k - 1;
                    }
                } 

                elseif ($i==$In_p[$n1]) {
                    if ($r == '3+') {
                        $In_k = $In_k + 3;
                    }
                    elseif ($r == '2+') {
                        $In_k = $In_k + 2;
                    }
                    elseif ($r == '1+') {
                        $In_k = $In_k + 1;
                    }
                }
                elseif ($i==$In_m[$n1]) {
                    if ($r == '3-') {
                        $In_k = $In_k - 3;
                    }
                    elseif ($r == '2-') {
                        $In_k = $In_k - 2;
                    }
                    elseif ($r == '1-') {
                        $In_k = $In_k - 1;
                    }
                } 

                elseif ($i==$Is_p[$n1]) {
                    if ($r == '3+') {
                        $Is_k = $Is_k + 3;
                    }
                    elseif ($r == '2+') {
                        $Is_k = $Is_k + 2;
                    }
                    elseif ($r == '1+') {
                        $Is_k = $Is_k + 1;
                    }
                }
                elseif ($i==$Is_m[$n1]) {
                    if ($r == '3-') {
                        $Is_k = $Is_k - 3;
                    }
                    elseif ($r == '2-') {
                        $Is_k = $Is_k - 2;
                    }
                    elseif ($r == '1-') {
                        $Is_k = $Is_k - 1;
                    }
                } 

                elseif ($i==$Ip_p[$n1]) {
                    if ($r == '3+') {
                        $Ip_k = $Ip_k + 3;
                    }
                    elseif ($r == '2+') {
                        $Ip_k = $Ip_k + 2;
                    }
                    elseif ($r == '1+') {
                        $Ip_k = $Ip_k + 1;
                    }
                }
                elseif ($i==$Ip_m[$n1]) {
                    if ($r == '3-') {
                        $Ip_k = $Ip_k - 3;
                    }
                    elseif ($r == '2-') {
                        $Ip_k = $Ip_k - 2;
                    }
                    elseif ($r == '1-') {
                        $Ip_k = $Ip_k - 1;
                    }
                } 

                elseif ($i==$Im_p[$n1]) {
                    if ($r == '3+') {
                        $Im_k = $Im_k + 3;
                    }
                    elseif ($r == '2+') {
                        $Im_k = $Im_k + 2;
                    }
                    elseif ($r == '1+') {
                        $Im_k = $Im_k + 1;
                    }
                }
                elseif ($i==$Im_m[$n1]) {
                    if ($r == '3-') {
                        $Im_k = $Im_k - 3;
                    }
                    elseif ($r == '2-') {
                        $Im_k = $Im_k - 2;
                    }
                    elseif ($r == '1-') {
                        $Im_k = $Im_k - 1;
                    }
                } 

                elseif ($i==$Iz_p[$n1]) {
                    if ($r == '3+') {
                        $Iz_k = $Iz_k + 3;
                    }
                    elseif ($r == '2+') {
                        $Iz_k = $Iz_k + 2;
                    }
                    elseif ($r == '1+') {
                        $Iz_k = $Iz_k + 1;
                    }
                }
                elseif ($i==$Iz_m[$n1]) {
                    if ($r == '3-') {
                        $Iz_k = $Iz_k - 3;
                    }
                    elseif ($r == '2-') {
                        $Iz_k = $Iz_k - 2;
                    }
                    elseif ($r == '1-') {
                        $Iz_k = $Iz_k - 1;
                    }
                } 
            }
        } 

        //Условия по выводу результата
        if (-132 <= $Io_k AND $Io_k <= -14) {
            $Io = 1;
        }
        elseif (-13 <= $Io_k AND $Io_k <= -3) {
            $Io = 2;
        }
        elseif (-2 <= $Io_k AND $Io_k <= 9) {
            $Io = 3;
        }
        elseif (10 <= $Io_k AND $Io_k <= 21) {
            $Io = 4;
        }
        elseif (22 <= $Io_k AND $Io_k <= 32) {
            $Io = 5;
        }
        elseif (33 <= $Io_k AND $Io_k <= 44) {
            $Io = 6;
        }
        elseif (45 <= $Io_k AND $Io_k <= 56) {
            $Io = 7;
        }
        elseif (57 <= $Io_k AND $Io_k <= 68) {
            $Io = 8;
        }
        elseif (69 <= $Io_k AND $Io_k <= 79) {
            $Io = 9;
        }
        elseif (80 <= $Io_k AND $Io_k <= 132) {
            $Io = 10;
        }

        //Условия по выводу результата
        if (-36 <= $Id_k AND $Id_k <= -11) {
            $Id = 1;
        }
        elseif (-10 <= $Id_k AND $Id_k <= -7) {
            $Id = 2;
        }
        elseif (-6 <= $Id_k AND $Id_k <= 3) {
            $Id = 3;
        }
        elseif (-2 <= $Id_k AND $Id_k <= 1) {
            $Id = 4;
        }
        elseif (2 <= $Id_k AND $Id_k <= 5) {
            $Id = 5;
        }
        elseif (6 <= $Id_k AND $Id_k <= 9) {
            $Id = 6;
        }
        elseif (10 <= $Id_k AND $Id_k <= 14) {
            $Id = 7;
        }
        elseif (15 <= $Id_k AND $Id_k <= 18) {
            $Id = 8;
        }
        elseif (19 <= $Id_k AND $Id_k <= 22) {
            $Id = 9;
        }
        elseif (23 <= $Id_k AND $Id_k <= 36) {
            $Id = 10;
        }

        //Условия по выводу результата
        if (-36 <= $In_k AND $In_k <= -8) {
            $In = 1;
        }
        elseif (-7 <= $In_k AND $In_k <= -4) {
            $In = 2;
        }
        elseif (-3 <= $In_k AND $In_k <= 0) {
            $In = 3;
        }
        elseif (1 <= $In_k AND $In_k <= 4) {
            $In = 4;
        }
        elseif (5 <= $In_k AND $In_k <= 7) {
            $In = 5;
        }
        elseif (8 <= $In_k AND $In_k <= 11) {
            $In = 6;
        }
        elseif (12 <= $In_k AND $In_k <= 15) {
            $In = 7;
        }
        elseif (16 <= $In_k AND $In_k <= 19) {
            $In = 8;
        }
        elseif (20 <= $In_k AND $In_k <= 23) {
            $In = 9;
        }
        elseif (24 <= $In_k AND $In_k <= 36) {
            $In = 10;
        }

        //Условия по выводу результата
        if (-30 <= $Is_k AND $Is_k <= -12) {
            $Is = 1;
        }
        elseif (-11 <= $Is_k AND $Is_k <= -8) {
            $Is = 2;
        }
        elseif (-7 <= $Is_k AND $Is_k <= -5) {
            $Is = 3;
        }
        elseif (-4 <= $Is_k AND $Is_k <= -1) {
            $Is = 4;
        }
        elseif (0 <= $Is_k AND $Is_k <= 3) {
            $Is = 5;
        }
        elseif (4 <= $Is_k AND $Is_k <= 6) {
            $Is = 6;
        }
        elseif (7 <= $Is_k AND $Is_k <= 10) {
            $Is = 7;
        }
        elseif (11 <= $Is_k AND $Is_k <= 13) {
            $Is = 8;
        }
        elseif (14 <= $Is_k AND $Is_k <= 17) {
            $Is = 9;
        }
        elseif (18 <= $Is_k AND $Is_k <= 30) {
            $Is = 10;
        }

        //Условия по выводу результата
        if (-30 <= $Ip_k AND $Ip_k <= -5) {
            $Ip = 1;
        }
        elseif (-4 <= $Ip_k AND $Ip_k <= -1) {
            $Ip = 2;
        }
        elseif (0 <= $Ip_k AND $Ip_k <= 3) {
            $Ip = 3;
        }
        elseif (4 <= $Ip_k AND $Ip_k <= 7) {
            $Ip = 4;
        }
        elseif (8 <= $Ip_k AND $Ip_k <= 11) {
            $Ip = 5;
        }
        elseif (12 <= $Ip_k AND $Ip_k <= 15) {
            $Ip = 6;
        }
        elseif (16 <= $Ip_k AND $Ip_k <= 19) {
            $Ip = 7;
        }
        elseif (20 <= $Ip_k AND $Ip_k <= 23) {
            $Ip = 8;
        }
        elseif (24 <= $Ip_k AND $Ip_k <= 27) {
            $Ip = 9;
        }
        elseif (28 <= $Ip_k AND $Ip_k <= 30) {
            $Ip = 10;
        }

        //Условия по выводу результата
        if (-12 <= $Im_k AND $Im_k <= -7) {
            $Im = 1;
        }
        elseif (-6 <= $Im_k AND $Im_k <= -5) {
            $Im = 2;
        }
        elseif (-4 <= $Im_k AND $Im_k <= -3) {
            $Im = 3;
        }
        elseif (-2 <= $Im_k AND $Im_k <= -1) {
            $Im = 4;
        }
        elseif (0 <= $Im_k AND $Im_k <= 1) {
            $Im = 5;
        }
        elseif (2 <= $Im_k AND $Im_k <= 4) {
            $Im = 6;
        }
        elseif (5 <= $Im_k AND $Im_k <= 6) {
            $Im = 7;
        }
        elseif (7 <= $Im_k AND $Im_k <= 8) {
            $Im = 8;
        }
        elseif (9 <= $Im_k AND $Im_k <= 10) {
            $Im = 9;
        }
        elseif (11 <= $Im_k AND $Im_k <= 12) {
            $Im = 10;
        }

        //Условия по выводу результата
        if (-12 <= $Iz_k AND $Iz_k <= -6) {
            $Iz = 1;
        }
        elseif (-5 <= $Iz_k AND $Iz_k <= -4) {
            $Iz = 2;
        }
        elseif (-3 <= $Iz_k AND $Iz_k <= -2) {
            $Iz = 3;
        }
        elseif (-1 <= $Iz_k AND $Iz_k <= 0) {
            $Iz = 4;
        }
        elseif (1 <= $Iz_k AND $Iz_k <= 2) {
            $Iz = 5;
        }
        elseif (3 <= $Iz_k AND $Iz_k <= 4) {
            $Iz = 6;
        }
        elseif (5 <= $Iz_k AND $Iz_k <= 6) {
            $Iz = 7;
        }
        elseif (7 <= $Iz_k AND $Iz_k <=8) {
            $Iz = 8;
        }
        elseif (9 <= $Iz_k AND $Iz_k <= 10) {
            $Iz = 9;
        }
        elseif (11 <= $Iz_k AND $Iz_k <= 12) {
            $Iz = 10;
        }
        if ($Io >= 5.5) {
            $Io_result = 'Высокий показатель по этой шкале соответствует высокому уровню субъективного контроля над любыми значимыми ситуациями: интернальный контроль, интернальная личность. Такие люди считают, что большинство важных событий в их жизни есть результат их собственных действий, что они могут ими управлять, и, таким образом, они чувствуют свою собственную ответственность за эти события и за то, как складывается их жизнь в целом. Обобщение различных экспериментальных данных позволяет говорить об интерналах как о более уверенных в себе, более спокойных и благожелательных, более популярных в сравнении с экстерналами. Их отличает более позитивная система отношений к миру и большая осознанность смысла и целей жизни.';
        } else {
            $Io_result = 'Низкий показатель по этой шкале соответствует низкому уровню субъективного контроля: экстернальный контроль, экстернальная личность. Такие люди не видят связи между своими действиями и значимыми для них событиями их жизни, не считают себя способными контролировать их развитие. Они полагают, что большинство событий их жизни является результатом случая или действия других людей. Обобщение различных экспериментальных данных позволяет говорить об экстерналах как о людях с повышенной тревожностью, обеспокоенностью. Их отличает конформность, меньшая терпимость к другим и повышенная агрессивность, меньшая популярность в сравнении с интерналами.';
        }
        if ($Id >= 5.5){
            $Id_result = 'Высокие показатели по этой шкале соответствуют высокому уровню субъективного контроля над эмоционально положительными событиями и ситуациями. Такие люди считают, что они сами добились всего того хорошего, что было и есть в их жизни, и что они способны с успехом преследовать свои цели в будущем.';
        } else {
            $Id_result = 'Низкие показатели по шкале свидетельствуют о том, что человек приписывает свои успехи, достижения и радости внешним обстоятельствам – везению, счастливой судьбе или помощи других людей.';
        }
        if ($In >= 5.5){
            $In_result = 'Высокие показатели по этой шкале говорят о развитом чувстве субъективного контроля по отношению к отрицательным событиям и ситуациям, что проявляется в склонности обвинять самого себя в разнообразных неприятностях и страданиях.';
        } else {
            $In_result = 'Низкие показатели свидетельствуют о том, что человек склонен приписывать ответственность за подобные события другим людям или считать их результатом невезения.';
        }
        if ($Is >= 5.5){
            $Is_result = 'Высокие показатели означают, что человек считает себя ответственным за события, происходящие в его семейной жизни.';
        } else {
            $Is_result = 'Низкие указывают на то, что субъект считает не себя, а своих партнеров причиной значимых ситуаций, возникающих в его семье.';
        }
        if ($Ip >= 5.5){
            $Ip_result = 'Высокие показатели свидетельствует и том, что человек считает свои действия важным фактором организации собственной производственной деятельности, складывающихся отношении в коллективе, своего продвижения и т.д.';
        } else {
            $Ip_result = 'Низкие указывают на то, что человек склонен приписывать более важное значение внешним обстоятельствам — руководству, товарищам по работе, везению-невезению.';
        }
        if ($Im >= 5.5){
            $Im_result = 'Высокие показатели свидетельствуют о том, что человек считает именно себя ответственным за построение межличностных отношений с окружающими.';
        } else {
            $Im_result = 'Низкие показатели указывают на то, что человек склонен приписывать более важное значение в этом процессе обстоятельствам, случаю или окружающим его людям.';
        }
        if ($Iz >= 5.5 ){
            $Iz_result = 'Высокие показатели свидетельствуют о том, что человек считает себя во многом ответственным за свое здоровье: если он болен, то обвиняет в этом себя и полагает, что выздоровление во многом зависит от его действий.';
        } else {
            $Iz_result = 'Человек с низкими показателями по этой шкале считает болезнь и здоровье результатом случая и надеется на то, что выздоровление придет в результате действий других людей, прежде всего врачей.';
        }




            $r_Io = 'Общая интернальность: '.$Io.' - ';
            $r_Id = 'В области достижений: '.$Id.' - ';
            $r_In = 'В области неудач: '.$In.' - ';
            $r_Is = 'В семейных отношениях: '.$Is.' - ';
            $r_Ip = 'В производственных отношениях: '.$Ip.' - ';
            $r_Im = 'В межличностных отношениях: '.$Im.' - ';
            $r_Iz = 'В отношениях здоровья: '.$Iz.' - ';
            $result = $r_Io.' '.$Io_result.' '.
            $r_Id.' '.$Id_result.' '.
            $r_In.' '.$In_result.' '.
            $r_Is.' '.$Is_result.' '.
            $r_Ip.' '.$Ip_result.' '.
            $r_Im.' '.$Im_result.' '.
            $r_Iz.' '.$Iz_result.' ';
            //Внесение результата в БД
            $sql = "INSERT INTO `result` (id_test, id_user, result, data_mdy, years) VALUES ('3', '$id_user', '$result', '$date_today', '$year')";
            $conn -> query($sql);
    } else {
        $Io_k = 0;
        $Id_k = 0;
        $In_k = 0;
        $Is_k = 0;
        $Ip_k = 0;
        $Im_k = 0;
        $Iz_k = 0;

        //Цикл прохождения по каждому ответу
        For ($i=50; $i<94; $i++) {
            $r = $_POST[$i];
            //Внесение ответа в БД
            $sql = "UPDATE `answer` SET answer = '$r' WHERE id_user = '$id_user'AND id_test = '3' AND id_question = '$i'";
            $conn -> query($sql);
            //Массивы по ключу расшифровки
            $Io_p = array(51, 53, 60, 61, 62, 64, 65, 66, 68, 69, 71, 74, 76, 78, 80, 81, 83, 85, 86, 88, 91, 93);
            $Io_m = array(50, 52, 54, 55, 56, 57, 58, 59, 63, 67, 70, 72, 73, 75, 77, 79, 82, 84, 87, 89, 90, 92);
            $Id_p = array(61, 64, 76, 81, 85, 86);
            $Id_m = array(50, 54, 55, 63, 75, 92);
            $In_p = array(51, 53, 69, 80, 91, 93);
            $In_m = array(56, 73, 82, 87, 89, 90);
            $Is_p = array(51, 65, 69, 81, 86);
            $Is_m = array(56, 63, 75, 77, 90);
            $Ip_p = array(68, 71, 74, 80, 91);
            $Ip_m = array(50, 58, 59, 73, 79);
            $Im_p = array(53, 76);
            $Im_m = array(55, 87);
            $Iz_p = array(62, 83);
            $Iz_m = array(52, 72);
            //Условия записи ответов для результата 
            for ($n1 = 0; $n1 < count($Io_p); $n1++) {
                if ($i==$Io_p[$n1]) {
                    if ($r == '3+') {
                        $Io_k = $Io_k + 3;
                    }
                    elseif ($r == '2+') {
                        $Io_k = $Io_k + 2;
                    }
                    elseif ($r == '1+') {
                        $Io_k = $Io_k + 1;
                    }
                    print_r($Io_k);
                }
                elseif ($i==$Io_m[$n1]) {
                    if ($r == '3-') {
                        $Io_k = $Io_k - 3;
                    }
                    elseif ($r == '2-') {
                        $Io_k = $Io_k - 2;
                    }
                    elseif ($r == '1-') {
                        $Io_k = $Io_k - 1;
                    }
                }   
                
                elseif ($i==$Id_p[$n1]) {
                    if ($r == '3+') {
                        $Id_k = $Id_k + 3;
                    }
                    elseif ($r == '2+') {
                        $Id_k = $Id_k + 2;
                    }
                    elseif ($r == '1+') {
                        $Id_k = $Id_k + 1;
                    }
                }
                elseif ($i==$Id_m[$n1]) {
                    if ($r == '3-') {
                        $Id_k = $Id_k - 3;
                    }
                    elseif ($r == '2-') {
                        $Id_k = $Id_k - 2;
                    }
                    elseif ($r == '1-') {
                        $Id_k = $Id_k - 1;
                    }
                } 

                elseif ($i==$In_p[$n1]) {
                    if ($r == '3+') {
                        $In_k = $In_k + 3;
                    }
                    elseif ($r == '2+') {
                        $In_k = $In_k + 2;
                    }
                    elseif ($r == '1+') {
                        $In_k = $In_k + 1;
                    }
                }
                elseif ($i==$In_m[$n1]) {
                    if ($r == '3-') {
                        $In_k = $In_k - 3;
                    }
                    elseif ($r == '2-') {
                        $In_k = $In_k - 2;
                    }
                    elseif ($r == '1-') {
                        $In_k = $In_k - 1;
                    }
                } 

                elseif ($i==$Is_p[$n1]) {
                    if ($r == '3+') {
                        $Is_k = $Is_k + 3;
                    }
                    elseif ($r == '2+') {
                        $Is_k = $Is_k + 2;
                    }
                    elseif ($r == '1+') {
                        $Is_k = $Is_k + 1;
                    }
                }
                elseif ($i==$Is_m[$n1]) {
                    if ($r == '3-') {
                        $Is_k = $Is_k - 3;
                    }
                    elseif ($r == '2-') {
                        $Is_k = $Is_k - 2;
                    }
                    elseif ($r == '1-') {
                        $Is_k = $Is_k - 1;
                    }
                } 

                elseif ($i==$Ip_p[$n1]) {
                    if ($r == '3+') {
                        $Ip_k = $Ip_k + 3;
                    }
                    elseif ($r == '2+') {
                        $Ip_k = $Ip_k + 2;
                    }
                    elseif ($r == '1+') {
                        $Ip_k = $Ip_k + 1;
                    }
                }
                elseif ($i==$Ip_m[$n1]) {
                    if ($r == '3-') {
                        $Ip_k = $Ip_k - 3;
                    }
                    elseif ($r == '2-') {
                        $Ip_k = $Ip_k - 2;
                    }
                    elseif ($r == '1-') {
                        $Ip_k = $Ip_k - 1;
                    }
                } 

                elseif ($i==$Im_p[$n1]) {
                    if ($r == '3+') {
                        $Im_k = $Im_k + 3;
                    }
                    elseif ($r == '2+') {
                        $Im_k = $Im_k + 2;
                    }
                    elseif ($r == '1+') {
                        $Im_k = $Im_k + 1;
                    }
                }
                elseif ($i==$Im_m[$n1]) {
                    if ($r == '3-') {
                        $Im_k = $Im_k - 3;
                    }
                    elseif ($r == '2-') {
                        $Im_k = $Im_k - 2;
                    }
                    elseif ($r == '1-') {
                        $Im_k = $Im_k - 1;
                    }
                } 

                elseif ($i==$Iz_p[$n1]) {
                    if ($r == '3+') {
                        $Iz_k = $Iz_k + 3;
                    }
                    elseif ($r == '2+') {
                        $Iz_k = $Iz_k + 2;
                    }
                    elseif ($r == '1+') {
                        $Iz_k = $Iz_k + 1;
                    }
                }
                elseif ($i==$Iz_m[$n1]) {
                    if ($r == '3-') {
                        $Iz_k = $Iz_k - 3;
                    }
                    elseif ($r == '2-') {
                        $Iz_k = $Iz_k - 2;
                    }
                    elseif ($r == '1-') {
                        $Iz_k = $Iz_k - 1;
                    }
                } 
            }
        } 

        //Условия по выводу результата
        if (-132 <= $Io_k AND $Io_k <= -14) {
            $Io = 1;
        }
        elseif (-13 <= $Io_k AND $Io_k <= -3) {
            $Io = 2;
        }
        elseif (-2 <= $Io_k AND $Io_k <= 9) {
            $Io = 3;
        }
        elseif (10 <= $Io_k AND $Io_k <= 21) {
            $Io = 4;
        }
        elseif (22 <= $Io_k AND $Io_k <= 32) {
            $Io = 5;
        }
        elseif (33 <= $Io_k AND $Io_k <= 44) {
            $Io = 6;
        }
        elseif (45 <= $Io_k AND $Io_k <= 56) {
            $Io = 7;
        }
        elseif (57 <= $Io_k AND $Io_k <= 68) {
            $Io = 8;
        }
        elseif (69 <= $Io_k AND $Io_k <= 79) {
            $Io = 9;
        }
        elseif (80 <= $Io_k AND $Io_k <= 132) {
            $Io = 10;
        }

        //Условия по выводу результата
        if (-36 <= $Id_k AND $Id_k <= -11) {
            $Id = 1;
        }
        elseif (-10 <= $Id_k AND $Id_k <= -7) {
            $Id = 2;
        }
        elseif (-6 <= $Id_k AND $Id_k <= 3) {
            $Id = 3;
        }
        elseif (-2 <= $Id_k AND $Id_k <= 1) {
            $Id = 4;
        }
        elseif (2 <= $Id_k AND $Id_k <= 5) {
            $Id = 5;
        }
        elseif (6 <= $Id_k AND $Id_k <= 9) {
            $Id = 6;
        }
        elseif (10 <= $Id_k AND $Id_k <= 14) {
            $Id = 7;
        }
        elseif (15 <= $Id_k AND $Id_k <= 18) {
            $Id = 8;
        }
        elseif (19 <= $Id_k AND $Id_k <= 22) {
            $Id = 9;
        }
        elseif (23 <= $Id_k AND $Id_k <= 36) {
            $Id = 10;
        }

        //Условия по выводу результата
        if (-36 <= $In_k AND $In_k <= -8) {
            $In = 1;
        }
        elseif (-7 <= $In_k AND $In_k <= -4) {
            $In = 2;
        }
        elseif (-3 <= $In_k AND $In_k <= 0) {
            $In = 3;
        }
        elseif (1 <= $In_k AND $In_k <= 4) {
            $In = 4;
        }
        elseif (5 <= $In_k AND $In_k <= 7) {
            $In = 5;
        }
        elseif (8 <= $In_k AND $In_k <= 11) {
            $In = 6;
        }
        elseif (12 <= $In_k AND $In_k <= 15) {
            $In = 7;
        }
        elseif (16 <= $In_k AND $In_k <= 19) {
            $In = 8;
        }
        elseif (20 <= $In_k AND $In_k <= 23) {
            $In = 9;
        }
        elseif (24 <= $In_k AND $In_k <= 36) {
            $In = 10;
        }

        //Условия по выводу результата
        if (-30 <= $Is_k AND $Is_k <= -12) {
            $Is = 1;
        }
        elseif (-11 <= $Is_k AND $Is_k <= -8) {
            $Is = 2;
        }
        elseif (-7 <= $Is_k AND $Is_k <= -5) {
            $Is = 3;
        }
        elseif (-4 <= $Is_k AND $Is_k <= -1) {
            $Is = 4;
        }
        elseif (0 <= $Is_k AND $Is_k <= 3) {
            $Is = 5;
        }
        elseif (4 <= $Is_k AND $Is_k <= 6) {
            $Is = 6;
        }
        elseif (7 <= $Is_k AND $Is_k <= 10) {
            $Is = 7;
        }
        elseif (11 <= $Is_k AND $Is_k <= 13) {
            $Is = 8;
        }
        elseif (14 <= $Is_k AND $Is_k <= 17) {
            $Is = 9;
        }
        elseif (18 <= $Is_k AND $Is_k <= 30) {
            $Is = 10;
        }

        //Условия по выводу результата
        if (-30 <= $Ip_k AND $Ip_k <= -5) {
            $Ip = 1;
        }
        elseif (-4 <= $Ip_k AND $Ip_k <= -1) {
            $Ip = 2;
        }
        elseif (0 <= $Ip_k AND $Ip_k <= 3) {
            $Ip = 3;
        }
        elseif (4 <= $Ip_k AND $Ip_k <= 7) {
            $Ip = 4;
        }
        elseif (8 <= $Ip_k AND $Ip_k <= 11) {
            $Ip = 5;
        }
        elseif (12 <= $Ip_k AND $Ip_k <= 15) {
            $Ip = 6;
        }
        elseif (16 <= $Ip_k AND $Ip_k <= 19) {
            $Ip = 7;
        }
        elseif (20 <= $Ip_k AND $Ip_k <= 23) {
            $Ip = 8;
        }
        elseif (24 <= $Ip_k AND $Ip_k <= 27) {
            $Ip = 9;
        }
        elseif (28 <= $Ip_k AND $Ip_k <= 30) {
            $Ip = 10;
        }

        //Условия по выводу результата
        if (-12 <= $Im_k AND $Im_k <= -7) {
            $Im = 1;
        }
        elseif (-6 <= $Im_k AND $Im_k <= -5) {
            $Im = 2;
        }
        elseif (-4 <= $Im_k AND $Im_k <= -3) {
            $Im = 3;
        }
        elseif (-2 <= $Im_k AND $Im_k <= -1) {
            $Im = 4;
        }
        elseif (0 <= $Im_k AND $Im_k <= 1) {
            $Im = 5;
        }
        elseif (2 <= $Im_k AND $Im_k <= 4) {
            $Im = 6;
        }
        elseif (5 <= $Im_k AND $Im_k <= 6) {
            $Im = 7;
        }
        elseif (7 <= $Im_k AND $Im_k <= 8) {
            $Im = 8;
        }
        elseif (9 <= $Im_k AND $Im_k <= 10) {
            $Im = 9;
        }
        elseif (11 <= $Im_k AND $Im_k <= 12) {
            $Im = 10;
        }

        //Условия по выводу результата
        if (-12 <= $Iz_k AND $Iz_k <= -6) {
            $Iz = 1;
        }
        elseif (-5 <= $Iz_k AND $Iz_k <= -4) {
            $Iz = 2;
        }
        elseif (-3 <= $Iz_k AND $Iz_k <= -2) {
            $Iz = 3;
        }
        elseif (-1 <= $Iz_k AND $Iz_k <= 0) {
            $Iz = 4;
        }
        elseif (1 <= $Iz_k AND $Iz_k <= 2) {
            $Iz = 5;
        }
        elseif (3 <= $Iz_k AND $Iz_k <= 4) {
            $Iz = 6;
        }
        elseif (5 <= $Iz_k AND $Iz_k <= 6) {
            $Iz = 7;
        }
        elseif (7 <= $Iz_k AND $Iz_k <=8) {
            $Iz = 8;
        }
        elseif (9 <= $Iz_k AND $Iz_k <= 10) {
            $Iz = 9;
        }
        elseif (11 <= $Iz_k AND $Iz_k <= 12) {
            $Iz = 10;
        }
        if ($Io >= 5.5) {
            $Io_result = 'Высокий показатель по этой шкале соответствует высокому уровню субъективного контроля над любыми значимыми ситуациями: интернальный контроль, интернальная личность. Такие люди считают, что большинство важных событий в их жизни есть результат их собственных действий, что они могут ими управлять, и, таким образом, они чувствуют свою собственную ответственность за эти события и за то, как складывается их жизнь в целом. Обобщение различных экспериментальных данных позволяет говорить об интерналах как о более уверенных в себе, более спокойных и благожелательных, более популярных в сравнении с экстерналами. Их отличает более позитивная система отношений к миру и большая осознанность смысла и целей жизни.';
        } else {
            $Io_result = 'Низкий показатель по этой шкале соответствует низкому уровню субъективного контроля: экстернальный контроль, экстернальная личность. Такие люди не видят связи между своими действиями и значимыми для них событиями их жизни, не считают себя способными контролировать их развитие. Они полагают, что большинство событий их жизни является результатом случая или действия других людей. Обобщение различных экспериментальных данных позволяет говорить об экстерналах как о людях с повышенной тревожностью, обеспокоенностью. Их отличает конформность, меньшая терпимость к другим и повышенная агрессивность, меньшая популярность в сравнении с интерналами.';
        }
        if ($Id >= 5.5){
            $Id_result = 'Высокие показатели по этой шкале соответствуют высокому уровню субъективного контроля над эмоционально положительными событиями и ситуациями. Такие люди считают, что они сами добились всего того хорошего, что было и есть в их жизни, и что они способны с успехом преследовать свои цели в будущем.';
        } else {
            $Id_result = 'Низкие показатели по шкале свидетельствуют о том, что человек приписывает свои успехи, достижения и радости внешним обстоятельствам – везению, счастливой судьбе или помощи других людей.';
        }
        if ($In >= 5.5){
            $In_result = 'Высокие показатели по этой шкале говорят о развитом чувстве субъективного контроля по отношению к отрицательным событиям и ситуациям, что проявляется в склонности обвинять самого себя в разнообразных неприятностях и страданиях.';
        } else {
            $In_result = 'Низкие показатели свидетельствуют о том, что человек склонен приписывать ответственность за подобные события другим людям или считать их результатом невезения.';
        }
        if ($Is >= 5.5){
            $Is_result = 'Высокие показатели означают, что человек считает себя ответственным за события, происходящие в его семейной жизни.';
        } else {
            $Is_result = 'Низкие указывают на то, что субъект считает не себя, а своих партнеров причиной значимых ситуаций, возникающих в его семье.';
        }
        if ($Ip >= 5.5){
            $Ip_result = 'Высокие показатели свидетельствует и том, что человек считает свои действия важным фактором организации собственной производственной деятельности, складывающихся отношении в коллективе, своего продвижения и т.д.';
        } else {
            $Ip_result = 'Низкие указывают на то, что человек склонен приписывать более важное значение внешним обстоятельствам — руководству, товарищам по работе, везению-невезению.';
        }
        if ($Im >= 5.5){
            $Im_result = 'Высокие показатели свидетельствуют о том, что человек считает именно себя ответственным за построение межличностных отношений с окружающими.';
        } else {
            $Im_result = 'Низкие показатели указывают на то, что человек склонен приписывать более важное значение в этом процессе обстоятельствам, случаю или окружающим его людям.';
        }
        if ($Iz >= 5.5 ){
            $Iz_result = 'Высокие показатели свидетельствуют о том, что человек считает себя во многом ответственным за свое здоровье: если он болен, то обвиняет в этом себя и полагает, что выздоровление во многом зависит от его действий.';
        } else {
            $Iz_result = 'Человек с низкими показателями по этой шкале считает болезнь и здоровье результатом случая и надеется на то, что выздоровление придет в результате действий других людей, прежде всего врачей.';
        }




            $r_Io = 'Общая интернальность: '.$Io.' - ';
            $r_Id = 'В области достижений: '.$Id.' - ';
            $r_In = 'В области неудач: '.$In.' - ';
            $r_Is = 'В семейных отношениях: '.$Is.' - ';
            $r_Ip = 'В производственных отношениях: '.$Ip.' - ';
            $r_Im = 'В межличностных отношениях: '.$Im.' - ';
            $r_Iz = 'В отношениях здоровья: '.$Iz.' - ';
            $result = $r_Io.' '.$Io_result.' '.
            $r_Id.' '.$Id_result.' '.
            $r_In.' '.$In_result.' '.
            $r_Is.' '.$Is_result.' '.
            $r_Ip.' '.$Ip_result.' '.
            $r_Im.' '.$Im_result.' '.
            $r_Iz.' '.$Iz_result.' ';

            //Внесение результата в БД
            $sql = "UPDATE `result` SET  result = '$result', data_mdy = '$date_today', years = '$year' WHERE id_test = '3' AND id_user = '$id_user'";
            $conn -> query($sql);
    }
    $re = mysqli_query($conn, "SELECT * FROM `result` WHERE id_test = '3' AND id_user='$id_user'");
    $q = mysqli_fetch_assoc($re); 
    //Редирект
    header('Location: /resourse/user/testy/process/result_3.php');
}
?>
