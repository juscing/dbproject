<?php

require_once('conf/config.php');
require_once(ROOT_PATH . 'db/dbconnect.php');

function queryDB($mT) {
	#$db_connection = DbUtil::loginConnection();
	$db_connection = new mysqli('stardock.cs.virginia.edu', 'cs4750jci5kb', 'moviedbgroup', 'cs4750jci5kb');
	if (mysqli_connect_errno()) {
		echo "connection error";
		return;
	}

	echo "Connection successful";

	$stmt = $db_connection->stmt_init();
	if ($stmt->prepare("select * from `Movie` where `title` = '$mT'")) {

		$stmt->execute();
		$stmt->bind_result($id, $title, $genreResponse, $uRating, $releaseYear, $runtime, $cRating);

		echo "<table>";
		echo "<tr><th>Title</th><th>Genre</th><th>User Rating</th><th>Year</th><th>Runtime</th><th>Critic Rating</th></tr>";

		while($stmt->fetch()) {
			echo "<tr>";
			echo("<td>" . $title . "</td>\n");
			echo("<td>" . $genreResponse . "</td>\n");
			echo("<td>" . $uRating . "</td>\n");
			echo("<td>" . $releaseYear . "</td>\n");
			echo("<td>" . $runtime . "</td>\n");
			echo("<td>" . $cRating . "</td>\n");
		}
		echo "</table>";

	}
}

	
#$actorName = $_POST['actor'];
$movieTitle = $_GET['title'];
#$directorName = $_POST['director'];
#$keyword = $_POST['keyword'];
#$genre = $_POST['genre'];
#$year = $_POST['Year'];

#print "actor: $actorName";
#print "movie: $movieTitle";
#print "director: $directorName";
#print "keyword: $keyword";

queryDB($movieTitle);

?>