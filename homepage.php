<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous"></head>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <link href="homepage.css" rel="stylesheet">
<?php
$account=$_POST['account'];
$passwrd=$_POST['password'];
include 'dbconnect.php';
$sql = "SELECT * from users where username = '$account' and password='$passwrd'";
$result = mysqli_query($db ,$sql);
if (mysqli_num_rows($result) > 0 ){
//output id# of login user
    $row = mysqli_fetch_assoc($result);
        
}

?> 
</head>
<body>
<div class="container">
<header class="blog-header py-3">
    <div class="row flex-nowrap justify-content-between align-items-center">
      <div class="col-4 pt-1">
        <a class="text-muted" href=""><?php echo "login as " .$row["firstname"] ." ".$row["lastname"]." CWID:".$row["CWID"] ; ?></a>
      </div>
      <div class="col-5 text-center">
        <a class="blog-header-logo text-dark" href="">Dashboard</a>
      </div>
      <div class="col-3 d-flex justify-content-between ">


        <a class="btn btn-sm btn-outline-secondary" href="">Notifications <span class="badge badge-light">0</span> </a>

        

        <a class="btn btn-sm btn-outline-secondary" href="login.php">Log Out</a>
      </div>
    </div>
  </header>
  <div class="nav-scroller py-1 mb-2">
    <nav class="nav d-flex justify-content-between">
      <a class="p-2 text-muted" href="">Home</a>
      <a class="p-2 text-muted" href="">Class</a>
      
    </nav>
  </div>

  <button type="button" class="btn btn-default btn-sm">
  <h5>Add Class  <i class="fas fa-calendar-plus"></i></h5>  
  </button>

<div class="card-deck">

    <div class="col-4">

  <div class="card">
  <div class="card-header">CSPC362</div>
    <div class="card-body">
      <h5 class="card-title">Assignment1</h5>
      <p class="card-text">text.</p>
      <p class="card-text"><small class="text-muted">Due 3/9/2020</small></p>
      <a href="#" class="btn btn-primary">Edit</a>
    </div>
    </div>

  </div>
  <div class="col-4">

  <div class="card">
  <div class="card-header">Class</div>
    <div class="card-body">
      <h5 class="card-title">task</h5>
      <p class="card-text">detail</p>
      <p class="card-text"><small class="text-muted">date</small></p>
      <a href="#" class="btn btn-primary">Edit</a>
      </div>
    </div>

  </div>
  <div class="col-4">

  <div class="card">
  <div class="card-header">Class</div>
    <div class="card-body">
      <h5 class="card-title">task</h5>
      <p class="card-text">detail.</p>
      <p class="card-text"><small class="text-muted">date</small></p>
      <a href="#" class="btn btn-primary">Edit</a>
    </div>
    </div>

    <br>
    <br>

  </div>
  <div class="card">
  <div class="card-header">Events</div>
    <div class="card-body">
      <h5 class="card-title">ECS Career Fair</h5>
      <p class="card-text">Location</p>
      <p class="card-text"><small class="text-muted">date</small></p>
      <a href="#" class="btn btn-primary">Edit</a>
    </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>