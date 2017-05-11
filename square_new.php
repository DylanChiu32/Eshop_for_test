<?php
define('IN_HHS', true);
require(dirname(__FILE__) . '/includes/init.php');

$act = trim($_GET['act']);
if ($act == 'create') {
    $square   = trim($_POST['square']);
    if(empty($square)){
        $res = array(
            'isError' => 1,
            'message' => '评论内容不能为空！'
        );
        echo json_encode($res);
        exit();
    }
    $order_id = intval($_POST['order_id']);
    $user_id  = $_SESSION['user_id'];
	$goods_id = $_POST['goods_id'];
    $sql = "update ".$hhs->table('order_info')." set `square` = '".$square."' where user_id = '".$user_id."' and `order_id` = '".$order_id."'";
    $db->query($sql);
    $insert_square_sql =  "INSERT INTO ".$GLOBALS['hhs']->table('square_mes')." ( order_id,goods_id,square_add_time) VALUES (".$order_id.",".$goods_id.",".gmtime().")";
    $db->query($insert_square_sql);
    $res = array(
        'isError' => 0
    );
    echo json_encode($res);
    exit();
}
if($act == 'zan'){
	$goods_id  =$_POST['goods_id'];
	$order_id = $_POST['order_id'];
	$user_id = $_SESSION['user_id'];
	
	$select_zan_log = "select id from ".$GLOBALS['hhs']->table('goods_zan_log')." where goods_id = ".$goods_id." AND user_id = ".$user_id." AND order_id = ".$order_id;
	$row = $GLOBALS['db']->getAll($select_zan_log);
	  if($row){
		$res = array(
			'isError' => 2,
		);
		echo json_encode($res);
		exit();
	}  
	
	$zan_log_sql = "INSERT INTO ".$GLOBALS['hhs']->table('goods_zan_log')." (goods_id,user_id,order_id) VALUES (".$goods_id.",".$user_id.",".$order_id.")";
	$db->query($zan_log_sql);
	
	$update_sql = "UPDATE ".$GLOBALS['hhs']->table('square_mes')." set zan_num = zan_num+1 where order_id = ".$order_id." AND goods_id = ".$goods_id;
	$db->query($update_sql);
	
	$zan_num = "select zan_num from".$GLOBALS['hhs']->table('square_mes')."where order_id = ".$order_id." AND goods_id = ".$goods_id;
	$num = $GLOBALS['db']->getOne($zan_num);
	
	$res = array(
        	'zan_num'=>$num,
			'isError' => 0
    );
    echo json_encode($res);
    exit();
	
}
/**
 * 公告赞
 * 
 */
if($act == 'announcement_zan'){
	
	$id = $_POST['id'];
	$user_id = $_SESSION['user_id'];
	$sql = "select id from ".$GLOBALS['hhs']->table('announcement')." where zan_user_id = ".$user_id. " and id = ".$id;
	$user = $GLOBALS['db']->getOne($sql);
	if($user){
		$res = array(
				'isError' => 2
		);
		echo json_encode($res);
		exit();
	}
	$zan_sql = "update ".$GLOBALS['hhs']->table('announcement')." set zan_num = zan_num+1 , zan_user_id = ".$user_id." where id = ".$id;
	$db->query($zan_sql);
	$zan_num_sql = "select zan_num from ".$GLOBALS['hhs']->table('announcement')." where id = ".$id;
	$zan_num = $GLOBALS['db']->getOne($zan_num_sql);

	$res = array(
			'zan_num'=>$zan_num,
			'isError' => 0
	);
	echo json_encode($res);
	exit();
}


/* 缓存编号 */
 $cache_id = sprintf('%X', crc32($_SESSION['user_rank'] . '-' . $_CFG['lang']));

    assign_template();

    $position = assign_ur_here();
    $smarty->assign('page_title',      $position['title']);    // 页面标题
    $smarty->assign('ur_here',         $position['ur_here']);  // 当前位置
    $smarty->assign('categories',      get_categories_tree()); // 分类树 
	$smarty->assign('action',     $action);
	$smarty->assign('announcement',get_announcement());

	$loading=$smarty->fetch('loading.html');
	$smarty->assign('loading',    $loading);
    $keywords = isset($_GET['keywords']) ? trim($_GET['keywords']) : '';

    $smarty->assign('keywords',    $keywords);
	$smarty->assign('goods_list',    get_goodslist('best'));
		
	$link="http://" . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'].'?uid='.$uid;//"/index.php";
    $smarty->assign('link', $link );
    $smarty->assign('link2', urlencode($link) );
	
	
	$smarty->assign('appid', $appid);
	$timestamp=time();
	$smarty->assign('timestamp', $timestamp );
	$class_weixin=new class_weixin($appid,$appsecret);
	$signature=$class_weixin->getSignature($timestamp);
	$smarty->assign('signature', $signature);
	$smarty->assign('imgUrl', 'http://'.$_SERVER['HTTP_HOST'].'/themes/'.$_CFG['template'].'/images/logo.gif');
	$smarty->assign('title', $_CFG['square_title']);
	$smarty->assign('desc', mb_substr($_CFG['square_desc'], 0,30,'utf-8')  );
	$smarty->display('square_new.dwt'); 

if($_REQUEST['act'] == 'add_img_text'){
	$file = $_FILES['imgs'];
	$text = $_POST['text'];
	$name = $file['name'];
	$user_id = $_SESSION['user_id'];
	$phone_sql = "select value from ".$GLOBALS['hhs']->table('shop_config')." where code = 'service_phone'";
	$phone = $GLOBALS['db']->getOne($phone_sql);
	//判断图片大小是否超过5M
	foreach ($file['size'] as $v){
		$max_size = '5242880';
		if($v > $max_size){
			$message = '您提交的图片太大啦！';
			$smarty->assign('phone',$phone);
			$smarty->assign('message',$message);
			$smarty->display('square_explain.htm');
			exit();
		}
	}
	//创建文件夹
	$datedir = date('Ymd',time());
	$filepath = 'images/squarefile/'.$datedir.'/';
	if (! file_exists ( $filepath )) {
		mkdir ( "$filepath", 0777, true );
	}
	
	//压缩图片文件夹
	$uploaddir_resize="images/square_upfiles_resize/".$datedir."/";
	if (! file_exists ( $uploaddir_resize )) {
		mkdir ( "$uploaddir_resize", 0777, true );
	}
	
	foreach ($name as $v){
		$type = strtolower(substr($v,strrpos($v,'.')+1));
		$allow_type = array('jpg','jpeg','png');
		if(!in_array($type, $allow_type)){
			$message = '您上传的图片格式不正确！请重新上传！';
			$smarty->assign('phone',$phone);
			$smarty->assign('message',$message);
			$smarty->display('square_explain.htm');
			exit();
		}
	}
	foreach ($file['tmp_name'] as $k=>$v){
		foreach ($name as $key=>$vv){
			if($k == $key){
				$type = strtolower(substr($vv,strrpos($vv,'.')+1));
				$vv=random(10).'.'.$type;
				$uploadfile=$filepath.$vv;
				 if(!move_uploaded_file($v,$uploadfile)){
				$message = '上传出错了，请重新发布！';
				$smarty->assign('phone',$phone);
				$smarty->assign('message',$message);
				$smarty->display('square_explain.htm');
				exit();
				}else{
					//压缩图片
					$size = filesize($uploadfile);
					$uploadfile_resize=$uploaddir_resize.$vv;
					if($type == "pjpeg"||$type == "jpg"|$type == "jpeg"){
						$im = imagecreatefromjpeg($uploadfile);
					}elseif($type == "png"){
						$im = imagecreatefrompng($uploadfile);
					}else{
						$im = imagecreatefromjpeg($uploadfile);
					}
					ResizeImage($im,0.5,$uploadfile_resize);
					ImageDestroy ($im);
					unlink($uploadfile);
				}
				$imgarr[] = $uploadfile_resize;
			}
		}
	}
	$imgarr = implode(',', $imgarr);
	$add_time = gmtime();
	$sql = "INSERT INTO ".$GLOBALS['hhs']->table('square_img_text')."(img,text,add_time,user_id) VALUES("."'".$imgarr."'".","."'".$text."'".",".$add_time.",".$user_id.")";
	$db->query($sql);
	/* $res = array(
			'isError' => 0,
			'message' => '发布成功！'
	);
	echo json_encode($res); */
}

function  d($arr){
	echo '<pre>';
	var_dump($arr);
	die;
}
function get_goodslist()
{
	global $hhs,$db;
    $keywords = isset($_GET['keywords']) ? trim($_GET['keywords']) : '';
    $orderby = isset($_GET['orderby']) ? trim($_GET['orderby']) : '';
	
    $where = " AND o.`square`<> '' ";
    if($orderby == 'j'){
        $where .= "AND sm.order_id = o.order_id AND sm.goods_id = og.goods_id AND sm.is_boutique = 1 ";
        $orderby= "sm.square_add_time desc";
    }elseif($orderby == 'p'){
    	$where .= "AND sm.order_id = o.order_id AND sm.goods_id = og.goods_id";
    	$orderby = "sm.comment_num  desc";
    }elseif ($orderby == 'z'){
    	$where .= "AND sm.order_id = o.order_id AND sm.goods_id = og.goods_id";
    	$orderby = "sm.zan_num desc";
    }else{
    	$orderby= "sm.square_add_time desc";
    }
    
    $sql = "select DISTINCT o.luckdraw_id,o.square,o.order_id, sm.is_boutique ,sm.square_add_time ,sm.square_add_time , o.team_sign,o.team_num,o.teammen_num,(team_num - teammen_num) as need, o.add_time,u.uname,u.headimgurl from "
    		.$hhs->table('order_info')." as o, "
    		.$hhs->table('users')." as u , "
    		.$hhs->table('square_mes')." as sm ,"
    		.$hhs->table('order_goods').
    		" as og  where o.order_id = og.order_id and o.show_square = 1 and o.user_id = u.user_id and sm.order_id = o.order_id and sm.goods_id = og.goods_id"
    		.$where." order by " . $orderby;
   
    $res = $GLOBALS['db']->getAll($sql);
  // d($sql);
	$user_id = $_SESSION['user_id'];
    $arr = array();
    foreach ($res AS $idx => $row)
    {
        $sql = "select g.is_on_sale,g.is_delete,g.goods_name,g.goods_id, g.goods_number, g.goods_thumb,g.little_img,g.goods_img, g.market_price, g.shop_price,g.team_price  from ".$hhs->table('order_goods')." as o,".$hhs->table('goods')." as g where g.`goods_id` = o.`goods_id` and o.`order_id` = '".$row['order_id']."'";
        $goods = $db->getRow($sql);
        $zan_num_sql = "select zan_num from".$GLOBALS['hhs']->table('square_mes')."where order_id = ".$row['order_id']." AND goods_id = ".$goods['goods_id'];
		$zan_num = $GLOBALS['db']->getOne($zan_num_sql);
        $user_iszan_sql = "select id from ".$GLOBALS['hhs']->table('goods_zan_log')." where user_id = ".$user_id." AND order_id = ".$row['order_id']." AND goods_id = ".$goods['goods_id'];
        $user_iszan = $db->getOne($user_iszan_sql);
        $comment_num_sql = "select count(*) from ".$GLOBALS['hhs']->table('square_comment')." where order_id = ".$row['order_id']." AND goods_id = ".$goods['goods_id'];
        $comment_num = $db->getOne($comment_num_sql);
		if($goods['is_on_sale'] == 1 && $goods['is_delete'] == 0)
		{
			$arr[$idx]['goods_id']   = $goods['goods_id'];
			$arr[$idx]['goods_name']   = $goods['goods_name'];
			$arr[$idx]['goods_number'] = $goods['goods_number'];
			$arr[$idx]['market_price'] = price_format($goods['market_price'],false);
			$arr[$idx]['shop_price']   = price_format($goods['shop_price'],false);
			$arr[$idx]['order_id'] = $row['order_id'];
			$arr[$idx]['goods_thumb'] = get_image_path($goods['goods_id'], $goods['goods_thumb'], true);
			$arr[$idx]['little_img']  = get_image_path($goods['goods_id'], $goods['little_img'], true);
			$arr[$idx]['goods_img']   = get_image_path($goods['goods_id'], $goods['goods_img']);
			$arr[$idx]['url']         = build_uri('goods', array('gid'=>$goods['goods_id']), $goods['goods_name']);
			$arr[$idx]['team_price']  = price_format($goods['team_price'],false);
			$arr[$idx]['team_num']    = $row['team_num'];
			$arr[$idx]['need']    = $row['team_num'] - $row['teammen_num'];
			$arr[$idx]['square']    = $row['square'];
			$arr[$idx]['team_id']    = $row['team_sign'];
			$arr[$idx]['uname']       = $row['uname'];
			$arr[$idx]['headimgurl']  = $row['headimgurl'];
			$arr[$idx]['add_time']    = local_date("Y-m-d H:i:s",$row['square_add_time']);
			$arr[$idx]['zan_num'] = $zan_num;
			$arr[$idx]['team_discount']    = @number_format($goods['team_price']/$goods['market_price']*10,1);
			$arr[$idx]['iszan'] = $user_iszan;
			$arr[$idx]['comment_num'] = $comment_num;
			$arr[$idx]['luckdraw_id'] = $row['luckdraw_id'];
			$arr[$idx]['is_boutique'] = $row['is_boutique'];
			$arr[$idx]['buy_nums']    = $db->getOne("select count(*) from ".$hhs->table('order_goods')." where goods_id = '".$goods['goods_id']."'");
			$arr[$idx]['uid']=$user_id;
	
			$arr[$idx]['gallery']   = $db->getAll("select thumb_url from ".$hhs->table('goods_gallery')." where goods_id = '".$goods['goods_id']."' limit 3");
	  	}
    }

    return $arr;
}

/**
 * 
 * 查询公告
 */
function get_announcement(){
	$user_id= $_SESSION['user_id'];
	$sql = "select * from ".$GLOBALS['hhs']->table('announcement')." where is_display = 1 order by add_time desc limit  3";
	$arr = $GLOBALS['db']->getAll($sql);
	
	foreach ($arr as $k =>$v){
		$iszan_sql = "select id from ".$GLOBALS['hhs']->table('announcement')." where zan_user_id = ".$user_id." AND id = ".$v['id'];
		$iszan = $GLOBALS['db']->getOne($iszan_sql);
		$arr[$k]['iszan'] = $iszan;
		$arr[$k]['add_time'] = local_date('Y-m-d H:i:s',$v['add_time']);
	}
	return $arr;
}

/**
 *生成随机名称 
 * 
 */
function random($length)
{
	$hash = 'HHS-';
	$chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz';
	$max = strlen($chars) - 1;
	mt_srand((double)microtime() * 1000000);
	for($i = 0; $i < $length; $i++)
	{
	$hash .= $chars[mt_rand(0, $max)];
	}
	return $hash;
}
/**
 * 
 * 压缩图片
 * @param $i 压缩比例
 */
function ResizeImage($uploadfile,$i,$name)
{
	//取得当前图片大小
	$width = imagesx($uploadfile);
	$height = imagesy($uploadfile);
	//生成缩略图的大小
	
		$newwidth = $width * $i;
		$newheight = $height * $i;
		if(function_exists("imagecopyresampled"))
		{
			$uploaddir_resize = imagecreatetruecolor($newwidth, $newheight);
			imagecopyresampled($uploaddir_resize, $uploadfile, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
		}
		else
		{
			$uploaddir_resize = imagecreate($newwidth, $newheight);
			imagecopyresized($uploaddir_resize, $uploadfile, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
		}
		 
		ImageJpeg ($uploaddir_resize,$name);
		ImageDestroy ($uploaddir_resize);

}

?>
