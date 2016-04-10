<?php
	require_once('session.php');
    require_once('model/User.php');

    

    function generateHash($string)
    {
        for ($i = 0; $i < 50; $i++)
        {
            $string = hash('sha256', $string);
        }
        return $string;
    }

    /*
    If login is successful, returns a user object with all necessary attributes assigned.
    */
    function doLogin($uname, $pass)
    {
        $database = new DBConnection();
        $mysqli = $database->conn;
            
            
        //Test to see if their credentials are valid
        $query = 'SELECT * FROM user WHERE username = ? OR email = ?';
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
                return new User($uid, $username, $email, $alias, $gender, $age, $is_admin); 
            // password hashes matched, this is a valid user
        }
        return false; // password hashes did not match or username didn't exist
    }
    function doRegister()
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
        } elseif (strlen($username) > 64 || strlen($username) < 2) {
            $message = "Username cannot be shorter than 2 or longer than 64 characters";
        } elseif (!preg_match('/^[a-z\d]{2,64}$/i', $username)) {
            $message = "Username does not fit the name scheme: only a-Z and numbers are allowed, 2 to 64 characters";
        } elseif (empty($email)) {
            $message = "Email cannot be empty";
        } elseif (strlen($email) > 64) {
            $message = "Email cannot be longer than 64 characters";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $message = "Your email address is not in a valid email format";
        } elseif (!empty($username)
            && strlen($username) <= 64
            && strlen($username) >= 2
            && preg_match('/^[a-z\d]{2,64}$/i', $username)
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
                
                $password_hash = generateHash($salt . $pass);
                
                // check to make sure that the username and email address hasn't already been used
                $sql = "SELECT * FROM users WHERE username = '" . $username . "' OR email = '" . $email . "';";
                $query_check_user_name = $db->query($sql);

                if ($query_check_user_name->num_rows == 1) {
                    $message = "Sorry, that username / email address is already taken.";
                } else {
                    // adds the new users data into the database
                    $sql = "INSERT INTO user (username, email, alias, hash_pass, gender) VALUES ('". $username . "','" . $email . "','" . $username . "','" . $password_hash . "'," . "0)";
                    $query_new_user_insert = $db->query($sql);
                    // if user has been added successfully
                    if ($query_new_user_insert) {
                        $message = "Your account has been created successfully. You can now log in.";
                    } else {
                        $message = "Sorry, your registration failed. Please go back and try again.";
                    }
                }
            } else {
                $message = "Sorry, no database connection.";
            }
        } else {
            $message = "An unknown error occurred.";
        }
        return $message;
    }
?>
