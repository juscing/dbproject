<?php
require_once('conf/config.php');
session_start();

if(!isset($_SESSION['user'])) {
	echo "<p>You are not logged in!</p>";
	die();
}
?>

<h1><?php echo $_SESSION['user']; ?></h1>

<h2>Favorite Movies</h2>

<h2>Favorite Actors</h2>

<h2>Favorite Directors</h2>