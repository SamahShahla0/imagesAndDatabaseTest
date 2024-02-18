<?php
include 'database.php';

header('Content-Type: application/json');

// Connect to the database
$conn = connectDB();

// Fetch items from the database
$query = "SELECT * FROM products ORDER BY productid DESC LIMIT 1";
$result = $conn->query($query);

$items = array();
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $items[] = $row;
    }
}

// Close database connection
$conn->close();

// Output items as JSON

echo json_encode($items);
?>