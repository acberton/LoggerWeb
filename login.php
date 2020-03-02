<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


  <title>WebLoggerSignin</title>

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">


  <!-- Custom styles for this template -->
  <link href="style.css" rel="stylesheet">


</head>

<body class="text-center">
  <form class="form-signin" action="homepage.php" method="post">
    <img class="mb-4" src="wlicon.png" alt="" width="72" height="72">
    <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
    <div class="alert alert-light" role="alert"> <?php if (isset($_GET['message'])) {
                                                    echo $_GET['message'];
                                                  } ?></div>
    <input type="acount" id="useraccount" name="account" class="form-control" placeholder="Account name" required="" autofocus="">

    <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required="">

    <div class="checkbox mb-3">
      <label>
        <input type="checkbox" value="remember-me"> Remember me
      </label>
    </div>
    <button class="btn btn-lg btn-primary btn-block" type="submit" name="login">Sign in</button>

  </form>
  <div class="d-flex justify-content-center links">
    Don't have an account?<a href="signup.php">Sign Up</a>
  </div>
  <p class="mt-5 mb-3 text-muted">© 2020</p>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>