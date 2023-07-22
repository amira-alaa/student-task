<?php
@session_start();
$page_title='student data';
$css_file='style.css';
if(isset($_SESSION['name'])){
include_once('./includes/templates/header.php');
require_once('./connection.php');

if($_SERVER['REQUEST_METHOD']=="POST" && isset($_SERVER['REQUEST_METHOD'])){
    $name=filter_var($_POST['name'],FILTER_SANITIZE_STRING);
    $college=filter_var($_POST['college'],FILTER_SANITIZE_STRING);
    $dep=filter_var($_POST['dep'],FILTER_SANITIZE_STRING);
    $gpa=$_POST['gpa'];

    global $con;
    $d=$con->prepare("INSERT INTO students(name,college,department,GPA) VALUE(?,?,?,?)");
    $d->execute(array($name,$college,$dep,$gpa));

    
}

?>


<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
    <div class="container mt-5 ">
        <div class="mt-3">
            <label for="name">name:</label><br>
            <input type="text" name="name" id="name">
        </div>
        <div class="mt-3">
            <label for="college">college name:</label><br>
            <input type="text" id="college" name="college">
        </div>
        <div class="mt-3">
            <label for="dep">department name:</label><br>
            <input type="text" id="dep" name="dep">
        </div>
        <div class="mt-3">
            <label for="GPA">GPA:</label><br>
            <input type="text" id="GPA" name="gpa">
        </div>
        <button type="submit" class="btn btn-primary mt-2 p-2">Submit</button><br>
            </div>
</form>
<div class="container mt-1">
<a href="student.php"><button type="submit" class="btn btn-primary mt-2 p-2">check the data</button></a><br>

<a href="logout.php"><button type="submit" class="btn btn-primary mt-2 p-2">Log Out</button></a>
</div>


<?php
include_once('./includes/templates/footer.php');

}else{
    header('location:login.php');
}
?>