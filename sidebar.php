<?php
require_once('conf/config.php');
require_once(ROOT_PATH . 'header.php');
require_once(ROOT_PATH . 'db/dbconnect.php');

$db_connection = DbUtil::loginConnection();
?>
<html>
  <head>

    <!-- Bootstrap Core CSS -->
    <!--<link href="css/bootstrap.css" rel="stylesheet">-->

    <!-- Custom CSS -->
    <link href="css/simple-sidebar.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/main.css">
  </head>
  <title>Simple Sidebar - Start Bootstrap Template</title>
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
  <![endif]-->
  <body>

  <!-- TRYING STUFF OUT -->
  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  <script src="https://code.jquery.com/jquery.js"></script>
  <!-- Include all compiled plugins (below), or include individual files 
        as needed -->
  <script src="js/bootstrap.min.js"></script>
  <!-- END OF STUFF -->



      <!-- NavBar -->
      <nav class="navbar navbar-static thinnav">
       <div class="container">
        <div class="navbar-header">
          <a class="navbar-brand" href="http://www.bootply.com" target="ext"><b>Bootply</b></a>
          <a class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="glyphicon glyphicon-chevron-down"></span>
          </a>
        </div>
          <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav">  
              <li><a href="#">Link</a></li>
              <li><a href="#">Link</a></li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Channels</a>
                <ul class="dropdown-menu">
                  <li><a href="#">Sub-link</a></li>
                  <li><a href="#">Sub-link</a></li>
                  <li><a href="#">Sub-link</a></li>
                  <li><a href="#">Sub-link</a></li>
                  
                </ul>
              </li>
            </ul>
            <ul class="nav navbar-right navbar-nav">
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="glyphicon glyphicon-search"></i></a>
                <ul class="dropdown-menu" style="padding:12px;">
                    <form class="form-inline">
                      <button type="submit" class="btn btn-default pull-right"><i class="glyphicon glyphicon-search"></i></button><input type="text" class="form-control pull-left" placeholder="Search">
                    </form>
                 </ul>
              </li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="glyphicon glyphicon-user"></i> <i class="glyphicon glyphicon-chevron-down"></i></a>
                <ul class="dropdown-menu">
                  <li><a href="#">Login</a></li>
                  <li><a href="#">Profile</a></li>
                  <li class="divider"></li>
                  <li><a href="#">About</a></li>
                 </ul>
              </li>
            </ul>
          </div>
        </div>
      </nav>
      <!-- End navbar -->

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
                  <form id="movieForm" action="query.php" method="GET">
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
                            <input class="form-control" name='actor' placeholder="Search by Actor">
                          </div>
                      </li>
                      <li>
                          <div class="form-group">
                            <input class="form-control" name='director' placeholder="Search by Director">
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
                          <button type="submit" class="btn btn-default" id='submit'>Submit</button>
                        </div>
                      </li>
                  </form>
              </div>
          </ul>
      </div>
      <!-- /#sidebar-wrapper -->

      <!-- Page Content -->
      <div id='content'>
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div id='dynamic'>

                        </div>
                        <h1>Simple Sidebar</h1>
                        <p>This template has a responsive menu toggling system. The menu will appear collapsed on smaller screens, and will appear non-collapsed on larger screens. When toggled using the button below, the menu will appear/disappear. On small screens, the page content will be pushed off canvas.</p>
                        <p>Make sure to keep all page content within the <code>#page-content-wrapper</code>.</p>
                        <a href="#menu-toggle" class="btn btn-default" id="menu-toggle2">Try another Search</a>
                    </div>
                </div>
            </div>
        </div>
      </div>
      <!-- /#page-content-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- Footer -->
    <footer class="footer">
      <div class="container">
        <p class="text-muted">Place sticky footer content here.</p>
      </div>
    </footer>
    <!-- End of Footer -->

  <!-- jQuery -->
  <script src="js/jquery.js"></script>

  <!-- Bootstrap Core JavaScript -->
  <script src="js/bootstrap.min.js"></script>

  <!-- Menu Toggle Script -->
  <script>
  $("#menu-toggle").click(function(e) {
      e.preventDefault();
      $("#wrapper").toggleClass("toggled");
  });
  $("#menu-toggle2").click(function(e) {
      e.preventDefault();
      $("#wrapper").toggleClass("toggled");
  });
  </script>

  <!-- Custom JS -->
  <script src="js/controller-main.js"></script>

</body>
</html>