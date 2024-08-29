<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Meta tags for character set, viewport, and title -->
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Ityadi Furniture</title>
    <link rel="shortcut icon" href="../img/logo.jpg" type="image/x-icon">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />

    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">
    <link rel="stylesheet" href="../css/admin.css">
    <script src="../js/admin.js"></script>
    <style>
        /* Additional style for image preview */
        body {
            /* background-color: #f4f4f4; */
            /* Updated body background color */
            font-family: Arial, sans-serif;
            margin: 0;
            /* Reset margin for the body */
            padding: 0;
            /* Reset padding for the body */
        }

        .container {
            background-color: #fff;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #333;
            margin-bottom: 30px;
        }

        label {
            font-weight: bold;
        }

        .form-control {
            border-radius: 5px;
        }

        textarea.form-control {
            resize: vertical;
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        #imagePreview {
            margin-top: 20px;
        }

        #imagePreview img {
            max-width: 150px;
            max-height: 150px;
            margin-right: 10px;
            margin-bottom: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            padding: 3px;
        }

        /* Background color for the "Upload Furniture" section header */
        .upload-section h2 {
            background-color: #0056b3;
            color: #fff;
            padding: 10px 20px;
            border-radius: 8px 8px 0 0;
            margin-top: 0;
            margin-bottom: 20px;
        }
    </style>

</head>

<body>

    <!-- Responsive container to control width -->
    <div class="container-fluid justify-content-center border-dark mt-5">

        <!-- Bootstrap row for layout -->
        <div class="row mt-5">
            <div class="col-lg-2 col-md-12">

                <!-- Main Navigation -->
                <header>
                    <!-- Sidebar -->
                    <nav id="sidebarMenu" class="collapse d-lg-block sidebar collapse bg-white">
                        <div class="position-sticky">
                            <div class="list-group list-group-flush mx-3 mt-4">
                                <!-- Navigation links with Bootstrap styling -->
                                <a href="dashboard.php" class="list-group-item list-group-item-action py-2 ripple"
                                    aria-current="true">
                                    <i class="fas fa-tachometer-alt fa-fw  me-3"></i><span>Dashboard</span>
                                </a>

                                <!-- Bedroom -->
                                <a href="#" class="list-group-item list-group-item-action py-2" aria-expanded="false"
                                    data-bs-toggle="collapse" data-bs-target="#bedroomDropdown"
                                    aria-controls="bedroomDropdown">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <i class="fas fa-bed me-3"></i><span>Bedroom</span>
                                        </div>
                                        <i id="bedroomDropdownIcon" class="fas fa-caret-down"></i>
                                    </div>
                                </a>
                                <div class="collapse" id="bedroomDropdown">
                                    <div class="list-group">
                                        <a href="bedroom_upload.php"
                                            class="list-group-item list-group-item-action py-2">
                                            <i class="fas fa-upload me-3"></i><span>Upload Furniture</span>
                                        </a>
                                        <a href="bedroom_view.php" class="list-group-item list-group-item-action py-2">
                                            <i class="fas fa-eye me-3"></i><span>View Furniture</span>
                                        </a>
                                        <a href="bedroom_review.php"
                                            class="list-group-item list-group-item-action py-2">
                                            <i class="fas fa-star me-3"></i><span>Reviews</span>
                                        </a>
                                    </div>
                                </div>

                                <!-- Living Room -->
                                <a href="#" class="list-group-item list-group-item-action py-2" aria-expanded="false"
                                    data-bs-toggle="collapse" data-bs-target="#livingRoomDropdown"
                                    aria-controls="livingRoomDropdown">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <i class="fas fa-couch me-3"></i><span>Living Room</span>
                                        </div>
                                        <i id="livingRoomDropdownIcon" class="fas fa-caret-down"></i>
                                    </div>
                                </a>
                                <div class="collapse" id="livingRoomDropdown">
                                    <div class="list-group">
                                        <a href="living_upload.php" class="list-group-item list-group-item-action py-2">
                                            <i class="fas fa-upload me-3"></i><span>Upload Furniture</span>
                                        </a>
                                        <a href="living_view.php" class="list-group-item list-group-item-action py-2">
                                            <i class="fas fa-eye me-3"></i><span>View Furniture</span>
                                        </a>
                                        <a href="living_review.php" class="list-group-item list-group-item-action py-2">
                                            <i class="fas fa-star me-3"></i><span>Reviews</span>
                                        </a>
                                    </div>
                                </div>

                                <!-- Reading Room -->
                                <a href="#" class="list-group-item list-group-item-action py-2" aria-expanded="false"
                                    data-bs-toggle="collapse" data-bs-target="#readingRoomDropdown"
                                    aria-controls="readingRoomDropdown">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <i class="fas fa-book me-3"></i><span>Reading Room</span>
                                        </div>
                                        <i id="readingRoomDropdownIcon" class="fas fa-caret-down"></i>
                                    </div>
                                </a>
                                <div class="collapse" id="readingRoomDropdown">
                                    <div class="list-group">
                                        <a href="reading_upload.php"
                                            class="list-group-item list-group-item-action py-2">
                                            <i class="fas fa-upload me-3"></i><span>Upload Furniture</span>
                                        </a>
                                        <a href="reading_view.php" class="list-group-item list-group-item-action py-2">
                                            <i class="fas fa-eye me-3"></i><span>View Furniture</span>
                                        </a>
                                        <a href="reading_review.php"
                                            class="list-group-item list-group-item-action py-2">
                                            <i class="fas fa-star me-3"></i><span>Reviews</span>
                                        </a>
                                    </div>
                                </div>
                                <!-- Dining Room -->
                                <a href="#" class="list-group-item list-group-item-action py-2" aria-expanded="false"
                                    data-bs-toggle="collapse" data-bs-target="#diningRoomDropdown"
                                    aria-controls="diningRoomDropdown">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <i class="fas fa-utensils me-3"></i><span>Dining Room</span>
                                        </div>
                                        <i id="diningRoomDropdownIcon" class="fas fa-caret-down"></i>
                                    </div>
                                </a>
                                <div class="collapse" id="diningRoomDropdown">
                                    <div class="list-group">
                                        <a href="dinning_upload.php"
                                            class="list-group-item list-group-item-action py-2">
                                            <i class="fas fa-upload me-3"></i><span>Upload Furniture</span>
                                        </a>
                                        <a href="dinning_view.php" class="list-group-item list-group-item-action py-2">
                                            <i class="fas fa-eye me-3"></i><span>View Furniture</span>
                                        </a>
                                        <a href="dining_review.php" class="list-group-item list-group-item-action py-2">
                                            <i class="fas fa-star me-3"></i><span>Reviews</span>
                                        </a>
                                    </div>
                                </div>

                                <!-- Office Room -->
                                <a href="#" class="list-group-item list-group-item-action py-2" aria-expanded="false"
                                    data-bs-toggle="collapse" data-bs-target="#officeRoomDropdown"
                                    aria-controls="officeRoomDropdown">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <i class="fas fa-briefcase me-3"></i><span>Office Room</span>
                                        </div>
                                        <i id="officeRoomDropdownIcon" class="fas fa-caret-down"></i>
                                    </div>
                                </a>
                                <div class="collapse" id="officeRoomDropdown">
                                    <div class="list-group">
                                        <a href="office_upload.php" class="list-group-item list-group-item-action py-2">
                                            <i class="fas fa-upload me-3"></i><span>Upload Furniture</span>
                                        </a>
                                        <a href="office_view.php" class="list-group-item list-group-item-action py-2">
                                            <i class="fas fa-eye me-3"></i><span>View Furniture</span>
                                        </a>
                                        <a href="office_review.php" class="list-group-item list-group-item-action py-2">
                                            <i class="fas fa-star me-3"></i><span>Reviews</span>
                                        </a>
                                    </div>
                                </div>

                                <!-- Others Furniture -->
                                <a href="#" class="list-group-item list-group-item-action py-2" aria-expanded="false"
                                    data-bs-toggle="collapse" data-bs-target="#othersFurnitureDropdown"
                                    aria-controls="othersFurnitureDropdown">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <i class="fas fa-plus-circle me-3"></i><span>Others Furniture</span>
                                        </div>
                                        <i id="othersFurnitureDropdownIcon" class="fas fa-caret-down"></i>
                                    </div>
                                </a>
                                <div class="collapse" id="othersFurnitureDropdown">
                                    <div class="list-group">
                                        <a href="others_upload.php" class="list-group-item list-group-item-action py-2">
                                            <i class="fas fa-upload me-3"></i><span>Upload Furniture</span>
                                        </a>
                                        <a href="others_view.php" class="list-group-item list-group-item-action py-2">
                                            <i class="fas fa-eye me-3"></i><span>View Furniture</span>
                                        </a>
                                        <a href="others_review.php" class="list-group-item list-group-item-action py-2">
                                            <i class="fas fa-star me-3"></i><span>Reviews</span>
                                        </a>
                                    </div>
                                </div>

                            
                                <!-- Blog -->
                                <a href="#" class="list-group-item list-group-item-action py-2"
                                        aria-expanded="false" data-bs-toggle="collapse"
                                        data-bs-target="#blogDropdown" aria-controls="blogDropdown">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <i class="fa-brands fa-blogger me-3"></i><span>Blog</span>
                                            </div>
                                            <i id="blogDropdownIcon" class="fas fa-caret-down"></i>
                                        </div>
                                    </a>
                                    <div class="collapse" id="blogDropdown">
                                        <div class="list-group">
                                            <a href="blog_upload.php"
                                                class="list-group-item list-group-item-action py-2">
                                                <i class="fas fa-upload me-3"></i><span>Upload Blog</span>
                                            </a>
                                            <a href="blog_view.php"
                                                class="list-group-item list-group-item-action py-2">
                                                <i class="fas fa-eye me-3"></i><span>View Blog</span>
                                            </a>
                                            
                                        </div>
                                    </div>
                                

                                <a href="viewContact.php" class="list-group-item list-group-item-action py-2 ripple"><i
                                        class="fa-solid fa-address-book me-3"></i></i><span>Contact
                                    </span></a>

                                <!-- Logout link -->
                                <a href="logout.php" id="logoutLink"
                                    class="list-group-item list-group-item-action py-2 ripple text-danger">
                                    <i class="fas fa-sign-out-alt me-3"></i><span><b>Logout</b></span>
                                </a>

                                <!-- Add other navigation links here -->
                            </div>
                        </div>
                    </nav>


                    <!-- Navbar -->
                    <nav id="main-navbar" class="navbar navbar-expand-lg navbar-light bg-white fixed-top">
                        <div class="container-fluid">
                            <!-- Brand -->
                            <a class="navbar-brand" href="dashboard.php">
                                <img src="../img/logo.jpg" height="50" alt="Ittadi Logo" loading="lazy">
                                Ityadi Furniture - Admin Panel
                            </a>

                            <!-- Toggle button -->
                            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                                aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>

                            <!-- Collapsible content -->
                            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                <div
                                    class="list-group list-group-flush mx-3 mt-4 navbar-nav me-auto mb-2 mb-lg-0 d-lg-none">
                                    <!-- Navigation links with Bootstrap styling -->
                                    <a href="dashboard.php" class="list-group-item list-group-item-action py-2 ripple"
                                        aria-current="true">
                                        <i class="fas fa-tachometer-alt fa-fw  me-3"></i><span>Dashboard</span>
                                    </a>

                                    <!-- Bedroom -->
                                    <a href="#" class="list-group-item list-group-item-action py-2"
                                        aria-expanded="false" data-bs-toggle="collapse"
                                        data-bs-target="#bedroomDropdown" aria-controls="bedroomDropdown">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <i class="fas fa-bed me-3"></i><span>Bedroom</span>
                                            </div>
                                            <i id="bedroomDropdownIcon" class="fas fa-caret-down"></i>
                                        </div>
                                    </a>
                                    <div class="collapse" id="bedroomDropdown">
                                        <div class="list-group">
                                            <a href="bedroom_upload.php"
                                                class="list-group-item list-group-item-action py-2">
                                                <i class="fas fa-upload me-3"></i><span>Upload Furniture</span>
                                            </a>
                                            <a href="bedroom_view.php"
                                                class="list-group-item list-group-item-action py-2">
                                                <i class="fas fa-eye me-3"></i><span>View Furniture</span>
                                            </a>
                                            <a href="bedroom_review.php"
                                                class="list-group-item list-group-item-action py-2">
                                                <i class="fas fa-star me-3"></i><span>Reviews</span>
                                            </a>
                                        </div>
                                    </div>

                                    <!-- Living Room -->
                                    <a href="#" class="list-group-item list-group-item-action py-2"
                                        aria-expanded="false" data-bs-toggle="collapse"
                                        data-bs-target="#livingRoomDropdown" aria-controls="livingRoomDropdown">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <i class="fas fa-couch me-3"></i><span>Living Room</span>
                                            </div>
                                            <i id="livingRoomDropdownIcon" class="fas fa-caret-down"></i>
                                        </div>
                                    </a>
                                    <div class="collapse" id="livingRoomDropdown">
                                        <div class="list-group">
                                            <a href="living_upload.php"
                                                class="list-group-item list-group-item-action py-2">
                                                <i class="fas fa-upload me-3"></i><span>Upload Furniture</span>
                                            </a>
                                            <a href="living_view.php"
                                                class="list-group-item list-group-item-action py-2">
                                                <i class="fas fa-eye me-3"></i><span>View Furniture</span>
                                            </a>
                                            <a href="living_review.php"
                                                class="list-group-item list-group-item-action py-2">
                                                <i class="fas fa-star me-3"></i><span>Reviews</span>
                                            </a>
                                        </div>
                                    </div>

                                    <!-- Reading Room -->
                                    <a href="#" class="list-group-item list-group-item-action py-2"
                                        aria-expanded="false" data-bs-toggle="collapse"
                                        data-bs-target="#readingRoomDropdown" aria-controls="readingRoomDropdown">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <i class="fas fa-book me-3"></i><span>Reading Room</span>
                                            </div>
                                            <i id="readingRoomDropdownIcon" class="fas fa-caret-down"></i>
                                        </div>
                                    </a>
                                    <div class="collapse" id="readingRoomDropdown">
                                        <div class="list-group">
                                            <a href="reading_upload.php"
                                                class="list-group-item list-group-item-action py-2">
                                                <i class="fas fa-upload me-3"></i><span>Upload Furniture</span>
                                            </a>
                                            <a href="reading_view.php"
                                                class="list-group-item list-group-item-action py-2">
                                                <i class="fas fa-eye me-3"></i><span>View Furniture</span>
                                            </a>
                                            <a href="reading_review.php"
                                                class="list-group-item list-group-item-action py-2">
                                                <i class="fas fa-star me-3"></i><span>Reviews</span>
                                            </a>
                                        </div>
                                    </div>
                                    <!-- Dining Room -->
                                    <a href="#" class="list-group-item list-group-item-action py-2"
                                        aria-expanded="false" data-bs-toggle="collapse"
                                        data-bs-target="#diningRoomDropdown" aria-controls="diningRoomDropdown">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <i class="fas fa-utensils me-3"></i><span>Dining Room</span>
                                            </div>
                                            <i id="diningRoomDropdownIcon" class="fas fa-caret-down"></i>
                                        </div>
                                    </a>
                                    <div class="collapse" id="diningRoomDropdown">
                                        <div class="list-group">
                                            <a href="dinning_upload.php"
                                                class="list-group-item list-group-item-action py-2">
                                                <i class="fas fa-upload me-3"></i><span>Upload Furniture</span>
                                            </a>
                                            <a href="dinning_view.php"
                                                class="list-group-item list-group-item-action py-2">
                                                <i class="fas fa-eye me-3"></i><span>View Furniture</span>
                                            </a>
                                            <a href="dining_review.php"
                                                class="list-group-item list-group-item-action py-2">
                                                <i class="fas fa-star me-3"></i><span>Reviews</span>
                                            </a>
                                        </div>
                                    </div>

                                    <!-- Office Room -->
                                    <a href="#" class="list-group-item list-group-item-action py-2"
                                        aria-expanded="false" data-bs-toggle="collapse"
                                        data-bs-target="#officeRoomDropdown" aria-controls="officeRoomDropdown">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <i class="fas fa-briefcase me-3"></i><span>Office Room</span>
                                            </div>
                                            <i id="officeRoomDropdownIcon" class="fas fa-caret-down"></i>
                                        </div>
                                    </a>
                                    <div class="collapse" id="officeRoomDropdown">
                                        <div class="list-group">
                                            <a href="office_upload.php"
                                                class="list-group-item list-group-item-action py-2">
                                                <i class="fas fa-upload me-3"></i><span>Upload Furniture</span>
                                            </a>
                                            <a href="office_view.php"
                                                class="list-group-item list-group-item-action py-2">
                                                <i class="fas fa-eye me-3"></i><span>View Furniture</span>
                                            </a>
                                            <a href="office_review.php"
                                                class="list-group-item list-group-item-action py-2">
                                                <i class="fas fa-star me-3"></i><span>Reviews</span>
                                            </a>
                                        </div>
                                    </div>

                                    <!-- Others Furniture -->
                                    <a href="#" class="list-group-item list-group-item-action py-2"
                                        aria-expanded="false" data-bs-toggle="collapse"
                                        data-bs-target="#othersFurnitureDropdown"
                                        aria-controls="othersFurnitureDropdown">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <i class="fas fa-plus-circle me-3"></i><span>Others Furniture</span>
                                            </div>
                                            <i id="othersFurnitureDropdownIcon" class="fas fa-caret-down"></i>
                                        </div>
                                    </a>
                                    <div class="collapse" id="othersFurnitureDropdown">
                                        <div class="list-group">
                                            <a href="others_upload.php"
                                                class="list-group-item list-group-item-action py-2">
                                                <i class="fas fa-upload me-3"></i><span>Upload Furniture</span>
                                            </a>
                                            <a href="others_view.php"
                                                class="list-group-item list-group-item-action py-2">
                                                <i class="fas fa-eye me-3"></i><span>View Furniture</span>
                                            </a>
                                            <a href="others_review.php"
                                                class="list-group-item list-group-item-action py-2">
                                                <i class="fas fa-star me-3"></i><span>Reviews</span>
                                            </a>
                                        </div>
                                    </div>

                                     <!-- Blog -->
                                     <a href="#" class="list-group-item list-group-item-action py-2"
                                        aria-expanded="false" data-bs-toggle="collapse"
                                        data-bs-target="#blogDropdown" aria-controls="blogDropdown">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <i class="fa-brands fa-blogger me-3"></i><span>Blog</span>
                                            </div>
                                            <i id="blogDropdownIcon" class="fas fa-caret-down"></i>
                                        </div>
                                    </a>
                                    <div class="collapse" id="blogDropdown">
                                        <div class="list-group">
                                            <a href="blog_upload.php"
                                                class="list-group-item list-group-item-action py-2">
                                                <i class="fas fa-upload me-3"></i><span>Upload Blog</span>
                                            </a>
                                            <a href="blog_view.php"
                                                class="list-group-item list-group-item-action py-2">
                                                <i class="fas fa-eye me-3"></i><span>View Blog</span>
                                            </a>
                                            
                                        </div>
                                    </div>

                                    

                                    <a href="viewContact.php"
                                        class="list-group-item list-group-item-action py-2 ripple"><i
                                            class="fa-solid fa-address-book me-3"></i></i><span>Contact
                                        </span></a>
                                        


                                    <!-- Logout link -->
                                    <a href="logout.php" id="logoutLink"
                                        class="list-group-item list-group-item-action py-2 ripple text-danger">
                                        <i class="fas fa-sign-out-alt me-3"></i><span><b>Logout</b></span>
                                    </a>

                                    <!-- Add other navigation links here -->

                                </div>
                            </div>
                    </nav>
                </header>

            </div>