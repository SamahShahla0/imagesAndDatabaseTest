<?php
error_reporting(E_ALL); 
ini_set('display_errors', 1);
include 'database.php';

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// Connect to the database
$conn = connectDB();

// Initialize response array
$response = array();

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST["name"])) {
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
                $response['success'] = true;
                $response['message'] = "New record created successfully";
            } else {
                $response['success'] = false;
                $response['message'] = "Error: " . $query . "<br>" . $conn->error;
            }
        } else {
            $response['success'] = false;
            $response['message'] = "Error uploading image";
        }
    } else {
        $response['success'] = false;
        $response['message'] = "Name parameter is missing";
    }
} else {
    $response['success'] = false;
    $response['message'] = "Invalid request method";
}

// Close database connection
$conn->close();

// Return JSON response
echo json_encode($response);
?>
