<!-- View data is defined here -->
<?php
    $isLoggedIn = $_SESSION['user'];
?>

<!-- Actual display of the view is defined here -->
<nav class="navbar navbar-inverse">
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
            
          <a class="navbar-brand" href="<?php echo $relativePath; ?>index.php">Gamer-Net</a>
            <ul class="nav navbar-nav">
                <li><a href="<?php echo $relativePath; ?>dashboard"><span class="glyphicon glyphicon-home">Home</span></a></li>
                <li><a href="<?php echo $relativePath; ?>search"><span class="glyphicon glyphicon-home">Search</span></a></li>
                <li><a href="<?php echo $relativePath; ?>settings"><span class="glyphicon glyphicon-home">Settings</span></a></li>
            </ul>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav navbar-right">
    <?php 
            if ($isLoggedIn)
            {
                echo("<li><a href=\"" . $relativePath .  "controller/controllers/logout.php\">Logout</a></li>");
            }
            else
            {
                echo ("<li><a href=\"" . $relativePath . "login\">Login</a></li>");
            }
    ?>        
            <li><a href="<?php echo $relativePath;?>search">Search</a></li>     
          </ul>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </div>
</nav>
