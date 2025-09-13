$pdf = new FPDF('P', 'mm', 'A4');

    $pdf->AddPage();

    // Header Title
    $pdf->Image('logo6.PNG', 10, 25, 40, 20); // Logo image at top left
    $pdf->SetXY(10, 10);
    $pdf->SetFont($fontFamilyConfigTable, 'B', 15);
    $pdf->Cell(0, 5, "TRIP SHEET", 0, 1, 'C');
    $pdf->Ln(2);

    // Draw Top Line
    $pdf->SetLineWidth(0.3);
    $pdf->Line(5, 20, 205, 20); // Adjusted length

    // Left Section: Address and Contact Info
    $pdf->SetFont($fontFamilyConfig, '', 11.5);
    $pdf->SetXY(50, 23);
    $pdf->MultiCell(100, 5, "No.199/3A, Tirupathi Road, Kakkavakkam Village,\nThandalam, Uthukottai Taluk, Tiruvallur Dist.\nTamilnadu - 601 102.\nMob: 72000 03097 / 72000 03098\nEmail: bcntravels99@gmail.com", 0, 'L');

    // Right Section: Duty Slip Info
    $pdf->SetXY(150, 25);
    $pdf->SetFont($fontFamilyConfig, '', 11.5);
    $pdf->Cell(50, 5, "Duty Slip No: ", 0, 1, 'L');
    $pdf->SetX(150);
    $pdf->Cell(50, 10, "Booking No: ", 0, 1, 'L');
    $pdf->SetX(150);
    $pdf->Cell(50, 10, "Date: .......................", 0, 1, 'L');

    // Draw Vertical Line Between Sections
    $pdf->Line(145, 20, 145, 50);

    // Bottom Line after Header
    $pdf->Line(5, 50, 205, 50);

    // Add Space Before Guest Details
    $pdf->Ln(8);

    // Table for Guest Details
    $pdf->SetFont($fontFamilyConfig, '', 11);
    $dataLeft = [
        "Guest Name" => "",
        "Mobile No." => "",
        "Corporate Name" => "",
        "Pickup" => "",
        "Drop At" => "",
        "Bill To" => $bill_to
    ];
    $dataRight = [
        "Type of Car" => "",
        "Vehicle No." => "",
        "Chauffeur Name" => "",
        "Mobile No." => "",
        "Booked by" => "",
        "Mobile No." => ""
    ];

    // Left Table
    $xPosLeft = 10;
    $xPosRight = 110;
    $yPos = 60;

    foreach ($dataLeft as $key => $value) {
        $pdf->SetXY($xPosLeft, $yPos);
        $pdf->Cell(45, 5, $key . " :", 0, 0, 'L');
        $pdf->Cell(50, 5, $value, 0, 1, 'L');
        $yPos += 8;
    }

    // Right Table
    $yPos = 60;
    foreach ($dataRight as $key => $value) {
        $pdf->SetXY($xPosRight, $yPos);
        $pdf->Cell(45, 5, $key . " :", 0, 0, 'L');
        $pdf->Cell(50, 5, $value, 0, 1, 'L');
        $yPos += 8;
    }

    // Table structure

    $pdf->Line(5, 115, 205, 115); // horizontal line
    $pdf->Line(5, 122, 205, 122); // horizontal line
    $pdf->Line(35, 200, 35, 115); // veritcal line
    $pdf->Line(5, 155, 125, 155); // horizontal line
    $pdf->Line(5, 162, 125, 162); // horizontal line
    $pdf->Line(65, 200, 65, 115); // veritcal line
    $pdf->Line(95, 200, 95, 115); // veritcal line
    $pdf->Line(125, 220, 125, 115); // veritcal line
    $pdf->Line(5, 200, 205, 200); // horizontal line
    $pdf->Line(5, 210, 125, 210); // horizontal line
    $pdf->Line(5, 220, 205, 220); // horizontal line
    $pdf->Line(5, 233, 205, 233); // horizontal line

    // Add Headers
    $pdf->SetFont($fontFamilyConfigTable, 'B', 10);
    $pdf->SetXY(5, 116);
    $pdf->Cell(30, 6, 'Trip Date', 0, 0, 'C');
    $pdf->Cell(30, 6, 'Starting Kms', 0, 0, 'C');
    $pdf->Cell(30, 6, 'Closing Kms', 0, 0, 'C');
    $pdf->Cell(30, 6, 'Total Kms', 0, 0, 'C');
    $pdf->Cell(80, 6, 'Trip Details', 0, 1, 'C');

    // Sub-Headers for End Date and Time
    $pdf->SetXY(5, 156);
    $pdf->Cell(30, 6, 'End Date', 0, 0, 'C');
    $pdf->Cell(30, 6, 'Starting Time', 0, 0, 'C');
    $pdf->Cell(30, 6, 'Closing Time', 0, 0, 'C');
    $pdf->Cell(30, 6, 'Total Time', 0, 1, 'C');

    // Add Labels for Toll, Parking, Signature
    $pdf->SetFont($fontFamilyConfigTable, '', 10);
    
    $pdf->SetXY(5, 201);
    $pdf->Cell(60, 6, 'Toll :', 0, 1, 'L'); 
    $pdf->SetXY(5, 212);  
    $pdf->Cell(60, 6, 'Parking :', 0, 1, 'L');  
    $pdf->SetXY(125, 201);
    $pdf->Cell(80, 6, 'Guest Signature :', 0, 1, 'L');

    // Feedback/Comments Section
    $pdf->SetXY(5, 221);
    $pdf->SetFont($fontFamilyConfigTable, 'I', 10);
    $pdf->Cell(200, 6, 'Value Feedback & Comments by the user / Guest :-', 0, 1, 'L');
    $pdf->SetXY(5, 226);
    $pdf->Cell(220, 6, 'Next Duty Pickup / Place', 0, 1, 'L');


$pdf->Output();