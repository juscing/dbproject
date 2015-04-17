<?php
require_once('conf/config.php');

require_once(ROOT_PATH . 'db/dbconnect.php');

require_once(ROOT_PATH . 'checkUsername.php');

require_once(ROOT_PATH . 'checkEmail.php');

$db_error = FALSE;

if( isset($_POST['username']) ) {
// echo("post");
$db_connection = DbUtil::loginUserLandConnection();

$user = trim($_POST["username"]);
$pass1 = trim($_POST["password"]);
$pass2 = trim($_POST["passwordVerify"]);
$email = trim($_POST["userEmail"]);
$fname = trim($_POST["fName"]);
$lname = trim($_POST["lName"]);
}

$errors = array();
if($_POST) {
if(empty($user)) {
	$errors["user"] = "Username is required";
} else if(checkUsername($user)) {
	$errors["user"] = "That username is already taken.";
}

if(empty($pass1)) {
	$errors["pass1"] = "Password is required";
} else if(strlen($pass1) < 6) {
	$errors["pass1"] = "Password must be at least 6 characters.";
}

if(empty($pass2) || $pass1 !== $pass2) {
	$errors["pass2"] = "Passwords must match.";
}

if(empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
	$errors["email"] = "Please enter a valid email address.";
} else if(checkEmail($email)) {
	$errors["email"] = "This email address is already registered";
}
if(empty($errors)) {
	if($stmt = $db_connection->prepare("INSERT INTO Users VALUES (?,?,?,?,?);")) {
		$stmt->bind_param("sssss", $user, hash("SHA256", $pass1), $email, $fname, $lname);
    	/* execute query */
    	if(! $stmt->execute()) {
    		echo($stmt->error);
    		$db_error = TRUE;
    	} else {
			// successfully create user
			session_start();
        // echo("session");
        if (!isset($_SESSION['user'])) {
            $_SESSION['user'] = $user;
        }
        if (!isset($_SESSION['name'])) {
        		if(empty($fname)) {
        			$_SESSION['name'] = $fname;
        		} else {
        			$_SESSION['name'] = $user;
        		}
        }
        header( 'Location: index.php' );			    	
    	}
	}
}
}
require_once(ROOT_PATH . 'header.php');
?>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.1/jquery.validate.min.js"></script>
<script type="text/javascript">
$(document).ready(function () {
	// override jquery validate plugin defaults
	$.validator.setDefaults({
   	 highlight: function(element) {
      	  $(element).closest('.form-group').addClass('has-error');
    	 },
    	  unhighlight: function(element) {
        		$(element).closest('.form-group').removeClass('has-error');
    		},
    		errorElement: 'span',
    		errorClass: 'help-block',
    		errorPlacement: function(error, element) {
        	if(element.parent('.input-group').length) {
            error.insertAfter(element.parent());
        	} else {
            error.insertAfter(element);
        	}
    }
});	
	var validator = $("form#register").validate({
	rules: {
    username: {
      required: true,
      remote: {
        url: "checkUsername.php",
        type: "post",
        data: {
          usernamecheck: function() {
            return $( "#username" ).val();
          }
        }
      }
    },
    userEmail: {
      required: true,
      remote: {
        url: "checkEmail.php",
        type: "post",
        data: {
          emailcheck: function() {
            return $( "#userEmail" ).val();
          }
        }
      }
    }
  },
  messages: {
    username: "That username is already taken.",
    userEmail: "Invalid or already registered email address.",
  },
  success: function(element) {
  	//label.text("Valid");
    element.closest('.form-group').removeClass('has-error').addClass('has-success');
  }
	
	});
});
</script>
<title>Registration</title>
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
<?php if($db_error) : ?>
<div class="alert alert-danger alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        There was an unspecified database error.
    </div>
<?php endif; ?>
<form id="register" action="" method="post" class="form">
	<?php if(isset($errors["user"])) : ?>
	<div id="usergroup" class="form-group has-error">	
	<?php else : ?>
	<div id="usergroup" class="form-group">
	<?php endif; ?>
        <label>
            Username:
        </label>
        <input id="username" name="username" type="text" class="form-control" required="" value="<?php if(isset($user)) : echo($user); endif; ?>">
        <?php if(isset($errors["user"])) : ?><span id="username-error" class="help-block"><?php echo($errors["user"]); ?></span><?php endif; ?>
    </div>
    <?php if(isset($errors["pass1"])) : ?>
	<div class="form-group has-error">	
	<?php else : ?>
	<div class="form-group">
	<?php endif; ?>
        <label>
            Password:
        </label>
        <input id="password1" name="password" minlength="6" type="password" class="form-control" required="">
        <?php if(isset($errors["pass1"])) : ?><span id="password1-error" class="help-block"><?php echo($errors["pass1"]); ?></span><?php endif; ?>
    </div>
    <?php if(isset($errors["pass2"])) : ?>
	<div class="form-group has-error">	
	<?php else : ?>
	<div class="form-group">
	<?php endif; ?>
        <label>
            Confirm Password:
        </label>
        <input name="passwordVerify" equalTo="#password1" type="password" class="form-control" required="">
        <?php if(isset($errors["pass2"])) : ?><span id="passwordVerify-error" class="help-block"><?php echo($errors["pass2"]); ?></span><?php endif; ?>
    </div>
    <?php if(isset($errors["email"])) : ?>
	<div class="form-group has-error">	
	<?php else : ?>
	<div class="form-group">
	<?php endif; ?>
        <label>
            Email:
        </label>
        <input id="userEmail" name="userEmail" type="email" class="form-control" required="" value="<?php if(isset($email)) : echo($email); endif; ?>">
        <?php if(isset($errors["email"])) : ?><span id="email-error" class="help-block"><?php echo($errors["email"]); ?></span><?php endif; ?>
    </div>
    <div class="form-group">
        <label>
            First Name:
        </label>
        <input name="fName" type="text" class="form-control" value="<?php if(isset($fname)) : echo($fname); endif; ?>">
    </div>
    <div class="form-group">
        <label>
            Last Name:
        </label>
        <input name="lName" type="text" class="form-control" value="<?php if(isset($lname)) : echo($lname); endif; ?>">
    </div>
    <button class="btn btn-lg btn-primary" type="submit">Register</button>
</form>
<br><br><br><br><br><br><br><br>
</div>
<?php
require_once('footer.php');
?>
