<!DOCTYPE html>
<html>

<head>
    <title>My Website</title>
    <!-- include Bootstrap CSS file -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>

<body>
    <?php
    session_start();
    $btn_text = "login";
    $action = "login.html";
    $loggedInUser = "";
    if (isset($_SESSION['username'])) {
        $loggedInUser = "Angemeldet als " . $_SESSION['username'];
        $btn_text = "logout";
        $action = "logout.php";
    }
    ?>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="content.php">Fancy Webpage</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mr-auto">
                <!-- <li class="nav-item">
                    <a class="nav-link" href="#">Link 1</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Link 2</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Link 3</a>
                </li> -->
            </ul>
            <form class="form-inline my-2 my-lg-0">
                <p class="mr-sm-2">
                    <?php echo $loggedInUser; ?>
                </p>
                <button class="btn btn-outline-secondary my-2 my-sm-0 logout" type="button"><?php echo $btn_text; ?></button>
            </form>
        </div>
    </nav>

    <!-- Include the login modal file -->
    <?php include 'login_modal.php'; ?>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            // Show the login modal when the "login" button is clicked
            $('.btn-outline-secondary').click(function () {
                if ($(this).text() === 'login') {
                    $('#loginModal').modal('show');
                    e.preventPropagation();
                }
            });

            // Handle logout button click
            $('.btn-outline-secondary.logout').click(function () {
                $.ajax({
                    type: 'GET',
                    url: 'logout.php',
                    success: function (response) {
                        location.reload(); // Reload the page after logout
                    }
                });
            });
        });
    </script>


</body>

</html>