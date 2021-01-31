<?php

session_start();

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true)
{
    header('Location: http://localhost/project/index.php');
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>
<body>
    <h1>Welcome <?php echo $_SESSION['Username']?></h1>
</body>
</html>
