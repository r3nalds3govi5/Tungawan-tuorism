<?php
	//Start session
	session_start();
	
	//Check whether the session variable SESS_MEMBER_ID is present or not
    if(!isset($_SESSION['loginid']) || (trim($_SESSION['loginid']) == '')) {
    
        $statushere='negative';
    }else{
        
        $statushere='positive';
    }

?>