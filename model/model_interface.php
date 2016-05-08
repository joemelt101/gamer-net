<?php
    require_once(__DIR__ . "/DBConnection.php");
    class Location
    {
        private $uid;
        private $city;
        private $state;
        private $zip_code;
        
        public function __construct($uid, $city, $state, $zip_code)
        {
            $this->uid = $uid;
            $this->city = $city;
            $this->state = $state;
            $this->zip_code = $zip_code;
        }
        public function getUser()
        {
            return User::loadByID($this->uid);
        }
        public function getCity()
        {
            return $this->city;
        }
        public function getState()
        {
            return $this->state;
        }
        public function getZip()
        {
            return $this->zip_code;
        }
        public static function loadByID($uid)
        {
            if (isset($uid))
            { 
                $database = new DBConnection();
                $mysqli = $database->conn;
            
                $query = file_get_contents(__DIR__ . "/dml/location/get_location.sql");
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
                    $stmt->bind_result($city, $state, $zip_code);
            
                    //   echo "hello4";
            
                    $stmt->fetch();
            
                    $stmt->close(); // close prepare statement
                    $database->close(); // close database connection
                    
                    
                    return new self($uid, $city, $state, $zip_code);
                }
            }
            return NULL;
        }
        public static function searchLocation($location)
        {
            $database = new DBConnection();
            $mysqli = $database->conn;
            
            //    echo "hello";
            $query = file_get_contents(__DIR__ . "/dml/location/search_for_locations.sql");
            if ($stmt = $mysqli->prepare($query))
            {
                $cityOrStateSearch = '%' . $location . '%';
                $zipSearch = $location . '%';
                $stmt->bind_param("sss", $cityOrStateSearch, $cityOrStateSearch, $zipSearch);
                if (!$stmt->execute())
                    echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
            
                    //  echo "hello2";
                $stmt->store_result();
                
                $stmt->bind_result($user_id, $city, $state, $zip_code);
                
                $locations = NULL;
                while ($stmt->fetch())
                {
                    $locations[] = new self($user_id, $city, $state, $zip_code);
                }
            
                $stmt->close(); // close prepare statement
                $database->close(); // close database connection
                return $locations;
            }
            
            return NULL;
        }
    }

    class Game
    {
        private $gid;
        private $name;
        private $developer;
        private $platform;
        private $genre;
        private $year;
        private $type;
        private $description;
        private $videoID;
        
        public function __construct($gid, $name, $developer, $platform, $genre, $year, $type, $description, $videoID)
        {
            $this->gid = $gid;
            $this->name = $name;
            $this->developer = $developer;
            $this->platform = $platform;
            $this->genre = $genre;
            $this->year = $year;
            $this->type = $type;
            $this->description = $description;
            $this->videoID = $videoID;
        }
        /*
        adds a "new" game to the database
        */
        public static function addGame($name, $developer, $platform, $genre, $year, $type, $description, $videoID)
        {
            $database = new DBConnection();
            $mysqli = $database->conn;
            
            $queries = explode(";", file_get_contents(__DIR__ . "/dml/game/add_game.sql"));
               // echo $query;
            if ($stmt = $mysqli->prepare($queries[0]))
            {
               // echo $queries[0];
                $stmt->bind_param("ssssii", $name, $developer, $platform, $genre, $year, $type);
                if (!$stmt->execute())
                    echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
            
                $stmt->store_result();
                $stmt->bind_result($game_id);
                $stmt->fetch();
                
                    //  echo "hello3";
            
                    //   echo "hello4";
                if ($stmt->num_rows < 1)
                {
                    $stmt->close();
                    if ($stmt = $mysqli->prepare($queries[1]))
                    {
                        echo $queries[1];
                        $stmt->bind_param("ssssiiss", $name, $developer, $platform, $genre,     $year, $type, $description, $videoID);
                        if (!$stmt->execute())
                            echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
            
                    //  echo "hello2";
                        $stmt->store_result();
                    //  echo "hello3";
            
                    //   echo "hello4";
            
                        $stmt->close(); // close prepare statement
                        $database->close(); // close database connection
                        return true;
                    }
                }
            }
            $database->close();
            
            return false;
        }
        /*
        used to create game objects from the game_ids located in the user's game list
        */
        public static function loadByID($gid)
        {
            if (isset($gid))
            { 
                $database = new DBConnection();
                $mysqli = $database->conn;
            
                $query = file_get_contents(__DIR__ . "/dml/game/getGameByID.sql");
               // echo $query;
                if ($stmt = $mysqli->prepare($query))
                {
                    //echo "hello";
                    //Get the stored salt and hash as $dbSalt and $dbHash
                    $stmt->bind_param("i", $gid);
                    if (!$stmt->execute())
                        echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
            
                    //  echo "hello2";
                    $stmt->store_result();
                    //  echo "hello3";
                    $stmt->bind_result($game_id, $name, $developer, $platform, $genre, $year, $type, $description, $videoID);
            
                    //   echo "hello4";
            
                    $stmt->fetch();
                    
                    if ($stmt->num_rows == 0)
                    {
                        $stmt->close();
                        $database->close();
                        return NULL;
                    }
            
                    $stmt->close(); // close prepare statement
                    $database->close(); // close database connection
                    
                    
                    
                    return new self($game_id, $name, $developer, $platform, $genre, $year, $type, $description, $videoID);
                }
            }
            return NULL;
        }
        public static function getGames()
        {
                $database = new DBConnection();
                $mysqli = $database->conn;
            
                $query = file_get_contents(__DIR__ . "/dml/game/list_games.sql");
               // echo $query;
                if ($stmt = $mysqli->prepare($query))
                {
                    //echo "hello";
                    //Get the stored salt and hash as $dbSalt and $dbHash
                    if (!$stmt->execute())
                        echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
            
                    //  echo "hello2";
                    $stmt->store_result();
                    //  echo "hello3";
                    $stmt->bind_result($game_id, $name, $developer, $platform, $genre, $year, $type, $description);
            
                    //   echo "hello4";
            
                    $games = NULL;
                    while ($stmt->fetch())
                    {
                        $games[] = new self($game_id, $name, $developer, $platform, $genre, $year, $type, $description);
                    }
            
                    $stmt->close(); // close prepare statement
                    $database->close(); // close database connection
                    
                    
                    return $games;
                }
            return NULL;
        }

        /* returns a game id of a specific game, to be used after a user creates a new game to add it to their list */
        public static function getGameIdForUser($name, $developer, $platform, $year, $type)
        {
            $database = new DBConnection();
            $mysqli = $database->conn;

            //echo "hello";
            $query = file_get_contents(__DIR__ . "/dml/game/getGame.sql");
            //echo $query;
            if ($stmt = $mysqli->prepare($query))
            {
                $stmt->bind_param("sssii", $name, $developer, $platform, $year, $type);
                if (!$stmt->execute())
                    echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;

                //echo "hello2";
                $stmt->store_result();

                $stmt->bind_result($gid);

                $stmt->fetch();
                //echo $gid;
                $stmt->close(); // close prepare statement
                $database->close(); // close database connection
                return $gid;
            }

            return NULL;
        }
        /* gets users "playing" this game */
        public function getUsersPlaying()
        {
            $database = new DBConnection();
            $mysqli = $database->conn;

            //echo "hello";
            $query = file_get_contents(__DIR__ . "/dml/user_games/getUsersPlaying.sql");
            //echo $query;
            if ($stmt = $mysqli->prepare($query))
            {
                $stmt->bind_param("i", $this->getGID());
                if (!$stmt->execute())
                    echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;

                //echo "hello2";
                $stmt->store_result();

                $stmt->bind_result($uid);
                
                $users;
                while ($stmt->fetch())
                {
                    $users[] = User::loadByID($uid);
                }

                $stmt->close(); // close prepare statement
                $database->close(); // close database connection
                return $users;
            }

            return NULL;
        }
        public static function searchGame($game)
        {
            $database = new DBConnection();
            $mysqli = $database->conn;
            
            //    echo "hello";
            $query = file_get_contents(__DIR__ . "/dml/game/search_for_games.sql");
            if ($stmt = $mysqli->prepare($query))
            {
                $gameSearch = '%' . $game . '%';
                $developerSearch = $game . '%';
                $stmt->bind_param("ss", $gameSearch, $developerSearch);
                if (!$stmt->execute())
                    echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
            
                    //  echo "hello2";
                $stmt->store_result();
                
                $stmt->bind_result($game_id, $name, $developer, $platform, $genre, $year, $type, $description, $videoID);
                
                $games = NULL;
                while ($stmt->fetch())
                {
                    $games[] = new self($game_id, $name, $developer, $platform, $genre, $year, $type, $description, $videoID);
                }
            
                $stmt->close(); // close prepare statement
                $database->close(); // close database connection
                return $games;
            }
            
            return NULL;
        }
        
        public function getGID()
        {
            return $this->gid;
        }
        public function getName()
        {
            return $this->name;
        }
        public function getDeveloper()
        {
            return $this->developer;
        }
        public function getPlatform()
        {
            return $this->platform;
        }
        public function getGenre()
        {
            return $this->genre;
        }
        public function getYear()
        {
            return $this->year;
        }
        public function getType()
        {
            return $this->type;
        }
        public function getDescription()
        {
            return $this->description;
        }
        public function getVideoID()
        {
            return $this->videoID;
        }
    }

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
        public static function loadByUsername($username)
        {
            if (isset($username))
            { 
                $database = new DBConnection();
                $mysqli = $database->conn;
            
                $uname = $mysqli->real_escape_string(strip_tags($uname, ENT_QUOTES));
                $pass = $mysqli->real_escape_string(strip_tags($pass, ENT_QUOTES));
            
                $query = file_get_contents(__DIR__ . "/dml/user/getUserByUsername.sql");
               // echo $query;
                if ($stmt = $mysqli->prepare($query))
                {
                    //echo "hello";
                    //Get the stored salt and hash as $dbSalt and $dbHash
                    $stmt->bind_param("s", $username);
                    if (!$stmt->execute())
                        echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
            
                    //  echo "hello2";
                    $stmt->store_result();
                    //  echo "hello3";
                    $stmt->bind_result($user_id, $email, $alias, $gender, $age, $availability, $is_admin);
            
                    //   echo "hello4";
            
                    if (!$stmt->fetch())
                        return NULL;
            
                    //    echo "<br><p>uname= " . $uname . "</p>";
       //     echo "<br><p>username=" .  $username ."</p>";
       //     echo "<br><p>email=" .  $email ."</p>";
            
                    $stmt->close(); // close prepare statement
                    $database->close(); // close database connection
                    
                    
                    return new self($user_id, $username, $email, $alias, $gender, $age, $availability, $is_admin);
                }
                
                return NULL;
            }
        }
        //create user object by querying database with $uid
        public static function loadByID($uid)
        {
            if (isset($uid))
            { 
                $database = new DBConnection();
                $mysqli = $database->conn;
            
                $uname = self::filter($mysqli, $uname);
                $pass = self::filter($mysqli, $pass);
            
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
            
                    if (!$stmt->fetch())
                        return NULL;
            
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
            if (!isset($mysqli))
            {
                $database = new DBConnection();
                $mysqli = $database->conn;
            }
            return $mysqli->real_escape_string(strip_tags($string, ENT_QUOTES));
        }
        
        
        
        /*
This function is not responsible for changing user password;
see setPass()
        */
        public function updateSettings($alias, $email, $age, $gender, $about, $city, $state, $zipcode)
        {
            $database = new DBConnection();
            $mysqli = $database->conn;
          //    echo "hello1";  
            
            
            /* should clean this up by possibly passing in an array into updateSettings() and then just calling filter function in a for loop */
            $alias = self::filter($mysqli, $alias);
            $email = self::filter($mysqli, $email);
            $age = self::filter($mysqli, $age);
            $gender = self::filter($mysqli, $gender);
            $city = self::filter($mysqli, $city);
            $state = self::filter($mysqli, $state);
            $zipcode = self::filter($mysqli, $zipcode);
           
           //     echo "hello3";
            $queries = explode(";", file_get_contents(__DIR__ . "/dml/user/update_user.sql"));
    //        echo $query;
            if ($stmt = $mysqli->prepare($queries[0]))
            {
                //echo "hello";
                    //Get the stored salt and hash as $dbSalt and $dbHash
                $stmt->bind_param("ssiisi", $alias, $email, $age, $gender, $about, $this->uid);
                if (!$stmt->execute())
                    echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
                else
                {
                                        //  echo "hello2";
                    $stmt->store_result();

            
                    $stmt->close(); // close prepare statement
                    if ($stmt = $mysqli->prepare($queries[1]))
                    {
                        $stmt->bind_param("ssii", $city, $state, $zipcode, $this->uid);
                        if (!$stmt->execute())
                        {
                            $stmt->close();
                            $database->close();
                            return false;
                        }
                    }
                    else
                    {
                        $database->close();
                        return false;
                    }
                    $database->close(); // close database connection
                
                    return true; // update was successful
                }
            }
            
            return false; // update was unsuccessful
        }
        
        /* this function assumes the password has already been filtered for dangerous
        characters (single quotes, etc.) */
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
                
                $stmt->fetch();
                $stmt->close(); // close prepare statement
                $database->close(); // close database connection
            }
            
            return $availability;
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
        public function getAbout()
        {
            $database = new DBConnection();
            $mysqli = $database->conn;
            
            //    echo "hello";
            $query = file_get_contents(__DIR__ . "/dml/user/getAbout.sql");
            if ($stmt = $mysqli->prepare($query))
            {
                    //Get the stored salt and hash as $dbSalt and $dbHash
                $stmt->bind_param("i", $this->uid);
                if (!$stmt->execute())
                    echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
            
                 
                $stmt->store_result();
                
                $stmt->bind_result($about);
            
                
                $stmt->fetch();
                
                $stmt->close(); // close prepare statement
                $database->close(); // close database connection
                return $about;
            }
        }
        public function setAbout($about)
        {
            $database = new DBConnection();
            $mysqli = $database->conn;    
            $query = file_get_contents(__DIR__ . "/dml/user/setAbout.sql");
            
            if ($stmt = $mysqli->prepare($query))
            {
                $stmt->bind_param("si", $about, $this->uid);
                if (!$stmt->execute())
                    echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
       //         $stmt->store_result();
      //          $stmt->fetch();
                $stmt->close(); // close prepare statement
                $database->close(); // close database connection
                
                return true;
            }
            $database->close();
            
            return false;
        }
        public function getLocation()
        {
            $database = new DBConnection();
            $mysqli = $database->conn;
            
            //    echo "hello";
            $query = file_get_contents(__DIR__ . "/dml/location/get_location.sql");
            if ($stmt = $mysqli->prepare($query))
            {
                    //Get the stored salt and hash as $dbSalt and $dbHash
                $stmt->bind_param("i", $this->uid);
                if (!$stmt->execute())
                    echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
            
                 
                $stmt->store_result();
                
                $stmt->bind_result($city, $state, $zip_code);
            
                
                $stmt->fetch();
                $location = array();
                $location[0] = $city;
                $location[1] = $state;
             //   echo $zip_code;
                $location[2] = $zip_code;
               // echo $location[2];
                $stmt->close(); // close prepare statement
                $database->close(); // close database connection
                return $location;
            }
        }
        public function setLocation($city, $state, $zip_code)
        {
        //    echo "model: " . $zip_code . "<br>";
            $database = new DBConnection();
            $mysqli = $database->conn;    
            $query = file_get_contents(__DIR__ . "/dml/location/update_location.sql");
            if ($stmt = $mysqli->prepare($query))
            {
            //    echo $zip_code;
                $stmt->bind_param("ssii", $city, $state, $zip_code, $this->uid);
                if (!$stmt->execute())
                    echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
      //          $stmt->store_result();

      //          $stmt->fetch();
                $stmt->close(); // close prepare statement
                $database->close(); // close database connection
                
                return true;
            }
            $database->close();
            
            return false;
        }
        public function addLocation($city, $state, $zip_code)
        {
            $database = new DBConnection();
            $mysqli = $database->conn;    
            $query = file_get_contents(__DIR__ . "/dml/location/add_location.sql");
            if ($stmt = $mysqli->prepare($query))
            {
                $stmt->bind_param("issi", $this->uid, $city, $state, $zip_code);
                if (!$stmt->execute())
                    echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
      //          $stmt->store_result();
      //          $stmt->fetch();
                $stmt->close(); // close prepare statement
                $database->close(); // close database connection
                
                return true;
            }
            $database->close();
            
            return false;
        }
        public function getFriend($fid)
        {
            $database = new DBConnection();
            $mysqli = $database->conn;
            
            //    echo "hello";
            $query = file_get_contents(__DIR__ . "/dml/relationship/getFriend.sql");
          //  echo $query;
            if ($stmt = $mysqli->prepare($query))
            {
                $stmt->bind_param("ii", $this->uid, $fid);
                if (!$stmt->execute())
                    echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
            
                    //  echo "hello2";
                $stmt->store_result();
                
                $stmt->bind_result($type);
                
                if (!$stmt->fetch())
                    return -1;
            
                $stmt->close(); // close prepare statement
                $database->close(); // close database connection
                return $type;
            }
            return -1;
        }
        /*
        this function will return an array of friendids and their type,
        the order will be by their alias (but alias will not be included)
        */
        public function getFriends()
        {
            $friends = NULL;
            $database = new DBConnection();
            $mysqli = $database->conn;
            
            //    echo "hello";
            $query = file_get_contents(__DIR__ . "/dml/relationship/list_friends.sql");
            if ($stmt = $mysqli->prepare($query))
            {
                $stmt->bind_param("i", $this->uid);
                if (!$stmt->execute())
                    echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
            
                    //  echo "hello2";
                $stmt->store_result();
                
                $stmt->bind_result($fid, $type);
                
                while ($stmt->fetch())
                {
                    $friends[$fid] = $type;
                }
            
                $stmt->close(); // close prepare statement
                $database->close(); // close database connection
            }
            return $friends;
        }
        /*
        handles all friend operations since all of them require the same parameters (user_id, friend_id) and because they are either update, insert, or delete queries, so the only difference is the query
        */
        public function doRelation($fid, $filename)
        {
            $database = new DBConnection();
            $mysqli = $database->conn;
            
            $queries = explode(";", file_get_contents(__DIR__ . "/dml/relationship/" . $filename));
            if ($stmt = $mysqli->prepare($queries[0]))
            {
                $stmt->bind_param("ii", $this->uid, $fid);
                if (!$stmt->execute())
                    echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
                $stmt->close(); // close prepare statement
                if ($stmt = $mysqli->prepare($queries[1]))
                {
                    $stmt->bind_param("ii", $fid, $this->uid);
                    if (!$stmt->execute())
                        echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
                    $stmt->close(); // close prepare statement
                    $database->close(); // close database connection
                
                    return true;
                }
            }

            $database->close();
            
            return false;
        }
            
        public function requestFriend($fid)
        {
            return $this->doRelation($fid, "friend_request.sql");
        }
        public function acceptFriend($fid)
        {
            return $this->doRelation($fid, "friend_accept.sql");
        }
        public function removeUser($fid)
        {
            return $this->doRelation($fid, "del_decline_unblock.sql");
        }
        public function block($fid)
        {
            // block current friend
            if (array_key_exists($fid, $this->getFriends()))
                $this->doRelation($fid, "block_friend.sql");
            else // block user that is not currently a friend
                $this->doRelation($fid, "block_user.sql");
        }
        public function doGameListOp($gid, $filename)
        {
            //echo 'hello';
            $database = new DBConnection();
            $mysqli = $database->conn;
            
            $query = file_get_contents(__DIR__ . "/dml/user_games/" . $filename);
            //echo $query;
            if ($stmt = $mysqli->prepare($query))
            {
                $stmt->bind_param("ii", $this->uid, $gid);
                if (!$stmt->execute())
                    echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;

                $stmt->close(); // close prepare statement
                $database->close(); // close database connection
                
                return true;
            }

            $database->close();
            
            return false;
        }
        public function addGame($gid)
        {
            return $this->doGameListOp($gid, "add_game_to_user's_games.sql");
        }
        public function removeGame($gid)
        {
            return $this->doGameListOp($gid, "del_game_from_user's_games.sql");
        }
        public function doesUserHaveGame($gid)
        {
            
            $database = new DBConnection();
            $mysqli = $database->conn;
            
            $userHasGame = false;

            $query = file_get_contents(__DIR__ . "/dml/user_games/search_user's_games.sql");
            if ($stmt = $mysqli->prepare($query))
            {
                //echo "hello";
                    //Get the stored salt and hash as $dbSalt and $dbHash
                $stmt->bind_param("ii", $this->uid, $gid);
                if (!$stmt->execute())
                    echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
            
                    //  echo "hello2";
                $stmt->store_result();
                
                $stmt->bind_result($game_id);
                
                $stmt->fetch();
                
                if ($stmt->num_rows > 0)
                    $userHasGame = true;
                
            }
            $stmt->close();
            $database->close();
            
            return $userHasGame;
        }
        public function getGames()
        {
            $database = new DBConnection();
            $mysqli = $database->conn;
            
            //    echo "hello";
            $query = file_get_contents(__DIR__ . "/dml/user_games/list_user's_games.sql");
            if ($stmt = $mysqli->prepare($query))
            {
                //echo "hello";
                    //Get the stored salt and hash as $dbSalt and $dbHash
                $stmt->bind_param("i", $this->uid);
                if (!$stmt->execute())
                    echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
            
                    //  echo "hello2";
                $stmt->store_result();
                
                $stmt->bind_result($game_id, $name, $developer, $platform, $genre, $year, $type, $description, $videoID);
                
                $games = NULL;
                while ($stmt->fetch())
                {
                  //  echo $name;
                    $games[] = new Game($game_id, $name, $developer, $platform, $genre, $year, $type, $description, $videoID);
                }
            
                $stmt->close(); // close prepare statement
                $database->close(); // close database connection
                return $games;
            }
            $database->close();
            return NULL;
        }
        public static function searchUser($username)
        {
            $database = new DBConnection();
            $mysqli = $database->conn;
            
            //    echo "hello";
            $query = file_get_contents(__DIR__ . "/dml/user/search_for_users.sql");
            if ($stmt = $mysqli->prepare($query))
            {
                //echo "hello";
                    //Get the stored salt and hash as $dbSalt and $dbHash
                $userSearch = '%' . $username . '%';
                $stmt->bind_param("ss", $userSearch, $userSearch);
                if (!$stmt->execute())
                    echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
            
                    //  echo "hello2";
                $stmt->store_result();
                
                $stmt->bind_result($uid, $username, $alias);
                
                $users = NULL;
                while ($stmt->fetch())
                {
                    $user = new stdClass();
                    $user->uid = $uid;
                    $user->username = $username;
                    $user->alias = $alias;
                    
                    $users[] = $user; // add user to users array
                }
            
                $stmt->close(); // close prepare statement
                $database->close(); // close database connection
                return $users;
            }
            
            return NULL;
        }
        /*
    If login is successful, returns a user object with all necessary attributes assigned.
    */
    public static function doLogin($uname, $pass)
    {
        $database = new DBConnection();
        $mysqli = $database->conn;
            
        $uname = $mysqli->real_escape_string(strip_tags($uname, ENT_QUOTES));
        $pass = $mysqli->real_escape_string(strip_tags($pass, ENT_QUOTES));
            
        //Test to see if their credentials are valid
        $query = file_get_contents(__DIR__ . "/dml/user/user_logs_on.sql");
        if ($stmt = $mysqli->prepare($query))
        {
            //echo "hello";
            //Get the stored salt and hash as $dbSalt and $dbHash
            $stmt->bind_param("ss", $uname, $uname);
            if (!$stmt->execute())
                echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
            
          //  echo "hello2";
            $stmt->store_result();
          //  echo "hello3";
            $stmt->bind_result($uid, $username, $email, $alias, $salt, $hash_pass, $gender, $age, $availability, $is_admin);
            
         //   echo "hello4";
            
            $stmt->fetch();
            
        //    echo "<br><p>uname= " . $uname . "</p>";
            
            
            
        
       //     echo "<br><p>username=" .  $username ."</p>";
       //     echo "<br><p>email=" .  $email ."</p>";
            
            $stmt->close(); // close prepare statement
            $database->close(); // close database connection
            
            
            
        
            //should never happen, but just in case
            if ($uname != $username && $uname != $email)
                return false;
            
        
            //Generate the local hash to compare against $dbHash
            $localhash = generateHash($salt . $pass);
            //Compare the local hash and the database hash to see if they're equal
            
            
            if ($localhash == $hash_pass)
            {
                $user = new User($uid, $username, $email, $alias, $gender, $age, $is_admin); 
            // password hashes matched, this is a valid user
                $user->setOnlineStatus(1);
                return $user;
            }
        }
        return false; // password hashes did not match or username didn't exist
    }
        public static function doRegister()
    {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $verifyEmail = $_POST['email2'];
        $pass = $_POST['pass'];
        $verifyPass = $_POST['pass2'];
        
        
        $message = "NULL";
        if (empty($username)) {
            $message = "Empty Username";
        } elseif (empty($pass) || empty($verifyPass)) {
            $message = "Empty Password";
        } elseif ($pass !== $verifyPass) {
            $message = "Password and password repeat are not the same";
        } elseif (strlen($pass) < 6) {
            $message = "Password has a minimum length of 6 characters";
        } elseif (strlen($username) > 20 || strlen($username) < 2) {
            $message = "Username cannot be shorter than 2 or longer than 20 characters";
        } elseif (!preg_match('/^[a-z\d]{2,20}$/i', $username)) {
            $message = "Username does not fit the name scheme: only a-Z and numbers are allowed, 2 to 20 characters";
        } elseif (empty($email) || empty($verifyEmail)) {
            $message = "Emails cannot be empty";
        } elseif ($email !== $verifyEmail) {
            $message = "Emails do not match";
        }
        elseif (strlen($email) > 64) {
            $message = "Email cannot be longer than 64 characters";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $message = "Your email address is not in a valid email format";
        } elseif (!empty($username)
            && strlen($username) <= 20
            && strlen($username) >= 2
            && preg_match('/^[a-z\d]{2,20}$/i', $username)
            && !empty($email)
            && strlen($email) <= 64
            && filter_var($email, FILTER_VALIDATE_EMAIL)
            && !empty($pass)
            && !empty($verifyPass)
            && ($pass === $verifyPass)
        ) {
            
            // starts a database connection
            $database = new DBConnection();
            $db = $database->conn;
            
            
            // change character set to utf8 and check it
            if (!$db->set_charset("utf8")) {
                $message = $db->error;
            }
            
             // change the input to utf8 and check the connection again
            // change the input to utf8 and check the connection again
            if (!$db->connect_errno) {
                
                // escaping, additionally removing everything that could be (html/javascript-) code
                // escaping allows us to prevent any input that could be potentially harmful
                // AKA javascript/HMTL/SQL injection
                $username = $db->real_escape_string(strip_tags($username, ENT_QUOTES));
                $email = $db->real_escape_string(strip_tags($email, ENT_QUOTES));
                
                
               
                // use PHP 5.5's function: password_hash in order to hash the user's password (60 char)
                mt_srand(); // seed random num generator
                $salt = mt_rand();
                
                $hash_pass = generateHash($salt . $pass);
                
                // check to make sure that the username and email address hasn't already been used
                $query = file_get_contents("model/dml/user/check_user_exists.sql");
                
                
                if ($stmt = $db->prepare($query))
                {
                    $stmt->bind_param("ss", $username, $email);
                    $stmt->execute();
                    $stmt->store_result();
                    if ($stmt->num_rows > 0)
                    {
                        $message = "Sorry, that username / email address is already taken.";
                        
                    }
                    else
                    {
                        $stmt->close();
                        $query = file_get_contents("model/dml/user/add_user.sql");
                        if ($stmt = $db->prepare($query))
                        {
                            $stmt->bind_param("sssis", $username, $email, $username, $salt, $hash_pass);
                            
                            if ($stmt->execute())
                                $message = "successful registration";
                            else
                                $message = "Sorry, registration failed. Try again.";
                        }
                    }
                    $stmt->close();
                    
                }
            } else {
                $message = "Sorry, no database connection.";
            }
        } else {
            $message = "An unknown error occurred.";
        }
        if (isset($database))
        {
            if ($database->connected())
                $database->close();
        }
        return $message;
    }
    }
?>
