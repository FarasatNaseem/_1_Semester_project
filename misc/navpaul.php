<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="abschluss.css" />
</head>
<?php
//user types {0: anon, 1: user, 2: admin}
//this should probably be an enum, but php doesn't have that feature
$user = 0;

class NavItem
{
    public string $name;
    public string $url;
    public array $clearance; //boolean array determining visibility for user types

    function __construct(string $name, string $url, array $clearance)
    {
        $this->name = $name;
        $this->url = $url;
        $this->clearance = $clearance;
    }
}

$items = array(
    new NavItem("Home", "indexabschluss.php", array(true, true, true)),
    new NavItem("Bildverwaltung", "#", array(false, true, false)),
    new NavItem("Hilfe", "#", array(true, true, true)),
    new NavItem("Impressum", "#", array(true, true, false)),
    new NavItem("Registrierung", "registerlogin.php", array(true, false, false)),
    new NavItem("Login", "registerlogin.php", array(true, false, false)),
    new NavItem("Profilverwaltung", "#", array(false, true, false)),
    new NavItem("Userverwaltung", "mng_user.php", array(false, false, true)),
    new NavItem("Logout", "#", array(false, true, true))
);
?>

<nav class="navbar bg-dark">

    <div class="container-fluid">

        <ul class="nav pills navbar-nav navbar-right">
            <?php
            $nav_item_tag = "<li class=\"nav-item\">";
            foreach ($items as $i) {
                if ($i->clearance[$user])
                    echo $nav_item_tag,
                        "<a href=\"$i->url\">$i->name</a>",
                        "</li>";
            }
            ?>
        </ul>
    </div>
</nav>

<!--
<nav class="navbar bg-dark">
    <ul class="nav pills">
        <li class="nav-item bg-light rounded-pill">
            <a class="nav-link" href="indexabschluss.php">Home</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="pinnwand.php">Pinnwand</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Home</a>
        </li>
    </ul>
</nav>
    -->