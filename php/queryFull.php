<?php

require_once('../conf/config.php');
require_once(ROOT_PATH . 'db/dbconnect.php');

function queryDB($arguments) {
	// Declarations
	$movieMap = array(
		$mTitle => array(
			"data" => array(),
			"actors" => array()
		)
	);

	#$movieMap["Shrek"]["data"]["genre"] = "Comedy";

	//$db_connection = DbUtil::loginConnection();
	$db_connection = new mysqli('stardock.cs.virginia.edu', 'cs4750jci5kb', 'moviedbgroup', 'cs4750jci5kb');
	if (mysqli_connect_errno()) {
		echo "connection error";
		return;
	}

	$stmt = $db_connection->stmt_init();
	$query = "SELECT * from (`Actor` NATURAL JOIN `StarredIn` NATURAL JOIN `Movie` NATURAL JOIN `Directed` NATURAL JOIN `Director`) WHERE";

	foreach ($arguments as $key => $value) {
		$query=$query . " `" . $key . "` LIKE '" . $value . "' AND ";
	}
	$query=substr($query,0, -5);
	echo $query;

	if ($stmt->prepare($query)) {

		$stmt->execute();
		$stmt->bind_result($director_id, $movie_id, $actor_id, $fname, $lname, $mtitle, $genreResponse, $uRating, $releaseYear, $runtime, $cRating, $plot, $dfname, $dlname);

		echo "<table>";
		echo "<tr><th>Title</th><th>Genre</th><th>User Rating</th><th>Year</th><th>Runtime</th><th>Critic Rating</th></tr>";

		while($stmt->fetch()) {
			echo "</table>";
			echo '<div class="featurette" id="about">';
	        echo '<img class="featurette-image img-circle img-responsive pull-right" src="http://placehold.it/500x500">';
	        echo '<h2 class="featurette-heading">'.$mtitle.'<span class="text-muted"></span></h2>';
	        echo '<p class="lead">Donec ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula porta felis euismod semper. Praesent commodo cursus magna, vel scelerisque nisl consectetur. Fusce dapibus, tellus ac cursus commodo.</p>';
	        echo '</div>';
	        echo '<hr class="featurette-divider">';

			$movieMap[$mtitle]["data"]["plot"] = $plot;
	      	$movieMap[$mtitle]["data"]["director"] = $dfname." ".$dlname;
			$movieMap[$mtitle]["data"]["cRating"] = $cRating;
			$movieMap[$mtitle]["data"]["runtime"] = $runtime;
			$movieMap[$mtitle]["data"]["releaseYear"] = $releaseYear;
			$movieMap[$mtitle]["data"]["uRating"] = $uRating;
			$movieMap[$mtitle]["data"]["genre"] = $genreResponse;
			$movieMap[$mtitle]["actors"][] = $fname." ".$lname;
    	}

    	for()
	}
}

// Array
$params = array();

// Grab Variables
$movieTitle = $_POST['title'];
$actor = $_POST['actor'];
$director = $_POST['director'];

// Split Actor into first and last name
$names = explode(" ", $actor, 2);
$firstname = $names[0];

if (sizeof($names)<2) {
	$lastname=$firstname;
} else if ($names[1] =="") {
	$lastname=$firstname;
} else {
	$lastname=$names[1];
}

// Split Director into first and last name
$names = explode(" ", $director, 2);
$director_firstname = $names[0];

if (sizeof($names)<2) {
	$director_lastname=$director_firstname;
} else if($names[1] == "") {
	$director_lastname=$firstname;
} else {
	$director_lastname=$names[1];
}

// Add non-Null values to parameters
if (strlen($movieTitle)>0) {
	$params['title']= "%$movieTitle%";
} 

if (strlen($actor)>0) {
	$params['first_name']= "%$firstname%";
	$params['last_name']= "%$lastname%";
} 

if (strlen($director)>0) {
	$params['director_first_name']= "%$director_firstname%";
	$params['director_last_name']= "%$director_lastname%";
} 

// Validation
foreach ($params as $key => $value) {
	echo "Key: $key; Value: $value<br />\n";
}

queryDB($params);
?>