<?php
include_once "classes/model/AUTH.abstractClass.php";
include_once "classes/model/User.class.php";
include_once "classes/model/Comment.class.php";
include_once "classes/model/Post.class.php";
include_once "classes/database/Database.class.php";
include_once "classes/file/FileManager.class.php";
include_once "classes/display/FeedPanel.php";
include_once "classes/display/UserDisplay.class.php";
include_once "classes/model/Admin.class.php";

$db = new Database();
$fm = new FileManager();

if (session_status() != PHP_SESSION_ACTIVE) session_start();

if (isset($_SESSION["User"])) $_SESSION["User"] = $db->getUser($_SESSION["User"]->getUserID()); //keep logged in user up-to-date
else if (isset($_COOKIE["stay"])) $_SESSION["User"] = $db->getUser($_COOKIE["stay"]); //login user if stay cookie set

if ((isset($_SESSION["User"]) && !$_SESSION["User"]->isActive())) {
    include "sites/logout.php";
}

?>
<!Doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>FH Technikum Wien Social Media Platform</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="abschluss.css" />

</head>

<body>
    

    <?php include 'sites/nav.php'; ?>
    
    <header id="anfang">
        
    <?php  include "sites/header.php"; ?>

    </header>
    <main>
        <div class="container" id="divindex">
            <div class="row">
                <?php

                if (isset($_GET['selection'])) {
                    $menu = $_GET['selection'];

                    switch ($menu) {
                        case 'home':
                            include('sites/feed.php');
                            break;
                        case 'register':
                            include('sites/register.php');
                            break;
                        case 'help':
                            include('sites/help.html');
                            break;
                        case 'login':
                            include('sites/login.php');
                            break;
                        case 'logout':
                            include('sites/logout.php');
                            break;
                        case 'profilverwaltung':
                            include('sites/profilverwaltung.php');
                            break;
                        case 'createPost':
                            include 'sites/createPost.php';
                            break;
                        case 'userverwaltung':
                            include 'sites/userverwaltung.php';
                            break;
                        case 'updatepost':
                            include 'updatepost.php';
                            break;
                        case 'impressum':
                            include 'sites/impressum.html';
                            break;
                        default:
                            include('sites/feed.php');
                            break;
                    }
                } else {
                    include('sites/feed.php');
                }
                ?>
            </div>
        </div>
        </div>
    </main>

    <!-- modal (mostly copied from https://www.w3schools.com/howto/howto_css_modal_images.asp) -->
    <div id="myModal" onclick="document.getElementById('myModal').style.display='none'" class="modal">
        <span class="close">&times;</span>
        <img class="modal-content" id="modalImg" src="img/like.jpg">

        <div id="caption">click again to close</div>
    </div>
    <script>
        function displayModal(source = '') {
            document.getElementById('myModal').style.display = 'block';
            document.getElementById('modalImg').src = source;
        }
    </script>
</body>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>

</html>
