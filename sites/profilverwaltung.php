<?php
$error = false;

if (isset($_POST) && isset($_POST['change'])) {
    $userChange = $_POST;
    if (!(Validator::IsUserNameExists($userChange['username'], $db->getUserNameList($_SESSION["User"]->getUserID())))) { //compare with everything except own entry
        if (!(Validator::IsEmailExists($userChange['email'], $db->getEmailList($_SESSION["User"]->getUserID())))) { //compare with everything except own entry
            if (Validator::IsPasswordMatched($userChange['password'], $userChange['repeatpasswordnew'])) {
                if (Validator::IsPasswordCorrect($userChange['password_old'], $_SESSION["User"]->getPassword())) {
                    if (strlen($userChange['password']) < 1) //if no new password, keep the old one
                        $userChange['password'] = $_SESSION["User"]->getPassword();
                    else
                        $userChange['password'] = password_hash($userChange['password'], PASSWORD_DEFAULT);

                    if (isset($_FILES['profilePic']) && $_FILES['profilePic']['size'] > 0)
                        $userChange['profilePic'] = $fm->upload($_FILES['profilePic'], $_SESSION['User']->getUsername());
                    else
                        $userChange['profilePic'] = $_SESSION['User']->getPic();
                    $db->ChangeUser($userChange);
                    header("Location: index.php");
                    echo "okay";
                } else {
                    $error = 'old password is wrong';
                }
            } else {
                $error = 'new passwords do not match!';
            }
        } else {
            $error = 'E-mail address already exists!';
        }
    } else {
        $error = 'Username already exists!';
    }
}

if ($error || isset($_POST) || !isset($_POST["change"])) {
    include "changedata.php";
    echo "<div class=\"container\"> <h5 class=\"text-danger\">" . $error . "</h5></div>";
}
