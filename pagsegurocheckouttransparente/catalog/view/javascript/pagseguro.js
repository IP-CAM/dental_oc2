
var verifyBrand = function () {

    // Obtendo apenas os 6 primeiros dígitos (bin)
    var cardBin = $("#cardNumber").val().substring(0, 6);

    // Atualizar Brand apenas se tiver 6 ou mais dígitos preenchidos
    if (String(cardBin).length >= 6) {

        //console.log(cardBin);

        // Atualizar Brand
        updateCardBrand(cardBin);

    } else {

        // Se não digitou o número do cartão, esconder parcelamento
        $("#installmentsWrapper").hide();

    }

};

var updateCardBrand = function (cardBin) {

    PagSeguroDirectPayment.getBrand({
        cardBin: cardBin,
        success: function (response) {

            var brand = response.brand.name;

            $("#cardBrand").html();
            $("#cardBrand").html("<img src='https://stc.pagseguro.uol.com.br/public/img/payment-methods-flags/68x30/" + brand + ".png'>");
            $("#creditCardBrand").val(brand);
            $("#cvv").attr("maxlength", response.brand.cvvSize)

            updateInstallments(brand);

        },
        error: function (response) {
            //console.log(response);
        },
        complete: function (response) {

        }

    });

};

// Atualiza dados de parcelamento atráves da bandeira do cartão
var updateInstallments = function (brand) {

    var amount = parseFloat($("#totalValue").val()).toFixed(2);

    PagSeguroDirectPayment.getInstallments({
        amount: amount,
        brand: brand,
        success: function (response) {

            // Para obter o array de parcelamento use a bandeira como "chave" da lista "installments"
            var installments = response.installments[brand];

            var options = '';
            for (var i in installments) {

                var optionItem = installments[i];
                var optionQuantity = optionItem.quantity; // Obtendo a quantidade
                var optionAmount = optionItem.installmentAmount; // Obtendo o valor
                var optionLabel = (optionQuantity + "x " + formatMoney(optionAmount)); // montando o label do option
                var price = optionAmount;

                options += ('<option value="' + optionItem.quantity + '" dataPrice="' + price + '">' + optionLabel + '</option>');

            }
            ;

            // Atualizando dados do select de parcelamento
            $("#installmentQuantity").html(options);

            // Exibindo select do parcelamento
            $("#installmentsWrapper").show();

            // Utilizando evento "change" como gatilho para atualizar o valor do parcelamento
            $("#installmentQuantity").trigger('change');

            updateTotal(1, amount)

        },
        error: function (response) {

        },
        complete: function (response) {

        }
    });

};

var updateTotal = function (quantity, value) {    
    $("#installmentTotal").val(formatMoney(quantity * value));
    $("#installmentValue").val(Number(value).toMoney(2, '.', ''));
};

var updateCardToken = function () {

    PagSeguroDirectPayment.createCardToken({
        cardNumber: $("#cardNumber").val(),
        brand: $("#creditCardBrand").val(),
        cvv: $("#cvv").val(),
        expirationMonth: $("#cardExpirationMonth").val(),
        expirationYear: $("#cardExpirationYear").val(),
        success: function (response) {

            // Obtendo token para pagamento com cartão
            token = response.card.token;

            // Executando o callback (pagamento) passando o token como parâmetro
            //callback(token);

        },
        error: function (response) {

            showCardTokenErrors(response.errors);

        },
        complete: function (response) {

        }

    });

};

var formatMoney = function (valor) {
    var valorAsNumber = Number(valor);
    return 'R$ ' + valorAsNumber.toMoney(2, ',', '.');
};

Number.prototype.toMoney = function (decimals, decimal_sep, thousands_sep) {
    var n = this,
            c = isNaN(decimals) ? 2 : Math.abs(decimals),
            d = decimal_sep || '.',
            t = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
            sign = (n < 0) ? '-' : '',
            i = parseInt(n = Math.abs(n).toFixed(c)) + '',
            j = ((j = i.length) > 3) ? j % 3 : 0;
    return sign + (j ? i.substr(0, j) + t : '') + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : '');
};

var showCardTokenErrors = function (errors) {

    if (typeof errors == 'object') {

        var html = '<ul class="errors">';

        for (i in errors) {
            html += ('<li>' + errors[i] + '</li>');
        }

        html += ('</ul>');

        $.colorbox({
            html: html,
            fixed: true
        });

    }

};