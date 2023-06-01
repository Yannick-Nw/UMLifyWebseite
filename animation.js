$(document).ready(function() {
  // Select the form and input fields
  var form = $("form");
  var inputFields = form.find("input");

  // Set initial opacity to 0 for input fields except the first one
  inputFields.not(":first").css("opacity", 0);

  // Listen for input events on each input field
  inputFields.each(function(index) {
    $(this).on("input", function() {
      // Fade in the next input field
      var nextInputField = inputFields.eq(index + 1);
      nextInputField.animate({ opacity: 1 }, 800);
    });
  });
});
