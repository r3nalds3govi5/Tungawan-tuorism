<div class="container-fluid bg-dark text-light footer pt-5 mt-5 wow fadeIn" data-wow-delay="0.1s">
    <div class="container py-5">
        <div class="row g-5">
            <div class="col-lg-3 col-md-6">
                <h5 class="text-white mb-3">Company</h5>
                <a class="btn btn-link" href="about.php">About Us</a>
                <a class="btn btn-link" href="javascript:;">Contact Us</a>
                <a class="btn btn-link" href="javascript:;">Privacy Policy</a>
                <a class="btn btn-link" href="javascript:;">Terms & Condition</a>
                <a class="btn btn-link" href="javascript:;">FAQs & Help</a>
            </div>
            <div class="col-lg-5 col-md-6">
                <h5 class="text-white mb-3">Contact</h5>
                <p class="mb-2"><i class="fa fa-map-marker-alt me-1"></i><a href="https://goo.gl/maps/hFG2ipkcxZ4Pic5M7" class="text-white" target="_blank"></i>Tungawan, Zamboanga Sibugay, 7018</a></p>
                <p class="mb-2"><i class="fa fa-phone-alt me-1"></i>+63 (997) 472-5677 (TM) +63 (960) 328-8425 (SMART)</p>
                <p class="mb-2"><i class="fa fa-envelope me-1"></i>tungawantourismoffice@gmail.com</p>
                <!--<div class="d-flex pt-2">-->
                <!--    <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-twitter"></i></a>-->
                <!--    <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-facebook-f"></i></a>-->
                <!--    <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-youtube"></i></a>-->
                <!--    <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-linkedin-in"></i></a>-->
                <!--</div>-->
            </div>
            <div class="col-lg-4 col-md-6">
                <h5 class="text-white mb-3">Gallery</h5>
                <div class="row g-2 pt-2">
                    <?php
                        $sql = mysqli_query($conn, "SELECT * FROM destination WHERE status = 1 AND category != 5 & 4 ORDER BY RAND() LIMIT 6");
                        while($sqlLoad = mysqli_fetch_assoc($sql)){
                    ?>
                        <div class="col-4">
                            <img class="img-fluid bg-light p-1" src="admin/uploads/<?= $sqlLoad['image']; ?>" alt="" style="height: 10vh !important">
                        </div>
                    <?php } ?>
                </div>
            </div>
            <!-- <div class="col-lg-3 col-md-6">
                <h5 class="text-white mb-3">Newsletter</h5>
                <p>Dolor amet sit justo amet elitr clita ipsum elitr est.</p>
                <div class="position-relative mx-auto" style="max-width: 400px;">
                    <input class="form-control border-primary w-100 py-3 ps-4 pe-5" type="text" placeholder="Your email">
                    <button type="button" class="btn btn-primary py-2 position-absolute top-0 end-0 mt-2 me-2">SignUp</button>
                </div>
            </div> -->
        </div>
    </div>
    <div class="container">
        <div class="copyright">
            <div class="row">
                <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                    &copy; <a class="border-bottom" href="javascript:;">Tungawan Tourism</a>, All Right Reserved.

                    Designed By <a class="border-bottom" href="javascript:;">BSCS IV Students</a>
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <div class="footer-menu">
                        <a href="index.php">Home</a>
                        <a href="javascript:;">Cookies</a>
                        <a href="javascript:;">Help</a>
                        <a href="javascript:;">FQAs</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>