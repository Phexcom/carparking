<?php if ($this->session->flashdata('message')): ?>
    <div class="alert alert-info">
        <?=$this->session->flashdata('message')?>
    </div>
<?php endif; ?>


<div class="container">
    <div class="jumbotron">
<?php echo form_open(); ?>

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
    <input  class="btn btn-danger"  type="submit" value="Login">   
</div>

    
<?php echo form_close(); ?>


    </div>
</div>
