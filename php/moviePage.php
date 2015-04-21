<?php

require_once('../conf/config.php');
require_once(ROOT_PATH . 'db/dbconnect.php');

function queryDB($offset) {
	$db_connection = DbUtil::loginConnection();
	$offset = intval($offset, $base = 10);
	if ($stmt = $db_connection->prepare("SELECT movie_id, title, genre, year, runtime, user_rating, critic_rating FROM `Movie` LIMIT 20 OFFSET ?")) {
		$stmt->bind_param("i", $offset);
		$stmt->execute();
		$stmt->bind_result($id, $title, $genre, $year, $runtime, $user_rating, $critic_rating);
		$count = 0;
		if($offset == 0) {
			echo '<div id="scroller"><h1>Movies</h1>';
		}
		$stmt->store_result();
		if($stmt->num_rows > 0) {
			echo '<table class="table table-striped">';
			echo "<tr>";
			echo("<th>" . "Title" . "</th>\n");
			echo("<th>" . "Genre" . "</th>\n");
			echo("<th>" . "Year" . "</th>\n");
			echo("<th>" . "Runtime" . "</th>\n");
			echo("<th>" . "User Rating" . "</th>\n");
			echo("<th>" . "Critic Rating" . "</th>\n");
			echo "</tr>";		
		}
		while($stmt->fetch()) {			
			echo "<tr>";
			echo('<td><a class="ajaxlink" href="movie.php?movie='.$id.'">'. $title . "</a></td>\n");
			echo("<td>" . $genre . "</td>\n");
			echo("<td>" . $year . "</td>\n");
			echo("<td>" . $runtime . "</td>\n");
			echo("<td>" . $user_rating . "</td>\n");
			echo("<td>" . $critic_rating . "</td>\n");
			echo "</tr>";
		}
		if($stmt->num_rows > 0) {
		echo '<tr style="display:none;">';
			$new_offset = $offset + 20;
			echo('<td><a class="jscroll-next" href="php/moviePage.php?offset=' . $new_offset . '">Offset</a></td>');
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