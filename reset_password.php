<?php
    session_start();
    require ('db.php');
    
    $msg = "";
    if (isset($_GET['reset'])) {
        if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM tourist WHERE code='{$_GET['reset']}'")) > 0) {
            if (isset($_POST['submit'])) {
                $password = mysqli_real_escape_string($conn, md5($_POST['password']));
                $confirm_password = mysqli_real_escape_string($conn, md5($_POST['confirm_password']));
    
                if ($password === $confirm_password) {
                    $query = mysqli_query($conn, "UPDATE tourist SET password='{$password}', code='' WHERE code='{$_GET['reset']}'");
    
                    if ($query) {
                        header("Location: loginForm.php");
                    }
                } else {
                    $msg = "<div class='alert alert-warning'>Password and confirm password did not match.</div>";   
                }
            }
        } else {
            $msg = "<div class='alert alert-warning'>Reset link did not match.</div>";  
        }
    } else {
        header("Location: reset_password.php");
    }
?>
<!doctype html>
<html lang="en">
  <head>
  	<title>Tungawan Tourism</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	
	<link rel="stylesheet" href="css/login.css">
	<link rel="shortcut icon" href="admin/dist/img/logo.png">

</head>
<body>
	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-6 text-center mb-5">
					<h2 class="heading-section">Tungawan Tourism</h2>
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="col-md-7 col-lg-5">
					<div class="login-wrap p-4 p-md-5">
        		      	<div class="d-flex">
            	      		<div class="w-100">
            	      			<h3 class="mb-4">New Password</h3>
            	      		</div>
            				<div class="w-50">
            					<p class="social-media d-flex justify-content-end">
            						<a href="#" class="social-icon d-flex align-items-center justify-content-center"><span class="fa fa-facebook"></span></a>
            						<a href="#" class="social-icon d-flex align-items-center justify-content-center"><span class="fa fa-twitter"></span></a>
            					</p>
            			    </div>
		      	        </div>
        				<form action="#" class="login-form" method="POST" onsubmit="return validateForm()">
                            <?php echo $msg; ?>
                            <span id="password-error" style="color: red;"></span>
            	            <div class="form-group">
            	            	<div class="icon d-flex align-items-center justify-content-center"><span class="fa fa-lock"></span></div>
            	                <input type="password" class="form-control rounded-left" name="password" id="password" placeholder="Password" required>
            	            </div>
            	            <div class="form-group">
            	            	<div class="icon d-flex align-items-center justify-content-center"><span class="fa fa-lock"></span></div>
            	                <input type="password" class="form-control rounded-left" name="confirm_password" placeholder="Password" required>
            	            </div>
            	            <div class="form-group d-flex align-items-center">
            	            	<div class="w-100">
            					</div>
        						<div class="w-100 d-flex justify-content-end">
            		            	<button type="submit" name="submit" class="btn btn-primary rounded submit">Login</button>
            	            	</div>
            	            </div>
            	            <div class="form-group mt-4">
                				<div class="w-100 text-center">
                					<p class="mb-1">Don't have an account? <a href="registration_form.php">Sign Up</a></p>
                				</div>
        	                </div>
    	                </form>
	                </div>
				</div>
			</div>
		</div>
	</section>
    <script>
        function validateForm() {
            var password = document.getElementById("password").value;
            
            if (password.length < 8) {
                document.getElementById("password-error").innerHTML = "Password must be at least 8 characters long";
                return false;
            } else if (!containsUpperCase(password) || !containsLowerCase(password) || !containsNumber(password)) {
                document.getElementById("password-error").innerHTML = "Password must contain at least one uppercase letter, one lowercase letter, and one number";
                return false;
            } else {
                document.getElementById("password-error").innerHTML = "";
                return true;
            }
        }
        
        function containsUpperCase(str) {
            return /[A-Z]/.test(str);
        }
        
        function containsLowerCase(str) {
            return /[a-z]/.test(str);
        }
        
        function containsNumber(str) {
            return /\d/.test(str);
        }
    </script>
    <script src="js/jquery.min.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
</body>
</html>