<?php
/*
    $controller->addContactInfo('facebook', 'bobsburgers');
    $controller->displayContactInfo();
    $controller->updateContactInfo(3, "xbox gamertag", "420xNoScope");
    $controller->displaycontactInfo();
    $controller->deleteContactInfo(3);
*/
//    $controller->displayContactInfo();
/*
    $controller->setAbout("WOOOOOOOOOOO!!!!!<br>urlsauce.com/R<br>urlsauce.com/i<br>");
    echo $controller->getAbout();

    

    $city = "Columbia";
    $state = "Missouri (Misery)";
    $zip_code = 65201;
  //  echo $zip_code;
    
    $updateButtonPressed = true;
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
    echo isset($location) ? $location : $controller->getLocation();
*/
?>
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
    
    <body id="body">
    <form action="#" method="post">
        <?php require_once('view/views/navbar_component.php');
        ?>

        
        <div class="panel panel-default container-fixed container">
            <div class="panel-body"> <!--box-->

            <!--location settings-->
            <div class="row">
                <div class="col-lg-12">
                    <h2>Location Settings</h2>
                </div>
            </div>
                    
            <!--range section-->
            <div class="row">        
                <div class="col-md-3">
                    <h3 class="">Range</h3>
                </div>
                <!--div class="col-md-8"></div>blank mid spacing-->
                <!--mi/km toggle-->
                <div class="col-md-offset-11">
                    <!--<input id="units-toggle" checked type="checkbox" data-style="android" data-onstyle="success" data-offstyle="success" data-toggle="toggle" data-on="mi" data-off="km">-->
                <input id="units-toggle" checked type="checkbox" data-style="" data-onstyle="success" data-offstyle="success" data-toggle="toggle" data-on="mi" data-off="km" name="distanceUnits">

                </div>
            </div> 
                
            <!--range slider, needs both bootstrap and js-->
            <div class="row">
                <div class="col-md-12">
                    <!-- <input id="mySlider" type="text" data-slider-min="0" data-slider-max="100" data-slider-step="5" data-slider-value="25"> -->

                    <input id="mySlider" type="text" name="distance">

                    <!--shows number when sliding, does not really work if clicked-->
                    <span id="CurrentSliderValLabel"> : <span id="mySliderVal"></span></span>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                      
                       <script type="text/javascript">// Instantiate a slider
                            var mySlider = $("input.slider").slider();

                            // Call a method on the slider
                            var value = mySlider.slider('getValue');


                            // // For non-getter methods, you can chain together commands
                            // mySlider
                            //     .slider('setValue', 5)
                            //     .slider('setValue', 7);
                        </script>

                        <script type="text/javascript">
                        $("#mySlider").slider({ id: "mySlider", min: 0, max: 200, value: 50, step:5 });
                        $("#mySlider").on("slide", function(slideEvt) {
                            $("#mySliderVal").text(slideEvt.value);
                        });</script>

                        
           
                </div>
            </div>
            <br>
                
            <!--area display section-->
            <div class="row">
                
                <div class="form-group col-xs-3">
                    <label for="areaDisplay"><h3>Area Display</h3></label>
                    <select class="form-control" id="areaDisplay">
                        <option>[City], [State]</option>
                        <option>[State] Area</option>
                        <option>Anonymous -> minimizes location features</option>
                    </select>
                </div>
            </div>
             
                
            <!--location settings-->
            <div class="row">
                <div class="col-lg-4">
                        <h2>User Settings</h2>
                </div>
                <div class="col-lg-4">
                        
                </div>
                <div class="col-lg-4">
                        <h2>Profile Settings</h2>
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
                                <input type="text" placeholder="alias" name="alias">
                            </div>
                        </div>
                            <br>
                        <div class="row">    
                            <div class="col-md-3">
                                Public Email
                            </div>
                            <div class="col-md-offset-3">
                                <input type="text" placeholder="public Email" name="publicEmail">
                            </div>
                        </div>
                            <br>
                        <div class="row">    
                            <div class="col-md-3">
                                Twitch.tv/
                            </div>
                            <div class="col-md-offset-3">
                                <input type="text" placeholder="twtich.tv/" name="twitch">
                            </div>
                        </div>
                            <br>
                        <div class="row">    
                            <div class="col-md-3">
                                Skype
                            </div>
                            <div class="col-md-offset-3">
                                <input type="text" placeholder="skype" name="skype">
                            </div>
                        </div>

                            <br>
                            


                </div>
            </div>
                    <div class="col-lg-4"></div>
                    <div class="col-lg-4">
                        <div class="card card-container">    
                        <br>    
                        <div class="row">    
                            <div class="col-md-3">
                                Top Game
                            </div>
                            <div class="col-md-offset-3">
                                <input type="text" placeholder="most played game" name="topGame">
                            </div>
                        </div>
                        <br>
                        <div class="row">    
                            <div class="col-md-3">
                                Hours Played
                            </div>
                            <div class="col-md-offset-3">
                                <input type="text" placeholder="hours played" name="hoursPlayed">
                            </div>
                        </div>
                        <br>
                        <div class="row">    
                            <div class="col-md-3">
                                Main Genre
                            </div>
                            <div class="col-md-offset-3">
                                <input type="text" placeholder="main genre" name="mainGenre">
                            </div>
                        </div>
    
                            <br>

                         <div class="row">    
                            <div class="col-md-3">
                                Main Console
                            </div>
                            <div class="col-md-offset-3">
                                <input type="text" placeholder="main console" name="mainConsole">
                            </div>
                        </div>
                            <br>
                        <div class="row">    
                            <div class="col-md-3">
                                Sub Console
                            </div>
                            <div class="col-md-offset-3">
                                <input type="text" placeholder="sub console" name="subConsole">
                            </div>
                        </div>   

                        </div>
            </div>
                    
            </div>
            <br>
                
                <div class="row">
                <div class="col-md-4">
                  
                </div>
                <div class="col-md-4">
                     <!-- outlline does not work... <button class="btn btn-sm btn-success-outline" type="submit">Save Changes</button> -->
                    <button class="btn btn-sm btn-success" type="submit" id="saveChanges">Save Changes</button>
                </div>
                <div class="col-md-4">
                  
                </div>
            </div>
                
            <br>
            <hr>
            <br>
                
            <div class="row"> 
                    <div class="col-lg-4"> <h3>Change Password</h3>
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
            </div>
                
                <br>
                    
                    
                    
            <!-- password stuff -->
             <!--       
            <div class="row">    
                <div class="col-md-2">
                    <h5>Change Password</h5>
                </div>
                <div class="col-md-offset-2">
                    <input type="password" placeholder="password" name="password"><h6> *Optional</h6>
                    <input type="password" placeholder="confirm password" name="passwordConfirm">
                </div>
            </div> -->

            
            <div class="row">
                <div class="col-md-3">
                    <!-- outlline does not work... <button class="btn btn-sm btn-success-outline" type="submit">Save Changes</button> -->
                    <button class="btn btn-sm btn-success" type="submit">Save Password</button>
                </div>
            </div>
    </form>
    
            <br><br><br><br>
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
