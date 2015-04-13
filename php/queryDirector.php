<?php

require_once('../conf/config.php');
require_once(ROOT_PATH . 'db/dbconnect.php');

function queryDB($dN) {
	#$db_connection = DbUtil::loginConnection();
	$db_connection = new mysqli('stardock.cs.virginia.edu', 'cs4750jci5kb', 'moviedbgroup', 'cs4750jci5kb');
	if (mysqli_connect_errno()) {
		echo "connection error";
		return;
	}

	$stmt = $db_connection->stmt_init();
	if ($stmt->prepare("SELECT name FROM `Director` WHERE `name` LIKE '$dN%'")) {

		$stmt->execute();
		$stmt->bind_result($name);

		echo "<table>";
		while($stmt->fetch()) {
			echo "<tr>";
			echo("<td>" . $name . "</td>\n");
		}
		echo "</table>";

	}
}

$director = $_GET['director'];
queryDB($director);
?>