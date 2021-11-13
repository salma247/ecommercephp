<?php
include '../shared/header.php';
include '../shared/nav.php';
include '../general/config.php';
include '../general/functions.php';

//add
if (isset($_POST['send'])) {
  $name = $_POST['name'];
  $brand = $_POST['brand'];
  $description = $_POST['description'];
  $categoryID = $_POST['categoryID'];
  $price = $_POST['price'];

  $image1_type = $_FILES['image1']['type'];
  $image1_name = $_FILES['image1']['name'];
  $image1_tmp = $_FILES['image1']['tmp_name'];

  $image2_type = $_FILES['image2']['type'];
  $image2_name = $_FILES['image2']['name'];
  $image2_tmp = $_FILES['image2']['tmp_name'];

  $image3_type = $_FILES['image3']['type'];
  $image3_name = $_FILES['image3']['name'];
  $image3_tmp = $_FILES['image3']['tmp_name'];

  $location = './upload/';

  if (empty($name)) {
    $errorName[] = "The name field is empty!";
  }

  if (empty($brand)) {
    $errorBrand[] = "The brand field is empty!";
  }

  if (empty($description)) {
    $errordesc[] = "The description field is empty!";
  }

  if (empty($price)) {
    $errorPrice[] = "The price field is empty!";
  }

  if (empty($image1_name) || empty($image2_name) || empty($image3_name)) {
    $errorImg[] = "Images must not be empty...";
  }


  if (empty($errorName) && empty($errorPrice) && empty($errorBrand) && empty($errordesc) && empty($errorImg)) {
    move_uploaded_file($image1_tmp, $location . $image1_name);
    move_uploaded_file($image2_tmp, $location . $image2_name);
    move_uploaded_file($image3_tmp, $location . $image3_name);

    $insert = "INSERT INTO `products` VALUES (NULL,'$name','$brand','$image1_name','$image2_name','$image3_name', '$description',$categoryID,$price)";
    $i = mysqli_query($conn, $insert);
    textMessage($i, 'Added');
  }
}


//update
$name = "";
$brand = "";
$description = "";
$categoryID = "";
$price = "";
$update = false;
if (isset($_GET['edit'])) {
  $update = true;
  $id = $_GET['edit'];
  $select = "SELECT * FROM products where id = $id";
  $ss = mysqli_query($conn, $select);
  $row = mysqli_fetch_assoc($ss);
  $name = $row['name'];
  $brand = $row['brand'];
  $price = $row['price'];
  $description = $row['description'];
  $categoryID = $row['categoryID'];
  if (isset($_POST['update'])) {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $categoryID = $_POST['categoryID'];
    $brand = $_POST['brand'];

    $image1_type = $_FILES['image1']['type'];
    $image1_name = $_FILES['image1']['name'];
    $image1_tmp = $_FILES['image1']['tmp_name'];

    $image2_type = $_FILES['image2']['type'];
    $image2_name = $_FILES['image2']['name'];
    $image2_tmp = $_FILES['image2']['tmp_name'];

    $image3_type = $_FILES['image3']['type'];
    $image3_name = $_FILES['image3']['name'];
    $image3_tmp = $_FILES['image3']['tmp_name'];

    $location = './upload/';

    if (empty($name)) {
      $errorName[] = "The name field is empty!";
    }

    if (empty($brand)) {
      $errorBrand[] = "The brand field is empty!";
    }

    if (empty($description)) {
      $errordesc[] = "The description field is empty!";
    }

    if (empty($price)) {
      $errorPrice[] = "The price field is empty!";
    }

    if (empty($image1_name) || empty($image2_name) || empty($image3_name)) {
      $errorImg[] = "Images must not be empty...";
    }


    if (empty($errorName) && empty($errorPrice) && empty($errorBrand) && empty($errordesc) && empty($errorImg)) {
      move_uploaded_file($image1_tmp, $location . $image1_name);
      move_uploaded_file($image2_tmp, $location . $image2_name);
      move_uploaded_file($image3_tmp, $location . $image3_name);

      $update = "UPDATE products SET name = '$name',brand = $brand, description = '$description', categoryID = $categoryID,price = $price where id = $id";
      $u = mysqli_query($conn, $update);
      echo "<script>window.open('location:/ecommerce/products/list.php','_self')</script>";
    }
  }
}
auth(1);
?>

<?php if ($update) : ?>
  <h1 class="text-center mt-5 dis">Update Product Page</h1>
  <div class="container col-md-6 mt-5">
    <div class="card card-1">
      <div class="card-body">
        <form method="POST" enctype="multipart/form-data">
          <div class="form-group">
            <label>Product Name</label>
            <?php if (!empty($errorName)) : ?>
              <div class="alert alert-warning" role="alert">
                <?php echo $errorName[0]; ?>
              </div>
            <?php endif; ?>
            <input type="text" placeholder="name" name="name" class="form-control" value="<?php echo $name ?>">
          </div>
          <div class="form-group">
            <label>Product Brand</label>
            <?php if (!empty($errorBrand)) : ?>
              <div class="alert alert-warning" role="alert">
                <?php echo $errorBrand[0]; ?>
              </div>
            <?php endif; ?>
            <input type="text" placeholder="brand" name="brand" class="form-control" value="<?php echo $brand ?>">
          </div>
          <div class="form-group">
            <label>Product Images</label>
            <?php if (!empty($errorImg)) : ?>
              <div class="alert alert-warning" role="alert">
                <?php echo $errorImg[0]; ?>
              </div>
            <?php endif; ?>
            <input type="file" name="image1" class="form-control">
            <input type="file" name="image2" class="form-control">
            <input type="file" name="image3" class="form-control">
          </div>
          <div class="form-group">
            <label>Description</label>
            <?php if (!empty($errordesc)) : ?>
              <div class="alert alert-warning" role="alert">
                <?php echo $errordesc[0]; ?>
              </div>
            <?php endif; ?>
            <input type="text" placeholder="description" name="description" class="form-control" value="<?php echo $description ?>">
          </div>
          <div class="form-group">
            <label>Category</label>
            <?php
            $select = "SELECT * FROM category";
            $c = mysqli_query($conn, $select);
            ?>
            <select name="categoryID" class="form-control">
              <?php foreach ($c as $data) { ?>
                <option value="<?php echo $data['id'] ?>"> <?php echo $data['name'] ?> </option>
              <?php } ?>
            </select>
          </div>
          <div class="form-group">
            <label>Price</label>
            <?php if (!empty($errorPrice)) : ?>
              <div class="alert alert-warning" role="alert">
                <?php echo $errorPrice[0]; ?>
              </div>
            <?php endif; ?>
            <input type="text" placeholder="price" name="price" class="form-control" value="<?php echo $price ?>">
          </div>

          <button class="btn send mr-3" name="update"> Update Data </button>

        <?php else : ?>
          <h1 class="text-center mt-5 dis">Add Product Page</h1>
          <div class="container col-md-6 mt-5">
            <div class="card card-1">
              <div class="card-body">
                <form method="POST" enctype="multipart/form-data">
                  <div class="form-group">
                    <label>Product Name</label>
                    <?php if (!empty($errorName)) : ?>
                      <div class="alert alert-warning" role="alert">
                        <?php echo $errorName[0]; ?>
                      </div>
                    <?php endif; ?>
                    <input type="text" placeholder="name" name="name" class="form-control" value="<?php echo $name ?>">
                  </div>
                  <div class="form-group">
                    <label>Product Brand</label>
                    <?php if (!empty($errorBrand)) : ?>
                      <div class="alert alert-warning" role="alert">
                        <?php echo $errorBrand[0]; ?>
                      </div>
                    <?php endif; ?>
                    <input type="text" placeholder="brand" name="brand" class="form-control" value="<?php echo $brand ?>">
                  </div>
                  <div class="form-group">
                    <label>Product Images</label>
                    <?php if (!empty($errorImg)) : ?>
                      <div class="alert alert-warning" role="alert">
                        <?php echo $errorImg[0]; ?>
                      </div>
                    <?php endif; ?>
                    <input type="file" name="image1" class="form-control">
                    <input type="file" name="image2" class="form-control">
                    <input type="file" name="image3" class="form-control">
                  </div>
                  <div class="form-group">
                    <label>Product description</label>
                    <?php if (!empty($errordesc)) : ?>
                      <div class="alert alert-warning" role="alert">
                        <?php echo $errordesc[0]; ?>
                      </div>
                    <?php endif; ?>
                    <input type="text" placeholder="description" name="description" class="form-control" value="<?php echo $description ?>">
                  </div>
                  <div class="form-group">
                    <label>Category</label>
                    <?php
                    $select = "SELECT * FROM category";
                    $c = mysqli_query($conn, $select);
                    ?>
                    <select name="categoryID" class="form-control">
                      <?php foreach ($c as $data) { ?>
                        <option value="<?php echo $data['id'] ?>"> <?php echo $data['name'] ?> </option>
                      <?php } ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Price</label>
                    <?php if (!empty($errorPrice)) : ?>
                      <div class="alert alert-warning" role="alert">
                        <?php echo $errorPrice[0]; ?>
                      </div>
                    <?php endif; ?>
                    <input type="text" placeholder="price" name="price" class="form-control" value="<?php echo $price ?>">
                  </div>

                  <button class="btn send" name="send"> Send Data </button>
                <?php endif ?>
                </form>
              </div>
            </div>
          </div>


          <?php include '../shared/script.php'; ?>