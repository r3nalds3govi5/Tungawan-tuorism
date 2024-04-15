<div class="container-fluid position-relative p-0">
        <nav class="navbar navbar-expand-lg navbar-light px-4 px-lg-5 py-3 py-lg-0">
            <a href="index.php" class="navbar-brand p-0">
                <h6 class="text-primary m-0"><i class="fa fa-map-marker-alt me-2"></i>Tungawan Tourism</h6>
                <!-- <img src="img/logo.png" alt="Logo"> -->
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="fa fa-bars"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav ms-auto py-0">
                    <a href="index.php" class="nav-item nav-link active">Home</a>
                    <a href="about.php" class="nav-item nav-link">About</a>
                    <a href="service.php" class="nav-item nav-link">Services</a>
                    <a href="package.php" class="nav-item nav-link">Packages</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Bookings & Reviews</a>
                        <div class="dropdown-menu m-0">
                            <a href="booking.php" class="dropdown-item">Booking</a>
                            <a href="testimonial.php" class="dropdown-item">Reviews</a>
                        </div>
                    </div>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Accommodation, Foods & Destination</a>
                        <div class="dropdown-menu">
                            <a href="javascript:;" class="dropdown-item">Accommodation</a>
                            <a href="javascript:;" class="dropdown-item">Foods & Cafes</a>
                            <a href="destination.php" class="dropdown-item">Destination</a>
                        </div>
                    </div>
                    <a href="contact.php" class="nav-item nav-link">Contact</a>
                </div>
                <a href="loginForm.php" class="btn btn-primary rounded-pill py-2 px-4">Login</a>
            </div>
        </nav>

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