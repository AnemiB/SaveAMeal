<?php
include '../config.php'; 
session_start();

$searchTerm = isset($_GET['search']) ? $_GET['search'] : '';
$searchTerm = $conn->real_escape_string($searchTerm);

// SQL query: Only show active meals for regular users, all meals for admin
if ($_SESSION['role'] === 'admin') {
    $sql = "SELECT m.meal_id, m.meal_name, m.ingredients, m.cost, m.meal_image, m.user_id, u.username, m.status 
            FROM meals m 
            JOIN users u ON m.user_id = u.user_id 
            WHERE (m.meal_name LIKE '%$searchTerm%' OR m.ingredients LIKE '%$searchTerm%')
            ORDER BY m.meal_id DESC";
} else {
    $sql = "SELECT m.meal_id, m.meal_name, m.ingredients, m.cost, m.meal_image, m.user_id, u.username 
            FROM meals m 
            JOIN users u ON m.user_id = u.user_id 
            WHERE (m.meal_name LIKE '%$searchTerm%' OR m.ingredients LIKE '%$searchTerm%')
            AND m.status = 'active'
            ORDER BY m.meal_id DESC";
}

$result = $conn->query($sql);

if (!$result) {
    echo "Error in SQL query: " . $conn->error;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main Feed</title>
    <link rel="stylesheet" href="../css/main.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato&family=Pacifico&display=swap" rel="stylesheet">
</head>
<body>
<header>
    <nav>
        <form method="GET" action="">
            <div class="search-bar">
                <input type="text" name="search" placeholder="Search" 
                       value="<?php echo htmlspecialchars($searchTerm); ?>">
                <button type="submit">🔍</button>
            </div>
        </form>
        <div class="logo">
            <img src="../images/logo.png" alt="Logo" height="50px" width="50px">
        </div>
        <ul>
            <li><a href="main.php">Meals</a></li>
            <li><a href="create_meal.php">Create Meal</a></li>
            <li><a href="profile.php">Profile</a></li>
            <li><a href="../logout.php">Log Out</a></li>
        </ul>
    </nav>
</header>
<main>
    <h1>Meals</h1>

    <div class="meals-grid">
        <?php
        if ($result->num_rows > 0) {
           
while ($row = $result->fetch_assoc()) {
    $meal_user_id = $row['user_id'];

    echo "<div class='meal-card'>";

    // Meal image container
    echo "<div class='meal-image-container'>";
    
    // Display meal image if available
    if ($row['meal_image']) {
        echo "<img src='" . htmlspecialchars($row['meal_image']) . "' alt='Meal Image'>";
    }

    // Show pending for deletion message if applicable
    if ($_SESSION['role'] === 'admin' && $row['status'] === 'inactive') {
        echo "<p class='pending-deletion'>Pending for deletion</p>";
    }

    echo "</div>"; // Close meal-image-container

    // Meal name linked to meal detail page
    echo "<p class='meal-name'>
            <a href='meal_detail.php?meal_id=" . htmlspecialchars($row['meal_id']) . "'>" . 
            htmlspecialchars($row['meal_name']) . 
          "</a></p>";

    // Ingredients
    echo "<p class='ingredients'>Ingredients: " . htmlspecialchars($row['ingredients']) . "</p>";

    // Meal price
    echo "<p class='price'>R " . htmlspecialchars($row['cost']) . "</p>";

    // Display Edit/Delete buttons for the owner or admin
    if (isset($_SESSION['user_id']) && 
        ($_SESSION['user_id'] == $meal_user_id || $_SESSION['role'] === 'admin')) {
        echo "<form action='delete_meal.php' method='post' style='display:inline;'>";
        echo "<input type='hidden' name='meal_id' value='" . htmlspecialchars($row['meal_id']) . "'>";
        echo "<button type='submit' class='delete-button' 
                    onclick='return confirm(\"Are you sure you want to delete this meal?\")'>
              Delete</button>";
        echo "</form>";

        echo "<a href='edit_meal.php?meal_id=" . htmlspecialchars($row['meal_id']) . "' class='edit-button'>Edit</a>";
    }

    echo "</div>"; // Close meal-card
}
        } else {
            echo "<p>No meals found.</p>";
        }
        ?>
    </div> 
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
