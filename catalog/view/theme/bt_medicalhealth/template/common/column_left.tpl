<?php if ($modules) { ?>
<div id="column-left" class="four columns">
    <div class="main-column-left">
        <?php foreach ($modules as $module) { ?>
        <?php echo $module; ?>
        <?php } ?>
        <?php include_once("catalog/view/theme/bt_medicalhealth/template/common/_manufactures.tpl"); ?>

    </div>
</div>
<?php } ?> 
