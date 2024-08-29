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
                        <h4 class="text-center"> Bedroom Review </h4>
                    </caption>
                    <table>

                        <thead>
                            <tr>
                               
                                <th scope="col">Product ID</th>
                                <th scope="col">Name</th>
                                <th scope="col">Review</th>
                                <th scope="col">Rating</th>
                                <th scope="col">Image</th>
                                <th scope="col">Delete</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Connect to your database here (you'll need your database connection logic)
                            include '../config.php';
                            // Execute the SQL query
                            $sql = "SELECT bedroom_reviews.id, bedroom_reviews.product_id, bedroom_reviews.user_name, bedroom_reviews.review_text, bedroom_reviews.rating, bedroom_reviews.created_at, MIN(bedroom_review_images.image_path) AS image_path FROM bedroom_reviews LEFT JOIN bedroom_review_images ON bedroom_reviews.id = bedroom_review_images.review_id GROUP BY bedroom_reviews.id, bedroom_reviews.product_id, bedroom_reviews.user_name, bedroom_reviews.review_text, bedroom_reviews.rating";
                            $result = mysqli_query($conn, $sql);

                            // Check if there are results
                            if (mysqli_num_rows($result) > 0) {
                                // Output data of each row
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<tr>";
                                    echo "<td data-label='ID'style='display: none;'>" . $row["id"] . "</td>";
                                    echo "<td data-label='Product ID'>" . $row["product_id"] . "</td>";
                                    echo "<td data-label='Name'>" . $row["user_name"] . "</td>";
                                    echo "<td data-label='Review'>" . $row["review_text"] . "</td>";
                                    echo "<td data-label='Rating'>" . $row["rating"] . "</td>";
                                    echo "<td data-label='Image'><img src='" . $row["image_path"] . "' width='50px'></td>";
                                    echo "<td data-label='Delete'><a class='btn btn-danger' href='javascript:void(0);' onclick='confirmDelete(" . $row["id"] . ")'>Delete</a></td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "0 results";
                            }

                            // Close the database connection
                            mysqli_close($conn);
                            ?>

                        </tbody>
                    </table>
                </div>
                <!-- ------------------------------------------------------------------------------------------------------------- -->


            </div>
        </div>
    </div>
    <div class="dark-overlay"></div>
    <script>

        function confirmDelete(id) {
            if (confirm("Are you sure you want to delete this review?")) {
                window.location.href = "bedroom_review_delete.php?id=" + id;
            }
        }


    </script>
    <!-- Bootstrap and Popper.js JavaScript for responsive behavior -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"
        integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"
        integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13"
        crossorigin="anonymous"></script>


</body>

</html>