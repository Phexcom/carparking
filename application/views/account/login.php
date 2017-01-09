<?php if ($this->session->flashdata('message')): ?>
    <div class="alert alert-info">
        <?=$this->session->flashdata('message')?>
    </div>
<?php endif; ?>