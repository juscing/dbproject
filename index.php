<?php
require_once('conf/config.php');
require_once(ROOT_PATH . 'header.php');
require_once(ROOT_PATH . 'db/dbconnect.php');

$db_connection = DbUtil::loginConnection();
?>
<html>
  <head>
    <link rel="stylesheet" type="text/css" href="css/main.css">
  </head>
  <title>Bootstrap 3 Template / Theme - Bootable</title>
  <body>
  <nav class="navbar navbar-static">
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
  </nav><!-- /.navbar -->

  <!-- Begin Form -->
  <form id="movieForm" action="query.php" method="POST">
    <div class="form-group">
      <label for="exampleInputEmail1">Search by one or more of the following dimensions:</label>
      <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Search by Actor or Actress">
    </div>
    <div class="form-group">
      <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Search by Movie Title">
    </div>
      <div class="form-group">
      <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Search by Director">
    </div>
    <div class="form-group">
      <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Search by Keyword (We'll do our best to search through movie plots)">
    </div>
    <div class="form-group">
      <select class="form-control">
        <option>Genre</option>
        <option>Horror</option>
        <option>Comedy</option>
        <option>Rom-Com</option>
        <option>Action</option>
        <option>Adventure</option>
      </select>
    </div>
    <div class="form-group">
    <!-- Select Multiple -->
      <div class="control-group">
        <label class="control-label" for="selectmultiple">Select Multiple</label>
        <div class="controls">
          <select id="selectmultiple" name="selectmultiple" class="input-xlarge" multiple="multiple">
            <option>1950s</option>
            <option>1960s</option>
            <option>1970s</option>
            <option>1980s</option>
            <option>1990s</option>
            <option>2000s</option>
            <option>2010s</option>
          </select>
        </div>
      </div>
    </div>

    <div class="form-group">
      <p class="help-block">Example block-level help text here.</p>
    </div>
    <div class="form-group">
      <button type="submit" class="btn btn-default">Submit</button>
    </div>
  </form>
  <!-- End of Form -->
  </body>
</html>

  <?php
  require_once('footer.php');
  ?>