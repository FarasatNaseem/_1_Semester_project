<?php
////-----------------------------------------------------------------------
//// <copyright file="model/Comment.class.php" company="FH Technikum Wien">
//// Copyright (c) FH Technikum Wien. All rights reserved.
//// </copyright>
//// <author>Muhammad Farasat Hussain, Christian Tomuta, Paul</author>
//// <summary>Social network.</summary>
////-----------------------------------------------------------------------


/// <summary>
/// Represents comment class.
/// </summary>
class Comment
{
     /// <summary>
     /// <prop name="$commentID">which is private propertie of this class.</prop>
     /// </summary>
    private int $commentID;

     /// <summary>
     /// <prop name="$post_id">which is private propertie of this class.</prop>
     /// </summary>
    private int $post_id;

     /// <summary>
     /// <prop name="$user_id">which is private propertie of this class.</prop>
     /// </summary>
    private int $user_id;

     /// <summary>
     /// <prop name="$text">which is private propertie of this class.</prop>
     /// </summary>
    private string $text;

     /// <summary>
     /// <prop name="$timestamp">which is private propertie of this class.</prop>
     /// </summary>
    private string $timestamp; 

     /// <summary>
     /// <prop name="$username">which is private propertie of this class.</prop>
     /// </summary>
    private string $username;

    /// <summary>
    /// Initializes private members of the <see cref="Comment"/> class.
    /// </summary>
    public function __construct($commentID, $post_id, $user_id, $text, $timestamp, $username)
    {
        $this->commentID = $commentID;
        $this->post_id = $post_id;
        $this->user_id = $user_id;
        $this->text = $text;
        $this->timestamp = $timestamp;
        $this->username = $username;
    }

    /// <summary>
    /// Gets the id of comment.
    /// </summary>
    /// <value>Comment id.</value>
    public function getCommentID()
    {
        return $this->commentID;
    }

    /// <summary>
    /// Gets the id of post.
    /// </summary>
    /// <value>Post id.</value>
    public function getPostID()
    {
        return $this->post_id;
    }

    /// <summary>
    /// Gets the id of user.
    /// </summary>
    /// <value>User id.</value>
    public function getUserID()
    {
        return $this->user_id;
    }

    /// <summary>
    /// Gets the text / comment.
    /// </summary>
    /// <value>comment.</value>
    public function getText()
    {
        return $this->text;
    }

    /// <summary>
    /// Gets the timestamp.
    /// </summary>
    /// <value>Commented time and date</value>
    public function getTimestamp()
    {
        return $this->timestamp;
    }

    /// <summary>
    /// This function is just used to display a comment of the user.
    /// </summary>
    public function display()
    {
        echo  '  <div id="allcomments" data-spy="scroll" data-target="#navbar-example3" data-offset="0">
                            <h6 id="item-1">👤 Commented by '.$this->username.' at '.$this->timestamp.'</h6>
                            <p> 💬 '.$this->text.'</p>
                        </div>';
    }
}