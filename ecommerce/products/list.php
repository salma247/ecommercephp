<?php
include '../shared/header.php';
include '../shared/nav.php';
include '../general/config.php';
include '../general/functions.php';

$select = "SELECT products.id, products.name product, products.brand ,products.img1, products.description, category.name cat FROM products JOIN category ON products.categoryID = category.id";
$s = mysqli_query($conn, $select);

if (isset($_GET['delete'])) {
  $id = $_GET['delete'];
  $delete = "DELETE from products WHERE id = $id";
  $d = mysqli_query($conn, $delete);
  if ($d) echo "<script>window.open('/ecommerce/products/list.php','_self')</script>";
}
auth(2);
?>

<div class="container col-md-10 mt-5">
  <div class="table-responsive">
      <table class="table table-striped text-center">
        <thead>
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Brand</th>
          <th>Image</th>
          <th>Description</th>
          <th>Category</th>
          <th colspan="2">Action</th>
        </tr>
        </thead>
       <tbody>
       <?php
        foreach ($s as $data) {
        ?>
          <tr>
            <th scope="row"> <?php echo $data['id'] ?></th>
            <td><?php echo $data['product'] ?></td>
            <td><?php echo $data['brand'] ?></td>
            <td> <img src="/ecommerce/products/upload/<?php echo $data['img1']?>" alt="" width="100px" height="100px"></td>
            <td><?php echo $data['description'] ?></td>
            <td><?php echo $data['cat'] ?></td>
            <td>
              <a href="/ecommerce/products/add.php?edit=<?php echo $data['id'] ?>" class="btn edit px-4 mb-1">Edit</a>
              <a onclick="return confirm('Are You Sure?')" href="/ecommerce/products/list.php?delete=<?php echo $data['id'] ?>" class="btn btn-danger px-3">Delete</a>
            </td>
          </tr>
        <?php } ?>
       </tbody>
      </table>
   

  </div>
</div>
<?php include '../shared/script.php'; ?>