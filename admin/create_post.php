<?php
require_once '../db.php';
require_once 'header.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once 'processing_post.php';

}

?>

<form action="#" method="POST" enctype="multipart/form-data">
  <div class="form-group">
    <label for="post_title">Title</label>
    <input type="text" name="title" id="post_title" class="form-control" placeholder="Title" aria-label="Post title">
  </div>
  <div class="form-group">
    <label for="post_body">Text</label>
    <textarea name="body" class="form-control" id="post_body" rows="3"></textarea>
  </div>
  <div class="form-group">
    <label for="post_iframe">Embed map or video</label>
    <textarea name="embedded_iframe" class="form-control" id="post_iframe" rows="3"></textarea>
  </div>
  <div class="form-group">
    <label for="post_img">Upload image</label>
    <input type="file" name="img_file" class="form-control-file" id="img_file" aria-describedby="fileHelp">
    <small id="fileHelp" class="form-text text-muted">This is some placeholder block-level help text for the above
      input. It's a bit lighter and easily wraps to a new line.</small>
  </div>
  <button type="submit" class="btn btn-primary">Publish</button>

</form>


<?php

require_once 'footer.php';