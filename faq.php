<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>FAQ</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700|Montserrat:400,700" rel="stylesheet">
  <link rel="stylesheet" href="css/style.css">
</head>

<body>
  <?php include 'top_navbar.php'; ?>
  <div class="container my-5">
    <h1 class="text-center">Frequently Asked Questions</h1>
    <div class="accordion" id="faqAccordion">
      <div class="card">
        <div class="card-header" id="headingOne">
          <h2 class="mb-0">
            <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne"
              aria-expanded="true" aria-controls="collapseOne">
              Question 1: What is UMLify?
            </button>
          </h2>
        </div>

        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#faqAccordion">
          <div class="card-body">
            UMLify is a web application that allows you to upload header files and generate UML diagrams from them.
          </div>
        </div>
      </div>
      <div class="card">
        <div class="card-header" id="headingTwo">
          <h2 class="mb-0">
            <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo"
              aria-expanded="false" aria-controls="collapseTwo">
              Question 2: How do I upload header files?
            </button>
          </h2>
        </div>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#faqAccordion">
          <div class="card-body">
            To upload header files, click on the "Header-Datei auswählen" button, select one or more .h files, and then
            click
            the "Hochladen" button to upload them to the server.
          </div>
        </div>
      </div>
      <div class="card">
        <div class="card-header" id="headingThree">
          <h2 class="mb-0">
            <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree"
              aria-expanded="false" aria-controls="collapseThree">
              Question 3: Is there a limit on the number of files I can upload?
            </button>
          </h2>
        </div>
        <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#faqAccordion">
          <div class="card-body">
            No, there are no limits on the number of files you can upload. You can upload as many header files as you
            need.
          </div>
        </div>
      </div>
      <div class="card">
        <div class="card-header" id="headingFour">
          <h2 class="mb-0">
            <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseFour"
              aria-expanded="false" aria-controls="collapseFour">
              Question 4: What types of UML diagrams does UMLify support?
            </button>
          </h2>
        </div>
        <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#faqAccordion">
          <div class="card-body">
            UMLify supports various types of UML diagrams, including class diagrams, sequence diagrams, activity
            diagrams,
            and more. You can explore the different diagram options once you upload your header files.
          </div>
        </div>
      </div>

      <div class="card">
        <div class="card-header" id="headingFive">
          <h2 class="mb-0">
            <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseFive"
              aria-expanded="false" aria-controls="collapseFive">
              Question 5: Can I download the generated UML diagrams?
            </button>
          </h2>
        </div>
        <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#faqAccordion">
          <div class="card-body">
            Yes, once the UML diagrams are generated, you will have the option to download them as image files (e.g.,
            PNG, SVG)
            or save them in a project for future reference.
          </div>
        </div>
      </div>

      <div class="card">
        <div class="card-header" id="headingSix">
          <h2 class="mb-0">
            <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseSix"
              aria-expanded="false" aria-controls="collapseSix">
              Question 6: Is UMLify free to use?
            </button>
          </h2>
        </div>
        <div id="collapseSix" class="collapse" aria-labelledby="headingSix" data-parent="#faqAccordion">
          <div class="card-body">
            Yes, UMLify is completely free to use. There are no hidden charges or subscription fees. Enjoy generating
            UML
            diagrams effortlessly.
          </div>
        </div>
      </div>
    </div>

  </div>


  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>