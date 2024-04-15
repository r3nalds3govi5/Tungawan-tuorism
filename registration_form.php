<?php
    session_start();
    require ('db.php');

    $msg = "";
    if (isset($_POST['submit'])) {
        $fname = mysqli_real_escape_string($conn, $_POST['fname']);
        $lname = mysqli_real_escape_string($conn, $_POST['lname']);
        $mobile = mysqli_real_escape_string($conn, $_POST['mobile']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = mysqli_real_escape_string($conn, md5($_POST['password']));
        $confirm_password = mysqli_real_escape_string($conn, md5($_POST['confirm_password']));
        $code = mysqli_real_escape_string($conn, md5(rand()));

        $destsearch = mysqli_query($conn,"SELECT * FROM `tourist` ORDER BY seq DESC");
        $destsearch_run=mysqli_fetch_array($destsearch);
    
        $dateString = date('Ymd');
        $type = 'TID';
          $destIDNumber = $destsearch_run['seq'];
      
        if($destIDNumber < 9999) {
          
          $destIDNumber = $destIDNumber + 1;
        }else{
        $destIDNumber = 1;
        } 
        $destNumber = $type . '' . $dateString . '-' . $destIDNumber;
        
        date_default_timezone_set('Asia/Manila');
        $petsa=date("Y-m-d");
        
        if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM tourist WHERE email='{$email}'")) > 0) {
            $msg = "<div class='alert alert-danger'>{$email} - This email address has been already exists.</div>";
        } else {
            if ($password === $confirm_password) {
                $sql = "INSERT INTO tourist (seq, tourist_id, firstName, lastName, mobile, email, password, code, date_entry) 
                VALUES('$destIDNumber', '$destNumber','$fname', '$lname','$mobile','$email','$password','$code','$petsa')";
                $result = mysqli_query($conn, $sql);

                if ($result) {
                    $from = 'tungawantourism.com';
                    $to = $email;
                    $subject = 'no reply';
                    $message = 'Here is the verification link <b><a href="https://tungawantourism.com/loginForm.php?verification='.$code.'">';
            
                    $headers = $from;
                    mail($to, $subject, $message, $headers);
                    $msg = "<div class='alert alert-info'>We've send a verification link on your email address.</div>";
                } else {
                    $msg = "<div class='alert alert-danger'>Something wrong went.</div>";
                }
            } else {
                $msg = "<div class='alert alert-danger'>Password and Confirm Password do not match</div>";
            }
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
            	      			<h3 class="mb-4">Sign Up</h3>
            	      		</div>
            				<div class="w-100">
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
        		      			<div class="icon d-flex align-items-center justify-content-center"><span class="fa fa-user"></span></div>
        		      			<input type="text" class="form-control rounded-left" name="fname" placeholder="First Name" required>
        		      		</div>
        		      		<div class="form-group">
        		      			<div class="icon d-flex align-items-center justify-content-center"><span class="fa fa-user"></span></div>
        		      			<input type="text" class="form-control rounded-left" name="lname" placeholder="Last Name" required>
        		      		</div>
        		      		<div class="form-group">
        		      			<div class="icon d-flex align-items-center justify-content-center"><span class="fa fa-phone"></span></div>
        		      			<input type="number" class="form-control rounded-left" min="0" maxlength="10" minlength="10" name="mobile" placeholder="Mobile" required>
        		      		</div>
        		      		<div class="form-group">
        		      			<div class="icon d-flex align-items-center justify-content-center"><span class="fa fa-envelope-o"></span></div>
        		      			<input type="email" class="form-control rounded-left" name="email" placeholder="Email" required>
        		      		</div>
            	            <div class="form-group">
            	            	<div class="icon d-flex align-items-center justify-content-center"><span class="fa fa-lock"></span></div>
            	                <input type="password" class="form-control rounded-left" name="password" id="password" placeholder="Password" required>
            	            </div>
            	            <div class="form-group">
            	            	<div class="icon d-flex align-items-center justify-content-center"><span class="fa fa-lock"></span></div>
            	                <input type="password" class="form-control rounded-left" name="confirm_password" placeholder="Confirm Password" required>
            	            </div>
            	            <div class="form-group d-flex align-items-center">
            	            	<div class="w-100">
                            <div class="wrappers">
                                        <?php
                                            $typequery = mysqli_query($conn,"SELECT * FROM terms_condition WHERE type='register'");
                                            $typedata = mysqli_fetch_array($typequery);
                                        ?>
                                            <input  type="checkbox" class="chk" name="terms" autocomplete="off" id="check"  required /> 
                                            <label for="check"> I agree with the <a href="../admin/uploads/<?php echo $typedata['terms_condition']; ?>" target="_blank"> Terms and condition</a></label>
                            </div>
            					</div>
        						<div class="w-100 d-flex justify-content-end">
            		            	<button type="submit" name="submit" class="btn btn-primary rounded submit">Login</button>
            	            	</div>
            	            </div>
            	            <div class="form-group mt-4">
                				<div class="w-100 text-center">
                					<p class="mb-1">Already have an account? <a href="loginForm.php">Sign in</a></p>
                				</div>
        	                </div>
    	                </form>
	                </div>
				</div>
			</div>
		</div>
	</section>
	    <script>
        document.querySelectorAll('input[type="number"]').forEach(input =>{
            input.oninput = () =>{
                if(input.value.length > input.maxLength) input.value = input.value.slice(0, input.maxLength);
            }
        });
    </script>
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