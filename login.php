<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/docs/4.0/assets/img/favicons/favicon.ico">

    <title>WebLoggerSignin</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">


    <!-- Custom styles for this template -->
    <!--link href="signin.css" rel="stylesheet-->

    <style>
    .form-signin {
        width: 100%;
        max-width: 330px;
        padding: 15px;
        margin: 0 auto;
      }
      .form-signin .checkbox {
        font-weight: 400;
      }
      .form-signin .form-control {
        position: relative;
        box-sizing: border-box;
        height: auto;
        padding: 10px;
        font-size: 16px;
      }

      .form-signin .form-control:focus {
        z-index: 2;
      }

      .form-signin input [type="account"] {
        margin-bottom: -1px;
        border-bottom-right-radius: 0;
        border-bottom-left-radius: 0;
      }

      .form-signin input[type="password"] {
        margin-bottom: 10px;
        border-top-left-radius: 0;
        border-top-right-radius: 0;
      }
      </style>
  </head>

  <body class="text-center">
    <form class="form-signin">
      <img class="mb-4" src="wlicon.png" alt="" width="72" height="72">
      <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
      
      
      <input type="acount" id="useraccount" name="account" class="form-control" placeholder="Account name" required="" autofocus="">
      
      
      
      <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required="">
     
      <div class="checkbox mb-3">
        <label>
          <input type="checkbox" value="remember-me"> Remember me
        </label>
      </div>
      <button class="btn btn-lg btn-primary btn-block" type="submit" name="login">Sign in</button>
      <p class="mt-5 mb-3 text-muted">© 2020</p>
    </form>
  
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
        crossorigin="anonymous"></script>
</body>
</html>
<!-- mySQL API-->
<!--?php
include "dbconnect.php";
IF(ISSET($_POST['login'])){
$account = $_POST['account'];
$password = $_POST['password'];
$cek = mysql_num_rows(mysql_query("SELECT * FROM user_login WHERE account='$accout' AND password='$password'"));
$data = mysql_fetch_array(mysql_query("SELECT * FROM user_login WHERE account='$account' AND password='$password'"));
IF($cek > 0)
{
 session_start();
 $_SESSION['account'] = $data['account'];
 $_SESSION['name'] = $data['full_name'];
 echo "<script language=\"javascript\">alert(\"welcome \");document.location.href='index.php';</script>";
}else{
 echo "<script language=\"javascript\">alert(\"Invalid username or password\");document.location.href='login.php';</script>";
}
}
?-->