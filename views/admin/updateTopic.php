<?php

?>
<br>

<h5>Update Your Data</h5>
<form method="post">
    <label for="dep">Enter New Department Name</label><br>
    <select class="select-inline-long" style="background: cornflowerblue;color: white" name="dept_name" id="select">
        <option value="none">None</option>
        <?php collect($results['departments']['department'])->each(function ($item) use ($data) { ?>
            <option value="<?php echo $item['name'] ?>"
                <?php echo $item['name'] == $data[0]['department_name'] ? 'selected' : '' ?>>
                <?php echo $item['name'] ?> </option>
        <?php }); ?>
    </select>
    <br>
    <br>
    <input type="hidden" value="<?php echo $_POST['id'] ?>" name="id">
    <label for="txt">Update Your Topic </label><br>
    <textarea name="text" id="txt"><?php echo $data[0]['topics'] ?></textarea><br>
    <input type="submit" name="update-data" value="Update" class="btn btn-success">
</form>
