<table class="form">

    <tr>
        <td><?php echo $txt_payment_heading_customer_type; ?></td>
        <td><?php echo $payment_customer_type; ?></td>
    </tr>
    <?php
    if ($payment_customer_type == "Pessoa Física") {
        ?>

        <tr>
            <td><?php echo $txt_payment_cad_name; ?></td>
            <td><?php echo $payment_cad_name; ?></td>
        </tr>
        <tr>
            <td><?php echo $txt_payment_cad_dob; ?></td>
            <td><?php echo $payment_cad_dob; ?></td>
        </tr>
        <tr>
            <td><?php echo $txt_payment_cad_cpf; ?></td>
            <td><?php echo $payment_cad_cpf; ?></td>
        </tr>
        <tr>
            <td><?php echo $txt_payment_cad_rg; ?></td>
            <td><?php echo $payment_cad_rg; ?></td>
        </tr>
        <tr>
            <td><?php echo $txt_payment_cad_telefone; ?></td>
            <td><?php echo $payment_cad_telefone; ?></td>
        </tr>
        <tr>
            <td><?php echo $txt_payment_cad_celular; ?></td>
            <td><?php echo $payment_cad_celular; ?></td>
        </tr>
        <tr>
            <td><?php echo $txt_payment_cad_gender; ?></td>
            <td><?php echo $payment_cad_gender; ?></td>
        </tr>
        <?php
    } else {
        ?>
        <tr>
            <td><?php echo $txt_payment_corop_name; ?></td>
            <td><?php echo $payment_corop_name; ?></td>
        </tr>
        <tr>
            <td><?php
                echo $txt_payment_corop_trade_name;
                ;
                ?></td>
            <td><?php echo $payment_corop_trade_name; ?></td>
        </tr>
        <tr>
            <td><?php echo $txt_payment_corop_responsible_name; ?></td>
            <td><?php echo $payment_corop_responsible_name; ?></td>
        </tr>
        <tr>
            <td><?php echo $txt_payment_corop_name; ?></td>
            <td><?php echo $payment_corop_cnpg; ?></td>
        </tr>
        <tr>
            <td><?php echo $txt_payment_corop_telefone; ?></td>
            <td><?php echo $payment_corop_telefone; ?></td>
        </tr>
        <tr>
            <td><?php echo $txt_payment_corop_responsible_cell; ?></td>
            <td><?php echo $payment_corop_responsible_cell; ?></td>
        </tr>
        <tr>
            <td><?php echo $txt_payment_corop_state_registration; ?></td>
            <td><?php echo $payment_corop_state_registration; ?></td>
        </tr>
        <tr>
            <td><?php echo $txt_payment_corop_isento; ?></td>
            <td><?php echo $payment_corop_isento; ?></td>
        </tr>
        <?php
    }
    ?>
    <tr>
        <td><?php echo $txt_payment_profession_type; ?></td>
        <td><?php echo $payment_profession_type; ?></td>
    </tr>

    <?php
    if ($payment_profession_type == "Odontologista") {
        ?>
        <tr>
            <td><?php echo $txt_payment_profession_cro; ?></td>
            <td><?php echo $payment_profession_cro; ?></td>
        </tr>
        <tr>
            <td><?php echo $txt_payment_profession_atuacao; ?></td>
            <td><?php echo $payment_profession_atuacao; ?></td>
        </tr>
        <?php
    } else if ($payment_profession_type == "Protético") {
        ?>
        <tr>
            <td><?php echo $txt_payment_profession_tdp; ?></td>
            <td><?php echo $payment_profession_tdp; ?></td>
        </tr>
        <tr>
            <td><?php echo $txt_payment_profession_atuacao; ?></td>
            <td><?php echo $payment_profession_atuacao; ?></td>
        </tr>
        <?php
    } else if ($payment_profession_type == "Acadêmico") {
        ?>
        <tr>
            <td><?php echo $txt_payment_profession_matricula; ?></td>
            <td><?php echo $payment_profession_matricula; ?></td>
        </tr>
        <tr>
            <td><?php echo $txt_payment_profession_ensino; ?></td>
            <td><?php echo $payment_profession_ensino; ?></td>
        </tr>
        <?php
    }
    ?>

    <tr>
        <td><?php echo $txt_payment_profession_graduacao; ?></td>
        <td><?php echo $payment_profession_graduacao; ?></td>
    </tr>
    <tr>
        <td><?php echo $txt_payment_profession_instituica; ?></td>
        <td><?php echo $payment_profession_instituica; ?></td>
    </tr>
    <tr>
        <td><?php echo $txt_payment_new_letter; ?></td>
        <td><?php echo $payment_news_letter==1?'Yes':'No'; ?></td>
    </tr>



</table>