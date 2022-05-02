<?php

?>
<ul class="nav nav-pills">
    <li role="presentation"><a href=<?php echo $vars['modulelink'] ?>>Home</a></li>
    <li role="presentation" class="active"><a href=<?php echo $vars['modulelink'] . '&action=add' ?>>Add Topic</a></li>
</ul>

<h5>Add New Topics For Departments</h5>
<br>
<br>
<form action="" method="post">
    <label for="select">Select Your Department </label><br>
    <select class="select-inline-long" style="background: cornflowerblue;color: white" name="dept_id" id="select">
        <option value="none">None</option>
        <?php collect($results['departments']['department'])->each(function ($item) { ?>
            <option value="<?php echo $item['id'] ?>"> <?php echo $item['name'] ?> </option>
        <?php }); ?>
    </select><br><br>
    <label for="select">Select Your Group Service </label><br>
    <select class="select-inline-long" style="background: #b7c0d0;color: #3d58bd" name="gid" id="select">
        <option value="none">None</option>
        <?php collect($productGroup)->each(function ($item) { ?>
            <option value="<?php echo $item['id'] ?>"> <?php echo $item['name'] ?> </option>
        <?php }); ?>
    </select>
    <br><br><br>
    <label for="text-area">Enter Your Topics</label><br>
    <textarea name="topic" id="text-area" class="input-group" style="width: 250px;height: 100px"></textarea>
    <br>
    <input type="submit" name="sub" class="btn btn-success" value="Add Topics">
</form>
