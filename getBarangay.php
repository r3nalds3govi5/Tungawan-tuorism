<?php
	include 'db.php';
	$pid=$_POST["municipality_id"];
	$result = mysqli_query($conn,"SELECT * FROM barangay WHERE municipal_ID='$pid'");
    $output='';
    
	echo '<option value disabled selected>Select Barangay</option>';

while($row = mysqli_fetch_array($result)) {
	
    $output .='
    
		<option value='. $row['id'] . '>'. $row['barangay'] .'</option>
        ';
    }
        echo $output;
?>

