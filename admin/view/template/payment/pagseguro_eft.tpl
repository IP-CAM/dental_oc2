<?php echo $header; ?>
<div id="content">
  <div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
  </div>
  <?php if ($error_warning) { ?>
  <div class="warning"><?php echo $error_warning; ?></div>
  <?php } ?>
  <div class="box">
    <div class="heading">
      <h1><img src="view/image/payment.png" alt="" /> <?php echo $heading_title; ?></h1>
      <div class="buttons"><a onclick="$('#form').submit();" class="button"><span><?php echo $button_save; ?></span></a><a onclick="location = '<?php echo $cancel; ?>';" class="button"><span><?php echo $button_cancel; ?></span></a></div>
    </div>
    <div class="content">
	  <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
	    <table class="form">
              <tr>
	        <td><span class="required">*</span> <?php echo $entry_nome_eft; ?></td>
	        <td><input type="text" name="pagseguro_eft_nome_eft" value="<?php echo $pagseguro_eft_nome_eft; ?>" size="50%" />
	          <?php if ($error_nome_eft) { ?>
	          <span class="error"><?php echo $error_nome_eft; ?></span>
	          <?php } ?></td>
	      </tr>
	      <tr>
	        <td><span class="required">*</span> <?php echo $entry_token; ?></td>
	        <td><input type="text" name="pagseguro_eft_token" value="<?php echo $pagseguro_eft_token; ?>" size="50%" />
	          <?php if ($error_token) { ?>
	          <span class="error"><?php echo $error_token; ?></span>
	          <?php } ?></td>
	      </tr>
	      <tr>
	        <td><span class="required">*</span> <?php echo $entry_email; ?></td>
	        <td><input type="text" name="pagseguro_eft_email" value="<?php echo $pagseguro_eft_email; ?>" size="50%" />
	          <?php if ($error_email) { ?>
	          <span class="error"><?php echo $error_email; ?></span>
	          <?php } ?></td>
	      </tr>

              <tr>
	        <td><?php echo $entry_text_information; ?></td>
                <td><textarea name="pagseguro_eft_text_information" cols="40" rows="5"><?php echo $pagseguro_eft_text_information; ?></textarea></td>
	      </tr>
              
              <tr>
	        <td><?php echo $entry_order_aguardando_pagamento; ?></td>
	        <td><select name="pagseguro_eft_order_aguardando_pagamento" id="pagseguro_eft_order_aguardando_pagamento">
	          <?php foreach ($order_statuses as $order_status) { ?>
	          <?php if ($order_status['order_status_id'] == $pagseguro_eft_order_aguardando_pagamento) { ?>
	          <option value="<?php echo $order_status['order_status_id']; ?>" selected="selected"><?php echo $order_status['name']; ?></option>
	          <?php } else { ?>
	          <option value="<?php echo $order_status['order_status_id']; ?>"><?php echo $order_status['name']; ?></option>
	          <?php } ?>
	          <?php } ?>
	        </select>
	        </td>
	      </tr>
	      <tr>
	        <td><?php echo $entry_order_analise; ?></td>
	        <td><select name="pagseguro_eft_order_analise" id="pagseguro_eft_order_analise">
	          <?php foreach ($order_statuses as $order_status) { ?>
	          <?php if ($order_status['order_status_id'] == $pagseguro_eft_order_analise) { ?>
	          <option value="<?php echo $order_status['order_status_id']; ?>" selected="selected"><?php echo $order_status['name']; ?></option>
	          <?php } else { ?>
	          <option value="<?php echo $order_status['order_status_id']; ?>"><?php echo $order_status['name']; ?></option>
	          <?php } ?>
	          <?php } ?>
	        </select>
	        </td>
	      </tr>
	      <tr>
	        <td><?php echo $entry_order_paga; ?></td>
	        <td><select name="pagseguro_eft_order_paga" id="pagseguro_eft_order_paga">
	          <?php foreach ($order_statuses as $order_status) { ?>
	          <?php if ($order_status['order_status_id'] == $pagseguro_eft_order_paga) { ?>
	          <option value="<?php echo $order_status['order_status_id']; ?>" selected="selected"><?php echo $order_status['name']; ?></option>
	          <?php } else { ?>
	          <option value="<?php echo $order_status['order_status_id']; ?>"><?php echo $order_status['name']; ?></option>
	          <?php } ?>
	          <?php } ?>
	        </select>
	         </td>
	      </tr>
	      <tr>
	        <td><?php echo $entry_order_disponivel; ?></td>
	        <td><select name="pagseguro_eft_order_disponivel" id="pagseguro_eft_order_disponivel">
	          <?php foreach ($order_statuses as $order_status) { ?>
	          <?php if ($order_status['order_status_id'] == $pagseguro_eft_order_disponivel) { ?>
	          <option value="<?php echo $order_status['order_status_id']; ?>" selected="selected"><?php echo $order_status['name']; ?></option>
	          <?php } else { ?>
	          <option value="<?php echo $order_status['order_status_id']; ?>"><?php echo $order_status['name']; ?></option>
	          <?php } ?>
	          <?php } ?>
	        </select>
	         </td>
	      </tr>
	      <tr>
	        <td><?php echo $entry_order_disputa; ?></td>
	        <td><select name="pagseguro_eft_order_disputa" id="pagseguro_eft_order_disputa">
	          <?php foreach ($order_statuses as $order_status) { ?>
	          <?php if ($order_status['order_status_id'] == $pagseguro_eft_order_disputa) { ?>
	          <option value="<?php echo $order_status['order_status_id']; ?>" selected="selected"><?php echo $order_status['name']; ?></option>
	          <?php } else { ?>
	          <option value="<?php echo $order_status['order_status_id']; ?>"><?php echo $order_status['name']; ?></option>
	          <?php } ?>
	          <?php } ?>
	        </select>
	         </td>
	      </tr>
	      <tr>
	        <td><?php echo $entry_order_devolvida; ?></td>
	        <td><select name="pagseguro_eft_order_devolvida" id="pagseguro_eft_order_devolvida">
	          <?php foreach ($order_statuses as $order_status) { ?>
	          <?php if ($order_status['order_status_id'] == $pagseguro_eft_order_devolvida) { ?>
	          <option value="<?php echo $order_status['order_status_id']; ?>" selected="selected"><?php echo $order_status['name']; ?></option>
	          <?php } else { ?>
	          <option value="<?php echo $order_status['order_status_id']; ?>"><?php echo $order_status['name']; ?></option>
	          <?php } ?>
	          <?php } ?>
	        </select>
	         </td>
	      </tr>
	      <tr>
	        <td><?php echo $entry_order_cancelada; ?></td>
	        <td><select name="pagseguro_eft_order_cancelada" id="pagseguro_eft_order_cancelada">
	          <?php foreach ($order_statuses as $order_status) { ?>
	          <?php if ($order_status['order_status_id'] == $pagseguro_eft_order_cancelada) { ?>
	          <option value="<?php echo $order_status['order_status_id']; ?>" selected="selected"><?php echo $order_status['name']; ?></option>
	          <?php } else { ?>
	          <option value="<?php echo $order_status['order_status_id']; ?>"><?php echo $order_status['name']; ?></option>
	          <?php } ?>
	          <?php } ?>
	        </select>
	         </td>
	      </tr>
              <tr>
	        <td><?php echo $entry_order_chargeback_debitado; ?></td>
	        <td><select name="pagseguro_eft_order_chargeback_debitado" id="pagseguro_eft_order_chargeback_debitado">
	          <?php foreach ($order_statuses as $order_status) { ?>
	          <?php if ($order_status['order_status_id'] == $pagseguro_eft_order_chargeback_debitado) { ?>
	          <option value="<?php echo $order_status['order_status_id']; ?>" selected="selected"><?php echo $order_status['name']; ?></option>
	          <?php } else { ?>
	          <option value="<?php echo $order_status['order_status_id']; ?>"><?php echo $order_status['name']; ?></option>
	          <?php } ?>
	          <?php } ?>
	        </select>
	         </td>
	      </tr>
              <tr>
	        <td><?php echo $entry_order_contestacao; ?></td>
	        <td><select name="pagseguro_eft_order_contestacao" id="pagseguro_eft_order_contestacao">
	          <?php foreach ($order_statuses as $order_status) { ?>
	          <?php if ($order_status['order_status_id'] == $pagseguro_eft_order_contestacao) { ?>
	          <option value="<?php echo $order_status['order_status_id']; ?>" selected="selected"><?php echo $order_status['name']; ?></option>
	          <?php } else { ?>
	          <option value="<?php echo $order_status['order_status_id']; ?>"><?php echo $order_status['name']; ?></option>
	          <?php } ?>
	          <?php } ?>
	        </select>
	         </td>
	      </tr>
	      <tr>
	      <tr>
	        <td><?php echo $entry_geo_zone; ?></td>
	        <td>
			  <select name="pagseguro_eft_geo_zone_id">
	            <option value="0"><?php echo $text_all_zones; ?></option>
	            <?php foreach ($geo_zones as $geo_zone) { ?>
	            <?php if ($geo_zone['geo_zone_id'] == $pagseguro_eft_geo_zone_id) { ?>
	            <option value="<?php echo $geo_zone['geo_zone_id']; ?>" selected="selected"><?php echo $geo_zone['name']; ?></option>
	            <?php } else { ?>
	            <option value="<?php echo $geo_zone['geo_zone_id']; ?>"><?php echo $geo_zone['name']; ?></option>
	           <?php } ?>
	            <?php } ?>
	          </select>
			</td>
	      </tr>
	      <tr>
	        <td><?php echo $entry_status; ?></td>
	        <td>
			  <select name="pagseguro_eft_status">
	            <?php if ($pagseguro_eft_status) { ?>
	            <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
	            <option value="0"><?php echo $text_disabled; ?></option>
	            <?php } else { ?>
	            <option value="1"><?php echo $text_enabled; ?></option>
	            <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
	            <?php } ?>
	          </select>
			</td>
	      </tr>
	      <tr>
	        <td><?php echo $entry_sort_order; ?></td>
	        <td><input type="text" name="pagseguro_eft_sort_order" value="<?php echo $pagseguro_eft_sort_order; ?>" size="1" /></td>
	      </tr>
	    </table>
      </form>
    </div>
  </div>
</div>
<?php echo $footer; ?>