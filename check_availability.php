<?php
    include('db.php'); // Include your database connection script
    
    $spotId = $_POST['destination']; // Replace with the actual tourist spot ID
    $date = $_POST['travel_date'];
    
    $sql = "SELECT * FROM booking WHERE destination_id = $spotId AND travel_dates = '$date'";
    $result = mysqli_query($conn, $sql);
    
    if (mysqli_num_rows($result) == 0) {
        echo 'available';
    } else {
        echo 'unavailable';
    }
?>
