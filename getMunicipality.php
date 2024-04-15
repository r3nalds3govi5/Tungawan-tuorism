<?php
	include 'db.php';
	$pid=$_POST["province_id"];
	$result = mysqli_query($conn,"SELECT * FROM municipality WHERE province_ID='$pid'");
    $output='';
    
    echo '<option value disabled selected>Select Municipality</option>';
    
while($row = mysqli_fetch_array($result)) {
	
    $output .='
    
        <option value='. $row['id'] . '>'. $row['municipality'] .'</option>
        ';
    }
        echo $output;

?>

