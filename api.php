<?php
define('IN_HHS', true);

require(dirname(__FILE__) . '/includes/init2.php');

require_once('includes/lib_order.php');

require_once('includes/lib_payment.php');

require_once('includes/modules/payment/wxpay.php');

include_once('includes/cls_json.php');

$act = isset($_REQUEST['act']) ? trim($_REQUEST['act']) : 'queryOrder';

$last_time = trim($_REQUEST['serv_time']);

if($act == 'queryOrder')
{		
	$sql = "select u.uname,u.headimgurl,o.pay_time from ".$hhs->table('order_info')." as o,".$hhs->table('users')." as u where o.pay_time > '".$last_time."' and o.user_id = u.user_id order by order_id desc";	
	$order = $db->getRow($sql);	
	$serv_time = gmtime();	
	$html = empty($order)?'':'<div class="ws-for-push ws-for-push-show"><img src="'.$order['headimgurl'].'"><span>最新订单来自'.$order['uname'].'，1秒前</span></div>';	
	$result = array('error' => 0, 'message' => '', 'content' => $html, 'serv_time' => $serv_time);	
	$json  = new JSON;	
	die($json->encode($result));	
}
if($act == 'queryRemaind')
{	
	
	$result = array('error' => 0, 'message' => '');
	
	$json  = new JSON;
	
	if($_CFG['auto_cancel'] > 0)
	{
	
		$sql = "select order_id,order_sn,user_id,point_remaind_time,money_paid from ".$hhs->table('order_info')." where point_shop_remind = 2 AND order_status = 1 AND pay_status = 2 AND shipping_status = 0 ";	
	
		$order_info = $db->getAll($sql);
		
		if(empty($order_info))
		{
		
			$result = array('error' => 3, 'message' => '请设置取消订单的时间');
					
			die($json->encode($result));
		
		}
		
		$arr['order_status']    = OS_RETURNED; 

        $arr['pay_status']  = PS_REFUNDED;

        $arr['shipping_status'] = 0;
		
        $arr['money_paid']  = 0;

        $arr['order_amount']= $order['money_paid'] + $order['order_amount'];
		
		$arr['point_shop_remind']  = 3;//自提提醒后过期退款

        $order_info['shipping_status'] = 0;		
		
		foreach($order_info as $key => $value)
		{		
			
			//获取当前时间
			
			$serv_time = gmtime()-($_CFG['auto_cancel']*24*60*60);
			
			if(isset($value['point_remaind_time']) && ($value['point_remaind_time'] < $serv_time) )
			{
				$refund_money = $value['money_paid']*100;
				//微信支付退款，只有微信支付的才退，no zuo no die 
				$r=refund($value['order_sn'],$refund_money);
				
				if($r)
				{
					
					update_order($value['order_id'], $arr);

					/* 记录log */
		
					order_action($value['order_sn'], 4, $order_info['shipping_status'], 3, '自提订单提醒过期退款');
		
					$user_id=$value['user_id'];
		
					$order_id=$value['order_id'];
		
					$wxch_order_name='refund';
		
					include_once('wxch_order.php');
					
					$result = array('error' => 2, 'message' => '请设置取消订单的时间');
					
					die($json->encode($result));
					
				}
			
			}
		
		}
	
	}

	$result = array('error' => 1, 'message' => '请设置取消订单的时间');
	
	die($json->encode($result));
				

}
