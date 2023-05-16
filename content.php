<!DOCTYPE html>
<html>

<head>
    <title>Content Page</title>
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="content.css">
    <script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


    <?php include('header.php'); ?>

    <script>
        function confirmDelete(id, event) {
            event.stopPropagation();
            document.getElementById('deleteButton').href = "?delete_id=" + id;
            var modal = new bootstrap.Modal(document.getElementById('confirmDeleteModal'));
            modal.show();
        }
    </script>

    <script>
        function rowClicked(id) {
            $.ajax({
                type: 'POST',
                data: {
                    topic_id: id
                },
                url: 'fetch_details.php',
                success: function (result) {
                    var decoded_result = JSON.parse(result);
                    $('#title').html("Thema: " + decoded_result.title);
                    $('#shortForm').html("Kürzel: " + decoded_result.shortTitle);
                    $('#description').html("Beschreibung: <br>" + decoded_result.topicDescription.replace(/\n/g, "<br>"));
                    $('#detailedView').show();

                },
                error: function () {
                    alert('Error occurred');
                }
            });
        }
    </script>

</head>

<body>
    <?php
    
    session_regenerate_id(true);

    if (!isset($_SESSION['username'])) {
        header("Location: login.html");
        exit();
    }

    $servername = "localhost";
    $username = "debian-sys-maint";
    $password = "SC88k4LOS7Mkv8Fl";
    $dbname = "Themenanmeldung";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if (isset($_GET['delete_id'])) {
        $id = $_GET['delete_id'];
        deleteEntry($conn, $id);
    }

    $sql = "SELECT * FROM topics";
    if ($result = $conn->query($sql)) {
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }


    function deleteEntry($conn, $id)
    {
        $sql = "DELETE FROM topics WHERE id=$id";
        if ($conn->query($sql) === TRUE) {
        } else {
            echo "Error deleting record: " . $conn->error;
        }
    }
    ?>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-auto">
                <h1>Themenübersicht</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th colspan="4" class="text-center">
                                <a href="content-form.php" class="btn btn-primary">Thema anlegen</a>
                            </th>
                        </tr>
                        <tr>
                            <th>Kürzel</th>
                            <th>Thema</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($row = $result->fetch_assoc()) {
                            $id = $row["id"];
                            $title = $row["title"];
                            $shortTitle = $row["shortTitle"];
                            $description = $row["topicDescription"];
                            echo "<tr onclick='rowClicked($id)'>";
                            echo "<td>" . $shortTitle . "</td>";
                            echo "<td>" . $title . "</td>";
                            echo "<td>";
                            echo "<form method='POST' action='content-form.php'>";
                            echo "<input type='hidden' name='id' value='" . $id . "'>";
                            echo "<input type='hidden' name='topic' value='" . $title . "'>";
                            echo "<input type='hidden' name='shortTopic' value='" . $shortTitle . "'>";
                            echo "<input type='hidden' name='topicDescription' value='" . $description . "'>";
                            echo "<button type='submit' class='btn btn-outline-primary'>Change</button>";
                            echo "</form>";
                            echo "</td>";
                            echo "<td><button onclick='confirmDelete($id, event)' class='btn btn-outline-danger'>Delete</button></td>";
                            echo "</tr>";
                        }
                        $result->close();
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="col-md-4">
                <div class="card border-dotted rounded" id="detailedView" style="display: none;">
                    <div class="card-body">
                        <h5 class="card-title text-center" id="title"></h5>
                        <p class="card-text" id="shortForm"></p>
                        <p class="card-text" id="description" style="max-height: 10em; overflow-y: auto;"></p>
                    </div>
                </div>

            </div>
        </div>

        <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="confirmDeleteModalLabel">Element Löschen?</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Soll der Eintrag wirklich gelöscht werden?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <a id="deleteButton" href="#" class="btn btn-danger">Delete</a>
                    </div>
                </div>
            </div>
        </div>

</body>

</html>