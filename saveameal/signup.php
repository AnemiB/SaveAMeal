<?php  
session_start(); // Start the session

require 'config.php'; // Include the config file to connect to the database

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Get form input values
    $username = $_POST['username'];
    $confirm_username = $_POST['confirm_username'];
    $email = $_POST['email'];
    $confirm_email = $_POST['confirm_email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Validate that username, email, and password match their confirmations
    if ($username != $confirm_username) {
        echo "Usernames do not match.";
    } elseif ($email != $confirm_email) {
        echo "Emails do not match.";
    } elseif ($password != $confirm_password) {
        echo "Passwords do not match.";
    } else {
        // Hash the password for security
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Prepare the SQL query to insert user data into the database
        $sql = "INSERT INTO users (username, email, password, created_at) VALUES (?, ?, ?, NOW())";

        // Prepare the SQL statement
        $stmt = $conn->prepare($sql);

        // Bind parameters to the SQL query
        $stmt->bind_param("sss", $username, $email, $hashed_password);

        // Execute the query and check for success
        if ($stmt->execute()) {
            // Redirect to the login page immediately without delay
            header("Location: index.php");
            exit(); // Ensure the script terminates after the redirect
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        // Close the statement
        $stmt->close();
    }

    // Close the database connection
    $conn->close();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - SaveAMeal</title>
    <link rel="stylesheet" href="css/signup.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&family=Pacifico&display=swap" rel="stylesheet">
</head>
<body>
    <div class="signup-container">
        <form class="signup-form" action="signup.php" method="post">
            <h2>Welcome to SaveAMeal!</h2>
            <h3>Sign Up</h3>
            
            <label for="username">Username</label>
            <input type="text" id="username" name="username" placeholder="Enter your username" required>

            <label for="confirm-username">Confirm Username</label>
            <input type="text" id="confirm-username" name="confirm_username" placeholder="Confirm your username" required>

            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="Enter your email" required>

            <label for="confirm-email">Confirm Email</label>
            <input type="email" id="confirm-email" name="confirm_email" placeholder="Confirm your email" required>

            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Enter your password" required>

            <label for="confirm-password">Confirm Password</label>
            <input type="password" id="confirm-password" name="confirm_password" placeholder="Confirm your password" required>

            <button type="submit">Sign Up</button>
        </form>
        <a href="index.php" class="signup-link">To Log In</a>
    </div>
</body>
</html>
