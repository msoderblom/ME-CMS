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
                <td>
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
                <td>
                  <form action='update.php' method='POST'>
                    <button type='submit' class='btn btn-success'>Edit</button>
                    <input type='hidden' name='post_id' value='$id'>
                  </form>
                </td>
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
?>

<script>
const toggleinputs = document.querySelectorAll('.toggleSwitch');

toggleinputs.forEach(toggle => {
  toggle.addEventListener('change', sendForm);
});

function sendForm(e) {
  //e.currentTarget.form.submit()
  //console.log(this.form);
  this.form.submit();

}
</script>

<style>
/* The switch - the box around the slider */
.switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}

/* Hide default HTML checkbox */
.switch input {
  opacity: 0;
  width: 0;
  height: 0;
}

/* The slider */
.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked+.slider {
  background-color: #2196F3;
}

input:focus+.slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked+.slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}
</style>