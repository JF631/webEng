<!DOCTYPE html>
<html>

<head>
    <title>Login Page</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- Include jQuery library -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <!-- Include Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <style>
        /* Add your custom styles here */
    </style>
</head>

<body>
    <div id="loginModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="loginModalLabel">Login</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Login form HTML code -->
                    <form id="loginForm" method="POST" action="login-eval.php">
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" id="username" name="username"
                                autocomplete="username" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password"
                                autocomplete="current-password" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // JavaScript code for handling login form submission and other functionalities
        $(document).ready(function () {
            // Show the login modal when the "login" button is clicked
            $('.btn-outline-secondary').click(function () {
                if ($(this).text() === 'login') {
                    $('#loginModal').modal('show');
                }
            });

            // Handle login form submission
            $('#loginForm').submit(function (event) {
                event.preventDefault(); // Prevent the default form submission

                // Perform AJAX login request
                $.ajax({
                    type: 'POST',
                    url: 'login-eval.php',
                    data: $(this).serialize(), // Serialize the form data
                    statusCode: {
                        401: function () {
                            // Display a message in the modal for unauthorized access
                            $('#loginModal .modal-body').text('Unauthorized access. Please check your credentials.');
                        }
                    },
                    success: function () {
                        location.reload(); // Reload the page after successful login
                    },
                    error: function () {
                        // Handle other errors, if any
                    }
                });
            });
        });
    </script>
</body>

</html>