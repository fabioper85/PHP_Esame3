<?php

include "include/getConnection.php";
include "include/functions.php";

$sensor_id = (isset($_GET)) ? $_GET['sensor_id'] : $sensor_id = '';

$db = connect($dbData);
$samples = getSamples($db, $sensor_id);

// echo "<pre>";
// print_r($samples);

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Sensore <?= $sensor_id; ?> - Samples</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300,300i,700|Raleway:400,400i,500,500i,700,700i|Roboto+Condensed:400,400i,700,700i|Roboto:300i,400,400i,700,700i,900,900i" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/samples.css">
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  </head>
  <body>
    <div class="container">
      <?php
        printSamples($samples);
      ?>
    </div>
    <div class="mini-footer">
      <div class="container">
        <a href="index.php">Back to home</a>
        <a id="moreSensors" href="sensors.php">More sensors</a>
      </div>
    </div>
    <script type="text/javascript" src="js/main.js"></script>
  </body>
</html>
