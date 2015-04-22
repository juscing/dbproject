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
  $("#results").on("click", "a.ajaxlink", function (e) {
  		e.preventDefault();
  		var ref = $(this).attr('href');
  		var res = $("#results");
  		res.fadeOut(function () {
  			res.empty();
  			$(window).unbind('scroll');
  			res.load(ref, function () {
  				res.fadeIn();
  			});
  		});
  });
  $("#results").on("click", "a.remfave", function (e) {
  		e.preventDefault();
  		var ref = $(this).attr('href');
  		var tag = this;
  		$.get(ref, function(data) {
  			if(data == 'false') {
				$(tag).closest("p").slideUp(function() {
					$(this).remove();
				});
  			}
  		});
  });
	$("#results").on("click", "a.star", function (e) {
  		e.preventDefault();
  		var ref = $(this).attr('href');
  		var tag = this;
  		var res = $("#results");
  		$.get(ref, function(data) {
  			if(data == 'true') {
				$(tag).addClass('fav');
				$(tag).removeClass('notfav');
  			} else {
  				$(tag).addClass('notfav');
				$(tag).removeClass('fav');
  			}
  		});
  });
  $("#results").on("click", "a.plus", function (e) {
  		e.preventDefault();
  		var ref = $(this).attr('href');
  		var tag = this;
  		var res = $("#results");
  		$.get(ref, function(data) {
  			if(data == 'true') {
				$(tag).addClass('wat');
				$(tag).removeClass('notwat');
  			} else {
  				$(tag).addClass('notwat');
				$(tag).removeClass('wat');
  			}
  		});
  });
  $("#actorlink").click(function(e) {
  		e.preventDefault();
  		$("#wrapper").addClass("toggled");
  		var res = $("#results");
  		res.fadeOut(function () {
  			res.empty();
  			res.load("php/actorPage.php", function () {
  				res.fadeIn();
  				item = $("#scroller");
  				scroller(item);
  			});
  		});
  	});
  	$("#directorlink").click(function(e) {
  		e.preventDefault();
  		$("#wrapper").addClass("toggled");
  		var res = $("#results");
  		res.fadeOut(function () {
  			res.empty();
  			res.load("php/directorPage.php", function () {
  				res.fadeIn();
  				item = $("#scroller");
  				scroller(item);
  			});
  		});
  	});
  	$("#movielink").click(function(e) {
  		e.preventDefault();
  		$("#wrapper").addClass("toggled");
  		var res = $("#results");
  		res.fadeOut(function () {
  			res.empty();
  			res.load("php/moviePage.php", function () {
  				res.fadeIn();
  				item = $("#scroller");
  				scroller(item);
  			});
  		});
  	});
  	$("#profilelink").click(function (e) {
  		e.preventDefault();
  		var ref = $(this).attr('href');
  		var res = $("#results");
  		res.fadeOut(function () {
  			res.empty();
  			$(window).unbind('scroll');
  			res.load(ref, function () {
  				res.fadeIn();
  			});
  		});
  });

  // AUTO COMPLETES
  $("#movieHint").on("click", "td", function () {
  	$("#title").val($(this).text());
  });
  $("#actorHint").on("click", "td", function () {
    $("#actor").val($(this).text());
  });
  $("#directorHint").on("click", "td", function () {
    $("#director").val($(this).text());
  });

  // DROPDOWNS
  $(".dropdown-menu").on("click", "li a", function () {
    $(this).parent().parent().parent().find("button").text($(this).text());
  })

  /*
  $("#ulist li a").click(function() {
    alert(this.id); // id of clicked li by directly accessing DOMElement property
  });
*/


});
function scroller(item) {
item.jscroll({
    loadingHtml: '<tr><td colspan="100"><img src="img/ajax-loader.gif" alt="Loading" /> Loading...</td></tr>',
    padding: 20,
    nextSelector: 'a.jscroll-next:last'
	});
return item;
}
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
          <li><a id="directorlink" href="#">Directors</a></li>
          <li><a id="movielink" href="#">Movies</a></li>
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
              <li><a id="profilelink" href="profile.php"><?php echo(htmlspecialchars($_SESSION['name'])."'s ") ?>Profile</a></li>
              <?php else : ?>
              <li><a href="login.php">Login</a></li>
              <li><a href="registration.php">Register</a></li>
              <?php endif; ?>
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
                            <div class="dropdown">
                              <button class="btn btn-default dropdown-toggle year" type="button" name='year' id="year" data-toggle="dropdown" aria-expanded="true">Year<span class="caret"></span>
                              </button>
                              <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
                                <li role="presentation" class="dropdown-header">Classics</li>
                                <li role="presentation"><a role="menuitem" tabindex="-1">1950s</a></li>
                                <li role="presentation"><a role="menuitem" tabindex="-1">1960s</a></li>
                                <li role="presentation" class="dropdown-header">Old School</li>
                                <li role="presentation"><a role="menuitem" tabindex="-1">1970s</a></li>
                                <li role="presentation"><a role="menuitem" tabindex="-1">1980s</a></li>
                                <li role="presentation" class="dropdown-header">Modern</li>
                                <li role="presentation"><a role="menuitem" tabindex="-1">1990s</a></li>
                                <li role="presentation"><a role="menuitem" tabindex="-1">2000s</a></li>
                                <li role="presentation" class="dropdown-header">PostModern</li>
                                <li role="presentation"><a role="menuitem" tabindex="-1">2010s</a></li>
                              </ul>
                            </div>
                          </div>
                      </li>
                      <li>
                        <div class="form-group">
                          <div class="dropdown">
                            <button class="btn btn-default dropdown-toggle genre" type="button" name='genre' id="genre" data-toggle="dropdown" aria-expanded="true">Genre<span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
                              <li role="presentation" class="dropdown-header">Thillers</li>
                              <li role="presentation"><a role="menuitem" tabindex="-1">Horror</a></li>
                              <li role="presentation"><a role="menuitem" tabindex="-1">Drama</a></li>
                              <li role="presentation" class="dropdown-header">Fun</li>
                              <li role="presentation"><a role="menuitem" tabindex="-1">Comedy</a></li>
                              <li role="presentation"><a role="menuitem" tabindex="-1">Rom-Com</a></li>
                              <li role="presentation" class="dropdown-header">Exciting</li>
                              <li role="presentation"><a role="menuitem" tabindex="-1">Action</a></li>
                              <li role="presentation"><a role="menuitem" tabindex="-1">Adventure</a></li>
                            </ul>
                          </div>
                        </div>
                      </li>
                      <li>
                        <div class="form-group">
                          <input class="span2" id="rating_value" name="rating_value" type="hidden">
                          <div class="dropdown">
                            <button class="btn btn-default dropdown-toggle rating" type="button" name='rating' id="crating" data-toggle="dropdown" aria-expanded="true">Critical Rating<span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1" id='ulist'>
                              <li role="presentation"><a role="menuitem" tabindex="-1">1</a></li>
                              <li role="presentation"><a role="menuitem" tabindex="-1">2</a></li>
                              <li role="presentation"><a role="menuitem" tabindex="-1">3</a></li>
                              <li role="presentation"><a role="menuitem" tabindex="-1">4</a></li>
                              <li role="presentation"><a role="menuitem" tabindex="-1">5</a></li>
                              <li role="presentation"><a role="menuitem" tabindex="-1">6</a></li>
                              <li role="presentation"><a role="menuitem" tabindex="-1">7</a></li>
                              <li role="presentation"><a role="menuitem" tabindex="-1">8</a></li>
                              <li role="presentation"><a role="menuitem" tabindex="-1">9</a></li>
                              <li role="presentation"><a role="menuitem" tabindex="-1">10</a></li>
                            </ul>
                          </div>
                        </div>
                      </li>
                      <li>
                        <div class="form-group">
                          <input class="span2" id="rating_value" name="rating_value" type="hidden">
                          <div class="dropdown">
                            <button class="btn btn-default dropdown-toggle rating" type="button" name='rating' id="urating" data-toggle="dropdown" aria-expanded="true">User Rating<span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1" id='ulist'>
                              <li role="presentation"><a role="menuitem" tabindex="-1">1</a></li>
                              <li role="presentation"><a role="menuitem" tabindex="-1">2</a></li>
                              <li role="presentation"><a role="menuitem" tabindex="-1">3</a></li>
                              <li role="presentation"><a role="menuitem" tabindex="-1">4</a></li>
                              <li role="presentation"><a role="menuitem" tabindex="-1">5</a></li>
                              <li role="presentation"><a role="menuitem" tabindex="-1">6</a></li>
                              <li role="presentation"><a role="menuitem" tabindex="-1">7</a></li>
                              <li role="presentation"><a role="menuitem" tabindex="-1">8</a></li>
                              <li role="presentation"><a role="menuitem" tabindex="-1">9</a></li>
                              <li role="presentation"><a role="menuitem" tabindex="-1">10</a></li>
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

      <div id="tryAgain" style="display:none;">
        <img src="img/arrow.png" style="position:fixed;top:42%;left:0px;" href="#menu-toggle" class="btn btn-default toggler" id="menu-toggle2">
      </div>

      <!-- /#sidebar-wrapper -->
      <div id="page-content-wrapper">
          <div class="container-fluid">
              <div class="row">
                  <div class="col-lg-12">
                    <!--
                      <div style="display:none;" id="tryAgain">
                        <a href="#menu-toggle" class="btn btn-default toggler" id="menu-toggle2">Try another Search</a>
                      </div>
                    -->
                      <div id='dynamic'>
                        <?php if(isset($logout) && $logout) : ?>
          	   		    		<div class="alert alert-info alert-dismissable">
               		   				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                		  				You have been logged out.
          			   				</div>
        						    <?php endif; ?>

                        <div id="results">
                          <!-- RESULTS GO HERE -->
                          <br><br><br><br>
                          <h1>Smoothie</h1>  
                          <h2 class="words"> Finally, find a movie you <i>want</i> to watch. Simply enter in the type of movie you want to see on the left, and we will do all the work for you!</h2>
                          <img src="img/main/ch1.jpg" class='displayed' alt="Mountain View" height="50%" style="position:fixed;bottom:0px;right:0px;" >
                        </div>    								
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
<link href='http://fonts.googleapis.com/css?family=Marvel:400,700,700italic,400italic' rel='stylesheet' type='text/css'>
<!-- /#wrapper -->
<?php
require_once('footer.php');
?>
