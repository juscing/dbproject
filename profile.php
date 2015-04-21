<?php
require_once('conf/config.php');
require_once(ROOT_PATH . 'db/dbconnect.php');
session_start();

if(!isset($_SESSION['user'])) {
	echo "<p>You are not logged in!</p>";
	die();
}
?>

<h1><?php echo $_SESSION['user']; ?></h1>

<h2>Favorite Movies</h2>

<?php
$db_connection = DbUtil::loginConnection();
if ($stmt = $db_connection->prepare("SELECT title, movie_id FROM `Movie` NATURAL JOIN `Favorites` WHERE username = ?")) {
		$stmt->bind_param("s", $_SESSION['user']);
		$stmt->execute();
		$stmt->bind_result($title, $id);
		while($stmt->fetch()) {
			echo("<p><strong><a class=\"ajaxlink\" href=\"movie.php?movie=$id\">$title</a></strong> | <a class=\"remfave text-danger\" href=\"favmovie.php?movie=$id\">Remove</a></p>");		
		}
}


?>

<h2>Favorite Actors</h2>

<h2>Favorite Directors</h2>