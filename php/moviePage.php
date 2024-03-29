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
	$queryuser = "SELECT watches.username, faves.username, Movie.movie_id, title, genre, year, runtime, user_rating, critic_rating FROM `Movie` LEFT JOIN (SELECT * FROM `Favorites` WHERE username = ?) AS faves ON Movie.movie_id = faves.movie_id LEFT JOIN (SELECT * FROM `Watch` WHERE username = ?) AS watches ON Movie.movie_id = watches.movie_id LIMIT 20 OFFSET ?";
	if ($stmt = $db_connection->prepare($queryuser)) {
		$stmt->bind_param("ssi", $user, $user, $offset);
		$stmt->execute();
		$stmt->bind_result($userw, $userf, $id, $title, $genre, $year, $runtime, $user_rating, $critic_rating);
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
			if(isset($_SESSION['user'])) {
				echo("<th>" . "Favorite" . "</th>\n");
				echo("<th>" . "Watch List" . "</th>\n");
			}
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
			if(isset($_SESSION['user'])) {
				echo('<td><a href="favmovie.php?movie='.$id.'" class="star ');
				if(empty($userf)) {
					echo "notfav";				
				} else {
					echo "fav";				
				}
				echo '"></a></td>';
				echo('<td><a href="watchlater.php?movie='.$id.'" class="plus ');
				if(empty($userw)) {
					echo "notwat";				
				} else {
					echo "wat";				
				}
				echo '"></a></td>';
			}
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