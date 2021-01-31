<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="abschluss.css" />
</head>

<?php
include "navbarabschluss.php";
?>
<header id="anfang">

    <?php
    include "headerabschluss.php";
    ?>
</header>
<section id="update">
    <div class="container" id="innen">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <header class="card-header">
                        <h4 class="card-title mt-2">
                            <div class="center">Ändere hier deine Daten</div>
                        </h4>
                    </header>
                    <article class="card-body">
                        <form action="daten.php" method="GET">
                            <div class="form-row">
                                <div class="col form-group">
                                    <label>Anrede </label>
                                    <br>
                                    <select id="anrede" name="salutation">
                                        <option value="male">männlich</option>
                                        <option value="female">weiblich</option>
                                    </select>
                                </div> <!-- form-group end.// -->
                            </div>
                            <div class="form-row">
                                <div class="col form-group">
                                    <label>Vorname </label>
                                    <input type="text" value="<?php echo ($_REQUEST['first_name']); ?>" name="first_name" class="form-control" placeholder="Max">
                                </div> <!-- form-group end.// -->
                                <div class="col form-group">
                                    <label>Nachname</label>
                                    <input type="text" value="<?php echo ($_REQUEST['last_name']); ?>" name="last_name" class="form-control" placeholder="Mustermann">
                                </div> <!-- form-group end.// -->
                            </div> <!-- form-row end.// -->
                            <div class="form-group">
                                <label>Email-Adresse</label>
                                <input type="email" value="<?php echo ($_REQUEST['email']); ?>" name="email" class="form-control" placeholder="max.mustermann@gmx.at">

                            </div> <!-- form-group end.// -->
                            <div class="form-row">
                                <div class="col form-group">
                                    <label>Create password</label>
                                    <input class="form-control" value="<?php echo ($_REQUEST['password']); ?>" name="password" type="password">
                                </div> <!-- form-group end.// -->
                                <div class="col form-group">
                                    <label>Username</label>
                                    <input type="text" class="form-control" value="<?php echo ($_REQUEST['username']); ?>" name="username" placeholder="max1234">
                                </div> <!-- form-group end.// -->
                            </div> <!-- form-row end.// -->

                            <div class="col-md-6">
                                <div class="form-group">
                                    <button type="submit" name="reg" class="btn btn-primary btn-block"> Update </button>
                                </div> <!-- form-group// -->
                            </div>

                        </form>
                    </article> <!-- card-body end .// -->
                    <!-- card.// -->
                </div> <!-- col.//-->

            </div> <!-- row.//-->


        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
</section>;