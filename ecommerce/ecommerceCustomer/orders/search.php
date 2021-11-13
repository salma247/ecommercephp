<?php
include '../../shared/header.php';
include '../sharedUI/nav.php';
include '../../general/config.php';
include '../../general/functions.php';

$query = $_GET['query'];
$error = false;

if (strlen($query) > 0) {
  $select = "SELECT * from products WHERE name LIKE '%$query%' OR brand LIKE '%$query%'";
  $s = mysqli_query($conn, $select);
  $row_product = mysqli_fetch_array($s);
  if (mysqli_num_rows($s) > 0) {
    $pro_id = $row_product['id'];
    $check_wishlist = 0;

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

          echo "<div class='alert alert-danger text-center mx-auto'>
        <h5>This Product has been aleardy Added to wishlist</h5>
        </div>";
        } else {

          $insert_wishlist = "INSERT INTO wishlist (customerID,productID) values ('$customer_id','$pro_id')";

          $run_wishlist = mysqli_query($conn, $insert_wishlist);
        }
      } else {
        echo "<script type = \"text/javascript\"> alert (\"Please Login First\"); </script>";
        echo "<script>window.open('/ecommerce/ecommerceCustomer/admin/login.php','_self')</script>";
      }
    }
  } else {
    $error = true;
  }
} else {
  $error = true;
  echo "<div class='alert alert-danger text-center mx-auto'>
  <h5>Search is empty</h5>
  </div>";
}

?>

<div class="container mt-5">
  <h1>Search Results for <?php echo $query ?></h1>
  <hr>
</div>

<?php if ($error) : ?>
  <div class="container mt-5">
    <h2>There are no results for <?php echo $query ?> </h2>
    <p>Check your spelling or try different keywords</p>

  </div>

<?php else : ?>

  <div class="container my-3 products">
    <div class="row">
      <?php foreach ($s as $data) { ?>
        <div class="card card-1 col-md-3 col-6 px-0 box" data-aos="fade-up" data-aos-duration="2000">
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
endif;
include '../sharedUI/footer.php';
include '../../shared/script.php';
?>