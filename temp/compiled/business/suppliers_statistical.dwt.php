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
<script type="text/javascript" src="../<?php echo $this->_var['admin_path']; ?>/js/tab.js"></script>
<script language="javascript" type="text/javascript" src="../js/DatePicker/WdatePicker.js"></script>
<script type="text/javascript" src="templates/js/public_tab.js"></script>
<script>
var process_request = "<?php echo $this->_var['lang']['process_request']; ?>";
</script>
</head>

<body onload="pageheight()">
<?php echo $this->fetch('library/lift_menu.lbi'); ?>
<?php if ($this->_var['action'] == 'sale_order'): ?>

<div class="main" id="main">
		<div class="maintop">
			<img src="templates/images/title_goods.png" /><span>统计报表</span>
		</div>
        <div class="maincon">
			<div class="contitlelist">
            	<span>销售排行</span>
                <div class="searchdiv">

 <form name="TimeInterval"  action="index.php" style="margin:0px">

    <input  class="Wdate" name="start_date" type="text" value='<?php echo $this->_var['start_date']; ?>' readonly="readonly" onfocus="WdatePicker({dateFmt:'yyyy-M-d',maxDate:'%y-%M-%d'})"/>&nbsp;&nbsp;
    &nbsp;&nbsp;
    <input  class="Wdate" name="end_date" type="text" value='<?php echo $this->_var['end_date']; ?>' readonly="readonly" onfocus="WdatePicker({dateFmt:'yyyy-M-d',maxDate:'%y-%M-%d'})"/>&nbsp;&nbsp;
    <input name="act" type="hidden" value="sale_order" />
    <input name="op" type="hidden" value="statistical" />
    <input type="submit" name="submit" value="<?php echo $this->_var['lang']['query']; ?>" class="btn" />
  </form>

                 </div>
                 <div class="titleright"><a href="?op=statistical&act=sale_order_download&start_date=<?php echo $this->_var['fstart_date']; ?>&end_date=<?php echo $this->_var['fend_date']; ?>">统计报表下载</a></div>

            </div>
		  <div class="conbox">
<table width="100%" cellspacing="1" cellpadding="3" class="listtable">
     <tr>
      <th><?php echo $this->_var['lang']['order_by']; ?></th>
      <th><?php echo $this->_var['lang']['goods_name']; ?></th>
      <th><?php echo $this->_var['lang']['goods_sn']; ?></th>
      <th><?php echo $this->_var['lang']['sell_amount']; ?></th>
      <th><?php echo $this->_var['lang']['sell_sum']; ?></th>
      <th><?php echo $this->_var['lang']['percent_count']; ?></th>
    </tr>
  <?php $_from = $this->_var['goods_order_data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'list');$this->_foreach['val'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['val']['total'] > 0):
    foreach ($_from AS $this->_var['list']):
        $this->_foreach['val']['iteration']++;
?>
    <tr align="center">
      <td><?php echo $this->_foreach['val']['iteration']; ?></td>
      <td align="left"><a href="javascript:;" target="_blank" style="cursor:default"><?php echo $this->_var['list']['goods_name']; ?></a></td>
      <td><?php echo $this->_var['list']['goods_sn']; ?></td>
      <td><?php echo $this->_var['list']['goods_num']; ?></td>
      <td><?php echo $this->_var['list']['turnover']; ?></td>
      <td><?php echo $this->_var['list']['wvera_price']; ?></td>
    </tr>
  <?php endforeach; else: ?>
    <tr><td class="no-records" colspan="10"><?php echo $this->_var['lang']['no_records']; ?></td></tr>
  <?php endif; unset($_from); ?><?php $this->pop_vars();; ?>
  </table>


        </div>
        
            <?php echo $this->fetch('library/pages.lbi'); ?> 
        
  </div>
       </div>

<?php endif; ?>
<?php if ($this->_var['action'] == 'sale_list'): ?>
<div class="main" id="main">
		<div class="maintop">
			<img src="templates/images/title_goods.png" /><span>统计报表</span>
		</div>
        <div class="maincon">
			<div class="contitlelist">
            	<span>销售明细</span>
                <div class="searchdiv">

 <form name="TimeInterval"  action="index.php" style="margin:0px">

    <input  class="Wdate" name="start_date" type="text" value='<?php echo $this->_var['start_date']; ?>' readonly="readonly" onfocus="WdatePicker({dateFmt:'yyyy-M-d',maxDate:'%y-%M-%d'})"/>&nbsp;&nbsp;
    &nbsp;&nbsp;
    <input  class="Wdate" name="end_date" type="text" value='<?php echo $this->_var['end_date']; ?>' readonly="readonly" onfocus="WdatePicker({dateFmt:'yyyy-M-d',maxDate:'%y-%M-%d'})"/>&nbsp;&nbsp;
    <input name="act" type="hidden" value="sale_list" />
    <input name="op" type="hidden" value="statistical" />
    <input type="submit" name="submit" value="<?php echo $this->_var['lang']['query']; ?>" class="btn" />
  </form>

                 </div>
                 <div class="titleright"><a href="?op=statistical&act=sale_list_download&start_date=<?php echo $this->_var['fstart_date']; ?>&end_date=<?php echo $this->_var['fend_date']; ?>">统计报表下载</a></div>

            </div>
		  <div class="conbox">

<table width="100%" cellspacing="1" cellpadding="3" class="listtable">
     <tr>
      <th><?php echo $this->_var['lang']['goods_name']; ?></th>
      <th><?php echo $this->_var['lang']['order_sn']; ?></th>
      <th><?php echo $this->_var['lang']['amount']; ?></th>
      <th><?php echo $this->_var['lang']['sell_price']; ?></th>
      <th><?php echo $this->_var['lang']['sell_date']; ?></th>
    </tr>
  <?php $_from = $this->_var['goods_sales_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'list');if (count($_from)):
    foreach ($_from AS $this->_var['list']):
?>
    <tr align="center">
      <td align="left"><a href="goods.php?id=<?php echo $this->_var['list']['goods_id']; ?>" target="_blank"><?php echo $this->_var['list']['goods_name']; ?></a></td>
      <td><a href="index.php?op=order&act=order_info&order_id=<?php echo $this->_var['list']['order_id']; ?>"><?php echo $this->_var['list']['order_sn']; ?></a></td>
      <td align="center"><?php echo $this->_var['list']['goods_num']; ?></td>
      <td align="center"><?php echo $this->_var['list']['sales_price']; ?></td>
      <td align="center"><?php echo $this->_var['list']['sales_time']; ?></td>
    </tr>
  <?php endforeach; else: ?>
    <tr><td class="no-records" colspan="10"><?php echo $this->_var['lang']['no_records']; ?></td></tr>
  <?php endif; unset($_from); ?><?php $this->pop_vars();; ?>
  </table>

        </div>
        
            <?php echo $this->fetch('library/pages.lbi'); ?> 
        
  </div>
       </div>

<?php endif; ?>
<?php if ($this->_var['action'] == 'order_stats'): ?>
  <div class="main" id="main">
		<div class="maintop">
			<img src="templates/images/title_goods.png" /><span>报表统计</span>
		</div>
        <div class="maincon">
			<div class="contitlelist">
            	<span>订单统计</span>
                 <div class="searchdiv">
<form action="index.php" method="get" id="selectForm" name="selectForm">
    <input class="Wdate" name="start_date" value="<?php echo $this->_var['start_date']; ?>" onfocus="WdatePicker({dateFmt:'yyyy-M-d',maxDate:'%y-%M-%d'})"/>
    &nbsp;&nbsp;&nbsp;&nbsp;
    <input class="Wdate" name="end_date" value="<?php echo $this->_var['end_date']; ?>" onfocus="WdatePicker({dateFmt:'yyyy-M-d',minDate:'%y-%M-%d'})"/>
   <input name="act" type="hidden" value="order_stats" />
    <input name="op" type="hidden" value="statistical" />
    <input type="submit" name="submit" value="查询" class="btn" />
  </form>
                 </div>
                 <div class="titleright"><a href="?op=statistical&act=order_stats_download&start_date=<?php echo $this->_var['fstart_date']; ?>&end_date=<?php echo $this->_var['fend_date']; ?>">统计报表下载</a></div>
            </div>
		  <div class="conbox">
   <div>
  <p style="margin: 10px">
    <strong>有效订单总金额</strong>:&nbsp;&nbsp;<?php echo $this->_var['total_turnover']; ?>&nbsp;&nbsp;&nbsp;
  </p>

  
    <ul class="listtab">
				<li id='nav1'class="act" class="act"><a href="javascript:;" onclick="show_html(1,2);"><?php echo $this->_var['lang']['order_circs']; ?></a></li>
                <li id='nav2'><a href="javascript:;" onclick="show_html(2,2);"><?php echo $this->_var['lang']['pay_method']; ?></a></li>
	</ul>
  <div class="conbox" style="display:block;" id="show_html1">
  <table width="90%" cellspacing="0" cellpadding="3">
      <tr>
        <td align="center">
        <?php if ($this->_var['is_multi'] == '0'): ?>
        <OBJECT classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"  codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0" WIDTH="650" HEIGHT="400" id="OrderGeneral" ALIGN="middle">
          <PARAM NAME="FlashVars" value="&dataXML=<?php echo $this->_var['order_general_xml']; ?>">
          <PARAM NAME="movie" VALUE="templates/images/charts/pie3d.swf?chartWidth=650&chartHeight=400">
          <PARAM NAME="quality" VALUE="high">
          <PARAM NAME=bgcolor VALUE="#FFFFFF">
          <param name="wmode" value="opaque" />
          <EMBED src="templates/images/charts/pie3d.swf?chartWidth=650&chartHeight=400" FlashVars="&dataXML=<?php echo $this->_var['order_general_xml']; ?>" quality="high" bgcolor="#FFFFFF" WIDTH="650" HEIGHT="400" wmode="opaque" NAME="OrderGeneral" ALIGN="middle" TYPE="application/x-shockwave-flash" PLUGINSPAGE="http://www.macromedia.com/go/getflashplayer"></EMBED>
          </OBJECT>
        <?php else: ?>
        <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"
              codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0"
              width="565" height="420" id="FCColumn2" align="middle">
              <PARAM NAME="FlashVars" value="&dataXML=<?php echo $this->_var['order_general_xml']; ?>">
              <PARAM NAME=movie VALUE="templates/images/charts/MSColumn3D.swf?chartWidth=650&chartHeight=400">
              <param NAME="quality" VALUE="high">
              <param NAME="bgcolor" VALUE="#FFFFFF">
              <param name="wmode" value="opaque" />
              <embed src="templates/images/charts/MSColumn3D.swf?chartWidth=650&chartHeight=400" FlashVars="&dataXML=<?php echo $this->_var['order_general_xml']; ?>" quality="high" bgcolor="#FFFFFF"  width="650" height="400" name="FCColumn2" wmode="opaque" align="middle" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer">
            </object>
    <?php endif; ?>
        </td>
      </tr>
    </table>
  </div>
   <div class="conbox" style="display:none;" id="show_html2">
 <table width="90%" cellspacing="0" cellpadding="3">
      <tr>
        <td align="center">
        <?php if ($this->_var['is_multi'] == '0'): ?>
          <OBJECT classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"  codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0" WIDTH="650" HEIGHT="400" id="PayMethod" ALIGN="middle">
          <PARAM NAME="FlashVars" value="&dataXML=<?php echo $this->_var['pay_xml']; ?>">
          <PARAM NAME="movie" VALUE="templates/images/charts/pie3d.swf?chartWidth=650&chartHeight=400">
          <PARAM NAME="quality" VALUE="high">
          <PARAM NAME="bgcolor" VALUE="#FFFFFF">
          <param name="wmode" value="opaque" />
          <EMBED src="templates/images/charts/pie3d.swf?chartWidth=650&chartHeight=400" FlashVars="&dataXML=<?php echo $this->_var['pay_xml']; ?>" quality="high" bgcolor="#FFFFFF" WIDTH="650" HEIGHT="400" NAME="PayMethod" wmode="opaque" ALIGN="middle" TYPE="application/x-shockwave-flash" PLUGINSPAGE="http://www.macromedia.com/go/getflashplayer"></EMBED>
        </OBJECT>
    <?php else: ?>
    <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0"
              width="565" height="420" id="FCColumn2" align="middle">
              <PARAM NAME="FlashVars" value="&dataXML=<?php echo $this->_var['pay_xml']; ?>">
              <PARAM NAME=movie VALUE="templates/images/charts/MSColumn3D.swf?chartWidth=650&chartHeight=400">
              <param NAME="quality" VALUE="high">
              <param NAME="bgcolor" VALUE="#FFFFFF">
              <param name="wmode" value="opaque" />
              <embed src="templates/images/charts/MSColumn3D.swf?chartWidth=650&chartHeight=400" FlashVars="&dataXML=<?php echo $this->_var['pay_xml']; ?>" quality="high" bgcolor="#FFFFFF"  width="650" height="400" name="FCColumn2" wmode="opaque" align="middle" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer"></object>
    <?php endif; ?>
        </td>
      </tr>
    </table>
   	</div>  
         
 </div>
</div>
</div>           
<?php endif; ?>
</body>
</html>