<?php
error_reporting(E_ALL);
session_start();
require "base.php";
$oki = false;
$db = InitBase();
if (isset ($_REQUEST["dodavanje"])) {
    if (!isset($_SESSION['username'])) {
        echo "{\"status\":\"NotOK\",\"message\":\"Vasa sesija je istekla!!\"}";
        exit (2);
    }
    $dobavljac = $_REQUEST["dobavljac"];
    $email = $_REQUEST["email"];
    $tel = $_REQUEST["telefon"];
    $adresa = $_REQUEST["adresa"];
    $racun = $_REQUEST["racun"];
    //$ocjena = intval($_REQUEST["ocjena"]);
    $opis = $_REQUEST["opis"];


    if ($_FILES["ugovor"]["name"]) {
        $filename = $_FILES["ugovor"]["name"];
        $source = $_FILES["ugovor"]["tmp_name"];
        $type = $_FILES["ugovor"]["type"];
        $name = explode(".", $filename);
        $okay = true;
        if (strtolower($name[count($name) - 1]) != 'pdf') {
            echo "{\"status\":\"NotOK\",\"message\":\"Dozvoljen je upload samo PDF fajlova!\"}";
            exit (3);
        }
        $folder = "ugovori/";
        if (!file_exists($folder)) #ukoliko folder ne postoji, kreirajmo ga
            mkdir($folder);

        #sada dodajemo dobavljaca u tabelu, da iskoristimo njegov ID kao ime ugovora (unikatno, zar ne? :D)
        $b = InitBase();
        $u = $b->prepare("INSERT INTO dobavljac (Naziv, Telefon, Email, Adresa, TekuciRacun, Opis) VALUES (:d, :t, :e, :a, :r, :op)");
        $u->bindParam(":d", $dobavljac);
        $u->bindParam(":t", $tel);
        $u->bindParam(":e", $email);
        $u->bindParam(":a", $adresa);
        $u->bindParam(":r", $racun);
        $u->bindParam(":op", $opis);
        //$u->bindParam(":oc", $ocjena);
        $u->execute();
        if (!$u) {
            echo "{\"status\":\"NotOK\",\"message\":\"Došlo je do greške prilikom konektovanja na bazu!\"}";
            exit (2);
        }
        $lid = $b->lastInsertId(); #treba nam last inserted id zbog imena fajla kao i Ugovor tabele
        $filename = "ugovor_{$lid}.pdf"; #ime je u formatu "ugovor_ID.pdf"
        $target_path = $folder . $filename;
        if (move_uploaded_file($source, $target_path)) {
            #ok, uploadovali smo fajl, sad ga treba ubaciti u tabelu Ugovor
            $b = InitBase();
            $u = $b->prepare("INSERT INTO ugovor (DobavljacID, Path) VALUES (:did, :p)");
            $u->bindParam(":did", $lid);
            $u->bindParam(":p", $target_path);
            $u->execute();
            if (!$u) {
                echo "{\"status\":\"NotOK\",\"message\":\"Došlo je do greške prilikom konektovanja na bazu (ne radi ubacivanje ugovora u bazu)!\"}";
                exit (6);
            }
            //echo "{\"status\":\"OK\"}";

            $oki = true;
        } else {
            echo "{\"status\":\"NotOK\",\"message\":\"Problem sa uploadom!!\"}";
            exit (2);
        }


    }
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
        <link rel="icon" href="favicon.ico">


    <title>Add Supplier | Woody</title>

    <link href="css/style.css" rel="stylesheet">

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/shop-homepage.css" rel="stylesheet">
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="css/addSupplier.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<?php if (!isset($_SESSION['username']))
{
Greska("Vasa sesija je istekla; molimo prijavite se ponovo: <button type=\"button\" class=\"buttonBluee\"  onclick=\"location.href = 'login.php';\">Login</button>");
exit (16);
}
?>

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
                    <a href="managerSuppliers.php">Manager | Suppliers</a>
                </li>
                <li>
                    <a href="#">Contact</a>
                </li>
                <li>



                    <?php if (isset($_SESSION['username'])) { ?>
                <li>
                    <div id="dummyy"></div>
                </li>
                <li>
                    <p id="welcomeuser">Welcome back, <?= $_SESSION['username']; ?>!</p><br>
                </li>
                <li>
                    <button type="button" class="buttonBluee"  onclick="location.href = 'logout.php';">Logout</button>
                </li>
                <?php } else { ?>
                    <li>
                        <div class="dummy"></div>
                    </li>
                    <li>
                        <button type="button" class="buttonBluee"  onclick="location.href = 'login.php';">Login</button>
                    </li>

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

    <div class="col-md-9">
        <form class="form-horizontal frmwidth" id="frm_dodavanje" method="post" enctype="multipart/form-data" action="addSupplier.php">
            <input type="hidden" name="dodavanje" value="1">
            <fieldset>

                <!-- Form Name -->
                <legend>Dodavanje dobavljača</legend>

                <!-- Text input-->
                <div class="form-group">
                    <label class="col-md-5 control-label" for="dobavljac">Dobavljač</label>
                    <div class="col-md-5">
                        <input id="dobavljac" name="dobavljac" placeholder="Dobavljac" class="form-control input-md" required="" type="text">
                        <span class="help-block">Naziv dobavljača</span>
                    </div>
                </div>

                <!-- Text input-->
                <div class="form-group">
                    <label class="col-md-5 control-label" for="email">Email</label>
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
                    <label class="col-md-5 control-label" for="adresa">Adresa</label>
                    <div class="col-md-5">
                        <input id="adresa" name="adresa" placeholder="Zmaja od Bosne, BB" class="form-control input-md" required="" type="text" value="">
                        <span class="help-block">Adresa dobavljača</span>
                    </div>
                </div>
                <!-- Text input-->
                <div class="form-group">
                    <label class="col-md-5 control-label" for="racun">Tekući račun</label>
                    <div class="col-md-5">
                        <input id="racun" name="racun" placeholder="0000154700552" class="form-control input-md" required="" type="text" value="">
                        <span class="help-block">Tekući račun dobavljača</span>
                    </div>
                </div>

                <!-- Text input
                <div class="form-group">
                    <label class="col-md-5 control-label" for="ocjena">Ocjena</label>
                    <div class="col-md-5">
                        <select name="ocjena" id="ocjena">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5" selected="selected">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                            <option value="10">10</option>
                        </select>
                        <span class="help-block">Ocjena dobavljača (radi evaluacije istog)</span>
                    </div>
                </div>
                <!-- Text input-->
                <div class="form-group">
                    <label class="col-md-5 control-label" for="ugovor">Ugovor</label>
                    <div class="col-md-5">
                        <input type="file" id="ugovor" name="ugovor">
                        <span class="help-block">Ugovor s dobavljačem (format: <b>PDF</b>)</span>
                    </div>
                </div>

                <!-- Text input-->
                <div class="form-group">
                    <label class="col-md-5 control-label" for="opis">Opis</label>
                    <div class="col-md-5">
                        <textarea name="opis" cols="25" id="opis"></textarea>
                        <span class="help-block">Opis dobavljača (može biti prazno)</span>
                    </div>
                </div>

                <!-- Button -->
                <div class="form-group">
                    <label class="col-md-8 control-label" for="ok"></label>
                    <div class="col-md-2">
                        <input type="submit" id="ok" name="ok" class="btn btn-primary" value="Dodaj">
                    </div>
                </div>

            </fieldset>
        </form>
    </div>

</div>
<!-- /.container -->
<?php
   if ($oki)
    echo "<script>alert ('Dobavljac uspjesno dodan!');</script>";
?>
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
