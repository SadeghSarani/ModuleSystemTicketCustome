<?php

?>
<ul class="nav nav-pills">
    <li role="presentation" class="active"><a href=<?php echo $vars['modulelink'] ?>>Home</a></li>
    <li role="presentation"><a href=<?php echo $vars['modulelink'] . '&action=add' ?>>Add Topic</a></li>
</ul>
<table class="table table-dark">
    <thead>
    <tr>

        <th scope="col">id</th>
        <th scope="col">Department</th>
        <th scope="col">Group Service</th>
        <th scope="col">Topic</th>
        <th scope="col">Update</th>
        <th scope="col">Delete</th>
    </tr>
    </thead>
    <tbody>
    <?php collect($departments)->each(function ($item) { ?>
        <tr>
            <td><?php echo $item['id'] ?></td>
            <td><?php echo $item['dept_id'] ?></td>
            <td><?php echo $item['gid'] ?></td>
            <td><?php echo $item['topics'] ?></td>
            <form method="post">
                <form method="post">
                    <td>
                        <input type="hidden" value="<?php echo $item['id'] ?>" name="id">
                        <input type="submit" name="update" value="Update" class="btn btn-warning">
                    </td>
                </form>
                <form method="post">
                    <td>
                        <input type="hidden" value="<?php echo $item['id'] ?>" name="id">
                        <input type="submit" value="Delete" name="delete" class="btn btn-danger">
                    </td>
                </form>
        </tr>
    <?php }); ?>
    </tbody>
</table>