<?php

require_once('conf/config.php');

require_once(ROOT_PATH . 'db/dbconnect.php');

$error = false;

if( isset($_POST['username']) ) {
// echo("post");
$db_connection = DbUtil::loginUserLandConnection();

$user = trim($_POST["username"]);

$pass = hash("SHA256", trim($_POST["password"]));

if($stmt = $db_connection->prepare("SELECT username, First_Name FROM Users WHERE username=? AND password = ?")) {
    $stmt->bind_param("ss", $user, $pass);
    /* execute query */
    $stmt->execute();
    
    /* bind variables to prepared statement */
    $stmt->bind_result($ures, $nameres);
    
    /* fetch values */
    if($stmt->fetch()) {
        session_start();
        // echo("session");
        if (!isset($_SESSION['user'])) {
            $_SESSION['user'] = $ures;
        }
        if (!isset($_SESSION['name'])) {
        		if(empty($nameres)) {
        			$_SESSION['name'] = $ures;
        		} else {
        			$_SESSION['name'] = $nameres;
        		}
        }
        header( 'Location: index.php' );
    } else {
        $error = true;
    }
    
    /* close statement */
    $stmt->close();
} else {
    $error = true;
}

/* close connection */
$db_connection->close();

}

require_once(ROOT_PATH . 'header.php');

?>
<title>Login</title>
</head>
<body>
</head>
<body>

<header class="masthead">
  <div class="container">
    <div class="row">
      <div class="col-md-6">
        <h1><a href="#">Movie Database Login</a>
          <p class="lead">Searchable Movies.</p></h1>
      </div>
      <div class="col-md-6">
        <div class="well pull-right">
          <img src="img/movieicon.png">      
        </div>
      </div>
    </div>
  </div>
</header>

<!-- Begin Body -->
<div class="container">
<?php if($error) : ?>
<div class="alert alert-danger alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        Bad username/password combination.
    </div>
<?php endif; ?>
<form action="" method="post" class="form">
    <div class="form-group">
        <label>
            Username
        </label>
        <input name="username" type="text" class="form-control">
    </div>
    <div class="form-group">
        <label>
            Password
        </label>
        <input name="password" type="password" class="form-control">
    </div>
    <button class="btn btn-lg btn-primary" type="submit">Login</button>
    <!--<strong><a href="/servicedogs/account/password-reset/">Forgot Your Username/Password?</a></strong>-->
</form>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
</div>
<?php
require_once('footer.php');
?>
