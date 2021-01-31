<?php
////-----------------------------------------------------------------------
//// <copyright file="model/AUTH.abstractClass.php" company="FH Technikum Wien">
//// Copyright (c) FH Technikum Wien. All rights reserved.
//// </copyright>
//// <author>Muhammad Farasat Hussain, Christian Tomuta, Paul</author>
//// <summary>Social network.</summary>
////-----------------------------------------------------------------------


/// <summary>
 /// Represents an abstract class of user authorization, which contains four variables. 
 /// </summary>
 /// <variable name="ANON">A constant variable, which indicates a Guest of the website.</variable>
 /// <variable name="USER">A constant variable, which indicates a registered user of the website.</variable>
 /// <variable name="ADMIN">A constant variable, which indicates the admin of the website.</variable>
abstract class AUTH
{
    const ANON = 0;
    const USER = 1;
    const ADMIN = 2;
}