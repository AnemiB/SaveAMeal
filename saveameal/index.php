<?php  
session_start(); // Start the session

require 'config.php'; // Include the config file for database connection

// Check if the form has been submitted 
if ($_SERVER["REQUEST_METHOD"] == "POST") { 
    // Sanitize and retrieve input
    $username = trim($_POST['username']); 
    $password = trim($_POST['password']); 
    
    // Check if username or password is empty
    if (empty($username) || empty($password)) {
        // Use a JavaScript alert to notify the user (optional)
        echo "<script>alert('Please enter both username and password.');</script>";
    } else {
        // SQL query to find the user by username
        $sql = "SELECT * FROM users WHERE username = ?"; 
        
        // Prepare the SQL statement 
        if ($stmt = $conn->prepare($sql)) { 
            // Bind the username to the SQL statement 
            $stmt->bind_param("s", $username); 
            
            // Execute the SQL statement 
            $stmt->execute(); 
            
            // Store the result in the 'result' variable 
            $result = $stmt->get_result(); 
            
            // Check if user exists 
            if ($result->num_rows > 0) { 
                // Fetch user data 
                $user = $result->fetch_assoc(); 
                
                // Verify the password using password_verify()
                if (password_verify($password, $user['password'])) { 
                    // Store user information in session 
                    $_SESSION['user_id'] = $user['user_id']; // Store user_id for session-based functionality
                    $_SESSION['role'] = $user['role']; // Store the user's role (admin or user)
                    
                    // Redirect based on role
                    header("Location: pages/main.php"); 
                    
                    exit(); // Terminate the script to ensure redirection 
                } else { 
                    // Incorrect password
                    echo "<script>alert('Invalid password.');</script>"; 
                } 
            } else { 
                // Username not found
                echo "<script>alert('Username not found.');</script>"; 
            } 
            $stmt->close(); 
        } else {
            echo "Error preparing the query: " . $conn->error;
        }
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
    <title>Login - SaveAMeal</title>
    <link rel="stylesheet" href="css/login.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&family=Pacifico&display=swap" rel="stylesheet">
</head>
<body>
    <div class="login-container">
        <form class="login-form" action="index.php" method="post">
            <h2>Welcome Back to SaveAMeal!</h2>
            <h3>Log In</h3>
            <label for="username">Username</label>
            <input type="text" id="username" name="username" placeholder="Enter your username" required>
        
            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Enter your password" required>
        
            <button type="submit">Log In</button>
        </form>

        <a href="signup.php" class="signup-link">To Sign Up</a>
    </div>
</body>
</html>
