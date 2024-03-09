<?php
## Include the FPDF library
require_once('../fpdf/fpdf.php');
## Require connection file
require_once('../conn.php');

## Retrieve year, month, and day from query parameters
$year = $_GET['year'];
$month = $_GET['month'];
$day = $_GET['day'];

## Fetch data from the database based on the provided date
$result_infor = mysqli_query($conn, "SELECT * FROM `sales` WHERE `year` = '$year' AND `month` = '$month' AND `day` = '$day'");
$num_rows = mysqli_num_rows($result_infor);

if ($num_rows > 0) {
    ## Create new PDF instance
    $pdf = new FPDF('P', 'mm', array(250, 297)); 
    $pdf->AddPage();

    ## Set font
    $pdf->SetFont('Arial', 'B', 16);

    ## Add title
    $pdf->Cell(0, 10, 'Sales Report', 0, 1, 'C');
    $pdf->Ln(10);

    ## Add date
    $pdf->Cell(0, 10, 'Date: ' . $day . '/' . $month . '/' . $year, 0, 1, 'C');
    $pdf->Ln(10);

    ## Add table header
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(40, 10, 'S/N', 1);
    $pdf->Cell(80, 10, 'Product Info', 1); // Increase width for product_infor
    $pdf->Cell(40, 10, 'Sub-total', 1);
    $pdf->Cell(40, 10, 'Transaction ID', 1);
    $pdf->Cell(40, 10, 'Payment Mode', 1);
    $pdf->Ln();

    ## Initialize counter
$serial_number = 1;

## Add table rows
$pdf->SetFont('Arial', '', 12, true);
while ($row = mysqli_fetch_assoc($result_infor)) {
    ## Output serial number
    $pdf->Cell(40, 10, $serial_number++, 1);
    ## Output product_infor using MultiCell to allow line breaks
    $pdf->MultiCell(80, 10, $row['product_infor'], 1);
    ## Position the subsequent cells correctly
    $pdf->SetX($pdf->GetX() - 80); ## Set position to align with product_infor cell
    ## Output sub-total
    $pdf->SetX($pdf->GetX() - 45); ## Move to the right for sub-total cell
    $pdf->Cell(40, 10, '₦'.number_format($row['total_naira'], 2), 1);
    ## Output transaction ID
    $pdf->Cell(40, 10, 'GR' . $row['trans_id'], 1);
    ## Output payment mode
    $pdf->Cell(40, 10, $row['payment_mode'], 1);
    $pdf->Ln();
}

    ## Output PDF
    $pdf->Output('sales_report.pdf', 'D'); ## 'D' for download
} else {
    echo "No data found in the table for the specified date." . '<br/><br/> <a href="./admin_home.php">go back</a>';
}
?>
