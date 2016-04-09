<?php
    function getLine($file)
    {
        // trim removes any white space at beginning and end of lines
        return trim(fgets($file));
    }

    $filename = ".credentials";
    $file = fopen($filename, "r") or die("Unable to open file.");

    $hostname = getLine($file);
    $username = getLine($file);
    $password = getLine($file);
    $db = "gamer-net";

    fclose($file);

    $conn = new mysqli($hostname, $username, $password, $db);

    if ($conn->connect_error)
    {
        die("Connection failed: " . $conn->connect_error);
    }
    echo "Connected successfully to database.";
?>