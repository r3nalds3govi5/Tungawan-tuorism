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
        <div class="container-fluid bg-primary py-5 mb-5 hero-header">
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
                            <input class="form-control border-0 rounded-pill w-100 py-3 ps-4 pe-5" style="color: #333" name="destination" value="<?php if(isset($_GET['destination'])){ echo $_GET['destination'];} ?>"type="text" placeholder="Eg: Gapas Gapas" required>
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
            <?php 
                if($_SERVER["REQUEST_METHOD"] == "GET") {
                    $search_job = $_GET['destination'];
                    $search_location = $_GET['destination'];
                    
                    $keywords = explode(" ", $search_job);

                    // Build the SQL query
                    $sql = "SELECT * FROM destination WHERE ";
                    foreach ($keywords as $key => $word) {
                        if ($key > 0) {
                            $sql .= "AND ";
                        }
                        $sql .= "keywords LIKE '%$word%' AND status= '1'";
                    }
                
                    $result = $conn->query($sql);
                
                    if ($result->num_rows > 0) {
                        
            
            ?>
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="section-title bg-white text-center text-primary px-3">Search Result for</h6>
                <h1 class="mb-5">"<?php if(isset($_GET['destination'])){ echo $_GET['destination'];} ?>"</h1>
            </div>
            <div class="row g-3">
                <?php
                    while($row = $result->fetch_assoc()) { 
                    $disid = $row['destination_id'];
                ?>
                <div class="col-lg-4 col-md-12 wow zoomIn" data-wow-delay="0.1s">
                    <a class="position-relative d-block overflow-hidden" href="destination_details.php?on=<?php echo $row['destination_id']; ?>">
                        <img class="img-fluid" src="admin/uploads/<?= $row['image']; ?>" alt="" style="height: 30vh !important">
                        
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
                            <i class="fa fa-map-marker-alt me-1"></i><?= $row['destination']; ?>
                        </div>
                    </a>
                </div>
                    
                <?php } 
                     }else{ 
                ?>
                    <div class="container">
                        <div class="row g-3">
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
                                <div class="text-left mb-3 wow fadeInUp" data-wow-delay="0.1s">
                                    <h6 class="section-title bg-white text-start text-primary pe-3">YOU MAY ALSO LIKE</h6>
                                </div>
                                <div class="row g-3">
                                    <?php
                                        $sql = mysqli_query($conn, "SELECT * FROM destination WHERE status = 1 ORDER BY RAND()");
                                        while($sqlLoad = mysqli_fetch_assoc($sql)){
                                    ?>
                                        <div class="col-lg-4 col-md-12 wow zoomIn" data-wow-delay="0.1s">
                                            <a class="position-relative d-block overflow-hidden" href="destination_details.php?on=<?php echo $sqlLoad['destination_id']; ?>">
                                                <img class="img-fluid" src="admin/uploads/<?= $sqlLoad['image']; ?>" alt="" style="height: 30vh !important">
                                                <div class="bg-white text-primary fw-bold position-absolute bottom-0 end-0 m-3 py-1 px-2"><i class="fa fa-map-marker-alt me-1"></i><?= $sqlLoad['destination']; ?></div>
                                            </a>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } } ?>
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