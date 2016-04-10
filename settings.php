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
                    
            <br><br>
            <div class="row">    
                <div class="col-md-2">
                    <h5>Change Alias<h5>
                </div>
                <div class="col-md-offset-2">
                    <input type="text" placeholder="alias" name="alias"><h6> *Optional</h6>
                </div>
            </div>

            <br>
            <div class="row">    
                <div class="col-md-2">
                    <h5>Change Password</h5>
                </div>
                <div class="col-md-offset-2">
                    <input type="password" placeholder="password" name="password"><h6> *Optional</h6>
                    <input type="password" placeholder="confirm password" name="passwordConfirm">
                </div>
            </div>

            <br><br>
            <div class="row">
                <div class="col-md-3">
                    <!-- outlline does not work... <button class="btn btn-sm btn-success-outline" type="submit">Save Changes</button> -->
                    <button class="btn btn-sm btn-success" type="submit">Save Changes</button>
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