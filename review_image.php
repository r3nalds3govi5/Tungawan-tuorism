<?php
    session_start();
    include 'db.php';
    
    if (isset($_POST["save_review"])) {
        $code=$_POST['user_name'];
        $des=$_POST['destination_name'];
        
        $file = rand(1000,100000)."-".$_FILES['image_review']['name'];
        $file_loc = $_FILES['image_review']['tmp_name'];
        $file_size = $_FILES['image_review']['size'];
        $file_type = $_FILES['image_review']['type'];
        $folder="uploads/";
    
        $new_size = $file_size/1024;
        $new_file_name = strtolower($file); 
        $final_file=str_replace(' ','-',$new_file_name);
        move_uploaded_file($file_loc,$folder.$final_file);
        
        $sql = "INSERT INTO destination_ratings(tourist_id, destination_id,rating_images) VALUES ('$code', '$des', '$new_file_name')";
        $result=mysqli_query($connect,$sql);
    }
        
?>