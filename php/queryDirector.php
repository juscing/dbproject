<?php

require_once('../conf/config.php');
require_once(ROOT_PATH . 'db/dbconnect.php');

function queryDB($name) {
	$names = explode(" ", $name, 2);
	$firstname = $names[0];
	$condition = "OR";

	if (sizeof($names)<2) {
		$lastname=$firstname;
	} else if ($names[1] =="") {
		$lastname=$firstname;
	} else {
		$condition = "AND";
		$lastname=$names[1];
	}

	#$db_connection = DbUtil::loginConnection();
	$db_connection = new mysqli('stardock.cs.virginia.edu', 'cs4750jci5kb', 'moviedbgroup', 'cs4750jci5kb');
	if (mysqli_connect_errno()) {
		echo "connection error";
		return;
	}

	$stmt = $db_connection->stmt_init();
	# Change this to: stars with
	if ($stmt->prepare("SELECT director_first_name, director_last_name FROM `Director` WHERE `director_first_name` LIKE '$firstname%' ". $condition . "`director_last_name` LIKE '$lastname%'")) {

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

$director = $_GET['director'];
queryDB($director);
?>