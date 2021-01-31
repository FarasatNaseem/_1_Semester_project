<?php
////-----------------------------------------------------------------------
//// <copyright file="Classes/database/Validator.class.php" company="FH Technikum Wien">
//// Copyright (c) FH Technikum Wien. All rights reserved.
//// </copyright>
//// <author>Muhammad Farasat Hussain, Christian Tomuta, Paul</author>
//// <summary>Social network.</summary>
////-----------------------------------------------------------------------


 /// <summary>
 /// Represents the validator class, which is responsible to validate everything.
 /// </summary>
class Validator
{
    /// <summary>
    /// This function is used replace a "," with "" from post tag.
    /// </summary>
    /// <param name="$delimiter">???????????????????.</param>
    /// <param name="$tagstring">The table name of the database.</param>
    /// <returns>Either tag with no "," / false if there is no tag in post.</returns>
    public static function explodeTags($tagstring, $delimiter)
    {
        if (strlen($tagstring) > 0)
            return explode($delimiter, str_replace(' ', '', $tagstring));
        else
            return false;
    }

    /// <summary>
    /// This function is just checking, weather a given username exists in the the user table.
    /// </summary>
    /// <param name="$username">A username, which existens is need to check.</param>
    /// <param name="$registeredUserNames">An array of all usernames, which are already in the user table.</param>
    /// <returns>Either true / false.</returns>
    public static function IsUserNameExists($username, $registeredUserNames)
    {
        $nameList = array();

        if($registeredUserNames != NULL)
        {
            $arrayLength = count($registeredUserNames);

            for ($i=0; $i < $arrayLength; $i++)
            { 
                $nameList[$i] = $registeredUserNames[$i]['username'];
            }
    
            for ($i=0; $i < $arrayLength; $i++)
            { 
                if($username == $nameList[$i])
                {
                    return true;
                }
            }
        }

        return false;
    }

    /// <summary>
    /// This function is just checking, weather a given email address exists in the the user table.
    /// </summary>
    /// <param name="$email">A email address, which existens is need to check.</param>
    /// <param name="$registeredUserNames">An array of all email addresses, which are already in the user table.</param>
    /// <returns>Either true / false.</returns>
    public static function IsEmailExists($email, $registeredEmails)
    {
        $emailList = array();

        if($registeredEmails != NULL)
        {
            $arrayLength = count($registeredEmails);

            for ($i=0; $i < $arrayLength; $i++)
            { 
                $emailList[$i] = $registeredEmails[$i]['email'];
            }
    
            for ($i=0; $i < $arrayLength; $i++)
            { 
                if($email == $emailList[$i])
                {
                    return true;
                }
            }
        }

        return false;
    }

    /// <summary>
    /// This function is just checking, weather a current given password is matched with the old password.
    /// </summary>
    /// <param name="$password">A password, which is given by the user at the time of login.</param>
    /// <param name="$correctPassword">A password, which was given by the user at the time of registration.</param>
    /// <returns>Either true / false.</returns>
    public static function isPasswordCorrect($password, $correctPassword)
    {
        if(password_verify($password, $correctPassword))
        {
            return true;
        }

        return false;
    }

    /// <summary>
    /// This function is just checking, weather a both passwords are matched or not.
    /// </summary>
    /// <param name="$password">A password, which is given by the user for the first time.</param>
    /// <param name="$repeatPassword">A password, which must be like the password, which is already given for the first time.</param>
    /// <returns>Either true / false.</returns>
    public static function IsPasswordMatched($password, $repeatPassowrd)
    {
        if($password == $repeatPassowrd)
        {
            return true;
        }

        return false;
    }

    /// <summary>
    /// This function is just checking, weather a user already liked the post or not.
    /// </summary>
    /// <param name="$pid">A post id, which is going to be liked by user.</param>
    /// <param name="$uid">A user id, who wants to like the post.</param>
    /// <param name="$userids">An array of all user ids, who liked the post.</param>
    /// <param name="$postids">An array of all post ids, which are liked by users.</param>
    /// <returns>Either true / false.</returns>
    public static function isLiked($pid , $uid, $userids, $postids)
    {
        $ulength = 0;

        if($userids != NULL)
            $ulength = count($userids);
        if($postids != NULL)
            $plength = count($postids);
        
        for ($i=0; $i < $ulength; $i++) 
        { 
           if($uid == $userids[$i]['user_id'])
           {
             for ($j=0; $j < $plength; $j++) 
             { 
                if($pid == $postids[$j]['post_id'])
                {
                    return true;
                }
             }
          }
        }
    
        return false;
    }

    /// <summary>
    /// This function is just checking, weather a user already disliked the post or not.
    /// </summary>
    /// <param name="$pid">A post id, which is going to be disliked by user.</param>
    /// <param name="$uid">A user id, who wants to disliked the post.</param>
    /// <param name="$userids">An array of all user ids, who disliked the post.</param>
    /// <param name="$postids">An array of all post ids, which are disliked by users.</param>
    /// <returns>Either true / false.</returns>
    public static function isDisliked($pid , $uid, $userids, $postids)
    {
        $ulength = 0;
        
        if($userids != NULL)
            $ulength = count($userids);
        if($postids != NULL)
            $plength = count($postids);
        
        for ($i=0; $i < $ulength; $i++) 
        { 
           if($uid == $userids[$i]['user_id'])
           {
             for ($j=0; $j < $plength; $j++) 
             { 
                if($pid == $postids[$j]['post_id'])
                {
                    return true;
                }
             }
           }
        }
    
        return false;
    }

    /// <summary>
    /// This function is just checking, weather a post belongs to a logged in user.
    /// </summary>
    /// <param name="$userid">logged in user id.</param>
    /// <param name="$postUserid">User id, who uploaded the post.</param>
    /// <returns>Either true / false.</returns>
    public static function isPersonal($userid, $postUserid)
    {
        if($userid == $postUserid)
        {
            return true;
        }

        return false;
    }

    /// <summary>
    /// This function is just checking, weather a logged in person is admin or not.
    /// </summary>
    /// <param name="$authorization">Admin indentity.</param>
    /// <returns>Either true / false.</returns>
    public static function isAdmin($authorization)
    {
        if($authorization == 2)
        {
            return true;
        }

        return false;
    }

    /// <summary>
    /// This function is just checking, weather a post is shared in public or not.
    /// </summary>
    /// <param name="$privacy">Post shared type.</param>
    /// <returns>Either true / false.</returns>
    public static function isPublic($privacy)
    {
        if($privacy == 1)
        {
            return true;
        }

        return false;
    }

    /// <summary>
    /// This function is just checking, weather a post is shared in private or not.
    /// </summary>
    /// <param name="$privacy">Post shared type.</param>
    /// <returns>Either true / false.</returns>
    public static function isPrivate($privacy)
    {
        if($privacy == 0)
        {
            return true;
        }

        return false;
    }
}