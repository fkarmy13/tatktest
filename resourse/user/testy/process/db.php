<?php
//Создание переменнных
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tatktest";
//Подключение к БД
$conn = mysqli_connect($server, $username, $password, $dbname);

if(!$conn){
    die("Cannection Fialed". mysqli_connect_error());
} else {
    echo $sql;
} 
