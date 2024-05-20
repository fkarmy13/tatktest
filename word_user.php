<?php
//Подключение к файлу с БД
require_once('resourse/db.php');
require_once 'vendor/autoload.php';
//Запуск сессии для приема данных пользователя с файла signin
session_start();
if (!$_SESSION['user']) {
  header('Location: resourse/authorize.php');
}

$id_test = $_GET['id_test'];
$id_user = $_GET['id_user'];
$group = $_GET['num_group'];
$document = new \PhpOffice\PhpWord\TemplateProcessor('./курсант.docx');




$res = mysqli_query($conn, "SELECT DISTINCT u.last_name, u.first_name, u.pathronymic, r.result, q.question, q.num_question, a.answer, t.name_test FROM `users` u, `result` r, `answer` a, `test` t, `question` q WHERE u.id_user=r.id_user AND r.id_test=a.id_test AND a.id_test=q.id_test AND r.id_test=t.id_test AND u.id_user=$id_user AND r.id_test = $id_test");
$result = mysqli_fetch_assoc($res);
$uploadDir = __DIR__;
$outputFile = $result['last_name'].'_'.$group.'_'.$result['name_test'].'.docx';

while ($result = mysqli_fetch_assoc($res)) {
    $FIO = $result['last_name'].' '.$result['first_name'].' '.$result['pathronymic'];
    $document->setValue('FIO', $FIO);
    $num_group = $result['num_group'];
    $document->setValue('num_group', $group);
    $name_test = $result['name_test'];
    $document->setValue('name_test', $name_test);
    $resul = $result['result'];
    $document->setValue('result', $resul);

    

}

    
    
    


$document->saveAs($outputFile);

$downloadFile = $outputFile;


// Контент-тип означающий скачивание
header("Content-Type: application/octet-stream");

// Размер в байтах
header("Accept-Ranges: bytes");

// Размер файла
header("Content-Length: ".filesize($downloadFile));

// Расположение скачиваемого файла
header("Content-Disposition: attachment; filename=".$downloadFile);  
ob_clean();
flush();
readfile($downloadFile);

unlink($outputFile);
exit;


?>