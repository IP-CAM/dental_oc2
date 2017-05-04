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
                                <td>
                                   <input type="text" name="name" value="<?php echo $name; ?>" />
                                   <input type="hidden" name="type" value="<?php echo $type; ?>" />
                                </td>
                            </tr>

                        </table>
                    </div>

                </div>

            </form>
        </div>
    </div>    
</div>    
<?php echo $footer; ?>