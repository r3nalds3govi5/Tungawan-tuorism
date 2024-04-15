<?php
    session_start();
    $connect = new PDO("mysql:host=localhost;dbname=tungtkzf_tzst", "tungtkzf_tzst", "8nVF{s1PEv@q");
    date_default_timezone_set('Asia/Manila');
    $petsa = date("Y-m-d");
    
    if (isset($_POST["rating_data"])) {
        $data = array(
            ':user_name'        => $_POST["user_name"],
            ':user_rating'      => $_POST["rating_data"],
            ':user_review'      => $_POST["user_review"],
            ':destination_name' => $_POST["destination_name"],
            ':datetime'         => $petsa
        );

        $query = "
            INSERT INTO destination_ratings 
            (tourist_id, destination_id, ratings, review, status, date_entry) 
            VALUES (:user_name, :destination_name, :user_rating, :user_review, '1', :datetime)
        ";

        $statement = $connect->prepare($query);

        $statement->execute($data);
        
        echo "Your Review & Rating Successfully Submitted";

    }
    
?>
