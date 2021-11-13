<?php
include './shared/header.php';
include './shared/nav.php';
include './general/config.php';
include './general/functions.php';

auth(2);

$select_products = "SELECT * FROM products";
$s_products = mysqli_query($conn, $select_products);
$product_num = mysqli_num_rows($s_products);

$select_customers = "SELECT * FROM customers";
$s_customers = mysqli_query($conn, $select_customers);
$customers_num = mysqli_num_rows($s_customers);

$select_category = "SELECT * FROM category";
$s_category = mysqli_query($conn, $select_category);
$category_num = mysqli_num_rows($s_category);

$select_promocodes = "SELECT * FROM promocodes";
$s_promocodes = mysqli_query($conn, $select_promocodes);
$promocodes_num = mysqli_num_rows($s_promocodes);

$select_orders = "SELECT * FROM orders";
$s_orders = mysqli_query($conn, $select_orders);
$orders_num = mysqli_num_rows($s_orders);

$earn = 0;

while ($row_cart = mysqli_fetch_array($s_orders)) {
 $earn += $row_cart['total'];
}


?>

<div class="container mt-5">
  <div class="row">

    <div class="col-lg-4 col-md-6 box">
      <div class="card card-primary">
        <div class="card-heading">
          <div class="row px-5 py-3 justify-content-between">
            <div class="col-xs-3">
              <i class="fa fa-tasks fa-5x"> </i>
            </div>
            <div class="col-xs-9 text-right">
              <div class="huge"> <?php echo $product_num; ?> </div>
              <div>Products</div>
            </div>
          </div>
        </div>
        <a href="/ecommerce/products/list.php">
          <div class="card-footer">
            <span class="pull-left"> View Details </span>
            <span class="pull-right"> <i class="fa fa-arrow-circle-right"></i> </span>
            <div class="clearfix"></div>
          </div>
        </a>
      </div>
    </div>


    <div class="col-lg-4 col-md-6 box">
      <div class="card card-green">
        <div class="card-heading">
          <div class="row px-5 py-3 justify-content-between">
            <div class="col-xs-3">
              <img src="https://img.icons8.com/external-flatart-icons-outline-flatarticons/64/ffffff/external-users-cv-resume-flatart-icons-outline-flatarticons.png" />
            </div>
            <div class="col-xs-9 text-right">
              <div class="huge"> <?php echo $customers_num; ?> </div>
              <div>Customers</div>
            </div>
          </div>
        </div>

        <a href="/ecommerce/customers/list.php">
          <div class="card-footer">
            <span class="pull-left"> View Details </span>
            <span class="pull-right"> <i class="fa fa-arrow-circle-right"></i> </span>
            <div class="clearfix"></div>
          </div>
        </a>
      </div>
    </div>


    <div class="col-lg-4 col-md-6 box">
      <div class="card card-yellow">
        <div class="card-heading">
          <div class="row px-5 py-3 justify-content-between">
            <div class="col-xs-3">
              <i class="fa fa-shopping-cart fa-5x"> </i>
            </div>
            <div class="col-xs-9 text-right">
              <div class="huge"> <?php echo $category_num; ?> </div>
              <div>Products Categories</div>
            </div>
          </div>
        </div>

        <a href="/ecommerce/category/list.php">
          <div class="card-footer">
            <span class="pull-left"> View Details </span>
            <span class="pull-right"> <i class="fa fa-arrow-circle-right"></i> </span>
            <div class="clearfix"></div>
          </div>
        </a>
      </div>
    </div>


    <div class="col-lg-4 col-md-6 box">
      <div class="card card-red">
        <div class="card-heading">
          <div class="row px-5 py-3 justify-content-between">
            <div class="col-xs-3">
              <img src="https://img.icons8.com/dotty/80/ffffff/percentage.png" />
            </div>
            <div class="col-xs-9 text-right">
              <div class="huge"> <?php echo $promocodes_num; ?> </div>
              <div>Promocodes</div>
            </div>
          </div>
        </div>
        <a href="/ecommerce/promocodes/list.php">
          <div class="card-footer">
            <span class="pull-left"> View Details </span>
            <span class="pull-right"> <i class="fa fa-arrow-circle-right"></i> </span>
            <div class="clearfix"></div>
          </div>
        </a>
      </div>
    </div>


    <div class="col-lg-4 col-md-6 box">
      <div class="card card-info">
        <div class="card-heading">
          <div class="row px-5 py-3 justify-content-between">
            <div class="col-xs-3">
            <img src="https://img.icons8.com/ios/64/ffffff/check.png"/>
            </div>
            <div class="col-xs-9 text-right">
              <div class="huge"> <?php echo $orders_num; ?> </div>
              <div>Orders</div>
            </div>
          </div>
        </div>
        <a href="/ecommerce/products/orders.php">
          <div class="card-footer">
            <span class="pull-left"> View Details </span>
            <span class="pull-right"> <i class="fa fa-arrow-circle-right"></i> </span>
            <div class="clearfix"></div>
          </div>
        </a>
      </div>
    </div>

    <div class="col-lg-4 col-md-6 box">
      <div class="card card-dark">
        <div class="card-heading">
          <div class="row px-5 py-3 justify-content-between">
            <div class="col-xs-3">
            <img src="https://img.icons8.com/external-vitaliy-gorbachev-fill-vitaly-gorbachev/60/ffffff/external-dollar-currency-vitaliy-gorbachev-fill-vitaly-gorbachev-1.png"/>
            </div>
            <div class="col-xs-9 text-right">
              <div class="huge"> <?php echo $earn; ?>$ </div>
              <div>Earnings</div>
            </div>
          </div>
        </div>
        <a href="/ecommerce/products/orders.php">
          <div class="card-footer">
            <span class="pull-left"> View Details </span>
            <span class="pull-right"> <i class="fa fa-arrow-circle-right"></i> </span>
            <div class="clearfix"></div>
          </div>
        </a>
      </div>
    </div>

  </div>

</div>

<?php include './shared/script.php'; ?>