<?php echo form_open('rate_add'); ?>
<div class="container mt-3 col-md-6">
    <!-- <center>Rate Event: <?php echo $rating_2['event_name'] ?></center> -->
    <div class="mt-3 form-group">
    <select class="form-control">
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
    </select>

        <textarea name="desc" class="form-group form-control my-3" rows="3"></textarea>
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>
<?php form_close(); ?>