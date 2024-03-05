<!DOCTYPE html>
<html lang="en">
<head>
<?php include_once("includes/include.php") ?>
<link rel="stylesheet" href="../css/contact.css">

</head>

<body>
<?php include_once("includes/navbar.php") ?>


  <main>
    <h1>Contact Us!</h1>

    <div class="contact-container">
      <div class="map-container">
        <iframe width="500" height="500" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"
          src="https://maps.google.com/maps?width=500&amp;height=500&amp;hl=en&amp;q=b4%207et+(My%20Business%20Name)&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed">
          <a href="https://www.maps.ie/population/">Population calculator map</a>
        </iframe>
      </div>

      <form action="#" method="post">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <label for="subject">Subject:</label>
        <input type="text" id="subject" name="subject" required>

        <label for="message">Message:</label>
        <textarea id="message" name="message" rows="4" required></textarea>

        <input type="submit" value="Submit">
      </form>
    </div>
</main>
<?php include_once("includes/footer.php") ?>
</body>

</html>
