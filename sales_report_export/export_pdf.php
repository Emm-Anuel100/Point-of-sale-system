<?php
## Require fpdf library
require_once('../fpdf/fpdf.php');
## Require connection file
require_once('../conn.php');

$start_year = $_GET['start_year'];
$start_month = $_GET['start_month'];
$start_day = $_GET['start_day'];
$end_year = $_GET['end_year'];
$end_month = $_GET['end_month'];
$end_day = $_GET['end_day'];

$result_sales = mysqli_query($conn, "SELECT * FROM sales WHERE 
    (YEAR > '$start_year' OR (YEAR = '$start_year' AND MONTH > '$start_month') OR (YEAR = '$start_year' AND MONTH = '$start_month' AND DAY >= '$start_day')) AND 
    (YEAR < '$end_year' OR (YEAR = '$end_year' AND MONTH < '$end_month') OR (YEAR = '$end_year' AND MONTH = '$end_month' AND DAY <= '$end_day'))");

if (mysqli_num_rows($result_sales) > 0) {
    $pdf = new FPDF('P', 'mm', array(380, 340));
    $pdf->AddPage();
    $pdf->SetFont('Arial', '', 12); ## Set font size to 12px without bold
    $pdf->Cell(0, 10, 'Sales Report', 0, 1, 'C');
    $pdf->Ln(10);
    $pdf->SetFont('Arial', '', 12); ## Set font size to 12px without bold
    $pdf->Cell(40, 10, 'S/N', 1);
    $pdf->Cell(80, 10, 'Product Info', 1);
    $pdf->Cell(40, 10, 'Payment Mode', 1);
    $pdf->Cell(40, 10, 'Transaction ID', 1);
    $pdf->Cell(40, 10, 'Amount', 1);
    $pdf->Cell(40, 10, 'Cashier', 1);
    $pdf->Cell(40, 10, 'Date', 1);
    $pdf->Ln();

    $i = 1;
    while ($row = mysqli_fetch_assoc($result_sales)) {
        $pdf->Cell(40, 10, $i++, 1);

        ## MultiCell for Product Info to allow line breaks
        $pdf->SetFont('Arial', '', 12); ## Set font size to 12px for Product Info
        $pdf->MultiCell(80, 10, $row['product_infor'], 1);

        ## Adjust the position for the last four columns to align with their headers
        $pdf->SetXY(130, $pdf->GetY() - 10); ## Adjust X and Y position
        $pdf->Cell(40, 10, $row['payment_mode'], 1);
        $pdf->Cell(40, 10, $row['trans_id'], 1);
        $pdf->Cell(40, 10, "₦" . $row['total_naira'], 1);
        $pdf->Cell(40, 10, $row['cashier'], 1);
        $pdf->Cell(40, 10, $row['day'] . "-" . $row['month'] . "-" . $row['year'], 1);
        $pdf->Ln();
    }

    ## Output PDF
    $pdf->Output('sales_report.pdf', 'I'); ## 'I' for inline view
} else {
    echo "No sales data found." . '<br/><br/> <a href="../iamadmin/admin_home.php">go back</a>';
}
?>
