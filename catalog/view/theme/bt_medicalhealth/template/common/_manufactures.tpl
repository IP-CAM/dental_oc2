<?php $this->load->model('catalog/manufacturer'); ?>
<?php
$manufactures = $this->model_catalog_manufacturer->getManufacturers();

$manu_facts = isset($this->request->get['manu_f'])?explode(',',$this->request->get['manu_f']):array();

$video_f = isset($this->request->get['video_filter'])?$this->request->get['video_filter']:'';
$uri = str_replace("amp;","",$_SERVER['REQUEST_URI']);

$query_strings = explode("&",$_SERVER['QUERY_STRING']);
$query_string_arr  = array();


foreach($query_strings as $query){
    $key = explode("=",$query);
    $query_string_arr[$key[0]] = preg_replace("/amp;/", "&", $query);
}

$uri = "?".implode("",$query_string_arr);

?>
<div id="column-left" class="four columns">
    <div class="main-column-left">
     
        <?php //include_once("catalog/view/theme/bt_medicalhealth/template/common/_manufactures.php"); ?>
        <div class="box category">
            <div class="box-heading">Filtro por vídeo</div>
            <div class="box-content">
                <div class="box-category">
                    <ul>
                        <li>
                            <input name="video" type="radio" class="video" value="video" />
                            Com Vídeo
                        </li>
                        <li>
                            <input name="video" type="radio" class="video"  
                            value="no_video" />
                            Sem Vídeo
                        </li>
                    </ul>
                </div>
            </div>
        </div>

    </div>

</div>

<script>
    Object.defineProperty(Array.prototype, "remove", {
        enumerable: false,
        value: function(item) {
            var removeCounter = 0;

            for (var index = 0; index < this.length; index++) {
                if (this[index] === item) {
                    this.splice(index, 1);
                    removeCounter++;
                    index--;
                }
            }
            return removeCounter;
        }
    });
    var manu_factures = [];
    manu_factures = <?php  echo json_encode($manu_facts); ; ?> ;
    var video_filter = '<?php  echo $video_f; ; ?>' ;
    var uri = decodeURI(encodeURI('<?php echo $uri; ?>'));
    var split_uri = uri.split("&");
    
        function replaced_values(split_uri,key,value){
            new_arr = [];
            t_value = "";
            $(split_uri).each(function(k,v){ 

                if (v.search(key)!=-1){
                   v = v.split("=");
                   v[1] =  value;
                   v = v.join("=");
                }
                else {
                    t_value = key+"="+value;
                    new_arr.push(v); 
                }
                
            })
            if(t_value!=''){
               new_arr.push(t_value); 
            }
            
            return new_arr.join("&");
        }    
        $(function() {

            for (ob in manu_factures) {
                $("#manuf_" + manu_factures[ob]).prop("checked", 'checked');
            }
            $(".manu_manuf").bind("click", function() {
                manu_factures = $.unique(manu_factures);

                if ($(this).is(':checked')) {
                    manu_factures.push($(this).val());
                }
                else {
                    remove_val = $(this).val();
                    manu_factures.remove(remove_val.toString());
                }
                
                url = uri;
                if (manu_factures.length > 0) {
                    //url = uri+'&manu_f=' + manu_factures.join(",");

                    url = replaced_values(split_uri,"manu_f",manu_factures.join(","));
                }

                console.log(url);
                window.location.href = url;


            })
            $("input.video[value='"+video_filter+"']").prop('checked',true);
            $("input.video").bind("click",function(){
               
                url = replaced_values(split_uri,"video_filter",$(this).val());
                console.log(url);
                window.location.href = url;
            })
        })

        function reload_page(){
            window.location = $("#boss_menu ul li:eq(1) a:eq(0)").attr("href");
        }
</script>    

