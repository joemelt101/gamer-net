
<!DOCTYPE html>

<html>
    <head>
        <title><?php echo $data->name;?></title>
        <!-- Import Libraries Dynamically so as to change in only one spot... -->
        <?php require_once(__DIR__ . '/includes.php'); ?>
        
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
    <body id="dg">
        <?php require_once(__DIR__ . '/navbar_component.php'); ?>
        
        
        <div class="container-fixed container">
            <div class="panel panel-default">
                <div class="panel-heading" id="blueGrey">
                    <div class="row">
                        <div class="col-sm-6">
                            <h2><?php echo $data->name;?></h2>
                        </div>
                            <?php
                                if (isset($data->inUserGameList))
                                {
                                    
                                    if ($data->inUserGameList)
                                    {
                                    ?>
                                        <form action="<?php echo $relativePath . 'game/' . $data->gid;?>" method="POST">
                                        <div class="col-sm-3">
                                            <h3></h3>
                                            <input class="btn btn-default" name="gameButton" type=submit value="Remove">
                                        </div>
                                    </form>
                                    <?php
                                    }
                                    else
                                    {
                                    ?>
                                        <form action="<?php echo $relativePath . 'game/' . $data->gid;?>" method="POST">
                                        <div class="col-sm-3">    
                                            <input class="btn btn-default" name="gameButton" type=submit value="Add">
                                        </div>
                                    </form>
                                    <?php
                                    }
                                    
                                }
                            ?>
                    </div>
                </div>
                
                <div class="panel-body" id="lg">
                    
                    <!-- 2 Columns for this Layout -->
                    <div class="row">
                        
                        <!-- Left Column -->
                        <div class="col-sm-8">
                            
                            
                            <!-- About Me -->
                            <div class="top30">
                                <?php
                                if (isset($data->videoLink))
                                {
                                    ?>
                                    <iframe width="420" height="315" src="<?php echo $data->videoLink;?>" frameborder="0" allowfullscreen></iframe>
                                    <br>
                                    <?php
                                }
                                echo $data->description;?>
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
                                <h5><?php
                                        if ($data->developer != "")
                                            echo "Developer: ", $data->developer, "<br>";
                                    ?></h5>
                                    <h5><?php
                                        if ($data->platform != "")
                                            echo "Platform: ", $data->platform, "<br>";
                                    ?></h5>
                                    <h5><?php
                                        if ($data->genre != "")
                                            echo "Genre: ", $data->genre, "<br>";
                                    ?></h5>
                                    <h5><?php
                                        if ($data->year != "")
                                            echo "Year: ", $data->year, "<br>";
                                    ?></h5>
                                    <?php
                                        if ($data->type == 1)
                                        {
                                            echo "<h5>", "Type: ", "Board Game", "</h5>";
                                        }
                                    ?>
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