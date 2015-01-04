<?php echo $header; ?>
<div id="content">
    <div class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
        <?php } ?>
    </div>
    <?php if ($error_warning) { ?>
    <div class="warning"><?php echo $error_warning; ?></div>
    <?php } ?>
    <div class="box">
        <div class="heading">
            <h1><img src="view/image/category.png" alt="" /> <?php echo $heading_title; ?></h1>
            <div class="buttons"><a onclick="$('#form').submit();" class="button"><?php echo $button_save; ?></a><a href="<?php echo $cancel; ?>" class="button"><?php echo $button_cancel; ?></a></div>
        </div>
        <div class="content">

            <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
                <div id="tab-general">


                    <div id="language">
                        <table class="form">
                            <tr>
                                <td><span class="required">*</span> <?php echo $entry_name; ?></td>
                                <td><?php foreach ($languages as $language) { ?>
                                    <?php
                                        if($language['code']=='en'){
                                    ?>
                                        <input type="text" name="name" value="<?php echo $name; ?>" />
                                    <?php
                                     }
                                     else {
                                      $value_other = "name_".$language['code'];
                                    ?>
                                    <input type="text" name="name_<?php echo $language['code']; ?>" value="<?php echo $$value_other ; ?>" />
                                    <?php
                                     }
                                    ?>
                                    <img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /><br />
                                    <?php if (isset($error_name[$language['language_id']])) { ?>
                                    <span class="error"><?php echo $error_name[$language['language_id']]; ?></span><br />
                                    <?php } ?>
                                    <?php } ?></td>
                            </tr>

                        </table>
                    </div>

                </div>

            </form>
        </div>
    </div>    
</div>    
<?php echo $footer; ?>