<!DOCTYPE html>
<html>

<head>
  <title>Astronomy Picture of the Day</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css"
    href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
  <link rel="stylesheet" type="text/css"
    href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
  <link rel="stylesheet" type="text/css" href="overview.css">

</head>

<body>
  <h1 class="text-center">Astronomy Picture of the Day</h1>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div id="imageCarousel" class="owl-carousel owl-theme">
          <?php
          // Fetch APOD JSON data
          include 'fetch_apod.php';
          $currentDate = date("Y-m-d");
          $sevenDaysAgo = date("Y-m-d", strtotime('-7 days', strtotime($currentDate)));
          $apodJson = fetchAPODs($sevenDaysAgo, $currentDate);

          foreach ($apodJson as $apodItem) {
            $apodTitle = $apodItem->title;
            $apodImageUrl = $apodItem->url;
            $apodExplanation = $apodItem->explanation;

            echo '<div class="item">';
            echo '<div class="card image-card">';
            echo '<div class="image-container">';
            echo '<button class="btn btn-info info-button" data-toggle="modal" data-target="#infoModal" data-title="' . $apodTitle . '" data-explanation="' . $apodExplanation . '">i</button>';
            echo '<img class="card-img-top" src="' . $apodImageUrl . '" alt="' . $apodTitle . '">';
            echo '</div>';
            echo '<div class="image-info"></div>';
            echo '</div>';
            echo '</div>';

          }
          ?>
        </div>

        <!-- Button to show/hide the image gallery -->
        <div class="text-center mt-3">
          <button id="toggleGalleryBtn" class="btn btn-primary">show older images</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Image Gallery -->
  <div id="imageGallery" class="container mt-5" style="display: none;">
    <div class="row" id="galleryImages">
      <!-- Gallery images will be dynamically loaded here -->
    </div>
  </div>

  <!-- Spinner -->
  <div id="spinner" class="text-center" style="display: none;">
    <div class="spinner-border text-primary" role="status">
      <span class="sr-only">Loading...</span>
    </div>
  </div>

  <!-- Image Modal -->
  <div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-body text-center">
          <img class="modal-image img-fluid" src="" alt="">
        </div>
      </div>
    </div>
  </div>

  <!-- Info Modal -->
  <div class="modal fade" id="infoModal" tabindex="-1" role="dialog" aria-labelledby="infoModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="infoModalLabel"></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p id="infoModalText"></p>
        </div>
      </div>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

  <script>
    // Initialize the carousel
    $(document).ready(function () {
      $('.owl-carousel').owlCarousel({
        items: 1,
        loop: true,
        nav: false,
        dots: true
      });

      // Handle info button click for dynamically added buttons
      $(document).on('click', '.info-button', function () {
        var title = $(this).data('title');
        var explanation = $(this).data('explanation');

        $('#infoModalLabel').text(title);
        $('#infoModalText').text(explanation);
      });

      // Handle gallery button click
      $('#toggleGalleryBtn').click(function () {
        $('#imageGallery').toggle();
        $('#toggleGalleryBtn').text(function (i, text) {
          return text === "show archiv" ? "Hide archiv" : "show archiv";
        });
        if ($('#imageGallery').is(':visible')) {
          $('#imageGallery')[0].scrollIntoView({ behavior: 'smooth' });

          // Show the spinner
          $('#toggleGalleryBtn').text('Loading...');
          $('#spinner').show();

          // Load gallery images using AJAX
          $.ajax({
            url: 'image_gallery.php',
            success: function (response) {
              $('#galleryImages').html(response);
              $('#toggleGalleryBtn').text('Hide archiv');
              // Hide the spinner
              $('#spinner').hide();
            },
            error: function () {
              alert('Error loading gallery images.');
              // Hide the spinner
              $('#spinner').hide();
            }
          });
        }
      });

      // Handle image link click
      $(document).on('click', '.image-link', function () {
        var src = $(this).data('src');
        var title = $(this).data('title');

        // Update the image source and alt text in the modal
        $('.modal-image').attr('src', src);
        $('.modal-image').attr('alt', title);
      });
    });

  </script>
</body>

</html>
