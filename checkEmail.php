<?php
require_once('conf/config.php');
require_once(ROOT_PATH . 'db/dbconnect.php');

function checkEmail($email) {
	$db_connection = DbUtil::loginUserLandConnection();
	$dupe = FALSE;
	if($stmt = $db_connection->prepare("SELECT email FROM Users WHERE email=?")) {
		$stmt->bind_param("s", $email);
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

if(isset($_POST["emailcheck"])) {
	if(checkEmail(trim($_POST["emailcheck"]))) {
		echo(json_encode(false));
	} else {
		echo(json_encode(true));			
	}
}
?>