<?php
    require('db.php');
    require('auth.php');

    if (isset($_SESSION['flash_message'])) {
        $flashMessage = $_SESSION['flash_message'];
        unset($_SESSION['flash_message']); // Clear the message to avoid displaying it again
      } else {
          $flashMessage = null;
    }

	if (isset($_POST['submitAddress'])) {
        $code=$_POST['codex'];
        $region=$_POST['region'];
        $province=$_POST['province'];
        $municipality=$_POST['municipality'];
        $barangay=$_POST['barangay'];
        $sitio=$_POST['sitio'];
        
        if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM tourist_address WHERE tourist_id='$code'")) > 0) {
            $sql = "UPDATE tourist_address SET region_id='$region', province_id='$province', municipal_id='$municipality', barangay_id='$barangay', sitio='$sitio' WHERE tourist_id='$code'";
            $result = mysqli_query($conn, $sql);
            $_SESSION['flash_message'] = 'Address successfully updated.';
            header("Location: profile_address.php");
        }else{
            $sql = "INSERT INTO tourist_address(tourist_id, region_id, province_id, municipal_id, barangay_id, sitio) 
            VALUES ('$code', '$region', '$province', '$municipality', '$barangay', '$sitio')";
            $result = mysqli_query($conn, $sql);
                if($result){
                    $_SESSION['flash_message'] = 'Address successfully addred.';
                    header("Location: profile_address.php");
                }else{
                    die('Query failed');
                }
        }
    }else{
        
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

                $qrygetAdd=mysqli_query($conn,"SELECT * FROM tourist_address WHERE tourist_id='$data1[tourist_id]'");
                $qrygetAdd_run=mysqli_fetch_array($qrygetAdd);
                    
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
                            <a class="list-group-item active" href="#"><i class="fe-icon-map-pin text-muted"></i>Addresses</a>
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
                <form class="profile" action="" method="POST">
                    <input type="hidden" name="codex" value="<?= $data1['tourist_id']; ?>">
                    <div class="row g-3">
                        
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" name="region" class="form-control" id="region" value="<?= $qrygetAdd_run['region_id']; ?>" required />
                                <label for="lastName">Region</label>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                             <div class="form-floating">
                                <input type="text" name="province" class="form-control" id="province" value="<?= $qrygetAdd_run['province_id']; ?>" required />
                                <label for="lastName">Province</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" name="municipality" class="form-control" id="municipality" value="<?= $qrygetAdd_run['municipal_id']; ?>" required />
                                <label for="lastName">Municipality</label>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" name="barangay" class="form-control" id="barangay" value="<?= $qrygetAdd_run['barangay_id']; ?>" required />
                                <label for="lastName">Barangay</label>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" name="sitio" class="form-control" id="sitio" value="<?= $qrygetAdd_run['sitio']; ?>" required />
                                <label for="lastName">Sitio</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <button class="btn btn-primary py-3" name="submitAddress" type="submit">Update Address</button>
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
    <script type="text/javascript">
    function getProvince(val) {
        $.ajax({
        url: "getProvince.php",
        type: "POST",
        data: 'region_id='+val,
        success: function(data){
        $("#province-list").html(data);
            }
        });
    };
    
    function getMunicipality(val) {
        $.ajax({
        url: "getMunicipality.php",
        type: "POST",
        data: 'province_id='+val,
        success: function(data){
        $("#municipality-list").html(data);
            }
        });
    };

    function getBarangay(val) {
        $.ajax({
        url: "getBarangay.php",
        type: "POST",
        data: 'municipality_id='+val,
        success: function(data){
        $("#barangay-list").html(data);
            }
        });
    };
</script>

</body>

</html>