<?php

function textMessage($condition, $mess)
{
  if ($condition) {
    echo "<div class='alert alert-info text-center mx-auto'>
    <h5>Data $mess Successfully</h5>
    </div>";
  } else {
    echo "<div class='alert alert-danger text-center mx-auto'>
    <h5>Failed</h5>
    </div>";
  }
}

function auth($role)
{
  if ($_SESSION['admin']) {
    if($_SESSION['role'] == $role || $_SESSION['role'] == 0 || $_SESSION['role'] == 1){}
    else {
      header('location:/ecommerce/admin/login.php');
    }
  } else {
    header('location:/ecommerce/admin/login.php');
  }
}
