<?php
    require_once("DBConnection.php");

    class User
    {
        private $uid;
        private $username;
        private $email;
        private $alias;
        private $gender;
        private $age;
        private $is_admin;

        public function __construct($uid, $username, $email, $alias, $gender, $age, $is_admin)
        {
            $this->uid = $uid;
            $this->username = $username;
            $this->email = $email;
            $this->alias = $alias;
            $this->gender = $gender;
            $this->age = $age;
            $this->is_admin = $is_admin;
        }
        //create user object by querying database with $_SESSION['user']
        public static function loadByID($uid)
        {
            if (isset($uid))
            { 
                $database = new DBConnection();
                $mysqli = $database->conn;
            
                $uname = $mysqli->real_escape_string(strip_tags($uname, ENT_QUOTES));
                $pass = $mysqli->real_escape_string(strip_tags($pass, ENT_QUOTES));
            
                $query = file_get_contents("model/dml/user/getUser.sql");
               // echo $query;
                if ($stmt = $mysqli->prepare($query))
                {
                    //echo "hello";
                    //Get the stored salt and hash as $dbSalt and $dbHash
                    $stmt->bind_param("i", $uid);
                    if (!$stmt->execute())
                        echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
            
                    //  echo "hello2";
                    $stmt->store_result();
                    //  echo "hello3";
                    $stmt->bind_result($username, $email, $alias, $gender, $age, $availability, $is_admin);
            
                    //   echo "hello4";
            
                    $stmt->fetch();
            
                    //    echo "<br><p>uname= " . $uname . "</p>";
       //     echo "<br><p>username=" .  $username ."</p>";
       //     echo "<br><p>email=" .  $email ."</p>";
            
                    $stmt->close(); // close prepare statement
                    $database->close(); // close database connection
                    
                    
                    return new self($uid, $username, $email, $alias, $gender, $age, $availability, $is_admin);
                }
                
                return NULL;
            }
        }
        
        public static function filter($mysqli, $string)
        {
            return $mysqli->real_escape_string(strip_tags($string, ENT_QUOTES));
        }
        
        public function updateDatabase($alias, $salt, $hash_pass, $gender, $age)
        {

                $database = new DBConnection();
                $mysqli = $database->conn;
                
            
                $alias = filter($mysqli, $alias);
                $salt = filter($mysqli, $salt);
                $hash_pass = filter($mysqli, $hash_pass);
                $gender = filter($mysqli, $gender);
                $age = filter($mysqli, $age);
            
            //    echo "hello";
                $query = file_get_contents("model/dml/user/update_user.sql");
                if ($stmt = $mysqli->prepare($query))
                {
                    //echo "hello";
                    //Get the stored salt and hash as $dbSalt and $dbHash
                    $stmt->bind_param("sisii", $alias, $salt, $hash_pass, $gender, $age);
                    if (!$stmt->execute())
                        echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
            
                    //  echo "hello2";
                    $stmt->store_result();

            
                    $stmt->close(); // close prepare statement
                    $database->close(); // close database connection
                    
                    

                    $this->alias = $alias;
                    $this->gender = $gender;
                    $this->age = $age;
            }
            
        }
        public function getUID()
        {
            return $this->uid;
        }
        public function getUsername()
        {
            return $this->username;
        }
        public function getEmail()
        {
            return $this->email;
        }
        public function getAlias()
        {
            return $this->alias;
        }
        public function getGender()
        {
            return $this->gender;
        }
        public function getAge()
        {
            return $this->age;
        }
        public function isAdmin()
        {
            return $this->is_admin;
        }
    }

    
?>
