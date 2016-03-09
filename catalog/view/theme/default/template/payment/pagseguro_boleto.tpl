<link rel="stylesheet" href="<?php echo $stylesheet; ?>">
<?php if ($text_information) { ?>
<div class="payment-information"><?php echo $text_information; ?></div>
<?php } ?>
<div class="payment-information">
    <label for="senderCPF">CPF: </label>
    <input type="text" name="senderCPF"  id="senderCPF" value="">
</div>
<div class="buttons">
    <div class="right">
       

        <a id="button-confirm" class="button"><span><?php echo $button_confirm; ?></span></a><span id="aguardando">Gerando boleto...</span></div>
</div>
<script type="text/javascript"><!--
$('#button-confirm').bind('click', function (e) {
        e.preventDefault();
        //payment_address_checkout(true);
        if ($('input[name=senderCPF]').val().trim() == '') {
            alert('Digite seu CPF')
        } else {
            var w = window.open('', 'janelaBoleto', 'height=600,width=800,channelmode=0,dependent=0,directories=0,fullscreen=0,location=0,menubar=0,resizable=1,scrollbars=1,status=0,toolbar=0')
            w.document.body.innerHTML = "<h1>Por favor aguarde...</h1>";
            $('#button-confirm').hide();
            $('#aguardando').show();
            $.ajax({
                type: 'POST',
                url: 'index.php?route=payment/pagseguro_boleto/payment',
                async: false,
                data: {senderHash: PagSeguroDirectPayment.getSenderHash(), senderCPF: $('input[name=senderCPF]').val()},
                dataType: 'json',
                beforeSend: function () {
                    $('#button-confirm').attr('disabled', true);

                    $('#payment').before('<div class="attention"><img src="catalog/view/theme/default/image/loading.gif" alt="" /> <?php echo $text_wait; ?></div>');
                },
                success: function (response) {
                    if (response['error']) {
                        alert('Ocorreu um erro inesperado. Por favor contate a loja.');
                    } else {
                        w.location.href = '<?php echo HTTP_SERVER; ?>index.php?route=payment/pagseguro_boleto/open&order_id=' + response['order_id'];
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

