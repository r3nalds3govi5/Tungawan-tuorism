<?php 
    session_start();
    require('db.php');
    if(!isset($_SESSION['loginid']) || (trim($_SESSION['loginid']) == '')){
        header("location: loginForm.php.php");
        exit();
    }
        date_default_timezone_set('Asia/Manila');
        $petsa=date("Y-m-d");
        
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["travel_date"])) {
        $code = $_POST['codex'];
        $destination = $_POST['destination'];
        $package = $_POST['package'];
        $noAdult = $_POST['No_Adult'];
        $noChildren = $_POST['No_Children'];
        $message = $_POST['message'];
        $dateTravel = $_POST['travel_date'];

        $destsearch = mysqli_query($conn,"SELECT * FROM `booking` ORDER BY seq DESC");
        $destsearch_run=mysqli_fetch_array($destsearch);

        $dateString = date('Ymd');
        $type = 'BID';
        $destIDNumber = $destsearch_run['seq'];

        if($destIDNumber < 9999) {
            $destIDNumber = $destIDNumber + 1;
        }else{
        $destIDNumber = 1;
        } 
        $destNumber = $type . '' . $dateString . '-' . $destIDNumber;

        $xblocker1 = mysqli_query($conn,"SELECT * FROM booking WHERE tourist='$code'");
        $counter1 = mysqli_fetch_array($xblocker1);
        $mydatetravel=$counter1['travel_dates'];
        
        if($dateTravel == $mydatetravel){
            $_SESSION['duplicate']="You already have travel plans on that date. Please choose another date.";
            header("Location: booking.php");
            exit();
        }
        
        $xblocker2 = mysqli_query($conn,"SELECT * FROM set_holidays WHERE destination_id='$destination'");
        $counter2 = mysqli_fetch_array($xblocker2);
        $spot = $counter2['destination_id'];
        $holidays = $counter2['holidays'];
        
        if($destination == $spot & $dateTravel == $holidays){
            $_SESSION['duplicate']="This destination is not available on this date. Please select another date.";
            header("Location: booking.php");
            exit();
        }
        
        $xblocker = mysqli_query($conn,"SELECT * FROM booking WHERE tourist='$code' AND destination='$destination' AND package='$package' AND travel_dates='$dateTravel'");
        $counter = mysqli_num_rows($xblocker);
        
        if ($counter <=0){
            $sql = "INSERT INTO booking(seq, booking_id, package, destination, tourist, No_Adult, No_Children, message, travel_dates, status, date_entry) 
            VALUES('$destIDNumber', '$destNumber','$package', '$destination', '$code', '$noAdult', '$noChildren', '$message', '$dateTravel', '0', '$petsa')";
            $result = mysqli_query($conn, $sql);
                if($result){
                    $_SESSION['message']="New booking has been save.";
                    header("Location: booking.php");
                }else{
                    die('Query failed');
                }
            }else{
                $_SESSION['duplicate']="This booking is already in the database.";
                header("Location: booking.php");
            }
    }

?>