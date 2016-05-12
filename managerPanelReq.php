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

    <!-- JavaScript -->
    <script src="js/managerPanel.js"></script>

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
                      <a href="managerPanelReq.php">Zahtjevi za kupovinom</a>
                  </li>
                  <li>
                      <!--<a href="evaluateArticles.php">Pregled stanja</a>-->
                  </li>

        <!--jer mi je mrsko css -->
                  <li>
                  <a href=""></a>
                  </li>
                  <li>
                  <a href=""></a>
                  </li>
                  <li>
                  <a href=""></a>
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

<?php
  require "base.php";

  $db = InitBase();

  $sql1 = "SELECT KupovinaID,ProizvodID,Kolicina FROM kupovina";
  $sql2 = "SELECT Naziv,Kolicina FROM skladisteproizvoda WHERE ProizvodID = :pid";
  $sql3 = "SELECT NazivKupca FROM kupovinaproizvoda WHERE KupovinaID = :kid";


  $statement = $db->prepare($sql1);
  $statement->execute();

 ?>
<div id="demo">
  <h1>Zahtjevi za kupovinom proizvoda</h1>
  <br>

  <!-- Responsive table starts here -->
  <!-- For correct display on small screens you must add 'data-title' to each 'td' in your table -->
  <div class="table-responsive-vertical shadow-z-1">
  <!-- Table starts here -->
  <table id="table" class="table table-hover table-mc-light-blue">
      <thead>
        <tr>
          <th>Naziv proizvoda</th>
          <th>Kupljeno (artikala)</th>
          <th>Kupac</th>
          <!--<th>Stanje</th>-->

        </tr>
      </thead>
      <tbody>
          
            <?php
      while ($u = $statement->fetch(PDO::FETCH_ASSOC))
      {
        $kid = $u['KupovinaID'];
        $pid = $u['ProizvodID'];
        $kol = $u['Kolicina'];

        $q = $db->prepare($sql2);
        $q->bindParam(":pid", $pid);
        $q->execute();
        $proizvodi = $q->fetchAll(PDO::FETCH_ASSOC);
        foreach ($proizvodi as $p) {
            $nazivp = $p['Naziv'];
            $kolicinap = $p['Kolicina'];
        }
/*
        $stanje = "";
        if ($kolicinap > $kol) {
          $stanje = "NA STANJU";
        }
        else
        {
          $razlika = $kol - $kolicinap;
          $stanje = "POTREBNO ".$razlika." ARTIKALA";
        }
*/
        $s = $db->prepare($sql3);
        $s->bindParam(":kid", $kid);
        $s->execute();
        
        $kupacdata = $s->fetchAll(PDO::FETCH_ASSOC);
        foreach ($kupacdata as $k) {

            $kupac = $k['NazivKupca'];
            /*
            $email = $k['Email'];
            $telefon = $k['Telefon'];
            $datum = $k['DatumKupovine'];
            */
        }
        
      ?>
      <tr> 
      
            <td data-title="Naziv"><?php echo $nazivp;?></td>
            <td data-title="Kupljeno"><?php echo $kol;?></td>
            <?php
        print '<td data-title="Kupac"><a href="shopDetails.php?kupovinaId='.urldecode($kid).'">'.$kupac.'</a></td>'
      ?>
            <!--
            <td data-title="Email"><?php echo $email;?></td>
      <td data-title="Telefon"><?php echo $telefon;?></td>
      <td data-title="Datum kupovine"><?php echo $datum;?></td>
      
            <td data-title="Stanje">(<?php echo $kolicinap;?>)&nbsp<?php echo $stanje;?></td>
-->
            </tr>
            <?php 
            } 
            ?>
          
      </tbody>
    </table>
  </div>

<?php
    $sql = "SELECT p.Naziv, Sum(k.Kolicina) Ukupno, p.Kolicina FROM kupovina k, skladisteproizvoda p WHERE p.ProizvodID=k.ProizvodID GROUP BY p.Naziv";
    $b = InitBase();
    $stmt = $b->prepare($sql);
    $stmt->execute();
  ?>

  <br>
  <h1>Procjena narudžbi</h1>
  <br>
  <!-- Responsive table starts here -->
  <!-- For correct display on small screens you must add 'data-title' to each 'td' in your table -->
  <div class="table-responsive-vertical shadow-z-1">
  <!-- Table starts here -->
  <table id="table" class="table table-hover table-mc-light-blue">
      <thead>
        <tr>
          <th>Naziv proizvoda</th>
          <th>Ukupno kupljeno artikala</th>
          <th>Stanje u skladištu</th>
          <th>Potrebno napraviti</th>

        </tr>
      </thead>
      <tbody>
          
            <?php
      while ($a = $stmt->fetch(PDO::FETCH_ASSOC))
      {
        $nazivproizvoda = $a['Naziv'];
        $ukupno = $a['Ukupno'];
        $uskladistu = $a['Kolicina'];
        $naruciti = 0;
        if ($uskladistu < $ukupno) {
          $naruciti = $ukupno - $uskladistu;
        }
      ?>
      <tr> 
            <td data-title="Naziv"><?php echo $nazivproizvoda;?></td>
            <td data-title="Ukupno prodato"><?php echo $ukupno;?></td>
            <td data-title="Stanje u skladištu"><?php echo $uskladistu;?>
            <td data-title="Potrebno"><?php echo $naruciti;?>
            </tr>
            <?php 
            } 
            ?>
          
      </tbody>
    </table>
  </div>


</div>
</body>

</html>
