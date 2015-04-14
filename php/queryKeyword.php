<?php

require_once('../conf/config.php');
require_once(ROOT_PATH . 'db/dbconnect.php');

function queryDB($mT) {
	#$db_connection = DbUtil::loginConnection();
	$db_connection = new mysqli('stardock.cs.virginia.edu', 'cs4750jci5kb', 'moviedbgroup', 'cs4750jci5kb');
	if (mysqli_connect_errno()) {
		echo "connection error";
		return;
	}

	$stmt = $db_connection->stmt_init();
	# Change this to: stars with
	if ($stmt->prepare("select * from `Movie` where `title` = '$mT'")) {

		$stmt->execute();
		$stmt->bind_result($id, $title, $genreResponse, $uRating, $releaseYear, $runtime, $cRating);

		echo "<table>";
		while($stmt->fetch()) {
			echo "<tr>";
			echo("<td>" . $title . "</td>\n");
		}
		echo "</table>";

	}
}

$movieTitle = $_GET['title'];

#$directorName = $_POST['director'];
#$keyword = $_POST['keyword'];
#$genre = $_POST['genre'];
#$year = $_POST['Year'];

// lookup all hints from array if $q is different from "" 
/*
// Array with names
$a[] = "anna";
$a[] = "brittany";
$a[] = "cinderella";
$a[] = "hegdeFund";
$a[] = "good will hunting";
$a[] = "good dill bunting";

$hint = "";

if ($movieTitle !== "") {
    $movieTitle = strtolower($movieTitle);
    $len=strlen($movieTitle);
    foreach($a as $name) {
        if (stristr($movieTitle, substr($name, 0, $len))) {
            if ($hint === "") {
                $hint = $name;
            } else {
                $hint .= ", $name";
            }
        }
    }
}

// Output "no suggestion" if no hint was found or output correct values 
echo $hint === "" ? "no suggestion" : $hint;
*/

queryDB($movieTitle);

?>