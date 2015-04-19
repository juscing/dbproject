<?php

require_once('../conf/config.php');
require_once(ROOT_PATH . 'db/dbconnect.php');

function queryDB($firstname, $lastname) {
	#$db_connection = DbUtil::loginConnection();
	$db_connection = new mysqli('stardock.cs.virginia.edu', 'cs4750jci5kb', 'moviedbgroup', 'cs4750jci5kb');
	if (mysqli_connect_errno()) {
		echo "connection error";
		return;
	}

	$stmt = $db_connection->stmt_init();
	# Change this to: stars with
	if ($stmt->prepare("SELECT first_name, last_name FROM `Actor` WHERE `first_name` LIKE '$actor%' OR `last_name` LIKE '$actor%'")) {

		$stmt->execute();
		$stmt->bind_result($fname, $lname);

		echo "<table>";
		while($stmt->fetch()) {
			echo "<tr>";
			echo("<td>" . $fname . " ". $lname."</td>\n");
		}
		echo "</table>";
	}
}

queryDB($_GET['actor']);
?>