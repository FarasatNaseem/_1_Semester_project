<?php
$error = false;

if (isset($_POST) && isset($_POST['register'])) {
    $userDetails = $_POST;

    if (!(Validator::IsUserNameExists($userDetails['username'], $db->getUserNameList()))) {
        if (!(Validator::IsEmailExists($userDetails['email'], $db->getEmailList()))) {
            if (Validator::IsPasswordMatched($userDetails['password'], $userDetails['repeatpassword'])) {
                $userDetails['password'] = password_hash($userDetails['password'], PASSWORD_DEFAULT);

                $userDetails['profilePic'] = ' ';
                if (isset($_FILES['profilePic']))
                    $userDetails['profilePic'] = $fm->upload($_FILES['profilePic'], $userDetails['username']);
                 else
                    $userDetails['profilePic'] = '';
                $db->InsertUser($userDetails);
                echo "<div class=\"container\"> <h5 class=\"text-danger\"> Registrierung erfolgreich </h5></div>";
            } else {
                $error = 'passwords did not match';
            }
        } else {
            $error = 'email already exists';
        }
    } else {
        $error = 'User name already exists';
    }
}
if ($error || isset($_POST) || !isset($_POST["register"])) {
    include "registerForm.html";
    echo "<div class=\"container\"> <h5 class=\"text-danger\">" . $error . "</h5></div>";
}