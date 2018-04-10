<?php

include "include/getConnection.php";
include "include/functions.php";

$db = connect($dbData);
$sensori = getSensori($db);

// echo "<pre>";
// print_r($sensori);

?>

<!DOCTYPE html>
<html lang="it">
  <head>
    <meta charset="utf-8">
    <title>PHP_Esame3_3BMeteo</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300,300i,700|Raleway:400,400i,500,500i,700,700i|Roboto+Condensed:400,400i,700,700i|Roboto:300i,400,400i,700,700i,900,900i" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg fixed-top navbar-light bg-light" id="mainNav">
      <a class="navbar-brand" href="#">3BMeteo</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav">
          <!-- <li class="nav-item active">
            <a class="nav-link" href="index.php">Home<span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Link</a>
          </li> -->
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Control Manager
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="../cake/3BMeteo/sensors" target="_blank">Sensors</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="#">Samples</a>
            </div>
          </li>
          <!-- <li class="nav-item">
            <a class="nav-link disabled" href="#">Disabled</a>
          </li> -->
        </ul>
        <!-- <form class="form-inline my-2 my-lg-0">
          <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form> -->
      </div>
    </nav>
    <div class="container-fluid" id="jumbo-box">
      <div class="jumbotron">
        <h1 class="display-4">3BMeteo</h1>
        <p class="lead"><i>The best way to check the weather on the line</i></p>
        <p>by <a href="http://www.facebook.com/fabio.broad.mod" target="_blank">Fabio Perretta</a></p>
        <!-- <p class="lead">
          <a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a>
        </p> -->
      </div>
    </div>
    <div id="sensors-box">
      <?php

        if(count($sensori) > 0)
        {
          $countActives = 0;
          $countNotActives = 0;
          foreach ($sensori as $sensore)
          {
            if($sensore['active'] == 0)
            {
              $countNotActives++;
            }

            if($sensore['active'] == 1)
            {
              $countActives++;
            }
          }

          echo "<div class='activeSensorsBox'>";
          echo "<h5>Sensori Attivi</h5>";

          if($countActives > 0)
          {
            echo "<table class='table table-hover'>";
            echo "<thead>";
            echo "<tr>";
            echo "<th scope='col'>Id Sensore</th>";
            echo "<th scope='col'>Codice sensore</th>";
            echo "<th scope='col'>Location</th>";
            echo "<th scope='col' class='text-center'>Azioni</th>";
            echo "<th scope='col' class='text-center'>Info Sensore</th>";
            echo "</tr>";
            echo "</thead>";
            echo "<tbody>";
            foreach ($sensori as $sensore)
            {
              if($sensore['active'] == 1)
              {
                echo "<tr>";
                echo "<td>".$sensore['id']."</td>";
                echo "<td>".$sensore['code']."</td>";
                echo "<td>".$sensore['location']."</td>";
                echo "<td class='text-center'><button class='btn btn-danger ajaxBtn active' value='".$sensore['id']."'>Disattiva</button></td>";
                echo "<td class='text-center'><a class='btn btn-primary mostraInfo' href='samples.php?sensor_id=".$sensore['id']."'>mostra</a></td>";
                echo "</tr>";
              }
            }
            echo "</tbody>";
            echo "</table>";
          }
          else
          {
            echo "<p>Non sono presenti sensori attivi!</p>";
          }
          echo "</div>";



          echo "<div class='inactiveSensorsBox'>";
          echo "<h5>Sensori Non Attivi</h5>";

          if($countNotActives > 0)
          {
            echo "<table class='table table-hover'>";
            echo "<thead>";
            echo "<tr>";
            echo "<th scope='col'>Id Sensore</th>";
            echo "<th scope='col'>Codice sensore</th>";
            echo "<th scope='col'>Location</th>";
            echo "<th scope='col' class='text-center'>Azioni</th>";
            echo "<th scope='col' class='text-center'>Info Sensore</th>";
            echo "</tr>";
            echo "</thead>";
            echo "<tbody>";
            foreach ($sensori as $sensore)
            {
              if($sensore['active'] == 0)
              {
                echo "<tr>";
                echo "<td>".$sensore['id']."</td>";
                echo "<td>".$sensore['code']."</td>";
                echo "<td>".$sensore['location']."</td>";
                echo "<td class='text-center'><button class='btn btn-success ajaxBtn inactive' value='".$sensore['id']."'>Attiva</button></td>";
                echo "<td class='text-center'><a class='btn btn-primary mostraInfo' href='samples.php?sensor_id=".$sensore['id']."'>mostra</a></td>";
                echo "</tr>";
              }
            }
            echo "</tbody>";
            echo "</table>";
          }
          else
          {
            echo "<p>Non sono presenti sensori inattivi!</p>";
          }
          echo "</div>";
        }
        else {
          echo "<p>Non sono presenti dati da mostrare!</p>";
        }

      ?>
    </div>
    <script src="js/main.js" type="text/javascript"></script>
  </body>
</html>
