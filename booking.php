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
                        <p class="mb-4">Kindly be advised that the indicated amount for each tourist destination serves as an approximation and is subject to change based on various circumstances. </p>
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
                                
                                <?php } 
                                    
                                    if(!isset($_GET['on']) || (trim($_GET['on']) == '')) {
                                    
                                ?>
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <select name="destination" class="form-select bg-transparent" id="select1" onchange="getPackage(this.value)" required />
                                                <option value disabled selected>Select a Destination</option>
                                                    <?php 
                                                        $destination = mysqli_query($conn,"SELECT * FROM destination WHERE status = 1 AND category != 4 AND category != 5 AND category != 3");
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
                                            <input name="No_Adult" type="number" min="0" value="1" class="form-control bg-transparent" id="No_Adult" required/>
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
                                    $sqlBooking = $conn->query("SELECT * FROM tour_package WHERE id='$code'");
                                    $sqlBooking_run = $sqlBooking->fetch_array();

                                    $sqlDestination = $conn->query("SELECT * FROM destination WHERE destination_id='$sqlBooking_run[destination]'");
                                    $sqlDestination_run = $sqlDestination->fetch_array();
                                    
                                    $sqlInclusion = $conn->query("SELECT * FROM inclusion WHERE package_id='" . $sqlBooking_run['package_id'] . "'");
                                    $sqlInclusion_run = $sqlInclusion->num_rows;
                                ?>

                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input name="destination" type="hidden" class="form-control bg-transparent" value="<?= $sqlBooking_run['destination']; ?>" readonly />
                                            <input type="text" class="form-control bg-transparent" value="<?= $sqlDestination_run['destination']; ?>" readonly>
                                            <label for="lastName">Destination</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input name="package" type="hidden" class="form-control bg-transparent" value="<?= $sqlBooking_run['package_id']; ?>" readonly />
                                            <input type="text" class="form-control bg-transparent" value="<?= $sqlBooking_run['package']; ?>" readonly />
                                            <label for="lastName">Package</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-floating">
                                            <input name="No_Adult" id="No_Adult" type="number" value="<?= $sqlBooking_run['number_person']; ?>" min='<?= $sqlBooking_run['number_person']; ?>'  class="form-control bg-transparent" id="No_Adult" required />
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
                                            $typequery = mysqli_query($conn,"SELECT * FROM terms_condition WHERE type='booking'");
                                            $typedata = mysqli_fetch_array($typequery);
                                        ?>
                                            <input  type="checkbox" class="chk" name="terms" autocomplete="off" id="check"  required /> 
                                            <label for="check"> I agree with the <a href="../admin/uploads/<?php echo $typedata['terms_condition']; ?>" target="_blank"> Terms and condition</a></label>
                                    </div>
                                    <p id="availabilityMessage"></p>
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
    <!-- Description -->
    <div class="container-xxl py-5 destination" >
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-12 wow fadeInUp" data-wow-delay="0.3s">
                    <h4 class="bg-white text-primary pe-3">Description</h4>
                    <p class="mb-1" style="text-align:justify">&nbsp;&nbsp;&nbsp;&nbsp;
                        <?= $sqlBooking_run['description']; ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Itinerary -->
    <?php if($sqlBooking_run['itinerary'] !='') { ?>
        <div class="container-xxl py-5 destination" >
            <div class="container">
                <div class="row g-5">
                    <div class="col-lg-12 wow fadeInUp" data-wow-delay="0.3s">
                        <h4 class="bg-white text-primary pe-3">Itinerary</h4>
                        <p class="mb-1" style="text-align:justify">&nbsp;&nbsp;&nbsp;&nbsp;
                            <?= $sqlBooking_run['itinerary']; ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
    
    <!-- Includes -->
    <?php if ($sqlInclusion_run > 0) { ?>
        <div class="container-xxl py-5 destination" >
            <div class="container">
                <div class="row g-5">
                    <div class="col-lg-12 wow fadeInUp" data-wow-delay="0.3s">
                        <h4 class="bg-white text-primary pe-3">Includes</h4>
                        <ul>
                            <?php
                                $sql = mysqli_query($conn, "SELECT * FROM inclusion WHERE package_id='$sqlBooking_run[package_id]' AND status='1'");
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
    <?php if ($sqlDestination_run['pen_location'] !=''){ ?>
        <div class="container-xxl py-5 destination" >
            <div class="container">
                <div class="row g-5">
                    <div class="col-lg-12 wow fadeInUp" data-wow-delay="0.3s">
                        <h4 class="bg-white text-primary pe-3">Location</h4>
                        <div class="position-relative h-100">
                            <iframe src="<?= $sqlDestination_run['pen_location']; ?>" 
                                    width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                            </iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
    
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

    <script>
        // var today = new Date().toISOString().split('T')[0];
        // document.getElementById("travel_date").setAttribute("min", today);
        document.addEventListener('DOMContentLoaded', function () {
            // Get the date input element
            var dateInput = document.getElementById('travel_date');
        
            // Set the minimum date to the current date
            dateInput.min = currentDate;
        
            // Optional: You can add an event listener to restrict date selection further
            dateInput.addEventListener('change', function () {
                var selectedDate = new Date(dateInput.value);
                var today = new Date(currentDate);
        
                // Check if the selected date is in the past
                if (selectedDate < today) {
                    alert('Please select a future date.');
                    dateInput.value = ''; // Reset the date input
                }
            });
        });

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