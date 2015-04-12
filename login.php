<?php
require_once('conf/config.php');
require_once(ROOT_PATH . 'header.php');
require_once(ROOT_PATH . 'db/dbconnect.php');

$db_connection = DbUtil::loginConnection();
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
<form action="/servicedogs/account/login/" method="post" class="form">
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
