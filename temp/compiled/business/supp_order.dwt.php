
<?php echo $this->fetch('library/header.lbi'); ?><body >


<?php echo $this->fetch('library/lift_menu.lbi'); ?>
<script type="text/javascript" src="templates/js/public_tab.js"></script>
<?php if ($this->_var['action'] == 'goods_order'): ?>
    <div class="main" id="main">

    <div class="maintop">

      <img src="templates/images/title_pics.png" /><span>订单管理</span>
<h6 style="float:right;padding:0 50px"><a href="import.php">批量发货</a></h6>
    </div>

    <div class="maincon">
      <div class="conbox" style="position:relative;">
      <div class="contitlelist">

        <span>订单列表</span>
                <div class="searchdiv">
            <form id="" name="form_order" method="get" action="index.php">
        <div>订单状态：</div>
        <select name="composite_status" id="composite_status">
                <option value="-1">请选择</option>
                  <?php echo $this->html_options(array('options'=>$this->_var['status_list'],'selected'=>$this->_var['filter']['composite_status'])); ?>
                </select>

<input type="text" value="<?php echo $this->_var['filter']['order_sn']; ?>" placeholder='订单号' class="input" name="order_sn">

<div>起止时间：</div>
<input class="Wdate" value="<?php echo $this->_var['filter']['start_date']; ?>" type="text" onfocus="WdatePicker({dateFmt:'yyyy-M-d HH:mm'})" readonly name="start_time">
<div>~</div>
<input class="Wdate" value="<?php echo $this->_var['filter']['end_date']; ?>" type="text" onfocus="WdatePicker({dateFmt:'yyyy-M-d HH:mm'})" readonly name="end_time">  
 <div>开团状态</div>
    <select name="team_status" id="team_status">
      <option value="-1">请选择</option>
   <option <?php if ($this->_var['filter']['team_status'] == 0): ?> selected="selected"<?php endif; ?> value="0">团购待付款</option>
     <option <?php if ($this->_var['filter']['team_status'] == 1): ?> selected="selected"<?php endif; ?> value="1">团购正在进行中</option>
  <option  <?php if ($this->_var['filter']['team_status'] == 2): ?> selected="selected"<?php endif; ?>value="2">团购成功</option>
  <option  <?php if ($this->_var['filter']['team_status'] == 3): ?> selected="selected"<?php endif; ?>value="3">团购失败</option>
    </select>        
   <div> 购买类型</div>
    <select name="type" id="type">
      <option value="-1">全部</option>
      <option value="1" <?php if ($this->_var['filter']['type'] == 1): ?> selected="selected"<?php endif; ?>>团购购买</option>
      <option value="2" <?php if ($this->_var['filter']['type'] == 2): ?> selected="selected"<?php endif; ?>>单独购买</option>

      <input name="act" type="hidden" value="<?php echo $this->_var['action']; ?>" />
       <input type="submit" class="btn" name="" value="搜索">
  <input name="op" type="hidden" value="order" />
                            </form>

                        </div>
      </div>

<form id="form_data" action="index.php" method="post" name="myform">
    <div class="bnts">
     <input name="act" type="hidden" value="order_operation" />
     <input type="submit" value="打印" name="order_print">

  <input name="op" type="hidden" value="order" />
     <input type="button" onclick="order_d();" value="导出" name="order_download">
 </div>
 <script>
var order_sn=document.forms['form_order'].order_sn.value;
var composite_status=document.forms['form_order'].composite_status.value;
var start_time=document.forms['form_order'].start_time.value;
var end_time=document.forms['form_order'].end_time.value;

var str="order_sn="+order_sn+"&composite_status="+composite_status+"&start_time="+start_time+"&end_time="+end_time+"&action=<?php echo $this->_var['action']; ?>";

function order_d(){ 
  
  window.location="index.php?op=order&act=order_download2&"+str;
}
</script>
        <table cellspacing="0" cellpadding="0" class="listtable">
        <tr>
          <th class="center"><input type="checkbox" name="checkbox" onclick='listTable.selectAll(this, "order_id")' /> </th>
            <th class="center">订单号</th>          
            <th class="center">下单时间</th>
            <th class="center"><?php if ($this->_var['order_list']['0']['point_id'] != 0): ?>自提点<?php else: ?>收货人<?php endif; ?></th>
            <th class="center">购买类型</th>
			<th class="center">商品数量</th>
                      <th class="center">总金额</th>
                      <th class="center">应付金额</th>
                      <th class="center">订单状态</th>
               <th>操作列</th>
            </tr>

                      <?php $_from = $this->_var['order_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'order_list_0_53906200_1480670757');if (count($_from)):
    foreach ($_from AS $this->_var['order_list_0_53906200_1480670757']):
?>

          <tr>
            <td align="center"><input type="checkbox"  name="order_id[]" id="order_id" value="<?php echo $this->_var['order_list_0_53906200_1480670757']['order_sn']; ?>" style="height:36px;line-height:36px;" /> </td>
            <td align="center"><a href="?op=order&act=order_info&order_id=<?php echo $this->_var['order_list_0_53906200_1480670757']['order_id']; ?>"><?php echo $this->_var['order_list_0_53906200_1480670757']['order_sn']; ?><?php if ($this->_var['order_list_0_53906200_1480670757']['extension_code'] == 'team_goods'): ?><span style="color:#F00;">[团]</span><?php endif; ?><?php if ($this->_var['order_list_0_53906200_1480670757']['team_first'] == 1): ?> <font color="red">[团长]</font> <?php endif; ?></a></td>

                      <td align="center"><?php echo $this->_var['order_list_0_53906200_1480670757']['buyer']; ?><br /><?php echo $this->_var['order_list_0_53906200_1480670757']['short_order_time']; ?></td>

                      <td align="center"><?php echo $this->_var['order_list_0_53906200_1480670757']['consignee']; ?><?php if ($this->_var['order_list_0_53906200_1480670757']['point_id'] == 0): ?>[TEL:<?php if ($this->_var['order_list_0_53906200_1480670757']['mobile']): ?><?php echo $this->_var['order_list_0_53906200_1480670757']['mobile']; ?><?php else: ?><?php echo $this->_var['order_list_0_53906200_1480670757']['tel']; ?><?php endif; ?>]<br /><?php echo $this->_var['order_list_0_53906200_1480670757']['address']; ?><?php endif; ?></td>
					  <td align="center"><?php if ($this->_var['order_list_0_53906200_1480670757']['extension_code'] == 'team_goods'): ?>团购【<?php echo $this->_var['lang']['team_status'][$this->_var['order_list_0_53906200_1480670757']['team_status']]; ?>】<?php else: ?>单独购买<?php endif; ?> <?php if ($this->_var['order_list_0_53906200_1480670757']['point_id'] > 0): ?> 自提<?php endif; ?></td>
            <td align="center"><?php echo $this->_var['order_list_0_53906200_1480670757']['goods_num']; ?></td>
                      <td align="center"><?php echo $this->_var['order_list_0_53906200_1480670757']['total_fee']; ?></td>
					  
                      <td align="center"><?php echo $this->_var['order_list_0_53906200_1480670757']['order_amount']; ?></td>

            <td align="center"><?php echo $this->_var['lang']['os'][$this->_var['order_list_0_53906200_1480670757']['order_status']]; ?>,<?php echo $this->_var['lang']['ps'][$this->_var['order_list_0_53906200_1480670757']['pay_status']]; ?>,<?php echo $this->_var['lang']['ss'][$this->_var['order_list_0_53906200_1480670757']['shipping_status']]; ?></td>

            <td align="center">

                       <a href="?op=order&act=order_info&order_id=<?php echo $this->_var['order_list_0_53906200_1480670757']['order_id']; ?>">查看</a> 

                       <!--

                       <a href="?act=supp_account_delete&id=<?php echo $this->_var['account']['account_id']; ?>" onclick="return confirm('确定要此操作吗');">删除-->
              </td>
        </tr>

          <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
</table>
            </form>    

      </div>
     <?php echo $this->fetch('library/pages.lbi'); ?>
    </div>
</div>

<?php endif; ?> 
<?php if ($this->_var['action'] == 'goods_order2'): ?>
    <div class="main" id="main">

    <div class="maintop">

      <img src="templates/images/title_pics.png" /><span>订单管理</span>
<h6 style="float:right;padding:0 50px"><a href="import.php">批量发货</a></h6>
    </div>

    <div class="maincon">
      <div class="conbox" style="position:relative;">
      <div class="contitlelist">

        <span>订单列表</span>
                <div class="searchdiv">
            <form id="" name="form_order" method="get" action="index.php">
        <div>订单状态：</div>
        <select name="composite_status" id="composite_status">
                <option value="-1">请选择</option>
                 
<option value="100" <?php if ($this->_var['filter']['composite_status'] == '100'): ?> selected<?php endif; ?>>已确认待付款</option>
<option value="120" <?php if ($this->_var['filter']['composite_status'] == '120'): ?> selected<?php endif; ?>>已付款</option>
<option value="3"  <?php if ($this->_var['filter']['composite_status'] == '3'): ?> selected<?php endif; ?>>已退款</option>
<option value="102" <?php if ($this->_var['filter']['composite_status'] == '102'): ?> selected<?php endif; ?>>已核销</option>
<option value="101" <?php if ($this->_var['filter']['composite_status'] == '101'): ?> selected<?php endif; ?>>待核销</option>

                </select>

<input type="text" value="<?php echo $this->_var['filter']['order_sn']; ?>" placeholder='订单号' class="input" name="order_sn">

<div>起止时间：</div>
<input class="Wdate" value="<?php echo $this->_var['filter']['start_date']; ?>" type="text" onfocus="WdatePicker({dateFmt:'yyyy-M-d HH:mm'})" readonly name="start_time">
<div>~</div>
<input class="Wdate" value="<?php echo $this->_var['filter']['end_date']; ?>" type="text" onfocus="WdatePicker({dateFmt:'yyyy-M-d HH:mm'})" readonly name="end_time">  
 <div>开团状态</div>
    <select name="team_status" id="team_status">
      <option value="-1">请选择</option>
   <option <?php if ($this->_var['filter']['team_status'] == 0): ?> selected="selected"<?php endif; ?> value="0">团购待付款</option>
     <option <?php if ($this->_var['filter']['team_status'] == 1): ?> selected="selected"<?php endif; ?> value="1">团购正在进行中</option>
  <option  <?php if ($this->_var['filter']['team_status'] == 2): ?> selected="selected"<?php endif; ?>value="2">团购成功</option>
  <option  <?php if ($this->_var['filter']['team_status'] == 3): ?> selected="selected"<?php endif; ?>value="3">团购失败</option>
    </select> 
    
  
     <select name="point_id" id="point_id">
      <option value="-1">选择自提点</option>
      <?php $_from = $this->_var['point_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'point');if (count($_from)):
    foreach ($_from AS $this->_var['point']):
?>
      <option value="<?php echo $this->_var['point']['id']; ?>" <?php if ($this->_var['filter']['point_id'] == $this->_var['point']['id']): ?> selected<?php endif; ?>><?php echo $this->_var['point']['shop_name']; ?></option>
      <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
      
     </select>
    <input type="text" value="<?php echo $this->_var['filter']['checked_mobile']; ?>" placeholder='提货人电话' class="input" name="checked_mobile">
    
           
   <div> 购买类型</div>
    <select name="type" id="type">
      <option value="-1">全部</option>
      <option value="1" <?php if ($this->_var['filter']['type'] == 1): ?> selected="selected"<?php endif; ?>>团购购买</option>
      <option value="2" <?php if ($this->_var['filter']['type'] == 2): ?> selected="selected"<?php endif; ?>>单独购买</option>
 <input name="act" type="hidden" value="<?php echo $this->_var['action']; ?>" />
       <input type="submit" class="btn" name="" value="搜索">

  <input name="op" type="hidden" value="order" />
                            </form>

                        </div>
      </div>

<form id="form_data" action="index.php" method="post" name="myform">
    <div class="bnts">
     <input name="act" type="hidden" value="order_operation" />
     <input type="submit" value="打印" name="order_print">

  <input name="op" type="hidden" value="order" />
     <input type="button" onclick="order_d();" value="导出" name="order_download">
 </div>
 <script>
var order_sn=document.forms['form_order'].order_sn.value;
var composite_status=document.forms['form_order'].composite_status.value;
var start_time=document.forms['form_order'].start_time.value;
var end_time=document.forms['form_order'].end_time.value;
var point_id=document.forms['form_order'].point_id.value;
var checked_mobile=document.forms['form_order'].checked_mobile.value;


var str="order_sn="+order_sn+"&composite_status="+composite_status+"&start_time="+start_time+"&end_time="+end_time+"&action=<?php echo $this->_var['action']; ?>"+"&point_id="+point_id+"&checked_mobile="+checked_mobile;

function order_d(){ 
  
  window.location="index.php?op=order&act=order_download2&"+str;
}
</script>
        <table cellspacing="0" cellpadding="0" class="listtable">
        <tr>
          <th class="center"><input type="checkbox" name="checkbox" onclick='listTable.selectAll(this, "order_id")' /> </th>
            <th class="center">订单号</th>          
            <th class="center">下单时间</th>
            <th class="center"><?php if ($this->_var['order_list']['0']['point_id'] != 0): ?>自提点<?php else: ?>收货人<?php endif; ?></th>
            <th class="center">购买类型</th>
			<th class="center">商品数量</th>
                      <th class="center">总金额</th>
                      <th class="center">应付金额</th>
                      <th class="center">订单状态</th>
               <th>操作列</th>
            </tr>

                      <?php $_from = $this->_var['order_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'order_list_0_53906200_1480670757');if (count($_from)):
    foreach ($_from AS $this->_var['order_list_0_53906200_1480670757']):
?>

          <tr>
            <td align="center"><input type="checkbox"  name="order_id[]" id="order_id" value="<?php echo $this->_var['order_list_0_53906200_1480670757']['order_sn']; ?>" style="height:36px;line-height:36px;" /> </td>
            <td align="center"><a href="?op=order&act=order_info&order_id=<?php echo $this->_var['order_list_0_53906200_1480670757']['order_id']; ?>"><?php echo $this->_var['order_list_0_53906200_1480670757']['order_sn']; ?><?php if ($this->_var['order_list_0_53906200_1480670757']['extension_code'] == 'team_goods'): ?><span style="color:#F00;">[团]</span><?php endif; ?><?php if ($this->_var['order_list_0_53906200_1480670757']['team_first'] == 1): ?> <font color="red">[团长]</font> <?php endif; ?></a></td>

                      <td align="center"><?php echo $this->_var['order_list_0_53906200_1480670757']['buyer']; ?><br /><?php echo $this->_var['order_list_0_53906200_1480670757']['short_order_time']; ?></td>

                      <td align="center"><?php echo $this->_var['order_list_0_53906200_1480670757']['consignee']; ?><?php if ($this->_var['order_list_0_53906200_1480670757']['point_id'] == 0): ?>[TEL:<?php if ($this->_var['order_list_0_53906200_1480670757']['mobile']): ?><?php echo $this->_var['order_list_0_53906200_1480670757']['mobile']; ?><?php else: ?><?php echo $this->_var['order_list_0_53906200_1480670757']['tel']; ?><?php endif; ?>]<br /><?php echo $this->_var['order_list_0_53906200_1480670757']['address']; ?><?php endif; ?></td>
					  <td align="center"><?php if ($this->_var['order_list_0_53906200_1480670757']['extension_code'] == 'team_goods'): ?>团购【<?php echo $this->_var['lang']['team_status'][$this->_var['order_list_0_53906200_1480670757']['team_status']]; ?>】<?php else: ?>单独购买<?php endif; ?> <?php if ($this->_var['order_list_0_53906200_1480670757']['point_id'] > 0): ?> 自提<?php endif; ?></td>
            <td align="center"><?php echo $this->_var['order_list_0_53906200_1480670757']['goods_num']; ?></td>
                      <td align="center"><?php echo $this->_var['order_list_0_53906200_1480670757']['total_fee']; ?></td>
					  
                      <td align="center"><?php echo $this->_var['order_list_0_53906200_1480670757']['order_amount']; ?></td>

            <td align="center"><?php echo $this->_var['lang']['os'][$this->_var['order_list_0_53906200_1480670757']['order_status']]; ?>,<?php echo $this->_var['lang']['ps'][$this->_var['order_list_0_53906200_1480670757']['pay_status']]; ?>,<?php echo $this->_var['lang']['pos'][$this->_var['order_list_0_53906200_1480670757']['shipping_status']]; ?>,<?php if ($this->_var['order_list_0_53906200_1480670757']['point_shop_remind'] == 1): ?>待提醒<?php else: ?>已提醒<?php endif; ?></td>

            <td align="center">

                       <a href="?op=order&act=order_info&order_id=<?php echo $this->_var['order_list_0_53906200_1480670757']['order_id']; ?>">查看</a> 

                       <!--

                       <a href="?act=supp_account_delete&id=<?php echo $this->_var['account']['account_id']; ?>" onclick="return confirm('确定要此操作吗');">删除-->
              </td>
        </tr>

          <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
		  <tr>
          	<th class="center" colspan="10"><input type="submit" value="取货提醒" name="order_point_status"></th>
          </tr>
		  
</table>
            </form>    

      </div>
     <?php echo $this->fetch('library/pages.lbi'); ?>
    </div>
</div>



<?php endif; ?>
  <?php if ($this->_var['action'] == 'order_info'): ?>
  
      <div class="main" id="main">
    <div class="maintop">
      <img src="templates/images/title_pics.png" /><span>订单管理</span>
    </div>
    <div class="maincon">
      <div class="contitlelist">
        <span>订单详情</span>
                <div class="titleright">
          <a href="?op=order&act=goods_order
">订单列表</a>
        </div>

        

      </div>

      <div class="conbox">

        <form action="?op=order&act=operate" method="post" name="theForm">

<div class="list-div" style="margin-bottom: 5px">

<table width="100%" cellpadding="3" cellspacing="1">

  <tr>

    <th colspan="4"><?php echo $this->_var['lang']['base_info']; ?></th>

  </tr>

  <tr>

    <td width="18%"><div align="right"><strong><?php echo $this->_var['lang']['label_order_sn']; ?></strong></div></td>

    <td width="34%"><?php echo $this->_var['order']['order_sn']; ?><?php if ($this->_var['order']['extension_code'] == "group_buy"): ?><a href="group_buy.php?act=edit&id=<?php echo $this->_var['order']['extension_id']; ?>"><?php echo $this->_var['lang']['group_buy']; ?></a><?php elseif ($this->_var['order']['extension_code'] == "exchange_goods"): ?><a href="exchange_goods.php?act=edit&id=<?php echo $this->_var['order']['extension_id']; ?>"><?php echo $this->_var['lang']['exchange_goods']; ?></a><?php endif; ?></td>

    <td width="15%"><div align="right"><strong><?php echo $this->_var['lang']['label_order_status']; ?></strong></div></td>

    <td><?php echo $this->_var['order']['status']; ?></td>

  </tr>

  <tr>

    <td><div align="right"><strong><?php echo $this->_var['lang']['label_user_name']; ?></strong></div></td>

    <td><?php echo empty($this->_var['order']['user_name']) ? $this->_var['lang']['anonymous'] : $this->_var['order']['user_name']; ?></td>

    <td><div align="right"><strong><?php echo $this->_var['lang']['label_order_time']; ?></strong></div></td>

    <td><?php echo $this->_var['order']['formated_add_time']; ?></td>

  </tr>
 <tr>
    <td><div align="right"><strong><?php echo $this->_var['lang']['label_shipping']; ?></strong></div></td>

    <td><?php if ($this->_var['exist_real_goods']): ?><?php if ($this->_var['order']['shipping_id'] > 0): ?><?php echo $this->_var['order']['shipping_name']; ?><?php else: ?><?php endif; ?> <?php if ($this->_var['order']['insure_fee'] > 0): ?>（<?php echo $this->_var['lang']['label_insure_fee']; ?><?php echo $this->_var['order']['formated_insure_fee']; ?>）<?php endif; ?><?php endif; ?></td>
    <td><div align="right"><strong><?php echo $this->_var['lang']['label_shipping_time']; ?></strong></div></td>
    <td><?php echo $this->_var['order']['shipping_time']; ?></td>
  </tr>
  <tr>

    <td><div align="right"><strong><?php echo $this->_var['lang']['label_payment']; ?></strong></div></td>

    <td><?php if ($this->_var['order']['pay_id'] > 0): ?><?php echo $this->_var['order']['pay_name']; ?><?php else: ?><?php echo $this->_var['lang']['require_field']; ?><?php endif; ?>

    </td>

    <td><div align="right"><strong><?php echo $this->_var['lang']['label_pay_time']; ?></strong></div></td>

    <td><?php echo $this->_var['order']['pay_time']; ?></td>

  </tr>
  <?php if ($this->_var['order']['team_first'] == 1): ?>
 <tr>
    <td><div align="right"><strong>团长优惠：</strong></div></td>
    <td><?php if ($this->_var['order']['discount_type'] == 1): ?>团长免单<?php elseif ($this->_var['order']['discount_type'] == 2): ?>团长优惠【<?php echo $this->_var['order']['discount_amount']; ?>】<?php else: ?>无优惠<?php endif; ?></td>
    <td><div align="right"><strong></strong></div></td>
    <td></td>
  </tr>
  <?php endif; ?>
  <?php if ($this->_var['order']['point_id']): ?>
  <tr>
    <td><div align="right"><strong>自提地址：</strong></div></td>
    <td><?php echo $this->_var['point_info']['region']; ?> <?php echo $this->_var['point_info']['address']; ?> <?php echo $this->_var['point_info']['shop_name']; ?><?php echo $this->_var['point_info']['mobile']; ?>   <?php echo $this->_var['order']['best_time']; ?></td>
    <td><div align="right"><strong>验证电话：</strong></div></td>
    <td><?php echo $this->_var['order']['checked_mobile']; ?></td>
  </tr>  
  <?php if ($this->_var['order']['shipping_status'] == 2): ?>
  <tr>
    <td><div align="right"><strong>自提状态：</strong></div></td>
    <td>已提货</td>
    <td><div align="right"><strong>操作人：</strong></div></td>
    <td><?php echo $this->_var['order']['op']; ?>，id：<?php echo $this->_var['order']['op_uid']; ?></td>    
  </tr>
  <?php endif; ?>
  <?php else: ?>
  <tr>
    <th colspan="4"><?php echo $this->_var['lang']['consignee_info']; ?></th>
  </tr>
  <tr>
    <td><div align="right"><strong><?php echo $this->_var['lang']['label_consignee']; ?></strong></div></td>
    <td><?php echo htmlspecialchars($this->_var['order']['consignee']); ?></td>
    <td><div align="right"><strong>   公司类别：</strong></div></td>
    <td><?php if ($this->_var['order']['address_type'] == 1): ?>家庭<?php else: ?>公司<?php endif; ?></td>
  </tr>
  <tr>
    <td><div align="right"><strong><?php echo $this->_var['lang']['label_address']; ?></strong></div></td>
    <td>[<?php echo $this->_var['order']['region']; ?>] <?php echo htmlspecialchars($this->_var['order']['address']); ?></td>
    <td><div align="right"><strong><?php echo $this->_var['lang']['label_mobile']; ?></strong></div></td>
    <td><?php echo htmlspecialchars($this->_var['order']['mobile']); ?></td>
  </tr>
  <?php endif; ?>
  <tr>
    <td><div align="right"><strong><?php echo $this->_var['lang']['label_postscript']; ?></strong></div></td>
    <td colspan="3"><?php echo $this->_var['order']['postscript']; ?></td>
  </tr>
  <?php if (0): ?>
  <tr>
    
    <th colspan="4"><?php echo $this->_var['lang']['other_info']; ?></th>
    
  </tr>

  <tr>

    <td><div align="right"><strong><?php echo $this->_var['lang']['label_inv_type']; ?></strong></div></td>

    <td><?php echo $this->_var['order']['inv_type']; ?></td>

    <td>&nbsp;</td>

    <td>&nbsp;</td>

  </tr>

  <tr>

    <td><div align="right"><strong><?php echo $this->_var['lang']['label_inv_payee']; ?></strong></div></td>

    <td><?php echo $this->_var['order']['inv_payee']; ?></td>

    <td><div align="right"><strong><?php echo $this->_var['lang']['label_inv_content']; ?></strong></div></td>

    <td><?php echo $this->_var['order']['inv_content']; ?></td>

  </tr>

<?php endif; ?>
</table>

</div>





<div class="list-div" style="margin-bottom: 5px">

<table width="100%" cellpadding="3" cellspacing="1">

  <tr>

    <th colspan="8" scope="col"><?php echo $this->_var['lang']['goods_info']; ?></th>

    </tr>

  <tr>

    <td scope="col"><div align="center"><strong><?php echo $this->_var['lang']['goods_name_brand']; ?></strong></div></td>

    <td scope="col"><div align="center"><strong><?php echo $this->_var['lang']['goods_sn']; ?></strong></div></td>

    <td scope="col"><div align="center"><strong><?php echo $this->_var['lang']['product_sn']; ?></strong></div></td>

    <td scope="col"><div align="center"><strong><?php echo $this->_var['lang']['goods_price']; ?></strong></div></td>

    <td scope="col"><div align="center"><strong><?php echo $this->_var['lang']['goods_number']; ?></strong></div></td>

    <td scope="col"><div align="center"><strong><?php echo $this->_var['lang']['goods_attr']; ?></strong></div></td>

    <td scope="col"><div align="center"><strong><?php echo $this->_var['lang']['storage']; ?></strong></div></td>

    <td scope="col"><div align="center"><strong><?php echo $this->_var['lang']['subtotal']; ?></strong></div></td>

  </tr>

  <?php $_from = $this->_var['goods_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'goods');if (count($_from)):
    foreach ($_from AS $this->_var['goods']):
?>

  <tr>

    <td align="center">

    <?php if ($this->_var['goods']['goods_id'] > 0 && $this->_var['goods']['extension_code'] != 'package_buy'): ?>

    <a href="./../goods.php?id=<?php echo $this->_var['goods']['goods_id']; ?>" target="_blank"><?php echo $this->_var['goods']['goods_name']; ?> <?php if ($this->_var['goods']['brand_name']): ?>[ <?php echo $this->_var['goods']['brand_name']; ?> ]<?php endif; ?>

    <?php if ($this->_var['goods']['is_gift']): ?><?php if ($this->_var['goods']['goods_price'] > 0): ?><?php echo $this->_var['lang']['remark_favourable']; ?><?php else: ?><?php echo $this->_var['lang']['remark_gift']; ?><?php endif; ?><?php endif; ?>

    <?php if ($this->_var['goods']['parent_id'] > 0): ?><?php echo $this->_var['lang']['remark_fittings']; ?><?php endif; ?></a>

    <?php elseif ($this->_var['goods']['goods_id'] > 0 && $this->_var['goods']['extension_code'] == 'package_buy'): ?>

    <a href="javascript:void(0)" onclick="setSuitShow(<?php echo $this->_var['goods']['goods_id']; ?>)"><?php echo $this->_var['goods']['goods_name']; ?><span style="color:#FF0000;"><?php echo $this->_var['lang']['remark_package']; ?></span></a>

    <div id="suit_<?php echo $this->_var['goods']['goods_id']; ?>" style="display:none">

        <?php $_from = $this->_var['goods']['package_goods_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'package_goods_list');if (count($_from)):
    foreach ($_from AS $this->_var['package_goods_list']):
?>

          <a href="./../goods.php?id=<?php echo $this->_var['package_goods_list']['goods_id']; ?>" target="_blank"><?php echo $this->_var['package_goods_list']['goods_name']; ?></a><br />

        <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>

    </div>

    <?php endif; ?>

    </td>

    <td align="center"><?php echo $this->_var['goods']['goods_sn']; ?></td>

    <td align="center"><?php echo $this->_var['goods']['product_sn']; ?></td>

    <td align="center"><?php echo $this->_var['goods']['formated_goods_price']; ?></td>

    <td align="center"><?php echo $this->_var['goods']['goods_number']; ?>
</td>

    <td align="center"><?php echo nl2br($this->_var['goods']['goods_attr']); ?></td>

    <td align="center"><?php echo $this->_var['goods']['storage']; ?></td>

    <td align="center"><?php echo $this->_var['goods']['formated_subtotal']; ?></td>

  </tr>

  <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>

  <tr>

    <td></td>

    <td>&nbsp;</td>

    <td>&nbsp;</td>

    <td><?php if ($this->_var['order']['total_weight']): ?><div align="right"><strong><?php echo $this->_var['lang']['label_total_weight']; ?>

    </strong></div><?php endif; ?></td>

    <td><?php if ($this->_var['order']['total_weight']): ?><div align="right"><?php echo $this->_var['order']['total_weight']; ?>

    </div><?php endif; ?></td>

    <td>&nbsp;</td>

    <td><strong><?php echo $this->_var['lang']['label_total']; ?></strong></td>

    <td><?php echo $this->_var['order']['formated_goods_amount']; ?></td>

  </tr>

</table>

</div>



<div class="list-div" style="margin-bottom: 5px">

<table width="100%" cellpadding="3" cellspacing="1">

  <tr>

    <th><?php echo $this->_var['lang']['fee_info']; ?></th>

  </tr>

  <tr>
    <td><div align="right"><?php echo $this->_var['lang']['label_goods_amount']; ?><strong><?php echo $this->_var['order']['formated_goods_amount']; ?></strong> 
      + <?php echo $this->_var['lang']['label_shipping_fee']; ?><strong><?php echo $this->_var['order']['formated_shipping_fee']; ?></strong>
    </div></td></tr>
  <tr>
    <td><div align="right"> = <?php echo $this->_var['lang']['label_order_amount']; ?><strong><?php echo $this->_var['order']['formated_total_fee']; ?></strong></div></td>
  </tr>
  <tr>
    <td><div align="right">
      - <?php echo $this->_var['lang']['label_money_paid']; ?><strong><?php echo $this->_var['order']['formated_money_paid']; ?></strong> - <?php echo $this->_var['lang']['label_surplus']; ?> <strong><?php echo $this->_var['order']['formated_surplus']; ?></strong>
      - <?php echo $this->_var['lang']['label_bonus']; ?> <strong><?php echo $this->_var['order']['formated_bonus']; ?></strong>
    </div></td>
  <tr>
    <td><div align="right"> = <?php if ($this->_var['order']['order_amount'] >= 0): ?><?php echo $this->_var['lang']['label_money_dues']; ?><strong><?php echo $this->_var['order']['formated_order_amount']; ?></strong>
      <?php else: ?><?php echo $this->_var['lang']['label_money_refund']; ?><strong><?php echo $this->_var['order']['formated_money_refund']; ?></strong>
      <input name="refund" type="button" value="<?php echo $this->_var['lang']['refund']; ?>" onclick="location.href='order.php?act=process&func=load_refund&anonymous=<?php if ($this->_var['order']['user_id'] <= 0): ?>1<?php else: ?>0<?php endif; ?>&order_id=<?php echo $this->_var['order']['order_id']; ?>&refund_amount=<?php echo $this->_var['order']['money_refund']; ?>'" />
      <?php endif; ?><?php if ($this->_var['order']['extension_code'] == "group_buy"): ?><br /><?php echo $this->_var['lang']['notice_gb_order_amount']; ?><?php endif; ?></div></td>
  </tr>


</table>
</div>


<div class="list-div" style="margin-bottom: 5px">
<table cellpadding="3" cellspacing="1">
  <?php if ($this->_var['order']['point_id'] == 0): ?>
  <tr>
    <th colspan="6"><?php echo $this->_var['lang']['action_info']; ?></th>
  </tr>
  <tr>
    <td><div align="right"><strong><?php echo $this->_var['lang']['label_action_note']; ?></strong></div></td>
  <td colspan="5"><textarea name="action_note" cols="80" rows="3"></textarea></td>
    </tr>
  <tr>
    <td><div align="right"></div>
      <div align="right"><strong><?php echo $this->_var['lang']['label_operable_act']; ?></strong> </div></td>
    <td colspan="5">
    
        <input type="hidden" name="shipping_id" value="<?php echo $this->_var['order']['shipping_id']; ?>" />  
    <?php if ($this->_var['order']['order_status'] == 4): ?>
    已退货
    <?php else: ?>
      
      
        <?php endif; ?> <?php if ($this->_var['operable_list']['pay']): ?>
       等待付款
        <?php endif; ?> 
    <?php if ($this->_var['operable_list']['split']): ?>
      <?php if ($this->_var['order']['extension_code'] == 'team_goods'): ?>
        <?php if ($this->_var['order']['team_status'] == 2): ?>  
        <?php if ($this->_var['order']['pay_status'] == 2): ?>
        <input name="ship" type="submit" value="<?php echo $this->_var['lang']['op_split']; ?>" class="button" />
        <?php endif; ?>
        <?php elseif ($this->_var['order']['team_status'] == 1): ?>
       <span style="color:#F00;"> 团购进行中...</span>
        <?php elseif ($this->_var['order']['team_status'] == 4): ?>
        <span style="color:#F00;"> 团购失败</span>
        
        <?php endif; ?>
      
      <?php else: ?>

        <input name="ship" type="submit" value="<?php echo $this->_var['lang']['op_split']; ?>" class="button" />
         <?php endif; ?>
        <?php endif; ?> 
        
        <!--<?php if ($this->_var['operable_list']['unship']): ?>
        <input name="unship" type="submit" value="<?php echo $this->_var['lang']['op_unship']; ?>" class="button" />
        <?php endif; ?> --><!-- <?php if ($this->_var['operable_list']['receive']): ?>
        <input name="receive" type="submit" value="<?php echo $this->_var['lang']['op_receive']; ?>" class="button" />
        <?php endif; ?>  -->
         <?php if ($this->_var['operable_list']['return']): ?>
        <input name="return" type="submit" value="<?php echo $this->_var['lang']['op_return']; ?>" class="button" />
        <?php endif; ?> <?php if ($this->_var['operable_list']['to_delivery']): ?>
        <input name="to_delivery" type="submit" value="<?php echo $this->_var['lang']['op_to_delivery']; ?>" class="button"/>
        <input name="order_sn" type="hidden" value="<?php echo $this->_var['order']['order_sn']; ?>" />
        <?php endif; ?> 
        <input name="order_id" type="hidden" value="<?php echo $_REQUEST['order_id']; ?>"></td>
    </tr>
  <?php endif; ?>
  <tr>
    <th><?php echo $this->_var['lang']['action_user']; ?></th>
    <th><?php echo $this->_var['lang']['action_time']; ?></th>
    <th><?php echo $this->_var['lang']['order_status']; ?></th>
    <th><?php echo $this->_var['lang']['pay_status']; ?></th>
    <th><?php echo $this->_var['lang']['shipping_status']; ?></th>
    <th><?php echo $this->_var['lang']['action_note']; ?></th>
  </tr>
  <?php $_from = $this->_var['opt_action_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'action_0_53906200_1480670757');if (count($_from)):
    foreach ($_from AS $this->_var['action_0_53906200_1480670757']):
?>
  <tr>
    <td><div align="center"><?php echo $this->_var['action_0_53906200_1480670757']['action_user']; ?></div></td>
    <td><div align="center"><?php echo $this->_var['action_0_53906200_1480670757']['action_time']; ?></div></td>
    <td><div align="center"><?php echo $this->_var['action_0_53906200_1480670757']['order_status']; ?></div></td>
    <td><div align="center"><?php echo $this->_var['action_0_53906200_1480670757']['pay_status']; ?></div></td>
    <td><div align="center"><?php echo $this->_var['action_0_53906200_1480670757']['shipping_status']; ?></div></td>
    <td><?php echo nl2br($this->_var['action_0_53906200_1480670757']['action_note']); ?></td>
  </tr>
  <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
</table>
</div>

</form>
    </div>
    </div>
</div>
 <?php endif; ?> 

         <?php if ($this->_var['action'] == 'delivery_info'): ?>
         <script>
		 function checkinvoice_no()
		 {
			if(document.theForm.invoice_no.value =='')
			{
				alert('请输入发货单号');
				return false;	
			} 
			return true;
		 }
		 </script>
     <div class="main" id="main">
    <div class="maintop">
      <img src="templates/images/title_goods.png" /><span>订单管理</span>
    </div>
        <div class="maincon">
      <div class="contitlelist">
              <span>发货详情</span>
            </div>
      <div class="conbox">
            <form action="index.php" method="post" name="theForm" >
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

    <td width="18%" height="25"><div align="right"><strong><?php echo $this->_var['lang']['label_order_sn']; ?></strong></div></td>

   <td width="34%" height="25"><?php echo $this->_var['delivery_order']['order_sn']; ?><?php if ($this->_var['delivery_order']['extension_code'] == "group_buy"): ?><a href="group_buy.php?act=edit&id=<?php echo $this->_var['delivery_order']['extension_id']; ?>"><?php echo $this->_var['lang']['group_buy']; ?></a><?php elseif ($this->_var['delivery_order']['extension_code'] == "exchange_goods"): ?><a href="exchange_goods.php?act=edit&id=<?php echo $this->_var['delivery_order']['extension_id']; ?>"><?php echo $this->_var['lang']['exchange_goods']; ?></a><?php endif; ?>

    <td height="25"><div align="right"><strong><?php echo $this->_var['lang']['label_order_time']; ?></strong></div></td>

    <td height="25"><?php echo $this->_var['delivery_order']['formated_add_time']; ?></td>

  </tr>
  <tr>
    <td><div align="right"><strong><?php echo $this->_var['lang']['label_shipping']; ?></strong></div></td>
    <td><?php if ($this->_var['exist_real_goods']): ?><?php if ($this->_var['delivery_order']['shipping_id'] > 0): ?><?php echo $this->_var['delivery_order']['shipping_name']; ?><?php else: ?><?php endif; ?> <?php if ($this->_var['delivery_order']['insure_fee'] > 0): ?>（<?php echo $this->_var['lang']['label_insure_fee']; ?><?php echo $this->_var['delivery_order']['formated_insure_fee']; ?>）<?php endif; ?><?php endif; ?></td>
    <td><div align="right"><strong><?php echo $this->_var['lang']['label_shipping_fee']; ?></strong></div></td>
    <td><?php echo $this->_var['delivery_order']['shipping_fee']; ?></td>
  </tr>
  <tr>
    <td height="25"><div align="right"><strong><?php echo $this->_var['lang']['label_user_name']; ?></strong></div></td>

    <td height="25"><?php echo empty($this->_var['delivery_order']['user_name']) ? $this->_var['lang']['anonymous'] : $this->_var['delivery_order']['user_name']; ?></td>
<?php if ($this->_var['delivery_order']['shipping_id'] == $this->_var['offlineID']): ?>
    <td height="25"><div align="right"><strong>提货人：</strong></div></td>

    <td height="25"><?php if ($this->_var['delivery_order']['status'] != 1): ?><input name="delivery_person" type="text" value="<?php echo $this->_var['delivery_order']['delivery_person']; ?>" <?php if ($this->_var['delivery_order']['status'] == 0): ?> readonly <?php endif; ?>><?php else: ?><?php echo $this->_var['delivery_order']['delivery_person']; ?><?php endif; ?></td>
<?php else: ?>
    <td height="25"><div align="right"><strong>快递单号：</strong></div></td>

    <td height="25"><?php if ($this->_var['delivery_order']['status'] != 1): ?><input name="invoice_no" type="text" value="<?php echo $this->_var['delivery_order']['invoice_no']; ?>" <?php if ($this->_var['delivery_order']['status'] == 0): ?> readonly <?php endif; ?>><?php else: ?><?php echo $this->_var['delivery_order']['invoice_no']; ?><?php endif; ?></td>
<?php endif; ?>
  </tr></table><br />
  <hr style="border-style:dashed;"/><br />
  <table width="100%" cellpadding="3" cellspacing="1">
  <tr>

    <th height="25" colspan="4"><?php echo $this->_var['lang']['consignee_info']; ?></th>

    </tr>

  <tr>

    <td height="25"><div align="right"><strong><?php echo $this->_var['lang']['label_consignee']; ?></strong></div></td>

    <td height="25"><?php echo htmlspecialchars($this->_var['delivery_order']['consignee']); ?></td>

    <td height="25"><div align="right"><strong><?php echo $this->_var['lang']['label_email']; ?></strong></div></td>

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
<table width="100%" cellpadding="3" cellspacing="1">
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
    <td width="18%" height="25"><div align="right"><strong>联系方式：</strong></div></td>
   <td width="34%" height="25"><?php echo $this->_var['suppliers_info']['phone']; ?></td>
    <td height="25"><div align="right"><strong></strong></div></td>
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

    <a href="/goods.php?id=<?php echo $this->_var['goods']['goods_id']; ?>" target="_blank"><?php echo $this->_var['goods']['goods_name']; ?> <?php if ($this->_var['goods']['brand_name']): ?>[ <?php echo $this->_var['goods']['brand_name']; ?> ]<?php endif; ?>
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
<?php if ($_SESSION['role_id'] == ''): ?>
<table cellpadding="3" cellspacing="1">



  <?php if ($this->_var['delivery_order']['status'] != 1): ?>

  <tr>

    <td><div align="right"><strong><?php echo $this->_var['lang']['label_action_note']; ?></strong></div></td>

  <td colspan="5"><textarea name="action_note" cols="80" rows="3"></textarea></td>

  </tr>

  <tr>

    <td><div align="right"><strong><?php echo $this->_var['lang']['label_operable_act']; ?></strong></div></td>

    <td  align="left">
    <?php if ($this->_var['delivery_order']['status'] == 2): ?>
    <input type="hidden" name="shipping_id" value="<?php echo $this->_var['delivery_order']['shipping_id']; ?>" />
    <input name="delivery_confirmed" type="submit" value="确认发货" class="button"/>&nbsp;&nbsp;
    <?php else: ?>
    已发货
    <?php endif; ?>
    <td align="left"><input onclick="de_print();" name="delivery_print" type="button" value="打印" class="button"/>

        <input name="order_id" type="hidden" value="<?php echo $this->_var['delivery_order']['order_id']; ?>">

        <input name="delivery_id" type="hidden" value="<?php echo $this->_var['delivery_order']['delivery_id']; ?>">
    <input name="op" type="hidden" value="order">
        <input name="act" type="hidden" value="<?php echo $this->_var['action_act']; ?>">

    </td>

  </tr>

  <?php endif; ?>
</table>
<?php endif; ?>
         </form>
            </div>
       </div>
        </div>
   <?php endif; ?>

<?php if ($this->_var['action'] == 'shipping_delivery_list'): ?>

<div class="main" id="main">
  <div class="maintop"> <img src="templates/images/title_goods.png" /><span>订单管理</span> </div>
  <div class="maincon">
    <div class="contitlelist"> <span>发货列表</span>
      <div class="searchdiv">
        <form action="index.php"  name="searchForm">
          <input name="order_sn"  placeholder='订单号' value="<?php echo $this->_var['filter']['order_sn']; ?>" type="text" id="order_sn" size="15">
          <input name="consignee" placeholder='<?php echo htmlspecialchars($this->_var['lang']['consignee']); ?>' value="<?php echo $this->_var['filter']['consignee']; ?>" type="text" id="consignee" size="15">
          <select name="status" id="status">
            <option value="-1" selected="selected">发货状态</option>
            <option value="0">已发货</option>
            <option value="1">退货</option>
            <option value="2">未发货</option>
          </select>
<!--           <?php if ($_SESSION['role_id'] != ''): ?>

          <?php else: ?>
          <select name="supp_account_id" id="supp_account_id">
            <option value="-1" selected="selected">分店</option>
       
 <?php $_from = $this->_var['supp_account_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'supp_account');if (count($_from)):
    foreach ($_from AS $this->_var['supp_account']):
?>

            <option value="<?php echo $this->_var['supp_account']['account_id']; ?>" <?php if ($this->_var['supp_account']['account_id'] == $this->_var['filter']['supp_account_id']): ?> selected='selected'<?php endif; ?>><?php echo $this->_var['supp_account']['name']; ?></option>
     
 <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>

          </select>
          <?php endif; ?> -->
           <input name="op" type="hidden" value="order" />
          <input name="act" type="hidden" value="shipping_delivery_list" />
          <input type="submit" value="查询" class="btn" />
        </form>
      </div>
      <!-- <div class="titleright"> <a href="javascript:void(0);" id="delivery_download">导出</a> <a href="javascript:void(0);" id="delivery_print" target="_blank">打印</a> </div> -->
      <script >

var str;

var order_sn=document.forms['searchForm'].order_sn.value;

var consignee=document.forms['searchForm'].consignee.value;

var status=document.forms['searchForm'].status.value;

str="order_sn="+order_sn+"&consignee="+consignee+"&status="+status;




//var supp_account_id=document.forms['searchForm'].supp_account_id.value;

//str+="&supp_account_id="+supp_account_id;




document.getElementById('delivery_download').href="index.php?op=order&act=delivery_download&shipping_type=0&"+str;

document.getElementById('delivery_print').href="index.php?op=order&act=delivery_print&shipping_type=0&"+str;


</script> 
    </div>
    <div class="conbox">
      <table cellspacing="0" cellpadding="0" class="listtable">
        <tr>
          <!-- <th>分店</th> -->
          <th><?php echo $this->_var['lang']['order_sn']; ?></th>
          <th><?php echo $this->_var['lang']['label_add_time']; ?></th>
          <th class="left"><?php echo $this->_var['lang']['consignee']; ?></th>
          <th class="left">发货时间</th>
          <th class="left">发货状态</th>
          <th class="left">操作</th>
        </tr>
        <?php $_from = $this->_var['delivery_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('dkey', 'delivery');if (count($_from)):
    foreach ($_from AS $this->_var['dkey'] => $this->_var['delivery']):
?>
        <tr>
          <!-- <td class="middle"><?php if ($this->_var['delivery']['supp_account_name']): ?><?php echo $this->_var['delivery']['supp_account_name']; ?><?php else: ?>未指派<?php endif; ?></td> -->
          <td class="middle"><?php echo $this->_var['delivery']['order_sn']; ?></td>
          <td  class="middle"><?php echo $this->_var['delivery']['add_time']; ?></td>
          <td><a href="mailto:<?php echo $this->_var['delivery']['email']; ?>"> <?php echo htmlspecialchars($this->_var['delivery']['consignee']); ?></a></td>
          <td><?php echo $this->_var['delivery']['update_time']; ?></td>
          <td><?php if ($this->_var['delivery']['status'] == '0'): ?>已发货<?php elseif ($this->_var['delivery']['status'] == '2'): ?>未发货<?php else: ?>退货<?php endif; ?></td>
          <td><a href="index.php?op=order&act=delivery_info&delivery_id=<?php echo $this->_var['delivery']['delivery_id']; ?>&shipping_type=0">详情</a> 
            
            <!--                   <a onclick="{if(confirm('<?php echo $this->_var['lang']['confirm_delete']; ?>')){return true;}return false;}" href="delivery_info.php?act=operate&remove_invoice=1&delivery_id=<?php echo $this->_var['delivery']['delivery_id']; ?>"><?php echo $this->_var['lang']['remove']; ?></a>

--></td>
        </tr>
        <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
      </table>
    </div>
    <?php echo $this->fetch('library/pages.lbi'); ?> </div>
</div>
<?php endif; ?> 
    <?php if ($this->_var['action'] == 'delivery_list'): ?>

       <div class="main" id="main">

    <div class="maintop">

      <img src="templates/images/title_goods.png" /><span>订单管理</span>

    </div>

        <div class="maincon">

      <div class="contitlelist">

              <span>提货列表</span>

                 <div class="searchdiv">

        <form action="suppliers.php"  name="searchForm">

 <input name="order_sn"  placeholder='订单号' value="<?php echo $this->_var['filter']['order_sn']; ?>" type="text" id="order_sn" size="15">

    <input name="consignee" placeholder='<?php echo htmlspecialchars($this->_var['lang']['consignee']); ?>' value="<?php echo $this->_var['filter']['consignee']; ?>" type="text" id="consignee" size="15">

  
    <select name="status" id="status">
      <option value="-1" selected="selected">提货状态</option>
      <?php echo $this->html_options(array('options'=>$this->_var['lang']['delivery_status'],'selected'=>$this->_var['filter']['status'])); ?>
    </select>
    <?php if (0): ?>
    <select name="delivery_pic" id="delivery_pic">
      <option value="-1" selected="selected">提货单上传</option>
      <option value="1">是</option>
     <option value="0">否</option>
    </select>
    
    <?php if ($_SESSION['role_id'] != ''): ?>
    <?php else: ?> 
     <select name="supp_account_id" id="supp_account_id">
      <option value="-1" selected="selected">分店</option>
 <?php $_from = $this->_var['supp_account_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'supp_account');if (count($_from)):
    foreach ($_from AS $this->_var['supp_account']):
?>
    <option value="<?php echo $this->_var['supp_account']['account_id']; ?>" <?php if ($this->_var['supp_account']['account_id'] == $this->_var['filter']['supp_account_id']): ?> selected='selected'<?php endif; ?>><?php echo $this->_var['supp_account']['name']; ?></option>
 <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
    </select>
   <?php endif; ?>
<?php endif; ?>
    <input name="act" type="hidden" value="delivery_list" />

    <input type="submit" value="查询" class="btn" />

  </form>
      </div>
      <div class="titleright">
<a href="javascript:void(0);" id="delivery_download">导出</a>
<a href="javascript:void(0);" id="delivery_print" target="_blank">打印</a>
</div>
<script >
var str;
var order_sn=document.forms['searchForm'].order_sn.value;
var consignee=document.forms['searchForm'].consignee.value;
var status=document.forms['searchForm'].status.value;
str="order_sn="+order_sn+"&consignee="+consignee+"&status="+status;
/*
<?php if ($_SESSION['role_id'] == ''): ?>
var supp_account_id=document.forms['searchForm'].supp_account_id.value;
str+="&supp_account_id="+supp_account_id;
<?php endif; ?>*/

document.getElementById('delivery_download').href="suppliers.php?act=delivery_download&"+str;
document.getElementById('delivery_print').href="suppliers.php?act=delivery_print&"+str;

</script>
            </div>
      <div class="conbox">
        <table cellspacing="0" cellpadding="0" class="listtable">

          <tr>
            <th>分店</th>
            <th><?php echo $this->_var['lang']['order_sn']; ?></th>
            <th>提货人</th>

            <th><?php echo $this->_var['lang']['label_add_time']; ?></th>

            <th class="left"><?php echo $this->_var['lang']['consignee']; ?></th>

            <th class="left">提货时间</th>

            <th class="left">提货状态</th>

                      <th class="left">操作</th>

          </tr>

                     <?php $_from = $this->_var['delivery_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('dkey', 'delivery');if (count($_from)):
    foreach ($_from AS $this->_var['dkey'] => $this->_var['delivery']):
?>

                <tr>
                  <td class="middle"><?php if ($this->_var['delivery']['supp_account_name']): ?><?php echo $this->_var['delivery']['supp_account_name']; ?><?php else: ?>未指派<?php endif; ?></td>

                  <td class="middle"><?php echo $this->_var['delivery']['order_sn']; ?></td>
                  <td class="middle"><?php echo $this->_var['delivery']['delivery_person']; ?></td>

                  <td  class="middle"><?php echo $this->_var['delivery']['add_time']; ?></td>

                  <td><a href="mailto:<?php echo $this->_var['delivery']['email']; ?>"> <?php echo htmlspecialchars($this->_var['delivery']['consignee']); ?></a></td>

                  <td><?php echo $this->_var['delivery']['update_time']; ?></td>

                  <td><?php echo $this->_var['delivery']['status_name']; ?></td>

                  <td>
                   <a href="index.php?op=order&act=delivery_info&delivery_id=<?php echo $this->_var['delivery']['delivery_id']; ?>">详情</a>
                 
                 
                 <?php if ($this->_var['delivery']['status'] == 0 && 0): ?>
                 <?php if ($this->_var['delivery']['delivery_pic']): ?>
                 <a href="<?php echo $this->_var['delivery']['delivery_pic']; ?>" target="_blank">提货单</a>
                 <?php else: ?>
                 <span id="delivery_pic_<?php echo $this->_var['delivery']['delivery_id']; ?>">
                  <a href="javascript:;" onclick="winopen('index.php?op=order&act=delivery_upload&delivery_id=<?php echo $this->_var['delivery']['delivery_id']; ?>','600','500');" >上传提货单</a>
        </span>
                <?php endif; ?>
                <?php endif; ?>

<!--                   <a onclick="{if(confirm('<?php echo $this->_var['lang']['confirm_delete']; ?>')){return true;}return false;}" href="delivery_info.php?act=operate&remove_invoice=1&delivery_id=<?php echo $this->_var['delivery']['delivery_id']; ?>"><?php echo $this->_var['lang']['remove']; ?></a>

-->                  </td>

                </tr>

          <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
        </table>
      </div>
           <?php echo $this->fetch('library/pages.lbi'); ?>
    </div>

        </div>
        
    <?php endif; ?>

</body>
</html>