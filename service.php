<?php
    require('db.php');
    require('auth.php');
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

        <div class="container-fluid bg-primary py-5 mb-5 hero-header-services">
            <div class="container py-5">
                <div class="row justify-content-center py-5">
                    <div class="col-lg-10 pt-lg-5 mt-lg-5 text-center">
                        <h1 class="display-3 text-white animated slideInDown">Services</h1>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb justify-content-center">
                                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                <li class="breadcrumb-item text-white active" aria-current="page">Services</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Navbar & Hero End -->


    <!-- Service Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="section-title bg-white text-center text-primary px-3">Services</h6>
                <h1 class="mb-5">Our Services</h1>
            </div>
            <div class="row g-4">
                <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="service-item rounded pt-3">
                        <div class="p-4">
                            <i class="fa fa-3x fa-globe text-primary mb-4"></i>
                            <h5>Best Destination</h5>
                            <p>We provide enticing destinations for leisure and adventure ensuring you to return for delightful experiences.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="service-item rounded pt-3">
                        <div class="p-4">
                            <i class="fa fa-3x fa-hotel text-primary mb-4"></i>
                            <h5>Accommodation</h5>
                            <p>Our lodgings suit budget-conscious travelers, offering affordability without compromising on satisfying accommodation standards</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="service-item rounded pt-3">
                        <div class="p-4">
                            <i class="fa fa-3x fa-calendar text-primary mb-4"></i>
                            <h5>Tour Packages</h5>
                            <p>We provide affordable Tungawan tour packages for optimal enjoyment of its finest attractions with budget-friendly options available.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.7s">
                    <div class="service-item rounded pt-3">
                        <div class="p-4">
                            <i class="fa fa-3x fa-coffee text-primary mb-4"></i>
                            <h5>Foods & Hospitality</h5>
                            <p>Our culinary offerings, including our restaurants and other dining establishments, are truly unique and will leave you exclaiming. </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Service End -->


    <!-- Testimonial Start -->
    <div class="container-xxl py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container">
            <div class="text-center">
                <h6 class="section-title bg-white text-center text-primary px-3">Reviews</h6>
                <h1 class="mb-5">Our Visitors Say!!!</h1>
            </div>
            <div class="owl-carousel testimonial-carousel position-relative">
                <?php
                    $sql = $conn->query("SELECT * FROM destination_ratings ORDER BY  id DESC LIMIT 10");
                    while($sqlLoad = $sql->fetch_array()){

                    $myDes = $sqlLoad['destination_id'];
                    $sqlLoadDes = $conn->query("SELECT * FROM destination WHERE destination_id = '$myDes'");
                    $sqlLoadDes_run = $sqlLoadDes->fetch_array();

                    $myTour = $sqlLoad['tourist_id'];
                    $sqlLoadTour = $conn->query("SELECT * FROM tourist WHERE tourist_id = '$myTour'");
                    $sqlLoadTour_run = $sqlLoadTour->fetch_array();

                    $disid = $sqlLoad['destination_id'];
                    $sql1 = $conn->query("SELECT id FROM destination_ratings WHERE destination_id='$disid' GROUP BY id");
                    $numR = $sql1->num_rows;

                    $sqlrating = $conn->query("SELECT *, SUM(ratings) AS total FROM destination_ratings WHERE destination_id='$disid'");
                    $rData = $sqlrating->fetch_array();
                    $total = $rData['total'];
                    
                    if($numR != 0){
                        $avg = $total / $numR;
                        $sql1 = $conn->query("SELECT id FROM destination_ratings GROUP BY id DESC");
                        $numR = $sql1->num_rows;

                ?>
                    <div class="testimonial-item bg-white text-center border p-4">
                        <?php
                            if($sqlLoadTour_run['image']==''){
                                    echo '<img class="bg-white rounded-circle shadow p-1 mx-auto mb-3" src="admin/uploads/default.png" style="width: 80px; height: 80px;">';
                                }else{
                                    echo '<img class="bg-white rounded-circle shadow p-1 mx-auto mb-3" src="admin/uploads/'.$sqlLoadTour_run['image'].'" style="width: 80px; height: 80px;">';
                            }
                        ?>
                        <h6 class="mb-0"><?= $sqlLoadTour_run['firstName'].' ' .$sqlLoadTour_run['lastName']; ?></h6>
                        <p style="font-size: 12px;">
                            <?php 
                                $start=1;
                                while ($start <= 5) {
                                    if (round($avg) < $start){ ?>
                                    <small class="bi bi-star text-primary"></small>
                            <?php
                                }else{ ?>
                                    <small class="bi bi-star-fill text-primary"></small>
                            <?php
                                }
                                    $start++;
                                }
                            ?>                
                        </p>
                        <p class="mb-0" style="font-size: 13px;"><i>"<?=  $sqlLoad['review']; ?>"</i></p>
                    </div>
                <?php } } ?>                                        
            </div>
        </div>
    </div>
    <!-- Testimonial End -->
        

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