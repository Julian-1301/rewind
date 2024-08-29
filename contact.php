<?php
// PHP logic for processing the form
$message = ""; // Variable to store message

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize form data
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $subject = htmlspecialchars($_POST['subject']);
    $message = htmlspecialchars($_POST['message']);

    // Email details
    $to = "test@test.nl"; // Replace with your email address
    $headers = "From: " . $email . "\r\n" .
               "Reply-To: " . $email . "\r\n" .
               "X-Mailer: PHP/" . phpversion();
    $fullMessage = "Naam: $name\nEmail-adres: $email\nBericht:\n$message";

    // Send email and return result
    if (mail($to, $subject, $fullMessage, $headers)) {
        echo "E-mail succesvol verzonden!";
    } else {
        echo "E-mail verzenden mislukt.";
    }
    exit; // Ensure no additional output is sent
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Rewind-IT</title>
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css"
    />
    <link rel="stylesheet" href="./style.css" />
    <link rel="icon" href="./favicon.ico" type="image/x-icon" />
    <script type="module" src="index.js"></script>
</head>
<body>
    <!--Main Navigation-->
    <header>
      <nav
        class="navbar sticky-top navbar-expand-lg navbar-dark bg-dark"
        style="z-index: 2000"
      >
        <div class="container-fluid">
          <!-- Navbar brand -->
          <a class="navbar-brand nav-link" href="index.html">
            <strong>Rewind-IT</strong>
          </a>
          <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarExample01"
            aria-controls="navbarExample01"
            aria-expanded="false"
            aria-label="Toggle navigation"
          >
            <i class="fas fa-bars"></i>
          </button>
          <div
            class="collapse navbar-collapse justify-content-end"
            id="navbarExample01"
          >
            <ul class="navbar-nav mr-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link" href="diensten.html">Diensten</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="overons.html">Over Ons</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="contact.php">Contact</a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
    </header>
    <!--Main Navigation-->

    <section class="py-5">
      <div class="container">
        <div class="row">
          <!-- Contact Information -->
          <div class="col-lg-6 mb-5 mb-lg-0">
            <h2 class="mb-4">Contact Informatie</h2>
            <ul class="list-unstyled">
              <li class="mb-3">
                <strong>Adresgegevens:</strong><br />
                Apkenstraat 49<br />
                1447PN Purmerend
              </li>
              <li class="mb-3">
                <strong>Telefoon:</strong><br />
                06-42622854
              </li>
              <li class="mb-3">
                <strong>E-mailadres:</strong><br />
                <a href="mailto:Info@rewind-it.nl">Info@rewind-it.nl</a>
              </li>
            </ul>
            <h2 class="mb-4 mt-5">Overige Informatie</h2>
            <ul class="list-unstyled">
              <li class="mb-3">
                <strong>KvK:</strong><br />
                94194610
              </li>
              <li>
                <strong>BTW:</strong><br />
                NL003257522B43
              </li>
            </ul>
          </div>

          <!-- Contact Form -->
          <div class="col-lg-6">
            <h2 class="mb-4">Neem Contact Op</h2>
            <form id="contactForm" method="POST">
              <div class="mb-3">
                <label for="name" class="form-label">Naam</label>
                <input
                  type="text"
                  class="form-control"
                  id="name"
                  name="name"
                  placeholder="Uw naam"
                  required
                />
              </div>
              <div class="mb-3">
                <label for="email" class="form-label">E-mailadres</label>
                <input
                  type="email"
                  class="form-control"
                  id="email"
                  name="email"
                  placeholder="Uw e-mailadres"
                  required
                />
              </div>
              <div class="mb-3">
                <label for="subject" class="form-label">Onderwerp</label>
                <input
                  type="text"
                  class="form-control"
                  id="subject"
                  name="subject"
                  placeholder="Onderwerp"
                  required
                />
              </div>
              <div class="mb-3">
                <label for="message" class="form-label">Bericht</label>
                <textarea
                  class="form-control"
                  id="message"
                  name="message"
                  rows="5"
                  placeholder="Uw bericht"
                  required
                ></textarea>
              </div>
              <button type="submit" class="btn btn-primary">Verzenden</button>
            </form>

            <!-- Display Success or Error Message -->
            <div id="formMessage" class="mt-3"></div>
          </div>
        </div>
      </div>
    </section>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/8cfa4acbf7.js" crossorigin="anonymous"></script>
    <script>
      document.addEventListener("DOMContentLoaded", function () {
        document
          .getElementById("contactForm")
          .addEventListener("submit", function (event) {
            event.preventDefault(); // Prevent the default form submission

            var formData = new FormData(this); // Collect form data

            fetch("contact.php", { // Submit to the same file
              method: "POST",
              body: formData,
            })
              .then((response) => response.text())
              .then((result) => {
                document.getElementById("formMessage").innerHTML =
                  '<div class="alert alert-success" role="alert">' +
                  result +
                  "</div>"; // Display success message
                document.getElementById("contactForm").reset(); // Reset the form fields
              })
              .catch((error) => {
                document.getElementById("formMessage").innerHTML =
                  '<div class="alert alert-danger" role="alert">An error occurred: ' +
                  error +
                  "</div>"; // Display error message
              });
          });
      });
    </script>
  </body>
</html>
