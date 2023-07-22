<?php
@session_start();
if(isset($_SESSION['name'])){


require_once('./connection.php');

if(isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD']=='GET'){
    if(isset($_GET['stu_id'])){
        global $con;

        $dstat=$con->prepare('DELETE FROM students WHERE id=?');
        $dstat->execute(array($_GET['stu_id']));
        header('location:student.php');
    }
}
}else{
    header('location:login.php');
}
?>