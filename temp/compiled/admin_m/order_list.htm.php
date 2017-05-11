<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title><?php echo $this->_var['lang']['cp_home']; ?></title>
<link href="css/mobile.css" rel="stylesheet" type="text/css" />
<?php echo $this->smarty_insert_scripts(array('files'=>'transport.js,common.js')); ?>
<?php echo $this->smarty_insert_scripts(array('files'=>'../js/utils.js,listtable.js,../js/region.js')); ?>
<div class="container">
    <div class="order_search">
        <form action="javascript:searchOrder()" name="searchForm">
            <div><input type="text" id="order_sn" placeholder='订单号' class="input" name="order_sn"></div>
            <input type="submit" class="btn" name="" value="搜索">
        </form>
    </div>
	<div class="order_list">
        <ul>
           <?php $this->assign('i','0'); ?>
            <?php if ($_GET['he'] == 1): ?>
                 <?php $_from = $this->_var['order_list1']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'order_list');$this->_foreach['order_list'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['order_list']['total'] > 0):
    foreach ($_from AS $this->_var['order_list']):
        $this->_foreach['order_list']['iteration']++;
?>
                    <?php if ($this->_var['order_list']['shipping_code'] != 'cac'): ?>
                     
              <li> 
                <a href="order.php?act=info&order_id=<?php echo $this->_var['order_list']['order_id']; ?>">
                    <p><i><?php echo $this->_foreach['order_list']['iteration']; ?></i>订单号：<?php echo $this->_var['order_list']['order_sn']; ?><?php if ($this->_var['order_list']['extension_code'] == 'team_goods'): ?><font>团</font><?php endif; ?><?php if ($this->_var['order_list']['team_first'] == 1): ?><font>团长</font><?php endif; ?><?php if ($this->_var['order_list']['extension_code'] == 'exchange_goods'): ?><font>积分兑换</font><?php endif; ?><span><?php echo $this->_var['order_list']['shipping_name']; ?></span></p>
                    <p>收货人：<?php echo $this->_var['order_list']['consignee']; ?>  电话：<?php if ($this->_var['order_list']['mobile']): ?><?php echo $this->_var['order_list']['mobile']; ?><?php else: ?><?php echo $this->_var['order_list']['tel']; ?><?php endif; ?><span>金额：<?php echo $this->_var['order_list']['total_fee']; ?></span></p>
                </a> 
            </li>
                    
                    <?php endif; ?>
              <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
            <?php else: ?>
                <?php $_from = $this->_var['order_list2']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'order_list');$this->_foreach['order_list'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['order_list']['total'] > 0):
    foreach ($_from AS $this->_var['key'] => $this->_var['order_list']):
        $this->_foreach['order_list']['iteration']++;
?>
                    <?php if ($this->_var['order_list']['shipping_code'] == 'cac'): ?>
                 <li> 
                <a href="order.php?act=info&order_id=<?php echo $this->_var['order_list']['order_id']; ?>">
                    <p><i><?php echo $this->_foreach['order_list']['iteration']; ?></i>订单号：<?php echo $this->_var['order_list']['order_sn']; ?><?php if ($this->_var['order_list']['extension_code'] == 'team_goods'): ?><font>团</font><?php endif; ?><?php if ($this->_var['order_list']['team_first'] == 1): ?><font>团长</font><?php endif; ?><span><?php echo $this->_var['order_list']['shipping_name']; ?></span></p>
                    <p>自提点：<?php echo $this->_var['order_list']['point_name']; ?><span>金额：<?php echo $this->_var['order_list']['total_fee']; ?></span></p>
                </a> 
                 </li> 
                    <?php endif; ?>
                <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
            <?php endif; ?>
           
           
           
        </ul>
    </div>
</div>
<div class="footer">
    <ul>            
        <li><a href="index.php">首页</a></li>
        <li><a href="order.php?act=list&composite_status=101&he=1"<?php if ($_GET['he'] == 1): ?> class="cur"<?php endif; ?>>待发货订单</a></li>
        <li><a href="order.php?act=list&composite_status=101&he=2"<?php if ($_GET['he'] == 2): ?> class="cur"<?php endif; ?>>待核销订单</a></li>
    </ul>
</div>
</body>
</html>
