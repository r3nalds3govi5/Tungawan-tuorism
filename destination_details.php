<?php
    require('db.php');
    require('auth.php');

    $code = $_GET['on'];
    $sql = $conn->query("SELECT * FROM destination WHERE destination_id='$code'");
    $sql_run = $sql->fetch_array();
    
    $myids = $sql_run['category'];
    $sqls = $conn->query("SELECT * FROM category WHERE id='$myids'");
    $sqls_run = $sqls->fetch_array();

    $myid = $sql_run['destination_id'];
    $sql1 = $conn->query("SELECT * FROM destination_overview WHERE destination_id='$myid'");
    $sql_run1 = $sql1->fetch_array();

    $myidd = $sql_run['destination_id'];
    $sql2 = $conn->query("SELECT * FROM gallery WHERE destination_id='$myidd'");
    $sql_run2 = $sql2->fetch_array();
    
    $myiddd = $sql_run['destination_id'];
    $sql3 = $conn->query("SELECT * FROM destination_videos WHERE destination_id='$myiddd'");
    $sql_run3 = $sql3->fetch_array();
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

         <div class="container-fluid bg-primary py-5 mb-3 " style="background: linear-gradient(rgba(20, 20, 31, .3), rgba(20, 20, 31, .3)), 
         url(admin/uploads/<?php echo $sql_run['image']; ?>); height: 70vh !important; background-repeat: no-repeat; background-size: cover;">
            <div class="container py-5">
                <div class="row justify-content-center py-5">
                    <div class="col-lg-10 pt-lg-5 mt-lg-5 text-center">
                        <h1 class="display-3 text-white animated slideInDown"><?= $sql_run['destination']; ?></h1>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb justify-content-center">
                                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                <li class="breadcrumb-item text-white active" aria-current="page"><?= $sql_run['destination']; ?></li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Navbar & Hero End -->


    <!-- About Start -->
    <div class="container-xxl py-5" >
        <div class="container">
            <div class="row g-5">
                <!--<div class="col-lg-12 wow fadeInUp" data-wow-delay="0.1s" style="height: 80vh !important;">-->
                <!--    <div class="position-relative h-100">-->
                <!--        <img class="img-fluid position-absolute w-100 h-100" src="admin/uploads/<?php echo $sql_run['image']; ?>" alt="" >-->
                <!--    </div>-->
                <!--</div>-->
                <div class="col-lg-12 text-center wow fadeInUp" data-wow-delay="0.3s">
                    <h5 class="section-title bg-white text-primary px-3">About</h5>
                    <h1><span class="text-primary"><?php echo $sql_run['destination']; ?></span></h1>
                    <?php 
                        $sql1 = $conn->query("SELECT id FROM destination_ratings WHERE destination_id='$sql_run[destination_id]' AND status='1' GROUP BY id");
                        $numR = $sql1->num_rows;

                        $sqlrating = $conn->query("SELECT *, SUM(ratings) AS total FROM destination_ratings WHERE destination_id='$sql_run[destination_id]' AND status='1'");
                        $rData = $sqlrating->fetch_array();
                        $total = $rData['total'];
                        
                        if($numR != 0){
                            $avg = $total / $numR;
                            $sql1 = $conn->query("SELECT id FROM destination_ratings GROUP BY id DESC");
                            $numR = $sql1->num_rows;
                    ?>
                    <div class="mb-4"> <?= round($avg,2); ?>/5
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
                    <?php
                        }
                            if ($sql_run['category'] != 4 && $sql_run['category'] != 5 && $sql_run['category'] != 3 && $sql_run['destination_id'] !='TID20230814-8') { ?>
                                <a class="btn btn-primary py-2 px-4 mb-3" href="booking_destination.php?on=<?= $sql_run['id']; ?>">Book Now</a>
                                <a class="btn btn-primary py-2 px-4 mb-3" href="rating_review.php?on=<?= $sql_run['destination_id']; ?>">Reviews</a>
                                <?php } else { ?>
                                <a class="btn btn-primary py-2 px-4 mb-3" href="rating_review.php?on=<?= $sql_run['destination_id']; ?>">Reviews</a>
                                <?php 
                                } 
                            ?>
                     
                        <p class="mb-3 " style="text-align:justify">&nbsp;&nbsp;&nbsp;&nbsp;
                         <?php echo $sql_run['description']; ?>
                        </p>
                </div>
                <?php
                    if($sql_run1['do']!='' || $sql_run1['dont']!='') {?>
                        <div class="col-lg-12 wow fadeInUp" data-wow-delay="0.3s">
                            <div class="service-item rounded pt-3">
                                <div class="p-4">
                                    <h5 class="text-primary"><i class="fa fa-thumbs-up"></i> Do's</h5>
                                    <p class="">&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $sql_run1['do']; ?> </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 wow fadeInUp" data-wow-delay="0.3s">
                            <div class="service-item rounded pt-3">
                                <div class="p-4">
                                    <h5 class="text-primary"><i class="fa fa-thumbs-down"></i> Don't</h5>
                                    <pstyle="text-align:justify">&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $sql_run1['dont']; ?></p>
                                </div>
                            </div>
                        </div>
                <?php  } ?>
            </div>
        </div>
    </div>

    <?php
        if ($sql_run['category'] != 5) { ?>
    <div class="container-xxl py-5" >
        <div class="container">
            <div class="row g-5">    
                <div class="col-lg-12 wow fadeInUp" data-wow-delay="0.3s">
                    <p>Getting to <?= $sql_run['destination']; ?> is easy with several transportation options available from the town.</p>
                    <p>Here’s how you can get to <?= $sql_run['destination']; ?> from Tungawan bus terminal:</p>
                    <h6>From Tungawan IBT to <?= $sql_run['location']; ?></h6>
                    <?php
                        if($sql_run['howtogetthere'] !='') { ?>
                            <p>&nbsp;&nbsp;&nbsp;&nbsp;<?= $sql_run['howtogetthere']; ?></p>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>
    
    <?php
        if ($sql_run['category'] != 5) { ?>
            <div class="container-xxl py-5" >
                <div class="container">
                    <div class="row g-5">    
                        <div class="col-lg-12  wow fadeInUp" data-wow-delay="0.1s">
                            <h5 class="bg-white text-primary">Getting to <?= $sql_run['destination']; ?></h5>
                            <div class="position-relative h-100">
                                <iframe src="<?= $sql_run['pen_location']; ?>" 
                                    width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                                </iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    <?php } ?>
    
    <?php
        if ($sql_run['whentogo'] !='') { ?>
            <div class="container-xxl py-5" >
                <div class="container">
                    <h5 class="bg-white text-primary">When to go to <?= $sql_run['destination']; ?>?</h5>
                    <div class="col-lg-12 wow fadeInUp" data-wow-delay="0.3s">
                        <p>&nbsp;&nbsp;&nbsp;&nbsp;<?= $sql_run['whentogo']; ?></p>
                    </div>
                </div>
            </div>
    <?php } ?>
    
    <?php
        if ($sql_run['other'] !='') { ?>
            <div class="container-xxl py-5" >
                <div class="container">
                    <h5 class="bg-white text-primary">Things to consider here in <?= $sql_run['destination']; ?></h5>
                    <div class="col-lg-12 wow fadeInUp" data-wow-delay="0.3s">
                        <p>&nbsp;&nbsp;&nbsp;&nbsp;<?= $sql_run['other']; ?></p>
                    </div>
                </div>
            </div>
    <?php } ?>
    
    <?php 
        if($sql_run2['image'] !=''){ ?>
            <div class="container-xxl py-5" >
                <div class="container">
                    <div class="text-center wow fadeInUp" data-wow-delay="0.3s">
                        <h5 class="section-title bg-white text-center text-primary px-3">GALLERY</h5>
                        <h6 class="mb-5">The beauty of <?= $sql_run['destination']; ?></h6>
                    </div>
                    <div class="row g-3">
                        <?php
                            $page=0;
                            if(isset($_POST['page'])){
                                $page = $_POST['page'];
                                $page = ($page * 6)-6;
                            }
                            $sqlGallery = mysqli_query($conn, "SELECT * FROM gallery WHERE destination_id='$sql_run2[destination_id]' ORDER BY id LIMIT $page, 6");
                            while($sqlGallery_run = mysqli_fetch_assoc($sqlGallery)){
                        ?>
                            <div class="col-lg-4 col-md-12 wow zoomIn" data-wow-delay="0.1s">
                                <div class="package-item">
                                    <div class="overflow-hidden">
                                        <img class="img-fluid" src="./admin/uploads/<?= $sqlGallery_run['image']; ?>" alt="">
                                    </div>
                                </div>
                            </div>
                            <div class="popup-image">
                                <span>&times;</span>
                                <img src="admin/uploads/<?= $sqlGallery_run['image']; ?>">
                            </div>
                        <?php } 
                            $sqlimages = mysqli_query($conn, "SELECT * FROM gallery WHERE destination_id='$sql_run2[destination_id]'");
                            $count = mysqli_num_rows($sqlimages);
                            $a = $count / 6;
                            $a = ceil ($a);
                        ?>
                        <form method="POST">
                            <?php
                                for ($b = 1; $b <= $a; $b++){
                            ?>
                            <input type="submit" class="btn btn-primary" value="<?php echo $b; ?>" name="page">
                            <?php } ?>
                        </form>
                    </div>
                </div>
            </div>
    <?php  } ?>
    
    <?php 
        if($sql_run3['dest_videos'] !=''){ ?>
            <div class="container-xxl py-5" >
                <div class="container" style="margin-top: 20px !important">
                    <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                        <h5 class="section-title bg-white text-center text-primary px-3">Videos</h5>
                        <h6 class="mb-5">Videos of <?= $sql_run['destination']; ?></h6>
                    </div>
                    <div class="row g-3">
                        <?php
                            $sqlGallery = mysqli_query($conn, "SELECT * FROM destination_videos WHERE destination_id='$sql_run2[destination_id]' ORDER BY RAND()");
                            while($sqlGallery_run = mysqli_fetch_assoc($sqlGallery)){
                                $video_path = "../admin/uploads/" . $sqlGallery_run["dest_videos"];
                        ?>
                            <div class="col-lg-4 col-md-12 wow zoomIn" data-wow-delay="0.1s">
                                <div class="package-item">
                                    <div class="overflow-hidden">
                                        <?php
                                            echo "
                                                <video width='320' height='240' controls>
                                                <source src='$video_path' type='video/mp4'>
                                                Your browser does not support the video tag.
                                                </video><br>
                                                ";
                                        ?>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
    <?php  } ?>
    
    <!-- Footer Start -->
    <?php include 'footer.php' ?>
    <!-- Footer End -->

    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    <script>
        document.querySelectorAll('.package-item img').forEach(image =>{
            image.onclick = () =>{
                document.querySelector('.popup-image').style.display = 'block';
                document.querySelector('.popup-image img').src = image.getAttribute('src');
            }
        });
        
        document.querySelector('.popup-image span').onclick = () =>{
            document.querySelector('.popup-image').style.display = 'none';
        }
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

</body>

</html>