<?php
phpinfo();
require_once('conf/config.php');

require_once(ROOT_PATH . 'db/dbconnect.php');

$error = false;

if( isset($_POST['username']) ) {
echo("post");
$db_connection = DbUtil::loginUserLandConnection();

$user = $_POST["username"];

$pass = hash("SHA256", $_POST["password"]);

if($stmt = $db_connection->prepare("SELECT username, First_Name FROM Users WHERE username=? AND password = ?")) {
    $stmt->bind_param("ss", $user, $pass);
    /* execute query */
    $stmt->execute();
    echo("query");
    /* fetch values */
    $result = $stmt->get_result();
    echo("result");
    $arr = $result->fetch_array();
    echo("array");
    if(count($arr) < 1) {
        echo("bad login");
        $error = True;
    } else {
        session_start();
        echo("session");
        if (!isset($_SESSION['user'])) {
            $_SESSION['user'] = $arr[0];
        }
        if (!isset($_SESSION['name'])) {
            $_SESSION['name'] = $arr[1];
        }
        echo("success");
        header( 'Location: index.php' );
    }
    
    /* close statement */
    $stmt->close();
} else {
    $error = True;
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
