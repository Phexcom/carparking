
<div class="container">
    <div class="jumbotron">
<?php echo form_open(); ?>

<div class="form-group input-group-lg">
    <label for="name" >Name:</label>
    <input name="name" class="form-control"  placeholder="Enter name" type="text" value="<?php echo set_value('name'); ?>" />
    <?php echo form_error('name','<div class="alert alert-danger text-center">','</div>'); ?>      
</div>

<div class="form-group input-group-lg">
    <label for="address" >Address:</label>
    <input name="address"  class="form-control" placeholder="Enter Address" type="text" value="<?php echo set_value('address'); ?>" />
    <?php echo form_error('address','<div class="alert alert-danger text-center">','</div>'); ?>      
</div>

<div class="form-group input-group-lg">
    <label for="card">Card:</label>
    <input name="card"  class="form-control" placeholder="Enter Card" type="text" value="<?php echo set_value('card'); ?>" />
    <?php echo form_error('card','<div class="alert alert-danger text-center">','</div>'); ?>      
</div>

<div class="form-group input-group-lg">
    <label for="email" >Email:</label>
    <input name="email"  class="form-control" placeholder="Enter Email" type="email" value="<?php echo set_value('email'); ?>" />
    <?php echo form_error('email','<div class="alert alert-danger text-center">','</div>'); ?>      
        
</div>

<div class="form-group input-group-lg">
    <label for="password">Password:</label>
    <input name="password"  class="form-control" placeholder="Enter Password" type="password"  />
    <?php echo form_error('password','<div class="alert alert-danger text-center">','</div>'); ?>      
</div>

<div class="form-group input-group-lg">
    <label for="password_confirm">Confirm Password:</label>
    <input name="password_confirm"  class="form-control" placeholder="Confirm Password" type="password" />
    <?php echo form_error('password_confirm','<div class="alert alert-danger text-center">','</div>'); ?>      
</div>

<div class="form-group input-group-lg">
    <input  class="btn btn-danger"  type="submit" value="Register">   
</div>

    
<?php echo form_close(); ?>


    </div>
</div>
