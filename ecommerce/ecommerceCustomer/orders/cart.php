<?php
include '../../shared/header.php';
include '../sharedUI/nav.php';
include '../../general/config.php';
include '../../general/functions.php';


$total = 0;
$after = 0;

if (isset($_GET['delete'])) {
  $id = $_GET['delete'];
  $delete = "DELETE from cart WHERE id = $id";
  $d = mysqli_query($conn, $delete);
  if ($d) echo "<script>window.open('/ecommerce/ecommerceCustomer/orders/cart.php','_self')</script>";
}

$message = "";
$code = "";
if (isset($_GET['apply'])) {
  $code = $_GET['code'];
  $add = $select = "SELECT * FROM promocodes WHERE code = '$code'";
  $q = mysqli_query($conn, $add);
  if ($q) {
    $row = mysqli_fetch_assoc($q);
    $after = $row['percentage'] / 100;
    $message = "<div class='alert alert-success text-center mx-auto'>
    <h5>Applied Successfully!</h5>
    </div>";
  } else {
    $message = "<div class='alert alert-danger text-center mx-auto'>
    <h5>Code not correct</h5>
    </div>";
  }
}


if (isset($_SESSION['customer'])) :
?>

  <div class="container mt-5">
    <h1>My Cart</h1>
    <hr>
  </div>

  <div class="container my-5 products">
    <div class="row">

      <?php $customer_session = $_SESSION['customer'];

      $get_customer = "select * from customers where name='$customer_session'";

      $run_customer = mysqli_query($conn, $get_customer);

      $row_customer = mysqli_fetch_array($run_customer);

      $customer_id = $row_customer['id'];


      $get_cart = "select * from cart where customerID='$customer_id'";

      $run_cart = mysqli_query($conn, $get_cart);

      while ($row_cart = mysqli_fetch_array($run_cart)) {

        $cart_id = $row_cart['id'];

        $product_id = $row_cart['productID'];

        $get_products = "select * from products where id='$product_id'";

        $run_products = mysqli_query($conn, $get_products);

        $row_products = mysqli_fetch_array($run_products);

        $product_name = $row_products['name'];

        $product_brand = $row_products['brand'];

        $product_img1 = $row_products['img1'];
        $total += ($row_products['price'] * $row_cart['amount']);
      ?>
        <div class="card card-1 col-12 box" data-aos="fade-up">
          <div class="container-fluid cart">
            <div class="row">
              <div class="col-md-2 col-4 box">
                <img src="/ecommerce/products/upload/<?php echo $product_img1 ?>" class="img-fluid my-2 img" alt="...">
              </div>
              <div class="col-md-10 col-8 box cart-info">
                <div class="info px-3 mt-2">
                  <h5 class="card-text"><?php echo $product_brand ?></h5>
                  <p class="card-text m-0"><?php echo $product_name ?></p>
                  <p class="m-0">Size: <?php echo $row_cart['size'] ?></p>
                  <p>QTY: <?php echo $row_cart['amount'] ?></p>
                  <h5 class="price">USD$<?php echo $row_products['price'] ?></h5>
                </div>
                <a href="/ecommerce/ecommerceCustomer/orders/cart.php?delete=<?php echo $cart_id ?>">
                  <img src="https://img.icons8.com/windows/32/555555/delete-sign.png" class="float-right close" />
                </a>
              </div>
            </div>
          </div>
        </div>
      <?php }
      $result = $conn->query($get_cart);
      if ($result->num_rows == 0) { ?>
        <div class="container mt-2">
          <h2>Your cart is empty</h2>
        </div>
      <?php } else { ?>
        <div class="container total mt-5">
          <?php echo $message ?>
          <div class="row">
            <div class="col-md-7 col-12 my-3">
              <form>
                <div class="input-group">
                  <input type="text" class="form-control" placeholder=" Enter Coupon Code" name="code" value="<?php echo $code ?>" aria-describedby="button-addon2">
                  <div class="input-group-append">
                    <button class="btn btn-secondary" name="apply" type="submit" id="button-addon2">Apply</button>
                  </div>
                </div>
              </form>
            </div>
            <div class="col-6">
              <h5 class="font-weight-bold">SUBTOTAL </h5>
            </div>
            <div class="col-6">
              <h5> <?php echo $total ?>$</h5>
            </div>
            <div class="col-6">
              <h5 class="font-weight-bold">SHIPPING </h5>
              <hr>
            </div>
            <div class="col-6">
              <h5> free</h5>
            </div>
            <div class="col-6">
              <h5 class="font-weight-bold">TOTAL</h5>
            </div>
            <div class="col-6">
              <h5><?php echo $total  - ($total * $after) ?>$</h5>
            </div>
            <form method="POST">
              <button type="submit" name="checkout" class="btn btn-success rounded-pill px-5 checkout">Checkout</button>
              <form>
              <?php
              if (isset($_POST['checkout'])) {
                if (isset($_SESSION['customer'])) {
                  $customerName = $_SESSION['customer'];
                  $get_customer = "SELECT * FROM customers where name = '$customerName'";
                  $run_customer = mysqli_query($conn, $get_customer);

                  $row_customer =  mysqli_fetch_assoc($run_customer);
                  $customerID = $row_customer['id'];

                  $date = date('l jS \of F Y h:i:s A');
                  $query = "INSERT INTO `orders` VALUES (NULL,$customerID , '$date', ($total  - ($total * $after)))";

                  $run_query = mysqli_query($conn, $query);

                  if ($run_query) {
                    $get_customer = "select * from customers where name='$customer_session'";

                    $run_customer = mysqli_query($conn, $get_customer);

                    $row_customer = mysqli_fetch_array($run_customer);

                    $customer_id = $row_customer['id'];

                    $del = "DELETE from cart where customerID='$customer_id'";

                    $run_customer = mysqli_query($conn, $del);

                    echo "<script>window.open('/ecommerce/ecommerceCustomer/orders/order.php','_self')</script>";
                  }
                } else {
                  echo "<script type = \"text/javascript\"> alert (\"Please Login First\"); </script>";
                  echo "<script>window.open('/ecommerce/ecommerceCustomer/admin/login.php','_self')</script>";
                }
              }
            }
              ?>
          </div>
        </div>
    </div>

  </div>


<?php else :
  echo "<script type = \"text/javascript\"> alert (\"Please Login First\"); </script>";
  echo "<script>window.open('/ecommerce/ecommerceCustomer/admin/login.php','_self')</script>";
endif;

include '../sharedUI/footer.php';
include '../../shared/script.php';
?>