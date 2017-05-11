<?php
define('IN_HHS', true);

$suppliers_id = isset($_REQUEST['id']) ? intval($_REQUEST['id']) : 0;

 $stores_info = get_suppliers_info($suppliers_id);
$sql = "SELECT count(*) FROM ".$hhs->table('goods')." as g WHERE is_on_sale = 1 AND is_alone_sale = 1 AND is_delete = 0 and  `suppliers_id` = " . $suppliers_id;
$stores_info['goods_num'] = $db->getOne($sql);
$sql = "SELECT sum(`sales_num`) FROM ".$hhs->table('goods')." as g WHERE `suppliers_id` = " .$suppliers_id . $where;
$stores_info['sales_num'] = $db->getOne($sql);
$sql = "SELECT count(*) FROM  ".$hhs->table('order_goods')." as o,".$hhs->table('goods')." as g WHERE g.`goods_id` = o.`goods_id` and g.`suppliers_id` = " .$suppliers_id;
$stores_info['sales_num'] += $db->getOne($sql);

$stores_info['supp_logo'] = $redirect_uri.$stores_info['supp_logo'];

$store_info['store_info'] = $stores_info;

//店铺广告
$sql = "select * from ".$hhs->table('supp_photo')." where is_check = 1 AND supp_id = ".$suppliers_id;
$supp_photo = $db->getAll($sql);
foreach($supp_photo as $idx=>$v)
{
	
	$supp_photo[$idx]['photo_file'] = $redirect_uri.$v['photo_file'];
}
$store_info['supp_photo'] = $supp_photo;

$results['content'] = $store_info;
echo $json->encode($results);
die();

function getSuppliers($suppliers_id){
    $sql = 'SELECT `suppliers_name` ,`user_id`,`supp_logo` '.
            'FROM ' . $GLOBALS['hhs']->table('suppliers') . 
            "WHERE `suppliers_id` = " . $suppliers_id;
    return $GLOBALS['db']->getRow($sql);
}

?>