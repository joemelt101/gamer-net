<<<<<<< HEAD
<?php
/*
    $controller->addContactInfo('facebook', 'bobsburgers');
    $controller->displayContactInfo();
    $controller->updateContactInfo(3, "xbox gamertag", "420xNoScope");
    $controller->displaycontactInfo();
    $controller->deleteContactInfo(3);
*/
//    $controller->displayContactInfo();
    //$controller->setAbout("WOOOOOOOOOOO!!!!!<br>urlsauce.com/R<br>urlsauce.com/i<br>");
    $controller->getAbout();

    

    $city = "Columbia";
    $state = "Missouri (Misery)";
    $zip_code = 65201;
  //  echo $zip_code;
    
    $updateButtonPressed = false;
    if ($updateButtonPressed)
    {
        if ($location = $controller->getLocation() == "empty")
            $controller->addLocation($city, $state, $zip_code);
        else
        {
            $controller->setLocation($city, $state, $zip_code);
        }
        $location = $controller->getLocation();
    }
    isset($location) ? $location : $controller->getLocation();

?>
=======

>>>>>>> 0547e24a2203cd015797ef879308ba4699124a32
<!DOCTYPE html>
<html>
    <head>
        
        <link rel="stylesheet" type="text/css" href="custom.css">
        <!--css, to be moved? moved-->
        <style>
            .toggle.android { 
                border-radius: 0px;
            }
            .toggle.android .toggle-handle { 
                border-radius: 0px; 
            }
            #body{
                /*background-color: dimgray;*/
            }
            .centered{
                display: block;
                margin-left: auto;
                margin-right: auto;
            }
            .verticallyCentered{
                line-height: 1.5em;
            }
            .clear {
                clear: both;
            }
            #areaDisplay{
                background-color: #5cb85c; /*success green*/
                color: white;
            }
            /*doesn't really work*/
            /*tried to get this hover color to work...*/
            .navbar-nav a:hover{
                background-color: #5cb85c;
            }
            #mySlider .slider-track-high {
                background: #5cb85c;
            }
            
            /* ===================================
            
                        Art's  CSS changes
            
            =====================================*/ 
            
            
                        /*
             * Card component
             */
            .card {
               
                background-color: #333;
            
                /* just in case there no content*/
                padding-left: 10px;
                padding-bottom: 10px;
                /* shadows and rounded borders */
                -moz-border-radius: 2px;
                -webkit-border-radius: 2px;
                border-radius: 2px;
                -moz-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
                -webkit-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
                box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
            }
            
            #saveChanges {
             margin: 0 auto;   
            }
            
            .left {
                float: left;
                padding-left: 15px;
                
            }
            
            
        </style>
        <title>G-N Settings</title>  
        <!-- Import Libraries Dynamically so as to change in only one spot... -->
        
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>

        <!-- Latest compiled JavaScript -->
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

        <!--http://www.bootstraptoggle.com/-->
        <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
        <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

        <!--Bootstrap Slider - https://cdnjs.com/libraries/bootstrap-slider, https://github.com/seiyria/bootstrap-slider-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/7.0.0/bootstrap-slider.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/7.0.0/bootstrap-slider.min.js"></script>
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/7.0.0/css/bootstrap-slider.css">
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/7.0.0/css/bootstrap-slider.min.css">


        <?php require_once('view/views/includes.html');
        ?>

    </head>
    
    <body id="dg">
    <form action="#" method="post">
        <?php require_once('view/views/navbar_component.php');
        ?>

        
        <div class="panel panel-default container-fixed container" id="lg">
            <div class="panel-body"> <!--box-->

            <!--location settings-->
            <br>
               <div class="row">
                <div class="col-lg-4">
                        
                </div>
                <div class="col-lg-4 text-center">
                        <h2>Settings</h2>    
                </div>
                <div class="col-lg-4">
                        
                </div>
                </div>
                <br>  
                
            <br><hr><br>
            <!--location settings-->
            <div class="row">
                <div class="col-lg-4 text-center">
                        <h2>User Settings</h2>
                </div>
                <div class="col-lg-4 text-center">
                        <h2>Location Settings</h2>    
                </div>
                <div class="col-lg-4 text-center">
                        <h2>Game Settings</h2>
                </div>
                </div>
                <br>

                <div class="row">
                    <div class="col-lg-4">
                        <div class="card card-container">    
                        <br>    
                        <div class="row">    
                            <div class="col-md-3">
                                Alias
                            </div>
                            <div class="col-md-offset-3">
                                <input type="text" placeholder="Alias" name="alias">
                            </div>
                        </div>
                            <br>
                        <div class="row">    
                            <div class="col-md-3">
                                Public Email
                            </div>
                            <div class="col-md-offset-3">
                                <input type="text" placeholder="Public Email" name="publicEmail">
                            </div>
                        </div>
                            <br>
                        <div class="row">    
                            <div class="col-md-3">
                                Profile Picture
                            </div>
                            <div class="col-md-offset-3">
                                <label class="control-label"></label>
    <input id="input-2" name="input2[]" type="file" class="file" multiple data-show-upload="false" data-show-caption="true">
                            </div>
                        </div>
                            
                                
                            


                </div>
            </div>
                    
                    
                    <div class="col-lg-4">
                        <div class="card card-container">    
                        <br>    
                        <div class="row">    
                            <div class="col-md-3">
                                City
                            </div>
                            <div class="col-md-offset-3">
                                <input type="text" placeholder="City" name="city">
                            </div>
                        </div>
                        <br>
                        <div class="row">    
                            <div class="col-md-3">
                                State
                            </div>
                            <div class="col-md-offset-3">
                                <input type="text" placeholder="State" name="state">
                            </div>
                        </div>
                        <br>
                        <div class="row">    
                            <div class="col-md-3">
                                Zipcode
                            </div>
                            <div class="col-md-offset-3">
                                <input type="text" placeholder="Zipcode" name="zipcode">
                            </div>
                        </div>
    
                            <br> 
                        </div>
                    </div>
                    
                    
                    <div class="col-lg-4">
                        <div class="card card-container">    
                        <br>    
                        <div class="row">    
                            <div class="col-md-3">
                                Platform
                            </div>
                            <div class="col-md-offset-3">
                                <input type="text" placeholder="Platform" name="platform">
                            </div>
                        </div>
                        <br>
                        <div class="row">    
                            <div class="col-md-3">
                                Genre
                            </div>
                            <div class="col-md-offset-3">
                                <input type="text" placeholder="Genre" name="genre">
                            </div>
                        </div>
    
                            <br>   

                        </div>
            </div>
                    
            </div>
            <br>
                
                <div class="row">
                <div class="col-sm-3 col-sm-offset-5">
                    <button class="btn btn-success">Save Changes</button>
                </div>
            </div>
                </form>    
            <br>
            <hr>
            <br>
            
            <form action="#" method="post">    
            <div class="row"> 
                <div class="col-lg-4"> </div>
                    <div class="col-lg-4"> <h3 class="text-center">Add Game</h3>
                        <br>
                        <div class="card card-container">    
                        <br> 
                        <div class="row">    
                            <div class="col-md-3">Name
                            </div>
                            <div class="col-md-offset-3">
                                <input type="text" placeholder="Name" name="gameName">
                            </div>
                        </div>
                            <br>
                        <div class="row">    
                            <div class="col-md-3">Developer
                            </div>
                            
                            <div class="col-md-offset-3">
                                <input type="text" placeholder="Developer" name="gameDev">
                            </div>
                        </div>
                             <br>
                        <div class="row">    
                            <div class="col-md-3">Platform
                            </div>
                            
                            <div class="col-md-offset-3">
                                <input type="text" placeholder="Platform" name="gamePlat">
                            </div>
                        </div>
                            
                             <br>
                        <div class="row">    
                            <div class="col-md-3">Genre
                            </div>
                            
                            <div class="col-md-offset-3">
                                <input type="text" placeholder="Genre" name="gameGenre">
                            </div>
                        </div>
                            
                             <br>
                        <div class="row">    
                            <div class="col-md-3">Year
                            </div>
                            
                            <div class="col-md-offset-3">
                                <input type="text" placeholder="Year" name="gameYear">
                            </div>
                        </div> 
                            
                             <br>
                        <div class="row">    
                            <div class="col-md-3">Type
                            </div>
                            
                            <div class="col-md-offset-3">
                                <input type="text" placeholder="Type" name="gameType">
                            </div>
                        </div>
                            
                             <br>
                        <div class="row">    
                            <div class="col-md-3">Description
                            </div>
                            
                            <div class="col-md-offset-3">
                                <input type="text" placeholder="Description" name="gameDesc">
                            </div>
                        </div>  
                        
                        </div>
                    
                    </div>
                <div class="col-lg-4"> </div>
            </div>
                
                <br>
                    


            
           <div class="row">
                <div class="col-sm-3 col-sm-offset-5">
                    <button class="btn btn-success">Add Game</button>
                </div>
            </div>
    </form>
            
            <br><hr><br>
            
            
            <form action="#" method="post">    
            <div class="row "> 
                <div class="col-lg-4"> </div>
                    <div class="col-lg-4"> <h3 class="text-center">Change Password</h3>
                        <br>
                        <div class="card card-container">    
                        <br> 
                        <div class="row">    
                            <div class="col-md-3">
                            </div>
                            <div class="col-md-offset-3">
                                <input type="text" placeholder="password" name="password">
                            </div>
                        </div>
                        <div class="row">    
                            <div class="col-md-3">
                            </div>
                            <br>
                            <div class="col-md-offset-3">
                                <input type="text" placeholder="confirm password" name="passwordConfirm">
                            </div>
                        </div>  
                        
                        </div>
                    
                    </div>
                <div class="col-lg-4"> </div>
            </div>
                
                <br>
            

            
           <div class="row">
                <div class="col-sm-3 col-sm-offset-5">
                    <button class="btn btn-success">Save Password</button>
                </div>
            </div>
    </form>
    
            <br><br> <hr><br><br>
            <form method="post" action="#"> <!-- delete account php? -->
            <div class="row">
                <div class="col-sm-3 col-sm-offset-5">
                    <button class="btn btn-danger">Delete Profile</button>
                </div>
            </div>
            </form>

        </div><!--close panel body-->
    </div><!--close main-->
        
        <footer class="centered">Copyright 2016 (find footer)</footer>

    </body>
    
</html>
