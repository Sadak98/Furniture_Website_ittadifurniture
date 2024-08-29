<?php
session_start(); // Start the session

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
  // If the session variable is not set or is not true (user is not logged in)
  $_SESSION['error'] = 'You are not allowed to access this page. Please log in as admin.';
  echo '<script>alert("You are not allowed to access this page. Please log in as admin.");';
  echo 'window.location.href = "Admin_Login.php";</script>';
  exit();
}

include 'config.php';

// If the user is logged in, proceed with the page content
?>


<?php include 'sidebar.php'; ?>

            <div class="col-lg-10 col-md-12">



                <!-- ------------------------------------------------------------------------------------------------------------------ -->
                <!-- Content section -->
                <div class="container mt-4 mb-5">
                    <caption>
                        <h4 class="text-center"> Contact Details </h4>
                    </caption>
                    <table>
                        <thead>
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Number</th>
                                <th scope="col">Email</th>
                                <th scope="col">Message</th>
                                <th scope="col">Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Connect to your database here (you'll need your database connection logic)
                            include '../config.php';
                            // Execute the SQL query
                            $sql = "SELECT * FROM `contact`";
                            $result = mysqli_query($conn, $sql);

                            // Check if there are results
                            if (mysqli_num_rows($result) > 0) {
                                // Output data of each row
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<tr>";
                                    // Hidden column for ID
                                    echo "<td data-label='ID' style='display: none;'>" . $row["id"] . "</td>";
                                    // Display other columns
                                    echo "<td data-label='Name'>" . $row["name"] . "</td>";
                                    echo "<td data-label='Number'>" . $row["number"] . "</td>";
                                    echo "<td data-label='Email'>" . $row["email"] . "</td>";
                                    echo "<td data-label='Message'>" . $row["message"] . "</td>";
                                    // Delete action with hidden ID passed to JavaScript function
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
            if (confirm("Are you sure you want to delete this item?")) {
                window.location.href = "contact_delete.php?id=" + id;
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