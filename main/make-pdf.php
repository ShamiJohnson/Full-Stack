<?php
    // Grab all the variables
    $fullname = $_POST['fullname']; 
    $email = $_POST['email'];
    $purpose = $_POST['purpose'];
    
    $categoryselect = $_POST['categoryselect'];
    $manufacturerselect = $_POST['manufacturerselect'];
    $modelselect = $_POST['modelselect'];
    $extraitem = $_POST['extraselect'];
    
    $otheritem = $_POST['otheritem'];
    $servicetag = $_POST['servicetag'];

    $loandate = $_POST['loandate'];
    $returndate = $_POST['returndate'];
    $time = $_POST['time'];
    
    
    require ('fpdf/fpdf.php');

    // Make a new instance of the library
    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->Image('img/logo/LogoLF.jpg',10,6,180);
    $pdf->SetFont("Times", "", 12);

    // Format the form
    $pdf->Ln(20);
    $pdf->Cell(0, 1, "The equipment listed below is the property of Indiana University-School of Education at IUPUI and is", 0, 1);
    $pdf->Cell(0, 10, "being loaned for the time period and to the person indicated below", 0, 1);

    
    $pdf->Cell(65, 10, "Faculty\Staff Members Name:", 0, 0);
    $pdf->SetFillColor(200,220,255);
    $pdf->Cell(110, 10, $fullname, 1, 1, 'L', true);

    $pdf->Cell(65, 10, "Email Address: ", 0, 0);
    $pdf->SetFillColor(200,220,255);
    $pdf->Cell(110, 10, $email, 1, 1, 'L', true);

    $pdf->Cell(65, 10, "Purpose: ", 0, 0);
    $pdf->SetFillColor(200,220,255);
    $pdf->Cell(110, 10, $purpose, 1, 1, 'L', true);

    $pdf->Ln(2);
    $pdf->Cell(19, 10, "Category: ", 0, 0);
    $pdf->SetFillColor(200,220,255);
    $pdf->Cell(40, 10, $categoryselect, 1, 0, 'L', true);

    $pdf->Cell(26, 10, "Manufacturer: ", 0, 0);
    $pdf->SetFillColor(200,220,255);
    $pdf->Cell(35, 10, $manufacturerselect, 1, 0, 'L', true);

    $pdf->Cell(15, 10, "Model: ", 0, 0);
    $pdf->SetFillColor(200,220,255);
    $pdf->Cell(40, 10, $modelselect, 1, 1, 'L', true);
    $pdf->Ln(2);

    $pdf->Cell(27, 10, "Extra Item(s): ", 0, 0);
    foreach ($extraitem as $extraselect){ 
        $pdf->SetFillColor(200,220,255);
        $pdf->Cell(37, 10, $extraselect, 1, 0, 'L', true);
    }

    $pdf->Ln(12);
    $pdf->Cell(65, 10, "Other Item: ", 0, 0);
    $pdf->SetFillColor(200,220,255);
    $pdf->Cell(110, 10, $otheritem, 1, 1, 'L', true);
    
    $pdf->Cell(65, 10, "Service Tag: ", 0, 0);
    $pdf->SetFillColor(200,220,255);
    $pdf->Cell(110, 10, $servicetag, 1, 1, 'L', true);

    $pdf->Cell(65, 10, "Loan Date: ", 0, 0);
    $pdf->SetFillColor(200,220,255);
    $pdf->Cell(110, 10, $loandate, 1, 1, 'L', true);

    $pdf->Cell(65, 10, "Return Date: ", 0, 0);
    $pdf->SetFillColor(200,220,255);
    $pdf->Cell(110, 10, $returndate, 1, 1, 'L', true);

    $pdf->Cell(65, 10, "Time: ", 0, 0);
    $pdf->SetFillColor(200,220,255);
    $pdf->Cell(110, 10, $time, 1, 1, 'L', true);


    $pdf->Ln(10);
    $pdf->Cell(0, 1, "I understand that the following conditions will apply to all equipment:", 0, 1);
    $pdf->Cell(0, 10, "     a. It will only be used by me for school related activity;", 0, 1);
    $pdf->Cell(0, 1, "     b. I assume liability for damage or theft and will be responsible for the repair or replacement costs", 0, 1);
    $pdf->Cell(0, 10, "     of each item (I will consult my personal homeowners or auto insurance coverage policies);", 0, 1);
    $pdf->Cell(0, 1, "     c. I will not store any confidential or sensitive information as defined by the IU Security Office", 0, 1);
    $pdf->Cell(0, 10, "     policy on the equipment, http://protect.iu.edu/cybersecurity/data ;", 0, 1);
    $pdf->Cell(0, 1, "     d. I will report the loss or theft of the equipment immediately to Education Technology Services;", 0, 1);
    $pdf->Cell(0, 10, "     e. I will execute reasonable care in its transport and use; ", 0, 1);
    $pdf->Cell(0, 1, "     f. I will return the equipment on the agreed Return Date/Time indicated above OR immediately", 0, 1);
    $pdf->Cell(0, 10, "     prior to terminating employment with IU School of Education at IUPUI OR upon the request of", 0, 1);
    $pdf->Cell(0, 1, "     Education Technology Services;", 0, 1);

    $pdf->Ln(2);
    
    $pdf->Cell(0, 20, "Faculty\Staff Member Signature: ________________________________    Date: ____/____/____", 0, 1);
    $pdf->Cell(0, 1, "APPROVAL: ________________________________________________   Date: ____/____/____", 0, 1);
    
    $pdf->Cell(0, 10, "                                 (Education Technology Services Staff Signature)", 0, 1);
    $pdf->Cell(0, 20, "The item(s) have been returned and inspected for damages. Damages are noted as follows:", 0, 1);
    $pdf->Cell(0, 1, "Signature of ETS Staff Checking in: ______________________________    Date: ____/____/____", 0, 0);

    // Output the final result
    $pdf->output();

?>
