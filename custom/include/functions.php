<?php

function getSensori($db)
{
  $dbh = $db->query("SELECT * FROM sensors");
  $result = $dbh->fetchAll();
  return $result;
}



function getSensors($db)
{
  $dbh = $db->query("SELECT * FROM sensors ORDER BY active DESC");
  $result = $dbh->fetchAll();
  return $result;
}




function getSamples($db, $id)
{
  $dbh = $db->query("SELECT samples.*, sensors.code FROM samples LEFT JOIN sensors ON samples.sensor_id=sensors.id WHERE sensor_id=$id ORDER BY datetime DESC");
  $result = $dbh->fetchAll();
  return $result;
}




function activeSensor($db, $id)
{
  $query = "UPDATE sensors SET active=1 WHERE id=:id";
  $prepare = $db->prepare($query);
  $prepare->bindValue(':id', $id);
  $exec = $prepare->execute();
}



function deactiveSensor($db, $id)
{
  $query = "UPDATE sensors SET active=0 WHERE id=:id";
  $prepare = $db->prepare($query);
  $prepare->bindValue(':id', $id);
  $exec = $prepare->execute();
}




function printSensori($sensori)
{
  if(count($sensori) > 0)
  {
    echo "<table class='table table-hover'>";
    echo "<thead>";
    echo "<tr>";
    echo "<th scope='col'>Id Sensore</th>";
    echo "<th scope='col'>Codice sensore</th>";
    echo "<th scope='col'>Location</th>";
    echo "<th scope='col'>Stato</th>";
    echo "<th scope='col' class='text-center'>Rilevamenti</th>";
    echo "</tr>";
    echo "</thead>";
    foreach ($sensori as $sensore)
    {
      echo "<tbody>";
      echo "<tr>";
      echo "<td>".$sensore['id']."</td>";
      echo "<td>".$sensore['code']."</td>";
      echo "<td>".$sensore['location']."</td>";
      if(!$sensore['active'])
      {
        echo "<td>Inattivo</td>";
      }

      if($sensore['active'])
      {
        echo "<td>Attivo</td>";
      }
      echo "<td class='text-center'><a class='btn btn-primary mostraInfo' href='samples.php?sensor_id=".$sensore['id']."'>mostra</button></td>";
    }
    echo "</tr>";
    echo "</tbody>";
    echo "</table>";
  }
  else
  {
    echo "<p>no sensors</p>";
  }
}




function printSamples($samples)
{
  if( count($samples) > 0 )
  {
    echo "<h1>Sensore ".$samples[0]['sensor_id']."</h1>";
    echo "<p>Codice: <b><i>".$samples[0]['code']."</i></b></p>";
    echo "<table class='table table-hover'>";
    echo "<thead>";
    echo "<tr>";
    echo "<th scope='col'>Id Sample</th>";
    echo "<th scope='col'>Data</th>";
    echo "<th scope='col'>Valore</th>";
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";
    foreach ($samples as $sample)
    {
      echo "<tr>";
      echo "<td class='sensor_id'>".$sample['id']."</td>";
      echo "<td>".$sample['datetime']."</td>";
      echo "<td>".$sample['value']."</td>";
      echo "</tr>";
    }
    echo "</tbody>";
    echo "</table>";
  }
  if( count($samples) < 1 )
  {
    echo "<p>Siamo spiacenti, non sono presenti rilevamenti per il sensore selezionato</p>";
    echo "<p>Stai per essere reindirizzato alla pagina principale di <a href='index.php'>3BMeteo</a> in <span id='counter'>5</span> secondi</p>";
  }
  // sleep(2);
  // header('Location: index.php');
}

function printSensoriIndex($sensori)
{
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
          echo "<td class='text-center'><a class='btn btn-primary mostraInfo' href='samples.php?sensor_id=".$sensore['id']."'>mostra</button></td>";
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
          echo "<td class='text-center'><a class='btn btn-primary mostraInfo' href='samples.php?sensor_id=".$sensore['id']."'>mostra</button></td>";
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
}

?>
