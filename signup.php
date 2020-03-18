<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


  <title>WebLoggerSignUp</title>

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">


  <!-- Custom styles for this template -->
  <link href="style.css" rel="stylesheet">

  <?php
  session_start();
  session_unset();
  include "dbconnect.php";
  if ($_SERVER['REQUEST_METHOD'] = 'POST') {
    //set variable
    session_unset();
    $errcheck = 0;
    $errmessage = "";
    $account = $_POST['account'];
    $CWID = $_POST['CWID'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $passwrd = $_POST['password'];
    //check duplicates account name
    $dupesql = "SELECT username FROM users WHERE username ='$account' ";
    $duperaw = mysqli_query($db, $dupesql);
    $dupesql2 = "SELECT CWID FROM users WHERE CWID ='$CWID' ";
    $duperaw2 = mysqli_query($db, $dupesql2);
    if (mysqli_num_rows($duperaw) > 0) {
      $errmessage = "user name has already exists";
      $_SESSION['message'] = 'user name has already exists';
      $errcheck = 1;
    }
    //check duplicates CWID
    else if (mysqli_num_rows($duperaw2) > 0) {
      $errmessage = "CWID has already exists";
      $_SESSION['message'] = 'CWID has already exists';
      $errcheck = 1;
    }
    //password mathes
    else if ($_POST['password'] != $_POST['repassword']) {
      $errmessage = "password not match";
      $_SESSION['message'] = 'password not match';
      $errcheck = 1;
    }

    if ($errcheck == 0) {
      // $sql= "INSERT INTO users VALUES ('$account',  '$CWID', '$firstname', '$lastname' ,' $passwrd') ";
      $sql = "INSERT INTO users VALUES (?,?,?,?,?) ";
      //creat account into database

      $stmt = $db->prepare($sql);
      $stmt->bind_param('issss', $CWID, $firstname, $lastname, $account,  $passwrd);
      $stmt->execute();

      if ($stmt->affected_rows > 0) {
        $message = 'registration succesful!';
        header("location: login.php?message=$message");
        exit;
      } else {
        // $_SESSION['message']= 'An error has occurred';
        $errmessage = "An error has occurred";
      }
    }
  }
  ?>
</head>

<body class="text-center">
  <form class="form-signin" action="signup.php" method="post">
    <img class="mb-4" src="wlicon.png" alt="" width="72" height="72">
    <h1 class="h3 mb-3 font-weight-normal">Creat an account</h1>

    <div class="alert alert-light" role="alert"> <?= $_SESSION['message'] ?></div>

    <input type="acount" name="account" class="form-control" placeholder="Account name" required="" autofocus="">

    <input type="CWID" name="CWID" class="form-control" placeholder="CWID" required="">

    <input type="firstname" name="firstname" class="form-control" placeholder="First name" required="">

    <input type="lastname" name="lastname" class="form-control" placeholder="Last name" required="">

    <input type="password" name="password" class="form-control" placeholder="Password" required="">

    <input type="password" name="repassword" class="form-control" placeholder="Confirm Password" required="">


    <button class="btn btn-lg btn-primary btn-block" type="submit" name="signup">Creat Account</button>
    <p class="mt-5 mb-3 text-muted">© 2020</p>
  </form>
  <?php

  ?>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>