<?php

include_once 'database.class.php';
include_once 'classes/user.class.php';

$db = new Database();
$usernames = $db->getUserNameList();

if (!empty($_POST['register']))
 {
    if (!empty( $_POST))
     {
        $userDetails = $_POST;

        $userObj = new User($userDetails);
      
        $emails = $db->getEmailList();

        if(!(Validator::IsUserNameExists($userDetails['uname'], $usernames)))
        {
            if(!(Validator::IsEamilExists($userDetails['email'], $emails)))
            {
                if ( Validator::IsPasswordMatched( $userDetails['password'], $userDetails['repeatpassword'] ) )
                {
                    $userDetails['password'] = password_hash( $userDetails['password'], PASSWORD_DEFAULT );
    
                    $userObj->userData = $userDetails;
        
                    $db->Insert( $userObj->userData );
                }
                else
                {
                    echo 'Invalid password';
                }
            }
            else
            {
                echo 'email already exists';
            }
        }
        else
        {
            echo 'User name already exists';
        }
    }

    header( 'Location: http://localhost/project/index.php?selection=register' );
}
else if (isset( $_POST['login']))
{
    $login = false;

    if (!empty($_POST))
    {
        $userDetails = $db->getUser( $_POST['username'] );

        if((Validator::IsUserNameExists($userDetails['username'], $usernames)))
        {
            if (!Validator::isPasswordCorrect($_POST['pass'], $userDetails['passwort']))
            {
                $login = true;
                session_start();
                $_SESSION['loggedin'] = true;
                $_SESSION['Username'] = $userDetails['username'];

                if (isset($_POST["stay"])) 
                {
                    setcookie("Username", $userDetails['username'], time() + 60 * 10);
                }

                header( 'Location:  http://localhost/project/index.php?selection=Home&usertype='.$userDetails['utype'].'&userID='.$userDetails['uid'].'');
            }
            else
            {
                echo 'Invalid password';
                header( 'Location:  http://localhost/project/index.php?selection=Login' );
            }
            }
            else
            {
                echo 'Invalid Username';
                header( 'Location:  http://localhost/project/index.php?selection=Login' );
            }
         }    
      }
?>