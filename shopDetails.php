<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <link rel="icon" href="favicon.ico">


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
                      <!-- <a href="sendEmail.php">Email</a> -->
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

  $kid = $_GET['kupovinaId'];

  $db = InitBase();
  $sql = "SELECT NazivKupca,Email,Telefon,DatumKupovine FROM kupovinaproizvoda WHERE KupovinaID = :kid";
  $statement = $db->prepare($sql);
  $statement->bindParam(":kid", $kid);
  $statement->execute();


 ?>
<div id="demo">
  <h1>Podaci o kupcu</h1>
  <br>

  <!-- Responsive table starts here -->
  <!-- For correct display on small screens you must add 'data-title' to each 'td' in your table -->
  <div class="table-responsive-vertical shadow-z-1">
  <!-- Table starts here -->
  <table id="table" class="table table-hover table-mc-light-blue">
      <thead>
        <tr>
          <th>Naziv kupca</th>
          <th>Email</th>
          <th>Telefon</th>
          <th>Datum kupovine</th>
        </tr>
      </thead>
      <tbody>
          	<?php
			while ($u = $statement->fetch(PDO::FETCH_ASSOC))			
			{
				$kupac = $u['NazivKupca'];
				$email = $u['Email'];
				$telefon = $u['Telefon'];		
				$datumkupovine = $u['DatumKupovine'];		
			?>
			<tr> 
			
            <td data-title="Kupac"><?php echo $kupac;?></td>
            <td data-title="Email"><?php echo $email;?></td>
            <td data-title="Telefon"><?php echo $telefon;?></td>
            <td data-title="Datum kupovine"><?php echo $datumkupovine;?></td>
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
