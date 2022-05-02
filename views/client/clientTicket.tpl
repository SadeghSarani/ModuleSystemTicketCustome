<h4 style="color: darkblue;text-align: center" >Form New Ticket </h4>
<br>
<div  style="text-align: center">
    <label for="product" style="width: 250px;background: white">Select Your Product</label><br>
    <select class="form-control" style="background: cornflowerblue;width: 250px;text-align: center" name="product" id="product" >
        <option value="">None</option>
        {foreach $service as $item}
            <option value={$item.id}>{$item.name}</option>
        {/foreach}
    </select>
</div>
<br>
<br>
<label for="dep">Select Your department : </label><br>
<select name="department" id="dep" style="width: 250px">

</select>
<br>
<br>
<label for="op">Select Your Subject:</label><br>
<select id="subject" name="op" style="width: 250px">

</select>
<br>
<br>
<label for="priority">Select Priority Ticket</label>
<br>
<select id="priority" name="op" style="width: 250px">

</select>
<br>
<br>
<span id="txt">

</span>
<br>
<input type="submit" name="submit" class="btn btn-success" id="sub">
<script>
    $('#product').change(function () {
        $.ajax({
            url: "index.php?m=supportSystem&action=product",
            type: "POST",
            data: {
                service_id: $('#product').val(),
            },
            success: function (result) {
                Result = JSON.parse(result);
                $('#dep').empty();
                $('#dep').append("<option value=''>Select</option>");
                Result.forEach(function (item) {
                    $('#dep').append("<option value=" + item.id + " >" + item.name + "</option>");
                });
            }
        });
    });
    $('#dep').change(function () {
        $.ajax({
            url: "index.php?m=supportSystem&action=subject",
            type: "POST",
            data: {
                service_id: $('#product').val(),
                department_id: $('#dep').val(),
            },
            success: function (result) {
                Result = JSON.parse(result);
                console.log(Result);
                $('#subject').empty();
                $('#subject').append("<option value=''>Select</option>");
                Result.forEach(function (item) {
                    $('#subject').append("<option value=" + item.topics + " >" + item.topics + "</option>");
                    $('#priority').append("<option value='None'> None </option>+<option value='low'> Low </option>" +
                        "<option value='medium'> Medium </option>" +
                        "<option value='High'> High </option>");
                    $('#txt').append("<textarea name='message' id='msg'> Enter Your Message </textarea>");
                });
            }
        });
    });
    $('#sub').click(function (e) {
        e.preventDefault();
        $.ajax({
            url: "index.php?m=supportSystem&action=submit",
            cache: false,
            type: "POST",
            data: {
                department_id: $('#dep').val(),
                subject: $('#subject').val(),
                service_id: $('#product').val(),
                priority: $('#priority').val(),
                message: $('#msg').val()
            },
            success: function (result) {
                result = JSON.parse(result);
            },
        });
    });
</script>

