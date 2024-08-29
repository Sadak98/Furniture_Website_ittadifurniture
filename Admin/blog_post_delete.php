<?php
session_start(); // Start the session

// Check if the user is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    $_SESSION['error'] = 'You are not allowed to access this page. Please log in as admin.';
    echo '<script>alert("You are not allowed to access this page. Please log in as admin.");';
    echo 'window.location.href = "Admin_Login.php";</script>';
    exit();
}

// Check if an ID is provided in the URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo '<script>alert("Invalid request.");';
    echo 'window.location.href = "blog_view.php";</script>';
    exit();
}

include '../config.php'; // Include your database connection file

$post_id = intval($_GET['id']); // Get the blog post ID from the URL

// First, delete associated images from the blog_images table
$sql = "DELETE FROM blog_images WHERE blog_post_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $post_id);
$stmt->execute();
$stmt->close();

// Now, delete the blog post from the blog_posts table
$sql = "DELETE FROM blog_posts WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $post_id);

if ($stmt->execute()) {
    echo '<script>alert("Blog post deleted successfully!");';
    echo 'window.location.href = "blog_view.php";</script>';
} else {
    echo '<script>alert("Error deleting blog post.");';
    echo 'window.location.href = "blog_view.php";</script>';
}

$stmt->close();
$conn->close();
?>
