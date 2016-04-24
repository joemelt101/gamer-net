<?php
class Controller
{
    public function __construct()
    {
        if (isLoggedIn())
        {
            redirect("dashboard");   
        }
        if (isset($_POST['email'], $_POST['email2'], $_POST['username'], 
        $_POST['pass'], $_POST['pass2']))
        {
            
            $registerMessage = self::doRegister();
            if ($registerMessage == "successful registration")
            {
                login($_POST['username'], $_POST['pass']);
            }
            else
                echo $registerMessage;
        }
    }
    public function getData()
    {   
        return NULL;
    }
    static function doRegister()
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
