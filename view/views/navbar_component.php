<!-- View data is defined here -->
<?php

$isLoggedIn = true;

?>

<!-- Actual display of the view is defined here -->
<nav class="navbar navbar-default ">
    <div class="container">
      <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Gamer-Net</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav navbar-right">
    <?php 
            if ($isLoggedIn)
            {
                echo("<li><a href=\"#\">Logout</a></li>");
            }
            else
            {
                echo ("<li><a href=\"#\">Login</a></li>");
            }

    ?>        
            <li><a href="search_page.php">Search</a></li>     
          </ul>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </div>
</nav>