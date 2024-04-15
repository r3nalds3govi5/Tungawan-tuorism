<?php
    require('db.php');
    require('auth.php');

    $code = $_GET['on'];
    $sql = mysqli_query($conn, "SELECT * FROM tour_package WHERE status = 1 AND id ='$code'");
    $sqlLoad = mysqli_fetch_assoc($sql);
    $desc = $sqlLoad['pdf_file'];
    
    $disid = $sqlLoad['destination'];
    $sql_destination = mysqli_query($conn, "SELECT * FROM destination WHERE destination_id = '$disid' AND status = 1");
    $sql_destination_run = mysqli_fetch_assoc($sql_destination);
    $pdfPath = "../admin/uploads/$desc";
    
    $sql1 = mysqli_query($conn, "SELECT * FROM inclusion WHERE package_id='$sqlLoad[package_id]' AND status='1'");
    $sql1_run=mysqli_num_rows($sql);
    
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
                    
                require('positive.php'); }else{ require('negative.php'); }
        ?>

        <div class="container-fluid bg-primary py-5 mb-5 hero-header" style="background: linear-gradient(rgba(20, 20, 31, .3), rgba(20, 20, 31, .3)), 
         url(admin/uploads/<?php echo $sql_destination_run['image']; ?>); height: 70vh !important; background-repeat: no-repeat; background-size: cover;">
            <div class="container py-5">
                <div class="row justify-content-center py-5">
                    <div class="col-lg-10 pt-lg-5 mt-lg-5 text-center">
                        <h1 class="display-3 text-white animated slideInDown"><?php echo $sql_destination_run['destination']; ?></h1>
                        <!--<p class="text-white"><?php echo $sqlLoad['description']; ?></p>-->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Navbar & Hero End -->

    <!-- About Start -->
    <div class="container-xxl py-5 destination" >
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s" style="height: 60vh !important;">
                    <div class="position-relative h-100">
                        <img class="img-fluid position-absolute w-100 h-100" src="admin/uploads/<?php echo $sqlLoad['image']; ?>" alt="" >
                    </div>
                </div>
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.3s">
                    <h1><span class="text-primary"><?php echo $sqlLoad['package']; ?></span></h1>
                    <p class="mb-1" style="text-align:justify">&nbsp;&nbsp;&nbsp;&nbsp;
                        <?= $sqlLoad['description']; ?>
                    </p>
                    <a href="package.php" class="btn btn-primary py-2 px-4 mt-2">Find More</a>
                    <a href="booking.php?on=<?php echo $sqlLoad['id']; ?>" class="btn btn-primary py-2 px-4 mt-2">Book Now</a>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->
    
    <!-- Description -->
    <!--<div class="container-xxl py-5 destination" >-->
    <!--    <div class="container">-->
    <!--        <div class="row g-5">-->
    <!--            <div class="col-lg-12 wow fadeInUp" data-wow-delay="0.3s">-->
    <!--                <h4 class="bg-white text-primary pe-3">Description</h4>-->
    <!--                <p class="mb-1" style="text-align:justify">&nbsp;&nbsp;&nbsp;&nbsp;-->
    <!--                    <?= $sqlLoad['description']; ?>-->
    <!--                </p>-->
    <!--            </div>-->
    <!--        </div>-->
    <!--    </div>-->
    <!--</div>-->
    
    <!-- Itinerary -->
    <?php
        if($sqlLoad['itinerary'] !=''){ ?>
            <div class="container-xxl py-5 destination" >
                <div class="container">
                    <div class="row g-5">
                        <div class="col-lg-12 wow fadeInUp" data-wow-delay="0.3s">
                            <h4 class="bg-white text-primary pe-3">Itinerary</h4>
                            <p class="mb-1" style="text-align:justify">&nbsp;&nbsp;&nbsp;&nbsp;
                                <?= $sqlLoad['itinerary']; ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
    <?php } ?>
    
    <!-- Includes -->
    <?php
        if($sql1_run > 0){ ?>
            <div class="container-xxl py-5 destination" >
                <div class="container">
                    <div class="row g-5">
                        <div class="col-lg-12 wow fadeInUp" data-wow-delay="0.3s">
                            <h4 class="bg-white text-primary pe-3">Includes</h4>
                            <ul>
                                <?php
                                    $sql = mysqli_query($conn, "SELECT * FROM inclusion WHERE package_id='$sqlLoad[package_id]' AND status='1'");
                                    while($sql_run=mysqli_fetch_array($sql)){ ?>
                                        <li class="mb-3" style="font-size: 18px; decoration: none !important;"><?= $sql_run['inclusion']; ?></li>
                                <?php  } ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
    <?php } ?>
    
    <!-- Location -->
    <div class="container-xxl py-5 destination" >
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-12 wow fadeInUp" data-wow-delay="0.3s">
                    <h4 class="bg-white text-primary pe-3">Location</h4>
                    <div class="position-relative h-100">
                        <iframe src="<?= $sql_destination_run['pen_location']; ?>" 
                                width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <!-- Package Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h4 class="bg-white text-center text-primary px-3 mb-5">You might also like...</h4>
            </div>
            <div class="row g-4 justify-content-center">
                <?php
                    $sql = mysqli_query($conn, "SELECT * FROM tour_package WHERE status = 1 AND id != $code");
                    while($sqlLoad = mysqli_fetch_assoc($sql)){
                    
                    $disid = $sqlLoad['destination'];
                    $sql_destination = mysqli_query($conn, "SELECT * FROM destination WHERE destination_id = '$disid' AND status = 1");
                    $sql_destination_run = mysqli_fetch_assoc($sql_destination);
                ?>
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="package-item">
                            <div class="overflow-hidden">
                                <img class="img-fluid" src="admin/uploads/<?= $sqlLoad['image']; ?>" alt="Package Image">
                            </div>
                            <div class="d-flex border-bottom">
                                <small class="flex-fill text-center border-end py-2"><i class="fa fa-map-marker-alt text-primary me-2"></i><?= $sql_destination_run['destination']; ?></small>
                                <small class="flex-fill text-center border-end py-2"><i class="fa fa-calendar-alt text-primary me-2"></i><?= $sqlLoad['package']; ?></small>
                                <small class="flex-fill text-center py-2"><i class="fa fa-user text-primary me-2"></i><?= $sqlLoad['number_person']; ?> Person</small>
                            </div>
                            <div class="text-center p-4">
                                <h3 class="mb-0">&#8369;<?= number_format($sqlLoad['price'],2); ?></h3>
                                <p><?= $sql_destination_run['destination']; ?></p>
                                <div class="d-flex justify-content-center mb-2">
                                    <a href="read_more.php?on=<?php echo $sqlLoad['id']; ?>" class="btn btn-sm btn-primary px-3 border-end" style="border-radius: 30px 0 0 30px;">Read More</a>
                                    <a href="booking.php?on=<?php echo $sqlLoad['id']; ?>" class="btn btn-sm btn-primary px-3" style="border-radius: 0 30px 30px 0;">Book Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <!-- Package End -->
    
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