<?php
    require('db.php');
    require('auth.php');
    // if(!isset($_SESSION['loginid']) || (trim($_SESSION['loginid']) == '')){
    //     header("location: loginForm.php");
    //     exit();
    // }
    $code = $_GET['on'];
    $sql = $conn->query("SELECT * FROM destination WHERE destination_id='$code'");
    $sql_run = $sql->fetch_array();

    $myid = $sql_run['destination_id'];
    $sql1 = $conn->query("SELECT * FROM destination_overview WHERE destination_id='$myid'");
    $sql_run1 = $sql1->fetch_array();

    $myidd = $sql_run['destination_id'];
    $sql2 = $conn->query("SELECT * FROM gallery WHERE destination_id='$myidd'");
    $sql_run2 = $sql2->fetch_array();
    
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

    <link href='http://fonts.googleapis.com/css?family=Ubuntu' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed' rel='stylesheet' type='text/css'>
    
    <style>
        .progress-label-left
        {
            float: left;
            margin-right: 0.5em;
            line-height: 1em;
        }
        .progress-label-right
        {
            float: right;
            margin-left: 0.3em;
            line-height: 1em;
        }
        .star-light
        {
            color:#e9ecef;
        }
    </style>
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
                $code = urlencode($code);
                $myid=	$_SESSION['loginid'];
                $qryget=mysqli_query($conn,"SELECT * FROM tourist WHERE id='$myid'");
                $data1=mysqli_fetch_array($qryget);
                    
                require('positive.php'); }else{ require('negative.php'); }
                
        ?>

        <div class="container-fluid bg-primary py-5 mb-5 hero-header">
            <!--<div class="container py-5">-->
            <!--    <div class="row justify-content-center py-5">-->
            <!--        <div class="col-lg-10 pt-lg-5 mt-lg-5 text-center">-->
            <!--            <h1 class="display-3 text-white animated slideInDown"><?php echo $sql_run['destination']; ?></h1>-->
            <!--        </div>-->
            <!--    </div>-->
            <!--</div>-->
        </div>
    </div>
    <!-- Navbar & Hero End -->

    <!-- About Start -->
    <div class="container-xxl destination" >
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s" style="min-height: 400px;">
                    <div class="position-relative h-100">
                        <img class="img-fluid position-absolute w-100 h-100" src="admin/uploads/<?php echo $sql_run['image']; ?>" alt="" >
                    </div>
                </div>
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.3s">
                    <h6 class="section-title bg-white text-start text-primary pe-3">Rating and Reviews</h6>
                    <h1><span class="text-primary"><?php echo $sql_run['destination']; ?></span></h1>
                    <?php 
                        $sql1 = $conn->query("SELECT id FROM destination_ratings WHERE destination_id='$sql_run[destination_id]' AND status='1' GROUP BY id");
                        $numR = $sql1->num_rows;

                        $sqlrating = $conn->query("SELECT *, SUM(ratings) AS total FROM destination_ratings WHERE destination_id='$sql_run[destination_id]' AND status='1'");
                        $rData = $sqlrating->fetch_array();
                        $total = $rData['total'];
                    
                    ?>

                    <div class="row">
                        <div class="col-sm-4 text-center">
                            <h1 class="text-primary mt-4">
                                <?php
                                    if($numR != 0){
                                        $avg = $total / $numR;
                                        $sql1 = $conn->query("SELECT id FROM destination_ratings GROUP BY id DESC");
                                        $numRs = $sql1->num_rows;
                                    ?>
                                    <b class="text-primary"><span id="average_rating"><?= number_format($avg, 1); ?></span> / 5</b>
                                <?php } ?>
                            </h1>
                            <div class="mb-3">
                                    <ul class="list-inline">
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
                                    </ul>
                                </div>
                            <h3><span id="total_review"><?= $numR; ?></span> Reviews</h3>
                        </div>
                        <div class="col-sm-8">
                            <p>
                                <?php
                                    $average_rating = 0;
                                    $total_review = 0;
                                    $five_star_review = 0;
                                    $total_user_rating = 0;
                                    $sql ="SELECT * FROM destination_ratings WHERE destination_id='$sql_run[destination_id]' AND status='1'";
                                    $result= mysqli_query($conn, $sql);

                                    foreach($result as $row){

                                        if($row["ratings"] == '5') {
                                            $five_star_review++;
                                            }
                                            $total_review++;
                                            $total_user_rating = $total_user_rating + $row["ratings"];
                                            
                                        
                                     $average_rating = $five_star_review / $total_review;
                                    }
                                ?>
                                <div class="progress-label-left"><b>5</b> <i class="fas fa-star text-primary"></i></div>
                                <div class="progress-label-right">(<span id=""><?= $five_star_review; ?></span>)</div>
                                <div class="progress">
                                    <div class="progress-bar text-primary" role="progressbar" style="width:<?= $average_rating;?>%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                               
                            </p>
                            <p>
                                <?php
                                    $average_rating = 0;
                                    $total_review = 0;
                                    $four_star_review = 0;
                                    $total_user_rating = 0;
                                    $sql ="SELECT * FROM destination_ratings WHERE destination_id='$sql_run[destination_id]' AND status='1'";
                                    $result= mysqli_query($conn, $sql);

                                    foreach($result as $row){

                                        if($row["ratings"] == '4') {
                                            $four_star_review++;
                                            }
                                            $total_review++;
                                            $total_user_rating = $total_user_rating + $row["ratings"];
                                            
                                            $average_rating = $four_star_review / $total_review;
                                        }

                                ?>
                                <div class="progress-label-left"><b>4</b> <i class="fas fa-star text-primary"></i></div>
                                <div class="progress-label-right">(<span id=""><?= $four_star_review; ?></span>)</div>
                                <div class="progress">
                                    <div class="progress-bar text-primary" style="width:<?= $average_rating;?>%" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id=""></div>
                                </div>               
                            </p>
                            <p>
                                <?php
                                    $average_rating = 0;
                                    $total_review = 0;
                                    $three_star_review = 0;
                                    $total_user_rating = 0;
                                    $sql ="SELECT * FROM destination_ratings WHERE destination_id='$sql_run[destination_id]' AND status='1'";
                                    $result= mysqli_query($conn, $sql);

                                    foreach($result as $row){

                                        if($row["ratings"] == '3') {
                                            $three_star_review++;
                                            }
                                            $total_review++;
                                            $total_user_rating = $total_user_rating + $row["ratings"];
                                            
                                            $average_rating = $three_star_review / $total_review;
                                        }

                                ?>
                                <div class="progress-label-left"><b>3</b> <i class="fas fa-star text-primary"></i></div>
                                <div class="progress-label-right">(<span id=""><?= $three_star_review; ?></span>)</div>
                                <div class="progress">
                                    <div class="progress-bar text-primary" style="width:<?= $average_rating;?>%" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id=""></div>
                                </div>               
                            </p>
                            <p>
                                <?php
                                    $average_rating = 0;
                                    $total_review = 0;
                                    $two_star_review = 0;
                                    $total_user_rating = 0;
                                    $sql ="SELECT * FROM destination_ratings WHERE destination_id='$sql_run[destination_id]' AND status='1'";
                                    $result= mysqli_query($conn, $sql);

                                    foreach($result as $row){

                                        if($row["ratings"] == '2') {
                                            $two_star_review++;
                                            }
                                            $total_review++;
                                            $total_user_rating = $total_user_rating + $row["ratings"];
                                            
                                            $average_rating = $two_star_review / $total_review;
                                        }

                                ?>
                                <div class="progress-label-left"><b>2</b> <i class="fas fa-star text-primary"></i></div>
                                <div class="progress-label-right">(<span id="total_two_star_review"><?= $two_star_review; ?></span>)</div>
                                <div class="progress">
                                    <div class="progress-bar text-primary" style="width:<?= $average_rating;?>%" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="two_star_progress"></div>
                                </div>               
                            </p>
                            <p>
                                <?php
                                    $average_rating = 0;
                                    $total_review = 0;
                                    $one_star_review = 0;
                                    $total_user_rating = 0;
                                    $sql ="SELECT * FROM destination_ratings WHERE destination_id='$sql_run[destination_id]' AND status='1'";
                                    $result= mysqli_query($conn, $sql);

                                    foreach($result as $row){

                                        if($row["ratings"] == '1') {
                                            $one_star_review++;
                                            }
                                            $total_review++;
                                            $total_user_rating = $total_user_rating + $row["ratings"];
                                            
                                            $average_rating = $one_star_review / $total_review;
                                        }

                                ?>
                                <div class="progress-label-left"><b>1</b> <i class="fas fa-star text-primary"></i></div>
                                <div class="progress-label-right">(<span id="total_one_star_review"><?= $one_star_review; ?></span>)</div>
                                <div class="progress">
                                    <div class="progress-bar text-primary" style="width:<?= $average_rating;?>%" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id=""></div>
                                </div>               
                            </p>
                        </div>
                        <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.3s">
                            <a class="btn btn-primary py-2 mt-2" href="testimonial.php">More reviews</a>
                            <button type="button" name="add_review" id="add_review" class="btn btn-primary py-2 mt-2">Write a review</button>
                        </div>

                    </div>
                    <div class="mt-5" id="review_content"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->
    <div id="review_modal" class="modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Write a Review</h5>
                        <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button> -->
                </div>
                <form action="review_image.php" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        <h4 class="text-center mt-2 mb-4">
                            <i class="fas fa-star star-light submit_star mr-1" id="submit_star_1" data-rating="1"></i>
                            <i class="fas fa-star star-light submit_star mr-1" id="submit_star_2" data-rating="2"></i>
                            <i class="fas fa-star star-light submit_star mr-1" id="submit_star_3" data-rating="3"></i>
                            <i class="fas fa-star star-light submit_star mr-1" id="submit_star_4" data-rating="4"></i>
                            <i class="fas fa-star star-light submit_star mr-1" id="submit_star_5" data-rating="5"></i>
                        </h4>
                        <div class="form-group">
                            <input type="hidden" name="user_name" id="user_name" value="<?= $data1['tourist_id']; ?>" class="form-control" placeholder="Enter Your Name" />
                            <input type="hidden" name="destination_name" id="destination_name" value="<?= $sql_run['destination_id']; ?>" class="form-control" placeholder="Enter Your Name" />
                        </div>
                        <div class="form-group">
                            <textarea name="user_review" id="user_review" rows="4" class="form-control mb-2" placeholder="Type Review Here"></textarea>
                        </div>
                        <!--<div class="form-group">-->
                        <!--    <label for="image_review">Image</label>-->
                        <!--    <input type="file" class="form-control" name="image_review" id="image_review">-->
                        <!--</div>-->
                        <div class="form-group text-center mt-4">
                            <button type="button" class="btn btn-primary py-3 px-5 mt-2" name="save_review" id="save_review">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <hr>
    
    <div class="container-xl" >
        <div class="container">
            <div class="row g-5">
                <div class="comment-wrapper pt-40">
                    <!--  Comment Box start--->
                    <?php
                        $page=0;
                        if(isset($_POST['page'])){
                            $page = $_POST['page'];
                            $page = ($page * 10)-10;
                        }
                        $myiddd = $sql_run['destination_id'];
                        $sql3 = mysqli_query($conn ,"SELECT * FROM destination_ratings WHERE destination_id='$myiddd' AND status='1' ORDER BY id DESC LIMIT $page, 10");
                        while ($sql_run3 = mysqli_fetch_array($sql3,MYSQLI_BOTH)) {
                        $dateRated =date('F d, Y', strtotime($sql_run3['date_entry']));

                            $myidddd = $sql_run3['tourist_id'];
                            $sql4 = $conn->query("SELECT * FROM tourist WHERE tourist_id='$myidddd'");
                            $sql_run4 = $sql4->fetch_array();

                    ?>
                    <div class="row fadeInUp" data-wow-delay="0.3s">
                        <div class="col-sm-1">
                            <?php
								if($sql_run4['image'] == ''){
									echo '<img src="admin/uploads/default.png" alt="Profile" alt="Comment Images" style="width: 60px; border-radius: 50%">';
								}else{
									echo '<img src="admin/uploads/'.$sql_run4['image'].'" alt="Comment Images" style="width: 60px; border-radius: 50%">';
								}
								if($data1['tourist_id'] == $sql_run3['tourist_id']){
							
							     //   echo '<a href="" style="font-size: 13px">Edit Review</a>';
							     
							        echo '<a href="delete_review.php?delete='.$sql_run3['id'].'" style="font-size: 13px">Delete Review</a>';
							    } 
							?>
							
                        </div>
                        <div class="col-sm-10">
                            <div class="comment-top">
                                <h6 class="title"><?= $sql_run4['firstName'].' '.$sql_run4['lastName']; ?></h6>
                                <div class="mb-1">
                                    <?php 
                                        $start=1;
                                        while ($start <= 5) {
                                            if ($sql_run3['ratings'] < $start){ ?>
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
                            </div>
                            <span class="subtitle"><?= $dateRated; ?></span>
                            <p><?= $sql_run3['review']; ?></p>
                            <div class="image=review">
                                <?php
            						if($sql_run3['rating_images'] != ''){
            						    $sqlLoadiamge = mysqli_query($conn, "SELECT * FFROM destination_ratings WHERE destination_id='$myiddd' AND tourist_id='$data1[tourist_id]'");
            						    while($sqlLoadiamge_run = mysqli_fetch_array($sqlLoadiamge)){
            							    echo '<img src="admin/uploads/'.$sqlLoadiamge_run['rating_images'].'" alt="Comment Images" style="width: 70px">';
            						    }
            						}
            					?>
        					</div>
                        </div>
                    </div>
					<div class="popup-image">
                            <span>&times;</span>
                            <img id="img" src="admin/uploads/<?= $sql_run4['image']; ?>">
                        </div>
                    <hr>
                    <?php } 
                    
                        $sqlimages = mysqli_query($conn, "SELECT * FROM destination_ratings WHERE destination_id='$myiddd' AND status='1'");
                        $count = mysqli_num_rows($sqlimages);
                        $a = $count / 10;
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
    </div>
    <!-- Footer Start -->
    <?php include 'footer.php' ?>
    <!-- Footer End -->

    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    <script>
        document.querySelectorAll('.image=review img').forEach(image =>{
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
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <!-- Template Javascript -->
    <script src="js/main.js"></script>
    <script>
        $(document).ready(function(){

            var rating_data = 1;

            $('#add_review').click(function(){

                $('#review_modal').modal('show');

            });

            $(document).on('mouseenter', '.submit_star', function(){

                var rating = $(this).data('rating');

                reset_background();

                for(var count = 1; count <= rating; count++)
                {

                    $('#submit_star_'+count).addClass('text-primary');

                }

    });

    function reset_background()
        {
            for(var count = 2; count <= 5; count++)
            {

                $('#submit_star_'+count).addClass('star-light');

                $('#submit_star_'+count).removeClass('text-primary');

            }
    }

        $(document).on('mouseleave', '.submit_star', function(){

            reset_background();

            for(var count = 1; count <= rating_data; count++)
            {

                $('#submit_star_'+count).removeClass('star-light');

                $('#submit_star_'+count).addClass('text-primary');
            }

    });

    $(document).on('click', '.submit_star', function(){

        rating_data = $(this).data('rating');

    });

        $('#save_review').click(function(){
            var user_name = $('#user_name').val();

            var destination_name = $('#destination_name').val();
            
            var user_review = $('#user_review').val();
            // var image_review = $("image_review").files;
            // const file = fileInput.files[0];
            var code = "<?php echo $code; ?>";

            if(user_name == '')
            {
                alert("Please you need to login first");
                window.location.href = 'loginForm.php';
                return false;
            }
            else
            {
                $.ajax({
                    url:"load_review.php",
                    type:"POST",
                    data:{rating_data:rating_data, user_name:user_name, destination_name:destination_name, user_review:user_review},
                    success:function(data)
                    {
                        $('#review_modal').modal('hide');

                        // load_rating_data(data);

                        // alert(data);
                         window.location.href = "rating_review.php?on=" + encodeURIComponent(code);
                    }
                })
            }

    });

});

</script>
</body>

</html>