<?php
@session_start();
$page_title='student data';
$css_file='style.css';
if(isset($_SESSION['name'])){
include_once('./includes/templates/header.php');
require_once('./connection.php');


global $con;
if(isset($_GET['stu_id'])){
    
    $stmt=$con->prepare('SELECT * FROM students where id=?');
    $stmt->execute(array($_GET['stu_id']));
    $data=$stmt->fetch();
}
if($_SERVER['REQUEST_METHOD']=="POST" && isset($_SERVER['REQUEST_METHOD'])){
    $name=filter_var($_POST['name'],FILTER_SANITIZE_STRING);
    $college=filter_var($_POST['college'],FILTER_SANITIZE_STRING);
    $dep=filter_var($_POST['dep'],FILTER_SANITIZE_STRING);
    $gpa=$_POST['gpa'];

    $d=$con->prepare("UPDATE students SET name=? , college=? , department=? , GPA=? where id=?");
    $d->execute(array($name,$college,$dep,$gpa,$_GET['stu_id']));
}


?>


<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
    <div class="container mt-5 ">
        <div class="mt-3">
            <label for="name">name:</label>
            <input type="text" name="name" id="name" value="<?php echo $data['name']; ?>">
        </div>
        <div class="mt-3">
            <label for="college">college name:</label>
            <input type="text" id="college" name="college" value="<?php echo $data['college']; ?>">
        </div>
        <div class="mt-3">
            <label for="dep">department name:</label>
            <input type="text" id="dep" name="dep" value="<?php echo $data['department']; ?>">
        </div>
        <div class="mt-3">
            <label for="GPA">GPA:</label>
            <input type="text" id="GPA" name="gpa" value="<?php echo $data['GPA']; ?>">
        </div>
        <button type="submit" class="btn btn-primary mt-2">UPDATE</button>
    </div>
</form>

<div class="container mt-1">

<a href="student.php"><button type="submit" class="btn btn-primary mt-2 p-2">check the data</button></a>
<a href="logout.php"><button type="submit" class="btn btn-primary mt-2 p-2">Log Out</button></a>
</div>


<?php
include_once('./includes/templates/footer.php');
}else{
    header('location:login.php');
}
?>




