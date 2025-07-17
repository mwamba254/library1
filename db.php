<?php 
$_SERVER = "localhost";
$username = "root"; // Database username
$password = ""; // Database password
$database = "librarydb"; // Database name
// Create connection
$conn = new mysqli($_SERVER, $username, $password, $database);  
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}   
// Set character set to utf8
$conn->set_charset("utf8"); 
// Check if the connection is successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    // echo "Connected successfully"; // Uncomment for debugging
}       
// Close the connection when done
// $conn->close(); // Uncomment if you want to close the connection immediately     
// Note: Do not close the connection here if you plan to use it in other scripts    
// This file can be included in other PHP files to use the database connection
?>   