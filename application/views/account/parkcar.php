
<div class="container">
    <div class="jumbotron">
 <?php if (isset($error)): ?>
    <div class="alert alert-danger alert-dismissible hidden-xs center">
        <strong><?=$error;?></strong>
    </div>
<?php endif; ?>   
<?php echo form_open(); ?>

<div class="form-group input-group-lg">
    <label for="reg_num" >Registration Number:</label>
    <select name="reg_num" class="form-control">
        <option value="" > Select Car</option>

        <?php foreach ($cars as $car): ?>
            <option value=" <? echo  $car->getRegId()?>" >
                <?= $car->getRegId().' - '.$car->getBrand().' - '.$car->getMake() ?> 
            </option>
        <?php endforeach; ?> 
    </select>
    <?php echo form_error('reg_num','<div class="alert alert-danger text-center">','</div>'); ?>          
</div>

<div class="form-group input-group-lg">
    <label for="locate" >Parking Location:</label>
    <select name="locate" class="form-control">
        <option value="" > Select Location</option>
        <?php foreach ($locations as $location): ?>
            <option value="<?php echo $location->getId(); ?>" >
                <?= $location->getName().' Price: AED '.$location->getPrice().'  Vat: AED'.$location->getVat() ?> 
            </option>
        <?php endforeach; ?> 
    </select>
    <?php echo form_error('locate','<div class="alert alert-danger text-center">','</div>'); ?>          
</div>

<div class="form-group input-group-lg">
    <label for="no_hour" >Hours:</label>
    <input name="no_hour"  class="form-control" placeholder="How many hours?" type="Number" value="<?php echo set_value('no_hour'); ?>" />
    <?php echo form_error('no_hour','<div class="alert alert-danger text-center">','</div>'); ?>      
        
</div>






<div class="form-group input-group-lg">
    <input  class="btn btn-danger-outline btn-lg"  type="submit" value="Park Car">   
</div>

    
<?php echo form_close(); ?>


    </div>
</div>