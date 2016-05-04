<?php
    class DBConnection
    {
        private $hostname;
        private $username;
        private $password;
        private $dbname;
        public $conn;// kept public so easy to do sql statements and check db connection
        
        public static function getLine($file)
        {
            // trim removes any white space at beginning and end of lines
            return trim(fgets($file));
        }
        public function __construct()
        {
            $filename = "/var/www/.credentials";
            $file = fopen($filename, "r") or die("Unable to open file.");
            
            $this->hostname = self::getLine($file);
            $this->username = self::getLine($file);
            $this->password = self::getLine($file);
            $this->dbname = self::getLine($file);
            
            fclose($file);
            
            $host = $this->hostname;
            $user = $this->username;
            $pass = $this->password;
            $dbname = $this->dbname;

            $this->conn = new mysqli($host, $user, $pass, $dbname);
            if ($this->conn->connect_error)
                die("Connection failed: " . $this->conn->connect_error);
        
           // echo "Connected successfully to database.";
            
        }
        public function connected()
        {
            return isset($this->conn);
        }
        
        public function close()
        {
            if (isset($this->conn))
            {
                mysqli_close($this->conn);
             //   echo "Database connection closed.";
            }
        }
    }
    function stmt_bind_assoc(&$stmt, &$out) // dynamic way for binding all return variables
    {
	   $data = mysqli_stmt_result_metadata($stmt);
	   $fields = array();
	   $out = array();
	   $fields[0] = $stmt;
	   for ($i = 1; $field = mysqli_fetch_field($data); $i++)
	   {
		  $fields[$i] = &$out[$field->name];
	   }
	   call_user_func_array('mysqli_stmt_bind_result', $fields);
    }
?>
