<?php

$text_success = true;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_p = htmlspecialchars($_POST['id']);
    $title_p = htmlspecialchars($_POST['title']);
    $body_p = $_POST['body'];
    $body_p = '<p>' . preg_replace('#(<br\s*?/?>\s*?){2,}#', '</p>' . "\n" . '<p>', nl2br($body_p)) . '</p>';

$body_p = htmlspecialchars($body_p);

echo "
<hr>
<pre>";
    print_r($_POST['embedded_iframe']);
    echo " </pre>";
$iframe_p = htmlspecialchars($_POST['embedded_iframe']);
echo "
<hr>
<pre>";
    print_r($iframe_p);
    echo " </pre>";

if (!$_FILES["img_file"]['error']) {
$success = true;
require_once 'img_check.php';

if ($success) {

$sql = 'UPDATE mecms_posts
SET img = :img
WHERE id = :id';

$stmt = $db->prepare($sql);
$stmt->bindParam(':id', $id_p);
$stmt->bindParam(':img', $img);
$stmt->execute();
}
}

if ($text_success) {
$sql = 'UPDATE mecms_posts
SET title = :title,
body = :body,
iframe = :iframe
WHERE id = :id';

$stmt = $db->prepare($sql);
$stmt->bindParam(':id', $id_p);
$stmt->bindParam(':title', $title_p);
$stmt->bindParam(':body', $body_p);
$stmt->bindParam(':iframe', $iframe_p);

$stmt->execute();
}

}