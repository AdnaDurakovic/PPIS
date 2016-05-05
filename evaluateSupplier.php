<?php
	require "base.php";
	$supplierId = $_GET['suppId'];
	$supplierName = $_GET['suppName'];

	$oki=true;
	$db = InitBase();
	if (isset ($_REQUEST["evaluacija"])) {

    	$sel11 = $_REQUEST["sel11"];
		$sel12 = $_REQUEST["sel12"];
		$sel13 = $_REQUEST["sel13"];
		$sel21 = $_REQUEST["sel21"];
		$sel22 = $_REQUEST["sel22"];
		$sel23 = $_REQUEST["sel23"];
		$sel31 = $_REQUEST["sel31"];
		$sel32 = $_REQUEST["sel32"];
		$sel33 = $_REQUEST["sel33"];
		$sel41 = $_REQUEST["sel41"];
		$sel42 = $_REQUEST["sel42"];

		$ocjena = ($sel11 + $sel12 + $sel13 + $sel21 + $sel22 + $sel23 + $sel31 + $sel32 + $sel33 + $sel41 + $sel42)/11;
		//echo "<script>alert (".$supplierId.");</script>";

		$b = InitBase();
		//retardiranost na nivou...
        $u = $b->prepare("UPDATE `dobavljac` SET Ocjena = '$ocjena' WHERE DobavljacID = '$supplierId'");
        //$u->bindParam(":oc", $ocjena, PDO::PARAM_STR);
        //$u->bindParam(":dobId", $suppId, PDO::PARAM_INT);
        $u->execute();

        if($u->rowCount() == 0)
        	echo "<script>alert ('Dobavljac nije uspjesno evaluiran!');</script>";
        if (!$u) {
        	$oki=false;
            echo "{\"status\":\"NotOK\",\"message\":\"Došlo je do greške prilikom konektovanja na bazu!\"}";
            exit (2);
        }
        if ($oki)
		    echo "<script>alert ('Dobavljac uspjesno evaluiran!');</script>";
		}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">

    <title>ManagerPanel | Woody</title>

    <!-- CSS -->
    <link href="css/managerPanel.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/heroic-features.css" rel="stylesheet">
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="css/evaluation.css">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  

	<style>
	body {
	  padding-top: 70px;
	}
	</style>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/shop-homepage.css" rel="stylesheet">
    <link rel="stylesheet" href="css/login.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
  	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
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
          <a class="navbar-brand" href="#">Woody</a>
      </div>
      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav">
              <li>
                  <a href="managerPanel.php">Panel</a>
              </li>
              <li>
                  <a href="managerStats.php">Stats</a>
              </li>
              <li>
                  <a href="managerSuppliers.php">Suppliers</a>
              </li>
<!--
              <li>
                  <div class="dummy"></div>
              </li>
-->
                <?php session_start(); ?>

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


          </ul>
      </div>
      <!-- /.navbar-collapse -->
  </div>
  <!-- /.container -->
  </nav>

<!-- Page Content -->
<div class="container">
  <h3>Evaluacija dobavljača <?php echo $supplierName; ?></h3>
  <?php
  	print '<form role="form" id="frm_evaluacija" method="post" action="evaluateSupplier.php?suppId='.$supplierId.'&suppName='.$supplierName.'">'
  ?>
  	<input type="hidden" name="evaluacija" value="1">
    <div class="form-group">

<!-- EVALUACIJA KVALITETA -->
	  <h4>1. Evaluacija kvaliteta</h4><br>
      <h5>A. Kvalitet isporučenih proizvoda – broj reklamacija u odnosu na broj dobava</h5>
      <select class="form-control" id="sel11" name="sel11">
        <option>1</option>
        <option>2</option>
        <option>3</option>
        <option>4</option>
        <option>5</option>
        <option>6</option>
        <option>7</option>
        <option>8</option>
        <option>9</option>
        <option>10</option>
      </select><br>

      <h5>B. Priložena prateća dokumentacija</h5>
      <select class="form-control" id="sel12" name="sel12">
        <option>1</option>
        <option>2</option>
        <option>3</option>
        <option>4</option>
        <option>5</option>
        <option>6</option>
        <option>7</option>
        <option>8</option>
        <option>9</option>
        <option>10</option>
      </select><br>

      <h5>C. Odzivnost pri rješavanju reklamacija – evaluacija se ogleda u odzivu dobavljača i njegovom aktivnoj saradnji u rješavanju reklamacija</h5>
      <select class="form-control" id="sel13" name="sel13">
        <option>1</option>
        <option>2</option>
        <option>3</option>
        <option>4</option>
        <option>5</option>
        <option>6</option>
        <option>7</option>
        <option>8</option>
        <option>9</option>
        <option>10</option>
      </select><br><br>

<!-- LOGISTIKA -->
      <h4>2. Logistika</h4><br>
      <h5>A. Ostvarenje željenog datuma isporuke – mogućnost dobavljača da odgovori na zahtjeve dobave u pogledu kvaliteta proizvoda, datuma dobave i dogovorene količine</h5>
      <select class="form-control" id="sel21" name="sel21">
        <option>1</option>
        <option>2</option>
        <option>3</option>
        <option>4</option>
        <option>5</option>
        <option>6</option>
        <option>7</option>
        <option>8</option>
        <option>9</option>
        <option>10</option>
      </select><br>

      <h5>B. Odgovor na zahtjev – priprema ponude u dogovorenom roku</h5>
      <select class="form-control" id="sel22" name="sel22">
        <option>1</option>
        <option>2</option>
        <option>3</option>
        <option>4</option>
        <option>5</option>
        <option>6</option>
        <option>7</option>
        <option>8</option>
        <option>9</option>
        <option>10</option>
      </select><br>

      <h5>C. Ispunjavanje ekoloških zahtjeva – dobavljač ima standard ISO14001, tj. ispunjava ekološke zahtjeve na način da nema negativan utjecaj na okolinu</h5>
      <select class="form-control" id="sel23" name="sel23">
        <option>1</option>
        <option>2</option>
        <option>3</option>
        <option>4</option>
        <option>5</option>
        <option>6</option>
        <option>7</option>
        <option>8</option>
        <option>9</option>
        <option>10</option>
      </select><br><br>


<!-- USLOVI PLAĆANJA -->
      <h4>3. Uslovi plaćanja</h4><br>
      <h5>A. Cijena, lako dokazljiva na osnovu komparativne analize konkuretskih ponuda</h5>
      <select class="form-control" id="sel31" name="sel31">
        <option>1</option>
        <option>2</option>
        <option>3</option>
        <option>4</option>
        <option>5</option>
        <option>6</option>
        <option>7</option>
        <option>8</option>
        <option>9</option>
        <option>10</option>
      </select><br>

      <h5>B. Rok plaćanja</h5>
      <select class="form-control" id="sel32" name="sel32">
        <option>1</option>
        <option>2</option>
        <option>3</option>
        <option>4</option>
        <option>5</option>
        <option>6</option>
        <option>7</option>
        <option>8</option>
        <option>9</option>
        <option>10</option>
      </select><br>

      <h5>C. Inicijative za smanjivanje troškova – broj bodova koji se odobrava u skladu sa prijedlozima dobavljača za smanjenje troškova logistike, prijedlozi za zamjenu materijala i slično</h5>
      <select class="form-control" id="sel33" name="sel33">
        <option>1</option>
        <option>2</option>
        <option>3</option>
        <option>4</option>
        <option>5</option>
        <option>6</option>
        <option>7</option>
        <option>8</option>
        <option>9</option>
        <option>10</option>
      </select><br><br>



<!-- TEHNIČKA PODRŠKA -->
      <h4>4. Tehnička podrška</h4><br>
      <h5>A. Postojeća tehnička podrška – pružanje tehničke podrške ovisno o kompleksnosti proizvoda, pravovremeno obavljanje promjena i dopuna u procesu proizvodnje proizvoda od strane nabavljača</h5>
      <select class="form-control" id="sel41" name="sel41">
        <option>1</option>
        <option>2</option>
        <option>3</option>
        <option>4</option>
        <option>5</option>
        <option>6</option>
        <option>7</option>
        <option>8</option>
        <option>9</option>
        <option>10</option>
      </select><br>

      <h5>B. Spremnost da učestvuje u fazi razvoja proizvoda – dobavljač je spreman da učestvuje u fazi razvoja proizvoda i u proizvodnji prvih uzoraka (prototip)</h5>
      <select class="form-control" id="sel42" name="sel42">
        <option>1</option>
        <option>2</option>
        <option>3</option>
        <option>4</option>
        <option>5</option>
        <option>6</option>
        <option>7</option>
        <option>8</option>
        <option>9</option>
        <option>10</option>
      </select><br>

  	</div>
  	<input type="submit" id="ok" name="ok" class="btn btn-primary" value="Evaluiraj">
  </form>
</div>

<!-- /.container -->

</body>
</html>