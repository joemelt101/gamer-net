<?php
	require_once('controller/php_libs/session.php');
    require_once("model/DBConnection.php");
	require_once('model/model_interface.php');
    
    

    function generateHash($string)
    {
        for ($i = 0; $i < 50; $i++)
        {
            $string = hash('sha256', $string);
        }
        return $string;
    }
    function login($uname, $password)
    {
        $user = doLogin($uname, $password);
        if (!$user)
        {
            echo "<p>Username or password is invalid.</p>";
        }
        else
        {
            $_SESSION['user'] = $user->getUID();
            redirect("dashboard");
        }
    }

    /*
    If login is successful, returns a user object with all necessary attributes assigned.
    */
    function doLogin($uname, $pass)
    {
        $database = new DBConnection();
        $mysqli = $database->conn;
            
        $uname = $mysqli->real_escape_string(strip_tags($uname, ENT_QUOTES));
        $pass = $mysqli->real_escape_string(strip_tags($pass, ENT_QUOTES));
            
        //Test to see if their credentials are valid
        $query = file_get_contents(__DIR__ . "/../../model/dml/user/user_logs_on.sql");
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
?>
