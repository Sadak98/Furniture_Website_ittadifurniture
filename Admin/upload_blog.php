<?php
include 'config.php';

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $topic1_title = $_POST['topic1_title'];
    $topic1_content = $_POST['topic1_content'];
    $topic2_title = $_POST['topic2_title'];
    $topic2_content = $_POST['topic2_content'];
    $published_date = $_POST['published_date'];

    // Insert the blog post
    $stmt = $conn->prepare("INSERT INTO blog_posts (title, topic1_title, topic1_content, topic2_title, topic2_content, published_date) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $title, $topic1_title, $topic1_content, $topic2_title, $topic2_content, $published_date);

    if ($stmt->execute()) {
        $blog_post_id = $stmt->insert_id;
        
        // Handle multiple file uploads
        $upload_dir = '../uploads/';
        if (!file_exists($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }

        foreach ($_FILES['images']['name'] as $key => $image_name) {
            if ($_FILES['images']['error'][$key] == 0) {
                $image_filename = basename($image_name);
                $image_path = $upload_dir . $image_filename;
                if (move_uploaded_file($_FILES['images']['tmp_name'][$key], $image_path)) {
                    // Insert image path into the blog_images table
                    $stmt_img = $conn->prepare("INSERT INTO blog_images (blog_post_id, image) VALUES (?, ?)");
                    $stmt_img->bind_param("is", $blog_post_id, $image_filename);
                    $stmt_img->execute();
                    $stmt_img->close();
                }
            }
        }
        // Use JavaScript to show an alert and redirect
        echo "<script>
            alert('New blog post uploaded successfully!');
            window.location.href = 'blog_upload.php';
        </script>";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
