<?php

require_once '../db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  
  $id = htmlspecialchars($_POST['post_id']);

  $sql = 'DELETE FROM mecms_posts WHERE id = :id';

  $stmt = $db->prepare($sql);
  $stmt->bindParam(':id', $id);
  $stmt->execute();

}

header('Location: index.php');
