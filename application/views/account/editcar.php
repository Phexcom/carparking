<div class="container">
    <div class="jumbotron">
        <?php if ($this->session->flashdata('error')): ?>
        <div class="alert alert-danger alert-dismissible hidden-xs center">
            <strong><?=$this->session->flashdata('error');?></strong>
        </div>
        <?php endif; ?>
        <?php echo form_open(); ?>
        <div class="form-group input-group-lg">
            <label for="color">Car Color:</label>
            <input name="color" class="form-control" placeholder="Enter Car color" type="text" value="<?php echo set_value('color', $car->getColor()); ?>"
            />
            <?php echo form_error('color','<div class="alert alert-danger text-center">','</div>'); ?>
        </div>
        <div class="form-group input-group-lg">
            <label for="make">Car make:</label>
            <input name="make" class="form-control" placeholder="Enter Car make" type="text" value="<?php echo set_value('make', $car->getMake()); ?>"
            />
            <?php echo form_error('make','<div class="alert alert-danger text-center">','</div>'); ?>
        </div>
        <div class="form-group input-group-lg">
            <label for="brand">Car brand:</label>
            <input name="brand" class="form-control" placeholder="Enter Car brand" type="text" value="<?php echo set_value('brand', $car->getBrand()); ?>"
            />
            <?php echo form_error('brand','<div class="alert alert-danger text-center">','</div>'); ?>
        </div>
        <div class="form-group input-group-lg">
            <input class="btn btn-danger-outline btn-lg" type="submit" value="Update Car">
        </div>
        <?php echo form_close(); ?>
    </div>
</div>