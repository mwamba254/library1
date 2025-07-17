<?php
$message = ""; // Initialize message
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include 'db.php';

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // secure password
    $role = $_POST['role'];

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $email, $password, $role);
    // Execute the statement
    if ($stmt->execute()) {             
        $message = "Registration successful!";
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
    <title>Register</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body class="register">
<div class="container">
    <h1>Register</h1>
    <form action="register.php" method="post">
        <input type="text" name="name" placeholder="Username" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <input type="text" name="role" value="user" hidden>
        
        <button type="submit">Register</button>
    </form>
    <?php if (!empty($message)) echo "<p>$message</p>"; ?> 
    <p>Already have an account? <a href="login.php">Login here</a>.</p>
     <p>Go back to <a href="index.php">Home</a>.</p>
</div>
</body>
</html>
