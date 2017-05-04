<link rel="stylesheet" href="<?php echo $stylesheet; ?>">
<?php if ($text_information) { ?>
<div class="payment-information"><?php echo $text_information; ?></div>
<?php } ?>
<div class="payment-information">
    <label><?php echo $txt_payment_area_code; ?></label>

    <select id="area_code" name="area_code" style="width:80px">
        <option value="">--</option>

        <?php
        foreach ($area_codes as $area_code) {
            $selected = "";
            if (!empty($payment_cad_area_code) && $area_code == $payment_cad_area_code) {
                $selected = "checked='checked';";
            }
        ?>
        <option value="<?php echo $area_code; ?>"><?php echo $area_code; ?></option>

        <?php
        }
        ?>
    </select>
</div>
<div class="dados_cartao">

    <!-- Total do pedido -->
    <input type="hidden" name="totalValue" id="totalValue" value="<?php echo $total; ?>">

    <div class="input-block-float">
        <label for="cardNumber">Número do cartão</label>
        <input type="text" name="cardNumber" id="cardNumber" size="16" maxlength="16" placeholder="Número do cartão"
               class="so_numeros"/>
        <input type="hidden" id="creditCardBrand" name="creditCardBrand"/>

        <div id="cardBrand"></div>
    </div>

    <div class="input-block-float">
        <!-- aqui colocar um tooltip com uma imagem mostrando onde fica o CVV de um cartão de crédito -->

        <label for="cvv" id="label-cvc">CVV <span id="tool-tip-cvc"><i class="fa fa-question-circle"></i> <span
                        id="tool-tip-content"><img src="catalog/view/theme/default/image/bancos/cartao-cvc.png" alt=""></span></span></label>
        <input type="text" name="cvv" id="cvv" size="4" placeholder="CVV" maxlength="4" class="so_numeros"/>

    </div>
    <div class="cf"></div>
    <div class="input-block">
        <label>Validade do cartão</label>
        <input type="text" id="cardExpirationMonth" name="expirationMonth" size="2" placeholder="MM" maxlength="2"
               class="so_numeros"/>
        <input type="text" id="cardExpirationYear" name="expirationYear" size="4" placeholder="AAAA" maxlength="4"
               class="so_numeros"/>
    </div>

    <div class="input-block">
        <label for="creditCardHolderName">Nome impresso no cartão</label>
        <input type="text" name="creditCardHolderName" id="creditCardHolderName" value=""/>
    </div>
    <div id="installmentsWrapper">
        <div class="input-block">
            <label for="installmentQuantity">Parcelamento</label>
            <select name="installmentQuantity" id="installmentQuantity"></select>
            <input type="hidden" name="installmentValue" id="installmentValue"/>

            <input type="text" readonly="" value="" id="installmentTotal">
        </div>
    </div>
    <input type="hidden" name="creditCardToken" id="creditCardToken"/>


    <div class="input-block">
        <label for="creditCardHolderCPF">CPF:</label>
        <input type="text" name="creditCardHolderCPF" id="creditCardHolderCPF" value="<?php echo $cpf ?>"/>
    </div>

    <div class="input-block">
        <label for="telefone">Telefone:</label>
        <input type="text" name="telefone" id="telefone" value="<?php echo $telefone ?>"/>
    </div>

    <div class="input-block">
        <label for="creditCardHolderBirthDate">Data de Nascimento:</label>
        <input type="text" name="creditCardHolderBirthDate" id="creditCardHolderBirthDate"
               value="<?php echo $data_nascimento ?>"/>
    </div>

    <div class="input-block-float">
        <label for="shippingAddressStreet">Endereço:</label>
        <input type="text" name="shippingAddressStreet" id="shippingAddressStreet" size="16"
               value="<?php echo $endereco ?>"/>
    </div>

    <div class="input-block-float">
        <label for="shippingAddressNumber">N&ordm;:</label>
        <input type="text" name="shippingAddressNumber" id="shippingAddressNumber" size="4"
               value="<?php echo $numero ?>"/>
    </div>

    <div class="input-block-float">
        <label for="shippingAddressComplement">Complemento:</label>
        <input type="text" name="shippingAddressComplement" id="shippingAddressComplement" size="10"
               value="<?php echo $complemento ?>"/>
    </div>

    <div class="input-block-float">
        <label for="shippingAddressDistrict">Bairro:</label>
        <input type="text" name="shippingAddressDistrict" id="shippingAddressDistrict" size="10"
               value="<?php echo $bairro ?>"/>
    </div>

    <div class="input-block-float">
        <label for="shippingAddressPostalCode">CEP:</label>
        <input type="text" name="shippingAddressPostalCode" id="shippingAddressPostalCode" value="<?php echo $cep ?>"/>
    </div>

    <div class="input-block-float">
        <label for="shippingAddressCity">Cidade:</label>
        <input type="text" name="shippingAddressCity" id="shippingAddressCity" size="17" value="<?php echo $cidade ?>"/>
    </div>

    <div class="input-block-float">
        <label for="shippingAddressState">UF:</label>
        <select name="shippingAddressState" id="shippingAddressState">
            <option value="440"
            <?php echo $estado == '440' ? 'selected' : '' ?>>AC</option>
            <option value="441"
            <?php echo $estado == '441' ? 'selected' : '' ?>>AL</option>
            <option value="442"
            <?php echo $estado == '442' ? 'selected' : '' ?>>AM</option>
            <option value="443"
            <?php echo $estado == '443' ? 'selected' : '' ?>>AP</option>
            <option value="444"
            <?php echo $estado == '444' ? 'selected' : '' ?>>BA</option>
            <option value="445"
            <?php echo $estado == '445' ? 'selected' : '' ?>>CE</option>
            <option value="446"
            <?php echo $estado == '446' ? 'selected' : '' ?>>DF</option>
            <option value="447"
            <?php echo $estado == '447' ? 'selected' : '' ?>>ES</option>
            <option value="448"
            <?php echo $estado == '448' ? 'selected' : '' ?>>GO</option>
            <option value="449"
            <?php echo $estado == '449' ? 'selected' : '' ?>>MA</option>
            <option value="450"
            <?php echo $estado == '450' ? 'selected' : '' ?>>MG</option>
            <option value="451"
            <?php echo $estado == '451' ? 'selected' : '' ?>>MS</option>
            <option value="452"
            <?php echo $estado == '452' ? 'selected' : '' ?>>MT</option>
            <option value="453"
            <?php echo $estado == '453' ? 'selected' : '' ?>>PA</option>
            <option value="454"
            <?php echo $estado == '454' ? 'selected' : '' ?>>PB</option>
            <option value="455"
            <?php echo $estado == '455' ? 'selected' : '' ?>>PE</option>
            <option value="456"
            <?php echo $estado == '456' ? 'selected' : '' ?>>PI</option>
            <option value="457"
            <?php echo $estado == '457' ? 'selected' : '' ?>>PR</option>
            <option value="458"
            <?php echo $estado == '458' ? 'selected' : '' ?>>RJ</option>
            <option value="459"
            <?php echo $estado == '459' ? 'selected' : '' ?>>RN</option>
            <option value="460"
            <?php echo $estado == '460' ? 'selected' : '' ?>>RO</option>
            <option value="461"
            <?php echo $estado == '461' ? 'selected' : '' ?>>RR</option>
            <option value="462"
            <?php echo $estado == '462' ? 'selected' : '' ?>>RS</option>
            <option value="463"
            <?php echo $estado == '463' ? 'selected' : '' ?>>SC</option>
            <option value="465"
            <?php echo $estado == '465' ? 'selected' : '' ?>>SE</option>
            <option value="464"
            <?php echo $estado == '464' ? 'selected' : '' ?>>SP</option>
            <option value="466"
            <?php echo $estado == '466' ? 'selected' : '' ?>>TO</option>
        </select>
    </div>


</div>

<div class="buttons">
    <div class="right"><a disabled="disabled" id="button-confirm"
                          class="button disabled"><span><?php echo $button_confirm; ?></span></a><span id="aguardando">Aguarde...</span>
    </div>
</div>
<style>
    #aguardando {
        display: none;
    }

    #installmentsWrapper {
        
    }
</style>

<script type="text/javascript" src="catalog/view/javascript/pagseguro.js"></script>
<?php if (!$this->config->get('dados_status')): ?>
<script type="text/javascript" src="catalog/view/javascript/mask.js"></script>
<?php endif; ?>

<script type="text/javascript"><!--

    /* Atualização do total */
    $("#installmentQuantity").change(function () {
        updateTotal($(this).val(), $('option:selected', this).attr("dataprice"));
    });


    $("#creditCardHolderCPF").unmask().mask("999.999.999-99");


    $("#shippingAddressPostalCode").unmask().mask("99999-999");


    $("input[name=telefone]").unmask().mask("(99) 9999-9999?9").live('focusout', function (event) {
        var target, phone, element;
        target = (event.currentTarget) ? event.currentTarget : event.srcElement;
        phone = target.value.replace(/\D/g, '');
        element = $(target);
        element.unmask();
        if (phone.length > 10) {
            element.mask("(99) 99999-999?9");
        } else {
            element.mask("(99) 9999-9999?9");
        }
    });


    $("#creditCardHolderBirthDate").unmask().mask("99/99/9999");


    PagSeguroDirectPayment.setSessionId('<?php echo $pagseguro_session; ?>');
    /* Pega bandeira */
    $('#cardNumber').keydown(function () {
        
        verifyBrand();
    });
    /* Máscaras dos inputs do cartão */
    $("#cardNumber").on("maskEvent", function () {
        $(this).mask("9999999999999999");
    });
    $("#cvv").on("maskEvent", function () {
        $(this).mask("9999").live('focusout', function (event) {
            var target, phone, element;
            target = (event.currentTarget) ? event.currentTarget : event.srcElement;
            phone = target.value.replace(/\D/g, '');
            element = $(target);
            element.unmask();
            if ($(this).attr("maxlength") > 3) {
                element.mask("9999");
            } else {
                element.mask("999");
            }
        });
    });
    $("input[name=expirationMonth]").on("maskEvent", function () {
        $(this).mask("99");
    });
    $("input[name=expirationYear]").on("maskEvent", function () {
        $(this).mask("9999");
    });
    var validate = true;
    var token = false;

    function creditCardValidate() {
        var validate = true;
        $.each($(".input-block input[type=text]"), function (key, value) {
            if ($(this).val() == '') {
                validate = false;
            }
        });

        if (validate) {
            return true;
        } else {
            alert('Todos os campos devem ser preenchidos!');
            return false;
        }
    }

    function generateCreditCardToken() {
        PagSeguroDirectPayment.createCardToken({
            cardNumber: $("#cardNumber").val(),
            brand: $("#creditCardBrand").val(),
            cvv: $("#cvv").val(),
            expirationMonth: $("#cardExpirationMonth").val(),
            expirationYear: $("#cardExpirationYear").val(),
            success: function (response) {

                // Obtendo token para pagamento com cartão
                $("#creditCardToken").val(response.card.token);
                // Executando o callback (pagamento) passando o token como parâmetro
                //callback(token);

            },
            error: function (response) {

                showCardTokenErrors(response.errors);
            },
            complete: function (response) {

            }
        });
    }

    $("#cardNumber, #creditCardBrand, #cvv, #cardExpirationMonth, #cardExpirationYear").blur(function () {
        if ($("#cardNumber").val() != "" && $("#creditCardBrand").val() != "" && $("#cvv").val() != "" && $("#cardExpirationMonth").val() != "" && $("#cardExpirationYear").val() != "") {
            generateCreditCardToken();
        }
    });

    $('#button-confirm').bind('click', function () {
        if ($("select[name='area_code']").val().trim()==''){
             alert('Digite seu Area code')
        }
        else if (creditCardValidate()) {

            var params = 'creditCardToken=' + $("#creditCardToken").val() + '&installmentQuantity=' + $("#installmentQuantity").val() + '&installmentValue=' + $("#installmentValue").val() + '&creditCardHolderName=' + $("#creditCardHolderName").val() + '&creditCardHolderCPF=' + $("#creditCardHolderCPF").val() + '&creditCardHolderBirthDate=' + $("#creditCardHolderBirthDate").val() + '&creditCardHolderPhone=' + $("#telefone").val() + '&shippingAddressStreet=' + $("#shippingAddressStreet").val() + '&shippingAddressNumber=' + $("#shippingAddressNumber").val() + '&shippingAddressComplement=' + $("#shippingAddressComplement").val() + '&shippingAddressDistrict=' + $("#shippingAddressDistrict").val() + '&shippingAddressPostalCode=' + $("#shippingAddressPostalCode").val() + '&shippingAddressCity=' + $("#shippingAddressCity").val() + '&shippingAddressState=' + $("#shippingAddressState").val();
            params+="&areaCode="+$("select[name='area_code']").val();
            
            $('#button-confirm').hide();
            $('#aguardando').show();
            $.ajax({
                type: 'POST',
                url: 'index.php?route=payment/pagseguro_credit_card/payment',
                dataType: 'json',
                data: params + '&senderHash=' + PagSeguroDirectPayment.getSenderHash(),
                beforeSend: function () {
                    $('#button-confirm').attr('disabled', true);
                    $('#payment').before('<div class="attention"><img src="catalog/view/theme/default/image/loading.gif" alt="" /> <?php echo $text_wait; ?></div>');
                },
                success: function (response) {
                    if (response['error']) {
                        alert('Ocorreu um erro inesperado. Por favor contate a loja.');
                        $('#button-confirm').show();
                        $('#aguardando').hide();
                    } else if (response['success']) {
                        // alert(response['success']);
                        //$.colorbox({href: response['success']});
                        //window.open(response['success']);
                        location = '<?php echo $url; ?>';
                    } else {
                        alert('Ocorreu um erro inesperado. Por favor contate a loja.');
                    }
                }
            });
        }
    });
    //--></script>
</script>

