<?php
include 'database.php';

// Connect to the database
$conn = connectDB();

// Fetch items from the database
$query = "SELECT * FROM products";
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
header('Content-Type: application/json');
echo json_encode($items);
?>