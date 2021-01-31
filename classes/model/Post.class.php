<?php
////-----------------------------------------------------------------------
//// <copyright file="model/Post.class.php" company="FH Technikum Wien">
//// Copyright (c) FH Technikum Wien. All rights reserved.
//// </copyright>
//// <author>Muhammad Farasat Hussain, Christian Tomuta, Paul</author>
//// <summary>Social network.</summary>
////-----------------------------------------------------------------------


/// <summary>
/// Represents post class.
/// </summary>
class Post
{
    /// <summary>
    /// <prop name="$postID">which is private propertie of this class.</prop>
    /// </summary>
    private int $postID;

    /// <summary>
    /// <prop name="$userID">which is private propertie of this class.</prop>
    /// </summary>
    private int $userID;

    /// <summary>
    /// <prop name="$createdDate">which is private propertie of this class.</prop>
    /// </summary>
    private string $createdDate;

    /// <summary>
    /// <prop name="$imagePath">which is private propertie of this class.</prop>
    /// </summary>
    private string $imagePath;

    /// <summary>
    /// <prop name="$thumbpath">which is private propertie of this class.</prop>
    /// </summary>
    private string $thumbPath;

    /// <summary>
    /// <prop name="$article">which is private propertie of this class.</prop>
    /// </summary>
    private string $article;

    /// <summary>
    /// <prop name="$likes">which is private propertie of this class.</prop>
    /// </summary>
    private array $likes;

    /// <summary>
    /// <prop name="$dislikes">which is private propertie of this class.</prop>
    /// </summary>
    private array $dislikes;

    /// <summary>
    /// <prop name="$privacy">which is private propertie of this class.</prop>
    /// </summary>
    private int $privacy;

    /// <summary>
    /// Initializes private members of the <see cref="Post"/> class.
    /// </summary>
    public function __construct($postID, $userID, $createdDate, $imagePath, $article, $likes, $dislikes, $privacy)
    {
        $this->postID = $postID;
        $this->userID = $userID;
        $this->createdDate = $createdDate;
        $this->imagePath = $imagePath;
        $this->article = $article;
        $this->likes = $likes;
        $this->dislikes = $dislikes;
        $this->privacy = $privacy;

        $this->thumbPath = pathinfo($this->imagePath, PATHINFO_DIRNAME) . "\\thumb.png";
    }

    /// <summary>
    /// Gets the post id.
    /// </summary>
    /// <value>Post id.</value>
    public function getPostID()
    {
        return $this->postID;
    }

    /// <summary>
    /// Gets the user id.
    /// </summary>
    /// <value>User id.</value>
    public function getUserID()
    {
        return $this->userID;
    }

    /// <summary>
    /// Gets the created date.
    /// </summary>
    /// <value>Created date.</value>
    public function getCreatedDate()
    {
        return $this->createdDate;
    }

    /// <summary>
    /// Gets the image path.
    /// </summary>
    /// <value>Image path.</value>
    public function getImagePath()
    {
        return $this->imagePath;
    }

    /// <summary>
    /// Gets the likes.
    /// </summary>
    /// <value>Likes.</value>
    public function getLikes()
    {
        return $this->likes;
    }

    /// <summary>
    /// Gets the dislikes.
    /// </summary>
    /// <value>Dislikes.</value>
    public function getDislikes()
    {
        return $this->dislikes;
    }

    /// <summary>
    /// Gets the privacy of post.
    /// </summary>
    /// <value>Privacy.</value>
    public function getPrivacy()
    {
        return $this->privacy;
    }

    /// <summary>
    /// Gets the User.
    /// </summary>
    /// <value>User object.</value>
    public function getUser(Database $db)
    {
        return $db->getUser($this->userID);
    }

    /// <summary>
    /// Gets the comments.
    /// </summary>
    /// <value>Comment object.</value>
    public function getComments(Database $db)
    {
        return $db->getComments($this->postID);
    }

    /// <summary>
    /// Gets post tags.
    /// </summary>
    /// <value>Tags.</value>
    public function getTags($db)
    {
        return $db->getTags($this->postID);
    }

    /// <summary>
    /// This function is just used to display post.
    /// </summary>
    public function display()
    {
        if (strlen($this->imagePath) > 0)
        {
            echo '<img class="img-thumbnail" 
            onclick="displayModal(\'' . str_replace("\\", "\\\\", $this->imagePath) . '\')"
            src="';
            if (file_exists($this->thumbPath))
                echo $this->thumbPath;
            else
                echo $this->imagePath;
            echo '">';
        }

        echo "<div>$this->article</div>";
    }
}