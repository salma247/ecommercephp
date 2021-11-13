<?php
include '../shared/header.php';
include '../shared/nav.php';
include '../general/config.php';
include '../general/functions.php';

//add
if (isset($_POST['send'])) {
  $code = $_POST['code'];
  $percentage = $_POST['percentage'];
  $insert = "INSERT INTO `promocodes` VALUES (NULL,'$code',$percentage)";
  $i = mysqli_query($conn, $insert);
  textMessage($i, 'Added');
}


//update
$code = "";
$percentage = "";
$update = false;
if (isset($_GET['edit'])) {
  $update = true;
  $id = $_GET['edit'];
  $select = "SELECT * FROM promocodes where id = $id";
  $ss = mysqli_query($conn, $select);
  $row = mysqli_fetch_assoc($ss);
  $code = $row['code'];
  $percentage = $row['percentage'];

  if (isset($_POST['update'])) {
    $code = $_POST['code'];
    $update = "UPDATE promocodes SET code = '$code', percentage = $percentage where id = $id";
    $u = mysqli_query($conn, $update);
    echo "<script>window.open('/ecommerce/promocodes/list.php','_self')</script>";
  }
}
auth(1);
?>

<?php if ($update) : ?>
  <h1 class="text-center mt-5 dis">Update Promocode</h1>
  <div class="container col-md-6 mt-5">
    <div class="card card-1">
      <div class="card-body">
        <form method="POST">
          <div class="form-group">
            <label>Promocode</label>
            <input type="text" placeholder="code" name="code" class="form-control" value="<?php echo $code ?>">
          </div>
          <div class="form-group">
            <label>Percentage</label>
            <input type="text" placeholder="percentage" name="percentage" class="form-control" value="<?php echo $percentage  ?>">
          </div>
          <button class="btn send mr-3" name="update">Update Data </button>

        <?php else : ?>
          <h1 class="text-center mt-5 dis">Add Promocode</h1>
          <div class="container col-md-6 mt-5">
            <div class="card card-1">
              <div class="card-body">
                <form method="POST">
                  <div class="form-group">
                    <label>Promocode</label>
                    <input type="text" placeholder="code" name="code" class="form-control" value="<?php echo $code ?>">
                  </div>
                  <div class="form-group">
                    <label>Percentage</label>
                    <input type="text" placeholder="percentage" name="percentage" class="form-control" value="<?php echo $percentage?>">
                  </div>
                  <button class="btn send" name="send"> Send Data </button>
                <?php endif ?>
                </form>
              </div>
            </div>
          </div>


          <?php include '../shared/script.php'; ?>