<?php
session_start(); // Start session

require '../config.php'; // Include the config file

// Ensure the user is logged in
if (!isset($_SESSION['user_id'])) {
    echo "<script>alert('You need to log in to edit a meal.'); window.location.href = '../index.php';</script>";
    exit();
}

// Check if the meal ID is provided in the URL
if (isset($_GET['meal_id'])) {
    $meal_id = $_GET['meal_id'];

    // Fetch the meal details from the database
    $sql = "SELECT meal_name, ingredients, calories, cost, prep_time, instructions, meal_image FROM meals WHERE meal_id = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("i", $meal_id);
        $stmt->execute();
        $stmt->bind_result($meal_name, $ingredients, $calories, $cost, $prep_time, $instructions, $meal_image);
        $stmt->fetch();
        $stmt->close();
    } else {
        echo "Error in preparing statement: " . $conn->error;
        exit();
    }
}

// Handle the form submission to update the meal
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $meal_name = $_POST['meal_name'];
    $ingredients = $_POST['ingredients'];
    $calories = $_POST['calories'];
    $cost = $_POST['cost'];
    $prep_time = $_POST['prep_time'];
    $instructions = $_POST['instructions'];
    $new_image = $meal_image; // Default to the existing image

    // Handle optional image upload
    if (!empty($_FILES["image"]["name"])) {
        $target_dir = "../uploads/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);

        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            $new_image = $target_file; // Update the image path if upload succeeds
        } else {
            echo "<script>alert('Sorry, there was an error uploading your file.');</script>";
        }
    }

    // Update the meal details in the database
    $sql = "UPDATE meals SET meal_name = ?, ingredients = ?, calories = ?, cost = ?, prep_time = ?, instructions = ?, meal_image = ? WHERE meal_id = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("ssdsdssi", $meal_name, $ingredients, $calories, $cost, $prep_time, $instructions, $new_image, $meal_id);

        if ($stmt->execute()) {
            echo "<script>alert('Meal updated successfully'); window.location.href = '../pages/main.php';</script>";
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Error in preparing statement: " . $conn->error;
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Meal</title>
    <link rel="stylesheet" href="../css/edit_meal.css">
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
    <h1>Edit Meal</h1>
    <form action="edit_meal.php?meal_id=<?php echo $meal_id; ?>" method="post" enctype="multipart/form-data">
        <label for="meal_name">Meal Name</label>
        <input type="text" id="meal_name" name="meal_name" value="<?php echo htmlspecialchars($meal_name); ?>" required>

        <label for="ingredients">Ingredients</label>
        <textarea id="ingredients" name="ingredients" required><?php echo htmlspecialchars($ingredients); ?></textarea>

        <label for="calories">Calories</label>
        <input type="number" id="calories" name="calories" value="<?php echo $calories; ?>" required>

        <label for="cost">Cost (R)</label>
        <input type="text" id="cost" name="cost" value="<?php echo $cost; ?>" required>

        <label for="prep_time">Preparation Time</label>
        <input type="text" id="prep_time" name="prep_time" value="<?php echo htmlspecialchars($prep_time); ?>" required>

        <label for="instructions">Instructions</label>
        <textarea id="instructions" name="instructions" required><?php echo htmlspecialchars($instructions); ?></textarea>

        <label for="image">Upload New Image (Optional)</label>
        <input type="file" id="image" name="image">
        <?php if ($meal_image): ?>
            <p>Current Image: <img src="<?php echo $meal_image; ?>" alt="Meal Image" height="100"></p>
        <?php endif; ?>

        <button type="submit">Update Meal</button>
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
