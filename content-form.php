<!DOCTYPE html>
<html>

<head>
    <title>Content Page</title>
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
    <script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <?php include('header.php'); ?>


    <script>
        function validateInput() {
            var shortTitleElement = document.getElementById("shortTitle");
            var errorMsgElement = document.getElementById("errorMsg");
            if (shortTitleElement.value.length > 5) {
                errorMsgElement.innerHTML = "Kürzel darf höchstens 5 Zeichen besitzen";
                return false;
            }
            var table =document.createElement("table");
            
            console.log(shortTitleElement.value);

            $.ajax({
                type: 'POST',
                data: {
                    short_form: shortTitleElement.value
                },
                url: 'check_short_form.php',
                success: function (result) {
                    var decoded_result = JSON.parse(result);
                    console.log(decoded_result);
                    decoded_result.forEach(element => {
                        table.innerHTML = '';
                        var row = document.createElement("tr");
                        var titleCell = document.createElement("td");
                        var shortTitleCell = document.createElement("td");
                        var descriptionCell = document.createElement("td");
                        var titleCellText = document.createTextNode(element.title);
                        var shortTitleCellText = document.createTextNode(element.shortTitle);
                        var descriptionCellText = document.createTextNode(element.topicDescription);
                        titleCell.appendChild(titleCellText);
                        shortTitleCell.appendChild(shortTitleCellText);
                        descriptionCell.appendChild(descriptionCellText);
                        row.appendChild(titleCell);
                        row.appendChild(shortTitleCell);
                        row.appendChild(descriptionCell);
                        table.appendChild(row);

                        console.log(element);
                    });
                    document.body.appendChild(table);
                },
                error: function () {
                    alert('Error occurred');
                }
            });

            return true;
        }
    </script>
</head>

<body>
    <?php
    $title = isset($_POST['id']) ? "Eintrag bearbeiten" : "Eintrag anlegen";
    if (!isset($_SESSION['username'])) {
        header("Location: login.html");
        exit();
    }

    $username = $_SESSION['username'];  
    ?>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-auto">
                <h1>
                    <?php echo $title ?>
                </h1>
            </div>
        </div>
        <form action="create_topic.php" method="POST" onsubmit="return validateInput()">
            <input type="hidden" name="topicId" value="<?php echo isset($_POST['id']) ? $_POST['id'] : ''; ?>">
            <div class="row justify-content-center">
                <div class="col-8">
                    <div class="form-group">
                        <label for="title">Thema:</label>
                        <input type="text" class="form-control" id="title" name="title" placeholder="Enter text..."
                            value="<?php echo isset($_POST['topic']) ? $_POST['topic'] : ''; ?>">
                    </div>
                </div>
                <div class="col-8">
                    <div class="form-group">
                        <label for="shortTitle">Kürzel:</label>
                        <input type="text" class="form-control" id="shortTitle" name="shortTitle"
                            placeholder="Enter text..."
                            value="<?php echo isset($_POST['shortTopic']) ? $_POST['shortTopic'] : ''; ?>">
                        <p id="errorMsg" style="color: red;"></p>
                    </div>
                </div>
                <div class="col-8">
                    <div class="form-group">
                        <label for="description">Beschreibung:</label>
                        <textarea class="form-control" id="description" name="description" rows="3"
                            placeholder="Enter text..."><?php echo isset($_POST['topicDescription']) ? $_POST['topicDescription'] : ''; ?></textarea>
                    </div>
                </div>
                <div class="col-8">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </form>

        <div>
            <p id="titleView"></p>
            <p id="shortForm"></p>
            <p id="descriptionView"></p>
        </div>

        <script>
            const inputElement = document.getElementById('shortTitle');
            inputElement.addEventListener('blur', function () {
                validateInput();
            });

        </script>
    </div>

</body>

</html>
<?php


?>