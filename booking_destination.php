<?php
    require('db.php');
    require('auth.php');
    
    if(!isset($_SESSION['loginid']) || (trim($_SESSION['loginid']) == '')){
        header("location: loginForm.php");
        exit();
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
    <link rel="shortcut icon" href="admin/dist/img/logo.png">
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.min.css"/>
    
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

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

        <div class="container-fluid bg-primary py-5 hero-header-booking">
            <div class="container py-5">
                <div class="row justify-content-center py-5">
                    <div class="col-lg-10 pt-lg-5 mt-lg-5 text-center">
                        <h1 class="display-3 text-white animated slideInDown">Booking</h1>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb justify-content-center">
                                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                <li class="breadcrumb-item text-white active" aria-current="page">Booking</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Navbar & Hero End -->

    <!-- Booking Start -->
    <div class="container-xxl py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container">
            <div class="booking p-5">
                <div class="row g-5 align-items-center">
                    <div class="col-md-6 text-white">
                        <h6 class="text-white text-uppercase">About</h6>
                        <h1 class="text-white mb-4">Online Booking</h1>
                         <p class="mb-4">  <p class="mb-4">Kindly be advised that the indicated amount for each tourist destination serves as an approximation and is subject to change based on various circumstances. </p>
                        <p class="mb-4">To seek further clarification or obtain updated information, please reach out to the dedicated tourism officer at +63 (997) 472-5677 (TM) or +63 (960) 328-8425 (SMART). Alternatively, you may communicate via email at tungawantourismoffice@gmail.com. Your proactive engagement is appreciated.</p>
                        <!-- <a class="btn btn-outline-light py-3 px-5 mt-2" href="">Read More</a> -->
                    </div>
                    <div class="col-md-6">
                        <h1 class="text-white mb-4">Book A Destination</h1>
                        <form action="booking_exe.php" method="POST">
                            <input name="codex" type="hidden" class="form-control bg-transparent" id="codex" value="<?= $data1['tourist_id']; ?>"/>
                            <div class="row g-3">
                                <?php
                                    if(!isset($_SESSION['loginid']) || (trim($_SESSION['loginid']) == '')) {
                                ?>
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input name="firstname" type="text" class="form-control bg-transparent" id="firstName" placeholder="Your First Name" required />
                                            <label for="firstName">Your First Name</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input name="lastname" type="text" class="form-control bg-transparent" id="lastName" placeholder="Your Last Name" required />
                                            <label for="lastName">Your Last Name</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input name="mobile" type="number" class="form-control bg-transparent" min="0" id="mobile" placeholder="Your Mobile No." required />
                                            <label for="name">Your Mobile No.</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input name="email" type="email" class="form-control bg-transparent" id="email" placeholder="Your Email" required />
                                            <label for="email">Your Email</label>
                                        </div>
                                    </div>
                                    <!--<div class="col-md-6">-->
                                    <!--    <div class="form-floating">-->
                                    <!--        <input name="travel_date" type="date" class="form-control bg-transparent" id="travel_date" placeholder="Date" data-target="#date3" data-toggle="datetimepicker" required/>-->
                                    <!--        <label for="datetime">Date</label>-->
                                    <!--    </div>-->
                                    <!--</div>-->

                                <?php }else{ ?>

                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input name="firstname" type="text" class="form-control bg-transparent" value="<?= $data1['firstName']; ?>" id="firstName" readonly> 
                                            <label for="firstName">Your First Name</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input name="lastname" type="text" class="form-control bg-transparent" value="<?= $data1['lastName']; ?>" id="lastName" readonly>
                                            <label for="lastName">Your Last Name</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input name="mobile" type="number" class="form-control bg-transparent" value="<?= $data1['mobile']; ?>" min="0" id="mobile" readonly>
                                            <label for="name">Your Mobile No.</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input name="email" type="email" class="form-control bg-transparent" value="<?= $data1['email']; ?>" id="email" readonly>
                                            <label for="email">Your Email</label>
                                        </div>
                                    </div>
                                    <?php
                                        $code = $_GET['on'];
                                        $sqlDestinations = $conn->query("SELECT * FROM destination WHERE id='$code'");
                                        $sqlDestinations_run = $sqlDestinations->fetch_array();

                                        $takenDatesQuery = "SELECT holidays FROM set_holidays WHERE destination_id='$sqlDestinations_run[destination_id]'";
                                        $takenDatesResult = $conn->query($takenDatesQuery);
                                        
                                        $takenDates = [];
                                        while ($row = $takenDatesResult->fetch_assoc()) {
                                            $takenDates[] = $row['holidays'];
                                        }
                                    ?>
                                    <!--<div class="col-md-6">-->
                                    <!--    <div class="form-floating">-->
                                    <!--        <input name="travel_date" type="date" class="form-control bg-transparent" id="travel_date" placeholder="Date"  required />-->
                                    <!--        <label for="travel_date">Date</label>-->
                                    <!--    </div>-->
                                    <!--</div>-->
                                
                                <?php } 
                                    
                                    if(!isset($_GET['on']) || (trim($_GET['on']) == '')) {
                                    
                                ?>
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <select name="destination" class="form-select bg-transparent" id="select1" onchange="getPackage(this.value)" required />
                                                <option value disabled selected>Select a Destination</option>
                                                    <?php 
                                                        $destination = mysqli_query($conn,"SELECT * FROM destination WHERE status = 1 AND AND category != 4 AND category != 5 AND category != 3");
                                                        while($destination_run = mysqli_fetch_array($destination)){ 
                                                    ?>
                                                <option value="<?php echo $destination_run['destination_id'] ?>"><?php echo $destination_run['destination'] ?></option>
                                                    <?php } ?>
                                            </select>
                                            <label for="select1">Destination</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <select name="package" class="form-select bg-transparent" id="select2" onchange="getNoPeople(this.value)">
                                                <option value="N/A">N/A</option>
                                            </select>
                                            <label for="select2">Packages</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-floating">
                                            <input name="No_Adult" type="number" min="0" class="form-control bg-transparent" id="No_Adult" required/>
                                            <label for="No_Adult">No. of Adult</label>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-floating">
                                            <input name="No_Children" type="number" min="0" class="form-control bg-transparent" id="No_Children"/>
                                            <label for="No_Children">No. of Children</label>
                                        </div>
                                    </div>

                                <?php 
                                    } else { 
                                    $code = $_GET['on'];  
                                    $sqlDestination = $conn->query("SELECT * FROM destination WHERE id='$code'");
                                    $sqlDestination_run = $sqlDestination->fetch_array();

                                    $sqlBooking = $conn->query("SELECT * FROM tour_package WHERE destination='$sqlDestination_run[destination_id]'");
                                    $sqlBooking_run = $sqlBooking->fetch_array();

                                    $myid = $sqlDestination_run['destination_id'];
                                    $sql1 = $conn->query("SELECT * FROM destination_overview WHERE destination_id='$myid'");
                                    $sql_run1 = $sql1->fetch_array();
                                ?>

                                   <div class="col-md-6">
                                        <div class="form-floating">
                                            <input name="destination" type="hidden" class="form-control bg-transparent" value="<?= $sqlDestination_run['destination_id']; ?>" readonly />
                                            <input name="destinations" type="text" class="form-control bg-transparent" value="<?= $sqlDestination_run['destination']; ?>" readonly>
                                            <label for="lastName">Destination</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <select name="package" class="form-select bg-transparent" id="select1" onchange="getPackage(this.value)" required />
                                                <option value="N/A">N/A</option>
                                                    <?php 
                                                        $destination = mysqli_query($conn,"SELECT * FROM tour_package WHERE status = 1 AND destination = '$sqlDestination_run[destination_id]'");
                                                        while($destination_run = mysqli_fetch_array($destination)){ 
                                                    ?>
                                                <option value="<?php echo $destination_run['package_id'] ?>"><?php echo $destination_run['package'] ?></option>
                                                    <?php } ?>
                                            </select>
                                            <label for="lastName">Package</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-floating">
                                            <input name="No_Adult" id="No_Adult" type="number" value="1" min='1'  class="form-control bg-transparent" id="No_Adult" required />
                                            <label for="No_Adult">No. of Adult</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-floating">
                                            <input name="No_Children" type="number" min='0' class="form-control bg-transparent" id="No_Children" />
                                            <label for="No_Children">No. of Children</label>
                                        </div>
                                    </div>
                            <?php } ?>
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input name="travel_date" type="date" class="form-control bg-transparent" id="travel_date" placeholder="Date" required />
                                            <label for="travel_date">Date</label>
                                            <script>
                                                // Get current date from PHP and pass it to JavaScript
                                                var currentDate = "<?php echo date('Y-m-d'); ?>";
                                            </script>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-floating">
                                            <textarea name="message" class="form-control bg-transparent" placeholder="Message" id="message" style="height: 100px"></textarea>
                                            <label for="message">Message</label>
                                        </div>
                                    </div>
                                    <div class="wrappers">
                                        <?php
                                            $typequery = mysqli_query($conn,"SELECT * FROM terms_condition");
                                            $typedata = mysqli_fetch_array($typequery);
                                        ?>
                                            <input  type="checkbox" class="chk" name="terms" autocomplete="off" id="check"  required /> 
                                            <label for="check"> I agree with the <a href="../admin/uploads/<?php echo $typedata['terms_condition']; ?>" target="_blank"> Terms and condition</a></label>
                                    </div>
                                    <div class="col-12">
                                        <button name="submit" class="btn btn-outline-light w-100 py-3" type="submit">Book Now</button>
                                    </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <?php
        if($sql_run1['do']!='' || $sql_run1['dont']!='') {?>
            <div class="container-xxl py-5" >
                <div class="container">
                    <h5 class="text-primary"><i class="fa fa-thumbs-up"></i> Do's</h5>
                    <p class="">&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $sql_run1['do']; ?> </p>
                </div>
            </div>
            <div class="container-xxl py-5" >
                <div class="container">
                    <h5 class="text-primary"><i class="fa fa-thumbs-down"></i> Don't</h5>
                    <pstyle="text-align:justify">&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $sql_run1['dont']; ?></p>
                </div>
            </div>
    <?php  } ?>
    
    <?php
        if ($sqlDestinations_run['whentogo'] !='') { ?>
            <div class="container-xxl py-5" >
                <div class="container">
                    <h5 class="bg-white text-primary">When to go to <?= $sqlDestinations_run['destination']; ?></h5>
                    <div class="col-lg-12 wow fadeInUp" data-wow-delay="0.3s">
                        <p>&nbsp;&nbsp;&nbsp;&nbsp;<?= $sqlDestinations_run['whentogo']; ?></p>
                    </div>
                </div>
            </div>
    <?php } ?>
    
    <?php
        if ($sqlDestinations_run['category'] != 5) { ?>
            <div class="container-xxl py-5" >
                <div class="container">
                    <div class="row g-5">    
                        <div class="col-lg-12  wow fadeInUp" data-wow-delay="0.1s">
                            <h5 class="bg-white text-primary">Getting to <?= $sqlDestinations_run['destination']; ?></h5>
                            <div class="position-relative h-100">
                                <iframe src="<?= $sqlDestinations_run['pen_location']; ?>" 
                                    width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                                </iframe>
                            </div>
                        </div>
                        <div class="col-lg-12 wow fadeInUp" data-wow-delay="0.3s">
                            <p>Getting to <?= $sqlDestinations_run['destination']; ?> is easy with several transportation options available from the town.</p>
                            <p>Here’s how you can get to <?= $sqlDestinations_run['destination']; ?> from Tungawan bus terminal:</p>
                            <h6>From Tungawan IBT to <?= $sqlDestinations_run['location']; ?></h6>
                            <p>&nbsp;&nbsp;&nbsp;&nbsp;<?= $sqlDestinations_run['howtogetthere']; ?></p>
                        </div>
                    </div>
                </div>
            </div>
    <?php } ?>

    <!-- Footer Start -->
    <?php include 'footer.php' ?>
    <!-- Footer End -->

    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    <script>
        var today = new Date().toISOString().split('T')[0];
        document.getElementById("travel_date").setAttribute("min", today);
    </script>

    <script>
        $(document).ready(function() {
            var takenDates = <?php echo json_encode($takenDates); ?>;

            $("#travel_date").datepicker({
                beforeShowDay: function(date) {
                    var formattedDate = $.datepicker.formatDate("Y-m-d", date);
                    if ($.inArray(formattedDate, takenDates) != -1) {
                        return [false, "", "Date already taken"];
                    } else {
                        return [true, "", ""];
                    }
                }
            });
        });
    </script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    
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
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
    <script>
        <?php if(isset($_SESSION['message'])) { ?>
            alertify.set('notifier','position', 'top-right');
            alertify.success('<?= $_SESSION['message']; ?>');
        <?php 
            unset($_SESSION['message']);
            } 
        ?>
    </script>
    <script>
        <?php if(isset($_SESSION['duplicate'])) { ?>
            alertify.set('notifier','position', 'top-right');
            alertify.warning('<?= $_SESSION['duplicate']; ?>');
        <?php 
            unset($_SESSION['duplicate']);
            } 
        ?>
    </script>

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

    <script type="text/javascript">
        function getNoPeople(val) {
            $.ajax({
            url: "getNoPeople.php",
            type: "POST",
            data: 'package_id='+val,
            success: function(data){
            $("#No_Adult").html(data);
                }
            });
        };
    </script>
</body>
</html>