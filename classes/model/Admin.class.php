<?php
////-----------------------------------------------------------------------
//// <copyright file="model/Admin.class.php" company="FH Technikum Wien">
//// Copyright (c) FH Technikum Wien. All rights reserved.
//// </copyright>
//// <author>Muhammad Farasat Hussain, Christian Tomuta, Paul</author>
//// <summary>Social network.</summary>
////-----------------------------------------------------------------------


 /// <summary>
 /// Represents the Admin class, which is responsible to manage the whole panal.
 /// </summary>
class Admin extends User 
{
    /// <summary>
    /// This function is used to block the user.
    /// </summary>
    /// <param name="$db">Object of database class.</param>
    /// <param name="$id">User id, who is gonna be blocked.</param>
    public static function ChangeUserStatus($db, $id)
    {
        $db->switchUserState($id);
        echo "state switch executed";
    }
}