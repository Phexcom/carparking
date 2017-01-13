
<div class="container">
    <div class="jumbotron">
 <?php if (isset($error)): ?>
    <div class="alert alert-danger alert-dismissible hidden-xs center">
        <strong><?=$error;?></strong>
    </div>
<?php endif; ?>   
<?php echo form_open(); ?>

<div class="form-group input-group-lg">
    <label for="name" >Name :</label>
    <input name="name"  class="form-control" placeholder="Edit Name" type="text" value="<?php echo set_value('name', $user->getName()); ?>" />
    <?php echo form_error('name','<div class="alert alert-danger text-center">','</div>'); ?>      
        
</div>

<div class="form-group input-group-lg">
    <label for="email" >Email :</label>
    <input name="email"  class="form-control" placeholder="Edit email" type="email" value="<?php echo set_value('email', $user->getEmail()); ?>" />
    <?php echo form_error('email','<div class="alert alert-danger text-center">','</div>'); ?>      
        
</div>

<div class="form-group input-group-lg">
    <label for="address" >Address :</label>
    <input name="address"  class="form-control" placeholder="Edit Address" type="text" value="<?php echo set_value('address', $user->getBillingAddress()); ?>" />
    <?php echo form_error('address','<div class="alert alert-danger text-center">','</div>'); ?>          
</div>



<div class="form-group input-group-lg">
    <input  class="btn btn-danger-outline btn-lg"  type="submit" value="Update User">   
</div>

    
<?php echo form_close(); ?>


    </div>
</div>