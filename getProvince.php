<?php
	include 'db.php';
	$pid=$_POST["region_id"];
	$result = mysqli_query($conn,"SELECT * FROM province WHERE region_id='$pid'");
    $output='';
    
    echo '<option value disabled selected>Select Province</option>';
    
while($row = mysqli_fetch_array($result)) {
	
    $output .='
    
        <option value='. $row['id'] . '>'. $row['province'] .'</option>
        ';
    }
        echo $output;

?>

