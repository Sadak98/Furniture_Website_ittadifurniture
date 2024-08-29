<?php
include 'config.php';

$post_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $topic1_title = $_POST['topic1_title'];
    $topic1_content = $_POST['topic1_content'];
    $topic2_title = $_POST['topic2_title'];
    $topic2_content = $_POST['topic2_content'];
    $published_date = $_POST['published_date'];

    // Update the blog post in the database
    $stmt = $conn->prepare("UPDATE blog_posts SET title = ?, topic1_title = ?, topic1_content = ?, topic2_title = ?, topic2_content = ?, published_date = ? WHERE id = ?");
    $stmt->bind_param("ssssssi", $title, $topic1_title, $topic1_content, $topic2_title, $topic2_content, $published_date, $post_id);

    if ($stmt->execute()) {
        // Handle multiple image uploads (if new images are uploaded)
        if (!empty($_FILES['images']['name'][0])) {
            $upload_dir = '../uploads/';
            if (!file_exists($upload_dir)) {
                mkdir($upload_dir, 0777, true);
            }

            foreach ($_FILES['images']['name'] as $key => $image_name) {
                if ($_FILES['images']['error'][$key] == 0) {
                    $image_filename = basename($image_name);
                    $image_path = $upload_dir . $image_filename;
                    if (move_uploaded_file($_FILES['images']['tmp_name'][$key], $image_path)) {
                        // Insert new image path into the blog_images table
                        $stmt_img = $conn->prepare("INSERT INTO blog_images (blog_post_id, image) VALUES (?, ?)");
                        $stmt_img->bind_param("is", $post_id, $image_filename);
                        $stmt_img->execute();
                        $stmt_img->close();
                    }
                }
            }
        }

        echo "<script>
            alert('Blog post updated successfully!');
            window.location.href = 'blog_view.php';
        </script>";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
