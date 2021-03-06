<?php
require_once '../db.php';

require_once 'functions.php';
$imgErrors = '';
$img_choosen = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && !isset($_POST['update'])) {

    $id = htmlspecialchars($_POST['post_id']);

    $sql = 'SELECT * FROM mecms_posts
            WHERE id = :id';
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $title = htmlspecialchars($row['title']);
        $body = strip_tags(htmlspecialchars_decode($row['body']));

        $iframe = htmlspecialchars_decode($row['iframe']);
        $iframe = scriptCleaning($iframe);

        $img = $row['img'];
    }

}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {

    require_once 'processing_update.php';
    $title = $title_p;
    $body = $body_p;
    $iframe = $iframe_p;
}

if ($img !== null) {
    $img_choosen .= "<img class='update-img' src='../images/$img'>
                  <fieldset class='form-group'>
                    <legend>Image alternatives</legend>
                    <div class='form-check disabled'>
                      <label class='form-check-label'>
                        <input class='form-check-input' name='img_checkbox' type='checkbox' value='delete_img'>
                        Delete image
                      </label>
                    </div>
                  </fieldset>";
}
require_once 'header.php';

?>
<form action="#" method="POST" enctype="multipart/form-data">
  <div class="form-group">
    <label for="post_title">Title*</label>
    <input type="text" name="title" value="<?=$title?>" id="post_title" class="form-control" placeholder="Title"
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
  <?=$img_choosen?>
  <div class="form-group">
    <label for="post_img">Select new image</label>
    <input type="file" name="img_file" class="form-control-file" id="img_file" aria-describedby="fileHelp">
    <small id="fileHelp" class="form-text error-text text-warning"><?=$imgErrors?></small>
  </div>
  <input type="hidden" name="update" value="true">
  <input type="hidden" name="id" value="<?=$id?>">
  <button type="submit" class="btn btn-primary">Save</button>

</form>




<?php
require_once 'footer.php';