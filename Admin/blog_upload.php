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
    <h2>Upload New Blog</h2>
    <form action="upload_blog.php" method="POST" enctype="multipart/form-data">
      <div class="form-group">
        <label for="title">Blog Title</label>
        <input type="text" class="form-control" id="title" name="title" required>
      </div>
      <div class="form-group">
        <label for="topic1_title">First Section Title</label>
        <input type="text" class="form-control" id="topic1_title" name="topic1_title" required>
      </div>
      <div class="form-group">
        <label for="topic1_content">First Section Content</label>
        <textarea class="form-control" id="topic1_content" name="topic1_content" rows="3" required></textarea>
      </div>
      <div class="form-group">
        <label for="topic2_title">Second Section Title</label>
        <input type="text" class="form-control" id="topic2_title" name="topic2_title" required>
      </div>
      <div class="form-group">
        <label for="topic2_content">Second Section Content</label>
        <textarea class="form-control" id="topic2_content" name="topic2_content" rows="3" required></textarea>
      </div>
      <div class="form-group">
        <label for="images">Images</label>
        <input type="file" class="form-control-file" id="images" name="images[]" multiple>
        <small class="form-text text-muted">Select multiple images (hold Ctrl or Cmd) for
                  upload.</small>
              </div>
              <div id="imagePreview"></div>
     <div class="form-group">
        <label for="published_date">Published Date</label>
        <input type="date" class="form-control" id="published_date" name="published_date" required>
      </div>
      <button type="submit" class="btn btn-primary">Upload</button>
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
  document.getElementById('images').addEventListener('change', function (event) {
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