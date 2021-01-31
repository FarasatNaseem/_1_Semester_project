<head>
    <link rel="stylesheet" type="text/css" href="abschluss.css" />
</head>
<section id="formular">
    <div class="container" id="innen">
        <div class="center">
            <div class="d-flex justify-content-center">
                <div class="col-md-6">
                    <div class="card">
                        <header class="card-header">
                            <h4 class="card-title mt-2">Schreib etwas oder lade ein Foto hoch</h4>
                        </header>
                        <article class="card-body">
                            <form action="pinnwand.php" method="get" enctype="multipart/form-data">
                                <div class="form-row">
                                    <div class="col form-group">

                                        <input type="text" name="posting" id="posting" class="form-control" style="height: 300px;" placeholder="Was liegt dir am Herzen?">
                                    </div> <!-- form-group end.// -->
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-block"> An deine Pinnwand posten </button>
                                    </div> <!-- form-group// -->
                                    <div class="col form-group">
                                        <label>Fotoupload</label>
                                        <input type="file" name="fileToUpload" id="fileToUpload">
                                    </div> <!-- form-group end.// -->
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-block"> Foto auf deine Pinnwand uploaden </button>
                                    </div> <!-- form-group end.// -->
                                </div> <!-- form-row end.// -->
                            </form>
                        </article>
                    </div>
                </div>

            </div>
        </div>
    </div>


</section>