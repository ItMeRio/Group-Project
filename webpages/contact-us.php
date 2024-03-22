<?php
session_start();
include "connect.php";

if(isset($_POST['contact_us'])){
  $name = mysqli_real_escape_string($conn, $_POST['name']);
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $subject = mysqli_real_escape_string($conn, $_POST['subject']);
  $text = mysqli_real_escape_string($conn, $_POST['message']);

  $contact_us_submit = mysqli_query($conn, "INSERT INTO contactus (name, contactus_email, subject, message) VALUES ('$name', '$email', '$subject', '$text')");
  
  if($contact_us_submit){
    $display_message = "Query sent"; // Set the message
  } else {
    $error_message = "Error: " . mysqli_error($conn); // Display SQL error if query fails
  }
}
?>

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

    <form action="" method="post">
      <label for="name">Name:</label>
      <input type="text" id="name" name="name" required>

      <label for="email">Email:</label>
      <input type="email" id="email" name="email" required>

      <label for="subject">Subject:</label>
      <input type="text" id="subject" name="subject" required>

      <label for="message">Message:</label>
      <textarea id="message" name="message" rows="4" required></textarea>

      <input type="submit" name ="contact_us" value="Submit">
    </form>

    <?php if(isset($display_message)): ?>
      <div class="success-message">
        <div class="success-icon">
          <i class="fas fa-check-circle"></i>
        </div>
        <div class="success-text">
          <?php echo $display_message; ?>
        </div>
      </div>
    <?php endif; ?>
  </div>
</main>
<?php include_once("includes/footer.php") ?>
</body>

</html>