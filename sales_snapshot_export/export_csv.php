<?php
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
    ## Initialize total naira
    $total_naira = 0;

    ## Set filename with date
    $filename = "sales_snapshot_$year-$month-$day.csv";

    ## Set CSV headers with filename
    header('Content-Type: text/csv');
    header("Content-Disposition: attachment; filename=\"$filename\"");

    ## Open file handle for output
    $output = fopen('php://output', 'w');

    ## Write CSV header
    fputcsv($output, array('S/N', 'Product Info', 'Sub-total', 'Transaction ID', 'Payment Mode', 'Cashier'));

    ## Initialize counter
    $serial_number = 1;

    ## Loop through database results and write to CSV
    while ($row = mysqli_fetch_assoc($result_infor)) {
        ## Output CSV row
        fputcsv($output, array(
            $serial_number++,
            $row['product_infor'],
            'N'.number_format($row['total_naira'], 2),
            'GR' . $row['trans_id'],
            $row['payment_mode'],
            $row["cashier"] 
        ));

        ## Sum up total naira
        $total_naira += $row['total_naira'];
    }

    ## Add row for total naira
    fputcsv($output, array('', '', 'Total Naira: ₦' . number_format($total_naira, 2), '', '', ''));

    ## Close file handle
    fclose($output);
} else {
    echo "No data found." . '<br/><br/> <a href="../iamadmin/admin_home.php">go back</a>';
}
?>
