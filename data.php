<?php
require('db.php');
$start = $_POST['starting']; 
$per_page = 9;


$sql = "SELECT * FROM destination WHERE status = 1 LIMIT $start, $per_page";
$result = mysqli_query($conn, $sql);

$output = '';

while ($data = mysqli_fetch_array($result)) 
{
    $output .= '<div class="col-lg-4 col-md-12 wow zoomIn" data-wow-delay="0.1s">
            <a class="position-relative d-block overflow-hidden" href="destination_details.php?on=' .$data['destination_id']. '">
                <img class="img-fluid" src="admin/uploads/' .$data['image']. '" alt="">
                <div class="bg-white text-primary fw-bold position-absolute bottom-0 end-0 m-3 py-1 px-2"><i class="fa fa-map-marker-alt me-1"></i>' .$data['destination']. '</div>
            </a>
        </div>';
}
echo $output;
?>