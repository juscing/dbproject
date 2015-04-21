<?php

session_start();
require_once('../conf/config.php');
require_once(ROOT_PATH . 'db/dbconnect.php');

function queryDB($offset) {
	$user = "";
	if(isset($_SESSION['user'])) {
		$user = $_SESSION['user'];
	}
	$db_connection = DbUtil::loginConnection();
	$offset = intval($offset, $base = 10);
	$query = "SELECT first_name, last_name, username, Actor.actor_id FROM `Actor` LEFT JOIN (SELECT * FROM `Favorite_Actors` WHERE username = ?) AS faves ON Actor.actor_id = faves.actor_id LIMIT 20 OFFSET ?";
	if ($stmt = $db_connection->prepare($query)) {
		$stmt->bind_param("si", $user, $offset);
		$stmt->execute();
		$stmt->bind_result($fname, $lname, $user, $id);
		$count = 0;
		if($offset == 0) {
			echo '<div id="scroller"><h1>Actors</h1>';
		}
		$stmt->store_result();
		if($stmt->num_rows > 0) {
			echo '<table class="table table-striped">';
			echo "<tr>";
			echo("<th>" . "First Name" . "</th>\n");
			echo("<th>" . "Last Name" . "</th>\n");
			if(isset($_SESSION['user'])) {
				echo("<th>" . "Favorite" . "</th>\n");
			}
			echo "</tr>";		
		}
		while($stmt->fetch()) {			
			echo "<tr>";
			echo("<td>" . $fname . "</td>\n");
			echo("<td>" . $lname . "</td>\n");
			if(isset($_SESSION['user'])) {
				echo('<td><a href="favactor.php?actor='.$id.'" class="star ');
				if(empty($user)) {
					echo "notfav";				
				} else {
					echo "fav";				
				}
				echo '"></a></td>';
			}
			echo "</tr>";
		}
		if($stmt->num_rows > 0) {
		echo '<tr style="display:none;">';
			$new_offset = $offset + 20;
			echo('<td><a class="jscroll-next" href="php/actorPage.php?offset=' . $new_offset . '">Offset</a></td>');
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