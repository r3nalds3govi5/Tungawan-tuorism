<?php
    include "assets/db.php";
    
    $reviews_count = reviews_count();
    $reviews_images_count = reviews_images_count();
    $images_reviews = images_reviews();
    $ratings_reviews = ratings_reviews('0');
    $has_user_already_rated = has_user_already_rated();
    $rating_avg = rating_avg();
    $customer_reviews_card = customer_reviews_card();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rating & Reviews System Using PHP Bootstrap Ajax & Jquery - Jamsrworld.com</title>
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="assets/css/swiper.css">
    <link rel="stylesheet" href="assets/css/sweetalert.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <div class="row m-0 g-0 m-lg-5">
        <div class="col-lg-4">
            <div class="card mb-2">
                <div class="card-header align-justify-between">
                    <h4 class="card-title">Customer Reviews</h4>
                    <span class="text-right font-normal"><?php echo $rating_avg; ?> out of 5</span>
                </div>
                <div id="customer_reviews_card" class="card-body">
                    <?php echo $customer_reviews_card; ?>
                </div>
            </div>
        </div>

        <div class="col-lg-8 ">
            <?php if (!has_user_already_rated()) {
            ?>

            <?php
            }
            ?>

            <div id="review_form_card" class="display-none card mb-2">

            </div>
            <!--  -->




            <!--  -->
            <div class="card">
                <div style="padding: .2rem 1rem;" class="card-header align-justify-between">
                    <h4 class="card-title">Ratings & Reviews (<span class="reviews-count"><?php echo $reviews_count; ?></span>) </h4>
                    <button id="add_review" class="m-0 btn-sm btn-secondary btn-sm btn">Rate & Review</button>
                </div>
                <div>
                    <div id="reviews_images_container" class="card-body">
                        <h6>User Images (<span class="reviews-images-count"><?php echo $reviews_images_count; ?></span>) </h6>
                        <div class="gallery-container">
                            <?php echo $images_reviews; ?>
                        </div>
                    </div>
                    <div id="rating_container">
                        <?php echo $ratings_reviews; ?>
                    </div>
                </div>
            </div>
            <!--  -->
        </div>
    </div>

    <!-- Login MOdal START  -->
    <div class="modal fade" id="login_modal" tabindex="-1" role="dialog" aria-labelledby="addnotesmodalTitle" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content border-0">
                <div class="modal-header bg-info text-white">
                    <h5 class="modal-title text-white">Creawte account</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="notes-box">
                        <div class="notes-content">
                            <form id="login_form">
                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <label>First Name</label>
                                        <input maxlength="15" required="" name="first_name" type="text" class="form-control" placeholder="First name">
                                    </div>
                                    
                                    <div class="col-md-12 mb-3">
                                        <label>Last Name</label>
                                        <input maxlength="15" required="" name="last_name" type="text" class="form-control" placeholder="Last name">
                                    </div>

                                    <div class="col-md-12 mb-3">
                                        <label>User Email</label>
                                        <input required="" name="user_email" type="email" class="form-control" placeholder="Email">
                                    </div>

                                    <div class="col-md-12 mb-3">
                                        <label>Password</label>
                                        <input required="" name="user_password" type="password" class="form-control" placeholder="**********">
                                    </div>

                                    <div class="col-lg-12">
                                        <button class="float-right btn btn-secondary">Login</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Login MOdal END  -->

    <!-- Modal -->
    <div id="modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

        <div style="max-width: 850px;" class="w-100 modal-dialog" role="document">
            <div style="background:transparent !important;" id="modal_content" class="modal-content">
            </div>
        </div>
    </div>


    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/popper.js"></script>
    <script src="assets/js/sweetalert.js"></script>
    <script src="assets/js/bootstrap.js"></script>
    <script src="assets/js/script.js"></script>

</body>

</html>