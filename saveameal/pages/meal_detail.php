<?php
include '../config.php';
session_start();

// Check if the meal_id is provided in the URL
$meal_id = isset($_GET['meal_id']) ? (int)$_GET['meal_id'] : 0;

if ($meal_id == 0) {
    echo "Invalid meal selected.";
    exit;
}

// Fetch the meal details from the database
$sql = "SELECT m.meal_name, m.ingredients, m.calories, m.prep_time, m.instructions, m.cost, m.meal_image, u.username 
        FROM meals m 
        JOIN users u ON m.user_id = u.user_id 
        WHERE m.meal_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $meal_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $meal = $result->fetch_assoc();
} else {
    echo "Meal not found.";
    exit;
}

// Handle comment form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['comment'])) {
    $comment_body = $_POST['comment'];
    $user_id = $_SESSION['user_id']; // Assuming user ID is stored in session

    // Insert comment into the database
    $insert_comment_sql = "INSERT INTO comments (meal_id, user_id, comment_body) VALUES (?, ?, ?)";
    $insert_comment_stmt = $conn->prepare($insert_comment_sql);
    $insert_comment_stmt->bind_param("iis", $meal_id, $user_id, $comment_body);

    if ($insert_comment_stmt->execute()) {
        // Redirect to the same page to display the new comment
        header("Location: meal_detail.php?meal_id=" . $meal_id);
        exit();
    } else {
        echo "Error: " . $insert_comment_stmt->error;
    }
    $insert_comment_stmt->close();
}

// Handle the like/unlike requests via AJAX
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['comment_id'])) {
    $user_id = $_SESSION['user_id'];
    $comment_id = $_POST['comment_id'];
    
    // Check if the user already liked this comment
    $check_like_sql = "SELECT * FROM likes WHERE user_id = ? AND comment_id = ?";
    $check_like_stmt = $conn->prepare($check_like_sql);
    $check_like_stmt->bind_param("ii", $user_id, $comment_id);
    $check_like_stmt->execute();
    $check_like_result = $check_like_stmt->get_result();

    if ($check_like_result->num_rows > 0) {
        // If the like exists, delete it (unlike)
        $delete_like_sql = "DELETE FROM likes WHERE user_id = ? AND comment_id = ?";
        $delete_like_stmt = $conn->prepare($delete_like_sql);
        $delete_like_stmt->bind_param("ii", $user_id, $comment_id);
        $delete_like_stmt->execute();
    } else {
        // If no like exists, insert a new like
        $insert_like_sql = "INSERT INTO likes (user_id, comment_id, status) VALUES (?, ?, 1)";
        $insert_like_stmt = $conn->prepare($insert_like_sql);
        $insert_like_stmt->bind_param("ii", $user_id, $comment_id);
        $insert_like_stmt->execute();
    }

    // Get the updated like count
    $like_count_sql = "SELECT COUNT(*) AS like_count FROM likes WHERE comment_id = ? AND status = 1";
    $like_count_stmt = $conn->prepare($like_count_sql);
    $like_count_stmt->bind_param("i", $comment_id);
    $like_count_stmt->execute();
    $like_count_result = $like_count_stmt->get_result();
    $like_count_row = $like_count_result->fetch_assoc();
    $like_count = $like_count_row['like_count'];

    echo json_encode(['success' => true, 'like_count' => $like_count]);
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="SaveAMeal offers budget-friendly, nutritious meals perfect for individuals and families on a tight budget. Discover affordable, healthy meal options and create meals for others.">
    <meta name="keywords" content="budget meals, healthy meals, nutritious food, affordable meals, family meals, healthy eating, SaveAMeal, low-cost food, budget-friendly, meals under R150">
    <meta name="author" content="SaveAMeal, Inc">
    <title><?php echo htmlspecialchars($meal['meal_name']); ?> - Meal Details</title>
    <link rel="icon" type="image/x-icon" href="../images/logo.png">
    <link rel="stylesheet" href="../css/meal_detail.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato&family=Pacifico&display=swap" rel="stylesheet">
    <script>
        function showAlert() {
            alert('Thank you for the meal!');
        }
    </script>
</head>
<body>
<header>
    <nav>
        <form method="GET" action="">
            <div class="search-bar">
                <input type="text" name="search" placeholder="Search">
                <button type="submit">🔍</button>
            </div>
        </form>
        <div class="logo">
          <a href="main.php">
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
        <div class="meal-detail">
            <h1><?php echo htmlspecialchars($meal['meal_name']); ?></h1>
            <p>Posted by: <?php echo htmlspecialchars($meal['username']); ?></p>
            
            <!-- Meal Image -->
            <div class="meal-image">
                <img src="<?php echo htmlspecialchars($meal['meal_image']); ?>" alt="Meal Image">
            </div>
            
            </br>

            <!-- Meal Details -->
            <div class="meal-info">
                <p><strong>Ingredients:</strong> <?php echo htmlspecialchars($meal['ingredients']); ?></p>
                <p><strong>Calories:</strong> <?php echo htmlspecialchars($meal['calories']); ?> calories per serving</p>
                <p><strong>Preparation time:</strong> <?php echo htmlspecialchars($meal['prep_time']); ?> minutes</p>
                <p><strong>Cost:</strong> R <?php echo htmlspecialchars($meal['cost']); ?></p>
            </div>

            <!-- Cooking Instructions -->
            <div class="instructions">
                <h2>Cooking Instructions:</h2>
                <p><?php echo nl2br(htmlspecialchars($meal['instructions'])); ?></p>
            </div>

            <button class="buy-button" id="buyButton" onclick="showAlert()">Buy Meal</button>
        </div>

        <!-- Comments Section -->
        <div class="comments-section">
            <h2>Comments</h2>
            <form method="POST" action="">
                <input type="hidden" name="meal_id" value="<?php echo $meal_id; ?>">
                <textarea name="comment" placeholder="Add a comment..." required></textarea>
                <button type="submit">Post Comment</button>
            </form>
            </br>
            <?php
    $comment_sql = "SELECT c.comment_id, c.comment_body, u.username,
                    (SELECT COUNT(*) FROM likes l WHERE l.comment_id = c.comment_id AND l.status = 1) AS like_count,
                    (SELECT COUNT(*) FROM likes l WHERE l.user_id = ? AND l.comment_id = c.comment_id) AS user_like_status
                    FROM comments c
                    JOIN users u ON c.user_id = u.user_id
                    WHERE c.meal_id = ? 
                    ORDER BY c.comment_id DESC";
    $comment_stmt = $conn->prepare($comment_sql);
    $comment_stmt->bind_param('ii', $_SESSION['user_id'], $meal_id);
    $comment_stmt->execute();
    $comments_result = $comment_stmt->get_result();

    if ($comments_result->num_rows > 0) {
        while ($comment = $comments_result->fetch_assoc()) {
            echo "<div class='comment'>";
            echo "<p><strong>" . htmlspecialchars($comment['username']) . ":</strong> " . htmlspecialchars($comment['comment_body']) . "</p>";
    
            // Handle the like count
            $like_count = isset($comment['like_count']) ? $comment['like_count'] : 0;
    
            // Determine the initial state of the like button
            $like_img = $comment['user_like_status'] > 0 ? '../images/like.svg' : '../images/notlike.svg';
    
            // Display the like button with the correct state
            echo '<img src="' . htmlspecialchars($like_img) . '" alt="Like Button" 
                    class="like-btn" data-comment-id="' . htmlspecialchars($comment['comment_id']) . '" 
                    data-like-type="comment">';
    
            // Display the like count
            echo '<span class="like-count" id="like-count-' . htmlspecialchars($comment['comment_id']) . '">' . htmlspecialchars($like_count) . '</span>';
            echo "</div>";
        }
    } else {
        echo "<p>No comments yet.</p>";
    }
    
    ?>
</div>
        </div>
    </main>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).on('click', '.like-btn', function() {
    var commentId = $(this).data('comment-id');
    var img = $(this);
    var countSpan = $('#like-count-' + commentId);

    $.post('meal_detail.php?meal_id=<?php echo $meal_id; ?>', {
        comment_id: commentId
    }, function(response) {
        response = JSON.parse(response);
        if (response.success) {
            var likeCount = response.like_count;

            // Update the like count
            countSpan.text(likeCount);

            // Toggle the like button image based on the current state
            if (img.attr('src').includes('notlike.svg')) {
                img.attr('src', '../images/like.svg'); // Change to liked state
            } else {
                img.attr('src', '../images/notlike.svg'); // Change to unliked state
            }
        } else {
            console.error('Failed to update like status.');
        }
    });
});



</script>
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
