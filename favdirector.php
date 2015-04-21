<?php

require_once('conf/config.php');
require_once(ROOT_PATH . 'db/dbconnect.php');

session_start();

if(isset($_GET['director']) && isset($_SESSION['user'])) {
	
	$user = $_SESSION['user'];
	$id = trim($_GET['director']);
	
	$db_connection = DbUtil::loginConnection();
	if ($stmt = $db_connection->prepare("DELETE FROM Favorite_Director WHERE username=? AND director_id=?")) {
		$stmt->bind_param("si", $user, $id);
		$stmt->execute();
		if($stmt->affected_rows === 0) {
			// We need to insert
			$db_connection2 = DbUtil::loginConnection();
			$stmt2 = $db_connection2->stmt_init();
			if ($stmt2->prepare("INSERT INTO Favorite_Director VALUES(?,?)")) {
				$stmt2->bind_param("is", $id, $user);
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