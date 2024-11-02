<?php
include '../config.php'; // Include your database connection
session_start(); // Start the session to access session variables

// Ensure the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: ../index.php");
    exit();
}

// Fetch current user details
$user_id = $_SESSION['user_id'];
$sql = "SELECT username, email FROM users WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$user_result = $stmt->get_result();
$user = $user_result->fetch_assoc();

// Handle form submission for updating username, email, and password
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $new_username = $_POST['new_username'];
    $new_email = $_POST['new_email'];
    $old_password = $_POST['old_password'];
    $new_password = $_POST['new_password'];

    // Validate inputs
    $update_needed = false;

    if (!empty($new_username)) {
        $update_needed = true;
        $update_sql = "UPDATE users SET username = ? WHERE user_id = ?";
        $update_stmt = $conn->prepare($update_sql);
        $update_stmt->bind_param("si", $new_username, $user_id);
        $update_stmt->execute();
        $update_stmt->close();
    }

    if (!empty($new_email)) {
        $update_needed = true;
        $update_sql = "UPDATE users SET email = ? WHERE user_id = ?";
        $update_stmt = $conn->prepare($update_sql);
        $update_stmt->bind_param("si", $new_email, $user_id);
        $update_stmt->execute();
        $update_stmt->close();
    }

    if (!empty($old_password) && !empty($new_password)) {
        // Verify old password
        $sql = "SELECT password FROM users WHERE user_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $password_result = $stmt->get_result();
        $user_data = $password_result->fetch_assoc();
        $stored_password = $user_data['password'];

        if (password_verify($old_password, $stored_password)) {
            $update_needed = true;
            $hashed_password = password_hash($new_password, PASSWORD_BCRYPT);
            $update_sql = "UPDATE users SET password = ? WHERE user_id = ?";
            $update_stmt = $conn->prepare($update_sql);
            $update_stmt->bind_param("si", $hashed_password, $user_id);
            $update_stmt->execute();
            $update_stmt->close();
        } else {
            echo "<script>alert('Old password is incorrect.');</script>";
        }
    }

    if ($update_needed) {
        echo "<script>alert('Profile updated successfully.'); window.location.href = 'profile.php';</script>";
    } else {
        echo "<script>alert('Please fill in all fields.');</script>";
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="SaveAMeal offers budget-friendly, nutritious meals perfect for individuals and families on a tight budget. Discover affordable, healthy meal options and create meals for others.">
    <meta name="keywords" content="budget meals, healthy meals, nutritious food, affordable meals, family meals, healthy eating, SaveAMeal, low-cost food, budget-friendly, meals under R150">
    <meta name="author" content="SaveAMeal, Inc">
    <title>Profile</title>
    <link rel="icon" type="image/x-icon" href="../images/logo.png">
    <link rel="stylesheet" href="../css/profile.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato&family=Pacifico&display=swap" rel="stylesheet">
</head>
<body>
<header>
        <nav>
            <div class="search-bar">
                <input type="text" placeholder="Search">
                <button>🔍</button>
            </div>
            <div class="logo">
             <a href="main.php">
                <img src="../images/logo.png" alt="Logo" height="50px" width="50px">
            </div>
            <ul>
                <li><a href="../pages/main.php">Meals</a></li>
                <li><a href="../pages/create_meal.php">Create Meal</a></li>
                <li><a href="../pages/profile.php">Profile</a></li>
                <li><a href="../logout.php">Log Out</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <h1>Profile</h1>
        <form action="profile.php" method="post">
            <label for="old_username">Old Username:</label>
            <input type="text" id="old_username" name="old_username" value="<?php echo htmlspecialchars($user['username']); ?>" readonly>
            </br>
            <label for="new_username">New Username:</label>
            <input type="text" id="new_username" name="new_username" placeholder="Enter new username">
            </br>
            <label for="old_email">Old Email:</label>
            <input type="email" id="old_email" name="old_email" value="<?php echo htmlspecialchars($user['email']); ?>" readonly>
            </br>
            <label for="new_email">New Email:</label>
            <input type="email" id="new_email" name="new_email" placeholder="Enter new email">
            </br>
            <label for="old_password">Old Password:</label>
            <input type="password" id="old_password" name="old_password" placeholder="Enter old password">
            </br>
            <label for="new_password">New Password:</label>
            <input type="password" id="new_password" name="new_password" placeholder="Enter new password">
            </br>
            <button type="submit">Update Profile</button>
        </form>
    </main>
</body>
<footer>
    <div class="footer-nav">
        <a href="./main.php">Meals</a>
        <a href="./create_meal.php">Create Meal</a>
        <a href="./profile.php">Profile</a>
        <a href="#">About</a>
        <a href="../logout.php">Log Out</a>
    </div>
    <hr>
    </br>
    <p>&copy; 2024 SaveAMeal, Inc</p>
    </br>
    <p style="font-size: x-small">*This is a student project</p>
</footer>
</html>
