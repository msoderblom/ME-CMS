<?php

require_once 'db.php';
require_once 'admin/functions.php';

$sql = "SELECT * FROM mecms_posts
        WHERE active = 1
        ORDER BY date_publish DESC";

$stmt = $db->prepare($sql);
$stmt->execute();

$blogPosts = "";
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $title = htmlspecialchars($row['title']);
    $body = htmlspecialchars_decode($row['body']);
    $img = $row['img'];
    $iframe = htmlspecialchars_decode($row['iframe']);
    $iframe = strip_tags($iframe, '<iframe>');
    $iframe = scriptCleaning($iframe);

    $date = htmlspecialchars($row['date_publish']);

    $body = scriptCleaning($body);

    $imgtag = '';
    if ($img) {
        $imgtag = "<img class='card-img-top' src='images/$img' alt='$img'>";
    }
    $iframetag = '';
    if ($iframe) {
        $iframetag = $iframe;
    }

    $blogPosts .= "
   <div class='card mb-4'>
   $imgtag
    <div class='card-body'>
      <h2 class='card-title'>$title</h2>
      $body
      $iframetag
    </div>
    <div class='card-footer text-muted'>
      Posted: $date
    </div>
  </div>";

}

?>

<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link href="https://stackpath.bootstrapcdn.com/bootswatch/4.4.1/lux/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-oOs/gFavzADqv3i5nCM+9CzXe3e5vXLXZ5LZ7PplpsWpTCufB7kqkTlC9FtZ5nJo" crossorigin="anonymous">
  <link rel="stylesheet" href="style.css">
  <title>ME-CMS Blog</title>
</head>

<header class="blog-header navbar navbar-expand-lg navbar-dark bg-primary">
  <h1 class="navbar-brand">
    <a class="navbar-brand" href="index.php">ME-CMS Blog Feed</a>
  </h1>
</header>
<main class="container">

  <?=$blogPosts?>

</main>


<footer class="container">
  <span>&copy 2020 ME CMS</span>
  <p>Created By <a href="https://github.com/EvelinaBjorkman">Evelina Björkman</a> & <a
      href="https://github.com/msoderblom">Matilda Söderblom</a></p>
</footer>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
  integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
  integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
</script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
  integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
</script>
</body>

</html>