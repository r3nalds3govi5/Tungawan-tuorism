<?php

    include 'db.php';
   
    if (isset($_GET['delete'])) {
        $get_id = $_GET['delete'];
        
        $sql = $conn->query("SELECT * FROM destination_ratings WHERE id='$get_id'");
        $sql_run = $sql->fetch_array();
        
        // Use prepared statement to avoid SQL injection
        $stmt = $conn->prepare("DELETE FROM destination_ratings WHERE id = ?");
        $stmt->bind_param("i", $get_id);
        $stmt->execute();
        
        // Redirect after deletion
        header("Location: rating_review.php?on=$sql_run[destination_id]");
    }
    
?>