
<script>
var arcades = [];
var all_options = <?php echo json_encode($product_config_all);
?>;
</script>
<?php
$this->load->model('catalog/product_options');
$options_arcade = $this->model_catalog_product_options->gerProductOptions($product_id);



echo "<b>Arcade</b><br /><br />";
?>
<div id="option-arcade" class="option">
    <?php
    $index = 0;
    foreach ($options_arcade as $option_v) {
        ?>
        <span style="margin-right:10px;">
            <input db_id="<?php echo $option_v['option_id']; ?>" index="<?php echo $index ?>" type="radio" name="option[arcade]" 
                   value="<?php echo $option_v['option_id']; ?>" 
                   id="option-value-<?php echo $option_v['option_id']; ?>" />
            <label for="option-value-<?php echo $option_v['option_id']; ?>"><?php echo $option_v['value']; ?>

            </label>
        </span>
        <?php
        $index++;
    }
    ?>
</div>
<br/>

<?php
echo "<b>Tamanho</b><br /><br />";
?>
<div id="option-tom" class="option">

</div>
<br/>
<?php
echo "<b>Cor</b><br /><br />";
?>

<div id="option-cor" class="option">

</div>
<input type="hidden" id="conf_option_id" name="option[conf_id]" value="" />

<script>
    $(function() {
        $("#option-arcade input").click(function() {
            url = "?route=product/conf_product/options&product_id=<?php echo $product_id; ?>";
            url += "&option_key=tamanho&option[arcade]=" + $(this).val();
            $.getJSON(url, function(data) {
                renderToms(data)
            });
            //renderToms(arcades[index_v]);

        })
        $("#option-tom input").live('click', function() {
            
            
            url = "?route=product/conf_product/options&product_id=<?php echo $product_id; ?>";
            url += "&option_key=cor&option[tamanho]=" + $(this).val();
            $.getJSON(url, function(data) {
                console.log(data);
                renderCor(data);
            });

//            
        })
    })

    function renderToms(toms) {
        htm = "";
        $.each(toms, function(k, v) {
            index = 0;
            console.log(v);
            htm += '<span style="margin-right:10px;">' +
                    '<input index="' + index + '" type="radio" name="option[tamanho]"' +
                    'value="' + v['option_id'] + '" ' +
                    'id="option-value-' + v['option_id'] + '" />' +
                    '<label for="option-value-' + v['option_id'] + '">' + v['value'] +
                    '</label>' +
                    '</span>';
            index++;
        })

        $("#option-tom").html(htm);
    }

    function renderCor(cors, tom_value) {

        htm = "";
        disabled ='';

        $.each(cors, function(k, v) {
            htm += '<span style="margin-right:10px;">' +
                    '<input  type="radio" name="option[cor]"' +
                    'value="' + v['option_id'] + '" ' +
                    'id="option-value-' + v['option_id'] + '" ' + disabled + ' ' + v['value'] + ' />' +
                    '<label for="option-value-' + v['option_id'] + '">' + v['value'] +
                    '</label>' +
                    '</span>';
        })

        $("#option-cor").html(htm);

    }
</script>