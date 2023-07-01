<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Dokumentation - APOD Project</title>

    <!-- Add Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <?php include('header.php'); ?>
</head>
<body>
    <div class="container">
        <h1>APOD Projekt</h1>
        <h2>Konzept</h2>
        <p>Fotos sind von Natur aus immer beeindruckend, denn sie schaffen es eigentlich einmalige Momente für immer einzufrieren.
        Fotos aus dem Weltall heben diese Bedeutung natürlich noch einmal auf ein höheres Niveau.
        Zwar sind die Fotos, die dort entstehen uns meist völlig fremd - und dennoch faszinieren sie immer wieder.
        Welche Fotos sind über die letzten Monate und Jahre aufgenommen worden? Und welches Foto wurde eigentlich an dem Tag aufgenommen als ich geboren wurde?
        Genau diese Fragen können mit dem Projekt beantwortet werden (Naja, zumindest für Menschen, die nach dem 1. Januar 1996 geboren sind)...
        Viel Spaß beim Durchschauen!
        </p>
    </div>

    <div class="container">
        <h2>Anforderungen - Funktional</h2>
        <!-- Card 1 -->
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">1. Nutzerverwaltung</h4>
                <p class="card-text">Neben dem Schlichten Anzeigen von Bildern von der NASA APOD API soll das System auch in der Lage sein, verschiedene Nutzerprofile (zeitgleich) verwalten zu können.
                Jeder angemeldete Nutzer soll Zugriff auf die von ihm favorisierten Bilder haben.
                Allerdings sollen auch nicht angemeldete Nutzer in der Lage sein, Bilder anzuschauen.
                </p>
            </div>
        </div>

        <!-- Card 2 -->
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">2. Datenverwaltung</h4>
                <p class="card-text">Die Nutzedaten als auch die Informationen über favorisierte Bilder sollen in einer SQL Datenbank hinterlegt werden.
                Nicht die Bilder selbst sollen gespeichert werden, sondern lediglich ihre Aufnahmedaten, so können sie immer wieder erneut angefragt werden.
                </p>
            </div>
        </div>

        <h2>Anforderungen - Nicht Funktional</h2>
        <!-- Card 3 -->
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">3. Optische Erscheinung</h4>
                <p class="card-text">Da es sich um eine Website handelt, die Fotos ästhetisch präsentieren soll, soll auch das optische Erscheinungsbild schlicht, aber modern und ansprechend sein.
                    Auch soll die Website auf Smartphone Displays noch angemessen visualisiert werden (Responisve).
                </p>
            </div>
        </div>
    </div>

    <div class="container">
        <h2>Mockups</h2>
        <div class="row">
            <!-- Mockup 1 -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">i) Mockup der Startseite</h4>
                        <img src="Docu/mockup_main.png" alt="Startseiten Mockup" class="img-fluid">
                    </div>
                </div>
            </div>

            <!-- Mockup 2 -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">ii) Mockup der Gallerieansicht</h4>
                        <img src="Docu/mockup_gallery.png" alt="Gallerie Mockup" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>

        <h2>Flowcharts</h2>
        <div class="row">
            <!-- Flowchart 1 -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">i) Login eines Nutzers</h4>
                        <img src="Docu/login_flowchart.jpg" alt="Flowchart zum Login" class="img-fluid">
                    </div>
                </div>
            </div>
            
            <!-- Flowchart 2 -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">ii) Anzeigen der Bilder Gallerie</h4>
                        <img src="Docu/flowchart.jpg" alt="Flowchart zum Laden von Bildern" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <h2>Validierung & Verifikation</h2>
        <!-- Card 1 -->
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Validierung</h4>
                <p class="card-text">Zur Validierung werden die Punkte aus den Anforderungen (s.o) aufgegriffen.
                Die entwickelte Webanwendung ist in der Lage Bilder, die es von der APOD API anfragt darzustellen.
                Zusätzlich können unterschiedliche Nutzprofile mit eindeutigem Nutznamen angelegt werden.
                Nutzer können außerdem favorisierte Bilder in ihrem Profil speichern.
                Auch kann jede/r Besucher:in der Seite das Foto angezeigt bekommen, das an seinem/ihrem Geburtstag aufgenommen wurde.
                Aus Performanzgründen werden beim Seitenstart nicht wie ursprünglich geplant sieben Bilder (der letzten Woche) angezeigt, sondern lediglich die letzten drei.
                </p>
            </div>
        </div>

        <!-- Card 2 -->
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Verifikation</h4>
                <h5 class="card-subtitle">1. Nutzerverwaltung</h5>
                <p class="card-text">Für die Nutzedaten wird eine einzige SQL Datenbank auf einem Webserver verwendet.
                Existiert ein Nutzername bereits bei der Registrierung in der Datenbank, wird ein Fehler angezeigt.
                Ansonsten wird der Nutzer direkt eingeloggt.
                Das gleiche gilt beim Login: Existiert der angegebene Login, wird der Nutzer eingeloggt, ansonsten wird eine Fehlernachricht angezeigt.
                </p>

                <h5 class="card-subtitle">2. Datenverwaltung</h5>
                <p class="card-text">In einem anderen SQL Table werden die favorisierten Bilder zu einem bestimmten Nutzernamen gespeichert.
                Hierbei werden nicht die Bilddaten selbst gespeichert, sondern lediglich die Daten. So können die Fotos immer wieder von der API angefragt werden.
                </p>

                <h5 class="card-subtitle">2. Optisches Erscheinungsbild</h5>
                <p>Natürlich ist die UI nur schwer objektiv zu beurteilen.
                    Allerdings ist sie responive und die Inhalte werden auch  auf kleinen Smartphone Displays
                    noch adäquat angezeigt. 

                </p>
            </div>
        </div>
    </div>

    <!-- Add Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
