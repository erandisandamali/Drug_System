$(document).ready(function () {
  $("#loginForm").submit(function (event) {
    event.preventDefault();

    if (validateForm()) {
      var username = $("#username").val();
      var password = $("#password").val();

      // Send AJAX request
      $.ajax({
        type: "POST",
        url: "process/login.php",
        data: {
          username: username,
          password: password,
        },
        dataType: "json", // Ensure the expected response type is JSON
        success: function (response) {
          // Check if the login was successful
          if (response.success) {
            // Redirect to the dashbord
            window.location.href = "dashboard.php";
          } else {
            $("#error-message").html(response.message);
            $("#error-message").show();
          }
        },
        error: function () {
          $("#error-message").html(
            "Error occurred while processing your request. Please try again later."
          );
        },
      });
    }
  });

  function validateForm() {
    var username = $("#username").val();
    var password = $("#password").val();

    if (username.trim() === "") {
      $("#usernameError").html("Please enter your username.");
      return false;
    } else {
      $("#usernameError").html("");
    }

    if (password.trim() === "") {
      $("#passwordError").html("Please enter your password.");
      return false;
    } else {
      $("#passwordError").html("");
    }

    return true;
  }
});
