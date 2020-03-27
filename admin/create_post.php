<?php
require_once '../db.php';
require_once 'header.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = htmlspecialchars($_POST['title']);
    $body = $_POST['body'];
    $body = '<p>' . preg_replace('#(<br\s*?/?>\s*?){2,}#', '</p>' . "\n" . '<p>', nl2br($body)) . '</p>';
$body = htmlspecialchars($body);

$sql = "INSERT INTO mecms_posts (title, body)
VALUES (:title, :body)";

$stmt = $db->prepare($sql);
$stmt->bindParam(':title', $title);
$stmt->bindParam(':body', $body);

$stmt->execute();

}

?>

<form action="#" method="POST">
  <div class="form-group">
    <label for="post_title">Title</label>
    <input type="text" name="title" id="post_title" class="form-control" placeholder="Title" aria-label="Post title">
  </div>
  <div class="form-group">
    <label for="post_body">Example textarea</label>
    <textarea name="body" class="form-control" id="post_body" rows="3"></textarea>
  </div>
  <button type="submit" class="btn btn-primary">Publish</button>

</form>


<?php

require_once 'footer.php';