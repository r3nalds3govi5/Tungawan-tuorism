<?php
    session_start();
    require ('db.php');
    
    $msg="";
    if (isset($_GET['verification'])) {
        if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM tourist WHERE code='{$_GET['verification']}'")) > 0) {
            $query = mysqli_query($conn, "UPDATE tourist SET code='' WHERE code='{$_GET['verification']}'");
            if ($query) {
                $msg = "<div class='alert alert-success'>Account verification has been successfully completed.</div>";
            }
        } else {
            header("Location: loginForm.php");
        }
    }
    
    if (isset($_GET['confirm'])) {
        if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM tourist INNER JOIN booking ON tourist.tourist_id=booking.tourist WHERE booking.booking_id='{$_GET['confirm']}'")) > 0) {
            $query = mysqli_query($conn, "UPDATE booking SET status='3' WHERE booking_id='{$_GET['confirm']}'");
            if ($query) {
                $msg = "<div class='alert alert-success'>Your booking successfully confirmed.</div>";
            }
        } else {
            header("Location: loginForm.php");
        }
    }
    
    if (isset($_POST['submit'])) {
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = mysqli_real_escape_string($conn, md5($_POST['password']));

        $sql = "SELECT * FROM tourist WHERE email='{$email}' AND password='{$password}'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);

            if (empty($row['code'])) {
                $_SESSION['loginid'] = $row['id'];
                // $_SESSION['status']=$email;
                header("location: index.php");
		        exit();
            } else {
                $msg = "<div class='alert alert-warning'>First verify your email account and try again.</div>";
            }
        } else {
            $msg= "<div class='alert alert-danger'>Email or password not matched.</div>";
        }
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
	
	<link href="lib/animate/animate.min.css" rel="stylesheet">

</head>
<body>
    <!-- Spinner Start -->
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <!-- Spinner End -->
	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-6 text-center mb-5">
					<h2 class="heading-section"><a href="index.php">Tungawan Tourism</a></h2>
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="col-md-7 col-lg-5">
					<div class="login-wrap p-4 p-md-5">
        		      	<div class="d-flex">
            	      		<div class="w-100">
            	      			<h3 class="mb-4">Sign In</h3>
            	      		</div>
            				<div class="w-100">
            					<p class="social-media d-flex justify-content-end">
            						<!--<a href="#" class="social-icon d-flex align-items-center justify-content-center"><span class="fa fa-facebook"></span></a>-->
            						<!--<a href="#" class="social-icon d-flex align-items-center justify-content-center"><span class="fa fa-twitter"></span></a>-->
            					</p>
            			    </div>
		      	        </div>
        				<form action="#" class="login-form" method="POST" onsubmit="return validateForm()">
                            <?php echo $msg; ?>
                            <span id="password-error" style="color: red;"></span>
        		      		<div class="form-group">
        		      			<div class="icon d-flex align-items-center justify-content-center"><span class="fa fa-envelope-o"></span></div>
        		      			<input type="email" class="form-control rounded-left" name="email" placeholder="Email" required>
        		      		</div>
            	            <div class="form-group">
            	            	<div class="icon d-flex align-items-center justify-content-center"><span class="fa fa-lock"></span></div>
            	                <input type="password" class="form-control rounded-left" name="password" id="password" placeholder="Password" required>
            	            </div>
            	            <div class="form-group d-flex align-items-center">
            	            	<div class="w-100">
            	    <!--                <label class="checkbox-wrap checkbox-primary mb-0">Save Password-->
        							  <!--<input type="checkbox" checked>-->
        							  <!--<span class="checkmark"></span>-->
            					<!--	</label>-->
            					</div>
        						<div class="w-100 d-flex justify-content-end">
            		            	<button type="submit" name="submit" class="btn btn-primary rounded submit">Login</button>
            	            	</div>
            	            </div>
            	            <div class="form-group mt-4">
                				<div class="w-100 text-center">
                					<p class="mb-1">Don't have an account? <a href="registration_form.php">Sign Up</a></p>
                					<p><a href="forgot_password.php">Forgot Password</a></p>
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
            } else {
                document.getElementById("password-error").innerHTML = "";
                return true;
            }
        }
    </script>
    <script src="js/jquery.min.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
</body>
</html>