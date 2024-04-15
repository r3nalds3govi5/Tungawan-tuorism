<?php
    // Assuming you have a database connection
    include('db.php');
    
    // Function to check availability
    function isAvailable($spotId, $date, $conn) {
        $sql = "SELECT * FROM booking WHERE destination_id = $spotId AND travel_dates = '$date'";
        $result = mysqli_query($conn, $sql);
    
        return mysqli_num_rows($result) == 0; // Returns true if no bookings for that date
    }
?>
