<?php
    require('db.php');
    require('auth.php');

    if (isset($_SESSION['flash_message'])) {
        $flashMessage = $_SESSION['flash_message'];
        unset($_SESSION['flash_message']); // Clear the message to avoid displaying it again
      } else {
          $flashMessage = null;
    }

	if (isset($_POST['submitPassword'])) {
        $code=$_POST['codex'];
        $op = md5($_POST['current_password']);
        $np = md5($_POST['new_password']);
        $c_np = md5($_POST['confirm_password']);
        
        if( empty($op)){
            // echo "Old Password is required.";
            $msgpassword='<div class="alert alert-warning alert-dismissible fade show" role="alert">Old Password is required.</div>';
            $_SESSION['flash_message'] = 'Old Password is required.';
            header("Location: profile_password.php");
            exit();
      
          }else if( empty($np)){
            // echo "New Password is required.";
            $_SESSION['flash_message'] = 'New Password is required.';
            header("Location: profile_password.php");
            exit();
      
          }else if($np !== $c_np){
            // echo "The confirmation password  does not match.";
            $_SESSION['flash_message'] = 'The confirmation password  does not match.';
            header("Location: profile_password.php");
            exit();
    
        }else {
	
            $sql = $conn->query("SELECT * FROM tourist WHERE password='$op' AND tourist_id='$code'");
            $result = $sql->fetch_array();
            if($result > 0){
                
                $sql_2 = "UPDATE tourist SET password='$np' WHERE tourist_id='$code'";
                $conn->query($sql_2);
                // echo "Your password has been changed successfully.";
                $msgpassword='<div class="alert alert-success alert-dismissible fade show" role="alert">Your password has been changed successfully.</div>';
                $_SESSION['flash_message'] = 'Your password has been changed successfully.';
                header("Location: profile_password.php");
    
            }else {
            //   echo "Incorrect password.";
              $_SESSION['flash_message'] = 'Incorrect password.';
              header("Location: profile_password.php");
            }
    
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

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Nunito:wght@600;700;800&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
    <link href="css/profile.css" rel="stylesheet">
    <link rel="shortcut icon" href="admin/dist/img/logo.png">

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="js/script.js"></script>

</head>

<body>
    <!-- Spinner Start -->
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <!-- Spinner End -->

    <!-- Topbar Start -->
    <?php include 'topbar.php' ?>
    <!-- Topbar End -->

    <!-- Navbar & Hero Start -->
    <div class="container-fluid position-relative p-0">
        <?php 
            if($statushere=='positive'){ 
                $myid=	$_SESSION['loginid'];
                $qryget=mysqli_query($conn,"SELECT * FROM tourist WHERE id='$myid'");
                $data1=mysqli_fetch_array($qryget);
                $date =date('F d, Y', strtotime($data1['date_entry']));
                    
                require('positive.php'); }else{ require('negative.php'); }
        ?>
        <div class="container-fluid bg-primary py-5 mb-4 hero-header">
            <!-- <div class="container py-5">
                <div class="row justify-content-center py-5">
                    <div class="col-lg-10 pt-lg-5 mt-lg-5 text-center">
                        <h1 class="display-3 text-white animated slideInDown">PROFILE</h1>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb justify-content-center">
                                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                <li class="breadcrumb-item text-white active" aria-current="page">Profile</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div> -->
        </div>
    </div>
    <!-- Navbar & Hero End -->

    <!-- Latest News & Update Start -->
    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-4 pb-5">
                <!-- Account Sidebar-->
                <div class="author-card pb-3">
                    <!-- <div class="author-card-cover" style="background: #3CAEA3;"></div> -->
                    <div class="author-card-profile">
                        <div class="author-card-avatar">
                            <!--<img src="https://bootdey.com/img/Content/avatar/avatar1.png" alt="Daniel Adams">-->
                        <?php
                            if($data1['image'] == ''){ 
                                echo '<img src="https://bootdey.com/img/Content/avatar/avatar1.png" alt="Profile Image">';
                            }else{ 
                                echo '<img src="admin/uploads/'.$data1['image'].'" alt="Profile Image">';
                        } ?>
                        </div>
                        <div class="author-card-details">
                            <h5 class="author-card-name text-lg" style="text-transform: capitalize"><?= $data1['firstName'].' '.$data1['lastName']; ?></h5><span class="author-card-position">Joined on <?= $date; ?></span>
                        </div>
                    </div>
                </div>
                <div class="wizard">
                    <nav class="list-group list-group-flush">
                        <a class="list-group-item" href="profile.php">
                            <i class="fe-icon-user text-muted"></i>Profile Settings</a>
                            <a class="list-group-item" href="profile_address.php"><i class="fe-icon-map-pin text-muted"></i>Addresses</a>
                        <a class="list-group-item active" href="#">
                            <div class="d-flex justify-content-between align-items-center">
                                <div><i class="fe-icon-heart mr-1 text-muted"></i>
                                    <div class="d-inline-block font-weight-medium text-uppercase">Change Password</div>
                                </div>
                            </div>
                        </a>
                    </nav>
                </div>
            </div>
            <!-- Profile Settings-->
            <div class="col-lg-8 col-md-12">
                <?php if ($flashMessage): ?>
                    <div id="flash-message" class="alert alert-success alert-dismissible fade show" role="alert">
                        <?php echo $flashMessage; ?>
                        </div>
                <?php endif; ?>
                <form class="profile" action="" method="POST">
                <input type="hidden" name="codex" value="<?= $data1['tourist_id']; ?>">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="password" name="current_password" class="form-control" id="current_password" />
                                <label for="current_password">Current Password </label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="password" name="new_password" class="form-control" id="new_password" />
                                <label for="new_password">New Password</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="password" name="confirm_password" class="form-control" id="confirm_password" />
                                <label for="confirm_password">Confirm Password</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <button class="btn btn-primary py-3" type="submit" name="submitPassword">Update Password</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Latest News & Update End -->

    <!-- Footer Start -->
    <?php include 'footer.php' ?>
    <!-- Footer End -->

    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>