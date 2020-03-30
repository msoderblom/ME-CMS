<?php
if (!$_FILES["img_file"]['error']) {
    $imgErrors = '';
    $target_dir = "../images/";
    $target_file = $target_dir . basename($_FILES["img_file"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    $check = getimagesize($_FILES["img_file"]["tmp_name"]);
    if ($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        $imgErrors .= 'File is not an image.<br>';
        $uploadOk = 0;
        $success = false;
    }

    // Check if file already exists
    if (file_exists($target_file)) {
        $uploadOk = 0;
    }

    // Allow certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif") {
        $imgErrors .= 'Sorry, only JPG, JPEG, PNG & GIF files are allowed.<br>';
        $uploadOk = 0;
        $success = false;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {

        $imgErrors .= 'Sorry, your file was not uploaded. Please try again.<br>';

        if ($success) {
            $img = $_FILES["img_file"]["name"];
        }
        // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["img_file"]["tmp_name"], $target_file)) {
            //echo "The file " . basename($_FILES["img_file"]["name"]) . " has been uploaded.";
            $img = $_FILES["img_file"]["name"];

        } else {
            $imgErrors .= 'Sorry, there was an error uploading your file.<br>';
            $success = false;
        }
    }
}