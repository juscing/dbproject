<?php

require_once('../conf/config.php');
require_once(ROOT_PATH . 'db/dbconnect.php');

function queryDB($arguments) {
	//$db_connection = DbUtil::loginConnection();
	$db_connection = new mysqli('stardock.cs.virginia.edu', 'cs4750jci5kb', 'moviedbgroup', 'cs4750jci5kb');
	if (mysqli_connect_errno()) {
		echo "connection error";
		return;
	}

	$stmt = $db_connection->stmt_init();
	if ($stmt->prepare("SELECT * from (Actor NATURAL JOIN StarredIn NATURAL JOIN Movie NATURAL JOIN Directed NATURAL JOIN Director) WHERE `title` = '$mT'")) {

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

// Array
$params = array();

//$actorName = $_POST['actor'];
$movieTitle = $_GET['title'];
$actor = $_GET['actor'];
$director = $_GET['director'];
//$keyword = $_GET['keyword'];
//$movieTitle = $_GET['title'];
//$movieTitle = $_GET['title'];

if (strlen($movieTitle)>0) {
	$params['title']= "%$movieTitle%";
} 

if (strlen($actor)>0) {
	$params['first_name']= "%$actor%";
	$params['last_name']= "%$actor";
} 

if (strlen($director)>0) {
	$params['director_first_name']= "%$director%";
	$params['last_name']= "%$director";
} 

foreach ($params as $key => $value) {
	echo "Key: $key; Value: $value<br />\n";
}

queryDB($movieTitle);

?>