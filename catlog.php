<?php

/**
 * 集果轩电商 商品分类
 * ============================================================================ * * 版权所有 2012-2014 索电旗下集果轩。
 * 网站地址: http://www.satsd.com；
 * ----------------------------------------------------------------------------
 * 这不是一个自由软件！您只能在不用于商业目的的前提下对程序代码进行修改和
 * 使用；不允许对程序代码以任何形式任何目的的再发布。
 * ============================================================================
 * $Author: pangbin $
 * $Id: category.php 17217 2014-05-12 06:29:08Z pangbin $
*/

define('IN_HHS', true);

require(dirname(__FILE__) . '/includes/init.php');
require_once(dirname(__FILE__) . '/includes/lib_fenxiao.php');

if ((DEBUG_MODE & 2) != 2)
{
    $smarty->caching = false;
}
$cat_id = isset($_REQUEST['cid']) ? intval($_REQUEST['cid']) : 0;
$type  = isset($_REQUEST['type']) ? trim($_REQUEST['type']) : '';
$page  = isset($_REQUEST['page']) ? intval($_REQUEST['page']) : 1;
$page  = $page > 0 ? $page : 1;
$sort  = isset($_REQUEST['sort']) ? trim($_REQUEST['sort']) : 'sort_order';
 
$size = isset($_CFG['page_size'])  && intval($_CFG['page_size']) > 0 ? intval($_CFG['page_size']) : 10;
$order = '';

    $smarty->assign('cat_id',      $cat_id);    // 分类
    $smarty->assign('sort',      $sort);    // 排序
	$smarty->assign('type',      $type); 
    $smarty->assign('page_title',      '商品分类');    // 页面标题

    $smarty->assign('categories',      get_categories_tree());

    $children = get_children($cat_id);
    $count = get_mall_goods_count($children, $type);
	
    $max_page = ($count> 0) ? ceil($count / $size) : 1;
    if ($page > $max_page)
    {
        $page = $max_page;
    }
	
    $goodslist = get_mall_goods($children, $type, $size, $page, $sort, $order);

    $smarty->assign('goods_list',       $goodslist);
	
    assign_pager('catlog',$cat_id, $count, $size, $sort, $order, $page, '', '', $type); // 分页

    $info = getPidInfo($_SESSION['user_id']);


    $link= $hhs->url().substr($_SERVER[SCRIPT_NAME], 1).'?uid='.$uid;
    $smarty->assign('link', $link );
    $smarty->assign('link2', urlencode($link) );
	
	
	$smarty->assign('appid', $appid);
	$timestamp=time();
	$smarty->assign('timestamp', $timestamp );
	$class_weixin=new class_weixin($appid,$appsecret);
	$signature=$class_weixin->getSignature($timestamp);
	$smarty->assign('signature', $signature);
	$smarty->assign('imgUrl', 'http://'.$_SERVER['HTTP_HOST'].'/themes/'.$_CFG['template'].'/images/logo.gif');
	$smarty->assign('title', $_CFG['mall_title']);
	$smarty->assign('desc', mb_substr($_CFG['mall_desc'], 0,30,'utf-8')  );
	
	


    $smarty->display('catlog.dwt');


/**
 * 获取数量
 * @param  [type] $cat_id [description]
 * @return [type]         [description]
 */
function get_mall_goods_count($cat_id, $type){
    $where   = "g.is_on_sale = 1 AND g.is_alone_sale = 1 AND g.is_delete = 0 ";
	if($type == 'mail')
	{
		$where  .= "AND g.is_mall = 1 and g.is_luck = 0 and g.is_miao = 0 and g.is_fresh = 0 and g.is_zero = 0";
	}
	elseif($type == 'team')
	{
		$where  .= "AND g.is_team = 1 and g.is_luck = 0 and g.is_miao = 0 and g.is_fresh = 0 and g.is_zero = 0";
	}
	elseif($type == 'luck')
	{
		$where  .= "AND g.is_luck = 1 and g.is_miao = 0 and g.is_fresh = 0 and g.is_zero = 0";
	}
	elseif($type == 'miao')
	{
		$where  .= "AND g.is_luck = 0 and g.is_miao = 1 and g.is_fresh = 0 and g.is_zero = 0";
	}
	elseif($type == 'zero')
	{
		$where  .= "AND g.is_luck = 0 and g.is_miao = 0 and g.is_fresh = 0 and g.is_zero = 1";
	}
	$where  .= " and $cat_id";
    //获得区域级别
    $current_region_type=get_region_type($_SESSION['site_id']); 
    if($current_region_type<=2){
         $where.=" and (g.city_id='".$_SESSION['site_id'] . "' or g.city_id=1) ";
    }elseif($current_region_type==3){
        $where.=" and (g.district_id='".$_SESSION['site_id'] . "' or g.city_id=1) ";
    }

    //$sql     = "select count(*) FROM ".$GLOBALS['hhs']->table('goods')." as g WHERE " . $where;
	$sql     = "select count(*) FROM ".$GLOBALS['hhs']->table('goods')." as g " . 
	'LEFT JOIN ' . $GLOBALS['hhs']->table('category') . ' AS c ON c.cat_id = g.cat_id WHERE ' .
	$where;
    return $GLOBALS['db']->getOne($sql);    
}

/**
 * 获取商品
 * @param  [type] $cat_id [description]
 * @param  [type] $size   [description]
 * @param  [type] $page   [description]
 * @param  [type] $sort   [description]
 * @param  [type] $order  [description]
 * @return [type]         [description]
 */
function get_mall_goods($cat_id, $type, $size, $page, $sort, $order){
    $where   = "g.is_on_sale = 1 AND g.is_alone_sale = 1 AND g.is_delete = 0 ";
	if($type == 'mail')
	{
		$where  .= "AND g.is_mall = 1 and g.is_luck = 0 and g.is_miao = 0 and g.is_fresh = 0 and g.is_zero = 0";
	}
	elseif($type == 'team')
	{
		$where  .= "AND g.is_team = 1 and g.is_luck = 0 and g.is_miao = 0 and g.is_fresh = 0 and g.is_zero = 0";
	}
	elseif($type == 'luck')
	{
		$where  .= "AND g.is_luck = 1 and g.is_miao = 0 and g.is_fresh = 0 and g.is_zero = 0";
	}
	elseif($type == 'miao')
	{
		$where  .= "AND g.is_luck = 0 and g.is_miao = 1 and g.is_fresh = 0 and g.is_zero = 0";
	}
	elseif($type == 'zero')
	{
		$where  .= "AND g.is_luck = 0 and g.is_miao = 0 and g.is_fresh = 0 and g.is_zero = 1";
	}
	$where  .= " and $cat_id";
    //获得区域级别
    $current_region_type=get_region_type($_SESSION['site_id']); 
    if($current_region_type<=2){
         $where.=" and (g.city_id='".$_SESSION['site_id'] . "' or g.city_id=1) ";
    }elseif($current_region_type==3){
        $where.=" and (g.district_id='".$_SESSION['site_id'] . "' or g.city_id=1) ";
    }

    $skip     = ($page - 1) * $size;

    $limit = " limit " . $skip . "," . $size;

    $sql = 'SELECT g.is_mall,g.is_team,g.is_luck,g.is_miao,g.is_zero,g.goods_id, g.goods_name, g.goods_number, g.suppliers_id, g.goods_name_style, g.market_price, g.shop_price , ' .
                'g.promote_start_date, g.promote_end_date, g.goods_brief, g.goods_thumb , g.goods_img,g.little_img ' .
            ' ,g.team_num,g.team_price '.
            'FROM ' . $GLOBALS['hhs']->table('goods') . ' AS g ' .
			'LEFT JOIN ' . $GLOBALS['hhs']->table('category') . ' AS c ON c.cat_id = g.cat_id ' .
            "WHERE $where ORDER BY g.`".$sort."`, g.goods_id DESC" . $limit;
    $res = $GLOBALS['db']->getAll($sql);

    $arr = array();
    foreach ($res AS $idx => $row)
    {
        $arr[$idx]['goods_id']      = $row['goods_id'];
        $arr[$idx]['goods_name']    = $row['goods_name'];
        $arr[$idx]['goods_brief']   = $row['goods_brief'];
        $arr[$idx]['goods_number']  = $row['goods_number'];
        
        $arr[$idx]['market_price']  = price_format($row['market_price'],false);
        $arr[$idx]['shop_price']    = price_format($row['shop_price'],false);
        
        $arr[$idx]['goods_thumb']   = get_image_path($row['goods_id'], $row['goods_thumb'], true);
        $arr[$idx]['goods_img']     = get_image_path($row['goods_id'], $row['goods_img']);
        $arr[$idx]['url']           = build_uri('goods', array('gid'=>$row['goods_id']), $row['goods_name']);
        $arr[$idx]['team_num']      = $row['team_num'];
        $arr[$idx]['team_price']    = price_format($row['team_price'],false);
        $arr[$idx]['team_discount'] = number_format($row['team_price']/$row['market_price']*10,1);
        $arr[$idx]['little_img']    = $row['little_img'];
		
		$arr[$idx]['is_mall']    = $row['is_mall'];
		$arr[$idx]['is_team']    = $row['is_team'];
		$arr[$idx]['is_luck']    = $row['is_luck'];
		$arr[$idx]['is_miao']    = $row['is_miao'];
		$arr[$idx]['is_zero']    = $row['is_zero'];
		
		$arr[$idx]['attr']    = get_goods_attr($row['goods_id']);
        unset($row);
    }

    return $arr;
}


?>
