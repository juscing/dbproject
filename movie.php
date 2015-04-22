<?php

session_start();

if(isset($_GET['movie'])) {
	require_once('conf/config.php');
	require_once(ROOT_PATH . 'db/dbconnect.php');
	
	$user = "";
	if(isset($_SESSION['user'])) {
		$user = $_SESSION['user'];
	}	
	
	$db_connection = DbUtil::loginConnection();	
	
	$stmt = $db_connection->stmt_init();
	if ($stmt->prepare("SELECT faves.username, watches.username, director_id, Movie.movie_id, title, genre, user_rating, year, runtime, critic_rating, Plot, director_first_name, director_last_name from (`Movie` NATURAL JOIN `Directed` NATURAL JOIN `Director`) LEFT JOIN (SELECT * FROM Watch WHERE username = ?) AS watches ON Movie.movie_id = watches.movie_id LEFT JOIN (SELECT * FROM Favorites WHERE username = ?) AS faves ON faves.movie_id = Movie.movie_id WHERE Movie.movie_id = ?")) {
		$stmt->bind_param("ssi", $user, $user, trim($_GET['movie']));
		
		$stmt->execute();
		
    	/* bind variables to prepared statement */

    	$stmt->bind_result($userf, $userw, $director_id, $movie_id, $mtitle, $genreResponse, $uRating, $releaseYear, $runtime, $cRating, $plot, $dfname, $dlname);
    	
		$stmt->fetch();	
	
	echo '<div class="featurette" id="about">';
	        echo '<img style="height:500px; width:500px;" class="featurette-image img-circle img-responsive pull-right" src='. "img/movies/". str_replace(' ','',$mtitle).'.jpg>';
				if(isset($_SESSION['user'])) {	
				echo('<div style="float:right;margin-top:20px;"><a href="favmovie.php?movie='.$movie_id.'" class="star ');
				if(empty($userf)) {
					echo "notfav";				
				} else {
					echo "fav";				
				}
				echo '"></a>';
				echo('<a href="watchlater.php?movie='.$movie_id.'" class="plus ');
				if(empty($userw)) {
					echo "notwat";				
				} else {
					echo "wat";				
				}
				echo '"></a></div>';
				}			
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