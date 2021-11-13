<?php
include '../../shared/header.php';
include '../sharedUI/nav.php';
include '../../general/config.php';
include '../../general/functions.php';

$select = "SELECT * from products WHERE categoryID = 8";
$s = mysqli_query($conn, $select);

?>

<div class="container-fluid p-0 cover">
  <h1>Kids Products</h1>
</div>

<div class="container my-3 products">
  <div class="row">
    <?php foreach ($s as $data) {
      $pro_id = $data['id'];

      if (isset($_POST['wish'])) {
        if (isset($_SESSION['customer'])) {
          $customer_session = $_SESSION['customer'];
          $get_customer = "SELECT * from customers where name='$customer_session'";
          $run_customer = mysqli_query($conn, $get_customer);
          $row_customer = mysqli_fetch_array($run_customer);
          $customer_id = $row_customer['id'];

          $select_wishlist = "SELECT * from wishlist where customerID='$customer_id' AND productID='$pro_id'";

          $run_wishlist = mysqli_query($conn, $select_wishlist);

          $check_wishlist = mysqli_num_rows($run_wishlist);

          if ($check_wishlist == 1) {
            echo "<script type = \"text/javascript\"> alert (\"This Product has been aleardy Added to wishlist\"); </script>";
            echo "<script>window.open('/ecommerce/ecommerceCustomer/products/women.php','_self')</script>";
          } else {

            $insert_wishlist = "INSERT INTO wishlist (customerID,productID) values ('$customer_id','$pro_id')";

            $run_wishlist = mysqli_query($conn, $insert_wishlist);
          }
        } else {
          echo "<script type = \"text/javascript\"> alert (\"Please Login First\"); </script>";
          echo "<script>window.open('/ecommerce/ecommerceCustomer/admin/login.php','_self')</script>";
        }
      }
    ?>
      <div class="card card-1 col-md-3 col-6 px-0 box" data-aos="fade-up" data-aos-duration="1000">
        <a href="/ecommerce/ecommerceCustomer/orders/add.php?pID=<?php echo $data['id'] ?>" class="product-info">
          <form method="POST" class="rounded-circle">
            <button class="btn" name="wish"><img src="https://img.icons8.com/material-outlined/24/fa314a/like--v1.png" /></button>
          </form>
          <img src="/ecommerce/products/upload/<?php echo $data['img1'] ?>" class="img-fluid m-0" alt="...">

          <div class="info px-3 mt-2">
            <h5 class="card-text"><?php echo $data['brand'] ?></h5>
            <p class="card-text"><?php echo $data['name'] ?></p>
            <p class="price"><?php echo $data['price'] ?>$</p>
          </div>
        </a>
      </div>
    <?php } ?>
  </div>
</div>

<?php
include '../sharedUI/footer.php';
include '../../shared/script.php';
?>