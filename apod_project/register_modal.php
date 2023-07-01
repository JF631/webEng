<!DOCTYPE html>
<html>

<head>
    <title>Registration Page</title>
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
    <div id="registerModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="registerModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="registerModalLabel">Register</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Registration form HTML code -->
                    <form id="registerForm" method="POST" action="register-eval.php">
                        <div class="form-group">
                            <label for="reg_username">Username</label>
                            <input type="text" class="form-control" id="reg_username" name="username"
                                autocomplete="username" required>
                            <span id="usernameErrorMessage" class="text-danger" style="display: none;">Username exists</span>
                        </div>
                        <div class="form-group">
                            <label for="reg_passwd">Password</label>
                            <input type="password" class="form-control" id="reg_passwd" name="password"
                                autocomplete="new-password" required>
                        </div>
                        <div class="form-group">
                            <label for="reg_passwdRepeat">Repeat Password</label>
                            <input type="password" class="form-control" id="reg_passwdRepeat" name="passwordRepeat"
                                autocomplete="new-password" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Register</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // JavaScript code for handling registration form submission and other functionalities
        $(document).ready(function () {
            // Show the register modal when the "register" button is clicked
            $('.btn-outline-secondary').click(function () {
                if ($(this).text() === 'register') {
                    $('#registerModal').modal('show');
                }
            });

            // Handle registration form submission
            $('#registerForm').submit(function (event) {
                event.preventDefault(); // Prevent the default form submission

                // Perform AJAX registration request
                $.ajax({
                    type: 'POST',
                    url: 'register-eval.php',
                    data: $(this).serialize(), // Serialize the form data
                    success: function () {
                        // Display a success message in the modal or redirect to a success page
                        $('#registerModal .modal-body').text('Registration successful!');
                        location.reload();
                        // Alternatively, you can redirect the user to a success page
                        // window.location.href = 'success.php';
                    },
                    error: function (xhr) {
                        if (xhr.status === 401) {
                            // Show the error message below the username input
                            $('#usernameErrorMessage').show();
                        }
                    }
                });
            });
        });
    </script>
</body>

</html>
