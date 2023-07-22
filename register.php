<?php
$page_title='signup page';
$css_file='style.css';
include_once('./includes/templates/header.php');
require_once('./connection.php');


global $con;
if($_SERVER['REQUEST_METHOD']=="POST" && isset($_SERVER['REQUEST_METHOD'])){
    $name=filter_var($_POST['name'],FILTER_SANITIZE_STRING);
    $email=filter_var($_POST['email'],FILTER_SANITIZE_EMAIL);
    $pass=filter_var($_POST['pass'],FILTER_SANITIZE_STRING);


    $hashed_pass=password_hash($pass,PASSWORD_DEFAULT);


    
    $d=$con->prepare("INSERT INTO users(name,email,password) VALUE(?,?,?)");
    $d->execute(array($name,$email,$hashed_pass));

    
}
?>


<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
    <div class="container mt-5 ">
        <div class="mt-3">
            <label for="name">name:</label><br>
            <input type="text" name="name" id="name">
        </div>
        <div class="mt-3">
            <label for="email">email:</label><br>
            <input type="email" id="email" name="email">
        </div>
        <div class="mt-3">
            <label for="pass">password:</label><br>
            <input type="password" id="pass" name="pass">
        </div>
        
        <button type="submit" class="btn btn-primary mt-2 p-2">CREATE AN ACCOUNT</button><br>
        

    </div>
</form>
<div class="container mt-1 ">
<a href="login.php"><button type="submit" class="btn btn-primary mt-2 p-2">Sign In</button></a>
</div>

<?php
include_once('./includes/templates/footer.php');
?>