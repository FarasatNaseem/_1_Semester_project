<?php
////-----------------------------------------------------------------------
//// <copyright file="display/FeedPanel.php" company="FH Technikum Wien">
//// Copyright (c) FH Technikum Wien. All rights reserved.
//// </copyright>
//// <author>Muhammad Farasat Hussain, Christian Tomuta, Paul</author>
//// <summary>Social network.</summary>
////-----------------------------------------------------------------------

/// <summary>
/// Represents the feed panel class, which is responsible to display everything.
/// </summary>
class FeedPanel
{
    /// <summary>
    /// <prop name="$post">which is private propertie of this class, whose data type is "Post".</prop>
    /// </summary>
    private Post $post;

    /// <summary>
    /// <prop name="$user">which is private propertie of this class, whose data type is "User".</prop>
    /// </summary>
    private User $user;

    /// <summary>
    /// <prop name="$comments">A private array, which contains all comments of a post.</prop>
    /// </summary>
    private array $comments;

    /// <summary>
    /// <prop name="$tags">A private array, which contains all tags of a post.</prop>
    /// </summary>
    private array $tags;

    /// <summary>
    /// Initializes private members of the <see cref="FeedPanel"/> class.
    /// </summary>
    public function __construct(Database $db, Post $post)
    {
        $this->post = $post;
        if ($this->post != null) {
            $this->user = $db->getUser($this->post->getUserID());
            $this->comments = $db->getComments($this->post->getPostID());
            $this->tags = $db->getTags($post->getPostID()); // added
        }
    }

    /// <summary>
    /// Printing all comments.
    /// </summary>
    /// <param name="$comments">An array of comments.</param>
    private function printComments($comments)
    {
        foreach ($comments as $comment)
        {
            $comment->display();
        }
    }

    /// <summary>
    /// Printing all tags.
    /// </summary>
    /// <param name="$tags">An array of tags.</param>
    private function printTags($tags)
    {
        $length = 0;

        if($tags != NULL)
        {
            $length = count($tags);
        }
       
        if($length > 0)
        {
            echo "<h6> tags: ";
            foreach ($tags as $tag)
            {
                echo "#$tag";
            }
            echo "</h6>";
        }
    }

    /// <summary>
    /// Printing post author name.
    /// </summary>
    /// <param name="$name">Author name.</param>
    private function printAuthor($name)
    {
       echo '<div class="center"> Posted by '.$name.'</h4></div> <br>';
    }

    /// <summary>
    /// Printing likes of post.
    /// </summary>
    /// <param name="$likes">An array of user likes.</param>
    private function printLike($likes)
    {
        $likesAmount = 0;

        foreach ($likes as $like)
        {
            $likesAmount++;
        }

        echo  $likesAmount;
        echo " ";
    }

    /// <summary>
    /// Printing dislike of post.
    /// </summary>
    /// <param name="$dislikes">An array of user dislikes.</param>
    private function printDislike($disikes)
    {
        $dislikesAmount = 0;

        foreach ($disikes as $dislike)
        {
            $dislikesAmount++;
        }
        echo " ";
        echo  $dislikesAmount;
        echo " ";
    }

    /// <summary>
    /// This function is used to display all posts along likes, dislikes, tags and comments of users.
    /// </summary>
    public function display()
    {
        $db = new Database();

        if (!isset($_SESSION['User']))
        {
            if (Validator::isPublic($this->post->getPrivacy()))
            {
                echo '<section id="postbox">';

                echo '<div class="container" id="innen">';
                
                echo '<div class="row justify-content-center">';
                
                echo '<div class="col-xs-7 col-sm-3 col-lg-4">';
                
                echo '<div class="card" style="width: 34rem;">';
                
                echo '<div class="card">
            <header class="card-header">
                <h4 class="card-title mt-2">';

                $this->printAuthor($this->user->getUsername());
                
                $this->post->display();
                
                echo "<h6>" . $this->post->getCreatedDate() . "</h6>";

                $this->printTags($this->tags);

                $this->printComments($this->comments);
              
                echo "<h4>";
                echo "Likes ";
                $this->printLike($this->post->getLikes());

                echo "Dislikes ";
                $this->printDislike($this->post->getDislikes());
                echo "</h4>";
            }
        }
        //  echo '</div> ';
        //  echo '</div> ';
        echo '</div> </div> </div> </div>';
        echo '</section>';

        if (isset($_SESSION['User']))
        {
            echo '<section id="postbox">';
            echo '<div class="container" id="innen">';
            echo '<div class="row justify-content-center">';
            echo '<div class="col-xs-7 col-sm-3 col-lg-4">';
            echo '<div class="card" style="width: 34rem;">';
            echo '<div class="card">
            <header class="card-header">
                <h4 class="card-title mt-2">';
              
                $this->printAuthor($this->user->getUsername());
                
                $this->post->display();
                
                echo "<h6> " . $this->post->getCreatedDate() . "</h6>";

                $this->printTags($this->tags);

                $this->printComments($this->comments);

            echo ' <div class="btn-group"> ';
                 
            User::Comment($_SESSION['User']->getUserID(), $this->post->getPostID(), $db);

            $this->printLike($this->post->getLikes());
            
            User::Like($_SESSION['User']->getUserID(), $this->post->getPostID(), $db);
            
            $this->printDislike($this->post->getDislikes());
          
            User::Dislike($_SESSION['User']->getUserID(), $this->post->getPostID(), $db);

            echo '</div>';

            if (isset($_SESSION['User']))
            {
                if(Validator::isPersonal($_SESSION['User']->getUserID(), $this->post->getUserID()))
                {
                    echo '<div class="btn-group">';
                   
                    User::DeletePost($_SESSION['User']->getUserID(), $this->post->getPostID(), $db);
                   
                    User::Update($_SESSION['User']->getUserID(), $this->post->getPostID());

                    User::Share($_SESSION['User']->getUserID(), $this->post->getPostID(), $this->post->getPrivacy(), $db);
                }
                else if(Validator::isAdmin($_SESSION['User']->getAuthorization()))
                {
                    echo '<div class="btn-group">';
                   
                    Admin::DeletePost($_SESSION['User']->getUserID(), $this->post->getPostID(), $db);
                   
                    Admin::Update($_SESSION['User']->getUserID(), $this->post->getPostID());

                    Admin::Share($_SESSION['User']->getUserID(), $this->post->getPostID(), $this->post->getPrivacy(), $db);
                }
            }
            echo '</div> </div>';
            echo '</div> </div> </div> </div>';
            echo '</section>';
        }
    }
}