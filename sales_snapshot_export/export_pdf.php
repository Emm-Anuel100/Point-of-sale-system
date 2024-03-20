<?php
## Require FPDF library
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
    $pdf = new FPDF('P', 'mm', array(350, 330)); 
    $pdf->AddPage();

    ## Set font
    $pdf->SetFont('Arial', 'B', 16);

    ## Add title
    $pdf->Cell(0, 10, 'Sales Snapshot', 0, 1, 'C');
    $pdf->Ln(10);

    ## Add date
    $pdf->Cell(0, 10, 'Date: ' . $day . '/' . $month . '/' . $year, 0, 1, 'C');
    $pdf->Ln(10);

    ## Add table header
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(40, 10, 'S/N', 1);
    $pdf->Cell(80, 10, 'Product Info', 1); // Increase width for product_info
    $pdf->Cell(40, 10, 'Sub-total', 1);
    $pdf->Cell(40, 10, 'Transaction ID', 1);
    $pdf->Cell(40, 10, 'Payment Mode', 1);
    $pdf->Cell(40, 10, 'Cashier', 1);
    $pdf->Ln();

    ## Initialize counter
    $serial_number = 1;

    ## Add table rows
    $pdf->SetFont('Arial', '', 12);
    while ($row = mysqli_fetch_assoc($result_infor)) {
        ## Output serial number
        $pdf->Cell(40, 10, $serial_number++, 1);

        ## Output product_info using MultiCell to allow line breaks
        $pdf->MultiCell(80, 10, $row['product_infor'], 1);

        ## Get current Y position
        $y_position = $pdf->GetY();

        ## Set X position for subsequent cells
        $pdf->SetXY(130, $y_position - 10); ## Align with product_info column
        $pdf->Cell(40, 10, 'N' . number_format($row['total_naira'], 2), 1); ## Sub-total

        $pdf->SetXY(170, $y_position - 10); ## Align with product_info column
        $pdf->Cell(40, 10, 'GR' . $row['trans_id'], 1); ## Transaction ID

        $pdf->SetXY(210, $y_position - 10); ## Align with product_info column
        $pdf->Cell(40, 10, $row['payment_mode'], 1); ## Payment Mode

        $pdf->SetXY(250, $y_position - 10); ## Align with product_info column
        $pdf->Cell(40, 10, $row['cashier'], 1); ## Cashier

        $pdf->Ln(); ## Move to the next row
    }

    ## Output PDF
    $pdf->Output('sales_snapshot.pdf', 'I'); ## 'I' for inline view
  } else {
    echo "No data found." . '<br/><br/> <a href="../iamadmin/admin_home.php">go back</a>';
}
?>
