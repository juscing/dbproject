<?php
require_once('conf/config.php');

require_once(ROOT_PATH . 'db/dbconnect.php');

$error = false;

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
	$("form#register").validate();
	
})
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
<form id="register" action="" method="post" class="form">
    <div class="form-group">
        <label>
            Username:
        </label>
        <input name="username" type="text" class="form-control" required="">
    </div>
    <div class="form-group">
        <label>
            Password:
        </label>
        <input id="password1" name="password" minlength="6" type="password" class="form-control" required="">
    </div>
    <div class="form-group">
        <label>
            Confirm Password:
        </label>
        <input name="passwordVerify" equalTo="#password1" type="password" class="form-control" required="">
    </div>
    <div class="form-group">
        <label>
            Email:
        </label>
        <input name="userEmail" type="email" class="form-control" required="">
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
</form>
<br><br><br><br><br><br><br><br>
</div>
<?php
require_once('footer.php');
?>
