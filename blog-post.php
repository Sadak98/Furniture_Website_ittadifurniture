<?php
include 'include/config.php';

$post_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Fetch the specific blog post from the database
$sql = "SELECT title, topic1_title, topic1_content, topic2_title, topic2_content, published_date FROM blog_posts WHERE id = ? ";
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

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($post['title']); ?> - Ityadi Furniture</title>
    <link rel="shortcut icon" href="img/logo.jpg" type="image/x-icon">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="css/blog-style.css">
    <link rel="stylesheet" href="css/style.css">
    <style>
        .content-section {
    background-color: #f1f1f1; /* Lighter gray background */
    border-radius: 8px;        /* Slightly rounded corners */
    padding: 15px;             /* Padding around the content */
    margin-bottom: 20px;       /* Space between sections */
    overflow-wrap: break-word; /* Ensures long text breaks properly */
    word-wrap: break-word;     /* For older browsers */
    word-break: break-word;    /* Break long words */
}
.content-section h2 {
    font-size: 24px;          /* Adjust title font size */
    overflow-wrap: break-word; /* Ensures long titles wrap properly */
    word-break: break-all;     /* Break long titles */
    white-space: normal;       /* Prevent long text from expanding */
}
.title {
            font-size: 30px;
            /* Adjust title font size */
            overflow-wrap: break-word;
            /* Ensures long titles wrap properly */
            word-break: break-all;
            /* Break long titles */
            white-space: normal;
            /* Prevent long text from expanding */
        }
        .blog-image {
            width: 100%;
            /* or a specific width, e.g., 600px */

            max-height: 600px;
            /* Optional: to limit the maximum height */

            border-radius: 10px;
            /* Optional: to add rounded corners */
        }

    </style>
</head>

<body>

    <?php include 'include/navbar.html'; ?> <!-- Include header -->

    <main class="container">
        <article>
            <h1 class="text-center title"><?php echo htmlspecialchars($post['title']); ?></h1>
            <p class="text-muted text-center"><?php echo date("F d, Y", strtotime($post['published_date'])); ?></p>

            <!-- Carousel for blog images -->
            <div id="carouselExampleIndicators" class="carousel slide mb-4" data-ride="carousel" data-interval="3000">
                <div class="carousel-inner">
                    <?php
                    $active = 'active';
                    $sql_img = "SELECT image FROM blog_images WHERE blog_post_id = ?";
                    $stmt_img = $conn->prepare($sql_img);
                    $stmt_img->bind_param("i", $post_id);
                    $stmt_img->execute();
                    $result_img = $stmt_img->get_result();
                    while ($img = $result_img->fetch_assoc()):
                    ?>
                        <div class="carousel-item <?php echo $active; ?>">
                            <img src="<?php echo 'uploads/' . $img['image']; ?>" class="d-block img-fluid mx-auto blog-image" alt="Blog Image">

                        </div>
                    <?php
                        $active = ''; // Only the first item should be active
                    endwhile;
                    $stmt_img->close();
                    ?>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>

            <!-- Display the first section with background and border radius -->
            <div class="content-section">
                <h2><?php echo htmlspecialchars($post['topic1_title']); ?></h2>
                <p><?php echo nl2br($post['topic1_content']); ?></p>
            </div>

            <!-- Display the second section with background and border radius -->
            <div class="content-section">
                <h2><?php echo htmlspecialchars($post['topic2_title']); ?></h2>
                <p><?php echo nl2br($post['topic2_content']); ?></p>
            </div>
        </article>
    </main>
    <div class="container my-4 text-center">
        <h5>Share this post:</h5>
        <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode('http://ittadifurniture.com/blog-post.php?id=' . $post_id); ?>" target="_blank" class="btn btn-primary btn-sm mx-2">
            <i class="fab fa-facebook-f"></i> Facebook
        </a>
        <a href="https://twitter.com/intent/tweet?url=<?php echo urlencode('http://ittadifurniture.com/blog-post.php?id=' . $post_id); ?>&text=<?php echo urlencode($post['title']); ?>" target="_blank" class="btn btn-info btn-sm mx-2">
            <i class="fab fa-twitter"></i> Twitter
        </a>
        <a href="https://wa.me/?text=<?php echo urlencode('Check out this post: http://ittadifurniture.com/blog-post.php?id=' . $post_id); ?>" target="_blank" class="btn btn-success btn-sm mx-2">
            <i class="fab fa-whatsapp"></i> WhatsApp
        </a>
    </div>
    

    <?php include 'include/footer.html'; ?> <!-- Include footer -->

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="js/drop.js"></script>

</body>

</html>

<?php
$conn->close();
?>