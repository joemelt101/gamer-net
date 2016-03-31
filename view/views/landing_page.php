<html>
    <head>
        <title>This is my page!</title>  
        <!-- Import Libraries Dynamically so as to change in only one spot... -->
        <?php require_once('/view/views/includes.html'); ?>
    </head>
    
    <body>
        <?php require_once('/view/views/navbar_component.php'); ?>
        
        <div class="content">
            <div class="jumbotron">
                <h1>Welcome to our site!</h1>
            </div>
        </div>
    </body>
    
</html>