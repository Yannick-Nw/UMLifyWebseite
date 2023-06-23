$(document).ready(function() {
  //drawUML(); //kann man entkommentieren für Tests
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
          getUML();
        }
      });
    });
  });
  
  function getUML() {
    $.ajax({
      url: 'callpythonscript.php',
      success: function(response) {
        window.location.href = 'showUML.php';
      }
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