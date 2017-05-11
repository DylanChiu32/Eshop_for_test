<!doctype html>
<html lang="zh-CN">
<head>
<meta name="Generator" content="haohaios v1.0" />
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
<title>商家管理平台</title>
<link href="templates/css/mobile.css" rel="stylesheet" type="text/css" />
</head>
<body >
<?php if ($this->_var['action'] == 'default'): ?>
<div class="container">
    <div class="main">
        <h1><?php echo $this->_var['info']['suppliers_name']; ?></h1>
        <div class="mbox">
            <h3>今日概况</h3>
            <ul class="ult">
                <li>订单数（个）<br/><?php echo $this->_var['today_order']; ?><br/><span>昨日：<?php echo $this->_var['yestoday_order']; ?></span></li>
                <li>成团数（个）<br/><?php echo $this->_var['teamtoday']; ?><br/><span>昨日：<?php echo $this->_var['team_yestoday']; ?></span></li>
                <li>成交额（元）<br/><?php echo $this->_var['today_money']; ?><br/><span>昨日：<?php echo $this->_var['yestoday_money']; ?></span></li>
            </ul>
        </div>
        <div class="mbox">
            <h3>整体概况</h3>
            <ul class="ulb">
                <li>商品总数<br/><?php echo $this->_var['goodsnum']; ?></li>
                <li>共成团<br/><?php echo $this->_var['totle_team']; ?></li>
                <li>总成交额<br/><?php echo $this->_var['totle_money']; ?></li>
                <li>总订单量<br/><?php echo $this->_var['totle_count']; ?></li>
                <li><a href="?composite_status=101&act=goods_order2&op=order">待核销订单<br/><?php echo $this->_var['weihe']; ?></a></li>
                <li>已核销订单<br/><?php echo $this->_var['yihe']; ?></li>
            </ul>
        </div>
    </div>
</div>
<div class="footer">
    <ul>
        <li><a href="?op=main&act=default" class="cur">首页</a></li>
        <li><a href="?composite_status=101&act=goods_order&op=order">待发货订单</a></li>
        <li><a href="?composite_status=101&act=goods_order2&op=order">待核销订单</a></li>
    </ul>
</div>
<?php endif; ?>
</body>
</html>