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
    <!-- <link href="css/navbar.css" rel="stylesheet"> -->

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
                            <button type="submit" name="submit" class="btn btn-primary rounded-pill py-2 px-4 position-absolute top-0 end-0 me-2" style="margin-top: 8.4px;">Search</button>
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
                        while($sqlLoad = $sql->fetch_assoc()){ ?>

                        <a href="destination_details.php?on=<?= $sqlLoad['destination_id']; ?>">
                            <div class="text-center border" style="background-image: url('admin/uploads/<?= $sqlLoad['image']; ?>');">
                                <img class="bg-white rounded-circle shadow p-1 mx-auto mb-1" src="admin/uploads/<?= $sqlLoad['image']; ?>" style="width: 120px; height: 120px;">
                                <h5 class="mb-0"><?= $sqlLoad['destination']; ?></h5>
                                <p class=""><?= $sqlLoad['location']; ?></p>
                            </div>
                        </a>
                    <?php } ?>
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
                    <a class="btn btn-primary py-2 px-4 mt-2" href="about.php">Read More</a>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->

    <!-- Destination Start -->
    <div class="container-xxl py-5 destination">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="section-title bg-white text-center text-primary px-3">Destination</h6>
                <h1 class="mb-5">Our Popular Tourist Spot</h1>
            </div>
            <div class="row g-3">
                <?php
                    $sql = mysqli_query($conn, "SELECT *, SUM(ratings) AS total, AVG(ratings) AS avg_ratings FROM destination_ratings WHERE status='1' GROUP BY destination_id ORDER BY avg_ratings DESC LIMIT 6");
                    while($sqlLoads = mysqli_fetch_assoc($sql)){
                                       
                    $disids = $sqlLoads['destination_id'];
                    $sql_destination = mysqli_query($conn, "SELECT * FROM destination WHERE destination_id = '$disids' AND status = 1 AND category != 4 AND category != 5 AND category != 3 ");
                    $sql_destination_run = mysqli_fetch_assoc($sql_destination);    
                    
                    $disid = $sql_destination_run['destination_id'];
                    
                ?>
                    <div class="col-lg-4 col-md-12 wow zoomIn" data-wow-delay="0.1s">
                        <a class="position-relative d-block overflow-hidden" href="destination_details.php?on=<?php echo $disid; ?>">
                            <img class="img-fluid" src="admin/uploads/<?= $sql_destination_run['image']; ?>" alt="" style="height: 30vh !important">
                                <?php
                                    $sql1 = $conn->query("SELECT id FROM destination_ratings WHERE destination_id='$disid' AND status='1' GROUP BY id");
                                    $numR = $sql1->num_rows;
    
                                    $sqlrating = $conn->query("SELECT *, SUM(ratings) AS total FROM destination_ratings WHERE destination_id='$disid' AND status='1'");
                                    $rData = $sqlrating->fetch_array();
                                    $total = $rData['total'];
                                    
                                    if($numR != 0){
                                        $avg = $total / $numR;
                                        $sql1 = $conn->query("SELECT id FROM destination_ratings GROUP BY id DESC");
                                        $numR = $sql1->num_rows;
                                        
                                ?>
                            <div class="bg-white text-danger fw-bold position-absolute top-0 start-0 m-3 py-1 px-2"><?= round($avg); ?>/5
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
        
    <!-- Footer Start -->
    <?php include 'footer.php' ?>
    <!-- Footer End -->

    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>

    <script>
        var today = new Date().toISOString().split('T')[0];
        document.getElementById("dateoftravel").setAttribute("min", today);
    </script>

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
<script>
    var box  = document.getElementById('box');
var down = false;


function toggleNotifi(){
	if (down) {
		box.style.height  = '0px';
		box.style.opacity = 0;
		down = false;
	}else {
		box.style.height  = '510px';
		box.style.opacity = 1;
		down = true;
	}
}
</script>
</body>

</html>