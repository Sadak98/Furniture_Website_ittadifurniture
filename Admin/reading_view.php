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


<?php include 'sidebar.php'; ?>

            
            <div class="col-lg-10 col-md-12">



                <!-- ------------------------------------------------------------------------------------------------------------------ -->
                <!-- Content section -->
                <div class="container mt-4 mb-5">
                    <caption>
                        <h4 class="text-center"> Reading Details </h4>
                    </caption>
                    <table>

                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Name</th>
                                <th scope="col">Code</th>
                                <th scope="col">Price</th>
                                <th scope="col">Offer Price</th>
                                <th scope="col">Type</th>
                                <th scope="col">Image</th>
                                <th scope="col">Update</th>
                                <th scope="col">Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Connect to your database here (you'll need your database connection logic)
                            include 'config.php';
                            // Execute the SQL query
                            $sql = "SELECT reading.id, reading.name, reading.code, reading.price, reading.offer_price, reading.type, MIN(reading_images.image_path) AS image_path
                            FROM reading
                            LEFT JOIN reading_images ON reading.id = reading_images.furniture_id
                            GROUP BY reading.id, reading.name, reading.code, reading.price, reading.offer_price, reading.type";
                            $result = mysqli_query($conn, $sql);

                            // Check if there are results
                            if (mysqli_num_rows($result) > 0) {
                                // Output data of each row
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<tr>";
                                    echo "<td data-label='ID'>" . $row["id"] . "</td>";
                                    echo "<td data-label='Name'>" . $row["name"] . "</td>";
                                    echo "<td data-label='Code'>" . $row["code"] . "</td>";
                                    echo "<td data-label='Price'>" . $row["price"] . "</td>";
                                    echo "<td data-label='Offer Price'>" . $row["offer_price"] . "</td>";
                                    echo "<td data-label='Type'>" . $row["type"] . "</td>";
                                    echo "<td data-label='Image'><img src='" . $row["image_path"] . "' width='60px'></td>";
                                    echo "<td data-label='Update'><a class='btn btn-primary' href='reading_update.php?id=" . $row["id"] . "'>Update</a></td>";
                                    echo "<td data-label='Delete'><a class='btn btn-danger' href='javascript:void(0);' onclick='confirmDelete(" . $row["id"] . ")'>Delete</a></td>";

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
        if (confirm("Are you sure you want to delete this item?")) {
            window.location.href = "reading_delete.php?id=" + id;
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