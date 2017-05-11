<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title><?php echo $this->_var['lang']['cp_home']; ?></title>
<link href="css/mobile.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/jquery.js"></script>
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
<input type="hidden" value="<?php echo $this->_var['order']['order_id']; ?>" id="oid"/>
<script>
$(function(){
    $('.sub').click(function(){
        var no = $('input[name=invoice_no]').val()
        var oid = $('#oid').val();
        $.ajax({
            url:'order.php?act=to_shippingtest',
            type:'post',
            data:{order_id:oid,invoice_no:no},
            dataType:'json',
            success:function(data){
                
                if(data.status==1){
                    alert('发货成功');
                    window.location.href="?act=list&composite_status=101&he=1";
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