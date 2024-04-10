<?php
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
    ## Initialize an array to store the fetched data
    $sales_data = [];

    ## Calculate total revenue
    $total_naira = 0;

    ## Fetch data and store it in the array
    while ($row = mysqli_fetch_assoc($result_sales)) {
        $sales_data[] = $row;
        $total_naira += $row['total_naira'];
    }

    ## Set headers for CSV file download
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="sales_report.csv"');

    ## Open file handle to write CSV data
    $output = fopen('php://output', 'w');

    ## Write headers to CSV file
    fputcsv($output, array('S/N', 'Product Info', 'Payment Mode', 'Transaction ID', 'Amount', 'Cashier', 'Date'));

    ## Fetch and write data rows to CSV file
    $i = 1;
    foreach ($sales_data as $row) {
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

    ## Add row for total revenue
    fputcsv($output, array('Total Revenue', '', '', '', "₦" . number_format($total_naira, 2), '', ''));

    ## Close file handle
    fclose($output);
} else {
    echo "No sales data found." . '<br/><br/> <a href="../iamadmin/admin_home.php">go back</a>';
}
?>
