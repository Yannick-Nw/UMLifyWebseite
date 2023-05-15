$(document).ready(function() {
    drawUML();
});

function drawUML() {
    console.log("ZEICHNEN");
    $.ajax({
		url: "result.json",
		dataType: "json",
		success: function (data) {
			// Parse the data here
			var classes = data.classes;
			var html = '<div class="container-fluid"><div class="row">';
			for (var className in classes) {
				var classData = classes[className];
				html += '<div class="col-sm">';
				html += '<div class="card">';
				html += '<div class="card-header fw-bold">' + className + "</div>";
				html += '<ul class="list-group list-group-flush">';
				for (var i = 0; i < classData.attributes.length; i++) {
					html += '<li class="list-group-item">' + classData.attributes[i] + "</li>";
				}
				html += "</ul>";
				var publicMethods = [];
				var protectedMethods = [];
				var privateMethods = [];
				for (var i = 0; i < classData.methods.length; i++) {
					var method = classData.methods[i];
					var methodName = method.name;
					var methodType = methodName.charAt(0);
					if (methodType === "+") {
						publicMethods.push(methodName);
					} else if (methodType === "#") {
						protectedMethods.push(methodName);
					} else if (methodType === "-") {
						privateMethods.push(methodName);
					}
				}
				if (publicMethods.length > 0) {
					html += '<div class="card-header">Public</div>';
					html += '<ul class="list-group list-group-flush">';
					for (var i = 0; i < publicMethods.length; i++) {
						html += '<li class="list-group-item">' + publicMethods[i].substring(1).trim() + "</li>";
					}
					html += "</ul>";
				}
				if (protectedMethods.length > 0) {
					html += '<div class="card-header">Protected</div>';
					html += '<ul class="list-group list-group-flush">';
					for (var i = 0; i < protectedMethods.length; i++) {
						html += '<li class="list-group-item">' + protectedMethods[i].substring(1).trim() + "</li>";
					}
					html += "</ul>";
				}
				if (privateMethods.length > 0) {
					html += '<div class="card-header">Private</div>';
					html += '<ul class="list-group list-group-flush">';
					for (var i = 0; i < privateMethods.length; i++) {
						html += '<li class="list-group-item">' + privateMethods[i].substring(1).trim() + "</li>";
					}
					html += "</ul>";
				}
				html += "</div>";
				html += "</div>";
			}
			html += "</div></div>";
			$("#uml").html(html);

			/*
			$.each(data.relations, function (key, value) {
                console.log(data.relations)
				var $card1 = $("#" + key);
				var $card2 = $("#" + value);

				var x1 = $card1.offset().left + $card1.outerWidth() / 2;
				var y1 = $card1.offset().top + $card1.outerHeight() / 2;
				var x2 = $card2.offset().left + $card2.outerWidth() / 2;
				var y2 = $card2.offset().top + $card2.outerHeight() / 2;

				var $line = $("<line></line>")
					.attr("id", key + "-" + value)
					.attr("x1", x1)
					.attr("y1", y1)
					.attr("x2", x2)
					.attr("y2", y2)
					.css({
						stroke: "black",
						"stroke-width": 2,
						"marker-end": "url(#arrowhead)",
					});

				$svg.append($line);
			});
			
			var $marker = $("<marker></marker>").attr("id", "arrowhead").attr("markerWidth", 10).attr("markerHeight", 10).attr("refX", 0).attr("refY", 3).attr("orient", "auto").attr("markerUnits", "strokeWidth");

			var $path = $("<path></path>").attr("d", "M0,0 L0,6 L9,3 z").css({ fill: "black" });

			$marker.append($path);
			$svg.append($marker);
			*/
			$(".card").draggable({
				// Add an event listener for the drag event
				drag: function (event, ui) {
					// Get the id of the dragged card
					var draggedCardId = $(event.target).attr("id");

					// Update the position of the arrows
					$.each(data.relations, function (key, value) {
						if (key === draggedCardId || value === draggedCardId) {
							var $card1 = $("#" + key);
							var $card2 = $("#" + value);

							var x1 = $card1.offset().left + $card1.outerWidth() / 2;
							var y1 = $card1.offset().top + $card1.outerHeight() / 2;
							var x2 = $card2.offset().left + $card2.outerWidth() / 2;
							var y2 = $card2.offset().top + $card2.outerHeight() / 2;

							// Update the coordinates of the line
							$("#" + key + "-" + value)
								.attr("x1", x1)
								.attr("y1", y1)
								.attr("x2", x2)
								.attr("y2", y2);
						}
					});
				},
			});

			/*
			$.each(data.relations, function (key, value) {
				$("#uml").append($("<p></p>").text(key + " -> " + value));
			});
            */
		},
	});
	$(".card").draggable();
    deleteFiles();
};

function deleteFiles(){
  $.ajax({
    url: 'deleteFilesFromServer.php',
    success: function(response) {
      console.log("Gelöscht");
    }
  });
}