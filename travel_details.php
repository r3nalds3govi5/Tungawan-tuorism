<?php
    require('db.php');
    require('auth.php');
    
    $code=$_GET['print'];
    $typequery = mysqli_query($conn,"SELECT * FROM booking WHERE booking_id='$code'");
    while($typedata = mysqli_fetch_array($typequery)){ 

        $myidd=$typedata['destination'];    
        $select1 = "SELECT * FROM destination WHERE destination_id='$myidd'";
        $query1 = mysqli_query($conn, $select1);
        $query1 = mysqli_fetch_array($query1);
        
        $booking = $typedata['booking_id'];
        $destination = $query1['destination'];
        $location = $query1['location'];
        $travelDate =date('F d, Y', strtotime($typedata['travel_dates']));

        $myid=$typedata['tourist'];    
        $select = "SELECT * FROM tourist WHERE tourist_id='$myid'";
        $query = mysqli_query($conn, $select);
        $query = mysqli_fetch_array($query);

        $lname = $query['lastName'];
        $fname = $query['firstName'];
        $mobile = $query['mobile'];
        $email = $query['email'];

}


    require_once('TCPDF-main/tcpdf.php');

    class PDF extends TCPDF{
    public function Header(){
        $imageFile = K_PATH_IMAGES. 'logo.png';
        $this->Image($imageFile, 43, 4, 24, '','PNG', '', 'C', false, 600, '', false, false,
        0, false, false, false);
        $this->Ln(8);
        $this->SetFont('helvetica', 'B', 6);
        $this->Cell(80,1,'TUNGAWAN TOURISM',0,1,'C');
        $this->SetFont('helvetica', '', 5);
        $this->Cell(80,1,'Libertad, Tungawan, Zamboanga Sibugay',0,1,'C');
        // $this->Cell(80,1,'Reg. Pag. No. 9520-09003311/Tel. No. 333-2596',0,1,'C');
        $this->Ln(5);
        $this->SetFont('helvetica', 'B', 8);
        $this->Cell(80,1,'TRAVEL DETAILS',0,1,'C');
        $this->Ln(2);
        $this->SetFont('helvetica', 'B', 8);
        $this->Cell(80,1,'__________________________________________________',0,1,'L');


    }
    public function Footer(){
        $this->SetY(-10);
        
        $this->SetFont('helvetica', 'I', 6);
        date_default_timezone_set("Asia/Dhaka");
        $today = date("F j, Y/ g:i A", time());
        
        $this->Cell(10,5, 'Generation Date/Time: '.$today,0,0,'L');
        $this->Cell(70,5, 'Page '.$this->getAliasNumPage().' of '.$this->getAliasNbPages(),0,false, 'R', 0, '', 0, false, 'T', 'M');


        }
    }
    // create new PDF document
    $pdf = new PDF('p', 'mm', 'A6', true, 'UTF-8', false);
    // $pdf->SetProtection(['print', 'copy'], '', null, 2, null);
    // $pdf->SetAutoPageBreak(true, 10);
    // $pdf->AddPage();

    // set header and footer fonts
    $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
    $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
    
    // set default monospaced font
    $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
    
    // set margins
    $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
    $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
    
    // set auto page breaks
    $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
    
    // set image scale factor
    $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
    
    // set some language-dependent strings (optional)
    if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
        require_once(dirname(__FILE__).'/lang/eng.php');
        $pdf->setLanguageArray($l);
    }
    
    // set default font subsetting mode
    $pdf->setFontSubsetting(true);
    
    // Set font
    // dejavusans is a UTF-8 Unicode font, if you only need to
    // print standard ASCII chars, you can use core fonts like
    // helvetica or times to reduce file size.
    $pdf->SetFont('dejavusans', '', 14, '', true);
    
    // Add a page
    // This method has several options, check the source code documentation for more information.
    $pdf->AddPage();
    $pdf->Ln(8);
    $pdf->SetFont('helvetica', '', 6);
    $pdf->Cell(80,1,'TOURIST: ' .$lname.', '.$fname,0,1,'L');
    $pdf->Ln(1);
    
    $pdf->Cell(80,1,'Mobile: '.$mobile,0,1);
    $pdf->Ln(1);
    $pdf->Cell(80,1,'Email: '.$email,0,1);
    
    $pdf->Ln(2);
    $pdf->SetFont('helvetica', '', 8);
    $pdf->Cell(80,1,'__________________________________________________',0,1,'L');
    
    $pdf->Ln(5);
    $pdf->SetFont('helvetica', '', 6);
    $pdf->Cell(80,1,'Booking ID: '.$booking,0,1);
    $pdf->Ln(1);
    $pdf->Cell(80,1,'Destination: '.$destination,0,1);
    $pdf->Ln(1);
    $pdf->Cell(80,1,'Travel Date: '.$travelDate,0,1);
    $pdf->Ln(1);
    $pdf->Cell(80,1,'Location: '.$location,0,1);

    
    
    $pdf->Ln(2);
    $pdf->SetFont('helvetica', '', 8);
    $pdf->Cell(80,1,'__________________________________________________',0,1,'L');

    
    // Close and output PDF document
    // This method has several options, check the source code documentation for more information.
    $pdf->Output('membership_form.pdf', 'I');