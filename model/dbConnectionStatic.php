<?php
    class dbConnection
    {
        private static $hostname;
        private static $username;
        private static $password;
        private static $dbname;
        private static $conn;
        
        // this is a static class, this will prevent trying to create any objects
        private function __construct() {}
        
        public static function getLine($file)
        {
            // trim removes any white space at beginning and end of lines
            return trim(fgets($file));
        }
        public static function open()
        {
            $filename = ".credentials";
            $file = fopen($filename, "r") or die("Unable to open file.");
            
            self::$hostname = self::getLine($file);
            self::$username = self::getLine($file);
            self::$password = self::getLine($file);
            self::$dbname = "gamer-net";
            
            fclose($file);
            
            $host = self::$hostname;
            $user = self::$username;
            $pass = self::$password;
            $dbname = self::$dbname;

            self::$conn = new mysqli($host, $user, $pass, $dbname);
            if (self::$conn->connect_error)
                die("Connection failed: " . self::$conn->connect_error);
        
            echo "Connected successfully to database.";
            return self::$conn;
        }
        public static function isConnected()
        {
            return isset(self::$conn);
        }
        public static function close()
        {
            if (self::isConnected())
            {
                mysqli_close(self::$conn);
                echo "Database connection closed.";
            }
        }
        
    }
    $conn = dbConnection::open();
    dbConnection::close();
?>