<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="Generator" content="haohaios v1.0" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>商家管理平台</title>
<link href="templates/css/layout.css" rel="stylesheet" type="text/css" />
</head>
<body>

        <div class="maincon" style="width:100%">
			<div class="contitlelist" style="background-color:#cccccc;color:black;">
            	<span>提货详情</span>
            </div>
		  <div class="conbox" >         
<table width="100%" cellpadding="3" cellspacing="1">
  <tr>
    <th colspan="4">订单信息</th>
  </tr>
  <tr>
    <td><div align="right"><strong><?php echo $this->_var['lang']['delivery_sn_number']; ?></strong></div></td>
    <td><?php echo $this->_var['delivery_order']['delivery_sn']; ?></td>
    <td><div align="right"><strong><?php echo $this->_var['lang']['label_shipping_time']; ?></strong></div></td>
    <td><?php echo $this->_var['delivery_order']['formated_update_time']; ?></td>
  </tr>
  <tr>
    <td width="16%" height="25"><div align="right"><strong><?php echo $this->_var['lang']['label_order_sn']; ?></strong></div></td>
   <td width="34%" height="25"><?php echo $this->_var['delivery_order']['order_sn']; ?><?php if ($this->_var['delivery_order']['extension_code'] == "group_buy"): ?><a href="group_buy.php?act=edit&id=<?php echo $this->_var['delivery_order']['extension_id']; ?>"><?php echo $this->_var['lang']['group_buy']; ?></a><?php elseif ($this->_var['delivery_order']['extension_code'] == "exchange_goods"): ?><a href="exchange_goods.php?act=edit&id=<?php echo $this->_var['delivery_order']['extension_id']; ?>"><?php echo $this->_var['lang']['exchange_goods']; ?></a><?php endif; ?>
    <td width="16%" height="25"><div align="right"><strong><?php echo $this->_var['lang']['label_order_time']; ?></strong></div></td>
    <td height="25"><?php echo $this->_var['delivery_order']['formated_add_time']; ?></td>
  </tr>
  <tr>
    <td height="25"><div align="right"><strong><?php echo $this->_var['lang']['label_user_name']; ?></strong></div></td>
    <td height="25"><?php echo empty($this->_var['delivery_order']['user_name']) ? $this->_var['lang']['anonymous'] : $this->_var['delivery_order']['user_name']; ?></td>

    <td height="25"><div align="right"><strong>提货人：</strong></div></td>
    <td height="25">__________________&nbsp;&nbsp;&nbsp;&nbsp;<strong>提货日期：</strong>____年____月____日
    </td>
  </tr>
  </table><br />
  <hr style="border-style:dashed;"/><br />
  <table width="100%" cellpadding="3" cellspacing="1">
  <tr>
    <th height="25" colspan="4"><?php echo $this->_var['lang']['consignee_info']; ?></th>
    </tr>
  <tr>
    <td height="25" width="16%"><div align="right"><strong><?php echo $this->_var['lang']['label_consignee']; ?></strong></div></td>
    <td height="25" width="34%"><?php echo htmlspecialchars($this->_var['delivery_order']['consignee']); ?></td>
    <td height="25" width="16%"><div align="right"><strong><?php echo $this->_var['lang']['label_email']; ?></strong></div></td>
    <td height="25"><?php echo $this->_var['delivery_order']['email']; ?></td>
  </tr>
  <tr>
    <td height="25"><div align="right"><strong><?php echo $this->_var['lang']['label_address']; ?></strong></div></td>
    <td height="25">[<?php echo $this->_var['delivery_order']['region']; ?>] <?php echo htmlspecialchars($this->_var['delivery_order']['address']); ?></td>
    <td height="25"><div align="right"><strong><?php echo $this->_var['lang']['label_zipcode']; ?></strong></div></td>
    <td height="25"><?php echo htmlspecialchars($this->_var['delivery_order']['zipcode']); ?></td>
  </tr>
  <tr>
    <td height="25"><div align="right"><strong><?php echo $this->_var['lang']['label_tel']; ?></strong></div></td>
    <td height="25"><?php echo $this->_var['delivery_order']['tel']; ?></td>
    <td height="25"><div align="right"><strong><?php echo $this->_var['lang']['label_mobile']; ?></strong></div></td>
    <td height="25"><?php echo htmlspecialchars($this->_var['delivery_order']['mobile']); ?></td>
  </tr>
</table>
<br />
  <hr style="border-style:dashed;"/><br />
<table width="100%" cellpadding="3"  cellspacing="1">
  <tr>
    <th colspan="4">商家信息</th>
  </tr>
  <tr>
    <td><div align="right"><strong>商家名称：</strong></div></td>
    <td><?php echo $this->_var['suppliers_info']['suppliers_name']; ?></td>
    <td><div align="right"><strong>商家地址：</strong></div></td>
    <td>[<?php echo $this->_var['suppliers_info']['region']; ?>]<?php echo $this->_var['suppliers_info']['address']; ?></td>
  </tr>
  <tr>
    <td width="16%" height="25"><div align="right"><strong>联系方式：</strong></div></td>
   <td width="34%" height="25"><?php echo $this->_var['suppliers_info']['phone']; ?></td>
    <td width="16%" height="25"><div align="right"><strong></strong></div></td>
    <td height="25"></td>
  </tr>
  </table>
  <br />
  <hr style="border-style:dashed;"/><br />
 <table width="100%" cellpadding="3" cellspacing="1" >
  <tr>
    <th colspan="7" scope="col"><?php echo $this->_var['lang']['goods_info']; ?></th>
    </tr>
  <tr>
    <td align="center"><strong><?php echo $this->_var['lang']['goods_name_brand']; ?></strong></td>
    <td align="center" ><strong><?php echo $this->_var['lang']['goods_sn']; ?></strong></td>
    <td align="center" ><strong><?php echo $this->_var['lang']['product_sn']; ?></strong></td>
    <td align="center" ><strong><?php echo $this->_var['lang']['goods_attr']; ?></strong></td>
    <td align="center" ><strong><?php echo $this->_var['lang']['label_send_number']; ?></strong></td>
    <td align="center" ><strong>单价</strong></td>
    <td align="center" ><strong>小计</strong></td>
    
  </tr>
  <?php $_from = $this->_var['goods_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'goods');if (count($_from)):
    foreach ($_from AS $this->_var['goods']):
?>
  <tr>
    <td align="center">
   <?php echo $this->_var['goods']['goods_name']; ?> <?php if ($this->_var['goods']['brand_name']): ?>[ <?php echo $this->_var['goods']['brand_name']; ?> ]<?php endif; ?>
    </td>
    <td align="center"><?php echo $this->_var['goods']['goods_sn']; ?></td>
    <td align="center"><?php echo $this->_var['goods']['product_sn']; ?></td>
    <td align="center"><?php echo nl2br($this->_var['goods']['goods_attr']); ?></td>
    <td align="center"><?php echo $this->_var['goods']['send_number']; ?></td>
    <td align="center"><?php echo $this->_var['goods']['goods_price']; ?></td>
    <td align="right"><?php echo $this->_var['goods']['goods_amount']; ?></td>
  </tr>
  <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
  <tr>
	<td colspan="5"> </td>
<td align="right" colspan="2">商品总金额：<?php echo $this->_var['total_goods_amount']; ?></td>
</tr>
</table>
<!-- 
<table width="100%" border="0">
<tbody>
<tr align="right">
<td> = 订单总金额：￥10.00 </td>
</tr>
<tr align="right">
<td> = 应付款金额：￥10.00 </td>
</tr>
</tbody>
</table> -->
            </div>
       </div>

   </body>
</html>