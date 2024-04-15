<?php
    require('db.php');
    require('auth.php');

    if (isset($_SESSION['flash_message'])) {
        $flashMessage = $_SESSION['flash_message'];
        unset($_SESSION['flash_message']); // Clear the message to avoid displaying it again
      } else {
          $flashMessage = null;
    }

	if (isset($_POST['submitProfile']) || isset($_POST['profile_image'])) {
        $code=$_POST['codex'];
        $fname=$_POST['firstName'];
        $mname=$_POST['middleName'];
        $lname=$_POST['lastName'];
        $mobile=$_POST['mobile'];
        $email=$_POST['email'];
        $sex=$_POST['sex'];
        $bdate=$_POST['birthdate'];
        
        $eighteen_years_ago = date("Y-m-d", strtotime("-18 years"));
        
        $file = rand(1000,100000)."-".$_FILES['profile_image']['name'];
        $file_loc = $_FILES['profile_image']['tmp_name'];
        $file_size = $_FILES['profile_image']['size'];
        $file_type = $_FILES['profile_image']['type'];
        $folder="admin/uploads/";
    
        $new_size = $file_size/1024;
        $new_file_name = strtolower($file); 
        $final_file=str_replace(' ','-',$new_file_name);
        move_uploaded_file($file_loc,$folder.$final_file);
        
        if (strlen($mobile) >= 10) {
            if ($bdate <= $eighteen_years_ago) {
                if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM tourist WHERE tourist_id='$code'")) > 0) {
                    $sql = "UPDATE tourist SET firstName='$fname', lastName='$lname', middleName='$mname', mobile='$mobile', email='$email', sex='$sex', birthday='$bdate', image='$final_file' WHERE tourist_id='$code'";
                    $result = mysqli_query($conn, $sql);
                        if($result){
                            $_SESSION['flash_message'] = 'Profile successfully updated.';
                            header("Location: profile.php");
                        }else{
                            die('Query failed');
                        }
                }else{
                    $_SESSION['flash_message'] = 'Update failed.';
                    header("Location: profile.php");
                }
            } else {
                $_SESSION['flash_message'] = 'You must be at least 18 years old to register.';
                header("Location: profile.php");
            }
        } else {
            $_SESSION['flash_message'] = 'Invalid mobile number.';
            header("Location: profile.php");
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
                            <!--<img src="https://bootdey.com/img/Content/avatar/avatar1.png" alt="Profile Image">-->
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
                        <a class="list-group-item active" href="#">
                            <i class="fe-icon-user text-muted"></i>Profile Settings
                        </a>
                        <a class="list-group-item" href="profile_address.php">
                            <i class="fe-icon-map-pin text-muted"></i>Addresses
                        </a>
                        <a class="list-group-item" href="profile_password.php">
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
                <form class="profile" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
                <input type="hidden" name="codex" value="<?= $data1['tourist_id']; ?>">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control" name="firstName" id="firstName" value="<?= $data1['firstName']; ?>">
                                <label for="firstName">Your Name</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control" name="middleName" id="middleName" value="<?= $data1['middleName']; ?>">
                                <label for="middleName">Your Middle Name</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control" name="lastName" id="lastName" value="<?= $data1['lastName']; ?>">
                                <label for="lastName">Your Name</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="email" name="email" class="form-control" id="email" value="<?= $data1['email']; ?>">
                                <label for="email">Your Email</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="number" name="mobile" class="form-control" min="0" maxlength="10" minlength="10" id="mobile" value="<?= $data1['mobile']; ?>">
                                <label for="lastName">Your Mobile</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <select name="sex" class="form-select" id="sex">
                                    <option value="<?= $data1['sex']; ?>"><?= $data1['sex']; ?></option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                                <label for="sex">Gender</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="date" name="birthdate" class="form-control" id="birthdate" value="<?= $data1['birthday']; ?>">
                                <label for="birthdate">Your Birth Day</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="file" name="profile_image" class="" id="image" />
                                <!-- <label for="lastName">Profile Picture</label> -->
                            </div>
                        </div>
                        <div class="col-12">
                            <button class="btn btn-primary py-3" name="submitProfile" type="submit">Update Profile</button>
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
    <script>
        document.querySelectorAll('input[type="number"]').forEach(input =>{
            input.oninput = () =>{
                if(input.value.length > input.maxLength) input.value = input.value.slice(0, input.maxLength);
            }
        });
    </script>
</body>

</html>