<?php
require_once '../db.php';
$imgErrors = '';
$title = '';
$body = '';
$iframe = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once 'processing_post.php';

}

require_once 'header.php';
?>

<form action="#" method="POST" enctype="multipart/form-data">
  <div class="form-group">
    <label for="post_title">Title*</label>
    <input type="text" name="title" id="post_title" value="<?=$title?>" class="form-control" placeholder="Title"
      aria-label="Post title" required>
  </div>
  <div class="form-group">
    <label for="post_body">Text*</label>
    <textarea name="body" class="form-control" id="post_body" rows="3"
      required><?=strip_tags(htmlspecialchars_decode($body))?></textarea>
  </div>
  <div class="form-group">
    <label for="post_iframe">Embed map or video</label>
    <textarea name="embedded_iframe" class="form-control" id="post_iframe" rows="3"><?=$iframe?></textarea>
  </div>
  <div class="form-group">
    <label for="post_img">Upload image</label>
    <input type="file" name="img_file" class="form-control-file" id="img_file" aria-describedby="fileHelp">
    <small id="fileHelp" class="form-text error-text text-warning"><?=$imgErrors?></small>
  </div>
  <button type="submit" class="btn btn-primary">Publish</button>

</form>


<?php

require_once 'footer.php';