<?php
    $conn= new mysqli('localhost','tungtkzf_tzst','8nVF{s1PEv@q','tungtkzf_tzst')or die("Could not connect to mysql".mysqli_error($conn));
    
    date_default_timezone_set("Asia/Manila");
    $base_url = "https://tungawantourism.com/public_html";
    $current_date = strtotime(date("d-m-Y H:i:s"));
    $users_tbl = 'users';
    $reviews_tbl = 'reviews';
    $images_tbl = 'images';
    $rating_vote_tbl = 'rating_like_dislike';
?>