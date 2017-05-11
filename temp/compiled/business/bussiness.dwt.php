<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="Generator" content="haohaios v1.0" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>商家管理平台</title>
<link href="templates/css/layout.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../js/jquery.js"></script>
<script type="text/javascript" src="../js/haohaios.js"></script>
<script type="text/javascript" src="../js/user.js"></script>
<script type="text/javascript" src="../js/region.js"></script>
<script type="text/javascript" src="../js/utils.js"></script>

<script type="text/javascript" src="templates/js/main.js"></script>
<script type="text/javascript" src="templates/js/supp.js"></script>
<script type="text/javascript" src="../<?php echo $this->_var['admin_path']; ?>/js/listtable.js"></script>
<script language="javascript" type="text/javascript" src="../js/DatePicker/WdatePicker.js"></script>


<script>
var process_request = "<?php echo $this->_var['lang']['process_request']; ?>";
</script>
</head>
<body onload="pageheight()">
	<?php echo $this->fetch('library/lift_menu.lbi'); ?>
  <?php if ($this->_var['action'] == 'default' || $this->_var['action'] == 'waitcheck'): ?>
  <div class="main" id="main">
		<div class="maintop">
			<img src="templates/images/title_goods.png" /><span>未结算订单</span>
		</div>
        <div class="maincon">
			<div class="contitlelist">
            	<span>未结算订单列表</span>
              <div class="searchdiv">
          <form id="" name="form_order" method="get" action="bussiness.php">
            <div>起止时间：</div>
            <input class="Wdate" value="" type="text" size="17" onfocus="WdatePicker({dateFmt:'yyyy-M-d'})" readonly="readonly" name="start_time" style="padding:0;">
            <div>~</div>
            <input class="Wdate" value="" type="text" size="17" onfocus="WdatePicker({dateFmt:'yyyy-M-d'})" readonly="readonly" name="end_time" style="padding:0;">
            <input name="act" type="hidden" value="default">
            <input type="submit" class="btn" name="" value="搜索">
          </form>
        </div>
                 <div class="titleright"><a href="suppliers.php?act=my_order">往期结算</a><a href="?act=apply">申请结算</a></div>
            </div>
		  <div class="conbox">
<table cellspacing="0" cellpadding="0" class="listtable">
  <tr>
    <th align="left">订单编号</th>
    <th align="left">订单时间</th>
    <th align="left">支付金额</th>
    <th align="left">结算ID</th>
  </tr>  
  <?php $_from = $this->_var['goods_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'goods');if (count($_from)):
    foreach ($_from AS $this->_var['goods']):
?>
  <tr>
    <td align="left"><a href="suppliers.php?act=order_info&order_id=<?php echo $this->_var['goods']['order_id']; ?>"><?php echo $this->_var['goods']['order_sn']; ?></a></td>
    <td align="left"><?php echo $this->_var['goods']['add_time']; ?></td>
    <td align="left"><?php echo $this->_var['goods']['amount']; ?></td>
    <td align="left">
    <?php if ($this->_var['goods']['settlement_sn']): ?>
    <a href="?act=checked&sn=<?php echo $this->_var['goods']['settlement_sn']; ?>"><?php echo $this->_var['goods']['settlement_sn']; ?></a>
    <?php else: ?>
    -
    <?php endif; ?>
    </td>
  </tr>
  <?php endforeach; else: ?>
  <tr><td class="no-records" colspan="14"><?php echo $this->_var['lang']['no_records']; ?></td></tr>
  <?php endif; unset($_from); ?><?php $this->pop_vars();; ?>
</table>
<?php echo $this->fetch('library/pages.lbi'); ?>
        </div>
       </div>
        </div>
 <?php endif; ?>
   <?php if ($this->_var['action'] == 'view'): ?>
  <div class="main" id="main">
    <div class="maintop">
      <img src="templates/images/title_goods.png" /><span>结算订单详情</span>
    </div>
        <div class="maincon">
      <div class="contitlelist">
              <span>未结算订单列表</span>
                 <div class="titleright">
                 <?php if ($this->_var['settlement_status'] == 1): ?>
                 <a href="javascript:;">审核中</a>
                 <?php elseif ($this->_var['settlement_status'] == 2): ?>
                 <a href="javascript:;">已审核</a>
                 <?php elseif ($this->_var['settlement_status'] == 3): ?>
                 <a href="?act=checkout&id=<?php echo $this->_var['id']; ?>">确认收款</a>
                 <?php elseif ($this->_var['settlement_status'] == 4): ?>
                 <a href="javascript:;">已完成</a>
                 <?php else: ?>
                 <a href="javascript:;">有疑问</a>
                 <?php endif; ?>
                 <a href="suppliers.php?act=my_order">往期结算</a>
                 </div>
            </div>
      <div class="conbox">
<table cellspacing="0" cellpadding="0" class="listtable">
  <tr>
    <th align="left">编号</th>
    <th align="left">订单号</th>
    <th align="left">订单时间</th>
    <th align="left">订单金额</th>
    <!-- <th align="left">佣金</th> -->
    <th align="left">结算金额</th>
  </tr>  
  <?php $_from = $this->_var['goods_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'goods');if (count($_from)):
    foreach ($_from AS $this->_var['goods']):
?>
  <tr>
    <td align="left"><?php echo $this->_var['goods']['id']; ?></td>
    <td align="left"><a href="suppliers.php?act=order_info&order_id=<?php echo $this->_var['goods']['order_id']; ?>"><?php echo $this->_var['goods']['order_sn']; ?></a></td>
    <td align="left"><?php echo $this->_var['goods']['order_time']; ?></td>
    <td align="left"><?php echo $this->_var['goods']['amount']; ?></td>
    <!-- <td align="left"><?php echo $this->_var['goods']['commission']; ?></td> -->
    <td align="left"><?php echo $this->_var['goods']['money']; ?></td>
  </tr>
  <?php endforeach; else: ?>
  <tr><td class="no-records" colspan="14"><?php echo $this->_var['lang']['no_records']; ?></td></tr>
  <?php endif; unset($_from); ?><?php $this->pop_vars();; ?>
</table>
<?php echo $this->fetch('library/pages.lbi'); ?>

<table cellspacing="0" cellpadding="0" class="listtable">
<?php if ($this->_var['settlement_status'] == 5): ?>
<tr>
    <td align="center" colspan="3">该结算单存在分歧</td>
</tr>
<tr>
  <td colspan="3">
    <form action="?act=apply5" method="post">
      <textarea name="msg" cols="30" rows="3"></textarea>
      <input type="hidden" name="id" value="<?php echo $this->_var['id']; ?>" />
      <input type="submit" value="确定" />
    </form>
    申诉内容250字以内
  </td>
</tr>
<?php endif; ?>
<tr>
  <td>操作者</td>
  <td>操作时间</td>
  <td>内容</td>
</tr>
<?php $_from = $this->_var['logs']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'log');if (count($_from)):
    foreach ($_from AS $this->_var['log']):
?>
<tr>
  <td><?php if ($this->_var['log']['is_supplier'] == 1): ?>商家<?php else: ?>管理<?php endif; ?></td>
  <td><?php echo $this->_var['log']['created_at']; ?></td>
  <td><?php echo $this->_var['log']['msg']; ?></td>
</tr>
<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
</table>

        </div>
       </div>
        </div>
 <?php endif; ?>
</body>
</html>