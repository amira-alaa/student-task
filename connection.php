<?php
$dsn="mysql:host=localhost;dbname=student-data";
$host="root";
$pass="";

try{
    $con=new PDO($dsn,$host,$pass);
}
catch(PDOException $e){
    echo 'error : '.$e->getMessage();
}
?>