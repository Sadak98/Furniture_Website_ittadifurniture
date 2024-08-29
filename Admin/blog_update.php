<?php
include 'config.php';

// Get the post ID from the query parameter
$post_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Fetch the blog post details
$sql = "SELECT title, topic1_title, topic1_content, topic2_title, topic2_content, published_date FROM blog_posts WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $post_id);
$stmt->execute();
$result = $stmt->get_result();
$post = $result->fetch_assoc();

if (!$post) {
    echo "Post not found!";
    exit;
}

$stmt->close();
?>
<style>
    h2 {
        background-color: #0056b3;
        color: white !important;
        padding: 10px 20px;
        border-radius: 8px 8px 0 0;
        margin-top: 0;
        margin-bottom: 20px;
    }
</style>
<?php include 'sidebar.php'; ?>


<div class="col-lg-10 col-md-12">
    <!-- Content section -->
    <div class="container mt-3 mb-5">
        <h2>Update Blog ID=<?php echo $post_id; ?></h2>
        <form action="blog_upd_action.php?id=<?php echo $post_id; ?>" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="title">Blog Title</label>
                <input type="text" class="form-control" id="title" name="title" value="<?php echo htmlspecialchars($post['title']); ?>" required>
            </div>
            <div class="form-group">
                <label for="topic1_title">First Section Title</label>
                <input type="text" class="form-control" id="topic1_title" name="topic1_title" value="<?php echo htmlspecialchars($post['topic1_title']); ?>" required>
            </div>
            <div class="form-group">
                <label for="topic1_content">First Section Content</label>
                <textarea class="form-control" id="topic1_content" name="topic1_content" rows="3" required><?php echo htmlspecialchars($post['topic1_content']); ?></textarea>
            </div>
            <div class="form-group">
                <label for="topic2_title">Second Section Title</label>
                <input type="text" class="form-control" id="topic2_title" name="topic2_title" value="<?php echo htmlspecialchars($post['topic2_title']); ?>" required>
            </div>
            <div class="form-group">
                <label for="topic2_content">Second Section Content</label>
                <textarea class="form-control" id="topic2_content" name="topic2_content" rows="3" required><?php echo htmlspecialchars($post['topic2_content']); ?></textarea>
            </div>

            <div class="form-group">
                <label for="published_date">Published Date</label>
                <input type="date" class="form-control" id="published_date" name="published_date" value="<?php echo $post['published_date']; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</div>

<div class="dark-overlay"></div>
<!-- Bootstrap and Popper.js JavaScript for responsive behavior -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"
    integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"
    integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>

<script>
    // JavaScript for image preview
    document.getElementById('images').addEventListener('change', function(event) {
        const imagePreview = document.getElementById('imagePreview');
        imagePreview.innerHTML = '';
        for (let i = 0; i < event.target.files.length; i++) {
            const img = document.createElement('img');
            img.src = URL.createObjectURL(event.target.files[i]);
            img.classList.add('preview-image');
            imagePreview.appendChild(img);
        }
    });
</script>
</body>

</html>