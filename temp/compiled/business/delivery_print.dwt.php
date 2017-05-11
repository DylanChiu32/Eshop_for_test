<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="Generator" content="haohaios v1.0" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>提货单</title>
</head>
<body>
	<table width="100%" border="0" cellpadding="5" cellspacing="1">
	<tr><td colspan="7" align="center" >提货单</td></tr>
	</table>
    <table style="background-color:black"  width="100%" border="0" cellpadding="5" cellspacing="1">
        
        <tr>
        <th align="center" bgcolor="#FFFFFF">分店</th>
          <th align="center" bgcolor="#FFFFFF">订单号</th>
            <th align="center" bgcolor="#FFFFFF">提货人</th>
            <th align="center" bgcolor="#FFFFFF">下单时间</th>		
          <th align="center" bgcolor="#FFFFFF">收货人</th>
 		  <th align="center" bgcolor="#FFFFFF">提货时间</th>
           <th align="center" bgcolor="#FFFFFF">提货状态</th>
			<th align="center" bgcolor="#FFFFFF">备注</th>
        </tr>
        <?php if ($this->_var['delivery_list']): ?>
        <?php $_from = $this->_var['delivery_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'item');$this->_foreach['name'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['name']['total'] > 0):
    foreach ($_from AS $this->_var['item']):
        $this->_foreach['name']['iteration']++;
?>
        <tr>
         <td align="center" bgcolor="#FFFFFF"><?php if ($this->_var['item']['supp_account_name']): ?><?php echo $this->_var['item']['supp_account_name']; ?><?php else: ?>未指派<?php endif; ?></td>
          <td align="center" bgcolor="#FFFFFF"><?php echo $this->_var['item']['order_sn']; ?></td>
           <td align="center" bgcolor="#FFFFFF"><?php echo $this->_var['item']['delivery_person']; ?></td>
           <td align="center" bgcolor="#FFFFFF"><?php echo $this->_var['item']['add_time']; ?></td>
          <td align="center" bgcolor="#FFFFFF"><?php echo $this->_var['item']['consignee']; ?></td>
          <td align="center" bgcolor="#FFFFFF"><?php echo $this->_var['item']['update_time']; ?></td>
          <td align="center" bgcolor="#FFFFFF"><?php echo $this->_var['item']['status_name']; ?></td>

           <td align="center" bgcolor="#FFFFFF"></td>
        </tr>
        <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
		<tr>

          <td align="center" colspan="4" bgcolor="#FFFFFF">合计</td> 
          <td align="center" bgcolor="#FFFFFF"><?php echo $this->_var['total_settlement_amount']; ?></td>
          <td align="center" bgcolor="#FFFFFF"></td>
          <td align="center" bgcolor="#FFFFFF"></td>
		<td align="center" bgcolor="#FFFFFF"></td>
        </tr>
        <?php else: ?>
        <tr>
          <td colspan="8" bgcolor="#FFFFFF">无可结算订单</td>
        </tr>
        <?php endif; ?>
      </table>
 </body>
</html>