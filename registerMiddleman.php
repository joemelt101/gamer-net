<?php
	require("model/dbConnection.php");
	require("scripts/registration_script.php");
	$register = new registration();

	            // show any errors that occured during the login process
            if (isset($register)) {
                if ($register->errors) {
                    foreach ($register->errors as $error) {
                         echo "<font color='red'><b>".$error."</font></b><br>";
                    }
                }
                else
                    header("Location: dashboard.php");
            }
?>
