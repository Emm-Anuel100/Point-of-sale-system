<?php
require '../conn.php';

$sql = "SELECT product_infor FROM sales";
$result = $conn->query($sql);

if ($result) {
    $product_names = array();
    while ($row = $result->fetch_assoc()) {
        $product_info = $row['product_infor'];
        preg_match_all('/(.*?) \(Quantity: (\d+),/', $product_info, $matches, PREG_SET_ORDER);
        foreach ($matches as $match) {
            $product_name = $match[1];
            $quantity = intval($match[2]);
            for ($i = 0; $i < $quantity; $i++) {
                $product_names[] = $product_name;
            }
        }
    }

    $product_counts = array_count_values($product_names);
    $labels = array_keys($product_counts);
    $data = array_values($product_counts);

    echo json_encode(array('labels' => $labels, 'data' => $data));
} else {
    echo json_encode(array('error' => 'Error executing SQL query'));
}
?>
