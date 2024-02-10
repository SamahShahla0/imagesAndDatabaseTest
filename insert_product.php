<?php
include 'database.php';

// Connect to the database
$conn = connectDB();

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];

    // Process image file
    if(isset($_FILES["image"]) && $_FILES["image"]["error"] == 0) {
        $imageData = file_get_contents($_FILES["image"]["tmp_name"]);
        $imageBase64 = base64_encode($imageData);

        // Insert data into the database
        $query = "INSERT INTO products (name, image_base64) VALUES (?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ss", $name, $imageBase64);
        
        if ($stmt->execute()) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $query . "<br>" . $conn->error;
        }
    } else {
        echo "Error uploading image";
    }
}

// Close database connection
$conn->close();
?>