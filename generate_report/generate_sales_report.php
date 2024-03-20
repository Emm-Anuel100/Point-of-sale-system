<?php
## Require connection file
require_once('../conn.php');

$start_year = mysqli_real_escape_string($conn, filter_var($_POST['start_year'], FILTER_DEFAULT));
$start_month = mysqli_real_escape_string($conn, filter_var($_POST['start_month'], FILTER_DEFAULT));
$start_day = mysqli_real_escape_string($conn, filter_var($_POST['start_day'], FILTER_DEFAULT));
$end_year = mysqli_real_escape_string($conn, filter_var($_POST['end_year'], FILTER_DEFAULT));
$end_month = mysqli_real_escape_string($conn, filter_var($_POST['end_month'], FILTER_DEFAULT));
$end_day = mysqli_real_escape_string($conn, filter_var($_POST['end_day'], FILTER_DEFAULT));

## Check if exact year, month, and day are not provided for start date
if (empty($start_year) || empty($start_month) || empty($start_day)) {
   ## move to the next day if exact day is not found
   $start_date = date('Y-m-d', strtotime('+1 day'));
   $start_year = date('Y', strtotime($start_date));
   $start_month = date('m', strtotime($start_date));
   $start_day = date('d', strtotime($start_date));
}

## Check if exact year, month, and day are not provided for end date
if (empty($end_year) || empty($end_month) || empty($end_day)) {
   ## move to the next day if exact day is not found
   $end_date = date('Y-m-d', strtotime('+1 day'));
   $end_year = date('Y', strtotime($end_date));
   $end_month = date('m', strtotime($end_date));
   $end_day = date('d', strtotime($end_date));
}

## Construct start and end date strings
$start_date = "$start_year-$start_month-$start_day";
$end_date = "$end_year-$end_month-$end_day";

$result_sales = mysqli_query($conn, "SELECT * FROM sales WHERE 
   (YEAR > '$start_year' OR (YEAR = '$start_year' AND MONTH > '$start_month') OR (YEAR = '$start_year' AND MONTH = '$start_month' AND DAY >= '$start_day')) AND 
   (YEAR < '$end_year' OR (YEAR = '$end_year' AND MONTH < '$end_month') OR (YEAR = '$end_year' AND MONTH = '$end_month' AND DAY <= '$end_day'))");

if (mysqli_num_rows($result_sales) > 0) {
   $output = "<h5 class='report-title'>Sales Report from $start_date to $end_date</h5><br/><br/>";
   $output .= "<table>
                <tr>
                   <th>S/n</th>
                   <th>Product Infor</th>
                   <th>Pay. mode</th>
                   <th>Trans. ID</th>
                   <th>Amount</th>
                   <th>Cashier</th>
                   <th>Date</th>
                </tr>";
   $i = 1;
   while ($row = mysqli_fetch_assoc($result_sales)) {
       $output .= "<tr>";
       $output .= "<td>" . $i . "</td>";
       $output .= "<td>" . $row['product_infor'] . "</td>";
       $output .= "<td>" . $row['payment_mode'] . "</td>";
       $output .= "<td>" . $row['trans_id'] . "</td>";
       $output .= "<td>" . "₦".$row['total_naira'] . "</td>";
       $output .= "<td>" . $row['cashier'] . "</td>";
       $output .= "<td>" . $row['day'] . "-" . $row['month'] . "-" . $row['year'] . "</td>";
       $output .= "</tr>";
       $i++;
   }
   $output .= "</table>";
   echo $output;

} else {
   echo "No sales data found for the specified date range.";
}

?>
