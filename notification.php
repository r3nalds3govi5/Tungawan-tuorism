<?php
    require('db.php');
    require('auth.php');

    if (isset($_SESSION['flash_message'])) {
        $flashMessage = $_SESSION['flash_message'];
        unset($_SESSION['flash_message']); // Clear the message to avoid displaying it again
      } else {
          $flashMessage = null;
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

                $qryget1="UPDATE notif SET seen_status='1' WHERE tourist_id='$data1[tourist_id]' AND seen_status='0'";
                $data2=mysqli_query($conn, $qryget1);

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
                            <!--<img src="https://bootdey.com/img/Content/avatar/avatar1.png" alt="Profile Image">-->
                        <?php
                            if($data1['image'] == ''){ 
                                echo '<img src="https://bootdey.com/img/Content/avatar/avatar1.png" alt="Profile Image">';
                            }else{ 
                                echo '<img src="admin/uploads/'.$data1['image'].'" alt="Profile Image">';
                        } ?>
                        </div>
                        <div class="author-card-details">
                            <h5 class="author-card-name text-lg"><?= $data1['firstName'].' '.$data1['lastName']; ?></h5><span class="author-card-position">Joined on <?= $date; ?></span>
                        </div>
                    </div>
                </div>
                <div class="wizard">
                    <nav class="list-group list-group-flush">
                        <a class="list-group-item active" href="#">
                            <i class="fe-icon-user text-muted"></i>Notification
                        </a>
                        <!-- <a class="list-group-item" href="profile_address.php">
                            <i class="fe-icon-map-pin text-muted"></i>Approved Booking
                        </a>
                        <a class="list-group-item" href="profile_address.php">
                            <i class="fe-icon-map-pin text-muted"></i>Completed Booking
                        </a> -->
                        <!-- <a class="list-group-item" href="profile_password.php">
                            <div class="d-flex justify-content-between align-items-center">
                                <div><i class="fe-icon-heart mr-1 text-muted"></i>
                                    <div class="d-inline-block font-weight-medium text-uppercase">Change Password</div>
                                </div>
                            </div>
                        </a> -->
                    </nav>
                </div>
            </div>
            <!-- Profile Settings-->
            <div class="col-lg-8 pb-5">
                <!-- Item-->
                <?php
                    $qrygetNotif=mysqli_query($conn,"SELECT * FROM notif WHERE tourist_id='$data1[tourist_id]'");
                    while($qrygetNotif_run=mysqli_fetch_array($qrygetNotif)){
                    $date =date('F d, Y', strtotime($qrygetNotif_run['date']));
                    // $date1 =date('F d, Y', strtotime($qrygetBooking_run['date_entry']));

                    $qrygetBooking=mysqli_query($conn,"SELECT * FROM booking WHERE booking_id='$qrygetNotif_run[item]'");
                    $qrygetBooking_run=mysqli_fetch_array($qrygetBooking);

                    $qrygetDestination=mysqli_query($conn,"SELECT * FROM destination WHERE destination_id='$qrygetBooking_run[destination]'");
                    $qrygetDestination_run=mysqli_fetch_array($qrygetDestination);
                      
                ?>
                    <div class="cart-item d-md-flex justify-content-between">
                        <div class="px-3 my-3">
                            <!-- <a class="cart-item-product" href="#"> -->
                                <div class="cart-item-product-thumb">
                                    <img src="admin/uploads/<?= $qrygetDestination_run['image']; ?>" alt="Product" style="height: 90px">
                                </div>
                                <div class="cart-item-product-info">
                                    <h4 class="cart-item-product-title"><?= $qrygetNotif_run['caption']; ?></h4>
                                    <div class="text-lg text-body font-weight-medium" style="font-size: 13px;">Destination: <?= $qrygetDestination_run['destination']; ?></div>
                                    <div class="text-lg text-body font-weight-medium" style="font-size: 13px;">Description: <?= $qrygetNotif_run['description']; ?></div>
                                    <span>Date: <span class="text-success font-weight-medium">
                                    <?= $date; ?>
                                    </span></span>
                                </div>
                            <!-- </a> -->
                        </div>
                    </div>
                <?php } ?>
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