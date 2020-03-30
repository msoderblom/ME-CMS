<?php

$table = "<table class='table'>
            <thead class='table-secondary'>
              <tr>
                <th scope='col'>id</th>
                <th scope='col'>Title</th>
                <th scope='col'>Body</th>
                <th scope='col'>Created at</th>
                <th scope='col'>Published</th>
                <th></th>
                <th></th>
              </tr>
            </thead>
            <tbody>";

$sql = 'SELECT * FROM mecms_posts
        ORDER BY date_publish DESC';

$stmt = $db->prepare($sql);
$stmt->execute();

$classname = 'table-default';

$published = "
<label class='switch'>
<input class='toggleSwitch' type='checkbox' name='activeToggle' value='1' checked>
<span class='slider round'></span>
</label>";
$unpublished = "
<label class='switch'>
<input class='toggleSwitch' type='checkbox' name='activeToggle' value='0'>
<span class='slider round'></span>
</label>";

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $id = htmlspecialchars($row['id']);
    $title = htmlspecialchars($row['title']);
    $body = htmlspecialchars(strip_tags(htmlspecialchars_decode($row['body'])));
    $body = scriptCleaning($body);
    $body = substr($body, 0, 30) . '...';
    $date = htmlspecialchars($row['date_publish']);
    $active = $row['active'];

    /*  $published = " <input type='checkbox' name='active' value='1' class='custom-control-input' id='customSwitch1$id' checked=''>
    <label class='custom-control-label' for='customSwitch1'>Published</label>";
    $unpublished = "<input type='checkbox' name='active' value='0' class='custom-control-input' disabled='' id='customSwitch2$id'>
    <label class='custom-control-label' for='customSwitch2'>Unpublished</label>"; */

    if ($active == 0) {
        $toggle = $unpublished;
    } else {
        $toggle = $published;
    }

    $table .= "<tr class='$classname'>
                <th scope='row'>$id</th>
                <td>$title</td>
                <td>$body</td>
                <td>$date</td>
                <td class='btn-td'id='$id'>
                  <form action='update_publish.php' method='POST'>
                    <div class='form-group'>
                      <div class='custom-control custom-switch'>
                        $toggle
                      </div>
                    </div>
                    <input type='hidden' name='post_id' value='$id'>
                    <input type='hidden' name='active' value='$active'>
                  </form>
                </td>
                <td class='btn-td'>
                  <form action='update.php' method='POST'>
                    <button type='submit' class='btn btn-success'>Edit</button>
                    <input type='hidden' name='post_id' value='$id'>
                  </form>
                </td>
                <td class='btn-td'>
                  <form action='delete.php' method='POST' class='deleteForm'>
                    <button type='submit' class='btn btn-warning'>Delete</button>
                    <input type='hidden' name='post_id' value='$id'>
                  </form>
                </td>
              </tr>";

    if ($classname === 'table-default') {
        $classname = 'table-active';
    } else {
        $classname = 'table-default';
    }
}

$table .= "</tbody>
          </table>";

echo '<a type="button" href="create_post.php" class="btn btn-info new-post-btn">Create New Post</a>';
echo $table;