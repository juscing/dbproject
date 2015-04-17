<?php
require_once('conf/config.php');
require_once(ROOT_PATH . 'db/dbconnect.php');

$error = TRUE;
if($_POST["username"]) {
	$db_connection = DbUtil::loginUserLandConnection();

	$user = $_POST["username"];

	if($stmt = $db_connection->prepare("SELECT username FROM Users WHERE username=?")) {
		$stmt->bind_param("s", $user);
    	/* execute query */
    	$stmt->execute();
    	
    	/* bind variables to prepared statement */
    	$stmt->bind_result($ures);
    	
    	/* fetch values */
    	if(! $stmt->fetch()) {
    		$error = FALSE;
    	}   	
    	
	}
}
if($error) {
	echo("bad");
} else {
	echo("good");
}	
?>