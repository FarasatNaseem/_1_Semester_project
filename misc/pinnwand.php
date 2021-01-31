<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>FH Technikum Wien Social Media Platform</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

</head>
<section id="pinnwand">

  <body>
    <?php
    include "navbarabschluss.php";
    ?>
    <header id="anfang">

      <?php
      include "headerabschluss.php";
      ?>

    </header>
    <main id="pinn">
      <div class="container">
      <div class="center"><h4>USER hat einen neuen Beitrag hinzugefügt:</h4>
        <div class="row justify-content-between">
          <div class="col">
          
          <?php
        
            if (!empty($_REQUEST["posting"])) {
              echo $_REQUEST["posting"];
              echo '<br>';
              echo '<img src="like.jpg" style="width:25px;height:25px;">';
              echo '&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;'; 
              echo '<img src="dislike.jpg" style="width:25px;height:25px;">';
              echo '&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;';
              echo '<button class="button_comment" type="submit" class="btn btn-primary btn-block"> Comment </button>';
            }
            else if (!empty($_REQUEST["fileToUpload"])) {
              echo '<img src="schlafzimmer.jpg" style="width:250px;height:250px;">';
              echo '<br>';
              echo '<br>';
              echo '<img src="like.jpg" style="width:25px;height:25px;">';
              echo '&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;'; 
              echo '<img src="dislike.jpg" style="width:25px;height:25px;">';
              echo '&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;';
              echo '<button class="button_comment" type="submit" class="btn btn-primary btn-block"> Comment </button>';
            }
            ?>
            </div>
          </div>
        </div>
      </div>
    </main>
  </body>
</section>