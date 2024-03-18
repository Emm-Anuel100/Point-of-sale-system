<?php

function Present_day_sales(){
## set $conn to a global variable
global $conn;

## Get current year
$current_year = date('Y');
## Get current month
$current_month = date('n');  ## Retrieve month without leading zeros
## Get current day
$day = date('j'); ## Retrieve day without leading zeros

## Query to fetch the number of sales made within the current year, month and day
$sql_sales_count = "SELECT COUNT(*) AS sales_count FROM sales WHERE YEAR = '$current_year' AND MONTH = '$current_month' AND DAY = '$day'";

$result_sales_count = $conn->query($sql_sales_count);

if ($result_sales_count->num_rows > 0) {
    ## Fetch the total number of sales
    $row_sales_count = $result_sales_count->fetch_assoc();
    $sales_count = $row_sales_count["sales_count"];
    
    ## Output the total number of sales
    echo "<h2>" . number_format($sales_count) . " <span>sales made today</span></h2><br/>";
   } else {
      echo "<h2>0 <span>sales made today</span></h2><br/>";
   }

## Query to fetch the sum of prices from the total_naira column for the current year, month and day
$sql_total_naira_sum = "SELECT SUM(total_naira) AS total_naira_sum FROM sales WHERE YEAR = '$current_year' AND MONTH = '$current_month' AND DAY = '$day'";

$result_total_naira_sum = $conn->query($sql_total_naira_sum);

if ($result_total_naira_sum->num_rows > 0) {
    ## Fetch the sum of prices
    $row_total_naira_sum = $result_total_naira_sum->fetch_assoc();
    $total_naira_sum = $row_total_naira_sum["total_naira_sum"];
    
    ## Output the sum of prices
    echo "<h2>&#8358;" . number_format($total_naira_sum, 2) . " <span>Realized</span></h2>";
    } else {
        echo "<h2>&#8358;0.00 <span>Realized</span></h2>";
    }
}
?>
