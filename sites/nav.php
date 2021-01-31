<?php

$auth = isset($_SESSION["User"]) ? $_SESSION["User"]->getAuthorization() : AUTH::ANON;

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
    new NavItem("Home", "index.php?selection=home", array(true, true, true)),
    new NavItem("Post erstellen", "index.php?selection=createPost", array(false, true, true)),
    new NavItem("Hilfe", "index.php?selection=help", array(true, true, true)),
    new NavItem("Impressum", "index.php?selection=impressum", array(true, true, true)),
    new NavItem("Registrierung", "index.php?selection=register", array(true, false, false)),
    new NavItem("Login", "index.php?selection=login", array(true, false, false)),
    new NavItem("Profilverwaltung", "index.php?selection=profilverwaltung", array(false, true, true)),
    new NavItem("Userverwaltung", "index.php?selection=userverwaltung", array(false, false, true)),
    new NavItem("Logout", "index.php?selection=logout", array(false, true, true))
);
?>
<nav class="navbar bg-light">
    <div class="container">
        <div class="navbar-header">
            <?php
            //<img style="height: 10vw;" src=<?php echo '"' . isset($_SESSION["User"]) ? $_SESSION["User"]->getThumb() : '' . '"' 
            if (isset($_SESSION["User"]))
                echo '<img style="height: 10vw;" src="' . $_SESSION["User"]->getThumb() . '">';
            ?>
            <br>
            <a class="navbar-brand" href="#"><?php echo isset($_SESSION["User"]) ? $_SESSION["User"]->getUsername() : "guest" ?></a>
        </div>

        <ul class="nav pills navbar-nav navbar-right">
            <?php
            $nav_item_tag = "<li class=\"nav-item\">";
            foreach ($items as $i) {
                if ($i->clearance[$auth]) {
                    echo $nav_item_tag,
                    "<a class=\"nav-link\" href=\"$i->url\">$i->name</a>",
                    "</li>";
                }
            }
            ?>
        </ul>
    </div>
</nav>