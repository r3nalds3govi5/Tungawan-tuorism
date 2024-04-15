
<?php
    session_start();
    unset($_SESSION["loginid"]);
    unset($_SESSION["email"]);
    header("Location:index.php");
?>