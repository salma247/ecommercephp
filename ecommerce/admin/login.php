<?php
include '../shared/header.php';
include '../shared/nav.php';
include '../general/config.php';
include '../general/functions.php';


$error = "";
if (isset($_POST['login'])) {
  $name = $_POST['name'];
  $password = $_POST['password'];
  $select = "SELECT * FROM admins WHERE name = '$name' and password = '$password'";
  $s = mysqli_query($conn, $select);
  $numRow = mysqli_num_rows($s);
  $row = mysqli_fetch_assoc($s);
  
  if($numRow == 0) $error = true;
  else {
    $error = false;
    $_SESSION['admin'] = $name;
    $_SESSION['role'] = $row['role'];
    echo "<script>window.open('/ecommerce/index.php','_self')</script>";
  }
}
?>


<h1 class="text-center mt-5 dis">Login Page</h1>
<div class="container col-md-6 mt-5">
  <div class="card card-1">
    <div class="card-body">
      <form method="POST">
       <?php
       if($error):
       ?>
      
          <div class="alert alert-danger "><h5>Login Failed</h5></div>
        
        <?php endif ?>
        <div class="form-group">
          <label for="">Admin Name</label>
          <input type="text" name="name" class="form-control">
        </div>
        <div class="form-group">
          <label for="">Password</label>
          <input type="password" name="password" class="form-control">
        </div>
        <button class="btn send px-4" name="login">Login</button>
      </form>
    </div>
  </div>
</div>


<?php include '../shared/script.php'; ?>