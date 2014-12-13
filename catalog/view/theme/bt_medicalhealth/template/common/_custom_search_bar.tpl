<?php
$this->load->model('catalog/category');
$categories = $this->model_catalog_category->get_RecursiveCategory();
$categories = $categories['categories'];
if (isset($this->request->get['category_id'])) {
$category_id = $this->request->get['category_id'];
} else {
$category_id = 0;
} 

if (isset($this->request->get['search'])) {
$search = $this->request->get['search'];
} else {
$search = '';
} 

$button_search = $this->language->get('button_search');
?>
<div>
    <?php if ($search) { ?>
    <input type="text" name="search" value="<?php echo $search; ?>" />
    <?php } else { ?>
    <input type="text" name="search" value="<?php echo $search; ?>" onclick="this.value = '';" onkeydown="this.style.color = '000000'" style="color: #999;" />
    <?php } ?>
</div>
<div>
    <select name="category_id">
        <option value="0"><?php echo $this->language->get('text_category'); ?></option>
        <?php foreach ($categories as $category_1) { ?>
        <?php if ($category_1['category_id'] == $category_id) { ?>
        <option value="<?php echo $category_1['category_id']; ?>" selected="selected"><?php echo $category_1['name']; ?></option>
        <?php } else { ?>
        <option value="<?php echo $category_1['category_id']; ?>"><?php echo $category_1['name']; ?></option>
        <?php } ?>
        <?php foreach ($category_1['children'] as $category_2) { ?>
        <?php if ($category_2['category_id'] == $category_id) { ?>
        <option value="<?php echo $category_2['category_id']; ?>" selected="selected">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $category_2['name']; ?></option>
        <?php } else { ?>
        <option value="<?php echo $category_2['category_id']; ?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $category_2['name']; ?></option>
        <?php } ?>
        <?php foreach ($category_2['children'] as $category_3) { ?>
        <?php if ($category_3['category_id'] == $category_id) { ?>
        <option value="<?php echo $category_3['category_id']; ?>" selected="selected">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $category_3['name']; ?></option>
        <?php } else { ?>
        <option value="<?php echo $category_3['category_id']; ?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $category_3['name']; ?></option>
        <?php } ?>
        <?php } ?>
        <?php } ?>
        <?php } ?>
    </select>

</div>

<div class="buttons">
    <div class="left"><span class="orange_button"><input type="button" value="<?php echo $button_search; ?>" id="button-search2" class="button" /></span></div>
</div>

<script>
    $('#button-search2').bind('click', function() {
        url = 'index.php?route=product/search';

        var search = $('#custom_search_bar input[name=\'search\']').attr('value');

        if (search) {
            url += '&search=' + encodeURIComponent(search);
        }

        var category_id = $('#custom_search_bar select[name=\'category_id\']').attr('value');

        if (category_id > 0) {
            url += '&category_id=' + encodeURIComponent(category_id);
        }

        var sub_category = $('#custom_search_bar input[name=\'sub_category\']:checked').attr('value');

        if (sub_category) {
            url += '&sub_category=true';
        }

        var description = $('#custom_search_bar input[name=\'description\']:checked').attr('value');

        if (description) {
            url += '&description=true';
        }

        location = url;
    });
</script>    