<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar top-bar"></span>
          <span class="icon-bar middle-bar"></span>
          <span class="icon-bar bottom-bar"></span>
        </button>
      <a class="navbar-brand" href="#">
        <img class="logo" alt="Western Sydney Racing" src="assets/images/logo.png" />
      </a>
      <p class="navbar-text">WESTERN SYDNEY RACING</p>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div id="navbar" class="navbar-collapse collapse">
      <ul class="nav navbar-nav navbar-right ">
        <li <?php if($page_name == "home") echo 'class="active"'; ?> ><a href="index.php">HOME</a></li>
        <li <?php if($page_name == "team") echo 'class="active"'; ?> ><a href="team.php">TEAM</a></li>
        <li <?php if($page_name == "car") echo 'class="active"'; ?> ><a href="car.php">CAR</a></li>
        <li <?php if($page_name == "sponsors") echo 'class="active"'; ?> ><a href="sponsors.php">SPONSORS</a></li>
        <li <?php if($page_name == "news") echo 'class="active"'; ?> ><a href="news.php">NEWS</a></li>
        <li <?php if($page_name == "join") echo 'class="active"'; ?> ><a href="join.php">JOIN</a></li>
        <li <?php if($page_name == "contact") echo 'class="active"'; ?> ><a href="contact.php">CONTACT</a></li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
