$(document).ready(function () {
	$("input").each(function() {
    var id = $(this).attr("id");
    var labelText = $(this).prev("label").text();
    pick(id, labelText);
});


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

function pick(name, labelText) {
	name = "#" + name;
	$(name).on("input", function () {
		var inputValue = $(this).val();
		if (!name.includes("-card")) {
			name = name + "-card";
		}
		if (!name.includes("#")) {
			name = "#" + name;
		}
		if (inputValue) {
			// console.log(name);
			if ($(name).length) {
				$(name + "-text").text(inputValue);
			} else {
				if (name.startsWith("#")) {
					name = name.slice(1);
				}
				diagramm(inputValue, name, labelText);
        lines();
			}
		}
	});
}

function diagramm(inputValue, name, labelText) {
	// console.log(inputValue);
	var div = $("<div>").addClass("row mb-5").attr("id", name + "-uml");;
  var card = $("<div>").addClass("card col-md-4").attr("id", name);
	var cardBody = $("<div>").addClass("card-body");
	var cardTitle = $("<h5>").addClass("card-title").text(labelText);
	var cardText = $("<p>")
		.addClass("card-text")
		.text(inputValue)
		.attr("id", name + "-text");

	cardBody.append(cardTitle).append(cardText);
	card.append(cardBody);
  div.append(card);
	$("#sign-up-uml").append(div);
}

function lines() {
  var cards = $(".card");
  for (var i = 0; i < cards.length - 1; i++) {
    new LeaderLine(cards[i], cards[i + 1]);
  }
}