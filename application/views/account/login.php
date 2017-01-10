<div class="container">
<?php if ($this->session->flashdata('message')): ?>
    <div class="alert alert-warning alert-dismissible hidden-xs center">
        <?=$this->session->flashdata('message')?>
    </div>
<?php endif; ?>
</div>


<div class="container">
    <div class="jumbotron">
 <?php if (isset($error)): ?>
    <div class="alert alert-danger">
        <?=$error;?>
    </div>
<?php endif; ?>   
<?php echo form_open(); ?>

<div class="form-group input-group-lg">
    <label for="email" >Email:</label>
    <input name="email"  class="form-control" placeholder="Enter Email" type="email" value="<?php echo set_value('email'); ?>" />
    <?php echo form_error('email','<div class="alert alert-danger text-center">','</div>'); ?>      
        
</div>

<div class="form-group input-group-lg">
    <label for="password">Password:</label>
    <input name="password"  class="form-control" placeholder="Enter Password" type="password" required="required"  />
    <?php echo form_error('password','<div class="alert alert-danger text-center">','</div>'); ?>      
</div>


<div class="form-group input-group-lg">
    <input  class="btn btn-danger"  type="submit" value="Login">   
</div>

    
<?php echo form_close(); ?>


    </div>
</div>
