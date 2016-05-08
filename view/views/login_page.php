<html>
    <head>
  <title>Gamer-Net | Login</title>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>  
        
    <style>
        
        body {
            /*removed wood background*/
            /*background-image: url("https://s-media-cache-ak0.pinimg.com/736x/e4/98/1a/e4981a3dd4aa2fa6f0bc84cde9087c7a.jpg");*/
            background: black; /* For browsers that do not support gradients */
            background: -webkit-linear-gradient(black, #252525); /* For Safari 5.1 to 6.0 */
            background: -o-linear-gradient(black, #252525); /* For Opera 11.1 to 12.0 */
            background: -moz-linear-gradient(black, #252525); /* For Firefox 3.6 to 15 */
            background: linear-gradient(black, #252525); /* Standard syntax */
            padding: -40px;
            background-position:center center;
            background-repeat:no-repeat;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
        }
                
        .card-container.card {
            max-width: 400px;
            padding: 30px 30px;
        }
                
        .LoginContainer {
            padding-top: 5%;   
        }

        .btn {
            font-weight: 700;
            height: 36px;
            -moz-user-select: none;
            -webkit-user-select: none;
            user-select: none;
            cursor: default;
        }

        /*
         * Card component
         */
        .card {
            background-color: #F7F7F7;
            /* just in case there no content*/
            padding: 20px 25px 30px;
            margin: 0 auto 25px;
            margin-top: 50px;
            /* shadows and rounded borders */
            -moz-border-radius: 2px;
            -webkit-border-radius: 2px;
            border-radius: 2px;
            -moz-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
            -webkit-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
            box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
        }

        .profile-img-card {
            width: 96px;
            height: 96px;
            margin: 0 auto 10px;
            display: block;
            -moz-border-radius: 50%;
            -webkit-border-radius: 50%;
            border-radius: 50%;
        }

        /*
         * Form styles
         */
        .profile-name-card {
            font-size: 16px;
            font-weight: bold;
            text-align: center;
            margin: 10px 0 0;
            min-height: 1em;
        }

        .reauth-email {
            display: block;
            color: #404040;
            line-height: 2;
            margin-bottom: 10px;
            font-size: 14px;
            text-align: center;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            -moz-box-sizing: border-box;
            -webkit-box-sizing: border-box;
            box-sizing: border-box;
        }

        .form-signin #inputEmail,
        .form-signin #inputPassword {
            direction: ltr;
            height: 44px;
            font-size: 16px;
        }

        .form-signin input[type=email],
        .form-signin input[type=password],
        .form-signin input[type=text],
        .form-signin button {
            width: 100%;
            display: block;
            margin-bottom: 10px;
            z-index: 1;
            position: relative;
            -moz-box-sizing: border-box;
            -webkit-box-sizing: border-box;
            box-sizing: border-box;
        }

        .form-signin .form-control:focus {
            border-color: rgb(104, 145, 162);
            outline: 0;
            -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075),0 0 8px rgb(104, 145, 162);
            box-shadow: inset 0 1px 1px rgba(0,0,0,.075),0 0 8px rgb(104, 145, 162);
        }

        .btn.btn-signin {
            /*background-color: #4d90fe; */
            /*background-color: rgb(104, 145, 162);*/
            background-color: gray;
            /* background-color: linear-gradient(rgb(104, 145, 162), rgb(12, 97, 33));*/
            padding: 0px;
            font-weight: 700;
            font-size: 14px;
            height: 36px;
            -moz-border-radius: 3px;
            -webkit-border-radius: 3px;
            border-radius: 3px;
            border: none;
            -o-transition: all 0.218s;
            -moz-transition: all 0.218s;
            -webkit-transition: all 0.218s;
            transition: all 0.218s;
        }

        .btn.btn-signin:hover,
        .btn.btn-signin:active,
        .btn.btn-signin:focus {
            background-color: #5cb85c;
        }

        .forgot-password {
            color: rgb(104, 145, 162);
        }

        .forgot-password:hover,
        .forgot-password:active,
        .forgot-password:focus{
            color: rgb(12, 97, 33);
        }

        .g-recaptcha > div > div {
            margin-left: auto;
            margin-right: auto;
            width: 100%;
        }

        .g-recaptcha{
            width: 100%;
        }

    </style>
    
    <!-- google recaptcha -->
    <script src='https://www.google.com/recaptcha/api.js'></script>
        
</head>
    
    <body>
       
         <?php require_once('view/views/navbar_component.php'); ?>
         <?php require_once('controller/php_libs/recaptchalib.php');?>
        
        <div class="container-fixed container">
            
            <div class="LoginContainer">
        <div class="card card-container">
            <!-- <img class="profile-img-card" src="//lh3.googleusercontent.com/-6V8xOA6M7BA/AAAAAAAAAAI/AAAAAAAAAAA/rzlHcD0KYwo/photo.jpg?sz=120" alt="" /> -->
            <img id="profile-img" class="profile-img-card" src="//ssl.gstatic.com/accounts/ui/avatar_2x.png" />
            <p id="profile-name" class="profile-name-card"></p>
            <form class="form-signin" method="post" action="login">
                <span id="reauth-email" class="reauth-email"></span>
                <input type="text" name="username" id="login" class="form-control" placeholder="Email or Username" required autofocus>
                <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>
                <div id="remember" class="checkbox">
                    <label>
                        <input type="checkbox" value="remember-me"> Remember me
                    </label>
                </div>
                <!-- recaptcha -->
                <div class="g-recaptcha" data-sitekey="6LeoVx8TAAAAADzo0h4wZU3AEuh4CHyS2XX4CNl8" data-theme="light"></div>
                <br>
                <button class="btn btn-lg btn-primary btn-block btn-signin" name="loginButton" type="submit">Sign in</button>
            </form><!-- /form -->
            

            <a href="#" class="forgot-password">
                Forgot password?
            </a>
            <br><br>
            Don't have an account?
            <a href="register" class="forgot-password">
                Register
            </a>
        </div><!-- /card-container -->
    </div><!-- /container -->
            
        </div>
       
        
    </body>
    
</html>
