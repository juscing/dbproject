<?php
require_once('conf/config.php');
session_start();
if(isset($_GET["logout"])) {
    if(isset($_SESSION['user'])){
        unset($_SESSION['user']);
        $logout = True;
    }
    if(isset($_SESSION['name'])){
        unset($_SESSION['name']);    
    }
}

require_once(ROOT_PATH . 'header.php');
require_once(ROOT_PATH . 'db/dbconnect.php');

?>
<!-- Metatropolis -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="Justin Ingram" >

<!-- Custom CSS -->
<link href="css/simple-sidebar.css" rel="stylesheet">
<link rel="stylesheet" href="css/main.css">
<link rel="stylesheet" href="css/one-page-wonder.css">
<title>Search for Movies!</title>
<!-- Custom JS -->
  <script type="text/javascript" src="js/jquery.jscroll.min.js"></script>
  <!-- Menu Toggle Script -->
  <script>
  $(document).ready(function() {
  	$("#result").jscroll({
    loadingHtml: '<img src="img/ajax.-loader.gif" alt="Loading" /> Loading...',
    padding: 20,
    nextSelector: 'a.jscroll-next:last'
	});
  	$("#menu-toggle").click(function(e) {
      e.preventDefault();
      $('#tryAgain').show()
      $("#wrapper").toggleClass("toggled");
  });
  $(".toggler").click(function(e) {
      e.preventDefault();
      $('#tryAgain').hide()
      $("#wrapper").toggleClass("toggled");
  });
  $("#actorlink").click(function(e) {
  		e.preventDefault();
  		$("#wrapper").addClass("toggled");
  		var res = $("#results");
  		res.fadeOut(function () {
  			res.empty();
  			res.load("php/actorPage.php", function () {
  				res.show();
  			});
  		})
  	});
  });
  </script>
</head>
<body>
<nav class="navbar navbar-fixed-top">
   <div class="container">
    <div class="navbar-header">
      <a class="navbar-brand toggler" href="#"><b>MovieDB</b></a>
      <a class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="glyphicon glyphicon-chevron-down"></span>
      </a>
    </div>
      <div class="navbar-collapse collapse">
        <ul class="nav navbar-nav">  
          <li><a id="actorlink" href="#">Actors</a></li>
          <li><a href="#">Directors</a></li>
          <li><a href="#">Movies</a></li>
          <li><a href="#">Producers</a></li>
          <li><a href="#">Studios</a></li>

        </ul>
        <ul class="nav navbar-right navbar-nav">
          <li>
            <a href="#" class="toggler"><i class="glyphicon glyphicon-search"></i></a>
          </li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="glyphicon glyphicon-user"></i> <i class="glyphicon glyphicon-chevron-down"></i></a>
            <ul class="dropdown-menu">
              <?php if (isset($_SESSION['user'])) : ?>
              <li><a href="index.php?logout=logout">Logout</a></li>
              <li><a href="#"><?php echo(htmlspecialchars($_SESSION['name'])."'s ") ?>Profile</a></li>
              <?php else : ?>
              <li><a href="login.php">Login</a></li>
              <li><a href="registration.php">Register</a></li>
              <?php endif; ?>
              <li class="divider"></li>
              <li><a href="#">About</a></li>
             </ul>
          </li>
        </ul>
      </div>
    </div>
</nav><!-- /.navbar -->

  <!-- Page Content -->
  <div class="container main">

    <div id="wrapper">
      <!-- Sidebar -->
      <div id="sidebar-wrapper">
          <ul class="sidebar-nav">
              <li class="sidebar-brand">
                  <a href="#">
                      Find a Movie!
                  </a>
              </li>
              <div id="container">
                  <form id="movieForm" method="GET">
                      <li>
                      </li>
                      <li>
                          <div class="form-group">
                              <input class="form-control" name='title' id='title' placeholder="Search by Movie Title">
                              <p><span id="movieHint" name ='movieHint'></span></p>
                          </div>
                      </li>
                      <li>
                          <div class="form-group">
                            <input class="form-control" name='actor' id='actor' placeholder="Search by Actor">
                            <p><span id="actorHint" name ='actorHint'></span></p>
                          </div>
                      </li>
                      <li>
                          <div class="form-group">
                            <input class="form-control" name='director' id='director' placeholder="Search by Director">
                            <p><span id="directorHint" name ='directorHint'></span></p>
                          </div>
                      </li>
                      <li>
                          <div class="form-group">
                              <input class="form-control" name='keyword' placeholder="Search by Keyword">
                          </div>
                      </li>
                      <li>
                          <div class="form-group">
                            <div class="dropdown">
                              <button class="btn btn-default dropdown-toggle year" type="button" name='Year' id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
                                Year
                                <span class="caret"></span>
                              </button>
                              <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
                                <li role="presentation" class="dropdown-header">Classics</li>
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="#">1950s</a></li>
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="#">1960s</a></li>
                                <li role="presentation" class="dropdown-header">Old School</li>
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="#">1970s</a></li>
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="#">1980s</a></li>
                                <li role="presentation" class="dropdown-header">Modern</li>
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="#">1990s</a></li>
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="#">2000s</a></li>
                                <li role="presentation" class="dropdown-header">PostModern</li>
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="#">2010s</a></li>
                              </ul>
                            </div>
                          </div>
                      </li>
                      <li>
                        <div class="form-group">
                          <div class="dropdown">
                            <button class="btn btn-default dropdown-toggle genre" type="button" name='genre' id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
                              Genre
                              <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
                              <li role="presentation" class="dropdown-header">Scary</li>
                              <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Horror</a></li>
                              <li role="presentation" class="dropdown-header">Fun</li>
                              <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Comedy</a></li>
                              <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Rom-Com</a></li>
                              <li role="presentation" class="dropdown-header">Exciting</li>
                              <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Action</a></li>
                              <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Adventure</a></li>
                            </ul>
                          </div>
                        </div>
                      </li>
                      <li>
                        <div class="form-group">
                          <button href="#menu-toggle" class="btn btn-default submit" id="menu-toggle" type="submit">Find Movies to Watch</button>
                        </div>
                      </li>
                  </form>
              </div>
          </ul>
      </div>
      <!-- /#sidebar-wrapper -->
      <div id="page-content-wrapper">
          <div class="container-fluid">
              <div class="row">
                  <div class="col-lg-12">
                      <div style="display:none;" id="tryAgain">
                        <a href="#menu-toggle" class="btn btn-default toggler" id="menu-toggle2">Try another Search</a>
                      </div>
                        <div id="results">
                          <!-- RESULTS GO HERE -->
                        </div>
                      <div id='dynamic'>
                        <?php if(isset($logout) && $logout) : ?>
          	   		    		<div class="alert alert-info alert-dismissable">
               		   				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                		  				You have been logged out.
          			   				</div>
        						    <?php endif; ?>
    									 <h1>Search for Movies!</h1>
                        <p>This template has a responsive menu toggling system. The menu will appear collapsed on smaller screens, and will appear non-collapsed on larger screens. When toggled using the button below, the menu will appear/disappear. On small screens, the page content will be pushed off canvas.</p>
                          <p>Make sure to keep all page content within the <code>#page-content-wrapper</code>.</p>                          
                           <img src="img/main/uva.png" class='displayed' alt="Mountain View" style="height:100%">
                        </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <!-- /#page-content-wrapper -->

    </div>
</div>
<script type="text/javascript" src="js/controller-main.js"></script>
<!-- /#wrapper -->
<?php
require_once('footer.php');
?>
