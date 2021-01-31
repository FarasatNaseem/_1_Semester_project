<?php

if(!isset($_SESSION['User']))
{
 header('Location: index.php');
}
else{
    include_once 'classes/database/Database.class.php';
    if(isset($_GET['postid']) && isset($_GET['userid']))
    {
        $db = new Database();
    
        $data = $_GET;
        $length = 0;
        $postData = $db->getPostDataByID($data['postid']);
        $tags = $db->getTags($data['postid']);
    
       if($tags != NULL)
       {
          $length = count($tags);
       }
       
        $db->deleteTag($data['postid']);
        
      if(isset($_POST) && isset($_POST["updatepost"]))
      {
          User::UpdatePost($fm, $db, $postData);
      }
    }
}


?>
<head>
    <link rel="stylesheet" type="text/css" href="abschluss.css" />
</head>
<section id="register">
    <div class="container" id="innen">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <header class="card-header">
                        <h4 class="card-title mt-2">
                            <div class="center">Update Post</div>
                        </h4>
                    </header>
                    <article class="card-body">
                        <form action="index.php?selection=updatepost&userid=<?php echo $data['userid']; ?>&postid=<?php echo $data['postid']; ?>" method="POST" enctype="multipart/form-data">
                            <div class="form-row">
                                <div class="col form-group">
                                    <label>Bild </label>
                                    <input type="file" name="file" class="form-control" > 
                                </div> <!-- form-group end.// -->
                            </div> <!-- form-row end.// -->
                            <div class="form-row">
                                <div class="col form-group">
                                    <label>Text</label><br>
                                    <textarea name="text" rows="4" cols="50"  >
                                    <?php
                                    if($postData != NULL)
                                    {
                                        echo $postData['article']; 
                                    }
                                    ?>
                                    </textarea>
                                </div> <!-- form-group end.// -->
                            </div> <!-- form-row end.// -->
                            <div class="form-row">
                                <div class="col form-group">
                                    <label>Tags (comma ',' sparated)</label><br>
                                    <textarea name="tags" rows="2" cols="50">
                                        <?php
                                        for ($i=0; $i < $length; $i++)
                                        { 
                                            if($i < $length - 1)
                                            {
                                                echo $tags[$i] .",";
                                            }
                                            else
                                            {
                                                echo $tags[$i];
                                            }
                                        }
                                        ?>
                                    </textarea>
                                </div> <!-- form-group end.// -->
                            </div> <!-- form-row end.// -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <button type="submit" name="updatepost" class="btn btn-primary btn-block"> Update
                                    </button>
                                </div> <!-- form-group// -->
                            </div>

                        </form>
                    </article> <!-- card-body end .// -->
                </div> <!-- card.// -->
            </div> <!-- col.//-->

        </div> <!-- row.//-->


    </div>
</section>
<!--container end.//-->
