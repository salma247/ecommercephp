<?php
include '../shared/header.php';
include '../shared/nav.php';
include '../general/config.php';
include '../general/functions.php';

//add
if (isset($_POST['send'])) {
  $name = $_POST['name'];
  $address = $_POST['address'];
  $phone = $_POST['phone'];
  $password = $_POST['password'];

  if (empty($name)) {
    $errorName[] = "The name field is empty!";
  }

  if (empty($address)) {
    $errorAdd[] = "The address field is empty!";
  }

  if (strlen($phone) < 10) {
    $errorPhone[] = "The phone no. is not correct!";
  }

  if (empty($password)) {
    $errorPassword[] = "The password field is empty!";
  } else if (strlen($password) < 3) {
    $errorPassword[] = "The password field must be 3 characters or more!";
  }


  if (empty($errorName) && empty($errorPassword) && empty($errorAdd) && empty($errorPhone)) {
    $insert = "INSERT INTO `customers` VALUES (NULL,'$name','$address','$phone','$password')";
    $i = mysqli_query($conn, $insert);
    textMessage($i, 'Added');
  }
}


//update
$name = "";
$address = "";
$phone = "";
$password = "";
$update = false;

if (isset($_GET['edit'])) {
  $update = true;
  $id = $_GET['edit'];
  $select = "SELECT * FROM customers where id = $id";
  $ss = mysqli_query($conn, $select);
  $row = mysqli_fetch_assoc($ss);
  $name = $row['name'];
  $address = $row['address'];
  $phone = $row['phone'];
  if (isset($_POST['update'])) {
    $name = $_POST['name'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];


    if (empty($name)) {
      $errorName[] = "The name field is empty!";
    }

    if (empty($address)) {
      $errorAdd[] = "The address field is empty!";
    }

    if (strlen($phone) < 10) {
      $errorPhone[] = "The phone no. is not correct!";
    }

    if (empty($password)) {
      $errorPassword[] = "The password field is empty!";
    } else if (strlen($password) < 3) {
      $errorPassword[] = "The password field must be 3 characters or more!";
    }


    if (empty($errorName) && empty($errorPassword) && empty($errorAdd) && empty($errorPhone)) {
      $update = "UPDATE customers SET name = '$name', address = '$address', phone = '$phone' where id = $id";
      $u = mysqli_query($conn, $update);
      echo "<script>window.open('/ecommerce/customers/list.php','_self')</script>";
    }
  }
}

auth(0);

?>

<?php if ($update) : ?>
  <h1 class="text-center mt-5 dis">Update Customer Page</h1>
  <div class="container col-md-6 mt-5">
    <div class="card card-1">
      <div class="card-body">
        <form method="POST">
          <div class="form-group">
            <label>Customer Name</label>
            <?php if (!empty($errorName)) : ?>
              <div class="alert alert-warning" role="alert">
                <?php echo $errorName[0]; ?>
              </div>
            <?php endif; ?>
            <input type="text" placeholder="full name" name="name" class="form-control" value="<?php echo $name ?>">
          </div>
          <div class="form-group">
            <label>Customer Address</label>
            <?php if (!empty($errorAdd)) : ?>
              <div class="alert alert-warning" role="alert">
                <?php echo $errorAdd[0]; ?>
              </div>
            <?php endif; ?>
            <input type="text" placeholder="address" name="address" class="form-control" value="<?php echo $address ?>">
          </div>
          <div class="form-group">
            <label>Customer Phone</label>
            <?php if (!empty($errorPhone)) : ?>
              <div class="alert alert-warning" role="alert">
                <?php echo $errorPhone[0]; ?>
              </div>
            <?php endif; ?>
            <input type="text" placeholder="phone" name="phone" class="form-control" value="<?php echo $phone ?>">
          </div>


          <button class="btn send mr-3" name="update"> Update Data </button>

        <?php else : ?>
          <h1 class="text-center mt-5 dis">Add Customer Page</h1>
          <div class="container col-md-6 mt-5">
            <div class="card card-1">
              <div class="card-body">
                <form method="POST">
                  <div class="form-group">
                    <label>Customer Name</label>
                    <?php if (!empty($errorName)) : ?>
                      <div class="alert alert-warning" role="alert">
                        <?php echo $errorName[0]; ?>
                      </div>
                    <?php endif; ?>
                    <input type="text" placeholder="full name" name="name" class="form-control" value="<?php echo $name ?>">
                  </div>
                  <div class="form-group">
                    <label>Customer Address</label>
                    <?php if (!empty($errorAdd)) : ?>
                      <div class="alert alert-warning" role="alert">
                        <?php echo $errorAdd[0]; ?>
                      </div>
                    <?php endif; ?>
                    <input type="text" placeholder="address" name="address" class="form-control" value="<?php echo $address ?>">
                  </div>
                  <div class="form-group">
                    <label>Customer Phone</label>
                    <?php if (!empty($errorPhone)) : ?>
                      <div class="alert alert-warning" role="alert">
                        <?php echo $errorPhone[0]; ?>
                      </div>
                    <?php endif; ?>
                    <input type="text" placeholder="phone" name="phone" class="form-control" value="<?php echo $phone ?>">
                  </div>
                  <div class="form-group">
                    <label>Customer Password</label>
                    <?php if (!empty($errorPassword)) : ?>
                      <div class="alert alert-warning" role="alert">
                        <?php echo $errorPassword[0]; ?>
                      </div>
                    <?php endif; ?>
                    <input type="password" placeholder="password" name="password" class="form-control" value="<?php echo $password ?>">
                  </div>

                  <button class="btn send" name="send"> Send Data </button>
                <?php endif ?>
                </form>
              </div>
            </div>
          </div>


          <?php include '../shared/script.php'; ?>