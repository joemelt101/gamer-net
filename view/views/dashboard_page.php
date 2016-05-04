
<!DOCTYPE html>

<html>
    <head>
        <title><?php 
            if (isset($_GET['user']))
                echo "Profile | ", $data->alias;
            else
                echo "Dashboard";
        ?></title>
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
                            <h2><?php echo $data->welcome;?></h2>
                        </div>
                        <?php
                            if (isset($_GET['user']))
                            {
                                if ($data->loggedUser)
                                {
                                    // prevent user from being able to add/block himself
                                    if ($data->loggedUser->getUsername() != $data->username)
                                    {
                                        //need to add logic for checking if already friend, etc.
                                        $type = $data->loggedUser->getFriend($data->uid);
                                        $value = "Send Friend Request";
                                        
                                        if ($type != -1) // not currently a 'friend' of any kind
                                        {
                                            switch ($type)
                                            {
                                                case 0:
                                                    $value = "Cancel Request";
                                                    break;
                                                case 1:
                                                    $value = "Accept Request";
                                                    break;
                                                case 2:
                                                    $value = "Remove Friend";
                                                    break;
                                                case 3:
                                                    $value = "Unblock";
                                                    break;
                                                default: //user tried to view someone's page who blocked them
                                                    redirect("dashboard");
                                                    break;
                                            }
                                        }
                        ?>
                            <form action="" method="POST">
                                <div class="col-sm-3">    
                                    <input class="btn btn-default" name="friendButton" type=submit value="<?php echo $value;?>">
                                </div>
                                <?php
                                    if ($value != "Unblock")
                                    {?>
                                
                                    <div class="col-sm-2">
                                    <input class="btn btn-default" name="blockButton" type="submit" value="Block">
                                    </div>
                                
        <?php  /* so apparently you need at least one space after <?php or there will be a compile error*/?>
                                <?php }?>
                            </form>
                        <?php
                                        
                                    }
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
                            
                            <!-- Link to Friends -->
                            <?php 
                                if (isset($_GET['user']))
                                {
                                    // prevents user from viewing their own profile as if it were someone else's profile
                                    if ($_GET['user'] == $data->loggedUser->getUsername())
                                        redirect("dashboard");
                                    else // viewing someone else's profile
                                        echo "<h3>Friends</h3>";
                                }
                                else // user is logged on and at their own dashboard
                                    echo "<a href = \"friends\"><h3>Friends</h3></a>";
                            
                            ?>
                            <div class="row">
                                <?php
                                if (isset($data->friends))
                                {
                                    $friends = $data->friends;
                                    $numOfFriends = count($friends);
                                    
                                    for ($i = 0; $i < $numOfFriends && $i < 6; $i++)
                                    {
                                        $friend = $friends[$i];
                                        if ($friend->type == "") // currently friends
                                        {
                                ?>
                                    <div class="col-sm-2 dark">
                                    <a href ="<?php echo $relativePath;?>user/<?php echo $friend->username;?>">
                                        <p class="text-center">
                                            <span class="glyphicon text-large glyphicon-user"></span>
                                            <br />
                                            <h6 class = "text-center"><?php echo $friend->alias;?></h6>
                                        </p>
                                    </a>
                                    <h6><?php
                                            if ($friend->alias != $friend->username)
                                                echo $friend->username;
                                        ?>
                                    </h6>
                                </div>
                                <?php
                                        }
                                    }
                                }
                                ?>
                                
                            </div>
                            
                            <!-- A list of Games -->
                            
                            <!-- Link to Friends -->
                            <div class="top30">
                                <h3>Games You Play</h3>

                                <div class="row">
                                <?php
                                    if (isset($data->games))
                                    {
                                        $games = $data->games;
                                        $numOfGames = count($games);
                                        for ($i = 0; $i < $numOfGames && $i < 6; $i++)
                                        {?>
                                    <div class="col-sm-2 dark">
                                        <p class="text-center"><span class="glyphicon text-large glyphicon-knight"></span><br /><?php echo $games[$i]->getName(); ?></p>
                                    </div>
                                    <?php
                                        }
                                    }?>
                                </div>
                            </div>
                            
                            <!-- About Me -->
                            <div class="top30">
                                <h3>About Me</h3>
                                <?php echo $data->about;?>
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
                        <!--        <address>
                                  <strong>Twitter, Inc.</strong><br>
                                  1355 Market Street, Suite 900<br>
                                  San Francisco, CA 94103<br>
                                  <abbr title="Phone">P:</abbr> (123) 456-7890
                                </address> -->
                                <address>
                                    <?php
                                        $location = $data->location;
                                        if (isset($location[0]))
                                            echo $location[0];
                                        if (isset($location[1]))
                                        {
                                            if (isset($location[0]))
                                                echo ", ";
                                            echo $location[1];
                                        }
                                        if (isset($location[2]))
                                        {
                                            if (isset($location[0]) || isset($location[1]))
                                                echo " ";
                                            echo $location[2];
                                        }
                                    ?><br>
                                </address>
                                
                                
                             <!-- this should only be shown if user is viewing another user's profile   
                                <h4>Status</h4>
                                <p>Feeling pretty good right now! Loving Starcraft 2!!!!</p> -->
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