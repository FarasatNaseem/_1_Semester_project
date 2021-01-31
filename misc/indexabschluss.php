<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>FH Technikum Wien Social Media Platform</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

</head>

<body>
  <?php
  include "navpaul.php";
  ?>
  <header id="anfang">

    <?php
    include "headerabschluss.php";
    ?>

  </header>

  <main>
    <div class="container-fluid">
      <div class="row">
        <div class="form-row">
          <div class="col-xs-6 col-md-4" id="links"><img src="cvphoto.jpg" alt="..." width="127" height="200">
            <br>
            Wilkommen! Du bist eingeloggt / registriert als Admin / User!
            <br><br>
            <div class="col-md-6">
              <div class=button_comment><button type="submit" class="btn btn-primary btn-block"> Logout </button></div>
            </div>
          </div>
        </div>
        <div class="col-xs-12 col-md-8">

          <?php include "schreibetwas.php"; ?></div>

      </div>
    </div>
  </main>
</body>




<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>

</html>