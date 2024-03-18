<?php
## This file is used to fetch all sold products for the current week
## and output the frequently bought ones in order
## Also invoked in (chart_views/week_chart.php ln:54) 
## Implemented ajax for real-time update on chart

## Require connection file
require_once '../conn.php';

## Get the current year, month, and day
$year = date('Y');
$month = date('n'); ## Retrieve month without leading zeros
$day = date('j'); ## Retrieve day without leading zeros

## Calculate the current day of the week (0 = Sunday, 1 = Monday, ..., 6 = Saturday)
$dayOfWeek = date('w');

## Calculate the number of days to subtract to get to Sunday (the start of the week)
$daysToSunday = $dayOfWeek;

## Calculate the number of days to add to get to Saturday (the end of the week)
$daysToSaturday = 6 - $dayOfWeek;

## Calculate the start date of the current week (the most recent Sunday)
$currentWeekStart = date('Y-n-d', strtotime("-$daysToSunday days"));

## Calculate the end date of the current week (the upcoming Saturday)
$currentWeekEnd = date('Y-n-d', strtotime("+$daysToSaturday days"));


## Fetch data from the database for the current week
$sql = "SELECT product_infor FROM `sales` WHERE `year` = '$year' 
        AND `month` = '$month' 
        AND `day` BETWEEN DAY('$currentWeekStart') AND DAY('$currentWeekEnd')";

$result = $conn->query($sql);

## Initialize an array to store product quantities
$productQuantities = array();

if ($result->num_rows > 0) {
    ## Loop through each row in the result set
    while ($row = $result->fetch_assoc()) {
        ## Extract product information from the product_info column
        $productInfo = $row['product_infor'];

        ## Parse the product information using regular expression
        preg_match_all('/(\w+\s*\w*)\s*\(Quantity:\s*(\d+),\s*Price:\s*[^)]+\)/', $productInfo, $matches, PREG_SET_ORDER);
        
        ## Extract product name and quantity for each match
        foreach ($matches as $match) {
            $productName = trim($match[1]);
            $quantity = intval($match[2]);

            ## Update product quantity in the array
            if (isset($productQuantities[$productName])) {
                $productQuantities[$productName] += $quantity;
            } else {
                $productQuantities[$productName] = $quantity;
            }
        }
    }
} else {
    echo "No data found for the current week.<br>"; ## Debugging output: Indicate no data found
}

## Prepare the data in the format required for the chart
$data = array();
foreach ($productQuantities as $productName => $quantity) {
    $data[] = array('product_name' => $productName, 'total_quantity' => $quantity);
}

## Return the data as JSON
echo json_encode($data);

## Close database connection
$conn->close();
?>
