<?php
	class DbUtil{
		
		public static function loginConnection() {
			$db = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
			if($db->connect_errno) {
				echo "fail";
				$db->close();
				exit();
			}
			return $db;
		}
	}
?>
