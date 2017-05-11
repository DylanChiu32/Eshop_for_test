<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="Generator" content="haohaios v1.0" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>商家管理平台</title>
<link href="templates/css/layout.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../js/haohaios.js"></script>
<script type="text/javascript" src="../js/user.js"></script>
<script type="text/javascript" src="../js/region.js"></script>
<script type="text/javascript" src="../js/utils.js"></script>
<script type="text/javascript" src="../js/jquery.js"></script>
<script type="text/javascript" src="templates/js/main.js"></script>
<script type="text/javascript" src="templates/js/supp.js"></script>
<script type="text/javascript" src="../<?php echo $this->_var['admin_path']; ?>/js/listtable.js"></script>
<script>
var process_request = "<?php echo $this->_var['lang']['process_request']; ?>";
</script>

</head>

<body onload="pageheight()">

	<?php echo $this->fetch('library/lift_menu.lbi'); ?>


 
  <div class="main" id="main">
		<div class="maintop">
			<img src="templates/images/title_goods.png" /><span>订单管理</span>
		</div>
        <div class="maincon">
			<div class="contitlelist">
            	<span>生成发货单</span>
            </div>
		  <div class="conbox">

  
  
  <form action="index.php?op=order&act=operate_post" method="post" name="theForm">
<div class="list-div" style="margin-bottom: 5px">
<table width="100%" cellpadding="3" cellspacing="1">
  <tr>
    <th colspan="4"><?php echo $this->_var['lang']['base_info']; ?>的</th>
  </tr>
  <tr>
    <td width="18%"><div align="right"><strong><?php echo $this->_var['lang']['label_order_sn']; ?></strong></div></td>
   <td width="34%"><?php echo $this->_var['order']['order_sn']; ?><?php if ($this->_var['order']['extension_code'] == "group_buy"): ?><a href="group_buy.php?act=edit&id=<?php echo $this->_var['order']['extension_id']; ?>"><?php echo $this->_var['lang']['group_buy']; ?></a><?php elseif ($this->_var['order']['extension_code'] == "exchange_goods"): ?><a href="exchange_goods.php?act=edit&id=<?php echo $this->_var['order']['extension_id']; ?>"><?php echo $this->_var['lang']['exchange_goods']; ?></a><?php endif; ?>
    <td><div align="right"><strong><?php echo $this->_var['lang']['label_order_time']; ?></strong></div></td>
    <td><?php echo $this->_var['order']['formated_add_time']; ?></td>
  </tr>
  <tr>
    <td><div align="right"><strong><?php echo $this->_var['lang']['label_user_name']; ?></strong></div></td>
    <td><?php echo empty($this->_var['order']['user_name']) ? $this->_var['lang']['anonymous'] : $this->_var['order']['user_name']; ?></td>
    <td><div align="right"></div></td>
    <td>&nbsp;</td>
  </tr>
<!--	<?php if ($this->_var['exist_real_goods']): ?>
  <tr>
    <td><div align="right"><strong><?php echo $this->_var['lang']['label_invoice_no']; ?></strong></div></td>
    <td colspan="3"><input name="delivery[invoice_no]" type="text" id="invoice_no" value="" size="20"/><input name="delivery_hidden" type="hidden" value="<?php echo $this->_var['exist_real_goods']; ?>" /></td>
  </tr>
	<?php endif; ?>-->
  <tr>
    <th colspan="4"><?php echo $this->_var['lang']['consignee_info']; ?></th>
    </tr>
  <tr>
    <td><div align="right"><strong><?php echo $this->_var['lang']['label_consignee']; ?></strong></div></td>
    <td><?php echo htmlspecialchars($this->_var['order']['consignee']); ?></td>
    <td><div align="right"><strong><?php echo $this->_var['lang']['label_email']; ?></strong></div></td>
    <td><?php echo $this->_var['order']['email']; ?></td>
  </tr>
  <tr>
    <td><div align="right"><strong><?php echo $this->_var['lang']['label_address']; ?></strong></div></td>
    <td>[<?php echo $this->_var['order']['region']; ?>] <?php echo htmlspecialchars($this->_var['order']['address']); ?></td>
    <td><div align="right"><strong><?php echo $this->_var['lang']['label_zipcode']; ?></strong></div></td>
    <td><?php echo htmlspecialchars($this->_var['order']['zipcode']); ?></td>
  </tr>
  <tr>
    <td><div align="right"><strong><?php echo $this->_var['lang']['label_tel']; ?></strong></div></td>
    <td><?php echo $this->_var['order']['tel']; ?></td>
    <td><div align="right"><strong><?php echo $this->_var['lang']['label_mobile']; ?></strong></div></td>
    <td><?php echo htmlspecialchars($this->_var['order']['mobile']); ?></td>
  </tr>
</table>
</div>

<div class="list-div" style="margin-bottom: 5px">
<table width="100%" cellpadding="3" cellspacing="1">
  <tr>
    <th colspan="9" scope="col"><?php echo $this->_var['lang']['goods_info']; ?></th>
    </tr>
  <tr>
    <td scope="col"><div align="center"><strong><?php echo $this->_var['lang']['goods_name_brand']; ?></strong></div></td>
    <td scope="col"><div align="center"><strong><?php echo $this->_var['lang']['goods_sn']; ?></strong></div></td>
    <td scope="col"><div align="center"><strong><?php echo $this->_var['lang']['product_sn']; ?></strong></div></td>
    <td scope="col"><div align="center"><strong><?php echo $this->_var['lang']['goods_attr']; ?></strong></div></td>
    <?php if ($this->_var['suppliers_list'] != 0): ?>
    <td scope="col"><div align="center"><strong><?php echo $this->_var['lang']['suppliers_name']; ?></strong></div></td>
    <?php endif; ?>
    <td scope="col"><div align="center"><strong><?php echo $this->_var['lang']['storage']; ?></strong></div></td>
    <td scope="col"><div align="center"><strong><?php echo $this->_var['lang']['goods_number']; ?></strong></div></td>
    <td scope="col"><div align="center"><strong><?php echo $this->_var['lang']['goods_delivery']; ?></strong></div></td>
    <td scope="col"><div align="center"><strong><?php echo $this->_var['lang']['goods_delivery_curr']; ?></strong></div></td>
  </tr>
  <?php $_from = $this->_var['goods_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'goods');if (count($_from)):
    foreach ($_from AS $this->_var['goods']):
?>
    
    <?php if ($this->_var['goods']['goods_id'] > 0 && $this->_var['goods']['extension_code'] == 'package_buy'): ?>
      <tr>
        <td><?php echo $this->_var['goods']['goods_name']; ?><span style="color:#FF0000;"><?php echo $this->_var['lang']['remark_package']; ?></span></td>
        <td><?php echo $this->_var['goods']['goods_sn']; ?></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
       <?php if ($this->_var['suppliers_list'] != 0): ?>
        <td><div align="right"></div></td>
       <?php endif; ?>
        <td><div align="right"></div></td>
        <td><div align="right"><?php echo $this->_var['goods']['goods_number']; ?></div></td>
        <td><div align="right"></div></td>
        <td><div align="right"></div></td>
      </tr>
      <?php $_from = $this->_var['goods']['package_goods_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'package');if (count($_from)):
    foreach ($_from AS $this->_var['package']):
?>
      <tr>
        <td>--&nbsp;<a href="goods.php?id=<?php echo $this->_var['package']['goods_id']; ?>" target="_blank"><?php echo $this->_var['package']['goods_name']; ?></a></td>
        <td><?php echo $this->_var['package']['goods_sn']; ?></td>
        <td><?php echo $this->_var['package']['product_sn']; ?></td>
        <td><?php echo $this->_var['package']['goods_attr_str']; ?></td>
        <?php if ($this->_var['suppliers_list'] != 0): ?>
        <td><div align="right"><?php echo empty($this->_var['suppliers_name'][$this->_var['package']['suppliers_id']]) ? $this->_var['lang']['restaurant'] : $this->_var['suppliers_name'][$this->_var['package']['suppliers_id']]; ?></div></td>
        <?php endif; ?>
        <td><div align="right"><?php echo $this->_var['package']['storage']; ?></div></td>
        <td><div align="right"><?php echo $this->_var['package']['order_send_number']; ?></div></td>
        <td><div align="right"><?php echo $this->_var['package']['sended']; ?></div></td>
        <td><div align="right"><input name="send_number[<?php echo $this->_var['goods']['rec_id']; ?>][<?php echo $this->_var['package']['g_p']; ?>]" type="text" id="send_number_<?php echo $this->_var['goods']['rec_id']; ?>_<?php echo $this->_var['package']['g_p']; ?>" value="<?php echo $this->_var['package']['send']; ?>" size="10" maxlength="11" <?php echo $this->_var['package']['readonly']; ?>/></div></td>
      </tr>
      <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>

    <?php else: ?>
    <tr>
      <td align="center">
      <?php if ($this->_var['goods']['goods_id'] > 0 && $this->_var['goods']['extension_code'] != 'package_buy'): ?>
      <a href="goods.php?id=<?php echo $this->_var['goods']['goods_id']; ?>" target="_blank"><?php echo $this->_var['goods']['goods_name']; ?> <?php if ($this->_var['goods']['brand_name']): ?>[ <?php echo $this->_var['goods']['brand_name']; ?> ]<?php endif; ?>
      <?php if ($this->_var['goods']['is_gift']): ?><?php if ($this->_var['goods']['goods_price'] > 0): ?><?php echo $this->_var['lang']['remark_favourable']; ?><?php else: ?><?php echo $this->_var['lang']['remark_gift']; ?><?php endif; ?><?php endif; ?>
      <?php if ($this->_var['goods']['parent_id'] > 0): ?><?php echo $this->_var['lang']['remark_fittings']; ?><?php endif; ?></a>
      <?php endif; ?>
      </td>
      <td align="center"><?php echo $this->_var['goods']['goods_sn']; ?></td>
      <td align="center"><?php echo $this->_var['goods']['product_sn']; ?></td>
      <td align="center"><?php echo nl2br($this->_var['goods']['goods_attr']); ?></td>
      <?php if ($this->_var['suppliers_list'] != 0): ?>
      <td align="center"><?php echo empty($this->_var['suppliers_name'][$this->_var['goods']['suppliers_id']]) ? $this->_var['lang']['restaurant'] : $this->_var['suppliers_name'][$this->_var['goods']['suppliers_id']]; ?></td>
      <?php endif; ?>
      <td align="center"><?php echo $this->_var['goods']['storage']; ?></td>
      <td align="center"><?php echo $this->_var['goods']['goods_number']; ?></td>
      <td align="center"><?php echo $this->_var['goods']['sended']; ?></td>
      <td align="center"><?php echo $this->_var['goods']['send']; ?><input name="send_number[<?php echo $this->_var['goods']['rec_id']; ?>]"  type="hidden" id="send_number_<?php echo $this->_var['goods']['rec_id']; ?>" value="<?php echo $this->_var['goods']['send']; ?>" size="10" maxlength="11" <?php echo $this->_var['goods']['readonly']; ?>/></div></td>
    </tr>
    <?php endif; ?>
  <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
</table>
</div>

<div class="list-div" style="margin-bottom: 5px">
<table cellpadding="3" cellspacing="1">
  <tr>
    <th colspan="6"><?php echo $this->_var['lang']['action_info']; ?></th>
  </tr>
  <?php if ($this->_var['account_list'] != 0 && 0): ?>
  <tr>
    <td><div align="right"><strong>分店：</strong></div></td>
  <td colspan="5"><select name="supp_account_id" id="supp_account_id">
        <option value="0" selected="true">不指定分店总店自行处理</option>
        <?php $_from = $this->_var['account_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'suppliers');if (count($_from)):
    foreach ($_from AS $this->_var['suppliers']):
?>
        <option value="<?php echo $this->_var['suppliers']['account_id']; ?>"><?php echo $this->_var['suppliers']['name']; ?></option>
        <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
      </select></td>
  </tr>
  <?php endif; ?>
  <tr>
    <td><div align="right"><strong><?php echo $this->_var['lang']['label_action_note']; ?></strong></div></td>
  <td colspan="5"><textarea name="action_note" cols="80" rows="3"><?php echo $this->_var['action_note']; ?></textarea></td>
  </tr>
  <tr>
    <td colspan="6" align="center">
        <input name="delivery_confirmed" type="submit" value="确认生成发货单"  class="button"/>&nbsp;&nbsp;
        <input type="button" value="取消生成" class="button" onclick="location.href='suppliers.php?act=order_info&order_id=<?php echo $this->_var['order_id']; ?>'" />


        <input name="order_id" type="hidden" value="<?php echo $this->_var['order']['order_id']; ?>">
        <input name="delivery[order_sn]" type="hidden" value="<?php echo $this->_var['order']['order_sn']; ?>">
        <input name="delivery[add_time]" type="hidden" value="<?php echo $this->_var['order']['order_time']; ?>">
        <input name="delivery[user_id]" type="hidden" value="<?php echo $this->_var['order']['user_id']; ?>">
        <input name="delivery[how_oos]" type="hidden" value="<?php echo $this->_var['order']['how_oos']; ?>">
        <input name="delivery[shipping_id]" type="hidden" value="<?php echo $this->_var['order']['shipping_id']; ?>">
        <input name="delivery[shipping_fee]" type="hidden" value="<?php echo $this->_var['order']['shipping_fee']; ?>">

        <input name="delivery[consignee]" type="hidden" value="<?php echo $this->_var['order']['consignee']; ?>">
        <input name="delivery[address]" type="hidden" value="<?php echo $this->_var['order']['address']; ?>">
        <input name="delivery[country]" type="hidden" value="<?php echo $this->_var['order']['country']; ?>">
        <input name="delivery[province]" type="hidden" value="<?php echo $this->_var['order']['province']; ?>">
        <input name="delivery[city]" type="hidden" value="<?php echo $this->_var['order']['city']; ?>">
        <input name="delivery[district]" type="hidden" value="<?php echo $this->_var['order']['district']; ?>">
        <input name="delivery[sign_building]" type="hidden" value="<?php echo $this->_var['order']['sign_building']; ?>">
        <input name="delivery[email]" type="hidden" value="<?php echo $this->_var['order']['email']; ?>">
        <input name="delivery[zipcode]" type="hidden" value="<?php echo $this->_var['order']['zipcode']; ?>">
        <input name="delivery[tel]" type="hidden" value="<?php echo $this->_var['order']['tel']; ?>">
        <input name="delivery[mobile]" type="hidden" value="<?php echo $this->_var['order']['mobile']; ?>">
        <input name="delivery[best_time]" type="hidden" value="<?php echo $this->_var['order']['best_time']; ?>">
        <input name="delivery[postscript]" type="hidden" value="<?php echo $this->_var['order']['postscript']; ?>">

        <input name="delivery[how_oos]" type="hidden" value="<?php echo $this->_var['order']['how_oos']; ?>">
        <input name="delivery[insure_fee]" type="hidden" value="<?php echo $this->_var['order']['insure_fee']; ?>">
        <input name="delivery[shipping_fee]" type="hidden" value="<?php echo $this->_var['order']['shipping_fee']; ?>">
        <input name="delivery[agency_id]" type="hidden" value="<?php echo $this->_var['order']['agency_id']; ?>">
        <input name="delivery[shipping_name]" type="hidden" value="<?php echo $this->_var['order']['shipping_name']; ?>">
        <input name="operation" type="hidden" value="<?php echo $this->_var['operation']; ?>">
    </td>
    </tr>
</table>
</div>
</form>
        </div>
       </div>
        </div>
    
</body>

</html>