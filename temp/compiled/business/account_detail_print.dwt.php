<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="Generator" content="haohaios v1.0" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $this->_var['title']; ?></title>
</head>
<body>
	<table width="100%" border="0" cellpadding="5" cellspacing="1">
	<tr><td colspan="7" align="center" ><?php echo $this->_var['title']; ?></td></tr>
	</table>
    <table style="background-color:black"  width="100%" border="0" cellpadding="5" cellspacing="1">
        
        <tr>
        <th align="center" bgcolor="#FFFFFF">序号</th>
          <th align="center" bgcolor="#FFFFFF">订单号</th>
           <th align="center" bgcolor="#FFFFFF">商品名称</th>
           <th align="center" bgcolor="#FFFFFF">订单时间</th>	
           <th align="center" bgcolor="#FFFFFF">商品数量</th>	
          <th align="center" bgcolor="#FFFFFF">订单金额</th>
          <th align="center" bgcolor="#FFFFFF">佣金</th>
          <th align="center" bgcolor="#FFFFFF">结算金额</th>
			<th align="center" bgcolor="#FFFFFF">备注</th>
        </tr>
        <?php if ($this->_var['account_detail']): ?>
        <?php $_from = $this->_var['account_detail']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'item');$this->_foreach['name'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['name']['total'] > 0):
    foreach ($_from AS $this->_var['item']):
        $this->_foreach['name']['iteration']++;
?>
        <tr>
         <td align="center" bgcolor="#FFFFFF"><?php echo $this->_foreach['name']['iteration']; ?></td>
          <td align="center" bgcolor="#FFFFFF"><?php echo $this->_var['item']['order_sn']; ?></td>
           <td align="center" bgcolor="#FFFFFF"><?php echo $this->_var['item']['goods_name']; ?></td>
          <td align="center" bgcolor="#FFFFFF"><?php echo $this->_var['item']['order_time']; ?></td>
           <td align="center" bgcolor="#FFFFFF"><?php echo $this->_var['item']['total_goods_num']; ?></td>
          
          <td align="center" bgcolor="#FFFFFF"><?php echo $this->_var['item']['amount']; ?></td>
          <td align="center" bgcolor="#FFFFFF"><?php echo $this->_var['item']['commission']; ?></td>
          <td align="center" bgcolor="#FFFFFF"><?php echo $this->_var['item']['money']; ?></td>
           <td align="center" bgcolor="#FFFFFF"></td>
        </tr>
        <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
		<tr>

          <td align="center" colspan="5" bgcolor="#FFFFFF">合计</td> 
          <td align="center" bgcolor="#FFFFFF"><?php echo $this->_var['total_amount']; ?></td>
          <td align="center" bgcolor="#FFFFFF"><?php echo $this->_var['total_commission']; ?></td>
          <td align="center" bgcolor="#FFFFFF"><?php echo $this->_var['total_money']; ?></td>
		<td align="center" bgcolor="#FFFFFF"></td>
        </tr>
        <?php else: ?>
        <tr>
          <td colspan="7" bgcolor="#FFFFFF">无可结算订单</td>
        </tr>
        <?php endif; ?>
      </table>
 </body>
</html>