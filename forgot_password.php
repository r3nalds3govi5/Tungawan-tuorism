<?php
    session_start();
    require ('db.php');
    
    $msg = "";
    if (isset($_POST['submit'])) {
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $code = mysqli_real_escape_string($conn, md5(rand()));
    
        if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM tourist WHERE email='{$email}'")) > 0) {
            $query = mysqli_query($conn, "UPDATE tourist SET code='{$code}' WHERE email='{$email}'");
            
            if ($query) {
                $from = 'https://tungawantourism.com';
                $to = $email;
                $subject = 'no reply';
                $message = 'Here is the verification link <b><a href="https://tungawantourism.com/reset_password.php?reset='.$code.'">';
        
                $headers = $from;
                mail($to, $subject, $message, $headers);
                
                $msg = "<div class='alert alert-info'>We've sent a verification link to your email address.</div>";   
            }
        } else {
            $msg = "<div class='alert alert-warning'>This email address did not found.</div>";   
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

</head>
<body>
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
            	      			<h3 class="mb-4">Forgot Password</h3>
            	      		</div>
            				<div class="w-50">
            					<p class="social-media d-flex justify-content-end">
            						<a href="#" class="social-icon d-flex align-items-center justify-content-center"><span class="fa fa-facebook"></span></a>
            						<a href="#" class="social-icon d-flex align-items-center justify-content-center"><span class="fa fa-twitter"></span></a>
            					</p>
            			    </div>
		      	        </div>
        				<form action="#" class="login-form" method="POST">
                            <?php echo $msg; ?>
        		      		<div class="form-group">
        		      			<div class="icon d-flex align-items-center justify-content-center"><span class="fa fa-envelope-o"></span></div>
        		      			<input type="email" class="form-control rounded-left" name="email" placeholder="Email" required>
        		      		</div>
            	            <div class="form-group d-flex align-items-center">
            	            	<div class="w-100">
            					</div>
        						<div class="w-100 d-flex justify-content-end">
            		            	<button type="submit" name="submit" class="btn btn-primary rounded submit">Send</button>
            	            	</div>
            	            </div>
            	            <div class="form-group mt-4">
                				<div class="w-100 text-center">
                					<p class="mb-1">Back to login? <a href="loginForm.php">Sign In</a></p>
                				</div>
        	                </div>
    	                </form>
	                </div>
				</div>
			</div>
		</div>
	</section>

    <script src="js/jquery.min.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
</body>
</html>