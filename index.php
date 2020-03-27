<?php

require_once 'db.php';

$sql = "SELECT * FROM mecms_posts
        WHERE active = 1
        ORDER BY date_publish DESC";

$stmt = $db->prepare($sql);
$stmt->execute();

$blogPosts = "";
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $title = htmlspecialchars($row['title']);
    $body = htmlspecialchars_decode($row['body']);
    $date = htmlspecialchars($row['date_publish']);
    $search = ['<script>', '</script>'];
    $replacements = ['&lt;script&gt;', '&lt;&sol;script&gt;'];

    $body = str_replace($search, $replacements, $body);

    $blogPosts .= "
   <div class='card mb-4'>
    <img class='card-img-top' src='http://placehold.it/750x300' alt='Card image cap'>
    <div class='card-body'>
      <h2 class='card-title'>$title</h2>
      $body
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
  <title>ME-CMS Blog</title>
</head>

<body class="container">
  <h1>Blog posts</h1>

  <?=$blogPosts?>









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