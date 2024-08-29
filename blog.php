<?php
include 'include/config.php';
// Fetch blog posts with their first image from the database
$sql = "SELECT bp.id, bp.title, bp.topic1_title, bp.topic1_content, bp.topic2_title, bp.topic2_content, bp.published_date, MIN(bi.image) AS image
                        FROM blog_posts bp
                        LEFT JOIN blog_images bi ON bp.id = bi.blog_post_id
                        GROUP BY bp.id, bp.title, bp.topic1_title, bp.topic1_content, bp.topic2_title, bp.topic2_content, bp.published_date
                        ORDER BY bp.id DESC";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog - Ityadi Furniture</title>
    <link rel="shortcut icon" href="img/logo.jpg" type="image/x-icon">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="css/blog-style.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <?php include 'include/navbar.html'; ?>

    <main class="container">
        <h2 class="text-center">Ityadi Furniture Blog</h2>


        <div class="row mt-4">
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="col-md-4">
                    <div class="card mb-4">
                        <img src="<?php echo 'uploads/' . $row['image'] ?: 'https://via.placeholder.com/300x200'; ?>" class="card-img-top" alt="Blog Image">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($row['title']); ?></h5>
                            <p class="card-text"><small class="text-muted"><?php echo date("F d, Y", strtotime($row['published_date'])); ?></small></p>
                            <p class="card-text"><?php echo substr(strip_tags($row['topic1_content']), 0, 50); ?>...</p>
                            <a href="blog-post.php?id=<?php echo $row['id']; ?>" class="btn btn-primary">Read More</a>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>

        <!-- Pagination (if needed) -->
        <!-- Add pagination code here if necessary -->
    </main>

    <?php include 'include/footer.html'; ?>




    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="js/drop.js"></script>

</body>

</html>

<?php
$conn->close();
?>