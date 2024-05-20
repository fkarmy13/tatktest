<?php
//Подключение к файлу с БД
require_once('resourse/db.php');
require_once 'vendor/autoload.php';
//Запуск сессии для приема данных пользователя с файла signin
session_start();
if (!$_SESSION['user']) {
  header('Location: resourse/authorize.php');
}

$num_group = $_GET['num_group'];
$id_test = $_GET['id_test'];
$document = new \PhpOffice\PhpWord\TemplateProcessor('./группа.docx');

$uploadDir = __DIR__;
$outputFile = $num_group.' группа.docx';


echo $id_test.'   '.$num_group;
$res = mysqli_query($conn, "SELECT DISTINCT u.id_user, u.last_name, u.first_name, u.pathronymic, u.num_group, r.result, r.id_test, t.name_test FROM `users` u, `result` r, `test` t WHERE u.id_user=r.id_user AND r.id_test=t.id_test AND u.num_group=$num_group AND r.id_test=$id_test ORDER BY name_test, last_name");

while ($result = mysqli_fetch_assoc($res)) {
    $FIO = $result['last_name'].' '.$result['first_name'].' '.$result['pathronymic'];
    $document->setValue('FIO', $FIO);
    $num_group = $result['num_group'];
    $document->setValue('num_group', $num_group);
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