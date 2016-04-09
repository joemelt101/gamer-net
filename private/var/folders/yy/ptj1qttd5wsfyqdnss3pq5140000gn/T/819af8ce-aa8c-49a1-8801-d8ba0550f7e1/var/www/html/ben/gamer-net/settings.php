<!DOCTYPE html>
<html>
    <head>
        
        <link rel="stylesheet" type="text/css" href="custom.css">
        <!--css, also moved-->
        <style>
            .toggle.android { border-radius: 0px;}
            .toggle.android .toggle-handle { border-radius: 0px; }
            #body{
                background-color: dimgray;
            }
            .centered{
                margin-left: auto;
                margin-right: auto;
            }
            .verticallyCentered{
                line-height: 1.5em;
            }
            .clear {
                clear: both;
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
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/6.1.7/bootstrap-slider.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/6.1.7/bootstrap-slider.min.js"></script>
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/6.1.7/css/bootstrap-slider.css">
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/6.1.7/css/bootstrap-slider.min.css">


        <?php require_once('view/views/includes.html');
        ?>

    </head>
    
    <body id="body">
    <form>
        <?php require_once('view/views/navbar_component.php');
        ?>

        <!--location settings-->
        <div class="panel panel-success container-fixed container">

            <div class="row">
                <div class="col-lg-12">
                    <h2>Location Settings</h2>
                </div>
            
                    
                    <!--range section-->
                <div class="row">        
                    <div class="col-md-2">
                        <h3 class="">Range</h3>
                    </div>
                    <div class="col-md-8"></div><!--blank mid spacing-->
                    <!--mi/km toggle-->
                    <div class="col-md-2">
                        <!--<input id="units-toggle" checked type="checkbox" data-style="android" data-onstyle="success" data-offstyle="success" data-toggle="toggle" data-on="mi" data-off="km">-->
                    <input id="units-toggle" checked type="checkbox" data-style="" data-onstyle="success" data-offstyle="success" data-toggle="toggle" data-on="mi" data-off="km">
<!--
                        <script>
                            $(function() {
                                $('#units-toggle').bootstrapToggle(
                                    {   /*on: 'Mi',
                                        off: 'Km'*/

                                    });
                            })
                        </script>
-->
                    </div>
                </div> 
                
            <!--range slider-->
            <div class="row">
                <div class="col-md-12">
                    <input id="rangeSlider" data-slider-id='rangeSlider' type="text" data-slider-min="0" data-slider-max="100" data-slider-step="5" data-slider-value="25"/>
                </div>

                <div class="col-md-12">
                    
                    
                    <script type="text/javascript">// Instantiate a slider
                    var mySlider = $("input.slider").slider();

                    // Call a method on the slider
                    var value = mySlider.slider('getValue');

                    // For non-getter methods, you can chain together commands
                    mySlider
                        .slider('setValue', 5)
                        .slider('setValue', 7);</script>

                        <script type="text/javascript">$('#rangeSlider').slider({
                            formatter: function(value) {
                                return 'Current value: ' + value;
                            }
                        });</script>

                </div>
            </div>
            <br>
                
            <div class="row">

                    <!---------------------------->
                    <!--display section-->
                    <div class="col-md-2 dropdown">
                        <button class="btn btn-primary dropdown-toggle btn-success" type="button" data-toggle="dropdown">Area Display
                            <span class="caret"></span>
                        </button>
                                <ul class="dropdown-menu">
                                    <li><a href="#">[City], [State]</a></li>
                                    <li><a href="#">[State] Area</a></li>
                                    <li><a href="#">Anonymous -> minimizes location features</a></li>
                                </ul>
                    </div>
                    <div class="col-md-10 clear"></div>
                    
                        
                    <br><br><br>
            </div>
                    
            <div class="row">    
                <!-------------------->
                    <!--friends list section-->
                    <div class="col-md-6 clear">
                        <h3>Friends List</h3>
                    </div>
                </div>

                <div class="col-md-6"></div>
                </div>
                <div class="col-md-6">
                    <a href="#">Change Alias</a><br>
                    <a href="#">Change Password</a>
                </div>
                
            </div>

        
    
    </form>
        
        <footer class="centered">Copyright 2016, or something like that</footer>

    </body>
    
</html>