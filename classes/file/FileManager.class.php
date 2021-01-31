<?php
////-----------------------------------------------------------------------
//// <copyright file="file/FileManager.class.php" company="FH Technikum Wien">
//// Copyright (c) FH Technikum Wien. All rights reserved.
//// </copyright>
//// <author>Muhammad Farasat Hussain, Christian Tomuta, Paul</author>
//// <summary>Social network.</summary>
////-----------------------------------------------------------------------

/// <summary>
/// Represents the FileManager class.
/// </summary>
class FileManager
{
    /// <summary>
    /// <variable name="DIR">A constant variable, which indicates the directory name.</variable>
    /// </summary>
    const DIR = "img\\";

    /// <summary>
    /// <variable name="MAXTHUMBWIDTH">A constant variable, Which indicates the width of the photo.</variable>
    /// </summary>
    const MAXTHUMBWIDTH = 300;

    /// <summary>
    /// <variable name="MAXTHUMBHEIGHT">A constant variable, Which indicates the height of the photo.</variable>
    /// </summary>
    const MAXTHUMBHEIGHT = 300;

    /// <summary>
    /// This function is used to upload photo.
    /// </summary>
    /// <param name="$file">The file, which is need to be uploaded.</param>
    /// <returns>File path.</returns>
    public function upload($file, $username)
    {
        if ($file['size'] <= 0)
            return '';
        //check if file is an image
        $mimeType = mime_content_type($file["tmp_name"]);
        if ($mimeType != false && !strcmp(explode("/", $mimeType)[0], "image")) {

            //get user directory
            $dir = $this->getDir($username, pathinfo($file["name"], PATHINFO_FILENAME));
            //create post directory
            $path =  $dir . "\\original." . pathinfo($file["name"], PATHINFO_EXTENSION);
            //echo $path;

            //save file in directory
            move_uploaded_file($file["tmp_name"], $path);

            //create thumbnail version of file
            $this->createThumbnail($path);

            return $path;
        }
    }

    /// <summary>
    /// creates (if necessary) and returns a unique directory for an uploaded file 
    /// </summary>
    /// <param name="$path">?????????????.</param>
    private function getDir($username, $filename)
    {
        //check if directoriy exists
        $path = FileManager::DIR . $username;
        if (!file_exists($path)) {
            mkdir($path);
        }

        $path = $path . '\\' . $filename;
        if (file_exists($path)) {
            $i = 1;
            while (file_exists($path . '(' . $i . ')'))
                $i++;
            $path = $path . '(' . $i . ')';
        }
        mkdir($path);

        return $path;
    }

    /// <summary>
    /// creates a thumbnail image (name: thumb.png) in the same directory as the original
    /// </summary>
    /// <param name="$original">???????????????.</param>
    private function createThumbnail($original)
    {
        //kopiert aus moodlekurs Präsenz 12
        $imgSize = getimagesize($original); //[0]: width, [1]: height
        switch ($imgSize[2]) {
                // Codes für die populärsten Bildformate
                // 1 = GIF, 2 = JPG, 3 = PNG
            case 1: // GIF
                $image = imagecreatefromgif($original);
                break;
            case 2: // JPEG
                $image = imagecreatefromjpeg($original);
                break;
            case 3: // PNG
                $image = imagecreatefrompng($original);
                break;
            default:
                return false;
        }
        $factor = 1;
        if ($imgSize[0] > $imgSize[1] && $imgSize[0] > FileManager::MAXTHUMBWIDTH) {
            //scale to max width
            $factor = FileManager::MAXTHUMBWIDTH / $imgSize[0];
        } else if ($imgSize[1] > FileManager::MAXTHUMBHEIGHT) {
            //scale to max height
            $factor = FileManager::MAXTHUMBHEIGHT / $imgSize[1];
        }
        $thumbwidth = round($imgSize[0] * $factor);
        $thumbheight = round($imgSize[1] * $factor);

        $thumb = imagecreatetruecolor($thumbwidth, $thumbheight);

        imagecopyresampled($thumb, $image, 0, 0, 0, 0, $thumbwidth, $thumbheight, $imgSize[0], $imgSize[1]);

        imagepng($thumb, pathinfo($original, PATHINFO_DIRNAME) . '\\thumb.png');
    }
}