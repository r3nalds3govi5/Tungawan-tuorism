<?php
    session_start();
    require 'db.php';

    $msg="";
    if (isset($_GET['verification'])) {
        if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM tourist WHERE code='{$_GET['verification']}'")) > 0) {
            $query = mysqli_query($conn, "UPDATE tourist SET code='' WHERE code='{$_GET['verification']}'");
            
            if ($query) {
                $msg= "Account verification has been successfully completed";
                header("Location: registrationForm.php?$msg");
            }
        } else {
            header("Location: registrationForm.php?$msg");
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
                $msg = "First verify your email account and try again.";
                header("location: registrationForm.php?$msg");
            }
        } else {
            $msg= "Email or password not matched.";
            header("location: registrationForm.php?$msg");
        }
    }
?>