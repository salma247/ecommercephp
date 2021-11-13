<?php
session_start();

if (isset($_GET['logout'])) {
  session_unset();
  session_destroy();
  header('location: /ecommerce/ecommerceCustomer/admin/login.php');
}

?>

<nav class="navbar navbar-expand-lg">
  <a class="navbar-brand  mr-md-4" href="/ecommerce/ecommerceCustomer/index.php"><img src="https://img.icons8.com/external-icongeek26-flat-icongeek26/64/000000/external-hanger-laundry-icongeek26-flat-icongeek26.png" />
    Fashworks
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAABmJLR0QA/wD/AP+gvaeTAAAANElEQVRIiWNgGAXDHjDCGG8+fPxPTYNFBPgZGRgYGJioaegoGJxgNBWNAsrBaCoaBUMAAACjzQwKUvJSwAAAAABJRU5ErkJggg=="></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item mr-2">
        <a class="nav-link" href="/ecommerce/ecommerceCustomer/products/men.php">Men</a>
      </li>
      <li class="nav-item mr-2">
        <a class="nav-link" href="/ecommerce/ecommerceCustomer/products/women.php">Women</a>
      </li>
      <li class="nav-item mr-2">
        <a class="nav-link" href="/ecommerce/ecommerceCustomer/products/kids.php">Kids</a>
      </li>
      <li class="nav-item mr-2">
        <a class="nav-link" href="/ecommerce/ecommerceCustomer/products/home.php">Home</a>
      </li>
    </ul>
    <ul class="navbar-nav">
      <?php if (isset($_SESSION['customer'])) : ?>
        <li class="nav-item mt-1">
          <a class="nav-link" href="/ecommerce/ecommerceCustomer/orders/cart.php">
            <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="32" height="32" viewBox="0 0 172 172" style=" fill:#000000;">
              <g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal">
                <path d="M0,172v-172h172v172z" fill="none"></path>
                <g fill="#ecf0f1">
                  <path d="M68.8,10.32c-0.91375,0 -1.78719,0.36281 -2.43219,1.00781l-5.87219,5.87219h-28.20531c-6.38281,0 -11.97281,4.43438 -13.41063,10.66938l-7.86094,34.05062h-4.13875c-3.7625,0 -6.88,3.1175 -6.88,6.88v13.76c0,3.7625 3.1175,6.88 6.88,6.88h1.65281l18.39594,63.78781c1.04813,3.62812 4.21938,5.01219 7.47125,5.01219h103.2c3.25188,0 6.42313,-1.38406 7.47125,-5.01219l18.39594,-63.78781h1.65281c3.7625,0 6.88,-3.1175 6.88,-6.88v-13.76c0,-3.7625 -3.1175,-6.88 -6.88,-6.88h-4.13875l-7.86094,-34.05062c-1.43781,-6.235 -7.02781,-10.66938 -13.41063,-10.66938h-28.20531l-5.87219,-5.87219c-0.645,-0.645 -1.51844,-1.00781 -2.43219,-1.00781zM70.22438,17.2h31.55125l5.87219,5.87219c0.645,0.645 1.51844,1.00781 2.43219,1.00781h29.62969c3.225,0 5.97969,2.19031 6.70531,5.33469l7.49813,32.50531h-135.82625l7.49812,-32.50531c0.72563,-3.13094 3.48031,-5.33469 6.70531,-5.33469h29.62969c0.91375,0 1.78719,-0.36281 2.43219,-1.00781zM6.88,68.8h158.24v13.76h-158.24zM15.695,89.44h140.61l-17.845,61.86625c0.24188,-0.81969 -0.3225,0.05375 -0.86,0.05375h-103.2c-0.5375,0 -1.10187,-0.87344 -0.86,-0.05375zM58.48,92.88c-5.65719,0 -10.32,4.66281 -10.32,10.32v34.13125c0,5.67063 4.66281,10.32 10.32,10.32c5.65719,0 10.32,-4.64937 10.32,-10.32v-34.13125c0,-5.65719 -4.66281,-10.32 -10.32,-10.32zM86,92.88c-5.67062,0 -10.32,4.66281 -10.32,10.32v34.13125c0,5.67063 4.66281,10.32 10.32,10.32c5.65719,0 10.32,-4.64937 10.32,-10.32v-34.13125c0,-5.65719 -4.66281,-10.32 -10.32,-10.32zM113.52,92.88c-5.65719,0 -10.32,4.66281 -10.32,10.32v34.13125c0,5.67063 4.66281,10.32 10.32,10.32c5.65719,0 10.32,-4.64937 10.32,-10.32v-34.13125c0,-5.65719 -4.66281,-10.32 -10.32,-10.32zM58.48,99.76c1.92156,0 3.44,1.51844 3.44,3.44v34.13125c0,1.935 -1.51844,3.44 -3.44,3.44c-1.92156,0 -3.44,-1.505 -3.44,-3.44v-34.13125c0,-1.92156 1.51844,-3.44 3.44,-3.44zM86,99.76c1.92156,0 3.44,1.51844 3.44,3.44v34.13125c0,1.935 -1.51844,3.44 -3.44,3.44c-1.92156,0 -3.44,-1.505 -3.44,-3.44v-34.13125c0,-1.92156 1.505,-3.44 3.44,-3.44zM113.52,99.76c1.92156,0 3.44,1.51844 3.44,3.44v34.13125c0,1.935 -1.51844,3.44 -3.44,3.44c-1.92156,0 -3.44,-1.505 -3.44,-3.44v-34.13125c0,-1.92156 1.51844,-3.44 3.44,-3.44z"></path>
                </g>
              </g>
            </svg>
          </a>
        </li>
        <li class="nav-item mt-1">
          <a class="nav-link" href="/ecommerce/ecommerceCustomer/wishlist/wishlist.php">
            <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="32" height="32" viewBox="0 0 172 172" style=" fill:#000000;">
              <g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal">
                <path d="M0,172v-172h172v172z" fill="none"></path>
                <g fill="#ecf0f1">
                  <path d="M20.64,6.88v158.24h91.44219c-2.795,-2.02906 -5.65719,-4.31344 -8.37156,-6.88h-76.19063v-144.48h116.96v86.52406c1.69313,-0.30906 3.41313,-0.52406 5.16,-0.52406c0.57781,0 1.15563,0.05375 1.72,0.09406v-92.97406zM44.72,48.16v6.88h13.76v-6.88zM68.8,48.16v6.88h58.48v-6.88zM44.72,68.8v6.88h13.76v-6.88zM68.8,68.8v6.88h58.48v-6.88zM44.72,89.44v6.88h13.76v-6.88zM68.8,89.44v6.88h58.48v-6.88zM118.68,106.64c-12.38937,0 -22.36,9.82281 -22.36,21.67469c0,18.62438 17.2,29.80438 28.20531,36.91281c3.09062,2.02906 5.50937,3.38625 7.22937,5.09281l2.06938,1.67969l2.05594,-1.69312c1.72,-1.35719 4.47469,-3.05031 7.21594,-5.07938c11.70406,-7.44437 28.90406,-18.28844 28.90406,-36.91281c0,-11.85187 -9.97062,-21.67469 -22.36,-21.67469c-5.84531,0 -11.35469,2.365 -15.48,6.08719c-4.12531,-3.72219 -9.63469,-6.08719 -15.48,-6.08719zM44.72,110.08v6.88h13.76v-6.88zM68.8,110.08v6.88h23.05875c1.11531,-2.49937 2.58,-4.81062 4.34031,-6.88zM118.68,113.4125c5.16,0 9.63469,2.4725 12.72531,6.88l2.75469,3.5475l2.75469,-3.5475c2.75469,-4.05812 7.56531,-6.88 12.72531,-6.88c8.6,0 15.48,6.7725 15.48,14.90219c0,14.90219 -14.44531,24.37563 -25.11469,31.16156c-2.40531,1.34375 -4.12531,2.70094 -5.84531,3.72219c-1.72,-1.35719 -3.44,-2.37844 -5.84531,-3.72219c-10.66937,-6.78594 -25.11469,-16.25937 -25.11469,-31.16156c0,-8.12969 6.88,-14.90219 15.48,-14.90219z"></path>
                </g>
              </g>
            </svg>
          </a>
        </li>
        <li class="nav-item mx-2">
        <div class="search-container">
          <form action="/ecommerce/ecommerceCustomer/orders/search.php" method="GET">
            <input type="text" placeholder=" Search.." name="query" class="mt-2">
          </form>
        </div>
      </li>
        <li class="nav-item">
          <form>
            <button type="submit" name="logout" class="btn logout btn-danger m-2 px-4">Logout</button>
          </form>
        </li>

      <?php else : ?>
        <li class="nav-item mr-2">
        <div class="search-container">
          <form action="/ecommerce/ecommerceCustomer/orders/search.php" method="GET">
            <input type="text" placeholder=" Search.." name="query" class="mt-2">
          </form>
        </div>
      </li>
        <a href="/ecommerce/ecommerceCustomer/admin/login.php" type="submit" class="btn m-2 login px-3">Login</a>
        <a href="/ecommerce/ecommerceCustomer/admin/signUp.php" type="submit" class="btn m-2 login px-3">Sign Up</a>
      <?php endif; ?>
       
    </ul>
  </div>
</nav>