
<!-- GAMER-NET - SEARCH PAGE -->
<html>
    <head>
        <title><?php echo $data->title;?></title>
        <!-- Import Libraries Dynamically so as to change in only one spot... -->
        <?php require_once('view/views/includes.php'); ?>
        <style>
            body{
                background-color: black;
            }
            .panel-heading, .panel-footer
            {
                text-align: center;
                background-color: rgb(34,34,34);
            }
            .panel-body
            {
                background-color: rgb(150,150,150)
            }
            .user
            {
                border-bottom-style: solid;
                border-bottom-width: 1px;
                border-color: rgb(200,200,200);
                padding: 0px;
                margin: 0px;
            }
            .info
            {
                padding: 3% 0 3% 0;
            }
            .picture
            {
                padding:7% 0 5% 7%;
            }
        </style>
        <script>
            $(document).ready(function(){
                $("button").click(function(){
                    $("button").css('opacity', '1.0');
                    
                    $(this).css('opacity', '0.5');
                    $(this).val(this.id);
                  //  alert(this.id);
                    
                });
            });
        </script>
    </head>
    <body>
        <?php require_once('view/views/navbar_component.php'); ?>

        <div class='container'>
            <div class='panel-body fixed-container'>
                <?php
                if (isset($_GET['user']))
                {
                if ($data->isLoggedUser)
                {
                    echo '<form action="', $relativePath, 'gameList/', $data->username, '" method="POST">';
                }
                if (isset($data->games))
                    foreach ($data->games as $game)
                {?>
                <div class='user row'>
                    <a href = "<?php echo $relativePath, "game/", $game->getGID();?>">
                        <div class='picture col-xs-4'>
                            <img src="<?php echo($relativePath);?>view/images/face.jpg" alt="..." class="img-circle">
                        </div>
                    </a>
                    <div class='info col-xs-8'>
                        <div class='username row'>
                            <a href="<?php echo $relativePath, "game/", $game->getGID();?>">
                                <h1><?php echo $game->getName();?></h1>
                            </a>
                            <h3><?php echo $game->getDeveloper();?></h3>
                            <h5><?php
                                    if ($game->getType() == 0)
                                        echo $game->getPlatform();
                                    else
                                        echo "Board Game";
                                ?></h5>
                            
                            <div>
                            <?php
                            if ($data->isLoggedUser)
                                echo "<button id='", $game->getGID(), "' type='submit' class='btn btn-secondary btn-sm' name='removeGame' value='", $game->getGID(), "'>Remove</button>";
                            ?>
                            </div>
                        </div>
                    </div>
                </div><?php
                }
                if ($data->isLoggedUser)
                    echo "</form>";
                }
                else if (isset($data->gid))
                {?>
                                   <div class="user row">

                <div class="col-lg-4 text-center">
                        <h1>Gamers Playing: <?php echo '<a href="', $relativePath, 'game/', $data->gid, '">', $data->gameName, '</a>';?></h1>
                        <br>
                </div>
                </div>
                <?php
                    foreach($data->users as $user)
                    {
                        $location = Location::loadByID($user->getUID());
                        echo $location->getZip();
                        ?>
                <div class='user row'>
                    <a href = "<?php echo $relativePath, "user/", $user->getUsername();?>">
                        <div class='picture col-xs-4'>
                            <img src="<?php echo($relativePath);?>view/images/face.jpg" alt="..." class="img-circle">
                        </div>
                    </a>
                    <div class='info col-xs-8'>
                        <div class='username row'>
                            <a href="<?php echo $relativePath, "user/", $user->getUsername();?>">
                                <?php
                                    echo '<br>';
                                    echo '<h2>', $user->getUsername(), '</h2>';
                                ?></a><?php
                        
                                    $genderString = getGenderString($user->getGender(), false);
                                    if ($genderString != "")
                                    {
                                        echo '<h4>', $user->getAge(), ', ', $genderString, '</h4>';
                                    }
                                    echo '<h4>', $user->getEmail(), '</h4>';
                                ?>
                        </div>
                    </div>
                </div><?php
                    }
                }?>
            </div>

            <div class='panel-footer'>
                <h6><a>Load more</a></h6>
            </div>


        </div>
    </body>
</html>