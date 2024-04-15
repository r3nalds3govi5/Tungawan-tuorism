<?php
	include 'db.php';
	$pid=$_POST["destination_id"];
	$result = mysqli_query($conn,"SELECT * FROM tour_package WHERE destination='$pid'");
    $output='';
    
    echo '<option value ="N/A">N/A</option>';
    
        while($row = mysqli_fetch_array($result)) {
	
    $output .='
    
        <option value='. $row['package_id'] . '>'. $row['package'] .'</option>
        ';
    }
        echo $output;

?>

