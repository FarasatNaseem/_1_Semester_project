<head>
    <link rel="stylesheet" type="text/css" href="abschluss.css" />
</head>
<section id="register">
    <div class="container" id="innen">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <header class="card-header">
                        <h4 class="card-title mt-2"><div class = "center">Sign up</div></h4>
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
                                    <input type="text" name="first_name" class="form-control" placeholder="Max">
                                </div> <!-- form-group end.// -->
                                <div class="col form-group">
                                    <label>Nachname</label>
                                    <input type="text" name="last_name" class="form-control" placeholder="Mustermann">
                                </div> <!-- form-group end.// -->
                            </div> <!-- form-row end.// -->
                            <div class="form-group">
                                <label>Email-Adresse</label>
                                <input type="email" name="email" class="form-control" placeholder="max.mustermann@gmx.at">
                                <small class="form-text text-muted">We'll never share your email with anyone else.</small>
                            </div> <!-- form-group end.// -->
                            <div class="form-row">
                                <div class="col form-group">
                                    <label>Create password</label>
                                    <input class="form-control" name="password" type="password">
                                </div> <!-- form-group end.// -->
                                <div class="col form-group">
                                    <label>Username</label>
                                    <input type="text" class="form-control"  name="username" placeholder="max1234">
                                </div> <!-- form-group end.// -->
                            </div> <!-- form-row end.// -->

                            <div class="col-md-6">
                            <div class="form-group">
                                <button type="submit" name="reg" class="btn btn-primary btn-block"> Register </button>
                            </div> <!-- form-group// -->
                            </div>

                        </form>
                    </article> <!-- card-body end .// -->
                    <div class="border-top card-body text-center">Du hast schon einen Account bei uns? <a href="registerlogin.php?section=login">Einloggen</a></div>
                </div> <!-- card.// -->
            </div> <!-- col.//-->

        </div> <!-- row.//-->


    </div>
</section>
<!--container end.//-->