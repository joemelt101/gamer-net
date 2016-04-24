
<!-- GAMER-NET - SEARCH PAGE -->
<html>
    <head>
        <title>Gamer-net -- Search</title>
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

            <div class='panel-heading'>
                <div class='row'>
                    <div class='col-xs-12'>
                        <form action='search' method='POST' class='input-group input-group-sm'>
                           <input name='searchBox' type='text'class='form-control' placeholder='Search'>
                           <div class='input-group-btn'>
                            <!--    <button type='submit' class='btn btn-default'>
                                    <span class='glyphicon glyphicon-search'></span>
                                </button>-->
                                <button type='submit' id='userSearch' name='searchType' value='userSearch' class='btn btn-default'>Username</button>
                                <button type='submit' id='gameSearch' name='searchType' value='gameSearch' class='btn btn-default'>Game</button>
                                <button type='submit' id='locationSearch' name='searchType' value='locationSearch' class='btn btn-default'>Location</button>
                           </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class='panel-body fixed-container'>
                <?php
                if (isset($data->games))
                    foreach($data->games as $game)
                    {
                        echo $game->getName(), "<br>";
                    }
                else if (isset($data->users))
                    foreach ($data->users as $user)
                {?>
                <div class='user row'>
                    <div class='picture col-xs-4'>
                        <img src="view/images/face.jpg" alt="..." class="img-circle">
                    </div>
                    <div class='info col-xs-8'>
                        <div class='username row'>
                            <?php
                                
                                echo "<h1>", $user->alias, "</h1>";
                                if ($user->alias != $user->username)
                                    echo "<h3>", $user->username, "</h3>";
                            ?>
                        </div>
                        <div class='userfriends row'>
                            <h4>Friends</h4>
                            <img src="view/images/face.jpg" alt='...' width='30' height='30'>
                            <img src="view/images/face.jpg" alt='...' width='30' height='30'>
                            <img src="view/images/face.jpg" alt='...' width='30' height='30'>
                            <img src="view/images/face.jpg" alt='...' width='30' height='30'>
                            <img src="view/images/face.jpg" alt='...' width='30' height='30'>
                            <img src="view/images/face.jpg" alt='...' width='30' height='30'>
                            <img src="view/images/face.jpg" alt='...' width='30' height='30'>
                        </div>
                        <div class='games row'>
                            <h4>Games</h4>
                            <img src="view/images/game_icon.jpg" alt="..." width='30' height='30'>
                            <img src="view/images/game_icon.jpg" alt="..." width='30' height='30'>
                            <img src="view/images/game_icon.jpg" alt="..." width='30' height='30'>
                            <img src="view/images/game_icon.jpg" alt="..." width='30' height='30'>
                            <img src="view/images/game_icon.jpg" alt="..." width='30' height='30'>
                        </div>
                    </div>
                </div><?php
                }
                else if (isset($data->locations))
                    foreach ($data->locations as $location)
                    {
                        echo $location->getCity(), ", ", $location->getState(), " ", $location->getZip(), "<br>";
                    }
                ?>
            </div>

            <div class='panel-footer'>
                <h6><a>Load more</a></h6>
            </div>


        </div>
    </body>
</html>
