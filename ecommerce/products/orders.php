<?php
include '../shared/header.php';
include '../shared/nav.php';
include '../general/config.php';
include '../general/functions.php';

$select = "SELECT orders.id, customers.name name ,orders.date , orders.total FROM orders JOIN customers ON orders.customerID = customers.id";
$s = mysqli_query($conn, $select);


if (isset($_GET['delete'])) {
  $id = $_GET['delete'];
  $delete = "DELETE from orders WHERE id = $id";
  $d = mysqli_query($conn, $delete);
  if ($d) echo "<script>window.open('/ecommerce/products/orders.php','_self')</script>";
}
auth(2);
?>

<div class="container col-md-10 mt-5">
  <div class="table-responsive">
    <table class="table table-striped text-center">
      <thead>
        <tr>
          <th>ID</th>
          <th>Customer Name</th>
          <th>Data</th>
          <th>Total</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $eran = 0;
        foreach ($s as $data) {
        ?>
          <tr>
            <th scope="row"> <?php echo $data['id'] ?></th>
            <td><?php echo $data['name'] ?></td>
            <td><?php echo $data['date'] ?></td>
            <td><?php
            echo $data['total'] ?>$</td>
            <td>
              <a onclick="return confirm('Are You Sure?')" href="/ecommerce/products/orders.php?delete=<?php echo $data['id'] ?>" class="btn btn-danger px-3">Delete</a>
            </td>
          </tr>
        <?php } ?>
        
      </tbody>
    </table>


  </div>
</div>
<?php include '../shared/script.php'; ?>