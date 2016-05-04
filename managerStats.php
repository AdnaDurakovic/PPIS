<script>
  function setProductData(data) {
  	return data;
  }
</script>


<?php
  require "base.php";

  $db = InitBase();

  $query = "SELECT Month(kp.DatumKupovine) 'Mjesec', Sum(k.Kolicina) 'Kolicina'
            FROM kupovina k, kupovinaproizvoda kp
            WHERE kp.DatumKupovine >= CURDATE() - INTERVAL 1 YEAR AND k.KupovinaID = kp.KupovinaID
            GROUP BY Month(kp.DatumKupovine)";

  $statement = $db->prepare($query);
  $statement->execute();

  $productData = [0,0,0,0,0,0];
  $allproductData = [0,0,0,0,0,0,0,0,0,0,0,0];
  while ($u = $statement->fetch(PDO::FETCH_ASSOC))
  {
    $productData[$u["Mjesec"]-1] = $u["Kolicina"];
    $allProductData[$u["Mjesec"]-1] = $u["Kolicina"];
  }

  echo '<script language="javascript">';
  echo 'var productData = setProductData('.json_encode($productData).');';
  echo '</script>';
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
    <link href="css/styles.css" rel="stylesheet">

    <!-- JavaScript -->
    <script src="js/managerPanel.js"></script>
    <script src="js/chart.min.js"></script>
    <script src="js/chart-data.js"></script>
    <script src="js/easypiechart.js"></script>
    <script src="js/easypiechart-data.js"></script>
    <script src="js/jquery-1.11.1.min.js"></script>
    <script src="js/bootstrap.mini.js"></script>
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

  <div class="row">
    <div class="col-lg-12">
      <div class="panel panel-default">
        <div class="panel-heading">Polugodišnji pregled prodaje</div>
        <div class="panel-body">
          <div class="canvas-wrapper">
            <canvas class="main-chart" id="line-chart" height="200" width="600"></canvas>
          </div>
        </div>
      </div>
    </div>
  </div><!--/.row-->


<script>
  var monthNames = ["Januar", "Februar", "Mart", "April", "Maj", "Juni",
    "Juli", "August", "Septembar", "Oktobar", "Novembar", "Decembar"];

  var d = new Date();
</script>

<div id="demo">
  <h1>Statistike proizvoda</h1>
  <br>

  <!-- Responsive table starts here -->
  <!-- For correct display on small screens you must add 'data-title' to each 'td' in your table -->
  <div class="table-responsive-vertical shadow-z-1">
  <!-- Table starts here -->
  <table id="table" class="table table-hover table-mc-light-blue">
      <thead>
        <tr>
          <th><script>document.write(monthNames[d.getMonth()-1])</script></th>
          <th><script>document.write(monthNames[d.getMonth()])</script></th>
          <th><script>document.write(monthNames[d.getMonth()+1])</script></th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <?php
            $trenutni = $allProductData[date('n')-1];
            $prosli = $allProductData[date('n')-2];
            $razlika = $trenutni - $prosli;
            if ($razlika < 0) {
              if ($trenutni == 0) { $proc = 0.00000000000001;}
				      else { $proc = $trenutni/100; }

              $proc_razlika = ((-1)*$razlika/$proc)/2;
              $naredni = $trenutni - ($proc_razlika/100)*$trenutni;
            }
            else {
              $proc = $trenutni/100;
              $proc_razlika = ($razlika/$proc)/2;
              $naredni = $trenutni + ($proc_razlika/100)*$trenutni;
            }

          ?>
          <td data-title="Prošli mjesec"><?php echo $allProductData[date('n')-2] ?></td>
          <td data-title="Trenutni mjesec"><?php echo $allProductData[date('n')-1] ?></td>
          <td data-title="Naredni mjesec"><?php echo $naredni ?></td>
        </tr>
      </tbody>
    </table>
  </div>
</div>


<?php
  $kapacitetSkladista = 1000;

  $query = "SELECT Sum(Kolicina) 'Kolicina' FROM skladisteproizvoda";

  $statement = $db->prepare($query);
  $statement->execute();

  $u = $statement->fetch(PDO::FETCH_ASSOC);
  $zauzeto = $u['Kolicina']/10;
?>
<br>
<br>
<div class="panel panel-default">
  <div class="panel-body easypiechart-panel">
    <h4>Popunjenost skladišta</h4>
    <div class="easypiechart" id="easypiechart-blue" data-percent="92" ><span class="percent"><?php echo $zauzeto ?>%</span>
    </div>
  </div>
</div>








</body>

</html>
