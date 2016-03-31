<?php $data = "name"; ?>

<html>

    <head>
        <title>This is my page!</title>
    </head>
    
    <body>
        <?php echo("$data"); ?>
        
        <form action="." method="POST">
            <input type="text" name="name" />
            <button type="submit" name="module" value="print">Print Name!</button>
        </form>
    </body>
</html>