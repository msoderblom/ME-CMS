<?php
$success = true;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    print_r($_FILES);
    print_r($_FILES["img_file"]);
    print_r($_FILES["img_file"]["tmp_name"]);

    $title = htmlspecialchars($_POST['title']);
    $body = $_POST['body'];
    $body = '<p>' . preg_replace('#(<br\s*?/?>\s*?){2,}#', '</p>' . "\n" . '<p>', nl2br($body)) . '</p>';
$body = htmlspecialchars($body);

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
echo "File is not an image.";
$uploadOk = 0;
}

// Check if file already exists
if (file_exists($target_file)) {
echo "Sorry, file already exists.";
$uploadOk = 0;

}

// Allow certain file formats
if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif") {
echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
$uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
echo "Sorry, your file was not uploaded.";
$success = false;

// if everything is ok, try to upload file
} else {
if (move_uploaded_file($_FILES["img_file"]["tmp_name"], $target_file)) {
echo "The file " . basename($_FILES["img_file"]["name"]) . " has been uploaded.";

} else {
echo "Sorry, there was an error uploading your file.";
$success = false;
}
}

if ($success) {
$sql = "INSERT INTO mecms_posts (title, body)
VALUES (:title, :body)";

$stmt = $db->prepare($sql);
$stmt->bindParam(':title', $title);
$stmt->bindParam(':body', $body);

$stmt->execute();

header('Location:index.php');
}

// else
// lägg in värden från post i inputen så användaren slipper skriva om

}
//header('Location:index.php');


