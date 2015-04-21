<?php

if(isset($_GET['movie'])) {
	require_once('conf/config.php');
	require_once(ROOT_PATH . 'db/dbconnect.php');
	
	$db_connection = DbUtil::loginConnection();	
	
	$stmt = $db_connection->stmt_init();
	if ($stmt->prepare("SELECT * from (`Movie` NATURAL JOIN `Directed` NATURAL JOIN `Director`) WHERE movie_id = ?")) {
		$stmt->bind_param("i", trim($_GET['movie']));
		
		$stmt->execute();
		
    	/* bind variables to prepared statement */

    	$stmt->bind_result($director_id, $movie_id, $mtitle, $genreResponse, $uRating, $releaseYear, $runtime, $cRating, $plot, $dfname, $dlname);
    	
		$stmt->fetch();	
	
	echo '<div class="featurette" id="about">';
	        echo '<img style="height:500px; width:500px;" class="featurette-image img-circle img-responsive pull-right" src='. "img/movies/". str_replace(' ','',$mtitle).'.jpg>';
	        echo '<h2 class="featurette-heading">'.$mtitle.'<span class="text-muted"></span></h2>';
	        echo '<p class="lead">'.$plot.'</p>';
	        echo '<p class="lead">Director: '.$dfname." ".$dlname.'</p>';
	        echo '<p class="lead">MetaCritic Rating: '.$cRating.'</p>';
	        echo '<p class="lead">Release: '.$releaseYear.'</p>';
	        echo '<p class="lead">User Ratings: '.$uRating.'</p>';
	        echo '<p class="lead">Genre: '.$genreResponse.'</p>';
	        $stmt->close();
	        $db_connection2 = DbUtil::loginConnection();
	        $stmt2 = $db_connection2->stmt_init();
			if($stmt2->prepare("SELECT first_name, last_name from (`Actor` NATURAL JOIN `StarredIn`) WHERE movie_id = ?")) {
				$stmt2->bind_param("i", trim($_GET['movie']));
				$stmt2->execute();
				$stmt2->bind_result($fname, $lname);
				echo '<p class="lead">Actors: ';
				$stmt2->fetch();
				echo $fname." ".$lname;
				while($stmt2->fetch()) {
					echo ', '.$fname." ".$lname;
				}
				echo "</p>";
			} else {
				echo "dberror";			
			}
	        
	        echo '</div>';

	} else {
		echo '<p>db error</p>';
	}
} else {
	echo '<p>No such movie in the database!</p>';
}
	        
?>