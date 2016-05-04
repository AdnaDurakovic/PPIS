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
                      <a href="managerPanel.php">Panel</a>
                  </li>
                  <li>
                      <a href="managerStats.php">Stats</a>
                  </li>
                  <li>
                      <a href="managerSuppliers.php">Stats</a>
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

  $statement = $db->prepare("SELECT ProizvodID,Naziv,Cijena,Kolicina,Opis FROM skladisteproizvoda");
  $statement->execute();
 ?>
<div id="demo">
  <h1>Stanje proizvoda na skladištu</h1>
  <br>

  <!-- Responsive table starts here -->
  <!-- For correct display on small screens you must add 'data-title' to each 'td' in your table -->
  <div class="table-responsive-vertical shadow-z-1">
  <!-- Table starts here -->
  <table id="table" class="table table-hover table-mc-light-blue">
      <thead>
        <tr>
          <th>ID</th>
          <th>Naziv</th>
          <th>Opis</th>
          <th>Količina</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody>
        <?php
          while ($u = $statement->fetch(PDO::FETCH_ASSOC))
          {
        ?>
              <tr>
                <td data-title="ID"><?php echo $u["ProizvodID"]?></td>
                <td data-title="Naziv"><?php echo $u["Naziv"]?></td>
                <td data-title="Opis"><?php echo $u["Opis"]?></td>
                <td data-title="Kolicina"><?php echo $u["Kolicina"]?></td>
                <?php if ($u["Kolicina"] > 0) { ?>
                  <td data-title="Status">Na stanju</td>
                <?php } else { ?>
                  <td id="nastanju" data-title="Status">Nema na stanju</td>
                <?php
                } ?>

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
