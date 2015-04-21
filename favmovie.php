<?php

require_once('conf/config.php');
require_once(ROOT_PATH . 'db/dbconnect.php');

session_start();

if(isset($_GET['movie']) && isset($_SESSION['user'])) {
	
	$user = $_SESSION['user'];
	$movie_id = trim($_GET['movie']);
	
	$db_connection = DbUtil::loginConnection();
	if ($stmt = $db_connection->prepare("DELETE FROM Favorites WHERE username=? AND movie_id=?")) {
		$stmt->bind_param("si", $user, $movie_id);
		$stmt->execute();
		if($stmt->affected_rows === 0) {
			// We need to insert
			$db_connection2 = DbUtil::loginConnection();
			$stmt2 = $db_connection2->stmt_init();
			if ($stmt2->prepare("INSERT INTO Favorites VALUES(?,?)")) {
				$stmt2->bind_param("si", $user, $movie_id);
				$stmt2->execute();
				// echo "insert ex..";
				if($stmt2->affected_rows === 0) {
					// echo "failed to insert";
				} else {
					echo "true"; // successful add favorite
				}			
			} else {
				// echo $stmt2->error;			
			}
		} else {
			echo "false"; // We deleted it		
		}		
	}
}

?>