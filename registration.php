<?php
// phpinfo();
require_once('conf/config.php');

require_once(ROOT_PATH . 'db/dbconnect.php');

$error = false;

require_once(ROOT_PATH . 'header.php');

?>
<title>Registration</title>
</head>
<body>
</head>
<body>

<header class="masthead">
  <div class="container">
    <div class="row">
      <div class="col-md-6">
        <h1><a href="#">Movie-DB New Account Registration</a>
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
            Username:
        </label>
        <input name="username" type="text" class="form-control">
    </div>
    <div class="form-group">
        <label>
            Password:
        </label>
        <input name="password" type="password" class="form-control">
    </div>
    <div class="form-group">
        <label>
            Confirm Password:
        </label>
        <input name="passwordVerify" type="password" class="form-control">
    </div>
    <div class="form-group">
        <label>
            Email:
        </label>
        <input name="userEmail" type="email" class="form-control">
    </div>
    <div class="form-group">
        <label>
            First Name:
        </label>
        <input name="fName" type="text" class="form-control">
    </div>
    <div class="form-group">
        <label>
            Last Name:
        </label>
        <input name="lName" type="text" class="form-control">
    </div>
    <button class="btn btn-lg btn-primary" type="submit">Register</button>
    <!--<strong><a href="/servicedogs/account/password-reset/">Forgot Your Username/Password?</a></strong>-->
</form>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
</div>
<?php
require_once('footer.php');
?>
