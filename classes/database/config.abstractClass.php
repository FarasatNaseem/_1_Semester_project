<?php
////-----------------------------------------------------------------------
//// <copyright file="Classes/database/config.abstractClass.php" company="FH Technikum Wien">
//// Copyright (c) FH Technikum Wien. All rights reserved.
//// </copyright>
//// <author>Muhammad Farasat Hussain, Christian Tomuta, Paul</author>
//// <summary>Social network.</summary>
////-----------------------------------------------------------------------



 /// <summary>
 /// Represents an abstract class of database configration, which contains four variables. 
 /// </summary>
 /// <variable name="serverName">A constant variable, which defines a host.</variable>
 /// <variable name="databaseName">A constant variable, which is name of a database</variable>
 /// <variable name="username">A constant variable, which is username of a database.</variable>
 /// <variable name="password">A constant variable, which is password of a database.</variable>
abstract class Configration
{
    const serverName = "Localhost";
    const databaseName = "projekt";
    const username = "root";
    const password = "admin123";
}