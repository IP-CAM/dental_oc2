<table>
    <tr>

        <td colspan="4">
            <?php
            $customer_types = array(
                "Pessoa Física", "Pessoa Jurídica"
            );
            $i = 0;
            $checkd = '';
            foreach ($customer_types as $type) {
                if ($i == 0) {
                    $checkd = 'checked="checked"';
                } else {
                    $checkd = '';
                }
                ?>
                <input type="radio" class="cusomer_type"  name="cusomer_type" value="<?php echo $type ?>" <?php echo $checkd; ?> /> 
                <label><?php echo $type ?></label>

                <?php
                $i++;
            }
            $checkd = '';
            ?>
        </td>
    </tr>
    <tr>
        <td colspan="4">

            <table class="customer" style="display:none" >
                <tr>
                    <td>
                        <h2>Dados Pessoais</h2>

                    </td>

                </tr>
                <tr>

                    <td>
                        Nome Completo
                    </td>
                    <td>
                        <input type="text" name="payment_cad_name" id="payment_cad_name" />
                    </td>
                    <td>
                        Data de Nascimento
                    </td>
                    <td>
                        <input type="text" name="payment_cad_dob" id="payment_cad_dob" />
                    </td>
                </tr>
                <tr>

                    <td>
                        CPF
                    </td>
                    <td>
                        <input type="text" name="payment_cad_cpf" id="payment_cad_cpf" />
                    </td>
                    <td>
                        RG
                    </td>
                    <td>
                        <input type="text" name="payment_cad_rg" id="payment_cad_rg" />
                    </td>
                </tr>
                <tr>

                    <td>
                        Telefone
                    </td>
                    <td>
                        <input type="text" name="payment_cad_telefone" id="payment_cad_telefone" />
                    </td>
                    <td>
                        Celular
                    </td>
                    <td>
                        <input type="text" name="payment_cad_celular" id="payment_cad_celular" />
                    </td>
                </tr>
                <tr>

                    <td colspan="4">
                        <?php
                        $genders = array(
                            "Masculino", "Feminino"
                        );
                        foreach ($genders as $gend) {
                            ?>
                            <input type="radio"  name="payment_cad_gender" value="<?php echo $gend ?>" /> 
                            <label><?php echo $gend ?></label>

                            <?php
                        }
                        ?>

                    </td>

                </tr>
            </table>

            <table class="account" style="display:none">
                <tr>
                    <td>
                        <h2>Dados da Empresa</h2>

                    </td>

                </tr>
                <tr>

                    <td>
                        Razão Social
                    </td>
                    <td>
                        <input type="text" name="payment_corop_name" id="payment_corop_name" />
                    </td>
                    <td>
                        Nome Fantasia
                    </td>
                    <td>
                        <input type="text" name="payment_corop_trade_name" id="payment_corop_trade_name" />
                    </td>
                </tr>
                <tr>

                    <td>
                        CNPJ
                    </td>
                    <td>
                        <input type="text" name="payment_corop_cnpg" id="payment_corop_cnpg"/>
                    </td>
                    <td>
                        Nome do Responsável
                    </td>
                    <td>
                        <input type="text" id="payment_corop_responsible_name" name="payment_corop_responsible_name" />
                    </td>
                </tr>
                <tr>

                    <td>
                        Telefone
                    </td>
                    <td>
                        <input type="text" name="payment_corop_telefone" id="payment_corop_telefone"/>
                    </td>
                    <td>
                        Celular do Responsável
                    </td>
                    <td>
                        <input type="text" name="payment_corop_responsible_cell" id="payment_corop_responsible_cell" />
                    </td>
                </tr>
                <tr>

                    <td>
                        Inscrição Estadual
                    </td>
                    <td>
                        <input type="text" name="payment_corop_state_registration" id="payment_corop_state_registration" />
                    </td>
                    <td>
                        Isento
                    </td>
                    <td>
                        <input type="checkbox" name="payment_corop_isento" id="payment_corop_isento" />
                    </td>
                </tr>

            </table>

            <table>
                <tr>

                    <th colspan="4">Dados Profissionais</th>
                </tr>
                <tr>

                    <td colspan="4">
                        <?php
                        $profession_types = array(
                            "Odontologista", "Protético",
                            "Acadêmico",
                        );
                        $i = 0;
                        foreach ($profession_types as $type) {
                            if ($i == 0) {
                                $checkd = 'checked="checked"';
                            } else {
                                $checkd = '';
                            }
                            ?>
                            <input type="radio"  name="payment_profession_type" 
                                   value="<?php echo $type ?>" <?php echo $checkd; ?> /> 
                            <label><?php echo $type ?></label>

                            <?php
                            $i++;
                        }
                        ?>

                    </td>
                </tr>
                <tr class="od" style="display: none">

                    <td>
                        CRO
                    </td>
                    <td colspan="3"> 
                        <input type="text" id="payment_profession_cro" name="payment_profession_cro" />
                    </td>

                </tr>
                <tr class="pr" style="display: none">

                    <td>
                        TDP
                    </td>
                    <td colspan="3"> 
                        <input type="text" id="payment_profession_tdp" name="payment_profession_tdp" />
                    </td>

                </tr>
                <tr class="ac" style="display: none">
                    <td>
                        Número da Matrícula
                    </td>
                    <td colspan="3">
                        <input type="text" id="payment_profession_matricula" name="payment_profession_matricula" />
                    </td>

                </tr>
                <tr class="ac" style="display: none">
                    <td>
                        Instituição de Ensino
                    <td colspan="3">
                        <input type="text" id="payment_profession_ensino" name="payment_profession_ensino" />
                    </td>
                </tr>
                <tr>

                    <td>
                        Graduação
                    </td>
                    <td>
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
                            foreach ($prof_inst as $val) {

                                echo "<option value='" . $val . "'>" . $val . "</option>";

                                $i++;
                            }
                            $checkd = '';
                            ?>
                        </select>
                        
                    </td>
                    <td>
                        Instituição de Ensino
                    </td>
                    <td>
                       <input type="text" id="payment_profession_instituica" name="payment_profession_instituica" />
                    </td>
                </tr>
                <tr class="area">

                    <td>
                        Área de Atuação
                    </td>
                    <td colspan="3">
                        <?php
                        $options_atuaca = array(
                            "Clínica", "Dentística",
                            "Endodontia", "Estética",
                            "Ortodondia", "Periodontia",
                            "Prótese", "Radiologia",
                        );
                        foreach ($options_atuaca as $opt) {
                            ?>
                            <label><?php echo $opt; ?></label>    
                            <input type="checkbox" name="payment_profession_atuacao" value="<?php echo $opt; ?>" />
                            <?php
                        }
                        ?>

                    </td>

                </tr>

            </table>
        </td>
    </tr>
</table>

<script>
    $(function() {
        $(".cusomer_type").click(function() {
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

        $("input[name='payment_profession_type'] ").click(function() {
            $(".od").hide();
            $(".pr").hide();
            $(".ac").hide();
            $(".area").show();
            if ($(this).is(':checked')) {
                if ($(this).val() == 'Odontologista') {
                   $(".od").show();
                }
                else if ($(this).val() == 'Protético') {
                    $(".pr").show();
                }
                else if ($(this).val() == 'Acadêmico') {
                    $(".ac").show();
                    $(".area").hide();
                }
            }
            console.log($(this));
        })
        $("input[name='payment_profession_type'][checked='checked'] ").trigger("click");
    })
</script>    