<?php

require_once('../conf/config.php');
require_once(ROOT_PATH . 'db/dbconnect.php');

function queryDB($mT) {
	$db_connection = DbUtil::loginConnection();
	if (mysqli_connect_errno()) {
		echo "connection error";
		return;
	}
	//echo $mt;
	$stmt = $db_connection->stmt_init();
	if ($stmt->prepare("SELECT title FROM `Movie` WHERE `title` LIKE '%$mT%' LIMIT 5")) {

		$stmt->execute();
		$stmt->bind_result($title);

		echo "<table class=\"suggest\">";
		while($stmt->fetch()) {
			echo "<tr>";
			echo("<td>" . $title . "</td>\n");
		}
		echo "</table>";
	}
}

queryDB($_GET['title']);

?>