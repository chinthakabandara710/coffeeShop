<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Coffee Lover</title>

    <meta content="" name="description">
    <meta content="" name="keywords">
    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">


    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Jost:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">


    <link href="assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">

</head>
</head>

<body>
    <?php
    include("./main/nav.php") ?>

    <section id="contact" class="contact ">
        <div class="container" data-aos="fade-up">

            <div class="section-title">
                <h2>Contact</h2>
                <p>Don’t hesitate to reach out with the contact information below, or send a message using the form.</p>
            </div>

            <div class="row">

                <div class="infomation">
                    <h3>Drop Us a Message</h3>
                    <form action="mailto:chinthakabandara455@gmail.com" class="form-signin" method="post" enctype="text/plain">

                        <div class="div-form ">
                            <input type="text" name="fName " class="form-control top mt-2" placeholder="Your Name" required autofocus>
                            <input type="text" name="phone " class="form-control middle mt-2" placeholder="Your Phone" required>
                            <input type="email" name="email " class="form-control bottom mt-2" placeholder="Your Email" required>
                            <textarea class="form-control message mt-2" name="Message" id="exampleFormControlTextarea1" rows="5" placeholder="Your Message" required></textarea><br>

                            <button id="cnt-btn" class="btn btn-lg btn-outline-dark mb-5" type="submit">Submit</button>

                        </div>
                    </form>
                    <div class="contact-details">
                        <p>Coffee Lover ,<br>
                            No:888<br>
                            katugasthota road,<br>
                            Kandy<br>0812-xxxxxx
                        </p>

                        <a id="email-add">coffeeLover@exsample.com</a>
                    </div>
                    <div id="map-container-google-2" class="container-fluid-f map mt-3" style="height: 500px">
                        <h3>Find Us on Google map</h3>
                        <iframe width="100%" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3957.5648901966892!2d80.6397672141526!3d7.29024336579862!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae3662e444100a7%3A0x1a8a9896b2d68651!2sKandy%20Lake!5e0!3m2!1sen!2sus!4v1623576911272!5m2!1sen!2sus" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                    </div>

                </div>

            </div>

        </div>
    </section>


    <?php
    include("./main/footer.php") ?>

    <div id="preloader"></div>
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>


    <script src="assets/vendor/aos/aos.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="assets/vendor/waypoints/noframework.waypoints.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>


    <script src="assets/js/main.js"></script>

</body>

</html>