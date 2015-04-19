<?php

require_once('../conf/config.php');
require_once(ROOT_PATH . 'db/dbconnect.php');

function queryDB($offset) {
	$db_connection = DbUtil::loginConnection();
	$offset = intval($offset, $base = 10);
	if ($stmt = $db_connection->prepare("SELECT director_first_name, director_last_name FROM `Director` LIMIT 20 OFFSET ?")) {
		$stmt->bind_param("i", $offset);
		$stmt->execute();
		$stmt->bind_result($fname, $lname);
		$count = 0;
		if($offset == 0) {
			echo '<div id="scroller"><h1>Directors</h1>';
		}
		$stmt->store_result();
		if($stmt->num_rows > 0) {
			echo '<table class="table table-striped">';
			echo "<tr>";
			echo("<th>" . "First Name" . "</th>\n");
			echo("<th>" . "Last Name" . "</th>\n");
			echo "</tr>";		
		}
		while($stmt->fetch()) {			
			echo "<tr>";
			echo("<td>" . $fname . "</td>\n");
			echo("<td>" . $lname . "</td>\n");
			echo "</tr>";
		}
		if($stmt->num_rows > 0) {
		echo '<tr style="display:none;">';
			$new_offset = $offset + 20;
			echo('<td><a class="jscroll-next" href="php/directorPage.php?offset=' . $new_offset . '">Offset</a></td>');
			echo "</tr>";
		echo "</table>";
		} else {
			echo "<p>No more results!</p>";
		}
		if($offset == 0) {
			echo '</div>';
		}
	}
}

if(isset($_GET['offset'])) {
	queryDB(trim($_GET['offset']));
} else {
	queryDB(0);
}

?>