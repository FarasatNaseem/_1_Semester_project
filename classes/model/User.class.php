<?php
////-----------------------------------------------------------------------
//// <copyright file="model/User.class.php" company="FH Technikum Wien">
//// Copyright (c) FH Technikum Wien. All rights reserved.
//// </copyright>
//// <author>Muhammad Farasat Hussain, Christian Tomuta, Paul</author>
//// <summary>Social network.</summary>
////-----------------------------------------------------------------------


/// <summary>
/// Represents user class.
/// </summary>

class User
{
    /// <summary>
    /// <prop name="$userID">which is private propertie of this class.</prop>
    /// </summary>
    private int $userID;

    /// <summary>
    /// <prop name="$authorization">which is private propertie of this class.</prop>
    /// </summary>
    private int $authorization;

    /// <summary>
    /// <prop name="$salutation">which is private propertie of this class.</prop>
    /// </summary>
    private string $salutation;

    /// <summary>
    /// <prop name="$firstName">which is private propertie of this class.</prop>
    /// </summary>
    private string $firstName;

    /// <summary>
    /// <prop name="$lastName">which is private propertie of this class.</prop>
    /// </summary>
    private string $lastName;

    /// <summary>
    /// <prop name="$email">which is private propertie of this class.</prop>
    /// </summary>
    private string $email;

    /// <summary>
    /// <prop name="$username">which is private propertie of this class.</prop>
    /// </summary>
    private string $username;

    /// <summary>
    /// <prop name="$password">which is private propertie of this class.</prop>
    /// </summary>
    private string $password;

    /// <summary>
    /// <prop name="$active">which is private propertie of this class.</prop>
    /// </summary>
    private bool $active;

    /// <summary>
    /// Initializes private members of the <see cref="User"/> class.
    /// </summary>
    /// <summary>
    /// <prop name="$active">path to profile picture</prop>
    /// </summary>
    private string $pic;

    /// <summary>
    /// Initializes private members of the <see cref="User"/> class.
    /// </summary>
    public function __construct($userID, $authorization, $salutation, $firstName, $lastName, $email, $username, $password, $active, $pic)
    {
        $this->userID = $userID;
        $this->authorization = $authorization;
        $this->salutation = $salutation;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->username = $username;
        $this->password = $password;
        $this->active = $active;

        $this->pic = $pic;
    }

    public function getPic()
    {
        return $this->pic;
    }
   
    public function getThumb()
    {
        $thumbpath = pathinfo($this->pic, PATHINFO_DIRNAME) . '\\thumb.png';
        if (file_exists($thumbpath))
            return $thumbpath;
        else
            return $this->pic;
    }

    /// <summary>
    /// Gets the array of user data.
    /// </summary>
    /// <value>User data.</value>
    public function getArray()
    {
        return array($this->userID, $this->authorization, $this->salutation, $this->firstName, $this->lastName, $this->email, $this->username, $this->password);
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
    /// Gets the user authorization.
    /// </summary>
    /// <value>User authorization</value>
    public function getAuthorization()
    {
        return $this->authorization;
    }

    /// <summary>
    /// Gets the user salutaion.
    /// </summary>
    /// <value>User salutaion.</value>
    public function getSalutation()
    {
        return $this->salutation;
    }

    /// <summary>
    /// Gets the user first name.
    /// </summary>
    /// <value>User first name.</value>
    public function getFirstName()
    {
        return $this->firstName;
    }

    /// <summary>
    /// Gets the user last name.
    /// </summary>
    /// <value>User last name.</value>
    public function getLastName()
    {
        return $this->lastName;
    }

    /// <summary>
    /// Gets the email.
    /// </summary>
    /// <value>User email address.</value>
    public function getEmail()
    {
        return $this->email;
    }

    /// <summary>
    /// Gets the username.
    /// </summary>
    /// <value>Username.</value>
    public function getUsername()
    {
        return $this->username;
    }

    /// <summary>
    /// Gets the password.
    /// </summary>
    /// <value>User password.</value>
    public function getPassword()
    {
        return $this->password;
    }

    /// <summary>
    /// Gets the user availability.
    /// </summary>
    /// <value>User availability.</value>
    public function isActive()
    {
        return $this->active;
    }

    /// <summary>
    /// This function is just used to display user id and user name.
    /// </summary>
    public function display()
    {
        echo "id: $this->userID, uname: $this->username";
    }

    /// <summary>
    /// This function is used to get like from user and store in database.
    /// </summary>
    /// <param name="$userid">Logged in user id.</param>
    /// <param name="$postid">The post, which is going to be liked by user.</param>
    /// <param name="$db">Object of database class.</param>
    public static function Like(int $userid, int $postid, $db)
    {
        if(isset($_GET['like']))
        {
            $data['userid'] = $_GET['userid'];
            $data['postid'] = $_GET['postid'];
    
            $likedUserIds = $db->getUserIdFromLikeTable();
            $dislikedUserIds = $db->getUserIdFromDislikeTable();
    
            $userlike = $db->getPostIdByUserId($data['userid'], "likes");
            $userDislike = $db->getPostIdByUserId($data['userid'], "dislikes");

         if($userDislike != NULL)
          {
             if(Validator::isDisliked($data['postid'], $data['userid'],$dislikedUserIds, $userDislike))
             {
                  $db->deleteDislike($data['userid'], $data['postid']);
 
                 if($userlike != NULL)
                 {
                      if(!Validator::isLiked($data['postid'], $data['userid'],$likedUserIds, $userlike))
                      {
                           $db->Insertlike($data);
                      }
                      else
                      {
                         $db->deleteDislike($data['userid'], $data['postid']);
                      }
                 }
                 else
                 {
                     $db->Insertlike($data);
                 }
             }
             else
             {
                 if($userlike != NULL)
                 {
                     if(!Validator::isLiked($data['postid'], $data['userid'],$likedUserIds, $userlike))
                    {
                        $db->InsertLike($data);
                    }
                    else
                    {
                       $db->deletelike($data['userid'], $data['postid']);
                    }
                }
                else
                {
                    $db->InsertLike($data);
                }
             }
         }
         else
         {
            if($userlike != NULL)
            {
               if(!Validator::isLiked($data['postid'], $data['userid'],$likedUserIds, $userlike))
               {  
                 $db->InsertLike($data);
               }
               else
               {
                 $db->deletelike($data['userid'], $data['postid']);
               }
            }
        else
        {
            $db->InsertLike($data);
        }
      
      }
      unset($_GET['like']);
      echo '<script>window.location="index.php?selection=home&userid=' . $userid . '"</script>';
         
     }

        echo '<a href="index.php?selection=home&like=true&userid=' . $userid . '&postid=' . $postid . '"><img id="likedislikebuttons" src="img/like.jpg"></a></a>';
    }

    /// <summary>
    /// This function is used to get dislike from user and store in database.
    /// </summary>
    /// <param name="$userid">Logged in user id.</param>
    /// <param name="$postid">The post, which is going to be disliked by user.</param>
    /// <param name="$db">Object of database class.</param>
    public static function Dislike(int $userid, int $postid, $db)
    {
       if(isset($_GET['dislike']))
       {
             $data['userid'] = $_GET['userid'];
             $data['postid'] = $_GET['postid'];

             $likedUserIds = $db->getUserIdFromLikeTable();
             $dislikedUserIds = $db->getUserIdFromDislikeTable();

             $userlike = $db->getPostIdByUserId($data['userid'], "likes");
             $userDislike = $db->getPostIdByUserId($data['userid'], "dislikes");

        if($userlike != NULL)
        {
            if(Validator::isLiked($data['postid'], $data['userid'],$likedUserIds, $userlike))
            {
                $db->deleteLike($data['userid'], $data['postid']);

                if($userDislike != NULL)
                {
                     if(!Validator::isDisliked($data['postid'], $data['userid'],$dislikedUserIds, $userDislike))
                     {
                          $db->InsertDislike($data);
                     }
                     else
                     {
                        $db->deleteDislike($data['userid'], $data['postid']);
                     }
                }
                else
                {
                    $db->InsertDislike($data);
                }
            }
            else
            {
                 if($userDislike != NULL)
                {
                    if(!Validator::isDisliked($data['postid'], $data['userid'],$dislikedUserIds, $userDislike))
                     {
                          $db->InsertDislike($data);
                     }
                     else
                     {
                        $db->deleteDislike($data['userid'], $data['postid']);
                     }
                }
                else
                {
                    $db->InsertDislike($data);
                }
            }
        }
        else
        {
             if($userDislike != NULL)
            {
                if(!Validator::isDisliked($data['postid'], $data['userid'],$dislikedUserIds, $userDislike))
                 {
                      $db->InsertDislike($data);
                 }
                 else
                 {
                    $db->deleteDislike($data['userid'], $data['postid']);
                 }
            }
            else
            {
                $db->InsertDislike($data);
            }
        }

        unset($_GET['dislike']);

        echo '<script>window.location="index.php?selection=home&userid=' . $userid . '"</script>';
     }

        echo '<a href="index.php?selection=home&dislike=true&userid=' . $userid . '&postid=' . $postid . '"><img id="likedislikebuttons" src="img/dislike.jpg"></a>';
    }

    /// <summary>
    /// This function is used to delete the post by user.
    /// </summary>
    /// <param name="$userid">Logged in user id.</param>
    /// <param name="$postid">The post, which is going to be deleted by user.</param>
    /// <param name="$db">Object of database class.</param>
    public static function DeletePost(int $userid, int $postid, $db)
    {
            if(isset($_GET['delete']))
            {
                $id = $_GET['postid'];
                $userid = $_GET['userid'];
                echo "inside";
                $db->deletePost($id);
   
                unset($_GET['delete']);
                echo '<script>window.location="index.php?selection=home&userid=' . $userid . '"</script>';
            }

        echo '<a href="index.php?selection=home&delete=true&userid=' . $userid . '&postid=' . $postid . '" class="btn btn-danger">Delete</a>';
    }

    /// <summary>
    /// This function is used to get comment from user and store in database.
    /// </summary>
    /// <param name="$userid">Logged in user id.</param>
    /// <param name="$postid">The post, which is going to be commented by user.</param>
    /// <param name="$db">Object of database class.</param>
    public static function Comment(int $userid, int $postid, $db)
    {
           if(isset($_POST['usercomment']))
           {
                $data = $_GET;
                $comment = $_POST;
                $data = array_merge($data, $comment);

                $db->InsertComment($data);
    
                $userid = $data['userid'];

                unset($_POST['usercomment']);
    
                echo '<script>window.location="index.php?selection=home&userid=' . $userid . '"</script>';
           }

        echo '  <form action="index.php?selection=home&comment=true&userid=' . $userid . '&postid=' . $postid . '" method="POST">
                <input id="comm" type="text" name="usercomment">
                <button id="comb" class="btn btn-primary type="submit" name="submit">Comment</button>
                </form>';    
    }

     /// <summary>
    /// This function is used to get action.
    /// </summary>
    /// <param name="$userid">Logged in user id.</param>
    /// <param name="$postid">The post, which user wants to update.</param>
    public static function Update(int $userid, int $postid)
    {
        echo '<a href="index.php?selection=updatepost&update=true&userid=' . $userid . '&postid=' . $postid . '" class="btn btn-warning">Update</a>';
    }

    /// <summary>
    /// This function is used to share a post by user.
    /// </summary>
    /// <param name="$userid">Logged in user id.</param>
    /// <param name="$postid">The post, which is going to be shared by user.</param>
    /// <param name="$privacy">Shared type of post. Could be either public or private.</param>
    /// <param name="$db">Object of database class.</param>
    public static function Share(int $userid, int $postid, int $privacy, $db)
    {
        if(isset($_GET['share']))
        {
            $data = $_GET;
            
            $db->changePostPrivacy($data['postid'], $data['sharedtype']);
            
            $userid = $data['userid'];

            unset($_GET['share']);
            
            echo '<script>window.location="index.php?selection=home&userid=' . $userid . '"</script>';
        }
        
        if (Validator::isPublic($privacy))
        {
            $textPublicPost = "Shared in public";
            echo '<a href="index.php?selection=home&share=true&userid=' . $userid . '&postid=' . $postid . '&sharedtype=1" class="btn btn-success">' . $textPublicPost . '</a>';
        }
        else
        {
            $textPublicPost = "Share publicly";
            echo '<a href="index.php?selection=home&share=true&userid=' . $userid . '&postid=' . $postid . '&sharedtype=1" class="btn btn-info">' . $textPublicPost . '</a>';
        }

        if (Validator::isPrivate($privacy))
        {
            $textPrivatePost = "Shared in private";
            echo '<a href="index.php?selection=home&share=true&userid=' . $userid . '&postid=' . $postid . '&sharedtype=0" class="btn btn-success">' . $textPrivatePost . '</a>';
        }
        else
        {
            $textPrivatePost = "Share privately";
            echo '<a href="index.php?selection=home&share=true&userid=' . $userid . '&postid=' . $postid . '&sharedtype=0" class="btn btn-info">' . $textPrivatePost . '</a>';
        }  
    }

    /// <summary>
    /// This function is used logged out the user.
    /// </summary>
    public static function Logout()
    {
        unset($_SESSION["User"]);
        setcookie("stay", null, time() + 0);
        header('Location:  index.php');
    }

    /// <summary>
    /// This function is used to upload a post by user.
    /// </summary>
    /// <param name="$fm">Object of file manager class.</param>
    /// <param name="$dm">Object of database class.</param>
    public static function UploadPost($fm, $db)
    {
        $imgPath = "";
      
      if (isset($_FILES['file']) && $_FILES['file']['size'] > 0)
      {
          $imgPath = $fm->upload($_FILES['file'], $_SESSION["User"]->getUsername());
      }
      
      if (strlen($imgPath) > 0 || strlen($_POST['text']) > 0)
      {
         $db->insertPost(array('user_id' => $_SESSION["User"]->getUserID(), 'image_path' => $imgPath, 'article' => $_POST['text']), $_POST['tags']);
         header('Location: index.php?selection=home');
      }
    }

    /// <summary>
    /// This function is used to update a post by user.
    /// </summary>
    /// <param name="$fm">Object of file manager class.</param>
    /// <param name="$dm">Object of database class.</param>
    /// <param name="$postData">Old post data.</param>
    public static function UpdatePost($fm, $db, $postData)
    {
        $imgPath = "";

        if (isset($_FILES['file']) && $_FILES['file']['size'] > 0) {
            $imgPath = $fm->upload($_FILES['file'], $db->getUser($postData['user_id'])->getUsername());
        } else
            $imgPath = $postData['image_path'];

        if (strlen($imgPath) > 0 || strlen($_POST['text']) > 0) {
            $db->updatePost(array('image_path' => $imgPath, 'article' => $_POST['text']), $_POST["tags"], $_GET['postid']);
            header('Location: index.php?selection=home&userid=' . $_SESSION["User"]->getUserID() . '');
        }
    }
}