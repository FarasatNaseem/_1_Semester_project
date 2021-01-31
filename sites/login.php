<?php
$error = false;

if (isset($_POST) && isset($_POST['login']))
{
    $registeredUsernames = $db->getUserNameList();

    if($registeredUsernames != NULL)
    {
        if(Validator::IsUserNameExists($_POST['username'], $registeredUsernames))
        {
            $user = $db->getUserByName($_POST['username']);
     
             if (Validator::isPasswordCorrect($_POST['password'], $user->getPassword()))
             {
                 if ($user->isActive())
                 {
                     $_SESSION['User'] = $user;

                     if (isset($_POST["stay"]))
                     {
                         setcookie("stay", $user->getUserID(), time() + 60 * 10);
                     }
     
                    header('Location:  index.php?selection=home&userid='.$user->getUserID().'');
                 } 
                 else
                 {
                     $error = 'account inactive';
                 }
             }
             else
             {
                 $error = 'Invalid password';
             }
         } 
         else
         {
             $error = 'Invalid Username';
         }
    }
    else
    {
        $error = "Invalid data";
    }
}

if ($error || !isset($_POST) || !isset($_POST["register"]))
{
    include "sites/loginForm.html";
    echo "<div class=\"container\"> <h5 class=\"text-danger\">" . $error . "</h5></div>";
}
