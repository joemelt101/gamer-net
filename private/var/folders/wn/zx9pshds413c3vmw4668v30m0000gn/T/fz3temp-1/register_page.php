<html>
    <head>
  <title>Bootstrap Theme Simply Me</title>

        
        
        
        
    <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">


<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
     
    <style>
        
        .LoginContainer {
    padding-top: 5%;   
}
          .card-container.card {
    max-width: 450px;
    padding: 40px 40px;
}
        
.LoginContainer {
    padding-top: 0%;   
}

body {
    background-image: url("https://s-media-cache-ak0.pinimg.com/736x/e4/98/1a/e4981a3dd4aa2fa6f0bc84cde9087c7a.jpg");
    padding: -40px;
    background-position:center center;
    background-repeat:no-repeat;
    -webkit-background-size: cover;
    -moz-background-size: cover;
    -o-background-size: cover;
    background-size: cover;
}
.btn {
    font-weight: 700;
    height: 36px;
    -moz-user-select: none;
    -webkit-user-select: none;
    user-select: none;
    cursor: default;
}
        
 .btn.btn-create {
    /*background-color: #4d90fe; */
    background-color: rgb(104, 145, 162);
 }
        
.btn.btn-create:hover,
.btn.btn-create:active,
.btn.btn-create:focus {
    background-color: rgb(12, 97, 33);
}
        
.panel-body {
    background-color: #F7F7F7;   
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
        
    
        </style>
        
         
</head>
    
    <body>
        
        
       <?php require_once('view/views/navbar_component.php'); ?>

        
        <div class=" container-fixed container">
            
            <div class="LoginContainer">
            <div class="card card-container">    
		<div class="row">
			<div class="">
				<div class="panel-body">
					<form method="POST" action="#" role="form">
						<div class="form-group">
							<h2 class="text-center">Create account</h2>
						</div>
						
						<div class="form-group">
                            <label class="control-label" for="email">Email</label>
							<input id="signupEmail" type="email" maxlength="50" class="form-control" placeholder="Email Address">
						</div>
						<div class="form-group">
                            <label class="control-label" for="repeatEmail"></label>
							<input id="signupEmailagain" type="email" maxlength="50" class="form-control" placeholder="Repeat Email">
						</div>
                        <div class="form-group">
                            <label class="control-label" for="username">Username</label>
							<input id="username"  maxlength="50" class="form-control" placeholder="Username">
						</div>
						<div class="form-group">
							<label class="control-label" for="signupPassword">Password</label>
							<input id="signupPassword" type="password" maxlength="25" class="form-control" placeholder="at least 6 characters" length="40">
						</div>
						<div class="form-group">
							<label class="control-label" for="signupPasswordagain">Password again</label>
							<input id="signupPasswordagain" type="password" maxlength="25" class="form-control" placeholder="Repeat Password">
						</div>
						<div class="form-group">
							<button id="signupSubmit" type="submit" class="btn btn-info btn-block btn-create">Create your account</button>
						</div>
						<p class="form-group">By creating an account, you agree to our <a href="#">Terms of Use</a> and our <a href="#">Privacy Policy</a>.</p>
						<hr>
						<p></p>Already have an account? <a href="#">Sign in</a></p>
					</form>
				</div>
			</div>
		</div>
	

            </div>
    </div><!-- /container -->
            
        </div>
       
        
    </body>
    
</html>