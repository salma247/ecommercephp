<?php
include '../../shared/header.php';
include '../sharedUI/nav.php';
include '../../general/config.php';
include '../../general/functions.php';
?>
<div class="container-fluid p-0 cover">
  <h1>Checkout</h1>
</div>

<div class="container p-5">
<div class="card  card-1 m-auto text-center">
  <div class="card-body my-5">
    <h2 class="card-title m-0">THANK YOU</h2>
    <p class="card-text">for shopping with us</p>
    <h5 class="mb-5">You Ordered on <?php echo date('l jS \of F Y h:i:s A') ?></h5>
    <h2>Payment options</h2>
    <img src="https://img.icons8.com/fluency/64/000000/paypal.png"/>
    <img src="https://img.icons8.com/color/64/000000/mastercard.png"/>
    <img src="https://img.icons8.com/office/64/000000/visa.png"/>
  </div>
</div>
</div>
</div>

<?php
include '../sharedUI/footer.php';
include '../../shared/script.php';
?>