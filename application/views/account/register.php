<?php echo validation_errors('<div class="alert alert-danger">','</div>') ?>
<?php echo form_open(); ?>
    <div style="background-color:#ccc;padding:2em">
        Name
        <input name="name" placeholder="Enter name" type="text" value="<?php echo set_value('name'); ?>" />
        <?php echo form_error('name','<div class="alert alert-danger">','</div>'); ?>
        Billing Address
        <input name="address" type="text" value="<?php echo set_value('address'); ?>" />
        Card
        <input name="card" type="text" value="<?php echo set_value('card'); ?>" />
        Email
        <input name="email" type="email" value="<?php echo set_value('email'); ?>" />
        Password
        <input name="password" type="password" />
        Confirm Password
        <input name="password_confirm" type="password" />
        <input type="submit" value="Register">
    </div>
    
<?php echo form_close(); ?>