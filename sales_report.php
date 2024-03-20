<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sales Report Form</title>
</head>
<body>

    <form method="POST" action="sales_report.php">
        <label for="start_year">Start Year:</label>
        <input type="number" id="start_year" name="start_year" required min="1900" max="2099" step="1">
        
        <label for="start_month">Start Month:</label>
        <input type="number" id="start_month" name="start_month" required min="1" max="12" step="1">
        
        <label for="start_day">Start Day:</label>
        <input type="number" id="start_day" name="start_day" required min="1" max="31" step="1">

        <br/><br/>

        <label for="end_year">End Year:</label>
        <input type="number" id="end_year" name="end_year" required min="1900" max="2099" step="1">
        
        <label for="end_month">End Month:</label>
        <input type="number" id="end_month" name="end_month" required min="1" max="12" step="1">
        
        <label for="end_day">End Day:</label>
        <input type="number" id="end_day" name="end_day" required min="1" max="31" step="1">

        <br/><br/>

        <input type="submit" value="Generate Report">
    </form>
</body>
<style>
        table {
            width: 60%;
            font-family: sans-serif;
            border-collapse: collapse;
        }
        .title{
         font-family:sans-serif;
        }
        th, td {
            padding: 8px;
            text-align: left;
            font-size: 15px;
        }
        th {
            background-color: green;
            color: white;
        }

        @media screen and (orientation: landscape) {
        th {
        background-color: rgb(252, 252, 252);
        color: rgb(243, 242, 242);
    }
}
    </style>
</html>
<?php
require_once './conn.php';

## Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['start_year'] && !empty($_POST['end_year']))) {
    ## Retrieve start date values from form data
    $start_year = $_POST['start_year'];
    $start_month = $_POST['start_month'];
    $start_day = $_POST['start_day'];

    ## Retrieve end date values from form data
    $end_year = $_POST['end_year'];
    $end_month = $_POST['end_month'];
    $end_day = $_POST['end_day'];

    ## Check if exact year, month, and day are not provided for start date
    if (empty($start_year) || empty($start_month) || empty($start_day)) {
        ## move to the next day
        $start_date = date('Y-m-d', strtotime('+1 day'));
        $start_year = date('Y', strtotime($start_date));
        $start_month = date('m', strtotime($start_date));
        $start_day = date('d', strtotime($start_date));
    }

    ## Check if exact year, month, and day are not provided for end date
    if (empty($end_year) || empty($end_month) || empty($end_day)) {
        ## move to the next day
        $end_date = date('Y-m-d', strtotime('+1 day'));
        $end_year = date('Y', strtotime($end_date));
        $end_month = date('m', strtotime($end_date));
        $end_day = date('d', strtotime($end_date));
    }

    ## Construct start and end date strings
    $start_date = "$start_day-$start_month-$start_year";
    $end_date = "$end_day-$end_month-$end_year";

    ## Construct and execute SQL query to fetch sales within the specified date range
    $sql = "SELECT * FROM sales WHERE 
            (YEAR > '$start_year' OR (YEAR = '$start_year' AND MONTH > '$start_month') OR (YEAR = '$start_year' AND MONTH = '$start_month' AND DAY >= '$start_day')) AND 
            (YEAR < '$end_year' OR (YEAR = '$end_year' AND MONTH < '$end_month') OR (YEAR = '$end_year' AND MONTH = '$end_month' AND DAY <= '$end_day'))";
    $result = mysqli_query($conn, $sql);

    ## Check if query was successful
    if ($result) {
        ## Output sales report table
        echo "<h4 class='title'>Sales Report from $start_date to $end_date</h4>";
        echo "<table border='1'>
                <tr>
                    <th>Product Infor</th>
                    <th>Trans. ID</th>
                    <th>Amount</th>
                    <th>Date</th>
                </tr>";
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['product_infor'] . "</td>";
            echo "<td>" . $row['trans_id'] . "</td>";
            echo "<td>" . "₦".$row['total_naira'] . "</td>";
            echo "<td>" . $row['day'] . "-" . $row['month'] . "-" . $row['year'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
      } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
     }

    ## Close database connection
    mysqli_close($conn);
}

?>
