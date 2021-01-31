<?php

    print_r($_GET['logout']);

    session_start();
    session_destroy();
    unset($_SESSION["Username"]);
    setcookie("Username", null, time() + 0);

    $userType = 0;

    header( 'Location:  http://localhost/project/index.php?usertype='.$userType.'');
    exit;

?>