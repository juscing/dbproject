<?php

require_once('../conf/config.php');
require_once(ROOT_PATH . 'db/dbconnect.php');
session_start();
function queryDB($arguments) {
	// Declarations
	$movieMap = array();

	$user = "";
	if(isset($_SESSION['user'])) {
		$user = $_SESSION['user'];
	}	

	$db_connection = DbUtil::loginConnection();
	if (mysqli_connect_errno()) {
		echo "connection error";
		return;
	}

	// Build the Query
	$stmt = $db_connection->stmt_init();
	$query = "SELECT * from (`Actor` NATURAL JOIN `StarredIn` NATURAL JOIN `Movie` NATURAL JOIN `Directed` NATURAL JOIN `Director`) LEFT JOIN (SELECT * FROM `Favorites` WHERE username = '$user') AS faves ON Movie.movie_id = faves.movie_id LEFT JOIN (SELECT * FROM `Watch` WHERE username = '$user') AS watches ON Movie.movie_id = watches.movie_id WHERE";
	foreach ($arguments as $key => $value) {
		$query=$query . " `" . $key . "` LIKE '" . $value . "' AND ";
	}
	$query=substr($query,0, -5);
	// Execute the Query
	echo $query;
	if ($stmt->prepare($query)) {
		$stmt->execute();
		$stmt->bind_result($director_id, $movie_id, $actor_id, $fname, $lname, $mtitle, $genreResponse, $uRating, $releaseYear, $runtime, $cRating, $plot, $dfname, $dlname, $userf, $id1, $userw, $id2);

		while($stmt->fetch()) {
			$movieMap[$mtitle]["data"]["plot"] = $plot;
	      	$movieMap[$mtitle]["data"]["director"] = $dfname." ".$dlname;
			$movieMap[$mtitle]["data"]["cRating"] = $cRating;
			$movieMap[$mtitle]["data"]["runtime"] = $runtime;
			$movieMap[$mtitle]["data"]["releaseYear"] = $releaseYear;
			$movieMap[$mtitle]["data"]["uRating"] = $uRating;
			$movieMap[$mtitle]["data"]["genre"] = $genreResponse;
			$movieMap[$mtitle]["actors"][] = $fname." ".$lname;
			$movieMap[$mtitle]["fave"] = $userf;
			$movieMap[$mtitle]["watch"] = $userw;
			$movieMap[$mtitle]["id"] = $movie_id;
    	}
    	foreach($movieMap as $title => $movie) {
    		$actors=array();
			echo '<div class="featurette" id="about">';
	        echo '<img style="height:500px; width:500px;" class="featurette-image img-circle img-responsive pull-right" src='. "img/movies/". str_replace(' ','',$title).'.jpg>';
   	        //echo '<img class="featurette-image img-circle img-responsive pull-right" src="http://placehold.it/500x500">';
			if(isset($_SESSION['user'])) {	
				echo('<div style="float:right;margin-top:20px;"><a href="favmovie.php?movie='.$movieMap[$title]["id"].'" class="star ');
				if(empty($movieMap[$title]["fave"] == $user)) {
					echo "notfav";				
				} else {
					echo "fav";				
				}
				echo '"></a>';
				echo('<a href="watchlater.php?movie='.$movieMap[$title]["id"].'" class="plus ');
				if(empty($movieMap[$title]["watch"] == $user)) {
					echo "notwat";				
				} else {
					echo "wat";				
				}
				echo '"></a></div>';
				}		        
	        echo '<h2 class="featurette-heading">'.$title.'<span class="text-muted"></span></h2>';
	        echo '<p class="lead">'.$movieMap[$title]["data"]["plot"].'</p>';
	       	echo '<div id="directorDiv"><p class="lead">Director: <span onmouseover="this.style.cursor=\'pointer\'" onmouseout="this.style.cursor=\'default\'">'.$movieMap[$title]["data"]["director"].'</span></p></div>';
	        echo '<p class="lead">MetaCritic Rating: '.$movieMap[$title]["data"]["cRating"].'</p>';
	        echo '<div id="yearDiv"><p class="lead">Release: <span onmouseover="this.style.cursor=\'pointer\'" onmouseout="this.style.cursor=\'default\'">'.$movieMap[$title]["data"]["releaseYear"].'</span></p></div>';
	        echo '<p class="lead">User Ratings: '.$movieMap[$title]["data"]["uRating"].'</p>';
	        echo '<div id="genreDiv"><p class="lead" >Genre: <span onmouseover="this.style.cursor=\'pointer\'" onmouseout="this.style.cursor=\'default\'">'.$movieMap[$title]["data"]["genre"].'</span></p></div>';

			foreach ($movie["actors"] as $a) {
	        	$actors[]='<span class="lead" onmouseover="this.style.cursor=\'pointer\'" onmouseout="this.style.cursor=\'default\'">'.$a.'</span>';
	        }

    		echo '<div id="actorDiv">';
    		echo '<p class="lead">Actors: '.implode('<span>, </span>', $actors).'</p>';
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
<script type="text/javascript" src="js/controller-results.js"></script>