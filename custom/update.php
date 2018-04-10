<?php

include "include/getConnection.php";
include "include/functions.php";

$db = connect($dbData);

$sensor_id = (isset($_GET['sensor_id'])) ? $_GET['sensor_id'] : '';
$state = (isset($_GET['state'])) ? $_GET['state'] : '';

// echo $sensor_id;
// echo $state;

if($state == 0)
{
  activeSensor($db, $sensor_id);
}

if($state == 1)
{
  deactiveSensor($db, $sensor_id);
}

$sensori = getSensori($db);
printSensoriIndex($sensori);

?>
