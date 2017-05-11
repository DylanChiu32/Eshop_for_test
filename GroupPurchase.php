<?php
define('IN_HHS', true);
require(dirname(__FILE__) . '/includes/init.php');
$goods_id=$_REQUEST['goods_id'];

$act = isset($_REQUEST['act']) ? trim($_REQUEST['act']) : 'default';
	

if ($act=='default'){
    
	$smarty->assign('goods_id', $goods_id);
	$sql="select * from ".$hhs->table('users')." where user_id=".$_SESSION['user_id'];
	$user_info=$db->getRow($sql);
	
	$smarty->assign('appid', $appid);
	$timestamp=time();
	$smarty->assign('timestamp', $timestamp );
	$class_weixin=new class_weixin($appid,$appsecret);
	$signature=$class_weixin->getSignature($timestamp);
	$smarty->assign('signature', $signature);

	$loading=$smarty->fetch('loading.html');
	$smarty->assign('loading',    $loading);
	
	$xaphp_sopenid=$_SESSION['xaphp_sopenid'];
	//$myLat=$_COOKIE['lat'];
	//$myLng=$_COOKIE['lng'];
	
	$sql="select * from ".$hhs->table("users")." where openid='$xaphp_sopenid' ";
	$weixin_user=$db->getRow($sql);
	$myLat = $weixin_user['lat'];
	$myLng = $weixin_user['lng'];/**/
	
	//以下为核心代码
	$_CFG['group_purchase']=empty($_CFG['group_purchase'])?15:$_CFG['group_purchase'];
	$range = 180 / pi() * floatval($_CFG['group_purchase']) / 6372.797;     //里面的 1 就代表搜索 1km 之内，单位km
	$lngR = $range / cos($myLat * pi() / 180);
	$maxLat = $myLat + $range;//最大纬度
	$minLat = $myLat - $range;//最小纬度
	$maxLng = $myLng + $lngR;//最大经度
	$minLng = $myLng - $lngR;//最小经度
	$sql="select * from ".$hhs->table("order_info")." where team_first=1 and team_status=1 and extension_code='team_goods' and extension_id='$goods_id' and lat>'$minLat' and lat<'$maxLat' and lng>'$minLng' and lng<'$maxLng' and lat>0 ";
	$group_list=$db->getAll($sql);
	foreach($group_list as $k=>$v){
	    $sql="select goods_name from ".$hhs->table("goods")." where goods_id=".$v['extension_id'];
	    $group_list[$k]['goods_name']=$db->getOne($sql);
	    $sql="select * from ".$hhs->table('users')." where user_id=".$v['user_id'];
	    $group_user=$db->getRow($sql);
	    $group_list[$k]['user_name']=$group_user['user_name'];
	    $group_list[$k]['headimgurl']=$group_user['headimgurl'];
	    $group_list[$k]['progress']=$v['teammen_num']/$v['team_num']*100;
	}
	$smarty->assign('group_list', $group_list );
	$group_list_str=$smarty->fetch('library/GroupPurchase.lbi' );
	$smarty->assign('group_list_str', $group_list_str );
	$smarty->display('GroupPurchase.dwt');
	
}else if($act=='get_group'){
	include_once('includes/cls_json.php');
	$json = new JSON();
	$result = array('error' => 0,'message'=>'', 'content' => '');
	
	$myLat = $_REQUEST['myLat'];
	$myLng = $_REQUEST['myLng'];

	//以下为核心代码
	$range = 180 / pi() * floatval($_CFG['group_purchase']) / 6372.797;     //里面的 1 就代表搜索 1km 之内，单位km
	$lngR = $range / cos($myLat * pi() / 180);
	$maxLat = $myLat + $range;//最大纬度
	$minLat = $myLat - $range;//最小纬度
	$maxLng = $myLng + $lngR;//最大经度
	$minLng = $myLng - $lngR;//最小经度
	
	
	//echo $maxLat.'==='.$minLat."<br>".$maxLng."===".$minLng;
	$sql="select * from ".$hhs->table("order_info")." where team_first=1 and team_status=1 and extension_code='team_goods' and extension_id='$goods_id' and lat>'$minLat' and lat<'$maxLat' and lng>'$minLng' and lng<'$maxLng' ";
	$group_list=$db->getAll($sql);
	
	//if(!empty($group_list)){
		foreach($group_list as $k=>$v){
			$sql="select goods_name from ".$hhs->table("goods")." where goods_id=".$v['extension_id'];
			$group_list[$k]['goods_name']=$db->getOne($sql);
			$sql="select * from ".$hhs->table('users')." where user_id=".$v['user_id'];
			$group_user=$db->getRow($sql);
			$group_list[$k]['user_name']=$group_user['user_name'];
			$group_list[$k]['headimgurl']=$group_user['headimgurl'];
			$group_list[$k]['progress']=$v['teammen_num']/$v['team_num']*100;
		}
		$smarty->assign('group_list', $group_list );
		$result['content']=$smarty->fetch('library/GroupPurchase.lbi' );

	//}
	/*
	else{
		$result['error']=1;
		$result['message']="附近没有团";
	}*/
	die($json->encode($result));
}

?>