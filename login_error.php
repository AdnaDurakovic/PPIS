


<!DOCTYPE html>
<html >
  <head>
    <meta charset="UTF-8">
    <title>Login | Woody</title>
    <link rel="stylesheet" href="css/login.css">
      <!-- Bootstrap Core CSS -->
      <link href="css/bootstrap.min.css" rel="stylesheet">

      <!-- Custom CSS -->
      <link href="css/heroic-features.css" rel="stylesheet">
          <link rel="icon" href="favicon.ico">

</head>

  <body>

  <!-- Navigation -->
  <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
          <!-- Brand and toggle get grouped for better mobile display -->
          <div class="navbar-header">
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                  <span class="sr-only">Toggle navigation</span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="index.php">Woody</a>
          </div>
          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
              <ul class="nav navbar-nav">
                  <li>
                      <a href="#">About</a>
                  </li>
                  <li>
                      <a href="shop.php">Shop</a>
                  </li>
                  <li>
                      <a href="#">Contact</a>
                  </li>
                  <li>
                      <div class="dummy"></div>
                  </li>
                  <li>
                      <button type="button" class="buttonBluee"  onclick="location.href = 'login.php';">Login</button>
                  </li>
              </ul>


          </div>
          <!-- /.navbar-collapse -->
      </div>
      <!-- /.container -->
  </nav>

<form action="login_script.php" enctype="application/x-www-form-urlencoded" method="post">
  <div class="group">
    <input type="text" name="username"><span class="highlight"></span><span class="bar"></span>
    <label>Name</label>
  </div>
  <div class="group">
    <input type="password" name="password"><span class="highlight"></span><span class="bar"></span>
    <label>Password</label>
  </div>
  <div class="group">
    <label id="errorLogin">Greška! Podaci koje ste unijeli nisu ispravni.</label>
  </div>
<br><br>
  <input name="submit" type="submit" value="Login" class="button buttonBlue"/>
</form>


    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

        <script src="js/login.js"></script>

  </body>

  <style type="text/css">
  #errorLogin {
    color: red;
    font-size: 12px;
  }
  </style>

</html>
