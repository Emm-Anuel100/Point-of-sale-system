<?php
## this file is used to fetch all sold products for the day
## also invoked in (chart_views/today's_chart.php ln:49) 
## inplemented ajax for real time update on chart

## require connection file
require_once '../conn.php';

## get current year and month and day
$year = DATE('Y');
$month = DATE('n'); ## Retrieve month without leading zeros
$day = DATE('j');  ## Retrieve day without leading zeros

## Fetch data from the database
$sql = "SELECT product_infor FROM `sales` WHERE `year` = '$year' AND `month` = '$month' AND `day` = '$day'";
$result = $conn->query($sql);

## Initialize an array to store product quantities
$productQuantities = array();

if ($result->num_rows > 0) {
    ## Loop through each row in the result set
    while ($row = $result->fetch_assoc()) {
        ## Extract product information from the product_info column
        $productInfo = $row['product_infor'];

        ## Parse the product information using regular expression
        preg_match_all('/(.+?)\s*\(Quantity:\s*(\d+),\s*Price:\s*[^)]+\)/', $productInfo, $matches, PREG_SET_ORDER);
        
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
}  else {
    echo "No data found for the day.<br>"; ## Debugging output: Indicate no data found
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
