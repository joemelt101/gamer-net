<?php
	require("model/dbConnection.php");
	require("scripts/login_script.php");
	$login = new Login();

	            // show any errors that occured during the login process
            if (isset($login)) {
                if ($login->errors) {
                    foreach ($login->errors as $error) {
                         echo "<font color='red'><b>".$error."</font></b><br>";
                    }
                }
                else
                    header("Location: dashboard.php");
            }
?>
