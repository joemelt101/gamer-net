<?php
    class dbConnection
    {
        private $hostname;
        private $username;
        private $password;
        private $dbname;
        private $conn;
        
        public static function getLine($file)
        {
            // trim removes any white space at beginning and end of lines
            return trim(fgets($file));
        }
        public function start()
        {
            $filename = ".credentials";
            $file = fopen($filename, "r") or die("Unable to open file.");
            
            $this->hostname = self::getLine($file);
            $this->username = self::getLine($file);
            $this->password = self::getLine($file);
            $this->dbname = "gamer-net";
            
            fclose($file);
            
            $host = $this->hostname;
            $user = $this->username;
            $pass = $this->password;
            $dbname = $this->dbname;

            $this->conn = new mysqli($host, $user, $pass, $dbname);
            if ($this->conn->connect_error)
                die("Connection failed: " . $this->conn->connect_error);
        
            echo "Connected successfully to database.";
            
        }
        public function stop()
        {
            if (isset($this->conn))
            {
                mysqli_close($this->conn);
                echo "Database connection closed.";
            }
        }
        
    }
    $database = new dbConnection();
    $database->start();
    $database->stop();
?>