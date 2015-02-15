<div class="cart">
    <div><span class="calculate_shipping"><?php echo $text_postal_code; ?></span>
        <input type="text" id="zip_postal_code" name="zip_postal_code" size="2" value="" />
    </div>
    <div id="loading_status" style="display:none">
        Carregando...
    </div>
    <div id="error_box" style="display:none;border:1px solid red;color:red">
        
    </div>
    <div id="result_box" style="display:none;border:1px solid green;color:green">
        <ul>
            
        </ul>
    </div>
</div>
<div>
    <span class="orange_button">
        <input type="button" value="<?php echo $button_postal_code; ?>" id="button-postal" class="button"  />
    </span>
</div>

<script>
    var empty_error = '<?php echo $postal_error_empty ?>';
    var product_id ='<?php echo $_GET['product_id'] ?>';
    $(function() {
        $("#button-postal").click(function() {
            zip_code = $.trim($("#zip_postal_code").val());
            var sendInfo = {
                zip_code: zip_code,
                product_id: product_id,
            };
            $("#loading_status").show();
            if (zip_code != '') {
                $.ajax({
                    type: "POST",
                    url: "?route=checkout/shipping_calculator",
                    dataType: "json",
                    success: function(msg) {
                        $("#loading_status").hide();
                        if(typeof(msg['correios']['error'])!="undefined" && msg['correios']['error']!=false){
                        
                            $("#error_box").html(msg['correios']['error']);
                            $("#error_box").show();
                            $("#error_box").hide("fade", {}, 5000)
                        }
                        else {
                            $("#result_box ul").html("");
                            for(ob in msg['correios']['quote']){
                                qut = msg['correios']['quote'];
                                li_ht = "<li><span>"+qut[ob]['title']+"</span>";
                                li_ht+='<div></div>';
                                li_ht+= "<label>"+qut[ob]['code']+"</label>";
                                li_ht+= "<label>"+qut[ob]['text']+"</label>";
                                li_ht+= "</li>";
                                $("#result_box ul").append(li_ht); 
                            }
                            $("#result_box").show();
                            $("#result_box").hide("fade", {}, 10000)
                        }
                        
                    },
                    data: sendInfo
                });
            }
            else {
                alert(empty_error);
                 $("#loading_status").hide();
            }

        })
    })
</script> 
<style>
    #result_box ul li {
        margin-bottom: 10px;
        display: block;
        color:black;    
        border-top: 1px solid #f2f2f2;
        padding-left:2px;
    }
    
    #result_box ul li>span {
        font-size: 14px;
        font-weight: bold;
    }
    #result_box ul li>label {
        font-size: 12px;
        margin-top: 10px;
        margin-left: 10px;
        clear:both;
    }
</style>    