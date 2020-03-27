<?php

$table = "<table class='table'>
            <thead class='table-secondary'>
              <tr>
                <th scope='col'>id</th>
                <th scope='col'>Title</th>
                <th scope='col'>Body</th>
                <th scope='col'>Created at</th>
                <th scope='col'>Active</th>
                <th></th>
                <th></th>
              </tr>
            </thead>
            <tbody>";

$sql = 'SELECT * FROM mecms_posts';

$stmt = $db->prepare($sql);
$stmt->execute();

$classname = 'table-default';

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $id = htmlspecialchars($row['id']);
    $title = htmlspecialchars($row['title']);
    $body = htmlspecialchars(strip_tags(htmlspecialchars_decode($row['body'])));
    $date = htmlspecialchars($row['date_publish']);
    $active = $row['active'];

    $table .= "<tr class='$classname'>
                <th scope='row'>$id</th>
                <td>$title</td>
                <td>$body</td>
                <td>$date</td>
                <td>$active</td>
                <td><button type='button' class='btn btn-success'>Update</button></td>
                <td>
                  <form action='delete.php' method='POST'>
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

echo $table;
