<?php

include "config.php";

function connect($dbData){
	try
	{
		static $db;
		if (!isset($db))
		{
			$db = new PDO($dbData['dns'], $dbData['user'], $dbData['pwd']);
		}
		return $db;
	}
	catch (PDOException $e)
	{
	  echo "ERRORE!" . $e->getMessage() . "<br/>";
	  die();
	}
}

?>
