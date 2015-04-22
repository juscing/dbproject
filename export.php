<?php

require_once('conf/config.php');
require_once(ROOT_PATH . 'db/dbconnect.php');

session_start();

if(isset($_SESSION['user'])) {
	$db_connection = DbUtil::loginConnection();
	if ($stmt = $db_connection->prepare("SELECT title, genre, year, runtime, user_rating, critic_rating, Plot FROM Movie NATURAL JOIN Watch WHERE username = ?")) {
		$stmt->bind_param("s", $_SESSION['user']);
		$stmt->execute();
		$stmt->bind_result($title, $genre, $year, $runtime, $user_rating, $critic_rating, $Plot);
		header('Content-Type: text/csv; charset=utf-8');
		header('Content-Disposition: attachment; filename=data.csv');

		// create a file pointer connected to the output stream
		$output = fopen('php://output', 'w');

		// output the column headings
		fputcsv($output, array('title', 'genre', 'year', 'runtime', 'user_rating', 'critic_rating', 'Plot'));		
		
		while($stmt->fetch()) {
			fputcsv($output, array($title, $genre, $year, $runtime, $user_rating, $critic_rating, $Plot));
		}
	}
}
?>