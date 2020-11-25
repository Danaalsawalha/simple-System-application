<?php

include_once('./connection.php');

if(array_key_exists('addData', $_POST)) {

    $productName = $_POST['productName'];
    $Description = $_POST['Description'];
    $photo  = $_POST['photo'];

    $sql = "INSERT INTO product(productName, Description, photo)
            VALUES ('$productName', '$Description', '$photo')";

    if(mysqli_query($conn, $sql)) {
        echo "<script>alert('Data Saved')</script>";
        header('location: HomePage.php');
    } else  {
        echo mysqli_error($conn);
        echo "<script>alert('Data Not Saved')</script>";
    }
      
?>

<?php

include_once('./connection.php');

if(array_key_exists('update', $_POST)) {
    $id = $_POST['update_id'];
    $productName = $_POST['productName'];
    $Description = $_POST['Description'];
    $photo  = $_POST['photo'];

    $sql = "UPDATE product SET 'productName='$productName', 'Description'=$Description, 'photo'=$photo WHERE id='$id' ";

    if(mysqli_query($conn, $sql)) {
        echo "<script>alert('Data Updated')</script>";
    } else  {
        echo mysqli_error($conn);
        echo "<script>alert('Data Not Updated')</script>";
    }
      
?>

<?php

include_once('./connection.php');

if(array_key_exists('deleteData', $_POST)) {

    $id = $_POST['delete_id'];
    $productName = $_POST['productName'];
    $Description = $_POST['Description'];
    $photo  = $_POST['photo'];

    $sql = "DELETE FROM product WHERE id='$id' ";

    if(mysqli_query($conn, $sql)) {
        echo "<script>alert('Data Deleted')</script>";
    } else  {
        echo mysqli_error($conn);
        echo "<script>alert('Data Not Deleted')</script>";
    }
      
?>

<!DOCTYPE html>
<html>

<head>
  <title>Home Page</title>
  <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link href="StyleBootstrap.css" rel="stylesheet">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
    integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css"
    integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
    integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
    crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
    crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
    crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.js"
    integrity="sha512-WNLxfP/8cVYL9sj8Jnp6et0BkubLP31jhTG9vhL/F5uEZmg5wEzKoXp1kJslzPQWwPT1eyMiSxlKCgzHLOTOTQ=="
    crossorigin="anonymous"></script>
</head>

<body>
  <div class="container h-100">
    <ul class="nav justify-content-end">
      <li class="nav-item">
        <h1 class="nav-link" id="title">Products List</h1>
      </li>
      <li class="nav-item">
        <a class="nav-link active" href="logout.php" tabindex="-1" aria-disabled="true">
          <h5>Log out</h5>
        </a>
      </li>
    </ul>
    <div id="user_info">
      <?php if(!isset($_SESSION['email'])): header("location: logout.php"); ?>
      <?php else: ?>
      <?php endif ?>

      <?php echo "<h1> Welcome".$_SESSION['fullname']."</h1><br>"?>
      <?php
      $bday = new DateTime('$birthDate'); 
      $today = new Datetime(date('m.d.y'));
      $diff = $today->diff($bday);
      printf('Your age : %d years, %d month, %d days', $diff->y, $diff->m, $diff->d);
      printf("\n");
      ?>
      
    </div>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal"
      data-whatever="@mdo">Add Product</button>
    <button type="button" class="btn btn-primary editInfo" data-toggle="modal" data-target="#exampleModal2"
      data-whatever="@mdo">Edit information</button>
    <br />
    <br>

    <div class = "card">
      <div class = "card-body">

    <?php include_once('./connection.php'); ?>
    <table class="table table-dark">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Product Name</th>
          <th scope="col">Description</th>
          <th scope="col">Image</th>
          <th scope="col"></th>
        </tr>
      </thead>
      <?php
          $query = "SELECT * FROM products";
          $query_run = mysqli_query($connection, $query);

          if($query_run){
            foreach($query_run as $row){
       ?>
      <tbody>
        <tr>
          <th scope="row">1</th>
          <td><?php echo $row["id_product"];?> </td>
          <td><?php echo $row["productName"];?> </td>
          <td><?php echo $row["Description"];?> </td>
          <td><?php echo $row["image"];?> </td>
          <td>
            <a href="InfoPage.html"><button type="button" class="btn btn-success btn-sm">View</button></a>
            <button type="button" class="btn btn-primary btn-sm editData" data-toggle="modal" data-target="#exampleModal3"
              data-whatever="@mdo">Edit</button>
            <button type="button" class="btn btn-danger btn-sm deleteData" data-toggle="modal" data-target="#exampleModal4"
              data-whatever="@mdo">Delete</button>
          </td>
        </tr>
      </tbody>
      <?php
            }
          }
          else{
            echo "No Record Found";
          }

       ?>
    </table>
    </div>
  </div>
    <!--Add Product modal-->
    <form method="POST" action="#">
      <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Add Product</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form>
                <div class="form-group">
                  <label for="recipient-name" class="col-form-label">Product Name:</label>
                  <input type="text" class="form-control" name="productName" id="recipient-name">
                </div>
                <div class="form-group">
                  <label for="message-text" class="col-form-label">Description:</label>
                  <textarea class="form-control" name="Description" id="message-text"></textarea>
                </div>
                <div class="form-group">
                  <label for="recipient-name" class="col-form-label">Insert Image:</label>
                  <input type="file" class="form-control"  name="photo" id="recipient-name">
                </div>
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="button" name="addData" class="btn btn-primary">Add Product</button>
            </div>
          </div>
        </div>
      </div>
      <!--Edit Info modal-->
      <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Edit information</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form metod="POST" action="#">
              <input type="hidden" name="update_id">
                <div class="form-group">
                  <label for="recipient-name" class="col-form-label">Full Name:</label>
                  <input type="text" class="form-control" name="fullName" id="fullName">
                </div>
                <div class="form-group">
                  <label for="message-text" class="col-form-label">Birth Date:</label>
                  <input type="date" class="form-control" name="birthDate" id="birthDate">
                </div>
                <div class="form-group">
                  <label for="recipient-name" class="col-form-label">Email:</label>
                  <input type="text" class="form-control" name="email" id="email">
                </div>
                <div class="form-group">
                  <label for="message-text" class="col-form-label">Password:</label>
                  <input type="password" class="form-control" name="userPassword" id="userPassword">
                </div>
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="button" name="editInfo" name="updatedata" class="btn btn-primary">Save Changes</button>
            </div>
          </div>
        </div>
      </div>
      <!--Edit Product modal-->
      <div class="modal fade" id="exampleModal3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Edit Product</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            <form metod="POST" action="#">
              <input type="hidden" name="update_id">
                <div class="form-group">
                  <label for="recipient-name" class="col-form-label">Product Name:</label>
                  <input type="text" class="form-control" name = "productName" id = "productName">
                </div>
                <div class="form-group">
                  <label for="message-text" class="col-form-label">Description:</label>
                  <textarea class="form-control" name = "Description" id = "Description"></textarea>
                </div>
                <div class="form-group">
                  <label for="recipient-name" class="col-form-label">Insert Image:</label>
                  <input type="file" class="form-control" name = "image" id = "image"">
                </div>
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="button" name="editData" name="updatedata" class="btn btn-primary">Save Changes</button>
            </div>
          </div>
        </div>
      </div>

      <!--Delete Product modal-->
      <div class="modal fade" id="exampleModal4" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Delete Product</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form metod="POST" action="#">
            <div class="modal-body">
            <input type="hidden" name="delete_id">
              Are you sure you want to delete the product?
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-success" data-dismiss="modal">Yes</button>
              <button type="button" name="deleteData" class="btn btn-danger deleteData">No</button>
            </div>
          </div>
        </div>
      </div>
    </form>
  </div>


<script>
$(document).ready(function(){
  $('.editInfo').on('click', function(){

    $('#exampleModal2').modal('show');

    $tr = $(this).closest('tr');
    vardata = $tr.children("td").map(function(){
      return $(this).text();
    }).get();

    console.log(data);

    $('#id_users').val(data[0]);
    $('#fullName').val(data[1]);
    $('#birthDate').val(data[2]);
    $('#email').val(data[3]);
    $('#id_userPassword').val(data[4]);
  })
})
</script>

<script>
$(document).ready(function(){
  $('.editData').on('click', function(){

    $('#exampleModal3').modal('show');

    $tr = $(this).closest('tr');
    vardata = $tr.children("td").map(function(){
      return $(this).text();
    }).get();

    console.log(data);

    $('#id_product').val(data[0]);
    $('#productName').val(data[1]);
    $('#Description').val(data[2]);
    $('#image').val(data[3]);
  })
})

</script>

<script>
$(document).ready(function(){
  $('.deleteData').on('click', function(){

    $('#exampleModal4').modal('show');

    $tr = $(this).closest('tr');
    vardata = $tr.children("td").map(function(){
      return $(this).text();
    }).get();

    console.log(data);

    $('#delete_id').val(data[0]);
  })
})

</script>

</body>

</html>