<?php
error_reporting(E_ALL);
session_start();
require "base.php";

$db = InitBase();
if (isset ($_REQUEST["kupovina"]))
{
    $kupac = $_REQUEST["kupac"];
    $email = $_REQUEST["email"];
    $tel = $_REQUEST["telefon"];
    $naruzba = $_REQUEST["narudzba"];
    $b = InitBase();
    $u = $b->prepare("INSERT INTO kupovinaproizvoda (NazivKupca, Email, Telefon, DatumKupovine, KreiraoNarudzbenicu) VALUES (:k, :e, :t, NOW(), :n)");
    $u->bindParam(":k", $kupac);
    $u->bindParam(":e", $email);
    $u->bindParam(":t", $tel);
    $u->bindParam(":n", $naruzba);
    $u->execute();

    if (!$u)
    {
        echo "{\"status\":\"NotOK\",\"message\":\"Došlo je do greške prilikom konektovanja na bazu!\"}";
        exit (2);
    }
    echo "{\"status\":\"OK\"}";
    exit (0);

}
?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Shop | Woody</title>

    <link href="css/style.css" rel="stylesheet">

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/shop-homepage.css" rel="stylesheet">
    <link rel="stylesheet" href="css/login.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>
<div id="MsgOK" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">

    <div class="modal-dialog modal-sm">
        <div class="modal-content" id="MsgCnt">
            ...
        </div>
    </div>
</div>
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
                        <a href="shop.html">Shop</a>
                    </li>
                    <li>
                        <a href="#">Contact</a>
                    </li>
                    <li>
                        <div class="dummy"></div>
                    </li>
                    <li>
                        <button type="button" class="buttonBluee"> <a href="login.html">Login</a>
                        </button>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <!-- Page Content -->
    <div class="container">

        <div class="col-md-9 frmwidth">
                <form class="form-horizontal" id="kupovina">
                    <input type="hidden" name="kupovina" value="1">
                    <fieldset>

                        <!-- Form Name -->
                        <legend>Kupovina proizvoda</legend>

                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-md-5 control-label" for="textinput">Kupac</label>
                            <div class="col-md-5">
                                <input id="kupac" name="kupac" placeholder="Firma" class="form-control input-md" required="" type="text">
                                <span class="help-block">Naziv firme</span>
                            </div>
                        </div>

                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-md-5 control-label" for="textinput">Email</label>
                            <div class="col-md-5">
                                <input id="email" name="email" placeholder="primjer@mail.ba" class="form-control input-md" required="" type="email">

                            </div>
                        </div>

                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-md-5 control-label" for="telefon">Telefon</label>
                            <div class="col-md-5">
                                <input id="telefon" name="telefon" placeholder="+387" class="form-control input-md" required="" type="tel" value="+387">
                                <span class="help-block">Telefon u formatu +387XXXYYY</span>
                            </div>
                        </div>

                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-md-5 control-label" for="textinput">Kreirao narudžbu</label>
                            <div class="col-md-5">
                                <input id="narudzba" name="narudzba" placeholder="John" class="form-control input-md" required="" type="text">
                                <span class="help-block">Naziv kreatora narudžbe</span>
                            </div>
                        </div>

                        <!-- Button -->
                        <div class="form-group">
                            <label class="col-md-8 control-label" for="ok"></label>
                            <div class="col-md-2">
                                <input type="submit" id="ok" name="ok" class="btn btn-primary" value="Kupi">
                            </div>
                        </div>

                    </fieldset>
                </form>
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
    <script src="js/login.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
