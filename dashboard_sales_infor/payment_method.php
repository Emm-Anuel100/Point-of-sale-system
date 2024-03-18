<?php

function payment_mode(){
 ## set $conn to global variable
 global $conn;
   
## SQL query to count occurrences of each payment mode
$sql = "SELECT payment_mode, COUNT(*) AS mode_count 
FROM sales 
GROUP BY payment_mode 
ORDER BY mode_count DESC 
LIMIT 1";

## Execute the query
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
## Fetch the row with the most frequent payment mode
$row = $result->fetch_assoc();

## Extract the payment mode and its count
$most_used_mode = $row['payment_mode'];
##$mode_count = $row['mode_count'];

## Output the most used payment mode
echo "$most_used_mode";
} else {
echo "No sales records found.";
}
}
?>
