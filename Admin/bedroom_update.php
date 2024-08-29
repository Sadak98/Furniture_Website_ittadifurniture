<?php
include 'config.php';
session_start(); // Start the session

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    // If the session variable is not set or is not true (user is not logged in)
    $_SESSION['error'] = 'You are not allowed to access this page. Please log in as admin.';
    echo '<script>alert("You are not allowed to access this page. Please log in as admin.");';
    echo 'window.location.href = "Admin_Login.php";</script>';
    exit();
}

// If the user is logged in, proceed with the page content


$errors = [];
$id = isset($_REQUEST['id']) ? intval($_REQUEST['id']) : 0;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate inputs
    $furnitureName = htmlspecialchars(trim($_POST['furnitureName']));
    $furnitureCode = htmlspecialchars(trim($_POST['furnitureCode']));
    $furnitureType = htmlspecialchars(trim($_POST['furnitureType']));
    $price = floatval($_POST['price']);
    $offerprice = floatval($_POST['offer_price']);
    $materials = htmlspecialchars(trim($_POST['materials']));
    $size = htmlspecialchars(trim($_POST['size']));
    $information = htmlspecialchars(trim($_POST['information']));

    // Validate uploaded images
    if (!empty($_FILES['images']['name'][0])) {
        $images = $_FILES['images'];
        $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];
        $uploadPath = 'uploads/'; // Define your upload directory

        foreach ($images['name'] as $key => $image) {
            $imageFileType = strtolower(pathinfo($image, PATHINFO_EXTENSION));
            if (!in_array($imageFileType, $allowedTypes)) {
                $errors[] = "Invalid file type for image: {$image}";
            } elseif ($images['size'][$key] > 5000000) { // Adjust the size limit as needed
                $errors[] = "File size exceeds limit for image: {$image}";
            } else {
                move_uploaded_file($images['tmp_name'][$key], $uploadPath . $image);
            }
        }
    }

    if (empty($errors)) {
        // Update database with sanitized data
        $updateQuery = "UPDATE bedroom SET name=?, code=?, type=?, price=?, offer_price=?, material=?, size=?, information=? WHERE id=?";
        $stmt = mysqli_prepare($conn, $updateQuery);
        mysqli_stmt_bind_param($stmt, "sssdssssi", $furnitureName, $furnitureCode, $furnitureType, $price, $offerprice, $materials, $size, $information, $id);

        if (mysqli_stmt_execute($stmt)) {
            // Redirect to success page or handle success
            header("Location: success.php");
            exit();
        } else {
            $errors[] = "Error updating data: " . mysqli_error($conn);
        }
    }
}

// Fetch existing data
$dataFetchQuery = "SELECT * FROM bedroom WHERE id=?";
$stmt = mysqli_prepare($conn, $dataFetchQuery);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$record = mysqli_stmt_get_result($stmt);
$data = mysqli_fetch_array($record);
?>



<?php include 'sidebar.php'; ?>

<div class="col-lg-10 col-md-12">
    <!-- Content section -->
    <div class="container mt-3 mb-5">
        <div class="upload-section">
            <h2>Update Bedroom Furniture</h2>
            <?php if (!empty($errors)): ?>
                <div class="alert alert-danger" role="alert">
                    <ul>
                        <?php foreach ($errors as $error): ?>
                            <li>
                                <?php echo $error; ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>
            <form action="bedroom_up_action.php" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="furnitureName">Furniture Name:</label>
                    <input type="text" class="form-control" id="furnitureName" name="furnitureName"
                        value="<?php echo $data['name'] ?>" required>
                    <input type="hidden" name="id" value="<?php echo $data['id'] ?>">
                </div>
                <div class="form-group">
                    <label for="furnitureCode">Furniture Code:</label>
                    <input type="text" class="form-control" id="furnitureCode" name="furnitureCode"
                        value="<?php echo $data['code'] ?>" required>
                </div>
                <div class="form-group">
                    <label for="furnitureType">Furniture Type:</label>
                    <select class="form-control" id="furnitureType" name="furnitureType" required>
                        <option value="Bed" <?php if ($data['type'] === 'Bed')
                                                echo 'selected'; ?>>Bed</option>
                        <option value="Bedside table" <?php if ($data['type'] === 'Bedside table')
                                                            echo 'selected'; ?>>
                            Bedside table</option>
                        <option value="Dressing table" <?php if ($data['type'] === 'Dressing table')
                                                            echo 'selected'; ?>>
                            Dressing table</option>
                        <option value="Chest of Drawer" <?php if ($data['type'] === 'Chest of Drawer')
                                                            echo 'selected'; ?>>
                            Chest of Drawer</option>
                        <option value="Almirah" <?php if ($data['type'] === 'Almirah')
                                                    echo 'selected'; ?>>
                            Almirah</option>
                        <option value="Wardrobe" <?php if ($data['type'] === 'Wardrobe')
                                                        echo 'selected'; ?>>
                            Wardrobe</option>
                        <option value="Alna & Hanger" <?php if ($data['type'] === 'Alna & Hanger')
                                                            echo 'selected'; ?>>
                            Alna & Hanger</option>
                        <option value="Easy & smart stool" <?php if ($data['type'] === 'Easy & smart stool')
                                                                echo 'selected'; ?>>
                            Easy & smart stool</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="price">Price:</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">&#2547;</span>
                        </div>
                        <input type="text" class="form-control" id="price" name="price"
                            value="<?php echo $data['price'] ?>" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="offer_price">Offer Price:</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">&#2547;</span>
                        </div>
                        <input type="text" class="form-control" id="offer_price" name="offer_price"
                            value="<?php echo $data['offer_price'] ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="materials">Materials:</label>
                    <input type="text" class="form-control" id="materials" name="materials"
                        value="<?php echo $data['material'] ?>" required>
                </div>
                <div class="form-group">
                    <label for="size">Size:</label>
                    <input type="text" class="form-control" id="size" name="size" value="<?php echo $data['size'] ?>"
                        required>
                </div>
                <div class="form-group">
                    <label for="information">Information:</label>
                    <textarea class="form-control" id="information" name="information"
                        required><?php echo htmlspecialchars($data['information'] ?? ''); ?></textarea>
                </div>
                <!-- Display Existing Images -->
                <div class="form-group">
                    <label>Existing Images:</label>
                    <div id="existingImages">
                        <?php
                        // Fetch existing images associated with the bedroom furniture ID
                        $fetchImagesQuery = "SELECT image_path FROM bedroom_images WHERE furniture_id = ?";
                        $stmtImages = mysqli_prepare($conn, $fetchImagesQuery);
                        mysqli_stmt_bind_param($stmtImages, "i", $id);
                        mysqli_stmt_execute($stmtImages);
                        $resultImages = mysqli_stmt_get_result($stmtImages);

                        while ($image = mysqli_fetch_assoc($resultImages)) {
                            echo '<img src="' . $image['image_path'] . '" alt="Existing Image" style="max-width: 150px; max-height: 150px; margin-right: 10px; margin-bottom: 10px; border-radius: 5px; border: 1px solid #ccc; padding: 3px;">';
                        }
                        ?>
                    </div>
                </div>

                <!-- Upload Images Input -->
                <div class="form-group">
                    <label for="furnitureImages">Upload Images:</label>
                    <input type="file" class="form-control-file" id="furnitureImages" name="images[]" multiple>
                    <small class="form-text text-muted">Select multiple images (hold Ctrl or Cmd) for upload.</small>
                </div>

                <!-- Display Selected Images Preview -->
                <div id="imagePreview" class="mt-3">
                    <p><strong>Selected Images Preview:</strong></p>
                    <div id="selectedImagesPreview"></div>
                </div>
                <button type="submit" class="btn btn-primary mt-0">Upload</button>
            </form>
        </div>
    </div>

</div>
</div>
</div>

<div class="dark-overlay"></div>

<!-- Bootstrap and Popper.js JavaScript for responsive behavior -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"
    integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB"
    crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"
    integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13"
    crossorigin="anonymous"></script>

<script>
    // JavaScript for image preview
    document.getElementById('furnitureImages').addEventListener('change', function(event) {
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