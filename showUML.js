$(document).ready(function() {
    drawUML();
});

function drawUML() {
    console.log("ZEICHNEN");
	$.ajax({
		url: "uploads/"+sessionID+"/result.json",
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
			console.log(classes);
			$("#uml").html(html);
			$(".card").draggable({
				containment: "#myDiv",
			});

			/*
			$.each(data.relations, function (key, value) {
				$("#uml").append($("<p></p>").text(key + " -> " + value));
			});
            */
		},
	});
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
