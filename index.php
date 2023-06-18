<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>UMLify</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700|Montserrat:400,700" rel="stylesheet">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/mike.css">
  <script src="https://unpkg.com/gojs/release/go.js"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bs-custom-file-input/dist/bs-custom-file-input.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
</head>

<body>
  <?php include 'top_navbar.php'; ?>
  <div class="container my-5">
    <div class="row">
      <div class="col-md-6 mx-auto">
        <h1 class="text-center mb-4">Header-Dateien hochladen</h1>
        <div class="text-center"><h6>Free, Easy, No Limits</h6></div><br>
        <form id="upload-form" enctype="multipart/form-data">
  <div class="form-group">
    <label for="file">Header-Datei auswählen:</label>
    <div class="custom-file">
      <input type="file" name="file[]" id="fileInput" multiple class="custom-file-input">
      <label class="custom-file-label" for="file">Choose file</label>
    </div>
  </div>
  <button type="submit" id="uploadFilesButton" class="btn btn-secondary btn-block btn-black" disabled>Hochladen</button>
</form>
      </div>
    </div>
  </div>
  
  <div class="container my-5">
    <h2 class="text-center mb-4">Wie funktioniert es?</h2>
    <div class="row">
      <div class="col-md-6">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Schritt 1</h5>
            <p class="card-text">Klicken Sie auf "Header-Datei auswählen", um eine oder mehrere<br>
            .h-Dateien auszuwählen, die Sie hochladen möchten.</p>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Schritt 2</h5>
            <p class="card-text">Klicken Sie auf "Hochladen", um Ihre Dateien auf unseren Server zu übertragen.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div id="uml"></div>
  <div id="myDiagramDiv"></div>
  <script>
    $(document).ready(function () {
      bsCustomFileInput.init()
    })
  </script>
  <div class="slider-thumb"></div>
  <div class="container">
  <div class="speech-bubble">
  Need help? Visit our <a href="faq.php">FAQ site</a>!
</div>
  <div class="horn"> </div>
  <div class="horn right"> </div>
  <div class="head"> </div>
 
  <div class="face">
    <div class="eye">
      <div class="iris"> </div>
    </div>
    <div class="mouth"> </div>
  </div>
  <div class="hand"></div>
  <div class="hand right"></div>
  <div class="leg">
    <div class="nail"></div>
    <div class="nail one"></div>
    <div class="nail two"></div>
  </div>

  <div class="leg two">
    <div class="nail"></div>
    <div class="nail one"></div>
    <div class="nail two"></div>
  </div>
</div>
<script src="script.js"></script>
</body>

</html>

