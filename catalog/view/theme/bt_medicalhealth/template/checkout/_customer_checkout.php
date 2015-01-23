<table class="customer_type">
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
            <label>Masculino</label>
            <input type="radio" name="payment_cad_gender" value="Masculino" />
            <label>Feminino</label>
            <input type="radio" name="payment_cad_gender" value="Feminino" />
        </td>

    </tr>
</table>

<table class="account">
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
            <label>Odontologista</label>
            <input type="radio" name="payment_profession_type" value="Odontologista" />
            <label>Protético</label>
            <input type="radio" name="payment_profession_type" value="Protético" />
            <label>Acadêmico</label>
            <input type="radio" name="payment_profession_type" value="Acadêmico" />
        </td>
    </tr>
    <tr>

        <td>
            CRO
        </td>
        <td colspan="3"> 
            <input type="text" id="payment_profession_cro" name="payment_profession_cro" />
        </td>

    </tr>
    <tr>

        <td>
            TDP
        </td>
        <td colspan="3"> 
            <input type="text" id="payment_profession_tdp" name="payment_profession_tdp" />
        </td>

    </tr>
    <tr>
        <td>
            Número da Matrícula
        </td>
        <td colspan="3">
            <input type="text" id="payment_profession_matricula" name="payment_profession_matricula" />
        </td>

    </tr>
    <tr>
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
            <input type="text" id="payment_profession_graduacao" name="payment_profession_graduacao" />
        </td>
        <td>
            Instituição de Ensino
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
            ?>
            <select id="payment_profession_instituica" name="payment_profession_instituica">
                <?php
                foreach ($prof_inst as $val) {
                    echo "<option value='" . $val . "'>" . $val . "</option>";
                }
                ?>
            </select>
        </td>
    </tr>
    <tr>

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