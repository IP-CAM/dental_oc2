<div class="customer_information">
    <div>

        <div colspan="4">
            <?php
            $area_style = "";
            $area_style = "display:none;";
            $profession_input = "checkbox";
            if ($_GET['route'] == "account/register") {
                $area_style = "display:none;";
                $profession_input = "checkbox";
            }
            ?>
            <?php
            $customer_types = array(
                "Pessoa Física", "Pessoa Jurídica"
            );

            $i = 0;
            $checkd = '';
            //echo $payment_customer_type;
            foreach ($customer_types as $type) {
                if (!empty($payment_customer_type)) {
                    if ($payment_customer_type == $type) {
                        $checkd = 'checked="checked"';
                    } else {
                        $checkd = '';
                    }
                } else {
                    $checkd = '';
                    if ($i == 0) {
                        $checkd = 'checked="checked"';
                    } else {
                        $checkd = '';
                    }
                }
                ?>
                <input type="radio" class="cusomer_type"  name="payment_customer_type" value="<?php echo $type ?>" <?php echo $checkd; ?> /> 
                <label><?php echo $type ?></label>

                <?php
                $i++;
            }
            $checkd = '';
            ?>
        </div>
    </div>
    <div>
        <div colspan="4">

            <div class="customer" style="display:none" >
                <div>
                    <div >
                        <h2><?php echo $txt_payment_heading_customer; ?></h2>

                    </div>

                </div>
                <div>

                    <div style="display:none">
                        <?php echo $txt_payment_cad_name; ?>
                    </div>
                    <div style="display:none">
                        <input type="text" name="payment_cad_name" id="payment_cad_name" value="<?php echo isset($payment_cad_name) ? $payment_cad_name : ""; ?>" />
                    </div>
                    <div>
                        <?php echo $txt_payment_cad_dob; ?>
                    </div>
                    <div>
                        <input type="text" name="payment_cad_dob" id="payment_cad_dob"  value="<?php echo isset($payment_cad_dob) ? $payment_cad_dob : ""; ?>" />
                    </div>
                </div>
                <div>

                    <div>
                        <?php echo $txt_payment_cad_cpf; ?>
                        <span class="required">*</span>
                    </div>
                    <div>
                        <input type="text" name="payment_cad_cpf" id="payment_cad_cpf" value="<?php echo isset($payment_cad_cpf) ? $payment_cad_cpf : ""; ?>"  />
                        <?php if (!empty($error_payment_cad_cpf)) { ?>
                            <span class="error"><?php echo $error_payment_cad_cpf; ?></span>
                        <?php } ?>
                    </div>
                    <div>
                        <?php echo $txt_payment_cad_rg; ?>
                    </div>
                    <div>
                        <input type="text" name="payment_cad_rg" id="payment_cad_rg" value="<?php echo isset($payment_cad_rg) ? $payment_cad_rg : ""; ?>"/>
                    </div>
                </div>
                <div>

                    <div style="display:none">
                        <?php echo $txt_payment_cad_telefone; ?>
                    </div>
                    <div style="display:none">
                        <input type="text" name="payment_cad_telefone" id="payment_cad_telefone" value="<?php echo isset($payment_cad_telefone) ? $payment_cad_telefone : ""; ?>"/>
                    </div>
                    <label><?php echo $txt_payment_area_code; ?>
                        <span class="required">*</span>
                    </label>
                    <div>
                        <select id="payment_cad_area_code" name="payment_cad_area_code" style="width:80px">


                            <?php
                            foreach ($area_codes as $area_code) {
                                $selected = "";
                                if (!empty($payment_cad_area_code) && $area_code == $payment_cad_area_code) {
                                    $selected = "selected='selected' ";
                                }
                                ?>
                                <option <?php echo $selected; ?> value="<?php echo $area_code; ?>"><?php echo $area_code; ?></option>

                                <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div>
                        <?php echo $txt_payment_cad_celular; ?>
                    </div>
                    <div>
                        <input type="text" name="payment_cad_celular" id="payment_cad_celular" value="<?php echo isset($payment_cad_celular) ? $payment_cad_celular : ""; ?>" />
                    </div>

                </div>
                <div>

                    <div colspan="4">
                        <?php
                        $genders = array(
                            "Masculino", "Feminino"
                        );
                        foreach ($genders as $gend) {
                            $selected = "";
                            if (!empty($payment_cad_gender) && $payment_cad_gender == $gend) {
                                $selected = "checked='checked';";
                            }
                            ?>
                            <input type="radio"  name="payment_cad_gender" value="<?php echo $gend ?>" <?php echo $selected; ?> /> 
                            <label><?php echo $gend ?></label>

                            <?php
                        }
                        ?>

                    </div>

                </div>
            </div>

            <div class="account" style="display:none">
                <div>
                    <div>
                        <h2><?php echo $txt_payment_heading_account; ?></h2>

                    </div>

                </div>
                <div>

                    <div>
                        <?php echo $txt_payment_corop_name; ?>
                    </div>
                    <div>
                        <input type="text" name="payment_corop_name" id="payment_corop_name" value="<?php echo isset($payment_corop_name) ? $payment_corop_name : ""; ?>" />
                    </div>
                    <div>
                        <?php echo $txt_payment_corop_trade_name; ?>
                    </div>
                    <div>
                        <input type="text" name="payment_corop_trade_name" id="payment_corop_trade_name" value="<?php echo isset($payment_corop_trade_name) ? $payment_corop_trade_name : ""; ?>"/>
                    </div>
                </div>
                <div>

                    <div>
                        <?php echo $txt_payment_corop_cnpg; ?>
                        <span class="required">*</span>
                    </div>
                    <div>
                        <input type="text" name="payment_corop_cnpg" id="payment_corop_cnpg" value="<?php echo isset($payment_corop_cnpg) ? $payment_corop_cnpg : ""; ?>"  />
                        <?php if (!empty($error_payment_corop_cnpg)) { ?>
                            <span class="error"><?php echo $error_payment_corop_cnpg; ?></span>
                        <?php } ?>
                    </div>
                    <div> 
                        <?php echo $txt_payment_corop_responsible_name; ?>
                    </div>
                    <div>
                        <input type="text" id="payment_corop_responsible_name" 
                               name="payment_corop_responsible_name" 
                               value="<?php echo isset($payment_corop_responsible_name) ? $payment_corop_responsible_name : ""; ?>"/>
                    </div>
                </div>
                <div>

                    <div>
                        <?php echo $txt_payment_corop_telefone; ?>
                    </div>
                    <div>
                        <input type="text" name="payment_corop_telefone" 
                               id="payment_corop_telefone" 
                               value = "<?php echo isset($payment_corop_telefone) ? $payment_corop_telefone : ""; ?>"
                               />
                    </div>
                    <div>
                        <?php echo $txt_payment_corop_responsible_cell; ?>
                    </div>
                    <div>
                        <input type="text" name="payment_corop_responsible_cell" 
                               id="payment_corop_responsible_cell" value = "<?php echo isset($payment_corop_responsible_cell) ? $payment_corop_responsible_cell : ""; ?>" />
                    </div>
                </div>
                <div>

                    <div>
                        <?php echo $txt_payment_corop_state_registration; ?>
                    </div>
                    <div>
                        <input type="text" name="payment_corop_state_registration" 
                               id="payment_corop_state_registration" value="<?php echo isset($payment_corop_state_registration) ? $payment_corop_state_registration : ""; ?>" />
                    </div>
                    <div>
                        <?php echo $txt_payment_corop_isento; ?>
                    </div>
                    <div>
                        <input type="checkbox" name="payment_corop_isento" id="payment_corop_isento"
                               <?php echo!empty($payment_corop_isento) ? "checked='checked'" : ""; ?>/>
                    </div>
                </div>

            </div>

            <div>
                <div class="customer_section">

                    <h3 colspan="4"><?php echo $txt_payment_heading_profession; ?></h3>
                </div>
                <div class="customer_section">

                    <div colspan="4">
                        <?php
                        $profession_types = array(
                            "Dentista", "Tecnico em Protese",
                            "Academico",
                        );
                        $i = 0;
                        $payment_profession_type = explode(",",$payment_profession_type);
                        foreach ($profession_types as $type) {
                            if (!empty($payment_profession_type)) {
                                if (is_array($payment_profession_type) && in_array($type, $payment_profession_type)) {
                                    $checkd = 'checked="checked"';
                                } else if (is_string($payment_profession_type) && $payment_profession_type == $type) {
                                    $checkd = 'checked="checked"';
                                } else {
                                    $checkd = '';
                                }
                            } else {
                                if ($i == 0) {
                                    $checkd = 'checked="checked"';
                                } else {
                                    $checkd = '';
                                }
                            }
                            ?>
                            <input type="<?php echo $profession_input ?>"  name="payment_profession_type[]" 
                                   value="<?php echo $type ?>" <?php echo $checkd; ?> /> 
                            <label><?php echo $type ?></label>

                            <?php
                            $i++;
                        }
                        ?>

                    </div>
                </div>
                <div class="od" style="display: none">

                    <div>
                        <?php echo $txt_payment_profession_cro; ?>
                    </div>
                    <div colspan="3"> 
                        <input type="text" id="payment_profession_cro" name="payment_profession_cro" 
                               value="<?php echo isset($payment_profession_cro) ? $payment_profession_cro : ""; ?>" />
                    </div>

                </div>
                <div class="pr" style="display: none">

                    <div>
                        <?php echo $txt_payment_profession_tdp; ?>
                    </div>
                    <div colspan="3"> 
                        <input type="text" id="payment_profession_tdp" 
                               name="payment_profession_tdp"
                               value="<?php echo isset($payment_profession_tdp) ? $payment_profession_tdp : ""; ?>" />
                    </div>

                </div>
                <div class="ac" style="display: none">
                    <div>
                        <?php echo $txt_payment_profession_matricula; ?>
                    </div>
                    <div colspan="3">
                        <input type="text" id="payment_profession_matricula" 
                               name="payment_profession_matricula" 
                               value="<?php echo isset($payment_profession_matricula) ? $payment_profession_matricula : ""; ?>" 
                               />
                    </div>

                </div>
                <div class="ac" style="display: none">
                    <div>
                        <?php echo $txt_payment_profession_ensino; ?>
                        <div colspan="3">
                            <input type="text" id="payment_profession_ensino" 
                                   name="payment_profession_ensino"
                                   value="<?php echo isset($payment_profession_ensino) ? $payment_profession_ensino : ""; ?>"
                                   />
                        </div>
                    </div>
                </div>
                <div>

                    <div style="display:none">
                        <?php echo $txt_payment_profession_graduacao; ?>
                    </div>
                    <div style="display:none">
                        <?php
                        $prof_inst = array(
                            'Selecione',
                            'Superior Completo',
                            'Pós Graduação',
                            'Mestrado',
                            'Doutorado',
                        );
                        $i = 0;
                        ?>
                        <select id="payment_profession_graduacao" name="payment_profession_graduacao">
                            <?php
                            $checked = '';
                            foreach ($prof_inst as $val) {
                                if (isset($payment_profession_graduacao) && $val == $payment_profession_graduacao) {
                                    $checkd = 'selected="selected"';
                                } else {
                                    $checked = '';
                                }
                                echo "<option value='" . $val . "' $checkd>" . $val . "</option>";

                                $i++;
                            }
                            $checkd = '';
                            ?>
                        </select>

                    </div>
                    <div class="deleted_by_brian" style="display: none">
                        <div>
                            <?php echo $txt_payment_profession_instituica; ?>
                        </div>
                        <div>
                            <input type="text" id="payment_profession_instituica" 
                                   name="payment_profession_instituica"
                                   value="<?php echo isset($payment_profession_instituica) ? $payment_profession_instituica : ""; ?>"
                                   />
                        </div>
                    </div>

                </div>
                <div class="area" style="<?php echo $area_style; ?>">

                    <div class="area_heading">
                        <?php echo $txt_payment_profession_atuacao; ?>
                    </div>
                    <div class="area_checkboxes">
                        <?php
                        $options_atuaca_dentista = array(
                            "Clinica", "Dentistica",
                            "Endodontia", "Estetica",
                            "Ortodondia", "Periodontia",
                            "Protese", "Radiologia",
                        );
                        $options_atuaca_técnico = array(
                            "Metaloceramica", "Ceramica sobre Zirconia",
                            "Ceramica Prensada – Metal Free", "Fundicao",
                            "Fresagem em CAD/CAM", "Trabalhos em Resina",
                            "PPR – Protese Parcial Removivel", "Protese Total",
                            "Placas (Bruxismo ou Injetada)", "Implantes",
                            "Encaixes (ERA, ORING ou TRILHO)",
                        );
                        $checkd = '';

                        if (!empty($payment_profession_atuacao) && is_string($payment_profession_atuacao)) {
                            $payment_profession_atuacao = explode(",", $payment_profession_atuacao);
                        } else if (!empty($payment_profession_atuacao) && is_array($payment_profession_atuacao)) {
                            
                        } else {
                            $payment_profession_atuacao = array();
                        }

                        $display_dentista_reference_box = "display:none";
                        $display_tec_reference_box = "display:none";

                        if (empty($payment_profession_type) || $payment_profession_type == "Dentista") {
                            $display_dentista_reference_box = "";
                        } else if ($payment_profession_type == "Tecnico em Protese") {
                            $display_tec_reference_box = "";
                        }

                        echo "<div reference='Dentista' style='" . $display_dentista_reference_box . "'>";

                        foreach ($options_atuaca_dentista as $opt) {
                            if (!empty($payment_profession_atuacao) && in_array($opt, $payment_profession_atuacao)) {
                                $checkd = 'checked="checked"';
                            } else {
                                $checkd = '';
                            }
                            ?>
                            <label><?php echo $opt; ?></label>    
                            <input type="checkbox" name="payment_profession_atuacao[Dentista][]" value="<?php echo $opt; ?>" <?php echo $checkd; ?> />
                            <?php
                        }
                        echo "</div>";

                        echo "<div reference='Tecnico em Protese' style='" . $display_tec_reference_box . "'>";

                        foreach ($options_atuaca_técnico as $opt) {
                            if (!empty($payment_profession_atuacao) && in_array($opt, $payment_profession_atuacao)) {
                                $checkd = 'checked="checked"';
                            } else {
                                $checkd = '';
                            }
                            ?>
                            <label><?php echo $opt; ?></label>    
                            <input type="checkbox" name="payment_profession_atuacao[Tecnico em Protese][]" value="<?php echo $opt; ?>" <?php echo $checkd; ?> />
                            <?php
                        }
                        echo "</div>";
                        ?>
                    </div>


                </div>
                <div class="news_letter" style="<?php echo $area_style; ?>">
                    <div>
                        <?php echo $txt_payment_news_letter; ?>
                    </div>
                    <div colspan="3">
                        <input type="checkbox" name="payment_news_letter" id="payment_news_letter" checked="checked" />
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<script>
    var route = "<?php echo $_GET['route']; ?>";
    var mapping_divs = {'Dentista': 'od', 'Tecnico em Protese': 'pr', 'Academico': 'ac'};
    function customer_section_scripts() {

        $(".cusomer_type").click(function () {
            if ($(this).is(':checked')) {
                if ($(this).val() == 'Pessoa Física') {
                    $(".customer").show();
                    $(".account").hide();
                }
                else if ($(this).val() == 'Pessoa Jurídica') {
                    $(".account").show();
                    $(".customer").hide();
                }
            }
        })
        $("input.cusomer_type[checked='checked']").trigger("click");

        $("input[name='payment_profession_type[]'] ").click(function (event, param) {
            //hiding all the elements
            handling_checkboxes(mapping_divs, param, route);


        })



        //MANAGING MASKS
        $("#payment_cad_telefone").mask({mask: "(##)########?#"});
        $("#payment_corop_telefone").mask({mask: "(##)########?#"});



        $('#cpf_cnpj').focus(function () {
            $("#cpf_cnpj").mask('destroy');
            $("#cpf_cnpj").val($("#cpf_cnpj").val().replace(/[^\d]/g, ''));
        });
        $('#payment_corop_cnpg').blur(function () {
            if ($.isNumeric($("#payment_corop_cnpg").val()) == true) {
                if ($("#payment_corop_cnpg").val().length == 11) {
                    $("#payment_corop_cnpg").mask({mask: "###.###.###-##"});
                } else if ($("#payment_corop_cnpg").val().length == 14) {
                    $("#payment_corop_cnpg").mask({mask: "##.###.###/####-##"});
                }
            } else if ($.isNumeric($("#payment_corop_cnpg").val().replace(/[^\d]/g, '')) == false) {
                $("#payment_corop_cnpg").mask('destroy');
                $("#payment_corop_cnpg").val('');
            }
        });
    }
    function handling_checkboxes(mapping_divs, param, route) {
        $(".area>div.area_checkboxes>div").hide();
        $.each(mapping_divs, function (t, v) {

            $("." + v).hide();
        })

        //showing all the elements by matching
        $("input[name='payment_profession_type[]'] ").each(function () {
            console.log($(this));
            console.log($(this).prop("checked"));
            if ($(this).prop("checked")) {
                var show_class = mapping_divs[$(this).val()];
                $("." + show_class).show();
            }
        })
        console.log("-------Param--------");
        console.log(param);
        console.log("-------End Param--------");
        if (typeof (param) == "undefined") {
            console.log("here");
            $(".area>div.area_checkboxes input[type='checkbox']").prop('checked', false);
        }
        else if (typeof (param['value']) != "undefined") {
            console.log(param['value']);
            console.log($("input[name='payment_profession_type[]'][value='" + param['value'] + "']"));
            $("input[name='payment_profession_type[]'][value='" + param['value'] + "']").prop('checked', true);
        }
        // a super condition for signup 
        if (route != "account/register") {
            $("input[name='payment_profession_type[]'] ").each(function () {
                if ($(this).prop("checked")) {
                    if ($(".area>div.area_checkboxes>div[reference='" + $(this).val() + "']").length > 0) {
                        $(".area>div.area_checkboxes>div[reference='" + $(this).val() + "']").show();

                        //un check others
                        $(".area>div.area_checkboxes>div[reference!='" + $(this).val() + "'] input[type='checkbox']").prop('checked', false);
                    }
                }
            })
        }
    }
    $(function () {
        customer_section_scripts();
        
        $("input[name='payment_profession_type[]'][checked='checked'] ").each(function () {
            //$(this).trigger("click", [{somedata: true, 'value': $(this).val()}]);
        })
        handling_checkboxes(mapping_divs, {}, route);
    })

    function manage_custom_field_errors(json_error) {
        var error_fields = ['payment_cad_cpf', 'payment_cad_name',
            'payment_cad_dob', 'payment_cad_rg', 'payment_corop_cnpg',
            'payment_corop_name', 'payment_corop_trade_name', 'payment_corop_cnpg',
            'payment_corop_responsible_name'
        ];
        console.log(json_error);
        $.each(error_fields, function (k, v) {
            console.log(v);
            if (typeof (json_error[v]) != "undefined") {
                $('#' + v).after('<span class="error">' + json_error[v] + '</span>');
            }
        })

    }

</script>    
<style>
    div.area_checkboxes {
        width: 521px;
    }
    div.checkout-content div.area_checkboxes {
        width: 330px;
    }
    div.area_checkboxes input[type="checkbox"] {
        margin-bottom: 10px;
    }
</style>