<?php
    require_once(__DIR__ . "/DBConnection.php");

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
        //create user object by querying database with $uid
        public static function loadByID($uid)
        {
            if (isset($uid))
            { 
                $database = new DBConnection();
                $mysqli = $database->conn;
            
                $uname = $mysqli->real_escape_string(strip_tags($uname, ENT_QUOTES));
                $pass = $mysqli->real_escape_string(strip_tags($pass, ENT_QUOTES));
            
                $query = file_get_contents(__DIR__ . "/dml/user/getUserByID.sql");
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
        
        
        
        /* this function is primarily for checking to see which user attributes
        were actually changed; an empty string indicates the attribute should not be changed;
        for example, if the user is just changing alias and
        nothing else, the function call for updateDatabase() would look like this:
        updateDatabase($newAlias, "", "", "", "");       
        
        NOTE: updateDatabase() could also be written more dynamically
        so that the function call has a dynamic number of parameters,
        kind of like printf() in C
        
        This function only does basic error checking, more in-depth error checking
        should be done for the settings page with ajax as the user types
        
        It's also important to note that salt and hash_pass aren't included
        in this function because salt and hash_pass aren't saved as user
        attributes in the User object, so it is VERY important
        that the salt and hash_pass are passed in correctly for when the user
        needs to change their password.
        */
        public function filterEmptyAttributes($alias, $gender, $age)
        {
            /*there's got to be a more dynamic way to do this since
            variable names are same as attribute names */
            if (!empty($alias))
            {
                echo $this->alias, " will be changed to ", $alias, "<br>";
                $this->alias = $alias;
            }
          
            if (is_numeric($gender))
                if ($gender == 0 || $gender == 1)
                {
                    echo "gender will be changed to ", ($gender ? "girl" : "boy"), "<br>"; 
                    $this->gender = $gender;
                }
            

            if (is_numeric($age))
            {
                /* this made me think, what is the minimum age user's can be?
This is a website for discussing with and or meeting up with people who play the same games so maybe it should only be for legal adults?

Should the age update dynamically as the years go by?
If yes then the user should just enter a birth date
                */
                if ($age >= 18) 
                {
                    echo "age will be changed to ", $age, "<br>";
                    $this->age = $age;
                }
                else
                    echo "age will NOT change, must be at least 18<br>";
            }
        }
        
        /*
After filtering the passed parameter variables, this function uses
the object's attribute values for the prepared statement.
This will be used for updating the user's settings in settings.php

This function is not responsible for changing user password;
see changePassword()
        */
        public function updateSettings($alias, $gender, $age)
        {
            $database = new DBConnection();
            $mysqli = $database->conn;
          //    echo "hello1";  
            
            $alias = self::filter($mysqli, $alias);
            $gender = self::filter($mysqli, $gender);
            $age = self::filter($mysqli, $age);
          //  echo "hello2";
            $this->filterEmptyAttributes($alias, $gender, $age);
           
           //     echo "hello3";
            $query = file_get_contents(__DIR__ . "/dml/user/update_user.sql");
    //        echo $query;
            if ($stmt = $mysqli->prepare($query))
            {
                //echo "hello";
                    //Get the stored salt and hash as $dbSalt and $dbHash
                $stmt->bind_param("siis", $this->alias, $this->gender, $this->age, $this->uid);
                if (!$stmt->execute())
                    echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
                else
                {
                                        //  echo "hello2";
                    $stmt->store_result();

            
                    $stmt->close(); // close prepare statement
                    $database->close(); // close database connection
                
                    return true; // update was successful
                }
            }
            
            return false; // update was unsuccessful
        }
        
        public function setPass($newPass)
        {
            $database = new DBConnection();
            $mysqli = $database->conn;
                    
            $query = file_get_contents(__DIR__ . "/dml/user/setPass.sql");
            
            if ($stmt = $mysqli->prepare($query))
            {
                mt_srand();
                $salt = mt_rand();
                $hash_pass = generateHash($salt . $newPass);
                $stmt->bind_param("isi", $salt, $hash_pass, $this->uid);
                if (!$stmt->execute())
                    echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
                
                $stmt->close(); // close prepare statement
                $database->close(); // close database connection
                
                return true;
            }
            $database->close();
            return false;
        }
        
        // function will be used when user want's to change password
        public function getPass()
        {
            $database = new DBConnection();
            $mysqli = $database->conn;
                    
            $saltAndHash;    
            $query = file_get_contents(__DIR__ . "/dml/user/getPass.sql");
            
            if ($stmt = $mysqli->prepare($query))
            {
                $stmt->bind_param("i", $this->uid);
                if (!$stmt->execute())
                    echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
            
                //  echo "hello2";
                $stmt->store_result();
                $stmt->bind_result($salt, $hash_pass);
                $stmt->fetch();
                
                $saltAndHash[] = $salt;
                $saltAndHash[] = $hash_pass;
            }
            $stmt->close(); // close prepare statement
            $database->close(); // close database connection
            
            return $saltAndHash;
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
        
        public function setOnlineStatus($status)
        {
           
            if (is_numeric($status))
            {
                $database = new DBConnection();
                $mysqli = $database->conn;
                if ($status != 0 && $status != 1) // error handle for wrong input
                    return;
                
                
                    
                
                $query = file_get_contents(__DIR__ . "/dml/user/setOnlineStatus.sql");
                
                if ($stmt = $mysqli->prepare($query))
                {
                    $stmt->bind_param("ii", $status, $this->uid);
                    if (!$stmt->execute())
                        echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
            
                    //  echo "hello2";
                    $stmt->store_result(); 
                }
                $stmt->close(); // close prepare statement
                $database->close(); // close database connection
                
            }
            
        }
        
        public function getOnlineStatus()
        {
            $database = new DBConnection();
            $mysqli = $database->conn;
            
            //    echo "hello";
            $query = file_get_contents(__DIR__ . "/dml/user/getOnlineStatus.sql");
            if ($stmt = $mysqli->prepare($query))
            {
                //echo "hello";
                    //Get the stored salt and hash as $dbSalt and $dbHash
                $stmt->bind_param("i", $this->uid);
                if (!$stmt->execute())
                    echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
            
                    //  echo "hello2";
                $stmt->store_result();
                
                $stmt->bind_result($availability);
                
                if ($stmt->fetch())
                {
                    if ($availability == 0)
                        echo $this->username, " is currently offline", "<br>";
                    else if ($availability == 1)
                        echo $this->username, " is currently online", "<br>";
                }
            
                $stmt->close(); // close prepare statement
                $database->close(); // close database connection
            }
        }
        
        public function getFriends()
        {
            $database = new DBConnection();
            $mysqli = $database->conn;
            
            //    echo "hello";
            $query = file_get_contents(__DIR__ . "/dml/relationship/list_friends.sql");
            if ($stmt = $mysqli->prepare($query))
            {
                //echo "hello";
                    //Get the stored salt and hash as $dbSalt and $dbHash
                $stmt->bind_param("i", $this->uid);
                if (!$stmt->execute())
                    echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
            
                    //  echo "hello2";
                $stmt->store_result();
                
                $stmt->bind_result($fid, $friend, $type);
                
                while ($stmt->fetch())
                {
                    if ($type == 2)
                        echo $friend, " is currently a friend", "<br>";
                    else if ($type == 0)
                        echo $friend, " is pending friend request", "<br>";
                    else if ($type == 1)
                        echo $friend, " wants to be your friend", "<br>";
                }
            
                $stmt->close(); // close prepare statement
                $database->close(); // close database connection
            }
        }
        
        /* returns an array of contact info where the platform is the key
        and the username is the value
        
        if user has no contact info, returns an empty array
        */
        public function getContactInfo()
        {
            $contactInfo = array();
            
            $database = new DBConnection();
            $mysqli = $database->conn;
            
            //    echo "hello";
            $query = file_get_contents(__DIR__ . "/dml/contactInfo/getContactInfo.sql");
            if ($stmt = $mysqli->prepare($query))
            {
                $stmt->bind_param("i", $this->uid);
                if (!$stmt->execute())
                    echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
            
                $stmt->store_result();
                
                if ($stmt->num_rows != 0)
                {
                    $stmt->bind_result($contact_id, $platform, $username);
                
                    
                
                    while ($stmt->fetch())
                    {
                        $info[0] = $platform;
                        $info[1] = $username;
                        $contactInfo[$contact_id] = $info;
                    }
                }
                

            
                $stmt->close(); // close prepare statement
                $database->close(); // close database connection
            }
            return $contactInfo;   
        }
        public function addContactInfo($platform, $username)
        {
            $database = new DBConnection();
            $mysqli = $database->conn;
                    
            $query = file_get_contents(__DIR__ . "/dml/contactInfo/addContactInfo.sql");
            
            if ($stmt = $mysqli->prepare($query))
            {
                $stmt->bind_param("iss", $this->uid, $platform, $username);
                if (!$stmt->execute())
                    echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
                
                $stmt->close(); // close prepare statement
                $database->close(); // close database connection
                
                return true;
            }
            $database->close();
            return false;
        }
        public function updateContactInfo($contact_id, $platform, $username)
        {
            $database = new DBConnection();
            $mysqli = $database->conn;
                    
            $query = file_get_contents(__DIR__ . "/dml/contactInfo/updateContactInfo.sql");
            
            if ($stmt = $mysqli->prepare($query))
            {
                $stmt->bind_param("ssi", $platform, $username, $contact_id);
                if (!$stmt->execute())
                    echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
                
                $stmt->close(); // close prepare statement
                $database->close(); // close database connection
                
                return true;
            }
            $database->close();
            return false;
        }
        public function deleteContactInfo($contact_id)
        {
            $database = new DBConnection();
            $mysqli = $database->conn;
                    
            $query = file_get_contents(__DIR__ . "/dml/contactInfo/deleteContactInfo.sql");
            
            if ($stmt = $mysqli->prepare($query))
            {
                $stmt->bind_param("i", $contact_id);
                if (!$stmt->execute())
                    echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
                
                $stmt->close(); // close prepare statement
                $database->close(); // close database connection
                
                return true;
            }
            $database->close();
            return false;
        }
    }
?>
