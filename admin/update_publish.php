<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once '../db.php';

    $id = $_POST['post_id'];
    $active = $_POST['active'];

    if ($active == '1') {
        $publishState = 0;
    } else if ($active == '0') {
        $publishState = 1;
    }

    $sql = "UPDATE mecms_posts SET active = :publish_state
            WHERE id = :id";

    $stmt = $db->prepare($sql);
    $stmt->bindParam(':publish_state', $publishState);
    $stmt->bindParam(':id', $id);

    $stmt->execute();

}

header('Location:index.php');