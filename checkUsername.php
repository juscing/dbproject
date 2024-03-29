<?php
require_once('conf/config.php');
require_once(ROOT_PATH . 'db/dbconnect.php');

function checkUsername($username) {
	$db_connection = DbUtil::loginUserLandConnection();
	$dupe = FALSE;
	if($stmt = $db_connection->prepare("SELECT username FROM Users WHERE username=?")) {
		$stmt->bind_param("s", $username);
    	/* execute query */
    	$stmt->execute();
    	
    	/* store result */
    	$stmt->store_result();
    	if($stmt->num_rows > 0) {
			$dupe = TRUE;
		}
    	$stmt->close();
	}
	$db_connection->close();

	return $dupe;
}

if(isset($_POST["usernamecheck"])) {
	if(checkUsername(trim($_POST["usernamecheck"]))) {
		echo(json_encode(false));
	} else {
		echo(json_encode(true));			
	}
}
?>