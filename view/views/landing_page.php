<html>
    <head>
        <title>This is my page!</title>  
        <!-- Import Libraries Dynamically so as to change in only one spot... -->
        <?php require_once('/view/views/includes.php'); ?>
    </head>
    
    <body>
        <?php require_once('/view/views/navbar_component.php'); ?>
        
        
        <div class="panel panel-success container-fixed container">
            <div class="jumbotron">
                <h1>First Component</h1>
                <p>This spans the width of the entire page of content! Blah, blah, blah, blah, blah, blah, blah, blah, blah, blah, blah.</p>
            </div>
            
            <div class="row">
                <div class="col-xs-6">
                    <h1>Second Component</h1>
                    <p>This spans the left column only. See how components can be side by side by Bootstrap's row settings?</p>
                </div>
                <div class="col-xs-6">
                        <a href="#" class="thumbnail">
                            <img src="/gamer-net/view/images/thumbnail.svg">
                        </a>
                </div>
            </div>
            
            <div>
                <h3>Third Component Can Go Here</h3>
            </div>
        </div>
        
    </body>
    
</html>