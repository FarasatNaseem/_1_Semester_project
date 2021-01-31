<?php
////-----------------------------------------------------------------------
//// <copyright file="display/UserDisplay.class.php" company="FH Technikum Wien">
//// Copyright (c) FH Technikum Wien. All rights reserved.
//// </copyright>
//// <author>Muhammad Farasat Hussain, Christian Tomuta, Paul</author>
//// <summary>Social network.</summary>
////-----------------------------------------------------------------------

 /// <summary>
 /// Represents the UserDisplay class.
 /// </summary>
class UserDisplay
{
    /// <summary>
     /// <prop name="$users">A public array of user data.</prop>
     /// </summary>
    public array $users;

    /// <summary>
    /// Initializes public members of the <see cref="UserDisplay"/> class.
    /// </summary>
    function __construct(array $users)
    {
        $this->users = $users;
    }

    /// <summary>
    /// displays all userdata as required for user administration
    /// </summary>
    function displayAsTable()
    {
        echo "<table class=\"table\">
        <thead>
            <tr>
                <th scope=\"col\">ID</th>
                <th scope=\"col\">Anrede</th>
                <th scope=\"col\">Vorname</th>
                <th scope=\"col\">Nachname</th>
                <th scope=\"col\">Username</th>
                <!--th scope=\"col\">Passwort</th-->
                <th scope=\"col\">Email</th>
                <th scope=\"col\">Status</th>
                <th scope=\"col\"></th>
            </tr>
        </thead>
        <tbody>";
        foreach ($this->users as $user) {
            echo "<tr> <th scopr\"row\">" . $user->getUserID() . "</th>
            <td>" . $user->getSalutation() . "</td>
            <td>" . $user->getFirstName() . "</td>
            <td>" . $user->getLastName() . "</td>
            <td>" . $user->getUsername() . "</td>
            <!--td>" . $user->getPassword() . "</td-->
            <td>" . $user->getEmail() . "</td>
            <td>" . ($user->isActive() ? "active" : "inactive") . "</td>
            <td> <form method=\"POST\" action=\"index.php?selection=userverwaltung\"> 
            <input type=\"hidden\" name=\"id\" value=\"" . $user->getUserID() . "\">
                <input type=\"submit\" name=\"switchStatus\" value=\"switch status\"> </form> </td>

            <td><form method=\"POST\" action=\"index.php?selection=userverwaltung\"> 
            <input type=\"hidden\" name=\"id\" value=\"" . $user->getUserID() . "\">
                <input type=\"submit\" name=\"showPosts\" value=\"show posts\"> </form> </td>
            ";
        }
        echo "</tbody>";
    }
}