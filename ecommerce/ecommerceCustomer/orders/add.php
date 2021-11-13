<?php
include '../../shared/header.php';
include '../sharedUI/nav.php';
include '../../general/config.php';
include '../../general/functions.php';

$product_id = @$_GET['pID'];

$select = "SELECT * from products WHERE id = $product_id";
$ss = mysqli_query($conn, $select);

$row = mysqli_fetch_assoc($ss);
$row_name = $row['name'];


if (isset($_POST['add_cart'])) {
  if (isset($_SESSION['customer'])) {
    $customerName = $_SESSION['customer'];
    $get_customer = "SELECT * FROM customers where name = '$customerName'";
    $run_customer = mysqli_query($conn, $get_customer);
    
    $row_customer =  mysqli_fetch_assoc($run_customer);
    $customerID = $row_customer['id'];

    $product_qty = $_POST['product_qty'];

    $product_size = $_POST['product_size'];

    $pro_price = $row['price'];

    $query = "INSERT INTO `cart` VALUES (NULL,'$customerID','$product_id','$product_qty','$product_size')";

    $run_query = mysqli_query($conn, $query);

    textMessage($run_query, 'Added');
    
  } else {
    echo "<script type = \"text/javascript\"> alert (\"Please Login First\"); </script>";
    echo "<script>window.open('/ecommerce/ecommerceCustomer/admin/login.php','_self')</script>";
  }
}

?>

<div class="container-fluid p-0 product-page mb-5">
  <h1>Product View</h1>
</div>

<div class="container my-3">
  <div class="row">
    <div id="carouselExampleControls" class="carousel slide col-md-6" data-ride="carousel" data-interval="false">
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="/ecommerce/products/upload/<?php echo $row['img1'] ?>" class="d-block w-100 zoom" data-magnify-src="/ecommerce/products/upload/<?php echo $row['img1'] ?>" alt="...">
        </div>
        <div class="carousel-item">
          <img src="/ecommerce/products/upload/<?php echo $row['img2'] ?>" class="d-block w-100 zoom" data-magnify-src="/ecommerce/products/upload/<?php echo $row['img2'] ?>" alt="...">
        </div>
        <div class="carousel-item">
          <img src="/ecommerce/products/upload/<?php echo $row['img3'] ?>" class="d-block w-100 zoom" data-magnify-src="/ecommerce/products/upload/<?php echo $row['img3'] ?>" alt="...">
        </div>
      </div>
      <button class="carousel-control-prev" type="button" data-target="#carouselExampleControls" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-target="#carouselExampleControls" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </button>
    </div>
    <div class="col-md-6">
      <div class="card card-1 p-5">
        <h5><?php echo $row['brand'] ?></h5>
        <h2><?php echo $row_name ?></h2>
        <form method="POST" class="mt-3">
          <label class="mt-3">Quantity</label>
          <select name="product_qty" class="form-control">
            <option>1</option>
            <option>2</option>
            <option>3</option>
            <option>4</option>
            <option>5</option>
          </select>
          <label class="mt-3">Size</label>
          <select name="product_size" class="form-control">
            <option>xs</option>
            <option>s</option>
            <option>m</option>
            <option>lg</option>
            <option>xl</option>
          </select>
          <div class="text-center">
            <h2 style="color:#003C30" class="p-3 text-left font-weight-bold">US$ <?php echo $row['price'] ?></h2>
            <button type="submit" name="add_cart" style="font-size: larger; font-weight: 600;" class="btn btn-success w-100 py-2"><img src="https://img.icons8.com/external-bearicons-glyph-bearicons/32/ffffff/external-cart-call-to-action-bearicons-glyph-bearicons.png" class="mr-2" /> Add to cart</button>
            <h5 class="text-left mt-4">Description <br> <?php echo $row['description'] ?></h5>
          </div>
        </form>
        <div class="container-fluid mt-5">
          <div class="row">
            <div class="col-md-6 mb-3">
              <img src="https://img.icons8.com/external-konkapp-detailed-outline-konkapp/40/001E18/external-fast-delivery-logistic-and-delivery-konkapp-detailed-outline-konkapp.png" />
              <span> Fast Delivery</span>
            </div>
            <div class="col-md-6 mb-3">
              <img src="https://img.icons8.com/ios-filled/32/001E18/cash-on-delivery.png" />
              <span> Cash On Delivery</span>
            </div>
            <div class="col-md-6 mb-3">
              <img src="https://img.icons8.com/ios/32/001E18/army-star.png" />
              <span> Orginal Brands</span>
            </div>
            <div class="col-md-6 mb-3">
              <img src="https://img.icons8.com/material-rounded/36/001E18/delivery-person.png" />
              <span>Free Returns</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php
include '../sharedUI/footer.php';
include '../../shared/script.php';
?>