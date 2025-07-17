<?php
$message = ""; // Initialize message
if ($_SERVER['REQUEST_METHOD'] === 'POST') {     
    include 'db.php';
    session_start();

    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // secure password

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO users (email, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $email, $password, );
    // Check if user exists     
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);                     
    $stmt->execute();
    $result = $stmt->get_result();  
    if ($result->num_rows > 0) {
        $message = "That email is already registered. <a href='login.php'>Login here</a>.";
    } else {
        // Insert new user
        $stmt = $conn->prepare("INSERT INTO users (email, password) VALUES (?, ?)");
        $stmt->bind_param("ss", $email, $password);
    }               

                
    // Execute the statement
    if ($stmt->execute()) {             
        $message = "login successful!";
    } else {
        $message = "Error: " . $stmt->error;
    }           
    // Close the statement and connection
    $stmt->close();
    $conn->close();
}  
?> 
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body class ="login">
<div class ="container">
    <h1>Login</h1>
    <form action="login.php" method="post">
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Login</button>
    </form>

    <!-- Display message -->
    <?php if (!empty($message)) echo $message; ?>

    <p>Don't have an account? <a href="register.php">Register here</a>.</p>
    <p>Go back to <a href="index.php">Home</a>.</p>
</div>
</body>
</html>
