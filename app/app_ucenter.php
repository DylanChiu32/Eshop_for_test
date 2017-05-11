<?php
define('IN_HHS', true);
$user_id = $_REQUEST['user_id'];
include_once(ROOT_PATH .'includes/lib_fenxiao.php');
    /* 订单状态 */
    
$_LANG['os'][OS_UNCONFIRMED] = '未确认';
$_LANG['os'][OS_CONFIRMED] = '已确认';
$_LANG['os'][OS_SPLITED] = '已确认';
$_LANG['os'][OS_SPLITING_PART] = '已确认';
$_LANG['os'][OS_CANCELED] = '已取消';
$_LANG['os'][OS_INVALID] = '无效';
$_LANG['os'][OS_RETURNED] = '已退货';
$_LANG['ss'][SS_UNSHIPPED] = '未发货';
$_LANG['ss'][SS_PREPARING] = '配货中';
$_LANG['ss'][SS_SHIPPED] = '配送中';//已发货
$_LANG['ss'][SS_RECEIVED] = '已签收';//收货确认
$_LANG['ss'][SS_SHIPPED_PART] = '已发货(部分商品)';
$_LANG['ss'][SS_SHIPPED_ING] = '配货中'; // 已分单
$_LANG['ps'][PS_UNPAYED] = '待支付';
$_LANG['ps'][PS_PAYING] = '付款中';
$_LANG['ps'][PS_PAYED] = '已付款';
$_LANG['ps'][PS_REFUNDED] = '已退款';
$_LANG['cancel'] = '取消订单';
$_LANG['pay_money'] = '付款';
$_LANG['view_order'] = '查看订单';
$_LANG['received'] = '确认收货';
$_LANG['ss_received'] = '已完成';
$_LANG['confirm_received'] = '你确认已经收到货物了吗？';
$_LANG['confirm_cancel'] = '您确认要取消该订单吗？取消后此订单将视为无效订单';
//if(!$_SESSION['user_id'])
//{
//	$results['error'] =0;
//	$results['content'] ='请先登录';
//	echo $json->encode($results);
//	die();
//		
//}

if($action =='')
{
	$action ='default';	
}
if ($action == 'default')
{
	include_once(ROOT_PATH .'includes/lib_clips.php');
        /**
     * 申请供应商什么的
     */
    $sql = "SELECT `is_check`,`suppliers_id` from ".$hhs->table('suppliers')." WHERE `user_id` = " . $_SESSION['user_id'];
    $row = $db->getRow($sql);
	$user_info['is_check'] = $row['is_check'];
	$user_info['suppliers_id'] = $row['suppliers_id'];
    $user_info['info'] = get_user_default($user_id);
   	$user_info['user_notice'] = $_CFG['user_notice'];
    $user_info['prompt'] =get_user_prompt($user_id);
	$results['content'] =$user_info;
	echo $json->encode($results);
	die();
}
elseif($action =='order_list')
{
    include_once(ROOT_PATH . 'includes/lib_transaction.php');
    include_once(ROOT_PATH . 'includes/lib_payment.php');
    include_once(ROOT_PATH . 'includes/lib_order.php');
    include_once(ROOT_PATH . 'includes/lib_clips.php');
    $page = isset($_REQUEST['page']) ? intval($_REQUEST['page']) : 1;
    $composite_status = isset($_REQUEST['composite_status']) ? intval($_REQUEST['composite_status']) : -1;
    $where=" AND is_luck = 0 ";
    //未付款
    if($_REQUEST['composite_status'] =='100')
    {
        $where = " and order_status in (0,1,5)  and pay_status=0 ";
    }
    //待收货
    if($_REQUEST['composite_status'] =='180')
    {
        $where .= order_query_sql('await_ship');
    }
    /* 已发货订单：不论是否付款 */
    if($_REQUEST['composite_status'] =='120')
    {
        $where .= order_query_sql('shipped2');
    }
    /* 已完成订单 */
    if($_REQUEST['composite_status'] =='999')
    {
        $where .= order_query_sql();
    }

    $page = isset($_REQUEST['page']) ? intval($_REQUEST['page']) : 1;
    $orders = app_get_user_orders_ex($user_id,2, 0, $where);
	foreach($orders as $idx=>$v)
	{
		foreach($v['goods_list'] as $id=>$vs)
		{
			$v['goods_list'][$id]['goods_thumb'] = $redirect_uri.$vs['goods_thumb'];
			$v['goods_list'][$id]['little_img'] = $redirect_uri.$vs['little_img'];
		}
		$orders[$idx] = $v;
	}
//echo "<pre>";

//print_r($orders);exit;

	
	
  	//$orders['composite_status'] = $composite_status;
	$results['content'] = $orders;
	//$results['composite_status'] = $composite_status;
	//$results['error'] =1;
	echo $json->encode($results);
	die();
}
elseif($action =='affirm_received')
{
    include_once(ROOT_PATH . 'includes/lib_transaction.php');
    include_once(ROOT_PATH . 'includes/lib_order.php');
    include_once(ROOT_PATH . 'includes/lib_fenxiao.php');
    //payment_info
    $order_id = isset($_REQUEST['order_id']) ? intval($_REQUEST['order_id']) : 0;
 
	
    
    if (affirm_received($order_id, $user_id))
    {

    	//分销更新状态
        $update_at = gmtime();
        updateMoney($order_id,$update_at);
        
        $order_info = order_info($order_id);
    	// 收货之后发优惠券
        if($_CFG['send_bonus_time'] == 1){
        	$bonus_list=send_order_bonus($order_id);
        }
      //  doFenxiao($order_info);
        if($order_info['team_sign'] > 0 && $_CFG['send_bonus_time'] == 0){
        	$bonus_list=send_order_bonus($order_id);
        }
        if(!empty($bonus_list)){
			
			
			$results['error'] =2;
			$results['order_id'] = $order_id;
			echo $json->encode($results);
			die();
			
        }
		
		$results['error'] =0;
		$results['composite_status'] = 999;
		echo $json->encode($results);
		die();

    }
    else
    {
		$results['error'] =1;
		echo $json->encode($results);
		die();

        //$err->show($_LANG['order_list_lnk'], 'user.php?act=order_list');
    }	
	
}
elseif($action =='cancel_order')
{
    include_once(ROOT_PATH . 'includes/lib_transaction.php');
    include_once(ROOT_PATH . 'includes/lib_order.php');
    $order_id = isset($_GET['order_id']) ? intval($_GET['order_id']) : 0;
    if (cancel_order($order_id, $user_id))
    {
		$results['error'] =0;
		echo $json->encode($results);
		die();
   }
    else
    {
		$results['error'] =1;
		echo $json->encode($results);
		die();
    }
}
elseif($action =='team_list')
{
    include_once(ROOT_PATH . 'includes/lib_transaction.php');
	$composite_status = isset($_REQUEST['composite_status']) ? intval($_REQUEST['composite_status']) : '';
	$where = ' AND `is_luck` = 0 ';
	switch ($composite_status) {
        case 999:
            $where .= " AND `team_status` > 2 ";
            break;
        case 120:
            $where .= " AND `team_status` = 2 ";
            break;
        case 100:
            $where .= " AND `team_status` = 1 ";
            break;
        
        default:
            $where .= " AND `team_status` > 0 ";
            break;
    }
	
    $page = isset($_REQUEST['page']) ? intval($_REQUEST['page']) : 1;
    $orders = get_user_team_orders($user_id, 10000, 0, $where);
	
	foreach($orders as $idx=>$v)
	{
		foreach($v['goods_list'] as $id=>$vs)
		{
			$v['goods_list'][$id]['goods_thumb'] = $redirect_uri.$vs['goods_thumb'];
			$v['goods_list'][$id]['little_img'] = $redirect_uri.$vs['little_img'];
		}
		$orders[$idx] = $v;
	}
	
	
	
  	//$orders['composite_status'] = $composite_status;
	$results['content'] = $orders;
	$results['composite_status'] = $composite_status;
	$results['error'] =1;
	echo $json->encode($results);
	die();
}
elseif($action =='order_detail')
{
    include_once(ROOT_PATH . 'includes/lib_transaction.php');
    include_once(ROOT_PATH . 'includes/lib_payment.php');
    include_once(ROOT_PATH . 'includes/lib_order.php');
    include_once(ROOT_PATH . 'includes/lib_clips.php');
    $order_id = isset($_GET['order_id']) ? intval($_GET['order_id']) : 0;
    /* 订单详情 */
    $order = get_order_detail($order_id, $user_id);
    if($order['is_luck']){
        $luck_rows = $db->getAll('select * from '.$hhs->table("order_luck").' WHERE order_id = "'.$order_id.'" ');
        $order['luck_rows'] = $luck_rows;
    }
    $team = isset($_GET['team']) ? intval($_GET['team']) : 0;
//    if($team>0 && !empty($order['team_sign']) && $order['team_status']!=0&&!empty($order['pay_time'])){//
//        //成功的回调
//        //include_once(ROOT_PATH .'successurl.php');
//    
//        hhs_header("location:share.php?team_sign=".$order['team_sign']);
//        exit();
//
//    }
//    if ($order === false)
//    {
//        //$err->show($_LANG['back_home_lnk'], './');
//        hhs_header("location:index.php");
//        exit;
//    }

    /* 是否显示添加到购物车 */
//    if ($order['extension_code'] != 'group_buy' && $order['extension_code'] != 'exchange_goods')
//    {
//        $smarty->assign('allow_to_cart', 1);
//    }

    /* 订单商品 */
    $goods_list = order_goods($order_id);
    foreach ($goods_list AS $key => $value)
    {
        $goods_list[$key]['market_price'] = price_format($value['market_price'], false);
        $goods_list[$key]['goods_price']  = price_format($value['goods_price'], false);
        $goods_list[$key]['subtotal']     = price_format($value['subtotal'], false);
    }

     /* 设置能否修改使用余额数 */
//    if ($order['order_amount'] > 0)
//    {
//        if ($order['order_status'] == OS_UNCONFIRMED || $order['order_status'] == OS_CONFIRMED)
//        {
//            $user = user_info($order['user_id']);
//            if ($user['user_money'] + $user['credit_line'] > 0)
//            {
//                $smarty->assign('allow_edit_surplus', 1);
//                $smarty->assign('max_surplus', sprintf($_LANG['max_surplus'], $user['user_money']));
//            }
//        }
//    }

    /* 未发货，未付款时允许更换支付方式 */
    if ($order['order_amount'] > 0 && $order['pay_status'] == PS_UNPAYED && $order['shipping_status'] == SS_UNSHIPPED)
    {
        $payment_list = available_payment_list(false, 0, true);

        /* 过滤掉当前支付方式和余额支付方式 */
        if(is_array($payment_list))
        {
            foreach ($payment_list as $key => $payment)
            {
                if ($payment['pay_id'] == $order['pay_id'] || $payment['pay_code'] == 'balance')
                {
                    unset($payment_list[$key]);
                }
            }
        }
		$order['payment_list'] = $payment_list;
      //  $smarty->assign('payment_list', $payment_list);
    }

    
    $order['order_status_cy']=$order['order_status'] ;
    $order['pay_status_cy']=$order['pay_status'] ;
    $order['shipping_status_cy']=$order['shipping_status'] ;
    /*可进行的操作*/
    
    if ($order['order_status'] == 0)
    {
		@$order['handler'] = $order['pay_online'];
        $order['handler'] .= "<a class='state_btn_1' href=\"user.php?act=cancel_order&order_id=" .$order['order_id']. "\" onclick=\"if (!confirm('".$GLOBALS['_LANG']['confirm_cancel']."')) return false;\">取消订单</a>";
        
    }
    else if ($order['order_status'] == OS_SPLITED)
    {
        /* 对配送状态的处理 */
        if ($order['shipping_status'] == SS_SHIPPED)
        {
            @$order['handler'] = "<a class='state_btn_1' href=\"user.php?act=affirm_received&order_id=" .$order['order_id']. "\" onclick=\"if (!confirm('".$GLOBALS['_LANG']['confirm_received']."')) return false;\">".$GLOBALS['_LANG']['received']."</a>";
            
            @$order['handler'] .= "<a class='state_btn_2' href=\"javascript:void(0);\" onclick='get_invoice(\"".$order['shipping_name']."\",\"".$order['invoice_no']."\");'>查看物流</a>";
        }/*
        elseif ($row['shipping_status'] == SS_RECEIVED)
        {
            @$row['handler'] = '<span style="color:red">'.$GLOBALS['_LANG']['ss_received'] .'</span>';
        }*/
        else
        {
            if ($order['pay_status'] == PS_UNPAYED)
            {
                @$order['handler'] = $order['pay_online'];
            }     
        }
    }
 
   
    $order['order_status'] = $_LANG['os'][$order['order_status']] . ',' . $_LANG['ps'][$order['pay_status']] . ',' . $_LANG['ss'][$order['shipping_status']];
	$province=$db->getRow("select region_name from hhs_region where region_id='$order[province]'");
    $city=$db->getRow("select region_name from hhs_region where region_id='$order[city]'");
    $district=$db->getRow("select region_name from hhs_region where region_id='$order[district]'");
    $order['province']=$province['region_name'];
    $order['city']=$city['region_name'];
    $order['district']=$district['region_name'];

	if($order['point_id'])
	{
		$order['shipping_point'] = get_shipping_point_name($order['point_id']);
		
	}
    $order['add_time']=local_date("Y-m-d H:i:s",$order['add_time']);
	$order['goods_list'] = $goods_list;
//    $smarty->assign('order',      $order);
//    $smarty->assign('goods_list', $goods_list);
//    $smarty->display('user_order.dwt');
	$results['error'] =0;
	echo $json->encode($order);
	die();	
	
}
elseif($action=='lottery_list')
{
	
	
    include_once(ROOT_PATH . 'includes/lib_transaction.php');
	$composite_status = isset($_REQUEST['composite_status']) ? intval($_REQUEST['composite_status']) : '';
	$where = ' AND `is_luck` = 1 ';
    if($_REQUEST['composite_status'] =='100')
    {
        $where .= " and pay_status =2 and team_status=1 ";
    }
    //待收货
    if($_REQUEST['composite_status'] =='120')
    {
        $where .= " and order_status in (0,1,5) and team_status=2";
    }
    //評論
    if($_REQUEST['composite_status'] =='999')
    {
        $where .= "  and pay_status=2 and shipping_status=2 and is_comm = 0 ";
    }

    $page = isset($_REQUEST['page']) ? intval($_REQUEST['page']) : 1;
    $orders = get_user_team_orders($user_id, 10000, 0, $where);
	
	foreach($orders as $idx=>$v)
	{
		foreach($v['goods_list'] as $id=>$vs)
		{
			$v['goods_list'][$id]['goods_thumb'] = $redirect_uri.$vs['goods_thumb'];
			$v['goods_list'][$id]['little_img'] = $redirect_uri.$vs['little_img'];
		}
		$orders[$idx] = $v;
	}
	
	
	
  	//$orders['composite_status'] = $composite_status;
	$results['content'] = $orders;
	$results['composite_status'] = $composite_status;
	$results['error'] =1;
	echo $json->encode($results);
	die();	
	
}
/* 添加收藏商品(ajax) */
elseif ($action == 'collect')
{
    include_once(ROOT_PATH .'includes/cls_json.php');
    $json = new JSON();
    $result = array('error' => 0, 'message' => '');
    $goods_id = $_REQUEST['goods_id'];
    if (!isset($user_id) || $user_id == 0)
    {
        $result['error'] = 4;
        $result['message'] = '请先登录';
        die($json->encode($result));
    }
    else
    {
        /* 检查是否已经存在于用户的收藏夹 */
        $sql = "SELECT COUNT(*) FROM " .$GLOBALS['hhs']->table('collect_goods') .
            " WHERE user_id='$user_id' AND goods_id = '$goods_id'";
        if ($GLOBALS['db']->GetOne($sql) > 0)
        {
            $result['error'] = 2;
            $result['message'] = '该商品已收藏过了';
            die($json->encode($result));
        }
        else
        {
            $time = gmtime();
            $sql = "INSERT INTO " .$GLOBALS['hhs']->table('collect_goods'). " (user_id, goods_id, add_time)" .
                    "VALUES ('$user_id', '$goods_id', '$time')";
            if ($GLOBALS['db']->query($sql) === false)
            {
                $result['error'] = 3;
                $result['message'] = $GLOBALS['db']->errorMsg();
                die($json->encode($result));
            }
            else
            {
                $result['error'] = 1;
                $result['message'] = '收藏成功';
                die($json->encode($result));
            }
        }
    }
}
elseif ($action == 'collect_store')
{

    include_once(ROOT_PATH .'includes/cls_json.php');
    $json = new JSON();
    $result = array('error' => 0, 'message' => '');
    $goods_id = $_REQUEST['store_id'];
   if (!isset($user_id) || $user_id == 0)
    {
        $result['error'] = 3;
        $result['message'] = '请先登录';
        die($json->encode($result));
    }
    else
    {
        /* 检查是否已经存在于用户的收藏夹 */
        $sql = "SELECT COUNT(*) FROM " .$GLOBALS['hhs']->table('collect_store') .
            " WHERE user_id='$user_id' AND suppliers_id = '$goods_id'";
        if ($GLOBALS['db']->GetOne($sql) > 0)
        {
            $result['error'] = 2;
            $result['message'] ='该店铺已经在收藏夹中';
            die($json->encode($result));
        }
        else
        {
            $time = gmtime();
            $sql = "INSERT INTO " .$GLOBALS['hhs']->table('collect_store'). " (user_id, suppliers_id, add_time)" .
                    "VALUES ('$user_id', '$goods_id', '$time')";
            if ($GLOBALS['db']->query($sql) === false)
            {
                $result['error'] = 3;
                $result['message'] = $GLOBALS['db']->errorMsg();
                die($json->encode($result));
            }
            else
            {
                $result['error'] = 1;
                $result['message'] = '收藏店铺成功';
                die($json->encode($result));
            }
        }
    }
}
elseif($action =='collection_list')
{
    include_once(ROOT_PATH . 'includes/lib_clips.php');
  
    $goods_list = get_collection_goods_app($user_id);
	
	foreach($goods_list as $idx=>$v)
	{
		$goods_list[$idx]['goods_thumb'] = $redirect_uri.$v['goods_thumb'];
	}
	$results['goods_list'] = $goods_list;
	$results['url'] = $hhs->url();
	$results['error'] =1;
	echo $json->encode($results);
	die();
}
/* 删除收藏的商品 */
elseif ($action == 'delete_collection')
{
    include_once(ROOT_PATH . 'includes/lib_clips.php');
    $collection_id = isset($_REQUEST['collection_id']) ? intval($_REQUEST['collection_id']) : 0;
    if ($collection_id > 0)
    {
        $db->query('DELETE FROM ' .$hhs->table('collect_goods'). " WHERE rec_id='$collection_id' AND user_id ='$user_id'" );
    }
	$results['error'] =1;
	echo $json->encode($results);
	die();
}
elseif ($action == 'collect_store_list')
{
    include_once(ROOT_PATH . 'includes/lib_clips.php');
	$sql = "select c.*,s.suppliers_name,s.real_name from ".$GLOBALS['hhs']->table('collect_store')." as c,".$GLOBALS['hhs']->table('suppliers')." as s where s.suppliers_id=c.suppliers_id and c.user_id='$user_id' order by id desc  ";
	$list = $GLOBALS['db'] -> getAll($sql);
	foreach($list as  $idx=>$value)
	{
		$list[$idx]['add_time']= local_date($GLOBALS['_CFG']['time_format'], $value['add_time']);
		$list[$idx]['logo'] = $redirect_uri.get_logo($value['suppliers_id']);
	}
	
	$results['store_list'] = $list;
	$results['url'] = $hhs->url();
	$results['error'] =1;
	echo $json->encode($results);
	die();
}
elseif ($action == 'del_collect_store')
{
    $rec_id = (int)$_GET['id'];
    if ($rec_id)
    {
        $db->query('DELETE FROM' .$hhs->table('collect_store'). "  WHERE suppliers_id='$rec_id' AND user_id ='$user_id'" );
    }
	$results['error'] =1;
	echo $json->encode($results);
	die();
}
elseif($action =='bonus')
{
    include_once(ROOT_PATH .'includes/lib_transaction.php');
    $page = isset($_REQUEST['page']) ? intval($_REQUEST['page']) : 1;
    $record_count = $db->getOne("SELECT COUNT(*) FROM " .$hhs->table('user_bonus'). " WHERE user_id = '$user_id'");
	
	// $smarty->assign('send_bouns',$_REQUEST['send_bouns']);
		
    //$pager = get_pager('user.php', array('act' => $action), $record_count, $page);
    $bonus = get_user_bouns_list2($user_id);
    if($_REQUEST['status']=='not_start'){
        $smarty->assign('status', 'not_start');
        $arr=$bonus['not_start'];
        $bonus=array();
        $bonus['not_start']=$arr;
    }elseif($_REQUEST['status']=='overdue'){
        $smarty->assign('status', 'overdue');
        $arr=$bonus['overdue'];
        $bonus=array();
        $bonus['overdue']=$arr;
    }
	$results['content'] = $bonus;
	$results['error'] =1;
	
	
	
	echo $json->encode($results);
	die();

}
elseif($action =='add_bonus')
{
	if(isset($_REQUEST['send_bouns'])){
		$result = app_add_bonus($user_id, $_REQUEST['send_bouns']);
		if($result==1)
		{
			$results['error'] =1;
			$results['content'] ='请先登录';
		}
		if($result==2)
		{
			$results['error'] =2;
			$results['content'] ='优惠券已过期';
		}
		if($result==3)
		{
			$results['error'] =3;
			$results['content'] ='绑定成功';
		}
		if($result==4)
		{
			$results['error'] =4;
			$results['content'] ='绑定失败';
		}
		if($result==5)
		{
			$results['error'] =5;
			$results['content'] ='优惠券已经绑定过了';
		}
		if($result==6)
		{
			$results['error'] =6;
			$results['content'] ='优惠券已被其他人使用过了';
		}
		if($result==7)
		{
			$results['error'] =7;
			$results['content'] ='优惠券不存在';
		}
	}
	else
	{
		$results['error'] =0;
		$results['content'] ='请输入优惠券序列号';
	}
		echo $json->encode($results);
		die();
	
}
elseif($action =='get_regions')
{
	
	$list = $db->getAll("select * from ".$hhs->table('region')." where region_type=1");

	foreach($list as $idx=>$v)
	{
		
		$parent_id = $v['parent_id'];
		$city_list = $db->getAll("select * from ".$hhs->table('region')." where parent_id='$parent_id'");
		foreach($city_list as $key=>$vs)
		{
			$pid = $vs['parent_id'];
			$district_list = $db->getAll("select * from ".$hhs->table('region')." where parent_id='$pid'");
			$city_list[$key]['district_list'] = $district_list;
		}
		$list[$idx]['city_list'] = $city_list;
	}	
	$results['content'] = $list;
	echo $json->encode($results);
	die();
}
elseif ($action == 'drop_consignee')
{
    include_once('includes/lib_transaction.php');
    $consignee_id = intval($_REQUEST['id']);
    if (app_drop_consignee($consignee_id,$user_id))
    {
		$results['error'] =0;
		echo $json->encode($results);
		die();
    }
    else
    {
		$results['error'] =1;
		echo $json->encode($results);
		die();
    }
}
elseif($action=='address_list')
{
	
   include_once(ROOT_PATH . 'includes/lib_transaction.php');
   include_once(ROOT_PATH . 'includes/lib_orders.php');
    include_once(ROOT_PATH . 'languages/' .$_CFG['lang']. '/shopping_flow.php');
    $smarty->assign('lang',  $_LANG);
  
    /* 获得用户所有的收货人信息 */
    $consignee_list = get_consignee_list($user_id);
	$address_id  = $db->getOne("SELECT address_id FROM " .$hhs->table('users'). " WHERE user_id='$user_id'");

   
    //取得国家列表，如果有收货人列表，取得省市区列表
    foreach ($consignee_list AS $region_id => $consignee)
    {
		if($consignee['address_id'] ==$address_id)
		{
			 $consignee_list[$region_id]['is_default'] =1;
		}
		else
		{
			 $consignee_list[$region_id]['is_default'] =0;
		}
      ////  $consignee_list[$region_id]['province_name'] = get_regions_name($consignee['province']);
		//$consignee_list[$region_id]['city_name'] = get_regions_name($consignee['city']);
       // $consignee_list[$region_id]['district_name'] = get_regions_name($consignee['district']);
        
    }
    /* 获取默认收货ID */
    
   
	$results['consignee_list'] = $consignee_list;

	echo $json->encode($results);
	die();	
}
elseif ($action == 'edit_consignee')
{
    //编辑收货人地址
    include_once('includes/lib_transaction.php');

    $address_id=$_REQUEST['address_id'];
    $sql = "SELECT * FROM " . $GLOBALS['hhs']->table('user_address') .
    " WHERE address_id = '$address_id' ";
    $consignee=$GLOBALS['db']->getRow($sql);
	
    $consignee['province_name'] = get_regions_name($consignee['province']);
	$consignee['city_name'] = get_regions_name($consignee['city']);
    $consignee['district_name'] = get_regions_name($consignee['district']);

	$results['consignee'] = $consignee;
	$results['error'] = 0;
	echo $json->encode($results);
	die();	

}
elseif($action =='act_edit_consignee')
{
    include_once(ROOT_PATH . 'includes/lib_transaction.php');
    include_once(ROOT_PATH . 'languages/' .$_CFG['lang']. '/shopping_flow.php');
    $smarty->assign('lang', $_LANG);
    $address = array(
        'user_id'    => $user_id,
        'address_id' => intval($_REQUEST['address_id']),
		'address_type' => intval($_REQUEST['address_type']),
        'country'    => isset($_REQUEST['country'])   ? intval($_REQUEST['country'])  : 1,
        'province'   => isset($_REQUEST['province'])  ? intval($_REQUEST['province']) : 0,
        'city'       => isset($_REQUEST['city'])      ? intval($_REQUEST['city'])     : 0,
        'district'   => isset($_REQUEST['district'])  ? intval($_REQUEST['district']) : 0,
		'address_type'   => isset($_REQUEST['address_type'])  ? intval($_REQUEST['address_type']) : 0,
        'address'    => isset($_REQUEST['address'])   ? compile_str(trim($_REQUEST['address']))    : '',
        'consignee'  => isset($_REQUEST['consignee']) ? compile_str(trim($_REQUEST['consignee']))  : '',
        'email'      => isset($_REQUEST['email'])     ? compile_str(trim($_REQUEST['email']))      : '',
        'tel'        => isset($_REQUEST['tel'])       ? compile_str(make_semiangle(trim($_REQUEST['tel']))) : '',
        'mobile'     => isset($_REQUEST['mobile'])    ? compile_str(make_semiangle(trim($_REQUEST['mobile']))) : '',
        'best_time'  => isset($_REQUEST['best_time']) ? compile_str(trim($_REQUEST['best_time']))  : '',
        'sign_building' => isset($_REQUEST['sign_building']) ? compile_str(trim($_REQUEST['sign_building'])) : '',
        'zipcode'       => isset($_REQUEST['zipcode'])       ? compile_str(make_semiangle(trim($_REQUEST['zipcode']))) : '',
    );	
	$address['province'] =get_str_replace_region_name(1,$address['province']);
	$address['city'] =get_str_replace_region_name(2,$address['city']);
	$address['district'] =get_str_replace_region_name(3,$address['district']);
    if (update_address($address))
    {  
		//$results['address_id'] = update_address($address);
		$results['error'] = 1;
		echo $json->encode($results);
		die();	
    }
	else
	{
		$results['error'] = 0;
		echo $json->encode($results);
		die();	
	}
	
}
elseif($action =='account_log')
{
	
    include_once(ROOT_PATH . 'includes/lib_clips.php');
    $page = isset($_REQUEST['page']) ? intval($_REQUEST['page']) : 1;
    /* 获取记录条数 */
    $sql = "SELECT COUNT(*) FROM " .$hhs->table('user_account').
           " WHERE user_id = '$user_id'" .
           " AND process_type " . db_create_in(array(SURPLUS_SAVE, SURPLUS_RETURN));
    $record_count = $db->getOne($sql);
    //分页函数
    $pager = get_pager('user.php', array('act' => $action), $record_count, $page);
    //获取剩余余额
    $surplus_amount = get_user_surplus($user_id);
    if (empty($surplus_amount))
    {
        $surplus_amount = 0;
    }
    //获取余额记录
    $account_log = app_get_account_log($user_id);
	//获取剩余积分
	$points = get_user_points($user_id);
	$smarty->assign('points', $points);
	$results['points'] = $points;
	$results['account_log'] = $account_log;
	$results['surplus_amount'] = price_format($surplus_amount, false);
	echo $json->encode($results);
	die();	
}
elseif($action =='cancel')
{
	
    include_once(ROOT_PATH . 'includes/lib_clips.php');
    $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
    if ($id == 0 || $user_id == 0)
    {
		$results['error'] =1;
		echo $json->encode($results);
		die();	
    }
    $result = del_user_account($id, $user_id);
    if ($result)
    {
		$results['error'] =0;
		echo $json->encode($results);
		die();	
    }
	
}
elseif($action =='act_account')
{
    include_once(ROOT_PATH . 'includes/lib_clips.php');
    include_once(ROOT_PATH . 'includes/lib_order.php');
    $amount = isset($_REQUEST['amount']) ? floatval($_REQUEST['amount']) : 0;
    if ($amount <= 0)
    {
        $results['error'] = 0;
		$results['content'] = '输入金额大于0';
		echo $json->encode($results);
		die();	
    }
    /* 变量初始化 */
    $surplus = array(
            'user_id'      => $user_id,
            'rec_id'       => !empty($_REQUEST['rec_id'])      ? intval($_REQUEST['rec_id'])       : 0,
            'process_type' => isset($_REQUEST['surplus_type']) ? intval($_REQUEST['surplus_type']) : 0,
            'payment_id'   => isset($_REQUEST['payment_id'])   ? intval($_REQUEST['payment_id'])   : 0,
            'user_note'    => isset($_REQUEST['user_note'])    ? trim($_REQUEST['user_note'])      : '',
            'amount'       => $amount
    );
   
	if ($amount < 1.00)
	{
        $results['error'] = 0;
		$results['content'] = '输入金额要大于1元';
		echo $json->encode($results);
		die();	
	}
	if ($amount > 200.00)
	{
		$results['error'] = 0;
		$results['content'] = '提现金额不得高于￥ 200.00';
		echo $json->encode($results);
		die();	

	}    
	/* 判断是否有足够的余额的进行退款的操作 */
	$sur_amount = get_user_surplus($user_id);
	if ($amount > $sur_amount)
	{
		$results['error'] = 0;
		$results['content'] = '输入金额大于当前钱包金额';
		echo $json->encode($results);
		die();	
	}
	//插入会员账目明细
	$amount = '-'.$amount;
	$surplus['payment'] = '';
	$surplus['rec_id']  = insert_user_account($surplus, $amount);

	$results['error'] = 1;
	$results['content'] = '提现成功';
	echo $json->encode($results);
	die();	
}
elseif($action =='account_detail')
{
	
    include_once(ROOT_PATH . 'includes/lib_clips.php');
    $page = isset($_REQUEST['page']) ? intval($_REQUEST['page']) : 1;
    $account_type = 'user_money';
    /* 获取记录条数 */
    $sql = "SELECT COUNT(*) FROM " .$hhs->table('account_log').
           " WHERE user_id = '$user_id'" .
           " AND $account_type <> 0 ";
    $record_count = $db->getOne($sql);
    //分页函数
    $pager = get_pager('user.php', array('act' => $action), $record_count, $page);
    //获取剩余余额
    $surplus_amount = get_user_surplus($user_id);
    if (empty($surplus_amount))
    {
        $surplus_amount = 0;
    }
	//获取剩余积分
	$points = get_user_points($user_id);

	
	
    //获取余额记录
    $account_log = array();
    $sql = "SELECT * FROM " . $hhs->table('account_log') .
           " WHERE user_id = '$user_id'" .
           " AND $account_type <> 0 " .
           " ORDER BY log_id DESC";
    $res = $GLOBALS['db']->selectLimit($sql, $pager['size'], $pager['start']);
    while ($row = $db->fetchRow($res))
    {
        $row['change_time'] = local_date($_CFG['date_format'], $row['change_time']);
        $row['type'] = $row[$account_type] > 0 ? '增加' : '减少';
        $row['user_money'] = price_format(abs($row['user_money']), false);
        $row['frozen_money'] = price_format(abs($row['frozen_money']), false);
        $row['rank_points'] = abs($row['rank_points']);
        $row['pay_points'] = abs($row['pay_points']);
        $row['short_change_desc'] = sub_str($row['change_desc'], 60);
        $row['amount'] = $row[$account_type];
        $account_log[] = $row;
    }
	$results['points'] = $points;
	$results['surplus_amount'] = price_format($surplus_amount, false);
	$results['account_log'] = $account_log;
	echo $json->encode($results);
	die();		
}
elseif($action =='account_raply')
{
    include_once(ROOT_PATH . 'includes/lib_clips.php');
    //获取剩余余额
    $surplus_amount = get_user_surplus($user_id);
    if (empty($surplus_amount))
    {
        $surplus_amount = 0;
    }
	//获取剩余积分
	$points = get_user_points($user_id);
	$results['points'] = $points;
	$results['surplus_amount'] = price_format($surplus_amount, false);
	echo $json->encode($results);
	die();		
	
}
elseif($action =='act_account')
{
    include_once(ROOT_PATH . 'includes/lib_clips.php');
    include_once(ROOT_PATH . 'includes/lib_order.php');
    $amount = isset($_POST['amount']) ? floatval($_POST['amount']) : 0;
    if ($amount <= 0)
    {
		$results['error'] =1;
		$results['message'] ='提现金额要大于0';
		echo $json->encode($results);
		die();		
    }
    /* 变量初始化 */
    $surplus = array(
            'user_id'      => $user_id,
            'rec_id'       => !empty($_REQUEST['rec_id'])      ? intval($_REQUEST['rec_id'])       : 0,
            'process_type' => isset($_REQUEST['surplus_type']) ? intval($_REQUEST['surplus_type']) : 0,
            'payment_id'   => isset($_REQUEST['payment_id'])   ? intval($_REQUEST['payment_id'])   : 0,
            'user_note'    => isset($_REQUEST['user_note'])    ? trim($_REQUEST['user_note'])      : '',
            'amount'       => $amount
    );
	
	if ($amount < 1.00)
	{
		$results['error'] =1;
		$results['message'] ='提现金额不得低于￥ 1.00';
		echo $json->encode($results);
		die();		
	}
	if ($amount > 200.00)
	{
		$results['error'] =1;
		$results['message'] ='提现金额不得高于￥ 200.00';
		echo $json->encode($results);
		die();		
	}    
	/* 判断是否有足够的余额的进行退款的操作 */
	$sur_amount = get_user_surplus($user_id);
	if ($amount > $sur_amount)
	{
		$results['error'] =1;
		$results['message'] ='余额不足';
		echo $json->encode($results);
		die();		
	}
	//插入会员账目明细
	$amount = '-'.$amount;
	$surplus['payment'] = '';
	$surplus['rec_id']  = insert_user_account($surplus, $amount);
	if ($surplus['rec_id'] > 0)
    {
		$results['error'] =0;
		$results['message'] ='提交成功';
		echo $json->encode($results);
		die();		
	}
	else
	{
		$results['error'] =1;
		$results['message'] ='提交失败';
		echo $json->encode($results);
		die();		
	}
}
elseif($action =='account_deposit')
{
    include_once(ROOT_PATH . 'includes/lib_clips.php');
	//获取剩余余额
    $surplus_amount = get_user_surplus($user_id);
    if (empty($surplus_amount))
    {
        $surplus_amount = 0;
    }
	//获取剩余积分
	$points = get_user_points($user_id);
	$results['points'] = $points;
	$results['surplus_amount'] = price_format($surplus_amount, false);
	$results['payment'] = get_online_payment_list(false);
	$results['error'] =0;
	echo $json->encode($results);
	die();		
	 //$_SESSION['user_id'] 
}
elseif($action =='account_deposit_act')
{
    include_once(ROOT_PATH . 'includes/lib_clips.php');
    include_once(ROOT_PATH . 'includes/lib_order.php');
    $amount = isset($_POST['amount']) ? floatval($_POST['amount']) : 0;
    if ($amount <= 0)
    {
		$results['error'] =1;
		$results['message'] ='提现金额要大于0';
		echo $json->encode($results);
		die();		
    }
    /* 变量初始化 */
    $surplus = array(
            'user_id'      => $user_id,
            'rec_id'       => !empty($_POST['rec_id'])      ? intval($_POST['rec_id'])       : 0,
            'process_type' => isset($_POST['surplus_type']) ? intval($_POST['surplus_type']) : 0,
            'payment_id'   => isset($_POST['payment_id'])   ? intval($_POST['payment_id'])   : 0,
            'user_note'    => isset($_POST['user_note'])    ? trim($_POST['user_note'])      : '',
            'amount'       => $amount
    );
	
	
        if ($surplus['payment_id'] <= 0)
        {
			$results['error'] =1;
			$results['message'] ='请选择支付方式';
			echo $json->encode($results);
			die();		
        }
        include_once(ROOT_PATH .'includes/lib_payment.php');
        //获取支付方式名称
        $payment_info = array();
        $payment_info = payment_info($surplus['payment_id']);
        $surplus['payment'] = $payment_info['pay_name'];
        if ($surplus['rec_id'] > 0)
        {
            //更新会员账目明细
            $surplus['rec_id'] = update_user_account($surplus);
        }
        else
        {
            //插入会员账目明细
            $surplus['rec_id'] = insert_user_account($surplus, $amount);
        }
        //取得支付信息，生成支付代码
        $payment = unserialize_config($payment_info['pay_config']);
        //生成伪订单号, 不足的时候补0
        $order = array();
        $order['order_sn']       = $surplus['rec_id'];
        $order['user_name']      = $_SESSION['user_name'];
        $order['surplus_amount'] = $amount;
        //计算支付手续费用
        $payment_info['pay_fee'] = pay_fee($surplus['payment_id'], $order['surplus_amount'], 0);
        //计算此次预付款需要支付的总金额
        $order['order_amount']   = $amount + $payment_info['pay_fee'];
        //记录支付log
        $order['log_id'] = insert_pay_log($surplus['rec_id'], $order['order_amount'], $type=PAY_SURPLUS, 0);
        /* 调用相应的支付方式文件 */
        include_once(ROOT_PATH . 'includes/modules/payment/' . $payment_info['pay_code'] . '.php');
        /* 取得在线支付方式的支付按钮 */
        $pay_obj = new $payment_info['pay_code'];
        $payment_info['pay_button'] = $pay_obj->get_code($order, $payment);
        /* 模板赋值 */
        
		$results['error'] =0;
		$results['message'] ='提交成功';
		echo $json->encode($results);
		die();		
	
	
	
}
elseif($action =='fenxiao')
{
	$level = isset($_REQUEST['level']) ? intval($_REQUEST['level']) : 0;
    $smarty->assign('level', $level);
	$page = isset($_REQUEST['page']) ? intval($_REQUEST['page']) : 1;
	$page = $page > 0 ? $page : 1;
	$fenxiao = getMoneyList($user_id,$page,$level);
    $smarty->assign('fenxiao', $fenxiao);
    $record_count = getMoneyListCount($user_id,$level);
	$pager  = get_pager('user.php', array('act' => $action,'level' => $level), $record_count, $page);
	$amount = getMoneyAmount($user_id);
    $smarty->assign('amount', $amount);
	$info = getPidInfo($user_id);
    $smarty->assign('root', $_SERVER['HTTP_HOST']);
	$level1_nums = getFollowsNum($user_id,1);
	$level2_nums = getFollowsNum($user_id,2);
	$level3_nums = getFollowsNum($user_id,3);
	$all_nums = $level1_nums + $level2_nums + $level3_nums;
	$checkedAmount    = price_format(getMoneyAmount($user_id,1));
	$notCheckedAmount = price_format(getMoneyAmount($user_id,0));
	$results['info'] = getPidInfo($user_id);
	$results['all_nums'] = $all_nums;
	$results['level1_nums'] = $level1_nums;
	$results['level2_nums'] = $level2_nums;
	$results['level3_nums'] = $level3_nums;
	$results['record_count'] = $record_count;
	$results['checkedAmount'] = $checkedAmount;
	echo $json->encode($results);
	die();		
}
elseif($action =='level')
{
	$level = isset($_REQUEST['level']) ? intval($_REQUEST['level']) : 0;
    $smarty->assign('level', $level);
	$page = isset($_REQUEST['page']) ? intval($_REQUEST['page']) : 1;
	$page = $page > 0 ? $page : 1;
	$follows = getFollows($user_id,$level,$page);
	$results['follows'] = $follows;
	echo $json->encode($results);
	die();		
	
}
elseif($action =='money')
{
	$checked = isset($_REQUEST['checked']) ? intval($_REQUEST['checked']) : '';
   
	$uid = isset($_REQUEST['uid']) ? intval($_REQUEST['uid']) : 0;
   
	$page = isset($_REQUEST['page']) ? intval($_REQUEST['page']) : 1;
	$page = $page > 0 ? $page : 1;
	$moneyList = getMoneyList($user_id,$page,$level,$checked,$uid);
    $record_count = getMoneyListCount($user_id,$level,$checked,$uid);
	$results['moneyList'] = $moneyList;
	echo $json->encode($results);
}
elseif($action =='suggestion')
{
	$results['list'] =get_suggestion();
	echo $json->encode($results);
}
elseif($action =='suggestion_content')
{
	$article_id = $_REQUEST['id'];
	$article = get_article_info($article_id);
	
	$results['article'] =$article;
	echo $json->encode($results);
}
elseif($action =='create_comment')
{
	
    $content      = trim($_REQUEST['comment']);
    $comment_rank = intval($_REQUEST['stars']);
    $id_value     = intval($_REQUEST['id_value']);
    $add_time     = gmtime();
    $ip_address   = real_ip();
    $order_id     = intval($_REQUEST['order_id']);
    $user_name    = $db->getOne("select user_name from ".$hhs->table('users')." where user_id='$user_id'");

    $sql = "select comment_id from ".$hhs->table('comment')." where user_id = '".$user_id."' and order_id = '".$order_id."' ";
    $comment_id = $db->getOne($sql);
    if ($comment_id) {
        $res = array(
            'isError' => 1,
            'message' => '已评论过了！'
        );
        echo json_encode($res);
        exit();
    }
    
    $sql = "insert into ".$hhs->table('comment')." (`user_name`,`user_id`,`content`,`comment_rank`,`id_value`,`add_time`,`ip_address`,`order_id`) values ('$user_name','$user_id','$content','$comment_rank','$id_value','$add_time','$ip_address','$order_id')";
    $db->query($sql);
    $id = $db->insert_id();
    if ($id) {
    	$db->query('update '.$hhs->table('order_info').' set `is_comm` = 1 where `order_id` = "'.$order_id.'"');
    	$res = array(
    		'isError' => 0,
			'message' => '评论成功！'
    	);
    }
    else{
    	$res = array(
    		'isError' => 2,
    		'message' => '评论失败，请重试！'
    	);
    }
    echo json_encode($res);
    exit();	
}
elseif($action =='update_username')
{
	$user_id = $_REQUEST['user_id'];
	$uname = $_REQUEST['uname'];
	$sql = $db->query("update ".$hhs->table('users')."  set uname='$uname' where user_id='$user_id'");
	if($sql)
	{
		$results['error'] =0;
		$results['message'] ='编辑成功';
		echo $json->encode($results);
		die();		
	}
	else
	{
		$results['error'] =1;
		$results['message'] ='编辑失败';
		echo $json->encode($results);
		die();		
	}
	
}
elseif($action =='create_square')
{
    $square   = trim($_REQUEST['square']);
    if(empty($square)){
        $res = array(
            'error' => 1,
            'message' => '评论内容不能为空！'
        );
        echo json_encode($res);
        exit();
    }
    $order_id = intval($_REQUEST['order_id']);
    $user_id  = $_REQUEST['user_id'];

    $sql = "update ".$hhs->table('order_info')." set `square` = '".$square."' where user_id = '".$user_id."' and `order_id` = '".$order_id."'";
    $db->query($sql);
    
    $res = array(
        'error' => 0,
		'message' => '发布成功！'
    );
    echo json_encode($res);
    exit();
	
}

function get_suggestion()
{
   
    $sql = 'SELECT article_id, title' .
               ' FROM ' .$GLOBALS['hhs']->table('article') .
               ' WHERE is_open = 1 AND cat_id = 23 ' .
               ' ORDER BY article_id DESC';
	$res = $GLOBALS['db']->getAll($sql);
    return $res;
}

/**
 *  给指定用户添加一个指定优惠劵
 *
 * @access  public
 * @param   int         $user_id        用户ID
 * @param   string      $bouns_sn       优惠劵序列号
 *
 * @return  boolen      $result
 */
function app_add_bonus($user_id, $bouns_sn)
{
    if (empty($user_id))
    {

        return 1;//请登录
    }

    /* 查询优惠劵序列号是否已经存在 */
    $sql = "SELECT bonus_id, bonus_sn, user_id, bonus_type_id FROM " .$GLOBALS['hhs']->table('user_bonus') .
           " WHERE bonus_sn = '$bouns_sn'";
    $row = $GLOBALS['db']->getRow($sql);
    if ($row)
    {
        if ($row['user_id'] == 0)
        {
            //优惠劵没有被使用
            $sql = "SELECT send_end_date, use_end_date ".
                   " FROM " . $GLOBALS['hhs']->table('bonus_type') .
                   " WHERE type_id = '" . $row['bonus_type_id'] . "'";

            $bonus_time = $GLOBALS['db']->getRow($sql);

            $now = gmtime();
            if ($now > $bonus_time['use_end_date'])
            {
              
                return 2;
            }

            $sql = "UPDATE " .$GLOBALS['hhs']->table('user_bonus') . " SET user_id = '$user_id' ".
                   "WHERE bonus_id = '$row[bonus_id]'";
            $result = $GLOBALS['db'] ->query($sql);
            if ($result)
            {
                 return 3;
            }
            else
            {
                return 4;
            }
        }
        else
        {
            if ($row['user_id']== $user_id)
            {
                //优惠劵已经添加过了。
                $error = 5;
            }
            else
            {
                //优惠劵被其他人使用过了。
               $error = 6;
            }

            return $error;
        }
    }
    else
    {
        //优惠劵不存在
        
        return 7;
    }

}


function get_collection_goods_app($user_id)

{

    $sql = 'SELECT g.goods_id, g.goods_name, g.goods_thumb, g.market_price, g.shop_price AS org_price, '.


                'g.promote_price,g.shop_price, g.promote_start_date,g.promote_end_date, c.rec_id, c.is_attention' .

            ' FROM ' . $GLOBALS['hhs']->table('collect_goods') . ' AS c' .

            " LEFT JOIN " . $GLOBALS['hhs']->table('goods') . " AS g ".

                "ON g.goods_id = c.goods_id ".

            " LEFT JOIN " . $GLOBALS['hhs']->table('member_price') . " AS mp ".

                "ON mp.goods_id = g.goods_id AND mp.user_rank = '$_SESSION[user_rank]' ".

            " WHERE c.user_id = '$user_id' ORDER BY c.rec_id DESC";

    $res = $GLOBALS['db'] -> query($sql);



    $goods_list = array();
	$i=0;

    while ($row = $GLOBALS['db']->fetchRow($res))

    {

        if ($row['promote_price'] > 0)

        {

            $promote_price = bargain_price($row['promote_price'], $row['promote_start_date'], $row['promote_end_date']);

        }

        else

        {

            $promote_price = 0;

        }



        $goods_list[$i]['rec_id']        = $row['rec_id'];

        $goods_list[$i]['is_attention']  = $row['is_attention'];

        $goods_list[$i]['goods_id']      = $row['goods_id'];

        $goods_list[$i]['goods_name']    = $row['goods_name'];
		$goods_list[$i]['goods_thumb']    = $row['goods_thumb'];
		

        $goods_list[$i]['market_price']  = price_format($row['market_price']);

        $goods_list[$i]['shop_price']    = price_format($row['shop_price']);

        $goods_list[$i]['promote_price'] = ($promote_price > 0) ? price_format($promote_price) : '';

        $goods_list[$i]['url']           = build_uri('goods', array('gid'=>$row['goods_id']), $row['goods_name']);
		$i++;

    }



    return $goods_list;

}
function app_get_account_log($user_id)
{

    $account_log = array();
    $sql = 'SELECT * FROM ' .$GLOBALS['hhs']->table('user_account').
           " WHERE user_id = '$user_id'" .
           " AND process_type " . db_create_in(array(SURPLUS_SAVE, SURPLUS_RETURN)) .
           " ORDER BY add_time DESC";
    $res = $GLOBALS['db']->query($sql);
    if ($res)
    {
        while ($rows = $GLOBALS['db']->fetchRow($res))
        {
            $rows['add_time']         = local_date($GLOBALS['_CFG']['date_format'], $rows['add_time']);
            $rows['admin_note']       = nl2br(htmlspecialchars($rows['admin_note']));
            $rows['short_admin_note'] = ($rows['admin_note'] > '') ? sub_str($rows['admin_note'], 30) : 'N/A';
            $rows['user_note']        = nl2br(htmlspecialchars($rows['user_note']));
            $rows['short_user_note']  = ($rows['user_note'] > '') ? sub_str($rows['user_note'], 30) : 'N/A';
            $rows['pay_status']       = ($rows['is_paid'] == 0) ? '未确认': '已确认';
            $rows['amount']           = price_format(abs($rows['amount']), false);
            /* 会员的操作类型： 冲值，提现 */
            if ($rows['process_type'] == 0)
            {
                $rows['type'] = '充值';
            }
            else
            {
                $rows['type'] = '提现';
            }
            /* 支付方式的ID */

            $sql = 'SELECT pay_id FROM ' .$GLOBALS['hhs']->table('payment').
                   " WHERE pay_name = '$rows[payment]' AND enabled = 1";
            $pid = $GLOBALS['db']->getOne($sql);
            /* 如果是预付款而且还没有付款, 允许付款 */
            if (($rows['is_paid'] == 0) && ($rows['process_type'] == 0))
            {
                $rows['handle'] = '<a href="user.php?act=pay&id='.$rows['id'].'&pid='.$pid.'">'.$GLOBALS['_LANG']['pay'].'</a>';
            }
            $account_log[] = $rows;
        }
        return $account_log;
    }
    else
    {
         return false;
    }

}
/**
 * 删除一个收货地址
 *
 * @access  public
 * @param   integer $id
 * @return  boolean
 */
function app_drop_consignee($id,$user_id)
{
    $sql = "SELECT user_id FROM " .$GLOBALS['hhs']->table('user_address') . " WHERE address_id = '$id'";
    $uid = $GLOBALS['db']->getOne($sql);

    if ($uid != $user_id)
    {
        return false;
    }
    else
    {
        $sql = "DELETE FROM " .$GLOBALS['hhs']->table('user_address') . " WHERE address_id = '$id'";
        $res = $GLOBALS['db']->query($sql);
        //设置默认的地址
       
		$sql="select address_id from ".$GLOBALS['hhs']->table('users')." where user_id=".$user_id;
		$address_id=$GLOBALS['db']->getOne($sql);
		if($address_id==$id){
			$sql = "SELECT address_id FROM " .$GLOBALS['hhs']->table('user_address')." where user_id=".$user_id ;
    		$r = $GLOBALS['db']->getAll($sql);
    		if(!empty($r)){
    			$default_address=$r[0]['address_id'];
    			$sql = "update " .$GLOBALS['hhs']->table('users')." set address_id=".$default_address." where user_id=".$user_id;
    			$GLOBALS['db']->query($sql);
    		}
		} /**/
        return $res;
    }
}

?>