<?php
include '../shared/header.php';
include '../shared/nav.php';
include '../general/config.php';
include '../general/functions.php';

if ($_SESSION['role'] == 0) {
  $error = "";
  if (isset($_POST['signUp'])) {
    $name = $_POST['name'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    if (empty($name)) {
      $errorName[] = "The name field is empty!";
    }
    if (empty($password)) {
      $errorPassword[] = "The password field is empty!";
    } else if (strlen($password) < 3) {
      $errorPassword[] = "The password field must be 3 characters or more!";
    }
    $select = "SELECT * from admins WHERE name = '$name' ";
    $s = mysqli_query($conn, $select);
    $num_row = mysqli_num_rows($s);
    if ($num_row > 0) {
      $errorName[] = "Username is used!";
    }
    if (empty($errorName) && empty($errorPassword)) {
      $insert = "INSERT INTO admins VALUES (null,'$name','$password',$role)";
      $i = mysqli_query($conn, $insert);
      textMessage($i, 'Added');
    }
  }
  auth(0);
?>


  <h1 class="text-center mt-5 dis">Add Admin Page</h1>
  <div class="container col-md-6 mt-5">
    <div class="card card-1">
      <div class="card-body">
        <form method="POST">
          <div class="form-group">
            <label for="">Admin Name</label>
            <?php if (!empty($errorName)) : ?>
              <div class="alert alert-warning" role="alert">
              <?php echo $errorName[0];?>
              </div>
              <?php endif; ?>
              <input type="text" name="name" class="form-control">
          </div>
          <div class="form-group">
            <label for="">Password</label>
            <?php if (!empty($errorPassword)) : ?>
              <div class="alert alert-warning" role="alert">
              <?php echo $errorPassword[0];?>
              </div>
              <?php endif; ?>
              <input type="password" name="password" class="form-control">
          </div>
          <div class="form-group">
            <label for="">Role</label>
            <select name="role" id="" class="form-control">
              <option value="0">Full Access</option>
              <option value="1">Semi Access</option>
              <option value="2">View Only</option>
            </select>
          </div>
          <button class="btn send px-4" name="signUp">ADD</button>
        </form>
      </div>
    </div>
  </div>


<?php }
include '../shared/script.php'; ?>