<?php
$success = true;
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $title = htmlspecialchars($_POST['title']);
    $body = $_POST['body'];
    $body = '<p>' . preg_replace('#(<br\s*?/?>\s*?){2,}#', '</p>' . "\n" . '<p>', nl2br($body)) . '</p>';
$body = htmlspecialchars($body);
if (isset($_POST['embedded_iframe']) && !empty($_POST['embedded_iframe'])) {
$iframe = ($_POST['embedded_iframe']);
$iframe = htmlspecialchars($iframe);
}
require_once 'img_check.php';
if ($success) {
$sql = "INSERT INTO mecms_posts (title, body, iframe, img)
VALUES (:title, :body, :iframe, :img)";
$stmt = $db->prepare($sql);
$stmt->bindParam(':title', $title);
$stmt->bindParam(':body', $body);
$stmt->bindParam(':iframe', $iframe);
$stmt->bindParam(':img', $img);
$stmt->execute();
header('Location:index.php');
}

}