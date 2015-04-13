<?php

require_once('../conf/config.php');
require_once(ROOT_PATH . 'db/dbconnect.php');

function queryDB($mT) {
	#$db_connection = DbUtil::loginConnection();
	$db_connection = new mysqli('stardock.cs.virginia.edu', 'cs4750jci5kb', 'moviedbgroup', 'cs4750jci5kb');
	if (mysqli_connect_errno()) {
		echo "connection error";
		return;
	}

	$stmt = $db_connection->stmt_init();
	if ($stmt->prepare("SELECT * FROM `Movie` WHERE `title` LIKE '$mT%'")) {

		$stmt->execute();
		$stmt->bind_result($id, $title, $genreResponse, $uRating, $releaseYear, $runtime, $cRating);

		echo "<table>";
		while($stmt->fetch()) {
			echo "<tr>";
			echo("<td>" . $title . "</td>\n");
		}
		echo "</table>";
	}
}

queryDB($_GET['title']);

?>