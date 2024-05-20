<?php 
//Запуск сессии для передачи сообщений
session_start();
//Подключение к файлу с БД
require_once('db.php');

//Получение внесенных данных пользователем из файла register
$last_name = $_POST['last_name'];
$first_name = $_POST['first_name'];
$pathronymic = $_POST['pathronymic'];
$num_group = $_POST['num_group'];
$email = $_POST['email'];
$pass = $_POST['pass'];
$repeat_pass = $_POST['repeat_pass'];

$_SESSION['last_name'] = $last_name;
$_SESSION['first_name'] = $first_name;
$_SESSION['pathronymic'] = $pathronymic;
$_SESSION['num_group'] = $num_group;
$_SESSION['email'] = $email;
$_SESSION['pass'] = $pass;
$_SESSION['repeat_pass'] = $repeat_pass;
//Запрос в БД для проверки зарегистрированного пользователя
$check_user = mysqli_query($conn, "SELECT * From `users` WHERE `email` = '$email'");

//Проверка на пустые поля ввода
if(empty($last_name) || empty($first_name) || empty($pathronymic) || empty($num_group) || empty($email) || empty($pass) || empty($repeat_pass)){
    //Вывод сообщения о пустых полях
    $_SESSION['message'] = 'Вы не заполнили поля';
    //Редирект на страницу регистрации
    header('Location: register.php');
    } else {
        //Проверка введенных паролей
        if($pass === $repeat_pass) {
            //Зашифровка пароля для внесения в БД
            $pass = md5($pass);
            //Проверка на зарегистрированного пользователя
            if (mysqli_num_rows($check_user) > 0) {
                $_SESSION['message'] = 'Данный пользователь зарегистрирован';
                header('Location: register.php');
            } else { 
                function random_number($length = 6)
                    {
                        $arr = array(
                            'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 
                            'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', 
                            '1', '2', '3', '4', '5', '6', '7', '8', '9', '0'
                        );
                    
                        $res = '';
                        for ($i = 0; $i < $length; $i++) {
                            $res .= $arr[random_int(0, count($arr) - 1)];
                        }
                        return $res;
                    }
                    
                $kod = random_number();
                $_SESSION['kod'] = $kod;
                $name = $first_name;
                $email = $email;
                $text = 'Код для успешной регистрации: '.$kod;
                $to = 'fkarmy13@mail.ru';
                $from = $email;
                $subject = 'Код для регистрации'.$kod;
                $msg = "
                Имя: $name
                Почта: $email
                Текст: $text";
                mail($to, $subject, $msg, "From: $from ");
                header('Location: regist.php');
                

            }
        } else {
            //Если пароли введены неверно вывод сообщения и редирект на страницу регистрации
            $_SESSION['message'] = 'Пароли не совпадают';
            header('Location: register.php');
        }
    }