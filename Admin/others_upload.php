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
        <div class="container mt-3 mb-5">
          <div class="upload-section">
            <h2>Others Furniture</h2>
            <form action="othersAction.php" method="POST" enctype="multipart/form-data">
              <div class="form-group">
                <label for="furnitureName">Furniture Name:</label>
                <input type="text" class="form-control" id="furnitureName" name="furnitureName" required>
              </div>
              <div class="form-group">
                <label for="furnitureCode">Furniture Code:</label>
                <input type="text" class="form-control" id="furnitureCode" name="furnitureCode" required>
              </div>
              <div class="form-group">
                <label for="furnitureType">Furniture Type:</label>
                <select class="form-control" id="furnitureType" name="furnitureType" required>
                  <option value="">Select Furniture</option>
                  <option value="Rack">Rack</option>
                  <option value="Side Box">Side Box</option>
                  <option value="Mattress">Mattress</option>
                  <option value="Office Set">Office Set</option>
                  <option value="Home Decor">Home Decor</option>
                  <option value="Wedding Set">Wedding Set</option>
                  <option value="Tea Table">Tea Table</option>

                </select>
              </div>
              <div class="form-group">
                <label for="price">Price:</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text">&#2547;</span>
                  </div>
                  <input type="text" class="form-control" id="price" name="price" required>
                </div>
              </div>
              <div class="form-group">
                <label for="offer_price">Offer Price:</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text">&#2547;</span>
                  </div>
                  <input type="text" class="form-control" id="offer_price" name="offer_price">
                </div>
              </div>
              <div class="form-group">
                <label for="materials">Materials:</label>
                <input type="text" class="form-control" id="materials" name="materials" required>
              </div>
              <div class="form-group">
                <label for="size">Size:</label>
                <input type="text" class="form-control" id="size" name="size" required>
              </div>
              <div class="form-group">
                <label for="information">Information:</label>
                <textarea class="form-control" id="information" name="information" rows="4" required></textarea>
              </div>
              <div class="form-group">
                <label for="furnitureImages">Upload Images:</label>
                <input type="file" class="form-control-file" id="furnitureImages" name="images[]" multiple required>
                <small class="form-text text-muted">Select multiple images (hold Ctrl or Cmd) for
                  upload.</small>
              </div>
              <div id="imagePreview"></div>
              <button type="submit" class="btn btn-primary mt-0">Upload</button>
            </form>
          </div>
        </div>
        <!-- ------------------------------------------------------------------------------------------------------------- -->


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