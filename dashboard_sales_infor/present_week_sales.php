<?php
## Require connection file
require_once '../conn.php';

function Present_week_sales(){
    global $conn;

    ## Get the current year, month, and day
    $year = date('Y');
    $month = date('n'); ## Retrieve month without leading zeros

    ## Calculate the current day of the week (0 = Sunday, 1 = Monday, ..., 6 = Saturday)
    $dayOfWeek = date('w');

    ## Calculate the number of days to subtract to get to Sunday (the start of the week)
    $daysToSunday = $dayOfWeek;

    ## Calculate the number of days to add to get to Saturday (the end of the week)
    $daysToSaturday = 6 - $dayOfWeek;

    ## Calculate the start date of the current week (the most recent Sunday)
    $currentWeekStart = date('Y-n-j', strtotime("-$daysToSunday days"));

    ## Calculate the end date of the current week (the upcoming Saturday)
    $currentWeekEnd = date('Y-n-j', strtotime("+$daysToSaturday days"));

    ## Fetch data from the database for the current week
    $sql = "SELECT total_naira FROM `sales` WHERE `year` = '$year' 
            AND `month` = '$month' 
            AND CONCAT(`year`, '-', `month`, '-', `day`) BETWEEN '$currentWeekStart' AND '$currentWeekEnd'";

    $result = $conn->query($sql);
    
    if (!$result) {
        echo "Error executing query: " . $conn->error;
        return;
    }
    
    $sales_count = 0; ##endregion Initialize sales count to 0
    $total_naira_sum = 0.00; ## Initialize total naira sum to 0.00

    if ($result->num_rows > 0) {
        ## Loop through each row in the result set
        while ($row = $result->fetch_assoc()) {
            ## Increase sales count
            $sales_count++;

            ## Extract total naira for the product
            $totalNaira = $row['total_naira'];

            ## Add the total naira for the product to the total naira sum
            $total_naira_sum += $totalNaira;
        }
    } else {
        echo "No data found for the current week.<br>"; ## Debugging output: Indicate no data found
    }

    ## Output the results
    echo "<h2>" . number_format($sales_count) . " <span>sales made this week</span></h2><br/>";
    echo "<h2>&#8358;" . number_format($total_naira_sum, 2) . " <span>Realized</span></h2>";
}

?>
