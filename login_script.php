<?php

  require "base.php";


  // Sanitize incoming username and password
  $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
  $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);

  // Connect to the MySQL server
  $db = InitBase();

  // Determine whether an account exists matching this username and password
  $stmt = $db->prepare("SELECT Tip FROM menadzer WHERE Username = :username AND Password = :password");

  // Bind the input parameters to the prepared statement
  $stmt->bindParam(':username', $username, PDO::PARAM_STR);
  $stmt->bindParam(':password', $password, PDO::PARAM_STR);

  // Execute the query
  $stmt->execute();

  $number_of_rows = $stmt->rowCount();


  if ($number_of_rows == 1) {

  // Bind the returned user ID to the $id variable
  $tip = $stmt->fetchColumn();



  session_start();

  $_SESSION['username'] = $username;

  // Redirect the user to the home page
  if ($tip == 1)
    header('Location: managerPanel.php');
  else if ($tip == 2)
    header('Location: managerPanelReq.php');
}
else {
  header("Location: login_error.php");
  die();
}

?>
