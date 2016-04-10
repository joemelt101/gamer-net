<?php

/**
 * Login class will handle all of the user login/logout process
 */
class Login
{
    // variable for database connection
    private $db_connection = null;
    
    // an array to hold all of the potential error messages
    public $errors = array();
    
    // an array to hold all other messages 
    public $messages = array();

   
    // __construct() function will automatically starts when you previously did "$login = new Login();"
    public function __construct()
    {
        // create/read session, IMPORTANT!
        session_start();

        // if the user slects the logout button this happens...
        if (isset($_GET["logout"])) {
            $this->doLogout();
        }
        // use post data to login, if a user login form is submitted... 
        elseif (isset($_POST["login"])) {
            $this->dologinWithPostData();
        }
    }

    // login with the given post data
    private function dologinWithPostData()
    {
        // check login form to make sure the user didn't mess anything up
        // this isn't 100% necessary
        if (empty($_POST['user_name'])) {
            $this->errors[] = "Username field was empty.";
        } elseif (empty($_POST['user_password'])) {
            $this->errors[] = "Password field was empty.";
        } elseif (!empty($_POST['user_name']) && !empty($_POST['user_password'])) {

            $database = new dbConnection();
            
            $this->db_connection = $database->conn;
            // change the input to utf8 and check the connection again
            if (!$this->db_connection->set_charset("utf8")) {
                $this->errors[] = $this->db_connection->error;
            }

            // if we didn't find any error, we can confirm a connection to the database
            if (!$this->db_connection->connect_errno) {

                // escape the POST stuff from the username input
                $user_name = $this->db_connection->real_escape_string($_POST['user_name']);

                // a query to our database, retrieves all info on the selected user (works for both username and user_email)
                $sql = "SELECT *
                        FROM user
                        WHERE username = '" . $user_name . "' OR email = '" . $user_name . "';";
                $result_of_login_check = $this->db_connection->query($sql);
                


                // if we find the username or email...
                if ($result_of_login_check->num_rows == 1) {
                
                    // store the resulting row into an object
                    $result_row = $result_of_login_check->fetch_object();

                    // the following utilizes PHP 5.5s password_verify(). It checks to make sure the provided password matches the hash stored in our DB
                    if (password_verify($_POST['user_password'], $result_row->hash_pass)) {

                        // write user data into PHP SESSION, SUPERGLOBALS!
                        $_SESSION['user_name'] = $result_row->username;
                        $_SESSION['user_email'] = $result_row->email;
                        $_SESSION['u_fname'] = $result_row->u_fname;
                        $_SESSION['u_lname'] = $result_row->u_lname;
                        $_SESSION['u_age'] = $result_row->u_age;
                        $_SESSION['u_sex'] = $result_row->u_sex;
                        $_SESSION['u_zip'] = $result_row->u_zip;
                        $_SESSION['u_exp'] = $result_row->u_exp;
                        $_SESSION['user_id'] = $result_row->user_id;
                        $_SESSION['user_login_status'] = 1;

                    } else {
                        $this->errors[] = "Wrong password. Try again.";
                    }
                } else {
                    $this->errors[] = "This user does not exist.";
                }
            } else {
                $this->errors[] = "Database connection problem.";
            }
        }
    }

    // function to log the user out
    public static function doLogout()
    {
        // make sure you delete all the session data
        $_SESSION = array();
        session_destroy();
        // prompt the user that the have been logged out
       // $this->messages[] = "You have been logged out.";

    }

    // quick and dirty function to check if the user is logged in
    public function isUserLoggedIn()
    {
        if (isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] == 1) {
            return true;
        }
        // default 
        return false;
    }
}
