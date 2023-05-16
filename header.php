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

    $loggedInUser = $_SESSION['username'];

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
            <form class="form-inline my-2 my-lg-0" action="logout.php">
                <p class="mr-sm-2">Angemeldet als
                    <?php echo $loggedInUser; ?>
                </p>
                <button class="btn btn-outline-secondary my-2 my-sm-0" type="submit">Logout</button>
            </form>
        </div>
    </nav>
</body>