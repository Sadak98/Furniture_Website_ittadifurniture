<?php
session_start(); // Start the session

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
  // If the session variable is not set or is not true (user is not logged in)
  $_SESSION['error'] = 'You are not allowed to access this page. Please log in as admin.';
  echo '<script>alert("You are not allowed to access this page. Please log in as admin.");';
  echo 'window.location.href = "Admin_Login.php";</script>';
  exit();
}

// If the user is logged in, proceed with the page content
?>
<style>
        table td {
            padding: .625em;
            text-align: center;
            word-wrap: break-word;
            /* Add this line to handle long words */
        }
    </style>

<?php include 'sidebar.php'; ?>

<div class="col-lg-10 col-md-12">
    <!-- ------------------------------------------------------------------------------------------------------------------ -->
    <!-- Content section -->
    <div class="container mt-4">
        <caption>
            <h4 class="text-center"> Blog Posts </h4>
        </caption>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Title</th>
                    <th scope="col">First Title</th>
                    <th scope="col">First Content</th>
                    <th scope="col">Second Title</th>
                    <th scope="col">Second Content</th>
                    <th scope="col">Published Date</th>
                    <th scope="col">Image</th>
                    <th scope="col">Update</th>
                    <th scope="col">Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Connect to your database here (you'll need your database connection logic)
                include '../config.php';

                // Execute the SQL query
                $sql = "SELECT bp.id, bp.title, bp.topic1_title, bp.topic1_content, bp.topic2_title, bp.topic2_content, bp.published_date, MIN(bi.image) AS image
                        FROM blog_posts bp
                        LEFT JOIN blog_images bi ON bp.id = bi.blog_post_id
                        GROUP BY bp.id, bp.title, bp.topic1_title, bp.topic1_content, bp.topic2_title, bp.topic2_content, bp.published_date";
                $result = mysqli_query($conn, $sql);

                // Check if there are results
                if (mysqli_num_rows($result) > 0) {
                    // Output data of each row
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td data-label='ID'>" . $row["id"] . "</td>";
                         echo "<td data-label='Title'><a href='../blog-post.php?id=" . $row["id"] . "'>" . htmlspecialchars($row["title"]) . "</a></td>";
                        echo "<td data-label='First Title'>" . htmlspecialchars($row["topic1_title"]) . "</td>";
                        echo "<td data-label='First Content'>" . substr(strip_tags($row["topic1_content"]), 0, 10) . "..</td>";
                        echo "<td data-label='Second Title'>" . htmlspecialchars($row["topic2_title"]) . "</td>";
                        echo "<td data-label='Second Content'>" . substr(strip_tags($row["topic2_content"]), 0, 10) . "..</td>";
                        echo "<td data-label='Published Date'>" . $row["published_date"] . "</td>";
                        echo "<td data-label='Image'><img src='../uploads/" . $row["image"] . "' width='50px'></td>";
                        echo "<td data-label='Update'><a class='btn btn-primary' href='blog_update.php?id=" . $row["id"] . "'>Update</a></td>";
                        echo "<td data-label='Delete'><a class='btn btn-danger' href='javascript:void(0);' onclick='confirmDelete(" . $row["id"] . ")'>Delete</a></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='9' class='text-center'>No blog posts found</td></tr>";
                }

                // Close the database connection
                mysqli_close($conn);
                ?>
            </tbody>
        </table>
    </div>
    <!-- ------------------------------------------------------------------------------------------------------------- -->
</div>

<script>
    function confirmDelete(id) {
        if (confirm("Are you sure you want to delete this blog post?")) {
            window.location.href = "blog_post_delete.php?id=" + id;
        }
    }
</script>

<!-- Bootstrap and Popper.js JavaScript for responsive behavior -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>

</body>
</html>
