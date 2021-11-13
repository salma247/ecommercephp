<?php
include '../shared/header.php';
include '../shared/nav.php';
include '../general/config.php';
include '../general/functions.php';

//add
if (isset($_POST['send'])) {
  $name = $_POST['name'];
  if (empty($name)) {
    $errorName[] = "The name field is empty!";
  }

  if (empty($errorName)) {
    $insert = "INSERT INTO `category` VALUES (NULL,'$name')";
    $i = mysqli_query($conn, $insert);
    textMessage($i, 'Added');
  }
}


//update
$name = "";
$update = false;
if (isset($_GET['edit'])) {
  $update = true;
  $id = $_GET['edit'];
  $select = "SELECT * FROM category where id = $id";
  $ss = mysqli_query($conn, $select);
  $row = mysqli_fetch_assoc($ss);
  $name = $row['name'];
  if (isset($_POST['update'])) {
    $name = $_POST['name'];
    $update = "UPDATE category SET name = '$name' where id = $id";
    $u = mysqli_query($conn, $update);
    echo "<script>window.open('/ecommerce/category/list.php')</script>";
  }
}
auth(1);
?>

<?php if ($update) : ?>
  <h1 class="text-center mt-5 dis">Update Category Page</h1>
  <div class="container col-md-6 mt-5">
    <div class="card card-1">
      <div class="card-body">
        <form method="POST">
          <div class="form-group">
            <label>Category Name</label>
            <?php if (!empty($errorName)) : ?>
              <div class="alert alert-warning" role="alert">
              <?php echo $errorName[0];?>
              </div>
              <?php endif; ?>
            <input type="text" placeholder="name" name="name" class="form-control" minlength="3" value="<?php echo $name ?>">
          </div>


          <button class="btn send mr-3" name="update">Update Data </button>

        <?php else : ?>
          <h1 class="text-center mt-5 dis">Add Category Page</h1>
          <div class="container col-md-6 mt-5">
            <div class="card card-1">
              <div class="card-body">
                <form method="POST">
                  <div class="form-group">
                    <label>Category Name</label>
                    <?php if (!empty($errorName)) : ?>
                      <div class="alert alert-warning" role="alert">
                        <?php echo $errorName[0]; ?>
                      </div>
                    <?php endif; ?>
                    <input type="text" placeholder="name" name="name" minlength="3" class="form-control" value="<?php echo $name ?>">
                  </div>
                  <button class="btn send" name="send"> Send Data </button>
                <?php endif ?>
                </form>
              </div>
            </div>
          </div>


          <?php include '../shared/script.php'; ?>