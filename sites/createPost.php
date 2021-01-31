<?php
if (isset($_POST) && isset($_POST["createPost"]))
{
    User::UploadPost($fm, $db);
}

if (!isset($_POST) || true)
{
    include "postForm.html";
}