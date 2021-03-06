<?php
define('IN_HHS', true);

$pcat_array = get_categories_tree();

foreach ($pcat_array as $key => $pcat_data)
{
    $pcat_array[$key]['name'] = $pcat_data['name'];

    if ($pcat_data['cat_id'])
	{
        foreach ($pcat_data['cat_id'] as $k => $v)
        {
			$pcat_array[$key]['cat_id'][$k]['name'] = $v['name'];
        }
    }
}
$i=0;
foreach($pcat_array as $idx=>$v)
{
	
	$pcat_arrays[$i] = $v;
	$i++;
	
}


$arr=array();
foreach($pcat_array as $f){

    //默认右侧二级分类
    $category = get_cat_tree($f['id']);
	
	
    foreach($category as $key => $value)
    {
        foreach($value['cat_id'] as $val)
        {
            foreach($val['cat_id'] as $v)
            {
                if(empty($v['cat_id']))
                {
                    $category[$key]['is_level'] = 1;
                    break;
                }
            }
        }
    }
    $arr[$f['id']]=$category;
}

$results['pcat_array'] = $pcat_array;
$results['arr'] = $arr;
echo $json->encode($results);
exit();




/**
 * 获得指定分类同级的所有分类以及该分类下的子分类
 *
 * @access  public
 * @param   integer     $cat_id     分类编号
 * @return  array
 */
function get_cat_tree($cat_id)
{
	global $redirect_uri,$hhs,$db;
    /*
     判断当前分类中全是是否是底级分类，
     如果是取出底级分类上级分类，
     如果不是取当前分类及其下的子分类
    */
	
	if($cat_id > 0)
	{
		$where = 'and cat_id = '.$cat_id;	
	}
    $sql = 'SELECT count(*) FROM ' . $GLOBALS['hhs']->table('category') . " WHERE  is_show = 1 ";
    if ($GLOBALS['db']->getOne($sql))
    {
        /* 获取当前分类及其子分类 */
        $sql = 'SELECT cat_id,cat_name ,parent_id,is_show,cat_img ' .
                'FROM ' . $GLOBALS['hhs']->table('category') .
                "WHERE  is_show = 1 ".$where." ORDER BY sort_order ASC, cat_id ASC";
		
		$res = $GLOBALS['db']->getRow($sql);
		
        if ($res['is_show'])
        {
           $cat_arr[0]['id']   = $res['cat_id'];
           $cat_arr[0]['name'] = $res['cat_name'];
		   $cat_arr[0]['cat_img'] = $redirect_uri.$res['cat_img'];
		   $cat_arr[0]['cats'] = get_children($cat_id);
		   
		   $cat_arr[0]['brands'] = get_goods_cate_brands($cat_arr[0]['cats']);
		   
		   
		   if (isset($res['cat_id']) != NULL)
		   {
			   $cat_arr[0]['cat_id'] = get_child_tree_xaphp($res['cat_id']);
		   }
        }
        
    }
	

    if(isset($cat_arr))
    {
        return $cat_arr;
    }
}






function get_child_tree_xaphp($tree_id = 0)
{
	$three_arr = array();
    $sql = 'SELECT count(*) FROM ' . $GLOBALS['hhs']->table('category') . " WHERE parent_id = '$tree_id' AND is_show = 1 ";
    if ($GLOBALS['db']->getOne($sql) || $tree_id == 0)
    {
        $child_sql = 'SELECT cat_id, cat_name, parent_id, is_show,cat_img ' .
                'FROM ' . $GLOBALS['hhs']->table('category') .
                "WHERE parent_id = '$tree_id' AND is_show = 1 ORDER BY sort_order ASC, cat_id ASC";
        $res = $GLOBALS['db']->getAll($child_sql);
		
        foreach ($res AS $key => $row)
        {
            if ($row['is_show'])
			{

               $three_arr[$key]['id']   = $row['cat_id'];
               $three_arr[$key]['name'] = $row['cat_name'];
               $three_arr[$key]['cat_img'] = $row['cat_img'];
               if (isset($row['cat_id']) != NULL)
               {
                       $three_arr[$key]['cat_id'] = get_child_tree_xaphp($row['cat_id']);
			   }
            }
        }
    }
    return $three_arr;
}

	function get_goods_cate_brands($cats)
	{
		if($cats)
		{
			$where = " and $cats ";	
		}
		$sql = "select g.brand_id,b.brand_name,b.brand_logo from ".$GLOBALS['hhs']->table('goods')." as g ".
		"left join ".$GLOBALS['hhs']->table('brand')." as b on g.brand_id = b.brand_id 
		where g.brand_id <> 0 $where GROUP BY b.brand_id ";
		$res = $GLOBALS['db']->getAll($sql);
		foreach($res as $key => $val)
		{
			$res[$key]['url'] = 'brand.php?id='.$val['brand_id'];
		}
		return $res;
	}

