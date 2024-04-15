<?php
    session_start();
    require ('db.php');

    $msg = "";
    if (isset($_POST['signup'])) {
        $fname = mysqli_real_escape_string($conn, $_POST['firstName']);
        $lname = mysqli_real_escape_string($conn, $_POST['lastName']);
        $mobile = mysqli_real_escape_string($conn, $_POST['mobile']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = mysqli_real_escape_string($conn, md5($_POST['password']));
        $confirm_password = mysqli_real_escape_string($conn, md5($_POST['confirm_password']));
        $code = mysqli_real_escape_string($conn, md5(rand()));

        $destsearch = mysqli_query($conn,"SELECT * FROM `tourist` ORDER BY seq DESC");
        $destsearch_run=mysqli_fetch_array($destsearch);
    
        $dateString = date('Ymd');
        $type = 'DID';
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
                    $message = 'Here is the verification link <b><a href="https://tungawantourism.com/registrationForm.php?verification='.$code.'">';
            
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

    $msg="";
    if (isset($_GET['verification'])) {
        if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM tourist WHERE code='{$_GET['verification']}'")) > 0) {
            $query = mysqli_query($conn, "UPDATE tourist SET code='' WHERE code='{$_GET['verification']}'");
            if ($query) {
                $msg= "Account verification has been successfully completed";
                // header("Location: registrationForm.php?$msg");
            }
        } else {
            header("Location: registrationForm.php");
        }
    }

    if (isset($_POST['submitbtn'])) {
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
                // header("location: registrationForm.php?$msg");
            }
        } else {
            $msg= "<div class='alert alert-danger'>Email or password not matched.</div>";
            // header("location: registrationForm.php?$msg");
        }
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Tungawan Tourism</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="" name="keywords">
  <meta content="" name="description">

  <!-- Google Web Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Nunito:wght@600;700;800&display=swap" rel="stylesheet">

  <!-- Template Stylesheet -->
  <link href="css/registration.css" rel="stylesheet">
  <link rel="shortcut icon" href="admin/dist/img/logo.png">
  <script
    src="https://kit.fontawesome.com/64d58efce2.js"
    crossorigin="anonymous"
  ></script>
</head>
<body>
<div class="container">
    <div class="forms-container">
        <div class="signin-signup">
            <form action="" method="POST" class="sign-in-form">
                <?php echo $msg; ?>
                <h2 class="title">Sign in</h2>
                <div class="input-field">
                  <i class="fas fa-envelope"></i>
                  <input type="email" name="email" placeholder="Email" />
                </div>
                <div class="input-field">
                  <i class="fas fa-lock"></i>
                  <input type="password" name="password" placeholder="Password" />
                </div>
                <input type="submit" value="Login" class="btn solid" name="submitbtn" />
                
                <a class="txt2" href="login.php">
    				Forgot password
    				<i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
			    </a>
            </form>

             <form action="" method="POST" class="sign-up-form">
                <h2 class="title">Sign up</h2>
                <div class="input-field">
                    <i class="fas fa-user"></i>
                    <input type="text" name="firstName"placeholder="First Name" />
                </div>
                <div class="input-field">
                    <i class="fas fa-user"></i>
                    <input type="text" name="lastName" placeholder="Last Name" />
                </div>
                <div class="input-field">
                    <i class="fas fa-phone"></i>
                    <input type="number" name="mobile" min="0" maxlength="10" placeholder="Mobile" />
                </div>
                <div class="input-field">
                    <i class="fas fa-envelope"></i>
                    <input type="email" name="email" placeholder="Email" />
                </div>
                <div class="input-field">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="password" placeholder="Password" />
                </div>
                <div class="input-field">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="confirm_password" placeholder="Confirm Password" />
                </div>
                <input type="submit" class="btn" name="signup" value="Sign up">
             </form>
        </div>
    </div>

      <div class="panels-container">
        <div class="panel left-panel">
          <div class="content">
            <h3>New here ?</h3>
            <p>
                if you don't have an account yet, join us and start your vacation here at Tungawan.
            </p>
            <button class="btn transparent" id="sign-up-btn">
              Sign up
            </button>
          </div>
          <img src="img/log.svg" class="image" alt="" />
        </div>
        <div class="panel right-panel">
          <div class="content">
            <h3>One of us ?</h3>
            <p>
                if you have an account, login here and have some fun
            </p>
            <button class="btn transparent" id="sign-in-btn">
              Sign in
            </button>
          </div>
          <img src="img/register.svg" class="image" alt="" />
        </div>
      </div>
    </div>
    <!-- JavaScript -->
    <script src="js/registration.js"></script>
    <script>
        document.querySelectorAll('input[type="number"]').forEach(input =>{
            input.oninput = () =>{
                if(input.value.length > input.maxLength) input.value = input.value.slice(0, input.maxLength);
            }
        });
    </script>
</body>
</html>