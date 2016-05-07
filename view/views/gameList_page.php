
<!-- GAMER-NET - SEARCH PAGE -->
<html>
    <head>
        <title><?php echo $data->username;?> | Game List</title>
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
                ?>
            </div>

            <div class='panel-footer'>
                <h6><a>Load more</a></h6>
            </div>


        </div>
    </body>
</html>