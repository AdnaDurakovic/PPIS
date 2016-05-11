<?php
require "base.php";

session_start();
session_destroy();

$db = InitBase();

$statement = $db->prepare("SELECT Naziv,Cijena,Slika,Opis FROM skladisteproizvoda");
$statement->execute();

?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Home | Woody</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/heroic-features.css" rel="stylesheet">
    <link rel="stylesheet" href="css/login.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

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
                    <a href="shop.php
                    ">Shop</a>
                </li>
                <li>
                    <a href="#">Contact</a>
                </li>
                <li>
                    <div class="dummy"></div>
                </li>
                <li>
                  <?php session_start(); ?>

                  <?php if (isset($_SESSION['username'])) { ?>
                  <p>Welcome back, <?= $_SESSION['username']; ?>!</p>
                  <button type="button" class="buttonBluee"  onclick="location.href = 'logout.php';">Logout</button>
                  <?php } else { ?>

                  <button type="button" class="buttonBluee"  onclick="location.href = 'login.php';">Login</button>

                  <?php } ?>




                </li>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>

<!-- Page Content -->
<div class="container">

    <!-- Jumbotron Header -->
    <header class="jumbotron hero-spacer">
        <h1>A Warm Welcome!</h1>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsa, ipsam, eligendi, in quo sunt possimus non incidunt odit vero aliquid similique quaerat nam nobis illo aspernatur vitae fugiat numquam repellat.</p>
        <p><a class="btn btn-primary btn-large">Call to action!</a>
        </p>
    </header>

    <hr>


    <!-- Title -->

    <!-- /.row -->

    <!-- Page Features -->
    <div class="row text-center">

      <?php
      $i = 0;
      // ispisuje samo četiri proizvoda iz baze :) da ne bude pretrpana početna stranica
        while ($i<4)
        {
          $u = $statement->fetch(PDO::FETCH_ASSOC)
          ?>
          <div class="col-md-3 col-sm-6 hero-feature">
              <div class="thumbnail">
                  <img src="pics/<?php echo $u["Slika"]?>" alt="">
                  <div class="caption">
                      <h3><?php echo $u["Naziv"]?></h3>
                      <p><?php echo $u["Opis"]?></p>
                  </div>
              </div>
          </div>
          <?php
          $i = $i + 1;
        }
       ?>


<!--
        <div class="col-md-3 col-sm-6 hero-feature">
            <div class="thumbnail">
                <img src="pics/5.jpg" alt="">
                <div class="caption">
                    <h3>Feature Label</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>

                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-6 hero-feature">
            <div class="thumbnail">
                <img src="pics/6.jpg" alt="">
                <div class="caption">
                    <h3>Feature Label</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>

                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-6 hero-feature">
            <div class="thumbnail">
                <img src="pics/7.jpg" alt="">
                <div class="caption">
                    <h3>Feature Label</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>

                </div>
            </div>
        </div>
-->
        <div><a href="shop.php">Više proizvoda</a></div>

    </div>


    <hr>


    <footer>
        <div class="row">
            <div class="col-lg-12">
                <p>Copyright &copy; PPIS Tim 8 2016</p>
            </div>
        </div>
    </footer>

</div>
<!-- /.container -->

<!-- jQuery -->
<script src="js/jquery.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>

</body>

</html>
