window.onload = function () {
  console.log("Javascript working");
  let form = document.getElementById("signup-form");

  form.addEventListener('submit', function (event) {
    // let form  = document.getElementById("contact-form");
    event.preventDefault();


    let form = document.getElementById("signup-form");
    let email = form.email;
    let confirm_email = form.Confirm_email

    console.log(email.value);
    if (email.value == confirm_email.value) {
      confirm_email.setCustomValidity("");
    } else {
      confirm_email.setCustomValidity("Email needs to Match");
      confirm_email.reportValidity()
      //alert("Emails dont match");
      return;
    }
    let today = new Date().toJSON().slice(0, 10);
    let date = document.getElementById("date");

    if (date.value <= today) {
      date.setCustomValidity("Date not Available")
      date.reportValidity();
      return;

    } else {
      date.setCustomValidity("");
      alert("Booking Confrimed");
      form.submit();
    }
  })
};
