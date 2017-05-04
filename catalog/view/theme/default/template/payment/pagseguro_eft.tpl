<script type="text/javascript" src="catalog/view/javascript/pagseguro.js"></script>
<link rel="stylesheet" href="<?php echo $stylesheet; ?>">
<?php if ($text_information) { ?>
    <div class="payment-information"><?php echo $text_information; ?></div>
<?php } ?>
<div class="payment-information">
    <label for="senderCPF">CPF: </label>
    <input type="text" name="senderCPF" value="" id="senderCPF">
</div>
<div class="bancos"></div>
<div class="buttons">
    <div class="right"><a id="button-confirm" class="button"><span><?php echo $button_confirm; ?></span></a><span
            id="aguardando">Acessando o banco...</span></div>
</div>
<style>

</style>
<script type="text/javascript"><!--

    //jQuery(document).ready(function ($) {
    PagSeguroDirectPayment.setSessionId('<?php echo $pagseguro_session; ?>');

        PagSeguroDirectPayment.getPaymentMethods({
            success: function (bandeiras) {
                console.log(bandeiras);

                var cards = bandeiras.paymentMethods.ONLINE_DEBIT.options;

                $.map(cards, function (e) {
                    if(e.name.toLowerCase() != 'bradesco') {
                        $('.bancos').append('<div class="banco"><input type="radio" name="bankname" id="' + e.name + '" value="' + e.name + '"/><label for="' + e.name + '"><img src="https://stc.pagseguro.uol.com.br' + e.images.MEDIUM.path + '"><i class="fa fa-check"></i></label></div>');
                    }
//                $('#bandeiras').append('<a class="pull-left" onClick="escolherBanco(\'' + e.name + '\')" id="' + e.name + '"><div class="overlay"></div><img src="https://stc.pagseguro.uol.com.br' + e.images.MEDIUM.path + '" /></a>');
                });
            }
        });
   // });

    $('#button-confirm').bind('click', function (e) {
        e.preventDefault();
        if ($('input[name=senderCPF]').val().trim() == '') {
            alert('Digite seu CPF')
        } else {
            var w = window.open('', 'janelaBoleto', 'height=600,width=800,channelmode=0,dependent=0,directories=0,fullscreen=0,location=0,menubar=0,resizable=1,scrollbars=1,status=0,toolbar=0');
            w.document.body.innerHTML = "<h1>Por favor aguarde...</h1>";
            $('#button-confirm').hide();
            $('#aguardando').show();
            $.ajax({
                type: 'POST',
                url: 'index.php?route=payment/pagseguro_eft/payment',
                async: false,
                dataType: 'json',
                data: {
                    bankName: $('input[name=bankname]:checked').val(),
                    senderHash: PagSeguroDirectPayment.getSenderHash(),
                    senderCPF: $('input[name=senderCPF]').val()
                },
                beforeSend: function () {
                    $('#button-confirm').attr('disabled', true);

                    $('#payment').before('<div class="attention"><img src="catalog/view/theme/default/image/loading.gif" alt="" /> <?php echo $text_wait; ?></div>');
                },
                success: function (response) {
                    if (response['error']) {
                        alert('Ocorreu um erro inesperado. Por favor contate a loja.');
                        $('#button-confirm').show();
                        $('#aguardando').hide();
                    } else {
                        w.location.href = '<?php echo HTTP_SERVER; ?>index.php?route=payment/pagseguro_eft/open&order_id=' + response['order_id'];
                        location = '<?php echo $url; ?>';
                    }
                },
                complete: function () {
                }
            });
        }
    });
    //--></script>
</script>

