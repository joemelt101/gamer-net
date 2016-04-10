<?php

// class that handles the user registration 
class Registration
{
    
    // variable for database connection
    private $db_connection = null;
    
    // an array to hold all of the potential error messages
    public $errors = array();
    
    // an array to hold all other messages 
    public $messages = array();

    // __construct() function will automatically starts when you previously did "$registration = new Registration();"
    public function __construct()
    {
        if (isset($_POST["register"])) {
            $this->registerNewUser();
        }
    }

    /**
     * handles the entire registration process. checks all error possibilities
     * and creates a new user in the database if everything is fine
     */
    // function to handle the registration process, also checks for any possible user errors
    // if there aren't any errors it adds the new user to the database.
    private function registerNewUser()
    {
        if (empty($_POST['user_name'])) {
            $this->errors[] = "Empty Username";
        } elseif (empty($_POST['user_password_new']) || empty($_POST['user_password_repeat'])) {
            $this->errors[] = "Empty Password";
        } elseif ($_POST['user_password_new'] !== $_POST['user_password_repeat']) {
            $this->errors[] = "Password and password repeat are not the same";
        } elseif (strlen($_POST['user_password_new']) < 6) {
            $this->errors[] = "Password has a minimum length of 6 characters";
        } elseif (strlen($_POST['user_name']) > 64 || strlen($_POST['user_name']) < 2) {
            $this->errors[] = "Username cannot be shorter than 2 or longer than 64 characters";
        } elseif (!preg_match('/^[a-z\d]{2,64}$/i', $_POST['user_name'])) {
            $this->errors[] = "Username does not fit the name scheme: only a-Z and numbers are allowed, 2 to 64 characters";
        } elseif (empty($_POST['user_email'])) {
            $this->errors[] = "Email cannot be empty";
        } elseif (strlen($_POST['user_email']) > 64) {
            $this->errors[] = "Email cannot be longer than 64 characters";
        } elseif (!filter_var($_POST['user_email'], FILTER_VALIDATE_EMAIL)) {
            $this->errors[] = "Your email address is not in a valid email format";
        } elseif (!empty($_POST['user_name'])
            && strlen($_POST['user_name']) <= 64
            && strlen($_POST['user_name']) >= 2
            && preg_match('/^[a-z\d]{2,64}$/i', $_POST['user_name'])
            && !empty($_POST['user_email'])
            && strlen($_POST['user_email']) <= 64
            && filter_var($_POST['user_email'], FILTER_VALIDATE_EMAIL)
            && !empty($_POST['user_password_new'])
            && !empty($_POST['user_password_repeat'])
            && ($_POST['user_password_new'] === $_POST['user_password_repeat'])
        ) {
            // starts a database connection
            $database = new dbConnection();
            $this->db_connection = $database->conn;

            // change character set to utf8 and check it
            if (!$this->db_connection->set_charset("utf8")) {
                $this->errors[] = $this->db_connection->error;
            }

             // change the input to utf8 and check the connection again
            // change the input to utf8 and check the connection again
            if (!$this->db_connection->connect_errno) {

                // escaping, additionally removing everything that could be (html/javascript-) code
                // escaping allows us to prevent any input that could be potentially harmful
                // AKA javascript/HMTL/SQL injection
                $user_name = $this->db_connection->real_escape_string(strip_tags($_POST['user_name'], ENT_QUOTES));
                $user_email = $this->db_connection->real_escape_string(strip_tags($_POST['user_email'], ENT_QUOTES));
                $u_fname = $_POST['u_fname'];
                $u_lname = $_POST['u_lname'];
                $u_age = $_POST['u_age'];
                $u_sex = $_POST['u_sex'];
                $u_zip = $_POST['u_zip'];
                $u_exp = $_POST['u_exp'];
                $user_password = $_POST['user_password_new'];

               
                // use PHP 5.5's function: password_hash in order to hash the user's password (60 char)
                $user_password_hash = password_hash($user_password, PASSWORD_DEFAULT);

                // check to make sure that the username and email address hasn't already been used
                $sql = "SELECT * FROM users WHERE user_name = '" . $user_name . "' OR user_email = '" . $user_email . "';";
                $query_check_user_name = $this->db_connection->query($sql);

                if ($query_check_user_name->num_rows == 1) {
                    $this->errors[] = "Sorry, that username / email address is already taken.";
                } else {
                    // adds the new users data into the database
                    $sql = "INSERT INTO user (username, email, alias, hash_pass, gender) VALUES (". $user_name . "," . $user_email . "," . $user_name . "," . $user_password_hash . "," . "0)";
                    $query_new_user_insert = $this->db_connection->query($sql);
                    // if user has been added successfully
                    if ($query_new_user_insert) {
                        $this->messages[] = "Your account has been created successfully. You can now log in.";
                    } else {
                        $this->errors[] = "Sorry, your registration failed. Please go back and try again.";
                    }
                }
            } else {
                $this->errors[] = "Sorry, no database connection.";
            }
        } else {
            $this->errors[] = "An unknown error occurred.";
        }
    }
}





