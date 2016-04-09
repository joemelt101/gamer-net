<?php
	require "dbConnection.php";
    

    class user
    {
        public static $db;
        
        public function __construct()
        {
            self::$db = new dbConnection();
        }
        public function getAll()
        {
            if (self::$db->connected())
            {
                $query = "SELECT username, alias FROM user ORDER BY alias";
                if ($stmt = self::$db->conn->prepare($query))
                {
                    $stmt->execute();
                    $stmt->bind_result($username, $alias);
                    while ($stmt->fetch())
                    {
                        echo $username, "::", $alias;
                    }
                    
                }
                else
                    echo "bad2";
            }
            else
                echo "bad3";
        }
    }

    $u = new user();
    $u->getAll();



    user::$db->close();
?>
