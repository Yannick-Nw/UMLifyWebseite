$(document).ready(function () {
	drawUML();
	downloadUML();
});

function drawUML() {
	console.log("ZEICHNEN");
	$.ajax({
		url: "result.json",
		dataType: "json",
		success: function (data) {
			var classes = data.classes;
			var html = '<div class="container"><div class="row">';
			for (var className in classes) {
				var classData = classes[className];
				html += '<div class="col-2 m-4">';
				html += '<div id="' + className + '"class="card">';
				html += '<div class="card-header fw-bold">' + className + "</div>";
				if (classData.attributes.length > 0) {
					html += '<div class="card-header">Attributes</div>';
					html += '<ul class="list-group list-group-flush">';
					for (var i = 0; i < classData.attributes.length; i++) {
						var attribute = classData.attributes[i];
						var attributeType = attribute.charAt(0);
						var cssClass = "";
						if (attributeType === "+") {
							cssClass = "public-attribute";
						} else if (attributeType === "#") {
							cssClass = "protected-attribute";
						} else if (attributeType === "-") {
							cssClass = "private-attribute";
						}
						html += '<li class="list-group-item ' + cssClass + '">' + attribute + "</li>";
					}
					html += "</ul>";
				}
				if (classData.methods.length > 0) {
					html += '<div class="card-header">Methods</div>';
					html += '<ul class="list-group list-group-flush">';
					for (var i = 0; i < classData.methods.length; i++) {
						var method = classData.methods[i];
						var methodName = method.name;
						var methodType = methodName.charAt(0);
						var cssClass = "";
						if (methodType === "+") {
							cssClass = "public-method";
						} else if (methodType === "#") {
							cssClass = "protected-method";
						} else if (methodType === "-") {
							cssClass = "private-method";
						}
						html += '<li class="list-group-item ' + cssClass + '">' + methodName + "</li>";
					}
					html += "</ul>";
				}
				html += "</div>";
				html += "</div>";
			}
			html += "</div></div>";
			console.log(classes);
			$("#uml").html(html);
			$(".card").draggable({
				containment: "#myDiv",
			});
			drawlines(classes);
		},
	});
	deleteFiles();
}

function deleteFiles() {
	$.ajax({
		url: "deleteFilesFromServer.php",
		success: function (response) {
			console.log("Gelöscht");
		},
	});
}

function downloadUML() {
	$("#pic").click(function () {
		canvasconverter();
		// htmlToImage.toJpeg($("#uml")[0], { quality: 0.95 }).then(function (dataUrl) {
		// 	var link = document.createElement("a");
		// 	link.download = "my-image-name.jpeg";
		// 	link.href = dataUrl;
		// 	link.click();
		// });
		html2canvas($("#sign-up-uml")[0]).then(function (canvas) {
			var link = document.createElement("a");
			link.download = "image.png";
			link.href = canvas.toDataURL();
			link.click();
		});
		// html2canvas(document.querySelector("#uml")).then(function (canvas) {
		// 	document.body.appendChild(canvas);
		// });
	});
}

function drawlines(classes) {
	/*
	var startCard = $("#card1");
	var endCard = $("#card2");

	var line = new LeaderLine(startCard, endCard, {
		path: "grid",
	});
	*/
	$(function () {
		for (var className in classes) {
			if (classes[className].parent.length > 0) {
				// console.log(classes[className].parent);
				let line = new LeaderLine(document.getElementById(className), document.getElementById(classes[className].parent), { path: "grid", color: "black" });
				let start = "#" + className;
				let end = "#" + classes[className].parent;
				// console.log(start, end);
				$('.myClass').append()
				$(start + ", " + end).draggable({
					drag: function () {
						line.position();
					},
				});
			}
		}
		// let line = new LeaderLine(document.getElementById("Enemy"), document.getElementById("Field"), { path: "grid", color: "black" });
		// $("#Enemy, #Field").draggable({
		// 	drag: function () {
		// 		line.position();
		// 	},
		// });
	});
}

function canvasconverter() {
	$(".leader-line").each(function () {
		var svg = this;
		console.log(svg);
		var xml = new XMLSerializer().serializeToString(svg);
		console.log(xml);
		var svg64 = btoa(xml);
		console.log(svg64);
		var b64Start = "data:image/svg+xml;base64,";
		console.log(b64Start);
		var image64 = b64Start + svg64;
		var img = new Image();
		console.log(img);
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
		// html2canvas($("#sign-up-uml")[0]).then(function (canvas) {
		//   document.body.appendChild(canvas);
		// });
		// $(newImg).replaceWith(newImg);
	});
}
