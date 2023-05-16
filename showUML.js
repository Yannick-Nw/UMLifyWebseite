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
  
		// Make the div elements with the class "card" draggable
		$(".card").draggable({
		  containment: "#myDiv"
		});
	  }
	});
  }
  