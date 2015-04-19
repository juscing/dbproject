<?php

require_once('../conf/config.php');
require_once(ROOT_PATH . 'db/dbconnect.php');

function queryDB($offset) {
	$db_connection = DbUtil::loginConnection();
	$offset = intval($offset, $base = 10);
	if ($stmt = $db_connection->prepare("SELECT first_name, last_name FROM `Actor` LIMIT 20 OFFSET ?")) {
		$stmt->bind_param("i", $offset);
		$stmt->execute();
		$stmt->bind_result($fname, $lname);
		
		echo "<h1>Actors</h1>";
		echo '<table class="table table-striped">';
		echo "<tr>";
			echo("<th>" . "First Name" . "</th>\n");
			echo("<th>" . "Last Name" . "</th>\n");
			echo "</tr>";
		while($stmt->fetch()) {
			echo "<tr>";
			echo("<td>" . $fname . "</td>\n");
			echo("<td>" . $lname . "</td>\n");
			echo "</tr>";
		}
		echo '<tr style="display:none;">';
			echo('<td><a class="jscroll-next" href="php/queryActor.php?offset=?' . (string)($offset + 20) . '">Offset</a></td>');
			echo "</tr>";
		echo "</table>";
	}
}

if(isset($_GET['offset'])) {
	queryDB(trim($_GET['offset']));
} else {
	queryDB(0);
}

?>