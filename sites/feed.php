<?php

include "sites/searchForm.html";

if (isset($_POST) && isset($_POST['search']))
    $posts = $db->getPostList(10, 0, $_POST['search'], Validator::explodeTags($_POST['tags'], ','), $_POST['order']);
else
    $posts = $db->getPostList();

foreach ($posts as $post)
{
    $fp = new FeedPanel($db, $post);
    $fp->display();
}