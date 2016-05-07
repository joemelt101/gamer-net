
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
        <title>Gamer-Net | Settings</title>  
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


        <?php require_once('view/views/includes.php');
        ?>

    </head>
    
    <body id="dg">
        <?php require_once('view/views/navbar_component.php');
        ?>

        
        <div class="panel panel-default container-fixed container" id="lg">
            <div class="panel-body"> <!--box-->
                           <div class="row">
                <div class="col-lg-4">
                        
                </div>
                <div class="col-lg-4 text-center">
                        <h2>Add Game</h2>    
                </div>
                <div class="col-lg-4">
                        
                </div>
                </div>
            <form action="addGame" method="post">    
            <div class="row"> 
                <div class="col-lg-4"> </div>
                    <div class="col-lg-4">
                        <br>
                        <div class="card card-container">    
                        <br> 
                        <div class="row">    
                            <div class="col-md-3">Name
                            </div>
                            <div class="col-md-offset-3">
                                <input type="text" placeholder="Name" name="name">
                            </div>
                        </div>
                            <br>
                        <div class="row">    
                            <div class="col-md-3">Developer
                            </div>
                            
                            <div class="col-md-offset-3">
                                <input type="text" placeholder="Developer" name="developer">
                            </div>
                        </div>
                             <br>
                        <div class="row">    
                            <div class="col-md-3">Platform
                            </div>
                            
                            <div class="col-md-offset-3">
                                <input type="text" placeholder="Platform" name="platform">
                            </div>
                        </div>
                            
                             <br>
                        <div class="row">    
                            <div class="col-md-3">Genre
                            </div>
                            
                            <div class="col-md-offset-3">
                                <input type="text" placeholder="Genre" name="genre">
                            </div>
                        </div>
                            
                             <br>
                        <div class="row">    
                            <div class="col-md-3">Year
                            </div>
                            
                            <div class="col-md-offset-3">
                                <input type="text" placeholder="Year" name="year">
                            </div>
                        </div> 
                            
                             <br>
                        <div class="row">    
                            <div class="col-md-3">Type
                            </div>
                            
                            <div class="col-md-offset-3">
                                <input type="radio" name="type" value="0" checked>Video Game
                                <input type="radio" name="type" value="1">Board Game
                            </div>
                        </div>
                            
                             <br>
                        <div class="row">    
                            <div class="col-md-3">Description
                            </div>
                            
                            <div class="col-md-offset-3">
                                <textarea style="color: black"rows="4" cols="30" placeholder="Description" name="description"></textarea>
                            </div>
                        </div>
                        <br>
                        <div class="row">    
                            <div class="col-md-3">Youtube Video ID</div>
                            <div class="col-md-offset-3">
                                <input type="text" placeholder="Video ID" name="videoID">
                            </div>
                        </div>  
                        
                        </div>
                    
                    </div>
                <div class="col-lg-4"> </div>
            </div>
                <br>
           <div class="row">
                <div class="col-sm-3 col-sm-offset-5">
                    <button name="addGameButton" class="btn btn-success">Add Game</button>
                </div>
            </div>
            
    </form>
        </div><!--close panel body-->
    </div><!--close main-->
        
        <footer class="centered">Copyright 2016 (find footer)</footer>

    </body>
    
</html>
