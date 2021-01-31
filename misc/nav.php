<?php

$user;
if(isset($_GET['usertype']))
{
    $user = $_GET['usertype'];
}
else
{
    $user = 0;
}

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
    new NavItem("Bildverwaltung", "index.php?selection=managePhoto", array(false, true, false)),
    new NavItem("Hilfe", "index.php?selection=help", array(true, true, true)),
    new NavItem("Impressum", "index.php?selection=impressum", array(true, true, false)),
    new NavItem("Registrierung", "index.php?selection=register", array(true, false, false)),
    new NavItem("Login", "index.php?selection=login", array(true, false, false)),
    new NavItem("Profilverwaltung", "index.php?selection=manageProfil", array(false, true, false)),
    new NavItem("Userverwaltung", "index.php?selection=manageUser", array(false, false, true)),
    new NavItem("Logout", "index.php?selection=logout", array(false, true, true))
);
?>

<nav class="navbar bg-dark">
    
    <ul class="nav pills">
        
        <?php
        
        $nav_item_tag = "<li class=\"nav-item\">";
        
        foreach ($items as $i)
        {
            if ($i->clearance[$user])
            {
                echo $nav_item_tag,
                "<a href=\"$i->url\">$i->name</a>",
                "</li>";
            }
        }
        
        ?>
    </ul>
</nav>
   