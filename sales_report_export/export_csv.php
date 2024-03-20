<?php
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
    ## Set headers for CSV file download
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="sales_report.csv"');
    
    ## Open file handle to write CSV data
    $output = fopen('php://output', 'w');

    ## Write headers to CSV file
    fputcsv($output, array('S/N', 'Product Info', 'Payment Mode', 'Transaction ID', 'Amount', 'Cashier', 'Date'));

    ## Fetch and write data rows to CSV file
    $i = 1;
    while ($row = mysqli_fetch_assoc($result_sales)) {
        ## Format data for CSV
        $csv_data = array(
            $i++,
            $row['product_infor'],
            $row['payment_mode'],
            $row['trans_id'],
            "₦" . $row['total_naira'],
            $row['cashier'],
            $row['day'] . "-" . $row['month'] . "-" . $row['year']
        );

        ## Write data to CSV file
        fputcsv($output, $csv_data);
    }

    ## Close file handle
    fclose($output);
  } else {
    echo "No sales data found." . '<br/><br/> <a href="../iamadmin/admin_home.php">go back</a>';
 }
?>
