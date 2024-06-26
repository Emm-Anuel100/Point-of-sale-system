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
    $currentWeekEnd = date('Y-n-j', strtotime("$daysToSaturday days"));

    ## Fetch data from the database for the current week
    $sql = "SELECT total_naira FROM `sales` WHERE `year` = '$year' 
            AND `month` = '$month' 
            AND CONCAT(`year`, '-', `month`, '-', `day`) BETWEEN '$currentWeekStart' AND '$currentWeekEnd'";

    $result = $conn->query($sql);
    
    if (!$result) {
        echo "Error executing query: " . $conn->error;
        return;
    }
    
    $sales_count = 0; ## endregion Initialize sales count to 0
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
        ## If no data found for the current week, execute the alternative query

        ## Query to fetch the number of sales made within the current week
        $sql_sales_count = "SELECT COUNT(DISTINCT product_infor) AS sales_count FROM sales 
                         WHERE `year` = '$year' 
                         AND `month` = '$month' 
                         AND `day` BETWEEN DAY('$currentWeekStart') AND DAY('$currentWeekEnd')";
        $result_sales_count = $conn->query($sql_sales_count);

        if (!$result_sales_count) {
            echo "Error executing query: " . $conn->error;
            return;
        }

        if ($result_sales_count->num_rows > 0) {
            ## Fetch the total number of sales
            $row_sales_count = $result_sales_count->fetch_assoc();
            $sales_count = $row_sales_count["sales_count"];
            
            ## Output the total number of sales for the week
            echo "<h2>" . number_format($sales_count) . " <span>sales made this week</span></h2><br/>";
        } else {
            echo "<h2>0 <span>sales made this week</span></h2><br/>";
        }


        ## Query to fetch the sum of prices from the total_naira column for the current week
        $sql_total_naira_sum = "SELECT SUM(total_naira) AS total_naira_sum FROM sales 
                                WHERE `year` = '$year' 
                                AND `month` = '$month' 
                                AND `day` BETWEEN DAY('$currentWeekStart') AND DAY('$currentWeekEnd')";
        $result_total_naira_sum = $conn->query($sql_total_naira_sum);

        if (!$result_total_naira_sum) {
            echo "Error executing query: " . $conn->error;
            return;
        }

        if ($result_total_naira_sum->num_rows > 0) {
            ## Fetch the sum of prices
            $row_total_naira_sum = $result_total_naira_sum->fetch_assoc();
            $total_naira_sum = $row_total_naira_sum["total_naira_sum"];
            
            ## Output the sum of prices realized for the week
            echo "<h2>&#8358;" . number_format($total_naira_sum, 2) . " <span>Realized</span></h2>";
        } else {
            echo "<h2>&#8358;0.00 <span>Realized</span></h2>";
        }

        return; ## Exit the function after executing the alternative query
    }

    ## Output the results
    echo "<h2>" . number_format($sales_count) . " <span>sales made this week</span></h2><br/>";
    echo "<h2>&#8358;" . number_format($total_naira_sum, 2) . " <span>Realized</span></h2>";
}

?>
