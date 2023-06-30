$(document).ready(function () {
	var lines = [];
	downloadUML();
	$("input").each(function () {
		var id = $(this).attr("id");
		var labelText = $(this).prev("label").text();
		pick(id, labelText, lines);
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

function pick(name, labelText, lines) {
	name = "#" + name;
	$(name).on("input", function () {
		var inputValue = $(this).val();
		if (labelText == "Password" || labelText == "Confirm Password") {
			var inputValue = "*".repeat(inputValue.length);
		}
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
				$("#sign-up-uml").removeClass("d-none");
				if (name.startsWith("#")) {
					name = name.slice(1);
				}
				diagramm(inputValue, name, labelText);
				drawlines(lines);
			}
		}
	});
}

function diagramm(inputValue, name, labelText) {
	// console.log(inputValue);
	var div = $("<div>")
		.addClass("row mb-5")
		.attr("id", name + "-uml");
	var card = $("<div>").addClass("card col-md-4").attr("id", name);
	var cardBody = $("<div>").addClass("card-body");
	var cardTitle = $("<h5>").addClass("card-title").text(labelText);
	var cardText = $("<p>")
		.addClass("card-text")
		.text(inputValue)
		.attr("id", name + "-text");

	cardBody.append(cardTitle).append(cardText);
	switch (labelText) {
		case "Username":
			div.addClass("justify-content-center");
			break;
		case "Password":
			break;
		case "Confirm Password":
			div.addClass("justify-content-end");
			break;
		default:
			break;
	}
	card.append(cardBody);
	div.append(card);
	$("#sign-up-uml").append(div);
}

function drawlines(lines) {
	console.log(lines);
	// lines.forEach(function (line) {
	// 	line.remove();
	// });
	// lines = [];
	// Select the SVG element
	var svg = $("svg");

	// Remove the SVG element
	svg.remove();

	var cards = $(".card");

	for (var i = 0; i < cards.length - 1; i++) {
		// console.log(cards[i]);
		if (i == 1) {
			var line = new LeaderLine(cards[i], cards[i + 1], { color: "black" });
		} else {
			var line = new LeaderLine(cards[i], cards[i + 1], { path: "grid", color: "black" });
		}
		// lines.push(line);
	}
	$("svg").appendTo($("#sign-up-uml"));
}

function downloadUML() {
	$("#pic").click(function () {
		canvasconverter();
		// htmlToImage.toJpeg($("#sign-up-uml")[0], { quality: 0.95 }).then(function (dataUrl) {
		// 	var link = document.createElement("a");
		// 	link.download = "my-image-name.jpeg";
		// 	link.href = dataUrl;
		// 	link.click();
		// });
		// var img = ReImg.fromSvg(document.querySelector("svg")).toImg();
		// console.log(img);
		// $("#sign-up-uml").append(img);
		// html2canvas($("#sign-up-uml")[0]).then(function (canvas) {
		// 	var link = document.createElement("a");
		// 	link.download = "image.png";
		// 	link.href = canvas.toDataURL();
		// 	link.click();
		// });
	});
}

function canvasconverter() {
	var oldSvgs = [];
	var newImgs = [];

	// $(".leader-line").each(function () {
	// 	const canvas = document.createElement("canvas");
	// 	canvas.width = this.width.baseVal.value;
	// 	canvas.height = this.height.baseVal.value;
	// 	let svgString = new XMLSerializer().serializeToString(this);
	// 	const marker = this.querySelector("marker");
	// 	if (marker) {
	// 		svgString = svgString.replace("</svg>", marker.outerHTML + "</svg>");
	// 	}
	// 	canvg(canvas, svgString);
	// 	const img = new Image();
	// 	img.src = canvas.toDataURL("image/png");
	// 	img.style.left = this.style.left;
	// 	img.style.top = this.style.top;
	// 	img.style.width = this.style.width;
	// 	img.style.height = this.style.height;
	// 	img.style.position = "absolute";
	// 	$(this).replaceWith(img);

	// 	oldSvgs.push(oldSvg);
	// 	newImgs.push(newImg);
	// });
	$(".leader-line").each(function () {
		// var svg = $(this);
		var svg = this;

		// console.log(svg);
		//var marker = svg.find("marker");

		var xml = new XMLSerializer().serializeToString(svg);
		console.log(xml);
		//xml = xml.replace("</svg>", marker[0].outerHTML + "</svg>");

		var svg64 = btoa(xml);
		// console.log(svg64);
		var b64Start = "data:image/svg+xml;base64,";
		// console.log(b64Start);
		var image64 = b64Start + svg64;
		var img = new Image();
		// console.log(img);
		img.src = image64;
		// document.body.appendChild(img);
		var oldSvg = svg;
		var newImg = img; // Replace this with the URL of the image you want to use

		// Copy relevant styles from oldSvg to newImg
		$(newImg).css({
			left: $(oldSvg).css("left"),
			top: $(oldSvg).css("top"),
			width: $(oldSvg).css("width"),
			height: $(oldSvg).css("height"),
			position: "absolute",
		});

		$(oldSvg).replaceWith(newImg);
		oldSvgs.push(oldSvg);
		newImgs.push(newImg);
	});

	html2canvas($("#sign-up-uml")[0]).then(function (canvas) {
		document.body.appendChild(canvas);
	});

	for (var i = 0; i < oldSvgs.length; i++) {
		$(newImgs[i]).replaceWith(oldSvgs[i]);
	}
}
