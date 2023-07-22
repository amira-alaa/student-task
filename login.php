<?php
@session_start();
$page_title='signin page';
$css_file='style.css';
include_once('./includes/templates/header.php');
require_once('./connection.php');

if(isset($_SESSION['name'])){
    header("Refresh:3;url=index.php");
}
else{
global $con;

if($_SERVER['REQUEST_METHOD']=="POST" && isset($_SERVER['REQUEST_METHOD'])){
    $email=filter_var($_POST['email'],FILTER_SANITIZE_EMAIL);
    $pass=filter_var($_POST['pass'],FILTER_SANITIZE_STRING);
    ///$hashed_pass=password_hash($pass,PASSWORD_DEFAULT);

    $stmt=$con->prepare("SELECT * FROM users where email=?");
    $stmt->execute(array($email));
    $data=$stmt->fetch();
    //$r_email=$data['email'];
    //$r_pass=$data['password'];
    $count=$stmt->rowcount();
    if($count>0){
        $result=password_verify($pass,$data['password']);
        if($result){
            
            echo "yes";
            $_SESSION['id']=$data['id'];
            $_SESSION['name']=$data['name'];
            $_SESSION['email']=$data['email'];

            echo "
            <script>
                toastr.success('success process')
            </script>";

            header("Refresh:1;url=index.php");


        }
        else{
            echo "
            <script>
                toastr.error('error pass')
            </script>";

        }
    }
    else{
        echo "
        <script>
            toastr.error('error email')
        </script>";

    }

    
}
}
?>


<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
    <div class="container mt-5 ">
        <div class="mt-3">
            <label for="email">email:</label><br>
            <input type="email" id="email" name="email">
        </div>
        <div class="mt-3">
            <label for="pass">password:</label><br>
            <input type="password" id="pass" name="pass">
        </div>
        
        <button type="submit" class="btn btn-primary mt-2 p-2">SIGN IN</button><br>

    </div>
</form>
<div class="container mt-1 ">
<a href="register.php"><button type="submit" class="btn btn-primary mt-2 p-2">Sign Up</button></a>
</div>



<?php
include_once('./includes/templates/footer.php');
?>