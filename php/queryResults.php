<?php

require_once('../conf/config.php');
require_once(ROOT_PATH . 'db/dbconnect.php');

function queryDB($arguments) {
	// Declarations
	$movieMap = array();
	$movies = array();

	//$db_connection = DbUtil::loginConnection();
	$db_connection = new mysqli('stardock.cs.virginia.edu', 'cs4750jci5kb', 'moviedbgroup', 'cs4750jci5kb');
	if (mysqli_connect_errno()) {
		echo "connection error";
		return;
	}

	// Build the Query to find all actor's movies
	$stmt = $db_connection->stmt_init();
	$query = "SELECT movie_id from (`Actor` NATURAL JOIN `StarredIn` NATURAL JOIN `Movie` NATURAL JOIN `Directed` NATURAL JOIN `Director`) WHERE";
	foreach ($arguments as $key => $value) {
		$query=$query . " `" . $key . "` LIKE '" . $value . "' AND ";
	}
	$query=substr($query,0, -5);

	// Find all the movies an actor has been in
	if ($stmt->prepare($query)) {
		$stmt->execute();
		$stmt->bind_result($movie_id);

		while($stmt->fetch()) {
			$movies[] = $movie_id;
		}
	}

	// Return all the movies that the Actor has been in
	$query = "SELECT * from (`Actor` NATURAL JOIN `StarredIn` NATURAL JOIN `Movie` NATURAL JOIN `Directed` NATURAL JOIN `Director`) WHERE";
	foreach ($movies as $value) {
		$query=$query . " `movie_id` LIKE '" . $value . "' OR ";
	}
	$query=substr($query,0, -4);

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
    		$actors=array();
			echo '<div class="featurette" id="about">';
	        echo '<img style="height:500px; width:500px;" class="featurette-image img-circle img-responsive pull-right" src='. "img/movies/". str_replace(' ','',$title).'.jpg>';
   	        //echo '<img class="featurette-image img-circle img-responsive pull-right" src="http://placehold.it/500x500">';
	        echo '<h2 class="featurette-heading">'.$title.'<span class="text-muted"></span></h2>';
	        echo '<p class="lead">'.$movieMap[$title]["data"]["plot"].'</p>';
	       	echo '<div id="directorDiv"><p class="lead"><b>Director: </b><span onmouseover="this.style.cursor=\'pointer\'" onmouseout="this.style.cursor=\'default\'">'.$movieMap[$title]["data"]["director"].'</span></p></div>';
	        echo '<p class="lead"><b>MetaCritic Rating: </b>'.$movieMap[$title]["data"]["cRating"].'</p>';
	        echo '<div id="yearDiv"><p class="lead"><b>Release: </b><span onmouseover="this.style.cursor=\'pointer\'" onmouseout="this.style.cursor=\'default\'">'.$movieMap[$title]["data"]["releaseYear"].'</span></p></div>';
	        echo '<p class="lead"><b>User Ratings: </b>'.$movieMap[$title]["data"]["uRating"].'</p>';
	        echo '<div id="genreDiv"><p class="lead"><b>Genre: </b><span onmouseover="this.style.cursor=\'pointer\'" onmouseout="this.style.cursor=\'default\'">'.$movieMap[$title]["data"]["genre"].'</span></p></div>';

			foreach ($movie["actors"] as $a) {
	        	$actors[]='<span class="lead" onmouseover="this.style.cursor=\'pointer\'" onmouseout="this.style.cursor=\'default\'">'.$a.'</span>';
	        }

    		echo '<div id="actorDiv">';
    		echo '<p class="lead"><b>Actors</b>: '.implode('<span>, </span>', $actors).'</p>';
	        echo '</div>';
	        echo '</div>';
	        echo '<hr class="featurette-divider">';
    		echo "<br><br>";
    	}
	}
}


// Array
$params = array();

// Grab Variables
if (isset($_POST['actor']) && !empty($_POST['actor'])) {
	$actor = $_POST['actor'];
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
	$params['first_name']= "%$firstname%";
	$params['last_name']= "%$lastname%";
}
if (isset($_POST['director']) && !empty($_POST['director'])) {
	$director = $_POST['director'];
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
	$params['director_first_name']= "%$director_firstname%";
	$params['director_last_name']= "%$director_lastname%";
}
if (isset($_POST['genre']) && !empty($_POST['genre'])) {
	$genre = $_POST['genre'];
	$params['genre']= $genre;
}
if (isset($_POST['year']) && !empty($_POST['year'])) {
	$year = $_POST['year'];
	$params['year']= $year;
}
if (isset($_POST['phrase']) && !empty($_POST['phrase'])) {
	$phrase = $_POST['phrase'];
	echo '<h2 class="featurette-heading"><font color="#77CCDD"> ' . $phrase . '... </font></h2>';
    echo '<hr class="featurette-divider">';
}

queryDB($params);
?>
<script type="text/javascript" src="js/controller-results.js"></script>