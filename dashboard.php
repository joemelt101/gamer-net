<?php
    require_once("helper.php");
?>

<!DOCTYPE html>

<html>
    <head>
        <title>Dashboard</title>
        <!-- Import Libraries Dynamically so as to change in only one spot... -->
        <?php require_once('view/views/includes.html'); ?>
        
        <style>
            a {
                display: block;
                color: inherit;
                text-decoration: inherit;
            }
            
            a:hover {
                display: block;
                text-decoration: inherit;
            }
            
            .text-large {
                font-size: 40px; 
            }
            
            .profile-image {
                font-size: 180px;   
            }
            
            .dark {
                padding-top: 10px;
                background-color: #2e2e2e;
            }
            
            .dark-panel {
                background-color: #2e2e2e;
            }
            
            .top5 { margin-top:5px; }
            .top7 { margin-top:7px; }
            .top10 { margin-top:10px; }
            .top15 { margin-top:15px; }
            .top17 { margin-top:17px; }
            .top30 { margin-top:30px; }
        </style>
    </head>
    
    <body>
        <?php require_once('view/views/navbar_component.php'); ?>
        
        
        <div class="container-fixed container">
            <div class="panel panel-default">
                
                <div class="panel-heading">
                    <?php
                        
                        if (isset($_SESSION['user']))
                        {
                            $user = unserialize($_SESSION['user']);
                        echo "<h2>Welcome, " . $user->getUsername() . " to your dashboard</h2>";
                        }
                    ?>
                </div>
                
                <div class="panel-body">
                    
                    <!-- 2 Columns for this Layout -->
                    <div class="row">
                        
                        <!-- Left Column -->
                        <div class="col-sm-8">
                            
                            <!-- Link to Friends -->
                            <h3>Friends <small>edit</small></h3>

                            <div class="row">
                                <div class="col-sm-2 dark">
                                    <p class="text-center"><span class="glyphicon text-large glyphicon-user"></span><br />First Last</p>
                                </div>
                                <div class="col-sm-2 dark">
                                    <p class="text-center"><span class="glyphicon text-large glyphicon-user"></span><br />First Last</p>
                                </div>
                                <div class="col-sm-2 dark">
                                    <p class="text-center"><span class="glyphicon text-large glyphicon-user"></span><br />First Last</p>
                                </div>
                                <div class="col-sm-2 dark">
                                    <p class="text-center"><span class="glyphicon text-large glyphicon-user"></span><br />First Last</p>
                                </div>
                                <div class="col-sm-2 dark">
                                    <p class="text-center"><span class="glyphicon text-large glyphicon-user"></span><br />First Last</p>
                                </div>
                                <div class="col-sm-2 dark">
                                    <p class="text-center"><span class="glyphicon text-large glyphicon-user"></span><br />First Last</p>
                                </div>
                            </div>
                            
                            <!-- A list of Games -->
                            
                            <!-- Link to Friends -->
                            <div class="top30">
                                <h3>Games You Play <small>edit</small></h3>

                                <div class="row">
                                    <div class="col-sm-2 dark">
                                        <p class="text-center"><span class="glyphicon text-large glyphicon-knight"></span><br />Game Name</p>
                                    </div>
                                    <div class="col-sm-2 dark">
                                        <p class="text-center"><span class="glyphicon text-large glyphicon-knight"></span><br />Game Name</p>
                                    </div>
                                    <div class="col-sm-2 dark">
                                        <p class="text-center"><span class="glyphicon text-large glyphicon-knight"></span><br />Game Name</p>
                                    </div>
                                    <div class="col-sm-2 dark">
                                        <p class="text-center"><span class="glyphicon text-large glyphicon-knight"></span><br />Game Name</p>
                                    </div>
                                    <div class="col-sm-2 dark">
                                        <p class="text-center"><span class="glyphicon text-large glyphicon-knight"></span><br />Game Name</p>
                                    </div>
                                    <div class="col-sm-2 dark">
                                        <p class="text-center"><span class="glyphicon text-large glyphicon-knight"></span><br />Game Name</p>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- About Me -->
                            <div class="top30">
                                <h3>About Me</h3>
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                            </div>
                            
                        </div>

                        <!-- Right Column -->
                        <div class="col-sm-4">
                            <br>
                            
                            <div class="panel panel-default dark-panel">
                                <div class="panel-body text-center">
                                    <span class="profile-image glyphicon glyphicon-user text-large"></span>
                                </div>
                            </div>
                            
                            <div>
                                <h4>Contact Information:</h4>
                                <address>
                                  <strong>Twitter, Inc.</strong><br>
                                  1355 Market Street, Suite 900<br>
                                  San Francisco, CA 94103<br>
                                  <abbr title="Phone">P:</abbr> (123) 456-7890
                                </address>
                                <h4>Status</h4>
                                <p>Feeling pretty good right now! Loving Starcraft 2!!!!</p>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
                <h6 class="text-center">Here is our company information and what not.</h6>
                <h6 class="text-center">Maybe an address here and a copyright symbol.</h6>
        </div>
        
    </body>
    
</html>