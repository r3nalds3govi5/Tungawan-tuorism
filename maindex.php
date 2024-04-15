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
    <!-- <link href="img/favicon.ico" rel="icon"> -->

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
                $myid =	$_SESSION['loginid'];
                $qryget = mysqli_query($conn,"SELECT * FROM tourist WHERE id='$myid'");
                $data1 = mysqli_fetch_array($qryget);
                
                require('positive.php'); }else{ require('negative.php'); }
        ?>

        <div class="container-fluid bg-primary py-5 mb-3 hero-header">
            <div class="container py-5">
                <div class="row justify-content-center py-5">
                    <div class="col-lg-10 pt-lg-5 mt-lg-5 text-center">
                        <h1 class="display-3 text-white mb-3 animated slideInDown">Welcome to Tungawan</h1>
                        <h3 class="fs-2 mb-3 animated slideInDown">The place that time forgot.</h3>
                        <p class="fs-5 text-white mb-4 animated slideInDown">
                            Tungawan, a municipality located in the province of Zamboanga Sibugay 
                            in the Philippines, is known for its natural beauty and rich cultural heritage. 
                            The town boasts of lush forests, pristine beaches, and stunning waterfalls 
                            that are sure to captivate any visitor's heart.
                        </p>
                        <div class="position-relative w-75 mx-auto animated slideInDown">
                        <form action="searchDestinationResult.php" method="GET">
                            <input class="form-control border-0 rounded-pill w-100 py-3 ps-4 pe-5" type="text" name="destination" placeholder="Eg: Gapas Gapas" required>
                            <button type="submit" name="submit" class="btn btn-primary rounded-pill py-2 px-4 position-absolute top-0 end-0 me-2" style="margin-top: 7px;">Search</button>
                            </form>  
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Navbar End -->
        
        <!-- Testimonial Start -->
        <div class="container-xxl mb-4 wow fadeInUp" data-wow-delay="0.1s">
            <div class="container"></div>
                <div class="owl-carousel testimonial-carousel position-relative">
                    <?php
                        $sql = $conn->query("SELECT * FROM destination WHERE status = 1 ORDER BY id DESC LIMIT 10");
                        while($sqlLoad = $sql->fetch_assoc()){
                    
                        echo '<div class="testimonial-item bg-white text-center border">
                            <img class="bg-white rounded-circle shadow p-1 mx-auto mb-1" src="admin/uploads/'.$sqlLoad['image'].'" style="width: 90px; height: 90px;">
                            <h5 class="mb-0">'.$sqlLoad['destination'].'</h5>
                            <p>'.$sqlLoad['location'].'</p>
                        </div>';
                        } 
                    ?>
                </div>
                <hr>
            </div>
        </div>
    <!-- Testimonial End -->
    </div>
    <!-- Navbar & Hero End -->

    <!-- About Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s" style="min-height: 400px;">
                    <div class="position-relative h-100">
                        <img class="img-fluid position-absolute w-100 h-100" src="img/about.jpg" alt="" >
                    </div>
                </div>
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.3s">
                    <h6 class="section-title bg-white text-start text-primary pe-3">About</h6>
                    <h1 class="mb-4"><span class="text-primary">Tungawan</span></h1>
                    <p class="mb-4" style="text-align:justify">&nbsp; &nbsp; &nbsp;
                        The town of Tungawan has a population of approximately 27,000 people as of the 2020 census. 
                        The majority of the population are Christians, with Roman Catholicism being the predominant religion. 
                        The economy of Tungawan is primarily driven by agriculture, with rice, corn, and coconuts being the main crops. 
                        Fishing is also an important industry, with the town's coastal location providing a valuable source of seafood.
                    </p>
                    <!-- <p class="mb-4" style="text-align:justify">&nbsp; &nbsp; &nbsp;
                        Tungawan is known for its beautiful beaches, such as the Linguisan Beach and Bangaan Island, 
                        which are popular destinations for locals and tourists alike. The town also has a number of 
                        natural attractions, including waterfalls and caves, that can be explored by visitors.
                        In terms of governance, Tungawan is divided into 25 barangays or villages, 
                        each with its own elected officials. The town is also represented 
                        in the provincial government of Zamboanga Sibugay by its elected officials, 
                        including a mayor, vice-mayor, and councilors.
                    </p> -->
                    <a class="btn btn-primary py-3 px-5 mt-2" href="">Read More</a>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->

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
                            <p>Diam elitr kasd sed at elitr sed ipsum justo dolor sed clita amet diam</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="service-item rounded pt-3">
                        <div class="p-4">
                            <i class="fa fa-3x fa-hotel text-primary mb-4"></i>
                            <h5>Accommodation</h5>
                            <p>Diam elitr kasd sed at elitr sed ipsum justo dolor sed clita amet diam</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="service-item rounded pt-3">
                        <div class="p-4">
                            <i class="fa fa-3x fa-calendar text-primary mb-4"></i>
                            <h5>Tour Packages</h5>
                            <p>Diam elitr kasd sed at elitr sed ipsum justo dolor sed clita amet diam</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.7s">
                    <div class="service-item rounded pt-3">
                        <div class="p-4">
                            <i class="fa fa-3x fa-coffee text-primary mb-4"></i>
                            <h5>Foods & Hospitality</h5>
                            <p>Diam elitr kasd sed at elitr sed ipsum justo dolor sed clita amet diam</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Service End -->

    <!-- Destination Start -->
    <div class="container-xxl py-5 destination">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="section-title bg-white text-center text-primary px-3">Destination</h6>
                <h1 class="mb-5">Our Popular Tourist Spot</h1>
            </div>
            <div class="row g-3">
                <?php
                    
                    $sql = mysqli_query($conn, "SELECT *, SUM(ratings) AS total FROM destination_ratings GROUP BY destination_id ORDER BY total DESC LIMIT 6");
                    while($sqlLoads = mysqli_fetch_assoc($sql)){
                                       
                    $disids = $sqlLoads['destination_id'];
                    $sql_destination = mysqli_query($conn, "SELECT * FROM destination WHERE destination_ID = '$disids' AND status = 1 AND category != 4 & 5");
                    $sql_destination_run = mysqli_fetch_assoc($sql_destination);    
                    
                    $disid = $sql_destination_run['destination_id'];
                    
                ?>
                    <div class="col-lg-4 col-md-12 wow zoomIn" data-wow-delay="0.1s">
                        <a class="position-relative d-block overflow-hidden" href="destination_details.php?on=<?php echo $sql_destination_run['destination_id']; ?>">
                            <img class="img-fluid" src="admin/uploads/<?= $sql_destination_run['image']; ?>" alt="">

                            <?php
                                    
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
                            <div class="bg-white text-danger fw-bold position-absolute top-0 start-0 m-3 py-1 px-2"><?= round($avg,2); ?>/5
                                <?php 
                                    $start=1;
                                    while ($start <= 5) {
                                        if (round($avg,2) < $start){ ?>
                                        <small class="bi bi-star text-primary"></small>
                                <?php
                                    }else{ ?>
                                        <small class="bi bi-star-fill text-primary"></small>
                                <?php
                                    }
                                        $start++;
                                    }
                                ?>                
                            </div>
                            <?php } ?>
                            <div class="bg-white text-primary fw-bold position-absolute bottom-0 end-0 m-3 py-1 px-2">
                                <i class="fa fa-map-marker-alt me-1"></i><?= $sql_destination_run['destination']; ?>
                            </div>
                        </a>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <!-- Destination Start -->


    <!-- Package Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="section-title bg-white text-center text-primary px-3">Packages</h6>
                <h1 class="mb-5">Awesome Packages</h1>
            </div>
            <div class="row g-4 justify-content-center">
                <?php

                    $sql = mysqli_query($conn, "SELECT * FROM tour_package WHERE status = 1");
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
                                <small class="flex-fill text-center py-2"><i class="fa fa-user text-primary me-2"></i><?= $sqlLoad['number_person']; ?> Person/s</small>
                            </div>
                            <div class="text-center p-4">
                                <h3 class="mb-0">&#8369;<?= number_format($sqlLoad['price'],2); ?></h3>
                                <p><?= $sqlLoad['description']; ?></p>
                                <div class="d-flex justify-content-center mb-2">
                                    <a href="#" class="btn btn-sm btn-primary px-3 border-end" style="border-radius: 30px 0 0 30px;">Read More</a>
                                    <a href="#" class="btn btn-sm btn-primary px-3" style="border-radius: 0 30px 30px 0;">Book Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <!-- Package End -->

    <!-- Process Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center pb-4 wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="section-title bg-white text-center text-primary px-3">Process</h6>
                <h1 class="mb-5">4 Easy Steps</h1>
            </div>
            <div class="row gy-5 gx-4 justify-content-center">
                <div class="col-lg-3 col-sm-6 text-center pt-4 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="position-relative border border-primary pt-5 pb-4 px-4">
                        <div class="d-inline-flex align-items-center justify-content-center bg-primary rounded-circle position-absolute top-0 start-50 translate-middle shadow" style="width: 100px; height: 100px;">
                            <i class="fa fa-globe fa-3x text-white"></i>
                        </div>
                        <h5 class="mt-4">Choose a destination</h5>
                        <hr class="w-25 mx-auto bg-primary mb-1">
                        <hr class="w-50 mx-auto bg-primary mt-0">
                        <p class="mb-0">Tempor erat elitr rebum clita dolor diam ipsum sit diam amet diam eos erat ipsum et lorem et sit sed stet lorem sit</p>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 text-center pt-4 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="position-relative border border-primary pt-5 pb-4 px-4">
                        <div class="d-inline-flex align-items-center justify-content-center bg-primary rounded-circle position-absolute top-0 start-50 translate-middle shadow" style="width: 100px; height: 100px;">
                            <i class="fa fa-archive fa-3x text-white"></i>
                        </div>
                        <h5 class="mt-4">Choose a package</h5>
                        <hr class="w-25 mx-auto bg-primary mb-1">
                        <hr class="w-50 mx-auto bg-primary mt-0">
                        <p class="mb-0">Tempor erat elitr rebum clita dolor diam ipsum sit diam amet diam eos erat ipsum et lorem et sit sed stet lorem sit</p>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 text-center pt-4 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="position-relative border border-primary pt-5 pb-4 px-4">
                        <div class="d-inline-flex align-items-center justify-content-center bg-primary rounded-circle position-absolute top-0 start-50 translate-middle shadow" style="width: 100px; height: 100px;">
                            <i class="fa fa-calendar fa-3x text-white"></i>
                        </div>
                        <h5 class="mt-4">Book your tour</h5>
                        <hr class="w-25 mx-auto bg-primary mb-1">
                        <hr class="w-50 mx-auto bg-primary mt-0">
                        <p class="mb-0">Tempor erat elitr rebum clita dolor diam ipsum sit diam amet diam eos erat ipsum et lorem et sit sed stet lorem sit</p>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 text-center pt-4 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="position-relative border border-primary pt-5 pb-4 px-4">
                        <div class="d-inline-flex align-items-center justify-content-center bg-primary rounded-circle position-absolute top-0 start-50 translate-middle shadow" style="width: 100px; height: 100px;">
                            <i class="fa fa-car fa-3x text-white"></i>
                        </div>
                        <h5 class="mt-4">Travel today</h5>
                        <hr class="w-25 mx-auto bg-primary mb-1">
                        <hr class="w-50 mx-auto bg-primary mt-0">
                        <p class="mb-0">Tempor erat elitr rebum clita dolor diam ipsum sit diam amet diam eos erat ipsum et lorem et sit sed stet lorem sit</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Process Start -->
    
    <!-- Booking Start -->
    <div class="container-xxl py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container">
            <div class="booking p-5">
                <div class="row g-5 align-items-center">
                    <div class="col-md-6 text-white">
                        <h6 class="text-white text-uppercase">Booking</h6>
                        <h1 class="text-white mb-4">Online Booking</h1>
                        <p class="mb-4">Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit. Aliqu diam amet diam et eos. Clita erat ipsum et lorem et sit.</p>
                        <p class="mb-4">Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit. Aliqu diam amet diam et eos. Clita erat ipsum et lorem et sit, sed stet lorem sit clita duo justo magna dolore erat amet</p>
                        <a class="btn btn-outline-light py-3 px-5 mt-2" href="">Read More</a>
                    </div>
                    <div class="col-md-6">
                        <h1 class="text-white mb-4">Book A Tour</h1>
                        <form action="" method="POST">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control bg-transparent" id="firstName" placeholder="Your First Name">
                                        <label for="firstName">Your First Name</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control bg-transparent" id="lastName" placeholder="Your Last Name">
                                        <label for="lastName">Your Last Name</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="number" class="form-control bg-transparent" min="0" id="mobile" placeholder="Your Mobile No.">
                                        <label for="name">Your Mobile No.</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="email" class="form-control bg-transparent" id="email" placeholder="Your Email">
                                        <label for="email">Your Email</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating date" id="date3" data-target-input="nearest">
                                        <input type="text" class="form-control bg-transparent datetimepicker-input" id="datetime" placeholder="Date & Time" data-target="#date3" data-toggle="datetimepicker" />
                                        <label for="datetime">Date & Time</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <select class="form-select bg-transparent" id="select1" onchange="getPackage(this.value)">
                                            <option value disabled selected>Select a Destination</option>
                                                <?php 
                                                    $destination = mysqli_query($conn,"SELECT * FROM destination WHERE status = 1 AND category != 4 & 5");
                                                    while($destination_run = mysqli_fetch_array($destination)){ 
                                                ?>
                                            <option value="<?php echo $destination_run['destination_id'] ?>"><?php echo $destination_run['destination'] ?></option>
                                                <?php } ?>
                                        </select>
                                        <label for="select1">Destination</label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-floating">
                                        <select class="form-select bg-transparent" id="select2">
                                            <option value="">Select a package</option>
                                        </select>
                                        <label for="select2">Packages</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating">
                                        <textarea class="form-control bg-transparent" placeholder="Special Request" id="message" style="height: 100px"></textarea>
                                        <label for="message">Special Request</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button class="btn btn-outline-light w-100 py-3" type="submit">Book Now</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Booking Start -->

    <!-- Testimonial Start -->
    <div class="container-xxl py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container">
            <div class="text-center">
                <h6 class="section-title bg-white text-center text-primary px-3">Reviews</h6>
                <h1 class="mb-5">Our Visitors Say!!!</h1>
            </div>
            <div class="owl-carousel testimonial-carousel position-relative">
                <?php
                    $sql = $conn->query("SELECT * FROM booking WHERE status = 4");
                    while($sqlLoad = $sql->fetch_array()){

                    $myDes = $sqlLoad['destination'];
                    $sqlLoadDes = $conn->query("SELECT * FROM destination WHERE destination_id = '$myDes'");
                    $sqlLoadDes_run = $sqlLoadDes->fetch_array();

                    $myTour = $sqlLoad['tourist'];
                    $sqlLoadTour = $conn->query("SELECT * FROM tourist WHERE tourist_id = '$myTour'");
                    $sqlLoadTour_run = $sqlLoadTour->fetch_array();

                    $myadd = $sqlLoadTour_run['tourist_id'];
                    $sqlLoadAdd = $conn->query("SELECT * FROM tourist_address WHERE tourist_id = '$myadd'");
                    $sqlLoadAdd_run = $sqlLoadAdd->fetch_array();

                    $mymun= $sqlLoadAdd_run['municipal_id'];
                    $sqlLoadMun = $conn->query("SELECT * FROM municipality WHERE id = '$mymun'");
                    $sqlLoadMun_run = $sqlLoadMun->fetch_array();

                    $mypro= $sqlLoadAdd_run['municipal_id'];
                    $sqlLoadPro = $conn->query("SELECT * FROM province WHERE id = '$mypro'");
                    $sqlLoadPro_run = $sqlLoadPro->fetch_array();

                    $myRev = $sqlLoad['tourist'];
                    $sqlLoadRev = $conn->query("SELECT * FROM reviews WHERE tourist='$myRev'");
                    $sqlLoadRev_run = $sqlLoadRev->fetch_array();

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
                        <p style="font-size: 12px;">of <?= $sqlLoadMun_run['municipality'].', '.$sqlLoadPro_run['province']; ?></p>
                        <p class="mb-0" style="font-size: 13px;"><i>"<?=  $sqlLoadRev_run['comment']; ?>"</i></p>
                    </div>
                <?php } ?>                                        
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
    <script type="text/javascript">
        function getPackage(val) {
            $.ajax({
            url: "getPackage.php",
            type: "POST",
            data: 'destination_id='+val,
            success: function(data){
            $("#select2").html(data);
                }
            });
        };
</script>
</body>

</html>