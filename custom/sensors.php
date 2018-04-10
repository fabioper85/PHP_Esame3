<?php

include "include/getConnection.php";
include "include/functions.php";

$db = connect($dbData);

$sensors = getSensors($db);

// echo "<pre>";
// print_r($sensors);

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Sensors</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300,300i,700|Raleway:400,400i,500,500i,700,700i|Roboto+Condensed:400,400i,700,700i|Roboto:300i,400,400i,700,700i,900,900i" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/samples.css">
    <link rel="stylesheet" href="css/sensors.css">
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  </head>
  <body>
    <div class="container">
      <h1>Elenco Sensori</h1>
      <?php printSensori($sensors); ?>
    </div>
  </body>
</html>
