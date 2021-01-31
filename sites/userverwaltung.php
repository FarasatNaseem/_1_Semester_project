<?php
if (!isset($_SESSION["User"]) || $_SESSION["User"]->getAuthorization() != AUTH::ADMIN) {
    echo "<h1> Userverwaltung nur für admins zugänglich </h1>";
    exit;
}

if (isset($_POST)) {

    if (isset($_POST["switchStatus"]))
    {
        Admin::ChangeUserStatus($db, $_POST['id']);
    }

    if (isset($_POST['showPosts']))
    {
        echo '<form method="POST" action="index.php?selection=userverwaltung"> 
        <input type="submit" value="zurück"> 
        </form>';
        foreach ($db->getPostsByUser($_POST['id']) as $post)
        {
            $fp = new FeedPanel($db, $post);
            $fp->display();
        }
    }
}

$uDisplay = new UserDisplay($db->getUserList());
$uDisplay->displayAsTable();