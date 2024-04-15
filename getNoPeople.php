<?php
	include 'db.php';
	$pid=$_POST["package_id"];
	$result = mysqli_query($conn,"SELECT * FROM tour_package WHERE package_id='$pid'");
    $output='';
    
    // echo '<option value ="N/A">N/A</option>';
    
        while($row = mysqli_fetch_array($result)) {
	
    $output .='
    
        <input type="number" id="No_Adult" name="No_Adult" value='. $row['number_person'] . ' required />';
    }
        echo $output;

?>

