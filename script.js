$(document).ready(function() {
  $('#upload-form').submit(function(e) {
    e.preventDefault();
    var formData = new FormData();
    var files = $('#fileInput')[0].files;

    for (var i = 0; i < files.length; i++) {
      formData.append('file[]', files[i]);
    }
  
      $.ajax({
        url: 'upload.php',
        type: 'POST',
        data: formData,
        async: false,
        cache: false,
        contentType: false,
        processData: false,
        success: function(response) {
          console.log(response);
          if (response == "error") {
            var errorMessage = $("<p>Der Upload darf nicht größer als 1MB sein!</p>").css({
              "color": "red",
              "font-weight": "bold",
              "text-align": "center",
              "font-size": "30px",
              "text-shadow": "1px 1px 2px rgb(0, 0, 0)",
              "margin-top": "2%"
              });
            $('#error-message').html(errorMessage);
          }else{
            getUML(response);
          }
        }
      });
    });
  });
  
  function getUML(uploadDir) {
    $.ajax({
      url: 'callpythonscript.php',
      type: 'POST',
      data: { upload_dir: uploadDir },
      success: function(response) {
        if (response !== "error") {
          window.location.href = 'showUML.php';
        } else {
          var errorMessage = $("<p>Es wurde kein .h File hochgeladen!</p>").css({
            "color": "red",
            "font-weight": "bold",
            "text-align": "center",
            "font-size": "30px",
            "text-shadow": "1px 1px 2px rgb(0, 0, 0)",
            "margin-top": "2%"
            });
          $('#error-message').html(errorMessage);
        }
      },
    });
  }

document.addEventListener('DOMContentLoaded', function() {
  const fileInput = document.getElementById('fileInput');
  const submitButton = document.getElementById('uploadFilesButton');

  fileInput.addEventListener('change', function() {
    if (fileInput.files.length > 0) {
      submitButton.disabled = false;
    } else {
      submitButton.disabled = true;
    }
  });
});