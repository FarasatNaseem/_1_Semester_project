<?php
////-----------------------------------------------------------------------
//// <copyright file="Classes/database/Database.class.php" company="FH Technikum Wien">
//// Copyright (c) FH Technikum Wien. All rights reserved.
//// </copyright>
//// <author>Muhammad Farasat Hussain, Christian Tomuta, Paul</author>
//// <summary>Social network.</summary>
////-----------------------------------------------------------------------

include_once 'config.abstractClass.php';
include_once 'Validator.class.php';

/// <summary>
/// Represents the database class.
/// </summary>
class Database
{
    /// <summary>
    /// <prop name="serverName">Host name, which is private propertie of this class.</prop>
    /// </summary>
    private $serverName;

    /// <summary>
    /// <prop name="databaseName">Database name, which is a private propertie of this class.</prop>
    /// </summary>
    private $databaseName;

    /// <summary>
    /// <prop name="username">username of the database, which is a private propertie of this class.</prop>
    /// </summary>
    private $username;

    /// <summary>
    /// <prop name="password">password of the database, which is a private propertie of this class.</prop>
    /// </summary>
    private $password;

    private $connection;
    private $validator;

    /// <summary>
    /// Initializes private members of the <see cref="Database"/> class.
    /// </summary>
    public function __construct()
    {
        $this->serverName = Configration::serverName;
        $this->databaseName = Configration::databaseName;
        $this->username = Configration::username;
        $this->password = Configration::password;

        $this->validator = new Validator();
    }

    /// <summary>
    /// A function, which is just making connection with the database
    /// </summary>
    public function Connect()
    {
        try {
            $connection = new PDO("mysql:host=$this->serverName;dbname=$this->databaseName", $this->username, $this->password);
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

            return $connection;
        } catch (PDOException $ex) {
            echo "Connection failed: " . $ex->getMessage();
        }
    }

    /// <summary>
    /// This function is used to fetch all columns from database.
    /// </summary>
    /// <param name="$table">The table name of the database.</param>
    /// <returns>All columns of a table.</returns>
    public function getAllData($table)
    {
        $conn = $this->Connect();
        $query = "SELECT * FROM $table";
        $statement = $conn->prepare($query);
        $statement->execute();

        while ($result = $statement->fetchAll()) {
            return $result;
        }
    }

    /// <summary>
    /// This function is used to fetch usernames from user table.
    /// </summary>
    /// <param name="$exceptID">A user id.</param>
    /// <returns>Usernames.</returns>
    public function getUserNameList($exceptID = false)
    {
        $conn = $this->Connect();
        if ($exceptID)
            $query = "SELECT username FROM user WHERE NOT (user_id = $exceptID)";
        else
            $query = "SELECT username FROM user";
        $statement = $conn->prepare($query);
        $statement->execute();

        while ($result = $statement->fetchALL()) {
            return $result;
        }
    }

    /// <summary>
    /// This function is used to fetch all emails from user table.
    /// </summary>
    /// <param name="$exceptID">A user id.</param>
    /// <returns>User emails.</returns>
    public function getEmailList($exceptID = false)
    {
        $conn = $this->Connect();
        if ($exceptID)
            $query = "SELECT email FROM user WHERE NOT (user_id = $exceptID)";
        else
            $query = "SELECT email FROM user";
        $statement = $conn->prepare($query);
        $statement->execute();

        while ($result = $statement->fetchALL()) {
            return $result;
        }
    }

    /// <summary>
    /// This function is used to insert a user data in user table.
    /// </summary>
    /// <param name="$data">An array of user data.</param>
    public function InsertUser($data)
    {
        $conn = $this->Connect();
        $query = "INSERT INTO user (authorization, salutation, first_name, last_name, email, username, password, pic) VALUE (?,?,?,?,?,?,?,?)";
        $statement = $conn->prepare($query);
        $statement->execute([$data['authorization'], $data['salutation'], $data['first_name'], $data['last_name'], $data['email'], $data['username'], $data['password'], $data['profilePic']]);
    }

    /// <summary>
    /// This function is used to update user's data in user table.
    /// </summary>
    /// <param name="$data">An array of user data.</param>
    public function ChangeUser($data)
    {
        $conn = $this->Connect();
        //$query = 'UPDATE user SET first_name = \'' . $data["first_name"] . '\', last_name = \'' . $data["last_name"] . '\', email = \'' . $data["email"] . '\', username = \'' . $data["username"] . '\', password = \'' . $data["password"] . '\', pic = \'' . $data["profilePic"] . '\' WHERE user_id = ' . $_SESSION["User"]->getUserID() . ';';

        //check email & username
        $check = $conn->prepare('SELECT username, email FROM user WHERE user_id = ?');

        $query = 'UPDATE user SET salutation = ?, first_name = ?, last_name = ?, password = ? , pic = ? WHERE user_id = ' . $_SESSION["User"]->getUserID() . ';';


        $statement = $conn->prepare($query);
        $statement->execute([$data['salutation'], $data['first_name'], $data['last_name'], $data['password'],  $data['profilePic']]);

        $check->execute([$_SESSION["User"]->getUserID()]);
        $res = $check->fetchObject();
        if ($res->username != $data['username']) {
            $stmt = $conn->prepare('UPDATE user SET username = ? WHERE user_id = ' . $_SESSION["User"]->getUserID() . ';');
            $stmt->execute([$data['username']]);
        }
        if ($res->email != $data['email']) {
            $stmt = $conn->prepare('UPDATE user SET email = ? WHERE user_id = ' . $_SESSION["User"]->getUserID() . ';');
            $stmt->execute([$data['email']]);
        }
    }

    /// <summary>
    /// This function is used to change the user status.
    /// </summary>
    /// <param name="$id">A user id, whose status is gonna change.</param>
    public function switchUserState($id)
    {
        $conn = $this->Connect();
        $stmt = $conn->prepare("UPDATE user SET active = NOT active WHERE user_id = $id");
        $stmt->execute();
    }

    /// <summary>
    /// This function is used to insert a post in the post table.
    /// </summary>
    /// <param name="$data">An array of post data.</param>
    /// <param name="$tags">Post tags.</param>
    public function InsertPost($data, $tags = false)
    {
        $conn = $this->Connect();
        $query = "INSERT INTO post (user_id, image_path, article) VALUE (?,?,?)";
        $statement = $conn->prepare($query);
        $statement->execute([$data['user_id'], $data['image_path'], $data['article']]);

        if ($tags)
            $this->InsertTags($this->latestPostID(), Validator::explodeTags($tags, ','));
    }

    /// <summary>
    /// This function is used to update a post's data in post table.
    /// </summary>
    /// <param name="$data">An array of post data.</param>
    /// <param name="$tags">new list of tags.</param>
    /// <param name="$data">the primary key of the post in question.</param>
    public function UpdatePost($data, $tags = false, $id)
    {
        $conn = $this->Connect();
        $query = 'UPDATE post SET image_path = ? , article = ? WHERE post_id = ' . $id . ';';
        $statement = $conn->prepare($query);
        $statement->execute([$data['image_path'], $data['article']]);

        if ($tags)
            $this->InsertTags($id, Validator::explodeTags($tags, ','));
    }
    /// <summary>
    /// deletes all tags in relation to the given post_id
    /// </summary>
    public function deleteTag($postid)
    {
        $query = "DELETE FROM tags WHERE post_id = ?";
        $statement = $this->Connect()->prepare($query);
        $statement->execute([$postid]);
    }

    /// <summary>
    /// This function is used to insert tag / tags in the tags table.
    /// </summary>
    /// <param name="$post_id">A post id.</param>
    /// <param name="$tags">Post tags.</param>
    public function InsertTags($post_id, $tags)
    {
        $conn = $this->Connect();
        foreach ($tags as $tag) {
            $stmt = $conn->prepare("INSERT INTO tags (post_id, tag) VALUE ($post_id, '$tag')");
            $stmt->execute();
        }
    }

    /// <summary>
    /// returns the most recently created post
    /// </summary>
    private function latestPostID()
    {
        $conn = $this->Connect();
        $stmt = $conn->prepare("SELECT post_id FROM post ORDER BY created_date DESC LIMIT 1");
        $stmt->execute();
        return $stmt->fetchObject()->post_id;
    }

    /// <summary>
    /// This function is used to fetch all data of a particular user.
    /// </summary>
    /// <param name="$username">Name of a user, whose data is going to be fetched.</param>
    public function getUserByName($username)
    {
        $conn = $this->Connect();
        $stmt = $conn->prepare("SELECT user_id FROM User WHERE username = \"$username\"");
        $stmt->execute();
        return $this->getUser($stmt->fetch(PDO::FETCH_OBJ)->user_id);
    }

    /// <summary>
    /// This function is used to fetch all data of a particular user.
    /// </summary>
    /// <param name="$id">The id of a user, whose data is going to be fetched.</param>
    /// <returns>All particular row of the user table.</returns>
    public function getUser(int $id)
    {
        $conn = $this->Connect();
        $stmt = $conn->prepare("SELECT * FROM User WHERE user_id = $id");
        $stmt->execute();
        $res = $stmt->fetch(PDO::FETCH_OBJ);
        if ($res) {
            $user = new User($res->user_id, $res->authorization, $res->salutation, $res->first_name, $res->last_name, $res->email, $res->username, $res->password, $res->active, $res->pic);
            return $user;
        } else {
            return null;
        }
    }

    /// <summary>
    /// This function is used to fetch all columns from the user table.
    /// </summary>
    /// <returns>All columns of a user table.</returns>
    public function getUserList()
    {
        $conn = $this->Connect();
        $stmt = $conn->prepare("SELECT user_id FROM User ORDER BY user_id ASC");
        $stmt->execute();
        $userList = array();
        while ($res = $stmt->fetchObject()) {
            array_push($userList, $this->getUser((int)$res->user_id));
        }

        return $userList;
    }

    /// <summary>
    /// This function is used to fetch a particular row of the table post.
    /// </summary>
    /// This function is also fetching likes and dislikes of the post.
    /// </summary>
    /// <param name="$id">The id of a post, whose data is going to be fetched.</param>
    /// <returns>All row of a post table with likes, dislikes.</returns>
    public function getPost(int $id)
    {
        $conn = $this->Connect();
        $stmt = $conn->prepare("SELECT * FROM Post WHERE post_id = $id");
        $stmt->execute();
        $res = $stmt->fetch(PDO::FETCH_OBJ);
        $stmt = $conn->prepare("SELECT user_id FROM Likes WHERE post_id = $id");
        $stmt->execute();
        $likes = array();
        $dislikes = array();
        while ($like = $stmt->fetch(PDO::FETCH_OBJ)) {
            array_push($likes, $like->user_id);
        }
        $stmt = $conn->prepare("SELECT user_id FROM Dislikes WHERE post_id = $id");
        $stmt->execute();
        while ($dislike = $stmt->fetch(PDO::FETCH_OBJ)) {
            array_push($dislikes, $dislike->user_id);
        }
        if ($res) {
            $post = new Post($res->post_id, $res->user_id, $res->created_date, $res->image_path, $res->article, $likes, $dislikes, $res->privacy);
            return $post;
        }
    }
    
    /// <summary>
    /// returns a list of all posts (objects) created by the given user 
    /// </summary>
    public function getPostsByUser($userID)
    {
        $conn = $this->Connect();
        $stmt = $conn->prepare("SELECT post_id FROM post WHERE user_id = $userID");
        $stmt->execute();
        $posts = array();
        while ($res = $stmt->fetchObject()) {
            array_push($posts, $this->getPost($res->post_id));
        }
        return $posts;
    }

    //returns an ordered list of posts (objects) from the DB
    public function getPostList($limit = false, $offset = false, $search = false, $tags = false, $order = "created_date")
    {
        $conn = $this->Connect();
        $query = "SELECT p.post_id FROM Post as p";

        $query .= " WHERE";
        if ($search)
            $query .= " (p.article like '%$search%' OR EXISTS (SELECT * FROM comments as c WHERE c.post_id = p.post_id AND c.comment LIKE '%$search%')) AND";

        $query .= " 1";
        switch ($order) {
            case 'newest':
                $query .= " ORDER BY created_date DESC";
                break;
            case 'oldest':
                $query .= " ORDER BY created_date ASC";
                break;
            case 'likes':
                $query .= " ORDER BY (SELECT COUNT(post_id) FROM likes as l WHERE l.post_id = p.post_id) DESC";
                break;
            case 'dislikes':
                $query .= " ORDER BY (SELECT COUNT(post_id) FROM dislikes as l WHERE l.post_id = p.post_id) DESC";
                break;
            default:
                $query .= " ORDER BY created_date DESC";
        }
        if ($limit)
            $query .= " LIMIT $limit";
        if ($offset)
            $query .= " OFFSET $offset";

        $stmt = $conn->prepare($query);

        $stmt->execute();
        $postList = array();
        for ($i = 0; $i < $limit || !$limit; $i++) {
            $res = $stmt->fetchObject();
            if ($res == false)
                break;

            if ($tags) {
                $tagFound = false;
                foreach ($tags as $tag) {
                    $tagQuery = $conn->prepare("SELECT * FROM tags as t WHERE (t.post_id = $res->post_id AND t.tag = '$tag')");
                    $tagQuery->execute();
                    if ($tagQuery->fetch())
                        $tagFound = true;
                }
            }
            if (!$tags || ($tagFound))
                array_push($postList, $this->getPost($res->post_id));
        }
        return $postList;
    }

    /// <summary>
    /// This function is used to fetch a all comments (objects) of a particular post from post table.
    /// </summary>
    /// <param name="$postID">The id of a post, whose comments are going to fetched.</param>
    /// <returns>All comments of the post.</returns>
    public function getComments(int $postID)
    {
        $conn = $this->Connect();
        $stmt = $conn->prepare("SELECT * FROM comments INNER JOIN user WHERE comments.user_id = user.user_id AND comments.post_id = $postID");
        $stmt->execute();
        $comments = array();

        while ($res = $stmt->fetch(PDO::FETCH_OBJ)) {
            $break = false;

            foreach ($comments as $comment) {
                if ($comment->getCommentID() == $res->comment_id) $break = true;
            }
            if ($break) break;
            $comment = new Comment($res->comment_id, $res->post_id, $res->user_id, $res->comment, $res->timestamp, $res->username);
            array_push($comments, $comment);
        }
        return $comments;
    }

    /// <summary>
    /// This function is used to fetch a all tags (strings) of a particular post from post table.
    /// </summary>
    /// <param name="$postID">The id of a post, whose tags are going to fetched.</param>
    /// <returns>All tags of the post.</returns>
    public function getTags($postID)
    {
        $conn = $this->Connect();
        $stmt = $conn->prepare("SELECT tag FROM tags WHERE post_id = $postID");
        $stmt->execute();
        $tags = array();
        while ($res = $stmt->fetchObject())
            array_push($tags, $res->tag);
        return $tags;
    }

    /// <summary>
    /// This function is used to fetch a all user ids of the likes table.
    /// </summary>
    /// <returns>All user ids, which are in the likes table.</returns>
    public function getUserIdFromLikeTable()
    {
        $conn = $this->Connect();
        $query = "SELECT user_id FROM likes";
        $statement = $conn->prepare($query);
        $statement->execute();

        while ($result = $statement->fetchALL()) {
            return $result;
        }
    }

    /// <summary>
    /// This function is used to fetch a all user ids of the dislikes table.
    /// </summary>
    /// <returns>All user ids, which are in the dislikes table.</returns>
    public function getUserIdFromDislikeTable()
    {
        $conn = $this->Connect();
        $query = "SELECT user_id FROM dislikes";
        $statement = $conn->prepare($query);
        $statement->execute();

        while ($result = $statement->fetchALL()) {
            return $result;
        }
    }

    /// <summary>
    /// This function is used to fetch a all post ids of the likes table.
    /// </summary>
    /// <returns>All post ids, which are in the likes table.</returns>
    public function getPostDataByID($id)
    {
        $conn = $this->Connect();
        $queryOne = "SELECT * FROM post WHERE post_id = ?";
        $statement = $conn->prepare($queryOne);
        $statement->execute([$id]);

        while ($result = $statement->fetch()) {
            return $result;
        }
    }

    /// <summary>
    /// This function is used to insert user like in the likes table.
    /// </summary>
    /// <param name="$data">An array, which contains user and post id.</param>
    public function InsertLike($data)
    {
        $conn = $this->Connect();
        $query = "INSERT INTO likes (user_id, post_id) VALUE (?,?)";
        $statement = $conn->prepare($query);
        $statement->execute([$data['userid'], $data['postid']]);
    }

    /// <summary>
    /// This function is used to insert user dislike in the dislikes table.
    /// </summary>
    /// <param name="$data">An array, which contains user and post id.</param>
    public function InsertDislike($data)
    {
        $conn = $this->Connect();
        $query = "INSERT INTO dislikes (user_id, post_id) VALUE (?,?)";
        $statement = $conn->prepare($query);
        $statement->execute([$data['userid'], $data['postid']]);
    }

    /// <summary>
    /// This function is used to delete a user like from the likes table.
    /// </summary>
    /// <param name="$uid">A user id, whose like is going to be deleted.</param>
    /// <param name="$pid">A post id, whose like of a given user id is going to be deleted.</param>
    public function deleteLike($uid, $pid)
    {
        $query = "DELETE FROM likes WHERE user_id = ? AND post_id = ?";
        $statement = $this->Connect()->prepare($query);
        $statement->execute([$uid, $pid]);
    }

    /// <summary>
    /// This function is used to delete a user dislike from the dislikes table.
    /// </summary>
    /// <param name="$uid">A user id, whose dislike is going to be deleted.</param>
    /// <param name="$pid">A post id, whose dislike of a given user id is going to be deleted.</param>
    public function deleteDislike($uid, $pid)
    {
        $query = "DELETE FROM dislikes WHERE user_id = ? AND post_id = ?";
        $statement = $this->Connect()->prepare($query);
        $statement->execute([$uid, $pid]);
    }

    /// <summary>
    /// This function is used to delete a a particular post from post table.
    /// </summary>
    /// <param name="$postid">A post id, whose is gonna be deleted.</param>
    public function deletePost($postid)
    {
        $query = "DELETE FROM post WHERE post_id = ?";
        $statement = $this->Connect()->prepare($query);
        $statement->execute([$postid]);
    }

    /// <summary>
    /// This function is used to fetch a particular post is from likes / dislikes table.
    /// </summary>
    /// <param name="$id">A use id, whose post id is gonna be fetched.</param>
    /// <param name="$table">A table name (likes / dislikes).</param>
    /// <returns>post id.</returns>
    public function getPostIdByUserId($id, $table)
    {
        $conn = $this->Connect();
        $query = "SELECT post_id FROM $table WHERE user_id = $id";
        $statement = $conn->prepare($query);
        $statement->execute();
        while ($data = $statement->fetchALL()) {
            return $data;
        }
    }

    /// <summary>
    /// This function is used to change the privacy type of user post.
    /// </summary>
    /// <param name="$postid">A post id, whose privacy policy is going to be changed.</param>
    /// <param name="$privacyType">This can be either public or private.</param>
    public function changePostPrivacy($postid, $privacyType)
    {
        $conn = $this->Connect();
        $query = 'UPDATE post SET privacy = \'' . $privacyType . '\' WHERE post_id = ' . $postid . ';';
        $statement = $conn->prepare($query);
        $statement->execute();
    }

    /// <summary>
    /// This function is used to insert a user comment in the user table.
    /// </summary>
    /// <param name="$data">An array, which contains user id, post id and user comment.</param>
    public function InsertComment($data)
    {
        $conn = $this->Connect();
        $query = "INSERT INTO comments (user_id, post_id, comment) VALUE (?,?,?)";
        $statement = $conn->prepare($query);
        $statement->execute([$data['userid'], $data['postid'], $data['usercomment']]);
    }
}