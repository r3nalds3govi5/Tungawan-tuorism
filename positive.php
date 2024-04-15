<nav class='navbar navbar-expand-lg navbar-light px-4 px-lg-5 py-3 py-lg-0'>
    <a href="index.php" class="navbar-brand p-0">
        <img src="admin/uploads/logo.png"> 
        <!--<h6 class="text-primary m-0"><i class="fa fa-map-marker-alt me-2"></i>Tungawan Tourism</h6>-->
    </a> 

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
        <span class="fa fa-bars"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarCollapse">
        <div class="navbar-nav ms-auto py-0">
            <a href="index.php" class="nav-item nav-link">Home</a>
            <!-- <a href="about.php" class="nav-item nav-link">About</a> -->
            <a href="package.php" class="nav-item nav-link">Packages</a>
            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Bookings & Reviews</a>
                <div class="dropdown-menu m-0">
                    <a href="booking_places.php" class="dropdown-item">Booking</a>
                    <a href="testimonial.php" class="dropdown-item">Reviews</a>
                    <!--<a href="reviews_ratings.php" class="dropdown-item">Reviews</a>-->
                </div>
            </div>
            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Explore Tungawan</a>
                <div class="dropdown-menu">
                    <a href="nature.php" class="dropdown-item">Nature</a>
                    <a href="sun_beach.php" class="dropdown-item">Sun & Beach</a>
                    <a href="adventure.php" class="dropdown-item">Adventure</a>
                    <a href="food_hospitality.php" class="dropdown-item">Food & Hospitality</a> 
                    <a href="event_culture.php" class="dropdown-item">Event & Culture</a>
                    <a href="all.php" class="dropdown-item">See All</a>
                </div>
            </div>
            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Newsroom & Media</a>
                <div class="dropdown-menu">
                    <a href="latestupdate.php" class="dropdown-item">News & Updates</a>
                    <a href="announcement.php" class="dropdown-item">Announcement</a>
                </div>
            </div>
            <div class="nav-item dropdown">
                <?php
                    $sqlNotif = mysqli_query($conn, "SELECT * FROM notif WHERE tourist_id='$data1[tourist_id]' AND seen_status='0'");
                    $sqlNotif1 = mysqli_fetch_array($sqlNotif);
                    $sqlNotif_run = mysqli_num_rows($sqlNotif);
                ?>
                <a href="notification.php" class="nav-link"><i class="bi bi-bell me-1"></i>(<?= $sqlNotif_run; ?>)</a>
                <?php if($sqlNotif_run > 0){ ?>
                <div class="dropdown-menu" style="width: 150px !important; padding-left: 13px">
                <a href="notification.php" class=""><?= $sqlNotif1['caption']; ?></a>
                </div>
                <?php } ?>
            </div>

            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown" style="text-transform: capitalize"><i class="fa fa-user-circle" aria-hidden="true"></i>
                    <?= $data1['firstName'].' '.$data1['lastName']; ?>
                </a>
                <div class="dropdown-menu">
                    <a href="profile.php" class="dropdown-item">Profile</a>
                    <a href="mybooking.php" class="dropdown-item">My Booking</a>
                    <!-- <a href="notification.php" class="dropdown-item">Notification <span style="background-color: #3CAEA3; color: #fff; padding: 1px; border-radius: 6px; font-size: 12px">(<?= $sqlNotif_run; ?>)</span></a> -->
                    <a href="logout.php" class="dropdown-item">Logout</a>
                </div>
            </div>
        </div>
    </div>
</nav>