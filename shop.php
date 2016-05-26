<?php

session_start();
require "base.php";

$db = InitBase();

$statement = $db->prepare("SELECT ProizvodID,Naziv,Cijena,Slika,Opis FROM skladisteproizvoda");
$statement->execute();


if (!isset($_SESSION["total"])) {

      $_SESSION["total"] = 0;

}
if (!isset($_SESSION["ukupno"])) {

      $_SESSION["ukupno"] = 0;

}



$total = $_SESSION["total"];
$ukupno = $_SESSION["ukupno"];
$nazivp = "debil";
?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="favicon.ico">

    <title>Shop | Woody</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/shop-homepage.css" rel="stylesheet">


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style type="text/css">
    .senpai {
        width: auto;
    }
    .buttonBlue {
      background: #4a89dc;
      text-shadow: 1px 1px 0 rgba(39, 110, 204, .5);
      float: right;
    }
    .buttonBluee a {
    text-decoration: none;
    color: #fff;
    }

    .buttonBluee {
        background: #4a89dc;
        border: 0;
        -webkit-font-smoothing: antialiased;
        border-bottom: 2px solid #3160B6;
        text-align: center;
        letter-spacing: 1px;
        vertical-align: middle;
        color: #fff;
        margin: .7em 0 1em 0;
        text-shadow: 1px 1px 0 rgba(39, 110, 204, .5);
        position: relative;
        display: inline-block;
        font-size: 14px;
        line-height: 20px;
        height: 30px;
        width: 100%;
        padding: 5px 30px;
    }

    .buttonBlue,.buttonBluee:hover { background: #357bd8; }

    .dummy {
        background: transparent;
        border: 0;
        margin: .6em 0 1em 0;
        position: relative;
        display: inline-block;
        height: 30px;
        width: 700px;
        padding: 5px 30px;
    }

    </style>

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

        <div class="row">

            <div class="col-md-3">
                <p class="lead"></p>

                <div class="list-group-item">
                    <h5>Korpa<br>_____________________________</h5>
                    <table style="width:100%">
                    <?php
                    
                    if (isset($_GET['nazivp'])&&isset($_GET['cijenap'])&&isset($_GET['idp'])&&isset($_GET['bla'])) {
                      $nazivp = $_GET['nazivp'];
                      $cijenap = $_GET['cijenap'];
                      $id = $_GET['idp'];
                      $kol = $_GET['kolicinap'];
                      $total = $total + $cijenap*$kol;

                      $_SESSION["nazivi"][$ukupno] = $nazivp;
                      $_SESSION["cijene"][$ukupno] = $cijenap;
                      $_SESSION["ids"][$ukupno] = $id;
                      $_SESSION["kolicine"][$ukupno] = $kol;

                      $ukupno = $ukupno + 1;

                      $_SESSION["ukupno"] = $ukupno;
                      $_SESSION["total"] = $total;
                    ?>

                    <?php
                    if (isset($_SESSION["nazivi"])) {

                    for ($k=0; $k < $ukupno; $k++) { ?>

                       <tr>
                        <td><?php echo $_SESSION["nazivi"][$k].'&nbsp&nbsp&nbsp&nbspx'.$_SESSION["kolicine"][$k]; ?></td>
                        <td align="right"><?php echo $_SESSION["cijene"][$k]; ?>KM</td>
                       </tr>

                    <?php
                    }
                    }
                  }
                

                    ?>
                    </table>

                    <h5>_____________________________</h5>

                    <table style="width:100%">
                      <tr>
                       <td id="h55">Ukupno:</td>
                       <td id="h55" align="right"><?php echo $_SESSION["total"]; ?>KM</td>
                      </tr>
                    </table>
                    <br>
                    <p>
                    <?php
                    $txtides = "";
                    if (isset($_SESSION["ids"])) {
                    	$ides = json_encode($_SESSION["ids"]);
                    	$txtides = urlencode($ides);
                    }
                    $txtkols = "";
                    if (isset($_SESSION["kolicine"])) {
                        $kols = json_encode($_SESSION["kolicine"]);
                        $txtkols = urlencode($kols);
                    }
                    	print '<a href="shopform.php?ids='.$txtides.'&kols='.$txtkols.'" class="btn btn-primary">Kupi</a>';

                    ?> 
                    </p>
                </div>
            </div>



            <div class="col-md-9">

                <div class="row carousel-holder">

                    <div class="col-md-12">
                        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                                <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                                <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                                <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                            </ol>
                            <div class="carousel-inner">
                                <div class="item active">
                                    <img class="slide-image" src="pics/1.jpg" alt="">
                                </div>
                                <div class="item">
                                    <img class="slide-image" src="pics/2.jpg" alt="">
                                </div>
                                <div class="item">
                                    <img class="slide-image" src="pics/3.jpg" alt="">
                                </div>
                            </div>
                            <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                                <span class="glyphicon glyphicon-chevron-left"></span>
                            </a>
                            <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                                <span class="glyphicon glyphicon-chevron-right"></span>
                            </a>
                        </div>
                    </div>

                </div>
                
                <div class="row">

                    <?php
                    while ($u = $statement->fetch(PDO::FETCH_ASSOC))
                    {
                        ?>
                        <div class="col-sm-4 col-lg-4 col-md-4">
                            <div class="thumbnail">
                            
                                <img src="pics/<?php echo $u["Slika"]?>" alt="">
                                <h4 class="pull-right"><?php echo $u["Cijena"]?> KM</h4>
                                <h4><a href="#"><?php echo $u["Naziv"]?></a>
                                </h4>
                                <div class="caption">
                                    <div class="inner">
                                      <p><?php echo $u["Opis"]?></p>
                                    </div>
                                </div>
                                <form action="shop.php" method="get" id="senpai" name="senpai">
                                <input id="kolicinap" name="kolicinap" type="number" value="0"/> 
                                <input id="nazivp" name="nazivp" type="hidden" value="<?php echo $u["Naziv"]?>"> 
                                <input id="idp" name="idp" type="hidden" value="<?php echo $u["ProizvodID"]?>"> 
                                <input id="cijenap" name="cijenap" type="hidden" value="<?php echo $u["Cijena"]?>"> 
                                <input id="bla" name="bla" type="hidden" value="1"> 
                                <!--<script type='text/javascript'>function getKol() {return document.getElementById('koll');}</script>-->
                                <p id="dodajbtn">
                                    <input type="submit" class="btn btn-primary" value="Dodaj">
                                </p>
                                </form>
                            </div>

                        </div>

                        <?php
                    }
                    ?>

                </div>

            </div>

        </div>

    </div>
    <!-- /.container -->

    <div class="container">

        <hr>

        <!-- Footer -->
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
