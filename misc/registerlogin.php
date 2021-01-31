<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="abschluss.css" />
</head>

<section id="registerlogin">

    <body>
        <?php
        include "navbarabschluss.php";
        ?>
        <header id="anfang">

            <?php
            include "headerabschluss.php";
            ?>
        </header>
        <main>
            <div class="container-fluid">
                <div class="row">

                    <div class="col-xs-12 col-md-8">
                        <?php
                        if (empty($_GET['section'])) {
                            include "registrierung.php";
                        } else if (isset($_GET['section'])) {
                            include "login.php";
                        }
                        ?>


                    </div>
                </div>
            </div>
        </main>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </body>


</section>
</div>