<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact - Ityadi Furniture </title>
    <link rel="shortcut icon" href="img/logo.jpg" type="image/x-icon">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">

    <style>
        /* Adjust alignment for the search button */
        @media (max-width: 575.98px) {
            .input-group {
                display: flex;
                flex-wrap: wrap;
                justify-content: center;
                align-items: center;
            }

            .input-group-append {
                margin-left: 0;
                /* Set margin-left to zero */
            }

            .btn {
                margin-top: 0.25rem;
                margin-left: 10px;
                /* Adjust this value as needed */
            }
        }
    </style>
</head>

<body>

    <?php include 'include/navbar.html'; ?>

    <!-- Contact Content -->
    <div class="container mt-4 mb-5">
        <!-- <h1>Contact Us</h1> -->
        <div class="row">
            <div class="col-md-6">
                <h2 class="text-center">Get in Touch</h2>
                <p>Feel free to reach out to us using the form below or via the contact information provided.</p>
                <!-- Contact Form -->
                <form action="contactAction.php" method="post">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="number">Phone Number</label>
                        <input type="number" class="form-control" id="number" name="number" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email">
                    </div>
                    <div class="form-group">
                        <label for="message">Message</label>
                        <textarea class="form-control" id="message" name="message" rows="3" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
            <div class="col-md-6 text-center mt-4">
                <h2>Our Address</h2>
                <p>
                    <i class="fas fa-map-marker-alt"></i>Dhaka - Moulvibazar Hwy, Moulvibazar, Sylhet<br>
                    <i class="far fa-envelope"></i>ityadifurniture2010@gmail.com<br>
                    <i class="fas fa-phone"></i> +8801720086890
                </p>
                <!-- Random Map Placeholder (just for illustration) -->
                <div class="embed-responsive embed-responsive-16by9" style="border-radius: 15px; box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3); overflow: hidden;">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d116177.57165476507!2d91.7193097!3d24.5010747!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x375173336168a6ef%3A0xaab529aca3a42ab8!2sIttadi%20Furniture!5e0!3m2!1sen!2sbd!4v1700165843637!5m2!1sen!2sbd" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>
    </div>



    <!-- Footer -->
    <?php include 'include/footer.html'; ?>




    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="js/drop.js"></script>
</body>

</html>