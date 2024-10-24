<?php
session_start(); // Start the session

require '../config.php'; // Include the config file for database connection

// Ensure the session user_id is set
if (!isset($_SESSION['user_id'])) {
    echo "<script>alert('You need to log in to create a meal.'); window.location.href = '../index.php';</script>";
    exit();
}

// Handle form submission and meal creation
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_SESSION['user_id']; // Get the logged-in user's ID from the session
    $meal_name = $_POST['meal_name'];
    $ingredients = $_POST['ingredients'];
    $calories = $_POST['calories']; // Get calories from the form
    $cost = $_POST['cost'];
    $prep_time = $_POST['prep_time'];
    $instructions = $_POST['instructions'];
    $meal_image = null; // Initialize image path as null

    // Handle optional image upload
    if (!empty($_FILES["image"]["name"])) {
        $target_dir = "../uploads/"; // Ensure the uploads folder exists in the correct directory
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            $meal_image = $target_file; // Store the image path if upload is successful
        } else {
            echo "<script>alert('Sorry, there was an error uploading your file.');</script>";
        }
    }

    // Insert meal details into the database
    $sql = "INSERT INTO meals (user_id, meal_name, ingredients, calories, cost, prep_time, instructions, meal_image, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, NOW())";
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        echo "Error in preparing statement: " . $conn->error;
        exit();
    }
    
    $stmt->bind_param("issdssss", $user_id, $meal_name, $ingredients, $calories, $cost, $prep_time, $instructions, $meal_image);
    
    if ($stmt->execute()) {
        echo "<script>alert('New meal created successfully'); window.location.href = '../pages/main.php';</script>";
    } else {
        echo "Error: " . $stmt->error;
    }
    
    $stmt->close();
    $conn->close(); 
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Meal</title>
    <link rel="stylesheet" href="../css/create_meal.css">
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
        <h1>Create a New Meal</h1>
        <form action="create_meal.php" method="post" enctype="multipart/form-data">
            <label for="meal_name">Meal Name</label>
            <input type="text" id="meal_name" name="meal_name" placeholder="Enter meal name" required>
            
            <label for="ingredients">Ingredients</label>
            <textarea id="ingredients" name="ingredients" placeholder="List ingredients" required></textarea>
            
            <label for="calories">Calories</label>
            <input type="number" id="calories" name="calories" placeholder="Enter calories" required>
            
            <label for="cost">Cost (R)</label>
            <input type="text" id="cost" name="cost" placeholder="Enter cost" required>
            
            <label for="prep_time">Preparation Time</label>
            <input type="text" id="prep_time" name="prep_time" placeholder="Enter preparation time" required>
            
            <label for="instructions">Instructions</label>
            <textarea id="instructions" name="instructions" placeholder="Enter cooking instructions" required></textarea>
            
            <label for="image">Upload Image</label>
            <input type="file" id="image" name="image">
            
            <button type="submit" class="post">Create Meal</button>
        </form>
    </main>
</body>
<footer>
    <div class="footer-nav">
        <a href="./main.php">Meals</a>
        <a href="./create_meal.php">Create Meal</a>
        <a href="./profile.php">Profile</a>
        <a href="../logout.php">Log Out</a>
        <a href="#">About</a>
    </div>
    <hr>
    <p>&copy; 2024 SaveAMeal, Inc</p>
</footer>
</html>
