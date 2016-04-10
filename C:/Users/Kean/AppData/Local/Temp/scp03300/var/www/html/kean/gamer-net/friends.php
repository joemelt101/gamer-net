<!DOCTYPE html>

<html>
    <head>
        <title>This is my page!</title>  
        <!-- Import Libraries Dynamically so as to change in only one spot... -->      
        
        <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
        <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
        
        <style>
            .rightAlign {
                float: right;
            }
            
            .fullWidth {
                width: 100%;
                height: 100%;
            }
            
            .leftAlign {
                float: left;
            }
            
            .oneThird {
                width: 33%;
            }
            
            .middle {
                width: 100%;
                margin: auto;
                padding-top: 3%;
            }
            
            .panel-group {
                padding-bottom: 30px;
            }
            
            .padding {
                margin-top: 5px;
            }
            
            .center {
                text-align: center;
            }
            
            .alignLeft {
                text-align: left;
            }
            
        </style>
        
        <?php require_once('view/views/includes.html'); ?>
    </head>
    
    <body>
        <?php require_once('view/views/navbar_component.php'); ?>
        
        <div class="panel container-fixed container">
            <div class="panel-body">
                <h3>Your Friends</h3>
                
                <div class="panel-group">
                    <div class="panel panel-default">
                        <div class="panel-body center">
                            <div class="col-sm-4">
                                <div>
                                    <a href="linkto.profile">
                                        <img src="view/images/thumbnail.svg" alt="Profile picture">
                                    </a>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <a href="linkto.profile">
                                    <h4>Username</h4>
                                </a>
                                <h5>Age: xx</h5>
                                <h5>Location: /*location*/</h5>
                                <h5>Gender: M/F</h5>
                                <h5>Availabile: Y/N</h5>
                            </div>
                            <div class="col-sm-4">
                                <h4>Games I'm playing</h4>
                                <div>
                                    <li>Dankey Kang</li>
                                    <li>Sanic the Him Haw</li>
                                    <li>Murica and Squeegee</li>
                                    <li>Kegstand of Smelleda: Fedora's Flask </li>
                                </div>
                                
                            </div>
                            
                            <!--div class="col-sm-3 middle">
                                <button type="button" class="btn btn-primary">Unfriend</button>
                                
                               <input type="checkbox" checked data-toggle="toggle" data-on="Ready" data-off="Not Ready" data-onstyle="success" data-offstyle="danger" data-style="">

                            </div-->
                        </div>
                    </div>
                    <div class="rightAlign padding">
                        <button type="button" class="btn btn-primary">Unfriend</button>
                        <input type="checkbox" checked data-toggle="toggle">
                    </div>

                </div>
            </div>
        </div>
    </body>
</html>