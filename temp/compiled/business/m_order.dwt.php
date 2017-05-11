<!doctype html>
<html lang="zh-CN">
<head>
<meta name="Generator" content="haohaios v1.0" />
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
<title>商家管理平台</title>
<link href="templates/css/mobile.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="templates/js/jquery.min.js"></script>
</head>
<body>
<?php if ($this->_var['action'] == 'goods_order' || $this->_var['action'] == 'goods_order2'): ?>
<div class="container">
    <div class="order_search">
        <form id="" name="form_order" method="get" action="index.php">
            <div><input type="text" value="<?php echo $this->_var['filter']['order_sn']; ?>" placeholder='订单号' class="input" name="order_sn"></div>
            <input name="act" type="hidden" value="<?php echo $this->_var['action']; ?>" />
            <input type="submit" class="btn" name="" value="搜索">
            <input name="op" type="hidden" value="order" />
        </form>
    </div>
    <div class="order_list">
        <ul>
            <?php $_from = $this->_var['order_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'order_list_0_28704000_1469009226');$this->_foreach['order_list'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['order_list']['total'] > 0):
    foreach ($_from AS $this->_var['order_list_0_28704000_1469009226']):
        $this->_foreach['order_list']['iteration']++;
?>
            <li>
                <a href="?op=order&act=order_info&order_id=<?php echo $this->_var['order_list_0_28704000_1469009226']['order_id']; ?>">
                    <p><i><?php echo $this->_foreach['order_list']['iteration']; ?></i>订单号：<?php echo $this->_var['order_list_0_28704000_1469009226']['order_sn']; ?><?php if ($this->_var['order_list_0_28704000_1469009226']['extension_code'] == 'team_goods'): ?><font>团</font><?php endif; ?><?php if ($this->_var['order_list_0_28704000_1469009226']['team_first'] == 1): ?><font>团长</font><?php endif; ?><span><?php echo $this->_var['order_list_0_28704000_1469009226']['shipping_name']; ?></span></p>
                    <p>收货人：<?php echo $this->_var['order_list_0_28704000_1469009226']['consignee']; ?>  电话：<?php if ($this->_var['order_list_0_28704000_1469009226']['point_id'] == 0): ?><?php if ($this->_var['order_list_0_28704000_1469009226']['mobile']): ?><?php echo $this->_var['order_list_0_28704000_1469009226']['mobile']; ?><?php else: ?><?php echo $this->_var['order_list_0_28704000_1469009226']['tel']; ?><?php endif; ?><?php endif; ?><span>金额：<?php echo $this->_var['order_list_0_28704000_1469009226']['total_fee']; ?></span></p>
                </a>
            </li>
            <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
        </ul>
    </div>
    <?php echo $this->fetch('library/m_pages.lbi'); ?>
</div>
<?php endif; ?> 

<?php if ($this->_var['action'] == 'order_info'): ?>
<div class="container">
    <div class="order_info">
        <form action="?op=order&act=operate" method="post" name="theForm">
        <h2><a href="javascript:history.back();"><i> < </i></a>订单：<?php echo $this->_var['order']['order_sn']; ?></h2>
        <div class="infobox">
            <h3><?php echo $this->_var['lang']['base_info']; ?></h3>
            <p><?php echo $this->_var['lang']['label_order_sn']; ?><?php echo $this->_var['order']['order_sn']; ?></p>
            <p><?php echo $this->_var['lang']['label_order_status']; ?><?php echo $this->_var['order']['status']; ?></p>
            <p><?php echo $this->_var['lang']['label_user_name']; ?><?php echo empty($this->_var['order']['user_name']) ? $this->_var['lang']['anonymous'] : $this->_var['order']['user_name']; ?></p>
            <p><?php echo $this->_var['lang']['label_order_time']; ?><?php echo $this->_var['order']['formated_add_time']; ?></p>
            <p><?php echo $this->_var['lang']['label_shipping']; ?><?php if ($this->_var['exist_real_goods']): ?><?php if ($this->_var['order']['shipping_id'] > 0): ?><?php echo $this->_var['order']['shipping_name']; ?><?php else: ?><?php endif; ?> <?php if ($this->_var['order']['insure_fee'] > 0): ?>（<?php echo $this->_var['lang']['label_insure_fee']; ?><?php echo $this->_var['order']['formated_insure_fee']; ?>）<?php endif; ?><?php endif; ?></p>
            <p><?php echo $this->_var['lang']['label_shipping_time']; ?><?php echo $this->_var['order']['shipping_time']; ?></p>
            <p><?php echo $this->_var['lang']['label_payment']; ?><?php if ($this->_var['order']['pay_id'] > 0): ?><?php echo $this->_var['order']['pay_name']; ?><?php else: ?><?php echo $this->_var['lang']['require_field']; ?><?php endif; ?></p>
            <p><?php echo $this->_var['lang']['label_pay_time']; ?><?php echo $this->_var['order']['pay_time']; ?></p>
            <?php if ($this->_var['order']['team_first'] == 1): ?>
            <p>团长优惠：<?php if ($this->_var['order']['discount_type'] == 1): ?>团长免单<?php elseif ($this->_var['order']['discount_type'] == 2): ?>团长优惠【<?php echo $this->_var['order']['discount_amount']; ?>】<?php else: ?>无优惠<?php endif; ?></p>
            <?php endif; ?>
        </div>
        <div class="infobox">
            <h3><?php echo $this->_var['lang']['consignee_info']; ?></h3>
            <?php if ($this->_var['order']['point_id']): ?>
            <p>自提地址：<?php echo $this->_var['point_info']['region']; ?> <?php echo $this->_var['point_info']['address']; ?> <?php echo $this->_var['point_info']['shop_name']; ?><?php echo $this->_var['point_info']['tel']; ?>   <?php echo $this->_var['order']['best_time']; ?></p>
            <p>验证电话：<?php echo $this->_var['order']['checked_mobile']; ?></p>
            <?php if ($this->_var['order']['shipping_status'] == 2): ?>
            <p>自提状态：已提货    操作人：<?php echo $this->_var['order']['op']; ?>，id：<?php echo $this->_var['order']['op_uid']; ?></p>
            <?php endif; ?>
            <?php else: ?>
            
            <p><?php echo $this->_var['lang']['label_consignee']; ?><?php echo htmlspecialchars($this->_var['order']['consignee']); ?></p>
            <p>公司类别：<?php if ($this->_var['order']['address_type'] == 1): ?>家庭<?php else: ?>公司<?php endif; ?></p>
            <p><?php echo $this->_var['lang']['label_address']; ?><?php echo htmlspecialchars($this->_var['order']['address']); ?></p>
            <p><?php echo $this->_var['lang']['label_mobile']; ?><?php echo htmlspecialchars($this->_var['order']['mobile']); ?></p>
            <?php endif; ?>
            <p><?php echo $this->_var['lang']['label_postscript']; ?><?php echo $this->_var['order']['postscript']; ?></p>
        </div>
        <div class="infobox">
            <h3><?php echo $this->_var['lang']['goods_info']; ?></h3>
            <p><?php echo $this->_var['lang']['goods_name']; ?><span><?php echo $this->_var['lang']['goods_number']; ?>/价格</span></p>
            <?php $_from = $this->_var['goods_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'goods');if (count($_from)):
    foreach ($_from AS $this->_var['goods']):
?>
            <p><?php echo $this->_var['goods']['goods_name']; ?><span>X<?php echo $this->_var['goods']['goods_number']; ?> <?php echo $this->_var['goods']['formated_subtotal']; ?></span></p>
            <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
            <?php if ($this->_var['order']['total_weight']): ?>
            <p class="ter"><?php echo $this->_var['lang']['label_total_weight']; ?><?php echo $this->_var['order']['total_weight']; ?></p>
            <?php endif; ?>
            <p class="ter"><?php echo $this->_var['lang']['label_total']; ?><?php echo $this->_var['order']['formated_goods_amount']; ?></p>
        </div>
        <div class="infobox">
            <h3><?php echo $this->_var['lang']['fee_info']; ?></h3>
            <p class="ter"><?php echo $this->_var['lang']['label_goods_amount']; ?><?php echo $this->_var['order']['formated_goods_amount']; ?></p>
            <p class="ter">+ <?php echo $this->_var['lang']['label_shipping_fee']; ?><?php echo $this->_var['order']['formated_shipping_fee']; ?></p>
            <p class="ter">= <?php echo $this->_var['lang']['label_order_amount']; ?><?php echo $this->_var['order']['formated_total_fee']; ?></p>
            <p class="ter">- <?php echo $this->_var['lang']['label_money_paid']; ?><?php echo $this->_var['order']['formated_money_paid']; ?></p>
            <p class="ter">- <?php echo $this->_var['lang']['label_surplus']; ?><?php echo $this->_var['order']['formated_surplus']; ?></p>
            <p class="ter">- <?php echo $this->_var['lang']['label_bonus']; ?><?php echo $this->_var['order']['formated_bonus']; ?></p>
            <p class="ter">= <?php if ($this->_var['order']['order_amount'] >= 0): ?><?php echo $this->_var['lang']['label_money_dues']; ?><?php echo $this->_var['order']['formated_order_amount']; ?><?php else: ?><?php echo $this->_var['lang']['label_money_refund']; ?><?php echo $this->_var['order']['formated_money_refund']; ?><?php endif; ?></p>
        </div>
        </form>
    </div>
	<?php if ($this->_var['order']['shipping_code'] != cac): ?>
    <div class="fahuo">
        <div class="txt">快递单号</div>
        <div class="inp">
            <input type="text" name="invoice_no" />
        </div>
        <input type="submit" value="发货" class="sub" />
    </div>
	<?php endif; ?>
</div>
<?php endif; ?>
<div class="footer">
    <ul>
        <li><a href="?op=main&act=default">首页</a></li>
        <li><a href="?composite_status=101&act=goods_order&op=order"<?php if ($this->_var['action'] == goods_order): ?> class="cur"<?php endif; ?>>待发货订单</a></li>
        <li><a href="?composite_status=101&act=goods_order2&op=order"<?php if ($this->_var['action'] == goods_order2): ?> class="cur"<?php endif; ?>>待核销订单</a></li>
    </ul>
</div>
<input type="hidden" value="<?php echo $this->_var['order']['order_id']; ?>" id="oid"/>
<script>
$(function(){
    $('.sub').click(function(){
        var no = $('input[name=invoice_no]').val()
        var oid = $('#oid').val();
        $.ajax({
            url:'index.php?op=order&act=to_shippingtest',
            type:'post',
            data:{order_id:oid,invoice_no:no},
            dataType:'json',
            success:function(data){
                if(data.status==1){
                    alert('发货成功');
                    window.location.href="?composite_status=101&act=goods_order&op=order";
                }else{
                    alert('发货失败');
                }
            }
        })
     })
})
</script>
</body>
</html>