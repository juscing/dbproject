<?php

require_once('../conf/config.php');
require_once(ROOT_PATH . 'db/dbconnect.php');

function queryDB($arguments) {
	// Declarations
	$movieMap = array();

	//$db_connection = DbUtil::loginConnection();
	$db_connection = new mysqli('stardock.cs.virginia.edu', 'cs4750jci5kb', 'moviedbgroup', 'cs4750jci5kb');
	if (mysqli_connect_errno()) {
		echo "connection error";
		return;
	}

	// Build the Query
	$stmt = $db_connection->stmt_init();
	$query = "SELECT * from (`Actor` NATURAL JOIN `StarredIn` NATURAL JOIN `Movie` NATURAL JOIN `Directed` NATURAL JOIN `Director`) WHERE";
	foreach ($arguments as $key => $value) {
		$query=$query . " `" . $key . "` LIKE '" . $value . "' AND ";
	}
	$query=substr($query,0, -5);

	// Execute the Query
	if ($stmt->prepare($query)) {
		$stmt->execute();
		$stmt->bind_result($director_id, $movie_id, $actor_id, $fname, $lname, $mtitle, $genreResponse, $uRating, $releaseYear, $runtime, $cRating, $plot, $dfname, $dlname);

		while($stmt->fetch()) {
			$movieMap[$mtitle]["data"]["plot"] = $plot;
	      	$movieMap[$mtitle]["data"]["director"] = $dfname." ".$dlname;
			$movieMap[$mtitle]["data"]["cRating"] = $cRating;
			$movieMap[$mtitle]["data"]["runtime"] = $runtime;
			$movieMap[$mtitle]["data"]["releaseYear"] = $releaseYear;
			$movieMap[$mtitle]["data"]["uRating"] = $uRating;
			$movieMap[$mtitle]["data"]["genre"] = $genreResponse;
			$movieMap[$mtitle]["actors"][] = $fname." ".$lname;
    	}
    	foreach($movieMap as $title => $movie) {
			echo '<div class="featurette" id="about">';
	        echo '<img style="height:500px; width:500px;" class="featurette-image img-circle img-responsive pull-right" src='. "img/movies/". str_replace(' ','',$title).'.jpg>';
   	        //echo '<img class="featurette-image img-circle img-responsive pull-right" src="http://placehold.it/500x500">';
	        echo '<h2 class="featurette-heading">'.$title.'<span class="text-muted"></span></h2>';
	        echo '<p class="lead">'.$movieMap[$mtitle]["data"]["plot"].'</p>';
	       	echo '<p class="lead">Director: '.$movieMap[$mtitle]["data"]["director"].'</p>';
	        echo '<p class="lead">MetaCritic Rating: '.$movieMap[$mtitle]["data"]["cRating"].'</p>';
	        echo '<p class="lead">Release: '.$movieMap[$mtitle]["data"]["releaseYear"].'</p>';
	        echo '<p class="lead">User Ratings: '.$movieMap[$mtitle]["data"]["uRating"].'</p>';
	        echo '<p class="lead">Genre: '.$movieMap[$mtitle]["data"]["genre"].'</p>';
	        echo '<p class="lead">Actors: '.implode(', ', $movie["actors"]).'</p>';
	        echo '</div>';
	        echo '<hr class="featurette-divider">';
    		echo "<br><br>";
    	}
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
	$lastname="";
} else if ($names[1] =="") {
	$lastname="";
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

queryDB($params);
?>