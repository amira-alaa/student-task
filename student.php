<?php
@session_start();
$page_title='data';
$css_file='style.css';
if(isset($_SESSION['name'])){
include_once('./includes/templates/header.php');
require_once('./connection.php');

global $con;
$dt=$con->prepare('SELECT * FROM students');
$dt->execute();
$students=$dt->fetchAll();
?>

<div class="container">
  <h2>Student Data</h2>
  <!-- <p>The .table-bordered class adds borders to a table:</p>             -->
  <table class="table table-bordered">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">name</th>
        <th scope="col">college</th>
        <th scope="col">department</th>
        <th scope="col">GPA</th>
        <th>delete</th>
        <th>update</th>

      </tr>
    </thead>

    <tbody>
       
       <?php foreach($students as $student){
        // echo $student['name']; 
        ?>

      <tr>
        <td><?php echo $student['id']?></td>
        <td><?php echo $student['name']?></td>
        <td><?php echo $student['college']?></td>
        <td><?php echo $student['department']?></td>
        <td><?php echo $student['GPA']?></td>
        <td><a href="delete.php?stu_id=<?php echo $student['id']?>" class="btn-danger btn p-2">delete</a></td>
        <td><a href="update.php?stu_id=<?php echo $student['id']?>" class="btn-success btn p-2">update</a></td>
      </tr>
      <?php } ?>
    </tbody>
  </table>
  
  
</div>


<div class="container mt-1">

<a href="index.php"><button type="submit" class="btn btn-primary mt-2 p-2">back to the form</button></a>
<a href="logout.php"><button type="submit" class="btn btn-primary mt-2 p-2">Log Out</button></a>
</div>


<?php
include_once('./includes/templates/footer.php');
}else{
  header('location:login.php');
}
?>