<?php
function connectDB() {
    $servername = "localhost"; // Replace with your database server
    $username = "username"; // Replace with your database username
    $password = "password"; // Replace with your database password
    $dbname = "items"; // Replace with your database name

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    return $conn;
}
?>