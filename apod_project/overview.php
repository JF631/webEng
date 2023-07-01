<!DOCTYPE html>
<html>

<head>
  <title>Astronomy Picture of the Day</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.1/font/bootstrap-icons.css">
  <link rel="stylesheet" type="text/css"
    href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
  <link rel="stylesheet" type="text/css"
    href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
  <link rel="stylesheet" type="text/css" href="overview.css">
  <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>


  <?php include('header.php'); ?>

</head>

<body>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="input-group mt-3 mb-3">
          <input id="searchInput" type="text" class="form-control datepicker"
            placeholder="Let's find your birthday image... (yyyy-MM-dd)">
          <div class="input-group-append">
            <button id="searchButton" class="btn btn-primary" type="button">Find</button>
          </div>
        </div>
      </div>
    </div>
  </div>

  <h1 class="text-center">Astronomy Picture of the Day</h1>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div id="imageCarousel" class="owl-carousel owl-theme">
          <?php
          // Fetch APOD JSON data
          include 'fetch_apod.php';
          $currentDate = date("Y-m-d");
          $sevenDaysAgo = date("Y-m-d", strtotime('-3 days', strtotime($currentDate)));
          $currentDate = date("Y-m-d", strtotime('-1 days', strtotime($currentDate)));
          $apodJson = fetchAPODs($sevenDaysAgo, $currentDate);

          if (empty($apodJson)) {
            echo 'The APOD API seems to not be working. Please come back later!';
          }

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

  <div class="text-center mt-3">
    <button id="loadMoreButton" class="btn btn-primary" style="display: none;">Load 10 More</button>
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
          <img id="modalImage" class="modal-image img-fluid" src="" alt="">
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

  <!-- Not logged in Modal -->
  <div class="modal fade" id="unauthorizedModal" tabindex="-1" aria-labelledby="unauthorizedModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="unauthorizedModalLabel">Please log in</h5>
          <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p>You need to be logged in in order to save an image</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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


      var currentDate = new Date();
      var endDate = new Date(currentDate);
      endDate.setDate(currentDate.getDate() - 5);
      var firstUsage = 0;

      var formattedDate = currentDate.toISOString().split('T')[0];
      var formattedEndDate = endDate.toISOString().split('T')[0];

      console.log(formattedDate);
      console.log(formattedEndDate);


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
      var buttonEnabled = true;

      $('#toggleGalleryBtn').click(function () {
        if (!buttonEnabled) {
          return; // Do nothing if button is disabled
        }

        $('#imageGallery').toggle();
        $('#toggleGalleryBtn').text(function (i, text) {
          return text === "show archiv" ? "Hide archiv" : "show archiv";
        });

        if ($('#imageGallery').is(':visible')) {
          $('#imageGallery')[0].scrollIntoView({ behavior: 'smooth' });

          // Show the spinner
          $('#toggleGalleryBtn').text('Loading...');
          $('#spinner').show();

          // Disable the button
          buttonEnabled = false;
          $('#toggleGalleryBtn').prop('disabled', true);

          // Load gallery images using AJAX
          $.ajax({
            url: 'image_gallery.php',
            method: 'POST',
            data: { startDate: formattedDate, endDate: formattedEndDate },
            success: function (response) {
              $('#galleryImages').html(response);
              $('#toggleGalleryBtn').text('Hide archiv');
              // Hide the spinner
              $('#spinner').hide();
              $('#loadMoreButton').show();

              // Enable the button
              buttonEnabled = true;
              $('#toggleGalleryBtn').prop('disabled', false);
            },
            error: function () {
              alert('Error loading gallery images.');
              // Hide the spinner
              $('#spinner').hide();

              // Enable the button
              buttonEnabled = true;
              $('#toggleGalleryBtn').prop('disabled', false);
            }
          });
        } else {
          $('#loadMoreButton').hide();
        }
      });


      $('#loadMoreButton').click(function () {
        currentDate.setDate(currentDate.getDate() - 10);
        endDate.setDate(endDate.getDate() - 10);

        // Adjust month transition if necessary
        // if (currentDate.getDate() > endDate.getDate()) {
        //   currentDate.setMonth(currentDate.getMonth() - 1);
        // }

        formattedDate = currentDate.toISOString().split('T')[0];
        formattedEndDate = endDate.toISOString().split('T')[0];

        console.log(formattedDate);
        console.log(formattedEndDate);

        // Disable the button
        $('#loadMoreButton').prop('disabled', true);
        $('#loadMoreButton').text('Loading...');

        $.ajax({
          url: 'image_gallery.php',
          method: 'POST',
          data: { startDate: formattedDate, endDate: formattedEndDate },
          success: function (response) {
            console.log(response);
            $('#galleryImages').append(response);
            $('#toggleGalleryBtn').text('Hide archiv');
            // Hide the spinner
            $('#spinner').hide();
            $('#loadMoreButton').show();

            // Enable the button
            $('#loadMoreButton').prop('disabled', false);
            $('#loadMoreButton').text('Load More');
          },
          error: function () {
            alert('Error loading gallery images.');
            // Hide the spinner
            $('#spinner').hide();

            // Enable the button
            $('#loadMoreButton').prop('disabled', false);
            $('#loadMoreButton').text('Load More');
          }
        });
      });


      // Handle image link click
      $(document).on('click', '.image-link', function () {
        var src = $(this).data('src');
        var title = $(this).data('title');

        // Update the image source and alt text in the modal
        $('.modal-image').attr('src', src);
        $('.modal-image').attr('alt', title);
      });

      $('#searchButton').click(function () {
        var searchText = $('#searchInput').val();

        // Call fetchAPOD function with the search text as the date
        $.ajax({
          url: 'birthday_img.php',
          method: 'POST',
          data: { date: searchText },
          success: function (response) {
            // Handle the response data
            console.log('APOD JSON:', response);

            // Parse the response as JSON
            var apodJson = JSON.parse(response);

            // Check if the response contains a valid image URL
            if (apodJson && apodJson.url) {
              var imageUrl = apodJson.url;

              // Update the modal image source
              $('#modalImage').attr('src', imageUrl);

              // Show the modal
              $('#imageModal').modal('show');
            } else {
              alert('Error: Invalid image data.');
            }
          },
          error: function () {
            alert('Error fetching APOD data: it is only working from 01 January 1996 onwards, sadly');
          }
        });
      });


      // Attach like button click event to dynamically added elements
      $(document).on('click', '.like-button', function () {
        // Get the parent card element
        var card = $(this).closest('.gallery-card');
        var likeButton = $(this);

        // Toggle the 'liked' class
        card.toggleClass('liked');
        var imageDate = $(this).closest('.gallery-card').find('.image-link').data('date');
        console.log('Gallery Date:', imageDate);


        // Assign 'likeButton' to a separate variable to access it in the AJAX success function
        var button = likeButton;

        $.ajax({
          url: 'like_image.php',
          method: 'POST',
          data: { date: imageDate },
          success: function (response) {
            // Update the heart icon based on the 'liked' class
            if (response === 'liked') {
              card.addClass('liked');
              button.html('<i class="bi bi-heart-fill"></i>');
            } else {
              card.removeClass('liked');
              button.html('<i class="bi bi-heart"></i>');
            }
          },
          error: function (xhr) {
            if (xhr.status === 401) {
              $('#unauthorizedModal').modal('show');
            } else if (xhr.status === 400) {
              alert('Error: Bad request.');
            } else if (xhr.status === 500) {
              alert('Error: Internal server error.');
            } else {
              alert('Error liking image.');
            }
          }
        });
      });
    });

  </script>

</body>

</html>