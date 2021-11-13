<?php
include '../shared/header.php';
include '../shared/nav.php';
include '../general/config.php';
include '../general/functions.php';

$select = "SELECT * FROM category";
$s = mysqli_query($conn, $select);

if (isset($_GET['delete'])) {
  $id = $_GET['delete'];
  $delete = "DELETE from category WHERE id = $id";
  $d = mysqli_query($conn, $delete);
  if ($d) echo "<script>window.open('/ecommerce/category/list.php','_self')</script>";
}

auth(2);
?>

<div class="container col-md-8 mt-5">
<div class="table-responsive">
    
      <table class="table table-striped text-center">
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th colspan="2">Action</th>
        </tr>
        <?php
        foreach ($s as $data) {
        ?>
          <tr>
            <td> <?php echo $data['id'] ?></td>
            <td><?php echo $data['name'] ?></td>
            <td>
              <a href="/ecommerce/category/add.php?edit=<?php echo $data['id'] ?>" class="btn edit px-4 mb-2">Edit</a>
              <a onclick="return confirm('Are You Sure?')" href="/ecommerce/category/list.php?delete=<?php echo $data['id'] ?>" class="btn btn-danger px-3 mb-2">Delete</a>
            </td>

          </tr>
        <?php } ?>
      </table>
   

  </div>
</div>
<?php include '../shared/script.php'; ?>