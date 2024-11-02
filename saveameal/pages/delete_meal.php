<?php
include '../config.php'; 
session_start();

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate that meal_id is set and is a valid integer
    if (isset($_POST['meal_id']) && is_numeric($_POST['meal_id'])) {
        $meal_id = intval($_POST['meal_id']);

        // Check if the user is an admin
        if ($_SESSION['role'] === 'admin') {
            // Admin can permanently delete the meal
            $sql = "DELETE FROM meals WHERE meal_id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $meal_id);
        } else {
            // Regular user can mark the meal as inactive
            $sql = "UPDATE meals SET status = 'inactive' WHERE meal_id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $meal_id);
        }

        if ($stmt->execute()) {
            // Redirect to main page with a success message
            if ($_SESSION['role'] === 'admin') {
                header("Location: main.php?message=Meal+deleted+successfully");
            } else {
                header("Location: main.php?message=Meal+marked+as+inactive");
            }
            exit();
        } else {
            echo "Error processing request: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Invalid meal ID.";
    }
} else {
    echo "Invalid request method.";
}

// Close the database connection
$conn->close();
?>
