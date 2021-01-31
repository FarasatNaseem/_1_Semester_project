<head>
    <link rel="stylesheet" type="text/css" href="abschluss.css" />
</head>
<section id="changedata">
    <div class="container" id="innen">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <header class="card-header">
                        <h4 class="card-title mt-2">
                            <div class="center">Update</div>
                        </h4>
                    </header>
                    <article class="card-body">
                        <form action="index.php?selection=profilverwaltung" method="POST" enctype="multipart/form-data">
                            <div class="form-row">
                                <div class="col form-group">
                                    <label>neues Profilbild </label>
                                    <br>
                                    <input type="file" name="profilePic" class="form-control">
                                    </select>
                                </div>
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
                                        <input type="text" name="first_name" class="form-control" value=<?php echo $_SESSION["User"]->getFirstName(); ?>>
                                    </div> <!-- form-group end.// -->
                                    <div class="col form-group">
                                        <label>Nachname</label>
                                        <input type="text" name="last_name" class="form-control" value=<?php echo $_SESSION["User"]->getLastName(); ?>>
                                    </div> <!-- form-group end.// -->
                                </div> <!-- form-row end.// -->
                                <div class="form-group">
                                    <label>Email-Adresse</label>
                                    <input type="email" name="email" required class="form-control" value=<?php echo $_SESSION["User"]->getEMail(); ?>>
                                    <small class="form-text text-muted">We'll never share your email with anyone else.</small>
                                </div> <!-- form-group end.// -->
                                <div class="form-row">
                                    <div class="col form-group">
                                        <label>Old password</label>
                                        <input class="form-control" name="password_old" required type="password">
                                    </div> <!-- form-group end.// -->
                                    <div class="col form-group">
                                        <label>New password</label>
                                        <input class="form-control" name="password" type="password">
                                    </div> <!-- form-group end.// -->
                                    <div class="col form-group">
                                        <label>Repeat new password</label>
                                        <input class="form-control" name="repeatpasswordnew" type="password">
                                    </div> <!-- form-group end.// -->
                                    <div class="col form-group">
                                        <label>Username</label>
                                        <input type="text" class="form-control" name="username" required value=<?php echo $_SESSION["User"]->getUserName(); ?>>
                                    </div> <!-- form-group end.// -->
                                </div> <!-- form-row end.// -->

                                <input type="hidden" name="authorization" value="1">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <button type="submit" name="change" class="btn btn-primary btn-block"> Update </button>
                                    </div> <!-- form-group// -->
                                </div>

                        </form>
                    </article> <!-- card-body end .// -->
                    <div class="border-top card-body text-center">Du hast schon einen Account bei uns? <a href="index.php?selection=login">Einloggen</a></div>
                </div> <!-- card.// -->
            </div> <!-- col.//-->

        </div> <!-- row.//-->


    </div>
</section>
<!--container end.//-->
