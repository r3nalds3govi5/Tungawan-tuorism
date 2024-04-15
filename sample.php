<?php
    include 'db.php';
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
        <nav class="navbar navbar-expand-lg navbar-light px-4 px-lg-5 py-3 py-lg-0">
            <a href="index.php" class="navbar-brand p-0">
                <h4 class="text-primary m-0"><i class="fa fa-map-marker-alt me-2"></i>Tungawan Tourism</h4>
                <!-- <img src="img/logo.png" alt="Logo"> -->
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="fa fa-bars"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav ms-auto py-0">
                    <a href="index.php" class="nav-item nav-link">Home</a>
                    <a href="about.php" class="nav-item nav-link active">About</a>
                    <a href="service.php" class="nav-item nav-link">Services</a>
                    <a href="package.php" class="nav-item nav-link">Packages</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Pages</a>
                        <div class="dropdown-menu m-0">
                            <a href="destination.php" class="dropdown-item">Destination</a>
                            <a href="booking.php" class="dropdown-item">Booking</a>
                            <a href="javascript:;" class="dropdown-item">Accommodation</a>
                            <a href="javascript:;" class="dropdown-item">Foods & Cafes</a>
                            <a href="testimonial.php" class="dropdown-item">Reviews</a>
                        </div>
                    </div>
                    <a href="contact.php" class="nav-item nav-link">Contact</a>
                </div>
                <a href="registrationForm.php" class="btn btn-primary rounded-pill py-2 px-4">Register</a>
            </div>
        </nav>
        <div class="container-fluid bg-primary py-5 mb-5 hero-header">
            <div class="container py-5">
                <div class="row justify-content-center py-5">
                    <div class="col-lg-10 pt-lg-5 mt-lg-5 text-center">
                        <h1 class="display-3 text-white mb-3 animated slideInDown">Enjoy Your Vacation With Us</h1>
                        <h3 class="fs-2 mb-3 animated slideInDown">The place that time forgot.</h3>
                        <p class="fs-5 text-white mb-4 animated slideInDown">
                            Tungawan, a municipality located in the province of Zamboanga Sibugay 
                            in the Philippines, is known for its natural beauty and rich cultural heritage. 
                            The town boasts of lush forests, pristine beaches, and stunning waterfalls 
                            that are sure to captivate any visitor's heart.
                        </p>
                        <div class="position-relative w-75 mx-auto animated slideInDown">
                        <form action="searchDestinationResult.php" method="GET">
                            <input class="form-control border-0 rounded-pill w-100 py-3 ps-4 pe-5" name="destination" value="<?php if(isset($_GET['destination'])){ echo $_GET['destination'];} ?>"type="text" placeholder="Eg: Gapas Gapas" required>
                            <button type="submit" name="submit" class="btn btn-primary rounded-pill py-2 px-4 position-absolute top-0 end-0 me-2" style="margin-top: 7px;">Search</button>
                            </form>  
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Navbar & Hero End -->     

    <!-- Destination Start -->
    <div class="container-xxl py-5 destination">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="section-title bg-white text-center text-primary px-3">Destination</h6>
                <h1 class="mb-5">Our Destination</h1>
            </div>
            <div class="row g-3">
                <div class="row g-3">
                    <?php 
                        if($_SERVER["REQUEST_METHOD"] == "GET") {
                            $destination = $_GET['destination'];

                            $sql = "SELECT * FROM destination WHERE 1=1 AND status = 1 AND category = 1";
                            
                            if (!empty($destination)) {
                                $sql .= " AND destination LIKE '%$destination%'";
                            }
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0 ) {
                                while ($row = $result->fetch_assoc()) {

                        ?>
                        <div class="col-lg-4 col-md-12 wow zoomIn" data-wow-delay="0.1s">
                            <a class="position-relative d-block overflow-hidden" href="javascript:;">
                                <img class="img-fluid" src="admin/uploads/<?= $row['image']; ?>" alt="">
                                <div class="bg-white text-primary fw-bold position-absolute bottom-0 end-0 m-3 py-1 px-2">
                                    <i class="fa fa-map-marker-alt me-1"></i><?= $row['destination']; ?>
                                </div>
                            </a>
                        </div>
                <?php } 
                    }else{ ?>
                        <div class="container text-center">
                            <div class="row justify-content-center">
                                <div class="col-lg-6">
                                    <i class="bi bi-exclamation-triangle display-1 text-primary"></i>
                                    <h1 class="mb-2">No result found</h1>
                                    <p class="mb-5">Try different or more general keyword</p>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="container">
                            <div class="text-left wow fadeInUp" data-wow-delay="0.1s">
                                <h6 class="section-title bg-white text-start text-primary pe-3">YOU MAY ALSO LIKE</h6>
                            </div>
                            <div class="row g-3">
                                <div class="row g-3">
                                    <?php
                                        $sql = mysqli_query($conn, "SELECT * FROM destination WHERE status = 1 AND category = 1");
                                        while($sqlLoad = mysqli_fetch_assoc($sql)){
                                    ?>
                                        <div class="col-lg-4 col-md-12 wow zoomIn" data-wow-delay="0.1s">
                                            <a class="position-relative d-block overflow-hidden" href="javascript:;">
                                                <img class="img-fluid" src="admin/uploads/<?= $sqlLoad['image']; ?>" alt="">
                                                <div class="bg-white text-primary fw-bold position-absolute bottom-0 end-0 m-3 py-1 px-2"><i class="fa fa-map-marker-alt me-1"></i><?= $sqlLoad['destination']; ?></div>
                                            </a>
                                        </div>
                                <?php } ?>
                                </div>
                            </div>
                        </div>
                <?php
                        } 
                    }   
                ?>
                </div>
            </div>
        </div>
    </div>
    <!-- Destination Start -->

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