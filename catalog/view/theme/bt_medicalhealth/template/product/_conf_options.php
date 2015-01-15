
<script>
    var arcades = [];
    var all_options = <?php echo json_encode($product_config_all);?>;
</script>
<?php
$product_config_options_arc = $product_config_options['arcade'];

echo "<b>Arcade</b><br /><br />";
?>
<div id="option-arcade" class="option">
    <?php
    $index = 0;
    foreach ($product_config_options_arc as $option_v) {
        $json_data = $option_v['json_data'];
        $json_data = json_decode($json_data, true);
        echo "<script>";
        echo "arcades.push({" . $json_data['arcade'] . ":" . $option_v['json_data'] . "})";
        echo "</script>";
        ?>
        <span style="margin-right:10px;">
            <input db_id="<?php echo $option_v['id']; ?>" index="<?php echo $index ?>" type="radio" name="option[arcade]" 
                   value="<?php echo $json_data['arcade']; ?>" 
                   id="option-value-<?php echo $json_data['arcade']; ?>" />
            <label for="option-value-<?php echo $json_data['arcade']; ?>"><?php echo $product_config_all['arcade'][$json_data['arcade']]; ?>

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
<input type="hidden" id="conf_option_id" name="conf_option_id" value="" />
<script>
    $(function() {
        $("#option-arcade input").click(function() {
            
            index_v = $(this).attr("index");
            $("#conf_option_id").val($(this).attr("db_id"));
            renderToms(arcades[index_v]);

        })
        $("#option-tom input").live('click', function() {
            tom_value = $(this).val();
            console.log(index_v);
            arcade_index = $("#option-arcade input:checked").attr("index");
            renderCor(arcades[arcade_index], tom_value);
        })
    })

    function renderToms(toms) {
        htm = "";
        $.each(toms, function(k, v) {
            index = 0;
            $.each(v['toms'], function(kt, vt) {
                console.log(vt);
                htm += '<span style="margin-right:10px;">' +
                        '<input index="' + index + '" type="radio" name="option[tamanho]"' +
                        'value="' + vt['tom'] + '" ' +
                        'id="option-value-' + vt['tom'] + '" />' +
                        '<label for="option-value-' + vt['tom'] + '">' + all_options['tamanho'][vt['tom']] +
                        '</label>' +
                        '</span>';
                index++;
            })
        })

        $("#option-tom").html(htm);
    }

    function renderCor(cors, tom_value) {

        htm = "";
        $.each(cors, function(k, v) {
            $.each(v['toms'], function(kt, vt) {

                if (vt['tom'] == tom_value) {

                    $.each(vt['cors'], function(kv, vc) {
                        
                        htm += '<span style="margin-right:10px;">' +
                                '<input  type="radio" name="option[cor]"' +
                                'value="' + vc['cor'] + '" ' +
                                'id="option-value-' + vc['cor'] + '" />' +
                                '<label for="option-value-' + vc['cor'] + '">' + all_options['cor'][vc['cor']] +
                                '</label>' +
                                '</span>';
                    })

                }
            })
        })
        
         $("#option-cor").html(htm);

    }
</script>