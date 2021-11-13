<?php

session_start();

if (isset($_GET['logout'])) {
  session_unset();
  session_destroy();
  header('location: /ecommerce/admin/login.php');
}
?>
<nav class="navbar navbar-expand-lg w-auto">
 
 <a class="navbar-brand" href="/ecommerce/index.php">Admin Panel</a>
 <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
   <span class="navbar-toggler-icon"></span>
 </button>
 <div class="collapse navbar-collapse" id="navbarNavDropdown">
   <?php if (isset($_SESSION['admin'])) : ?>
     <ul class="navbar-nav ml-3">
       <li class="nav-item dropdown">
         <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-expanded="false">
           Customers
         </a>
         <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
           <a class="dropdown-item" href="/ecommerce/customers/add.php">Add Customer</a>
           <a class="dropdown-item" href="/ecommerce/customers/list.php">List Customer</a>
         </div>
       </li>
       <li class="nav-item dropdown">
         <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-expanded="false">
           Categories
         </a>
         <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
           <a class="dropdown-item" href="/ecommerce/category/add.php">Add Category</a>
           <a class="dropdown-item" href="/ecommerce/category/list.php">List Categories</a>
         </div>
       </li>
       <li class="nav-item dropdown">
         <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-expanded="false">
           Products
         </a>
         <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
           <a class="dropdown-item" href="/ecommerce/products/add.php">Add Products</a>
           <a class="dropdown-item" href="/ecommerce/products/list.php">List Products</a>
         </div>
       </li>
       <li class="nav-item dropdown">
         <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-expanded="false">
           Promocodes
         </a>
         <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
           <a class="dropdown-item" href="/ecommerce/promocodes/add.php">Add Promocode</a>
           <a class="dropdown-item" href="/ecommerce/promocodes/list.php">List Promocodes</a>
         </div>
       </li>
      <?php if($_SESSION['role'] == 0) : ?>
       <li class="nav-item dropdown">
         <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-expanded="false">
           Admins
         </a>
         <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
           <a class="dropdown-item" href="/ecommerce/admin/add.php">Add Admin</a>
         </div>
       </li>
       <?php endif ?>
     </ul>
 </div>
 <form>
   <button type="submit" name="logout" class="btn logout btn-danger px-4">Logout</button>
 </form>
<?php else : ?>
 <a href="/ecommerce/admin/login.php" type="submit" class="btn login my-2 my-sm-0 px-4">Login</a>
<?php endif; ?>
</nav>

