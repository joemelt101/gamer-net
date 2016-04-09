<!-- GAMER-NET -- SEARCH PAGE -->
<!DOCTYPE html>
<html>
    <head>
        <title>Gamer-net -- Search</title>
        <!-- Import Libraries Dynamically so as to change in only one spot... -->
        <?php require_once('view/views/includes.html'); ?>        
        <style>
            #searchbar
            {
                background-color: crimson
            }
            
            #buttons
            {
                background-color: beige;
            }
            
            #friends-panel
            {
                background-color: aqua;
            }
            
        </style>
    </head>
    <body> 
        <?php require_once('view/views/navbar_component.php'); ?>
        
        <div class='panel fixed-container container'>
            <div class='panel-body'>
                <div class='row'>
                    <div id='searchbar' class='col-xs-6'>
                        col1
                    </div>
                    <div id='buttons' class='col-xs-6'>
                        col2
                    </div>
                </div>
                <div id='friends-panel' class='row'>
                    <div class='row'>
                        friend1
                    </div>
                    <div class='row'>
                        friend2
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>