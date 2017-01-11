<div class="container">
<?php if ($this->session->flashdata('error')): ?>
    <div class="alert alert-danger alert-dismissible center">
       <strong><?=$this->session->flashdata('error')?></strong>
    </div>
<?php endif; ?>
</div>
<div class="container">
    <div class="jumbotron">
        <?php echo form_open(); ?>
        <div class="form-group input-group-lg">
            <label for="reg_num">Registration Number:</label>
            <select name="reg_num" class="form-control" required>
                <option value=""> Select Car</option>
                <?php foreach ($cars as $car) : ?>
                    <option 
                        value="<?php echo $car->getRegId(); ?>"
                        <?php echo set_select('reg_num',$car->getRegId()); ?>>
                        <?php echo $car->getRegId().' - '.$car->getBrand().' - '.$car->getMake() ?> 
                    </option>
                <?php endforeach; ?> 
            </select>
            <?php echo form_error('reg_num', '<div class="alert alert-danger text-center">', '</div>'); ?>
        </div>
        <div class="form-group input-group-lg">
            <label for="location">Parking Location:</label>
            <select name="location" class="form-control" required>
                <option value="">Select Location</option>
                <?php foreach ($locations as $location) : ?>
                    <option 
                        value="<?php echo $location->getId(); ?>"
                        <?php echo set_select('location',$location->getId()); ?>>
                        <?= $location->getName()." | AED ".$location->getPrice().' | VAT: AED '.$location->getVat() ?> 
                    </option>
                <?php endforeach; ?> 
            </select>
            <?php echo form_error('location', '<div class="alert alert-danger text-center">', '</div>'); ?>
        </div>
        <div class="form-group input-group-lg">
            <label for="no_hour">Hours:</label>
            <input name="no_hour" min="1" required class="form-control" placeholder="How many hours?" type="Number" value="<?php echo set_value('no_hour'); ?>"
            />
            <?php echo form_error('no_hour', '<div class="alert alert-danger text-center">', '</div>'); ?>
        </div>
        <div class="form-group input-group-lg">
            <input class="btn btn-danger-outline btn-lg" type="submit" value="Park Car">
        </div>
        <?php echo form_close(); ?>
    </div>
</div>