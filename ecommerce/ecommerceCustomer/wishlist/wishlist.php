<?php
include '../../shared/header.php';
include '../sharedUI/nav.php';
include '../../general/config.php';
include '../../general/functions.php';

if (isset($_GET['delete'])) {
  $id = $_GET['delete'];
  $delete = "DELETE from wishlist WHERE id = $id";
  $d = mysqli_query($conn, $delete);
  if ($d) echo "<script>window.open('/ecommerce/ecommerceCustomer/wishlist/wishlist.php','_self')</script>";
}

if(isset($_SESSION['customer'])):
?>

<div class="container mt-5">
  <h1>My wishlist</h1>
  <hr>
</div>

<div class="container my-5 products">
  <div class="row">

    <?php $customer_session = $_SESSION['customer'];

    $get_customer = "select * from customers where name='$customer_session'";

    $run_customer = mysqli_query($conn, $get_customer);

    $row_customer = mysqli_fetch_array($run_customer);

    $customer_id = $row_customer['id'];


    $get_wishlist = "select * from wishlist where customerID='$customer_id'";

    $run_wishlist = mysqli_query($conn, $get_wishlist);

    while ($row_wishlist = mysqli_fetch_array($run_wishlist)) {

      $wishlist_id = $row_wishlist['id'];

      $product_id = $row_wishlist['productID'];

      $get_products = "select * from products where id='$product_id'";

      $run_products = mysqli_query($conn, $get_products);

      $row_products = mysqli_fetch_array($run_products);

      $product_name = $row_products['name'];

      $product_brand = $row_products['brand'];

      $product_img1 = $row_products['img1'];
    ?>
      <div class="card card-1 col-md-3 col-6 px-0 box">
        <form method="POST" class="rounded-circle">
        </form>
        <div class="hvrbox">
          <img src="/ecommerce/products/upload/<?php echo $product_img1 ?>" class="img-fluid m-0 hvrbox-layer_bottom" alt="...">
          <div class="hvrbox-layer_top">
            <div class="hvrbox-text">
              <a href="/ecommerce/ecommerceCustomer/orders/add.php?pID=<?php echo $product_id ?>">
                <img src="https://img.icons8.com/external-kiranshastry-lineal-kiranshastry/48/ffffff/external-share-interface-kiranshastry-lineal-kiranshastry-1.png" />
              </a>
              <a href="/ecommerce/ecommerceCustomer/wishlist/wishlist.php?delete=<?php echo $wishlist_id ?>" onclick="return confirm('Are You Sure?')">
                <img src="https://img.icons8.com/external-kiranshastry-lineal-kiranshastry/48/ffffff/external-delete-miscellaneous-kiranshastry-lineal-kiranshastry.png" />
              </a>
            </div>
          </div>
        </div>
        <div class="info px-3 mt-2">
          <h5 class="card-text"><?php echo $product_brand ?></h5>
          <p class="card-text"><?php echo $product_name ?></p>
          <p class="price"><?php echo $row_products['price'] ?>$</p>
        </div>
      </div>
    <?php } ?>
  </div>
</div>

<?php else:
 echo "<script type = \"text/javascript\"> alert (\"Please Login First\"); </script>";
 echo "<script>window.open('/ecommerce/ecommerceCustomer/admin/login.php','_self')</script>";
endif;

include '../sharedUI/footer.php';
include '../../shared/script.php';
?>