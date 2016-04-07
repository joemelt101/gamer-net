 <html>
    <head>
        <title>This is my page!</title>  
        <!-- Import Libraries Dynamically so as to change in only one spot... -->
        <?php require_once('view/views/includes.html'); ?>
    </head>
    
    <body>
        <?php require_once('view/views/navbar_component.php'); ?>
        
        
        <div class="panel container-fixed container">
            <div class="panel-heading">
                <h1>Search</h1>
                <p>Enter the information that describes those you're interested in!</p>
            </div>
            
            <div class="input-group">
              <input type="radio" class="form-control" placeholder="Username">
            </div>
        </div>
    </body>
    
     <script>
        
     </script>
</html>