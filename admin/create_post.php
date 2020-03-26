<?php
require_once '../db.php';
require_once 'header.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = htmlspecialchars($_POST['title']);
    $body = htmlspecialchars($_POST['body']);

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