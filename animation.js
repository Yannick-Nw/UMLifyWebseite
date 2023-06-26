$(document).ready(function () {
  pick("input-1");

  
	// // Select the form and input fields
	// var form = $("form");
	// var inputFields = form.find("input");

	// // Set initial opacity to 0 for input fields except the first one
	// inputFields.not(":first").css("opacity", 0);

	// // Listen for input events on each input field
	// inputFields.each(function (index) {
	// 	$(this).on("input", function () {
	// 		// Fade in the next input field
	// 		var nextInputField = inputFields.eq(index + 1);
	// 		nextInputField.animate({ opacity: 1 }, 800);
	// 	});
	// });

});

function pick(name) {
  name = "#" + name;
  $(name).on('input', function() {
    var inputValue = $(this).val();
    name = name + "-card";
    if (inputValue) {
      if ($(name).length) {
        
      } else {
        diagramm(inputValue, name);
      }
    }
  });
}

function diagramm(inputValue, name) {
  console.log(inputValue);
	var card = $("<div>").addClass("card col-md-4").attr('name', name);
	var cardBody = $("<div>").addClass("card-body");
	var cardTitle = $("<h5>").addClass("card-title").text("Username");
	var cardText = $("<p>").addClass("card-text").text(inputValue);

	cardBody.append(cardTitle).append(cardText);
	card.append(cardBody);

	$("#sign-up-uml").append(card);
}
