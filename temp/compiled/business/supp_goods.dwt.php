<?php echo $this->fetch('library/header.lbi'); ?>
<body >
<?php echo $this->fetch('library/lift_menu.lbi'); ?>
<script type="text/javascript" src="templates/js/public_tab.js"></script>
<script type="text/javascript" src="templates/js/supp.js"></script>
<?php if ($this->_var['action'] == 'my_goods'): ?>
<script>
/**
 * 切换状态
 */
listTable.supp_toggle = function(obj, act, id)
{
  var val = (obj.src.match(/yes.gif/i)) ? 0 : 1;
  var res = Ajax.call(this.url, "act="+act+"&val=" + val + "&id=" +id, null, "POST", "JSON", false);
  if (res.message)
  {
    alert(res.message);
  }

  if (res.error == 0)
  {
	if(res.content ==2)
	{
		obj.src='themes/haohainew/images/no.gif';
	}
	else
	{
		
    	obj.src = (res.content > 0) ? '../<?php echo $this->_var['admin_path']; ?>/images/yes.gif' : '../<?php echo $this->_var['admin_path']; ?>/images/no.gif';
	}
  }
}
	</script>
 <div class="main" id="main">
		<div class="maintop">
			<img src="templates/images/title_goods.png" /><span>商品管理</span>
		</div><div class="maincon">
			<div class="contitlelist">
            	<span>我的商品</span>
                 <div class="searchdiv">
             <form method="post" action="index.php">
              <div>状态：</div>
                 <select id="goods_status" name="goods_status">
                	<option value="">请选择</option>
                    <option value="0" <?php if ($this->_var['goods_status'] == '0'): ?> selected="selected"<?php endif; ?>>已下架</option>
                    <option value="1" <?php if ($this->_var['goods_status'] == '1'): ?> selected="selected"<?php endif; ?>>已上架</option>
                </select>
                <?php if (0): ?>
                <div>促销：</div>
                 <select id="is_promote" name="is_promote">
                	<option value="">请选择</option>
                    <option value="1" <?php if ($this->_var['is_promote'] == '1'): ?> selected="selected"<?php endif; ?>>是</option>
                    <option value="0" <?php if ($this->_var['is_promote'] == '0'): ?> selected="selected"<?php endif; ?>>否</option>
                </select>
                <div>当季：</div>
                 <select id="is_season" name="is_season">
                	<option value="">请选择</option>
                    <option value="1" <?php if ($this->_var['is_season'] == '1'): ?> selected="selected"<?php endif; ?>>是</option>
                    <option value="0" <?php if ($this->_var['is_season'] == '0'): ?> selected="selected"<?php endif; ?>>否</option>
                </select>
                <?php endif; ?>
                 <div>审核：</div>
                 <select id="is_check" name="is_check">
                	<option value="">请选择</option>
                    <option value="0" <?php if ($this->_var['is_check'] == '0'): ?> selected="selected"<?php endif; ?>>审核中</option>
                    <option value="1" <?php if ($this->_var['is_check'] == '1'): ?> selected="selected"<?php endif; ?>>已审核</option>
                    <option value="2" <?php if ($this->_var['is_check'] == '2'): ?> selected="selected"<?php endif; ?>>未审核</option>
                </select>
                <?php if (0): ?>
    			 <div>推荐：</div>
                 <select id="is_supp_top" name="is_supp_top">
                	<option value="">请选择</option>
                    <option value="1" <?php if ($this->_var['is_supp_top'] == '1'): ?> selected="selected"<?php endif; ?>>是</option>
                    <option value="0" <?php if ($this->_var['is_supp_top'] == '0'): ?> selected="selected"<?php endif; ?>>否</option>
                </select>                
                <?php endif; ?>
                <input type="text"   value="" class="input" name="keywords">
                <input type="hidden" name="act"  value="my_goods" />
                <input type="hidden" name="op"  value="goods" />
                <input type="submit" class="btn" name="" value="搜索">
            </form>
                        </div>
            </div>

            

			<div class="conbox">
            <form method="post" action="index.php">
				<table cellspacing="0" cellpadding="0" class="listtable">

					<tr>

					  <th><input onclick="listTable.selectAll(this, 'checkbox');" type="checkbox" name="checkbox" value="checkbox" /></th>

					  <th>货号</th>

					  <th class="left">商品名称</th>

					  <th class="left">商品价格</th>
 
					  <th class="left">团购价格</th>
                      
                      <th class="left">团购人数</th>

					  <th class="right">审核状态</th>

                      <th class="right">上架</th>
					  <th>操作列</th>
					</tr>
                      <?php $_from = $this->_var['goods_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'goods');if (count($_from)):
    foreach ($_from AS $this->_var['goods']):
?>
					<tr>
					  <td class="checkbox"><input type="checkbox" name="checkbox[]" value="<?php echo $this->_var['goods']['goods_id']; ?>" /></td>
					  <td class="middle"><?php echo $this->_var['goods']['goods_sn']; ?></td>
					  <td><?php echo sub_str($this->_var['goods']['goods_name'],30); ?><?php if ($this->_var['goods']['gmt_end_time']): ?><font color="#FF0000">[促销]</font><?php endif; ?></td>
					  <td><?php echo $this->_var['goods']['shop_price']; ?></td>
					  <td>
                      <!-- 
                     <img src="../<?php echo $this->_var['admin_path']; ?>/images/<?php if ($this->_var['goods']['is_season']): ?>yes<?php else: ?>no<?php endif; ?>.gif" onclick="listTable.supp_toggle(this, 'is_season', <?php echo $this->_var['goods']['goods_id']; ?>)" /> 
                       -->
                      <?php echo $this->_var['goods']['team_price']; ?></td>
                      
                       <td> <?php echo $this->_var['goods']['team_num']; ?></td>
                       <!-- 
                       <img src="../<?php echo $this->_var['admin_path']; ?>/images/<?php if ($this->_var['goods']['is_supp_top']): ?>yes<?php else: ?>no<?php endif; ?>.gif" onclick="listTable.supp_toggle(this, 'is_supp_top', <?php echo $this->_var['goods']['goods_id']; ?>)" />
                        -->
					  <td class="right"> 
                      
                       <?php if ($this->_var['goods']['is_check'] == '0'): ?>审核中...<?php elseif ($this->_var['goods']['is_check'] == 1): ?>已审核<?php else: ?><span style="color:#F00;">未通过</span><?php endif; ?>
                      <?php if ($this->_var['goods']['is_check'] == 2 && $this->_var['goods']['check_desc'] != ''): ?><span style="color:#F00;">[<?php echo $this->_var['goods']['check_desc']; ?>]</span><?php endif; ?>
                      
                      
                      
                      </td>
                      <td class="right">
                      <?php if ($this->_var['goods']['is_check'] == 1): ?><a href='?op=goods&act=goods_on_sale&goods_id=<?php echo $this->_var['goods']['goods_id']; ?>&id=<?php echo $this->_var['goods']['is_on_sale']; ?>' onclick="return confirm('确定要继续此操作吗？')"><?php if ($this->_var['goods']['is_on_sale'] == 0): ?>上架<?php else: ?>取消上架<?php endif; ?></a><?php else: ?>    <?php if ($this->_var['goods']['is_on_sale'] == 0): ?>未上架<?php else: ?>已上架<?php endif; ?>  <?php endif; ?>
                       </td>
					  <td class="middle">
                       <a href="/goods.php?ii=lii&id=<?php echo $this->_var['goods']['goods_id']; ?>">预览</a>| 
                       <a href="?op=goods&act=edit_goods&goods_id=<?php echo $this->_var['goods']['goods_id']; ?>&page=<?php echo $this->_var['pager']['page']; ?>">编辑</a>
                       
                    <?php if ($this->_var['specifications'] [ $this->_var['goods']['goods_type'] ] != ''): ?>| 
      <a href="?op=goods&act=product_list&goods_id=<?php echo $this->_var['goods']['goods_id']; ?>&page=<?php echo $this->_var['pager']['page']; ?>" title="<?php echo $this->_var['lang']['item_list']; ?>">货品</a><?php endif; ?>
  
                       
                       | <a href="?op=goods&act=delete_goods&goods_id=<?php echo $this->_var['goods']['goods_id']; ?>" onclick="return confirm('确定要此操作吗');">回收站</a>
                      
                       </td>
					</tr>

					<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>

				</table>
<input name="act" type="hidden" value="my_goods_batch" />
<input name="page" type="hidden" value="<?php echo $this->_var['pager']['page']; ?>" />
<input name="op" type="hidden" value="goods" />
<table border="0">
	<tr>
	<td>
		<input class="button" type="submit" value="批量删除"  name="remove">
	</td>
	<td>
		<input class="button" type="submit" value="批量上架"  name="up_sale">
	</td>
	<td>
		<input class="button" type="submit" value="批量下架"  name="down_sale">
	</td>
	</tr>
</table>
</form> 
			</div>

			     <?php echo $this->fetch('library/pages.lbi'); ?>

		</div>

        </div>

<?php endif; ?>
<?php if ($this->_var['action'] == 'product_list'): ?>

 <div class="main" id="main">
		<div class="maintop">
			<img src="templates/images/title_goods.png" /><span>商品管理</span>
		</div><div class="maincon">
			<div class="contitlelist">
            	<span>货品库存</span>
                	<div class="titleright">
					<a href="?op=goods&act=my_goods&page=<?php echo $this->_var['page']; ?>">返回列表</a>
				</div>
            </div>
	<div class="conbox">
<form method="post" action="index.php?op=goods&page=<?php echo $this->_var['page']; ?>" name="addForm" id="addForm" >
<input type="hidden" name="goods_id" value="<?php echo $this->_var['goods_id']; ?>" />
<input type="hidden" name="act" value="product_add_execute" />
  <table width="100%" id="table_list"   class="edittable">
    <tr>
      <th colspan="20" scope="col"><?php echo $this->_var['goods_name']; ?>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $this->_var['goods_sn']; ?></th>
    </tr>
    <tr>
      
      <?php $_from = $this->_var['attribute']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'attribute_value');if (count($_from)):
    foreach ($_from AS $this->_var['attribute_value']):
?>
        <td scope="col"><div align="center"><strong><?php echo $this->_var['attribute_value']['attr_name']; ?></strong></div></td>
      <?php endforeach; else: ?>
        <td scope="col">&nbsp;</td>
      <?php endif; unset($_from); ?><?php $this->pop_vars();; ?>
      
      <td class="label_2"><?php echo $this->_var['lang']['goods_sn']; ?></td>
      <td class="label_2"><?php echo $this->_var['lang']['goods_number']; ?></td>
      <td class="label_2">&nbsp;</td>
    </tr>

    <?php $_from = $this->_var['product_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'product');if (count($_from)):
    foreach ($_from AS $this->_var['product']):
?>
    <tr>
      <?php $_from = $this->_var['product']['goods_attr']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'goods_attr');if (count($_from)):
    foreach ($_from AS $this->_var['goods_attr']):
?>
      <td scope="col"><div align="center"><?php echo $this->_var['goods_attr']; ?></div></td>
      <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
      <td class="td_1"><span onclick="listTable.edit(this, 'edit_product_sn', <?php echo $this->_var['product']['product_id']; ?>)"><?php echo empty($this->_var['product']['product_sn']) ? $this->_var['lang']['n_a'] : $this->_var['product']['product_sn']; ?></span></td>
      <td class="td_1"><span onclick="listTable.edit(this, 'edit_product_number', <?php echo $this->_var['product']['product_id']; ?>)"><?php echo $this->_var['product']['product_number']; ?></span></td>
      <td><input type="button" class="button"   value=" - " onclick="product_remove(<?php echo $this->_var['product']['product_id']; ?>);"/></td>
    </tr>
    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>

    <tr id="attr_row">
    
    <?php $_from = $this->_var['attribute']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('attribute_key', 'attribute_value');if (count($_from)):
    foreach ($_from AS $this->_var['attribute_key'] => $this->_var['attribute_value']):
?>
      <td align="center">
        <select name="attr[<?php echo $this->_var['attribute_value']['attr_id']; ?>][]"  class="input" >
        <option value="" selected>请选择</option>
        <?php $_from = $this->_var['attribute_value']['attr_values']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'value');if (count($_from)):
    foreach ($_from AS $this->_var['value']):
?>
        <option value="<?php echo $this->_var['value']; ?>"><?php echo $this->_var['value']; ?></option>
        <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
        </select>
      </td>
    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
    

      <td class="label_2"><input type="text" name="product_sn[]"  class="input" value="" size="20"/></td>
      <td class="label_2"><input type="text" class="input" name="product_number[]" value="<?php echo $this->_var['product_number']; ?>" size="10"/></td>
      <td><input type="button" class="button" value=" + " onclick="javascript:add_attr_product();"/></td>
    </tr>

    <tr>
      <td align="center" colspan="<?php echo $this->_var['attribute_count_3']; ?>">
        <input type="button" class="button" value="保存设置" onclick="checkgood_sn()" />
      </td>
    </tr>
  </table>
</form>
		</div>


</div>
        </div>

<script type="text/javascript">

<?php $_from = $this->_var['filter']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['item']):
?>
listTable.filter.<?php echo $this->_var['key']; ?> = '<?php echo $this->_var['item']; ?>';
<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>

listTable.query = 'product_query';

var _attr = new Array;
<?php $_from = $this->_var['attribute']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('attribute_key', 'attribute_value');if (count($_from)):
    foreach ($_from AS $this->_var['attribute_key'] => $this->_var['attribute_value']):
?>
_attr[<?php echo $this->_var['attribute_key']; ?>] = '<?php echo $this->_var['attribute_value']['attr_id']; ?>';
<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>


function product_remove(id)
{
  if(confirm('确定要执行此操作吗?'))
    {
       window.location.href="index.php?op=goods&page=<?php echo $this->_var['page']; ?>&act=product_remove&id="+id; 
    }
    return false; 
}
/**
 * 追加货品添加表格
 */
function add_attr_product()
{
  var table_list = document.getElementById('table_list');
  var new_tr_id = rand_str('t');
  var attr_row, attr_col, new_row, new_col;
  var index = table_list.rows.length - 2; //此行号为输入框所在行

  //创建新行
  attr_row = document.getElementById('attr_row');
  attr_col = attr_row.getElementsByTagName('td');

  new_row = table_list.insertRow(index);//新增行
  new_row.setAttribute("id", new_tr_id);

  //创建新行的列
  for (var i = 0; i < attr_col.length; i++)
  {
    new_col = new_row.insertCell(-1);
    new_col.setAttribute("align", attr_col[i].getAttribute("align"));
    new_col.setAttribute("class", attr_col[i].getAttribute("class"));
    new_col.setAttribute("className", attr_col[i].getAttribute("className"));

    if (i + 1 == attr_col.length)
    {
      new_col.innerHTML = '<input type="button" class="button" value=" - " onclick="javascript:minus_attr_product(\'' + new_tr_id + '\');"/>';
    }
    else
    {
      new_col.innerHTML = attr_col[i].innerHTML;
    }
  }

  //重置选项
//  var sel = new_row.getElementsByTagName('select');
//  if (sel.length > 0)
//  {
//    for (var j = 0; j < sel.length; j++)
//    {
//      sel[j].value = '';
//    }
//  }

  return true;
}

/**
 * 删除追加的货品表格
 */
function minus_attr_product(tr_number)
{
  if (tr_number.length > 0)
  {
    if (confirm("确定删除吗？") == false)
    {
      return false;
    }

    var table_list = document.getElementById('table_list');

    for (var i = 0; i < table_list.rows.length; i++)
    {
      if (table_list.rows[i].id == tr_number)
      {
        table_list.deleteRow(i);
      }
    }
  }

  return true;
}
function  checkgood_sn()
{
    //var validator = new Validator('addForm');
    var volumePri = document.getElementsByName("product_sn[]");
	var check_sn='';
    for (i = 0 ; i < volumePri.length ; i ++)
    {
        if(volumePri.item(i).value == "")
        {
        }
		else
		{
		    check_sn=check_sn+'||'+volumePri.item(i).value;
		}
    }
			var callback = function(res)
			{
               if (res.error > 0)
               {
                  alert(res.message);
               }
			   else
		       {
			      document.forms['addForm'].submit();
		       }
		   }
           Ajax.call('index.php?op=goods&act=check_products_goods_sn', "goods_sn=" + check_sn, callback, "GET", "JSON");
}
/**
 * 返回随机数字符串
 *
 * @param : prefix  前缀字符
 *
 * @return : string
 */
function rand_str(prefix)
{
  var dd = new Date();
  var tt = dd.getTime();
  tt = prefix + tt;

  var rand = Math.random();
  rand = Math.floor(rand * 100);

  return (tt + rand);
}



</script>
<?php endif; ?>
<?php if ($this->_var['action'] == 'add_goods' || $this->_var['action'] == 'edit_goods'): ?>
    <!--script type="text/javascript" src="../js/goods_cat_region.js"></script-->
    <!--<script type="text/javascript" src="templates/js/jquery_common.min.js"></script>-->
   <!--script type="text/javascript" src="/js/transport.js"></script-->
    <script>
	region.isAdmin = true;
     
		function checkgoodsinfo()
		{
			var goods_desc = document.getElementById('desc_num').value;
			//var is_promote = document.myform.is_promote.checked;
			//var promote_price = document.myform.promote_price.value;
			var goods_number  = document.myform.goods_number.value;
			var goods_img_url  = document.getElementById('goods_img_url').value;
			var little_img  = document.getElementById('little_img').value;
			var city_id  = document.myform.city_id.value;
			
		    var msg = '';
		  if(document.myform.goods_name.value=='')
		  {
			msg += '请输入商品名称。\n';
		  }
		  
 		 if(document.myform.city_id.value=='')
		  {
			msg += '请选择城市。\n';
		  }		  
		  if(document.myform.shop_price.value =='')
		  {
			msg += '请输入商品价格。\n';
		  }
		  
		  else if(document.myform.market_price.value < 0.01)
		   {
			 msg += '请输入市场价格\n';
		   }
			//if(is_promote == true)
//			{
//				if(promote_price <= 0)
//				{
//					msg += '商品促销价格不能为零。\n';
//				}
//			}
			
			
			if(goods_number =='' || goods_number <= 0)
			{
				msg += '请输入商品库存。\n';
			}
			if(goods_img_url.length < 40)
			{
		
				msg += '请上传一张图片。\n';
			}
			
			if(little_img.length < 40)
			{
		
				msg += '请上传一张商品矩形图片。\n';
			}
			
			if(goods_desc < 5)
			{
				msg += '请输入详细描述最少不得少于5个字。\n';
			}
		
            var Jse = document.getElementById('Jse');
            var li = Jse.getElementsByTagName("li");
            for(var i=0; i<li.length; i++){
                   
                if(li[i].className=='act' && i!=3){
                    
                     document.getElementById('J_express').value=888;
                }
            }
		 
			if (msg.length > 0)
			{
			   alert(msg);
			   return false;
			}
			else
			{
			   return true;
			}
		}
    </script>
 	<div class="main" id="main">
		<div class="maintop">
			<img src="templates/images/title_addgoods.png" /><span>商品管理</span>
		</div>
		<div class="maincon" style="color:#000;">
			<div class="contitleedit"><span><?php if ($this->_var['action'] == 'add_goods'): ?>新增信息<?php else: ?>编辑信息<?php endif; ?></span></div>
            <ul class="listtab" id="Jse">
        <li id='nav1' class="act" ><a href="javascript:;" onclick="show_html(1,4);">详细描述</a></li>
        <li id='nav2' ><a href="javascript:;" onclick="show_html(2,4);">商品相册</a></li>        
                <li id='nav3' ><a href="javascript:;" onclick="show_html(3,4);">商品属性</a></li>
                <li id='nav4' ><a href="javascript:;" onclick="show_html(4,4);">运费设置</a></li>
      </ul>
      		<form action="index.php" enctype="multipart/form-data" method="post" name="myform" onsubmit="return checkgoodsinfo();">
		    <div class="conbox" style="display:block;" id="show_html1">
				<table cellspacing="0" cellpadding="0" class="edittable">
					<tr>
						<td class="right" width="100">商品名称：</td>
						<td><input type="text" value="<?php echo $this->_var['goods']['goods_name']; ?>" name="goods_name" class="input" size="35"><font style="color:#F00">*</font></td>
					</tr>
          <tr>
            <td class="right" width="100">商品简单描述：</td>
            <td><textarea name="goods_brief" id="goods_brief" cols="35" rows="2"><?php echo $this->_var['goods']['goods_brief']; ?></textarea></td>
          </tr>

                     <tr>
						<td class="right">区域选择：</td>
                        <td>
                  

		  <select class="input"   name="city_id" id="selCities"  onchange="region.changed(this, 3, 'selDistricts')">

          <option value='1'>全国</option>

            <?php $_from = $this->_var['cities']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'region');if (count($_from)):
    foreach ($_from AS $this->_var['region']):
?>

              <option value="<?php echo $this->_var['region']['region_id']; ?>" <?php if ($this->_var['region']['region_id'] == $this->_var['goods']['city_id']): ?>selected="selected"<?php endif; ?>><?php echo $this->_var['region']['region_name']; ?></option>

            <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>

        </select>
         <select  class="input"   name="district_id" id="selDistricts">

				<option value="0">请选择</option>

				<?php $_from = $this->_var['district_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'district');if (count($_from)):
    foreach ($_from AS $this->_var['district']):
?>

				<option value="<?php echo $this->_var['district']['region_id']; ?>" <?php if ($this->_var['district']['region_id'] == $this->_var['goods']['district_id']): ?>selected="selected"<?php endif; ?>  ><?php echo $this->_var['district']['region_name']; ?></option>

				<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>

		</select>                
                        </td>
					</tr>

                   
                     
                      <tr>
						<td class="right">商品分类：</td>
						<td>
                        <select name="cat_id" class="input"  >
            				<option value="0">请选择...</option>
            				<?php echo $this->_var['cat_list']; ?>
            			</select>
                        </td>
					</tr>
					
            <tr>
              <td class="right">商品品牌：</td>
              <td><select name="brand_id" class="input"  >
                  <option value="0">请选择...</option>
                  
                   <?php $_from = $this->_var['supp_brand_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'brand');if (count($_from)):
    foreach ($_from AS $this->_var['brand']):
?> 
                  
                  <option value="<?php echo $this->_var['brand']['brand_id']; ?>" <?php if ($this->_var['goods']['brand_id'] == $this->_var['brand']['brand_id']): ?> selected="selected"<?php endif; ?>><?php echo $this->_var['brand']['brand_name']; ?></option>
                  
                  <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                  
                </select></td>
            </tr>
                  
                    <tr>
						<td class="right">商品价格：</td>
						<td><input type="text" value="<?php echo $this->_var['goods']['shop_price']; ?>" name="shop_price" class="input" size="35"><font style="color:#F00">*</font>
                        </td>
					</tr>
                    <tr>
						<td class="right">商品货号：</td>
						<td><input type="text" value="<?php echo $this->_var['goods']['goods_sn']; ?>" name="goods_sn" class="input" size="35"><font style="color:#F00">可不填，系统自动生成</font>
                        </td>
					</tr>
          <tr>
            <td class="right">市场价格：</td>
            <td><input type="text" value="<?php echo $this->_var['goods']['market_price']; ?>" name="market_price" class="input" size="35"><font style="color:#F00">*</font>
                        </td>
          </tr>
          <script>
          function clearBox(index){
                J_1 = document.getElementById('J_check1');
                J_2 = document.getElementById('J_check2');
                J_3 = document.getElementById('J_check3');
                switch(index){
                    
                    case 1:
                    J_2.checked=false;
                    J_3.checked=false;
                    break;
                    
                    case 2:
                    J_1.checked=false;
                    J_3.checked=false;
                    break;
                    
                    case 3:
                    J_1.checked=false;
                    J_2.checked=false;
                    break;
                }
          }
          </script>
          <tr>
            <td class="right">销售方式：</td>
            <td>
              

              <input type="checkbox" id="J_check1" onclick="clearBox(1)" name="is_mall" value="1" <?php if ($this->_var['goods']['is_mall'] == 1): ?>checked<?php endif; ?>>单独购
              <input type="checkbox" id="J_check2" onclick="clearBox(2)" name="is_zero" value="1" <?php if ($this->_var['goods']['is_zero'] == 1): ?>checked<?php endif; ?>>零元购
              <input type="checkbox" id="J_check3" onclick="clearBox(3)" name="is_team" value="1" <?php if ($this->_var['goods']['is_team'] == 1): ?>checked<?php endif; ?>>拼团
             
              <font color="red">单独购、拼团、零元购只能三选一</font>
            </td>
            
          </tr>  
          <tr>
          <td class="right">加入推荐：</td>
          <td>
            <input type="checkbox" name="is_best" value="1" <?php if ($this->_var['goods']['is_best']): ?>checked="checked"<?php endif; ?> />精品 
              <input type="checkbox" name="is_new" value="1" <?php if ($this->_var['goods']['is_new']): ?>checked="checked"<?php endif; ?> />新品
              <input type="checkbox" name="is_hot" value="1" <?php if ($this->_var['goods']['is_hot']): ?>checked="checked"<?php endif; ?> />热销
               <input type="checkbox" name="is_tejia" value="1" <?php if ($this->_var['goods']['is_tejia'] == 1): ?>checked<?php endif; ?>>特价
              <input type="checkbox" name="is_fresh" value="1" <?php if ($this->_var['goods']['is_fresh'] == 1): ?>checked<?php endif; ?>>新人专享
          </td>
          </tr>
          <tr>
            <td class="right">零元购邮费：</td>
            <td><input type="text" value="<?php echo $this->_var['goods']['shipping_fee']; ?>" name="shipping_fee" class="input" size="35">
                        </td>
          </tr>          
           <tr>
            <td class="right">是否关注后购买:</td>
            <td>
            <input type="radio" name="subscribe" value="0" <?php if ($this->_var['goods']['subscribe'] == 0): ?>checked="checked"<?php endif; ?>>否 
            <input type="radio" name="subscribe" value="1" <?php if ($this->_var['goods']['subscribe'] == 1): ?>checked="checked"<?php endif; ?>>是 &nbsp;若选择是，必须是关注的会员才能购买
            </td>
          
          </tr>
          
           <tr>
            <td class="right">产品标签：</td>
            <td>
          <input type="text" name="lab_qgby" id="lab_qgby" class="input"  value="<?php echo $this->_var['goods']['lab_qgby']; ?>" />
        <input type="text" name="lab_zpbz" id="lab_zpbz"  class="input" value="<?php echo $this->_var['goods']['lab_zpbz']; ?>" />
        <input type="text" name="lab_qtth" id="lab_qtth" class="input"  value="<?php echo $this->_var['goods']['lab_qtth']; ?>" />
        <input type="text" name="lab_jkbs" id="lab_jkbs" class="input"  value="<?php echo $this->_var['goods']['lab_jkbs']; ?>" />
        <input type="text" name="lab_hwzy" id="lab_hwzy" class="input"  value="<?php echo $this->_var['goods']['lab_hwzy']; ?>" />
        </td>
          </tr> 
          <tr>
            <td class="right">产品特色：</td>
            <td>
          <input type="text" name="ts_a" class="input"  id="ts_a" value="<?php echo $this->_var['goods']['ts_a']; ?>" />
        <input type="text" name="ts_b" class="input"  id="ts_b" value="<?php echo $this->_var['goods']['ts_b']; ?>" />
        <input type="text" name="ts_c" class="input"  id="ts_c" value="<?php echo $this->_var['goods']['ts_c']; ?>" />
        </td>
          </tr>  
          
                      <tr>
						<td class="right">商品规格：</td>
						<td><input type="text" value="<?php echo $this->_var['goods']['guige']; ?>" name="guige" class="input" size="35">
                        </td>
					</tr>
                    <tr>
            <td class="right">商品重量：</td> 
            <td><input type="text"   class="input"name="goods_weight" value="<?php echo $this->_var['goods']['goods_weight_by_unit']; ?>" size="20" /> <select name="weight_unit"><?php echo $this->html_options(array('options'=>$this->_var['unit_list'],'selected'=>$this->_var['weight_unit'])); ?></select></td>
          </tr>         
                    <tr>
						<td class="right">商品库存：</td>
						<td><input type="text" value="<?php echo $this->_var['goods']['goods_number']; ?>" name="goods_number" class="input" size="20">
                        <font style="color:#F00">*</font></td>
					</tr>
					<tr>
			            <td class="right">参团人数：</td>
			            <td><input type="text"  class="input" name="team_num" value="<?php if ($this->_var['form_act'] == 'insert_goods'): ?>5<?php else: ?><?php echo $this->_var['goods']['team_num']; ?><?php endif; ?>" size="20" />
			             <font style="color:#F00">*</font></td>
			          </tr>
			          <tr>
			            <td class="right">团购价格：</td>
			            <td><input type="text" name="team_price"  class="input" value="<?php echo $this->_var['goods']['team_price']; ?>" size="20" />
			            <font style="color:#F00">*</font></td>
			          </tr>
			          <tr>
			            <td class="right">团购销量：</td>
			            <td><input type="text" name="sales_num"  class="input" value="<?php echo $this->_var['goods']['sales_num']; ?>" size="20" /></td>
			          </tr>
            <tr>
            <td class="right">团购限购数量：</td>
            <td><input type="text" name="limit_buy_bumber"  class="input" value="<?php echo $this->_var['goods']['limit_buy_bumber']; ?>" size="20"> 如果是团购请设置，为0表示不限购，如果是团长免单或团长优惠请确认是否要限制购买次数</td>
          </tr>
          <tr>
            <td class="right">团购限制次数：</td>
            <td>
            <input type="radio" name="limit_buy_one" value="0"  <?php if ($this->_var['goods']['limit_buy_one'] == 0): ?>checked="checked"<?php endif; ?>>否 
            <input type="radio" name="limit_buy_one" value="1" <?php if ($this->_var['goods']['limit_buy_one'] == 1): ?>checked="checked"<?php endif; ?>>是
              &nbsp;一个会员只能购买一次
            </td>
          </tr>                      
            <tr>
            <td class="right">团长优惠：</td>
            <td>
              <select name="discount_type" class="input"   onchange="change_discount_type(this.value)">
                  <option value="0">无优惠</option>
                  <option value="1" <?php if ($this->_var['goods']['discount_type'] == 1): ?>selected='selected'<?php endif; ?>>团长免单</option>
                  <option value="2" <?php if ($this->_var['goods']['discount_type'] == 2): ?>selected='selected'<?php endif; ?>>团长优惠</option>
                </select>
                <span <?php if ($this->_var['goods']['discount_type'] != 2): ?>style="display:none;"<?php endif; ?> id="discount_amount">
                优惠金额：<input type="text"  name="discount_amount" value="<?php echo $this->_var['goods']['discount_amount']; ?>" onblur="discount_amount_blur(this.value)" >
                </span>
            </td>
          </tr> 
          <tr>
            <td class="right">是否允许使用优惠券：</td>
            <td>
                <label><input type="radio" name="bonus_allowed" value="1"<?php if ($this->_var['goods']['bonus_allowed'] != 0): ?>checked='checked'<?php endif; ?>>是</label>
                <label><input type="radio" name="bonus_allowed" value="0"<?php if ($this->_var['goods']['bonus_allowed'] == 0): ?>checked='checked'<?php endif; ?>>否</label>
            </td>
          </tr>
          <tr>
            <td class="right">指定可用免单券：</td>
            <td><select name="bonus_free_all" class="input"  ><option value="0">请选择</option>
            <?php $_from = $this->_var['bonus_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'bonus');if (count($_from)):
    foreach ($_from AS $this->_var['bonus']):
?>
            <option value="<?php echo $this->_var['bonus']['type_id']; ?>" <?php if ($this->_var['bonus']['type_id'] == $this->_var['goods']['bonus_free_all']): ?>selected<?php endif; ?>><?php echo $this->_var['bonus']['type_name']; ?></option>
            <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
            </select></td>
          </tr>
          <tr>
            <td class="right">是否允许分销：</td>
            <td>
                <label><input type="radio" name="allow_fenxiao" value="1"<?php if ($this->_var['goods']['allow_fenxiao'] != 0): ?>checked='checked'<?php endif; ?>  onclick="document.getElementById('fenxiao_row').style.display = ''">是</label>
                <label><input type="radio" name="allow_fenxiao" value="0"<?php if ($this->_var['goods']['allow_fenxiao'] == 0): ?>checked='checked'<?php endif; ?>  onclick="document.getElementById('fenxiao_row').style.display = 'none'">否</label>
            </td>
          </tr>     
          <tr id="fenxiao_row" <?php if ($this->_var['goods']['allow_fenxiao'] == 0): ?> style="display:none;" <?php endif; ?>>
            <td class="right">分销金额：</td>
            <td>
                一级<input type="text"  class="input" name="rate_1" value="<?php echo empty($this->_var['goods']['rate_1']) ? '0' : $this->_var['goods']['rate_1']; ?>">元
                二级<input type="text"   class="input"name="rate_2" value="<?php echo empty($this->_var['goods']['rate_2']) ? '0' : $this->_var['goods']['rate_2']; ?>">元
                三级<input type="text"  class="input" name="rate_3" value="<?php echo empty($this->_var['goods']['rate_3']) ? '0' : $this->_var['goods']['rate_3']; ?>">元
            </td>
          </tr>    
          <tr>
            <td class="right">秒杀产品：</td>
            <td>
                <label><input type="radio" name="is_miao" value="1"<?php if ($this->_var['goods']['is_miao'] != 0): ?>checked='checked'<?php endif; ?>>是</label>
                <label><input type="radio" name="is_miao" value="0"<?php if ($this->_var['goods']['is_miao'] == 0): ?>checked='checked'<?php endif; ?>>否</label>
            </td>
          </tr>
          <script type="text/javascript" src="templates/js/jquery1.42.min.js"></script>
          <script type="text/javascript">
              function jianting(is_miao){
                  if(is_miao==1){
                        $('#show , #promote_4').css('display','table-row');
                    }
                    else{
                        $('#show , #promote_4').css('display','none');
                    }
                }
              $(document).ready(function(){
                    jianting($("input[name='is_miao']:checked").val());
                    $("input[name='is_miao']").live('change', function(){
                     var is_miao =$("input[name='is_miao']:checked").val() ;
                         jianting(is_miao);
                    });
              });
           </script>

          <tr id="show">
            <td class="right">秒杀价格：</td>
            <td>
                <input type="text"   class="input"name="promote_price" value="<?php echo empty($this->_var['goods']['promote_price']) ? '0.00' : $this->_var['goods']['promote_price']; ?>">
            </td>
          </tr>          
          <tr id="promote_4">
            <td class="right">秒杀时间</td>
            <td id="promote_6">
              <input name="promote_start_date"   class="input"type="text" id="promote_start_date" size="25" value='<?php echo $this->_var['goods']['promote_start_date']; ?>' readonly onfocus="WdatePicker({dateFmt:'yyyy-M-d HH:mm'})" />
               - 
               <input name="promote_end_date"  class="input" type="text" id="promote_end_date" size="25" value='<?php echo $this->_var['goods']['promote_end_date']; ?>' readonly onfocus="WdatePicker({dateFmt:'yyyy-M-d HH:mm'})" /> <font color="red">*</font>
            </td>
          </tr>
<!--           <tr>
            <td class="right">夺宝产品：</td>
            <td>
                <label><input type="radio" name="is_luck" value="1"<?php if ($this->_var['goods']['is_luck'] != 0): ?>checked='checked'<?php endif; ?>>是</label>
                <label><input type="radio" name="is_luck" value="0"<?php if ($this->_var['goods']['is_luck'] == 0): ?>checked='checked'<?php endif; ?>>否</label>  <font color="red">和秒杀产品只能二选一</font>
            </td>
          </tr>
          <tr>
            <td class="right">夺宝期数：</td>
            <td>
                <input type="text" name="luck_times" value="<?php echo empty($this->_var['goods']['luck_times']) ? '1' : $this->_var['goods']['luck_times']; ?>" disabled> <font color="red"></font>
            </td>
          </tr>
          <tr>
            <td class="right">最大期数：</td>
            <td>
                <input type="text" name="max_luck_times" value="<?php echo $this->_var['goods']['max_luck_times']; ?>"> <font color="red"></font>
            </td>
          </tr>
          <tr>
            <td class="right">平均份数：</td>
            <td>
                <input type="text" name="luck_number" value="<?php echo $this->_var['goods']['team_num']; ?>"> <font color="red"></font>
            </td>
          </tr>    -->      
					<?php if (0): ?>
                     <tr>
						<td class="right">商品重量：</td>
						<td><input type="text" value="<?php echo $this->_var['goods']['goods_weight']; ?>" name="goods_weight" class="input" size="35">kg
                        </td>
					</tr>
                     <tr>
						<td class="right">是否免费配送：</td>
						<td>
                        <input type="checkbox" name="is_shipping" value="1" <?php if ($this->_var['goods']['is_shipping']): ?>checked="checked"<?php endif; ?> />
                        打勾表示此商品不会产生运费花销，否则按照正常运费计算。
                        </td>
					</tr> 
                     <tr>
						<td class="right">是否是套餐：</td>
						<td>
                        <input type="checkbox" name="is_package" value="1" <?php if ($this->_var['goods']['is_package']): ?>checked="checked"<?php endif; ?> />
                        打勾表示此商品是多个商品打包成套餐销售。
                        </td>
					</tr> 
                    <tr>
						<td class="right">商品单位：</td>
						<td><input type="text" value="<?php echo $this->_var['goods']['unit']; ?>" name="unit" class="input" size="2">
                        </td>
					</tr>
					 
                         <tr>
						<td class="right">产品授权书：</td>
						<td>
                        <input name="goods_authorization" type="file" />
                         <?php if ($this->_var['goods']['goods_authorization']): ?>
                <a href="/<?php echo $this->_var['goods']['goods_authorization']; ?>" target="_blank"><img src="templates/images/yes.gif" border="0" /></a>
              <?php else: ?>
                <img src="templates/images/no.gif" />
              <?php endif; ?>&nbsp;&nbsp;大小建议800KB以下  
                        </td>
					</tr>
					 <?php endif; ?>
                  <!--  <tr>
                      <td class="right">到店消费：</td>
                      <td><input type="checkbox" name="is_consumption" id="is_consumption" <?php if ($this->_var['goods']['is_consumption']): ?> checked="checked"<?php endif; ?>  value="1"/></td>
                    </tr>-->
               <tr>
                  <td class="right">商品图片：</td>
                  <td>
                <input type="text" size="40"  class="input" id="goods_img_url" value="<?php echo $this->_var['goods']['goods_img']; ?>" style="color:#aaa;"  name="goods_img_url"/>
               <a href="javascript:;" onclick="winopen('index.php?op=goods&act=get_pic&img_id=goods_img_url','600','500');" class="bnt">选择图片</a>
              <?php if ($this->_var['goods']['goods_img']): ?>
                <a href="/<?php echo $this->_var['goods']['goods_img']; ?>" target="_blank"><img src="templates/images/yes.gif" border="0" /></a>
              <?php else: ?>
                <img src="templates/images/no.gif" />
              <?php endif; ?> &nbsp;&nbsp;大小建议400像素*400像素  <font style="color:#F00">*</font> 
                </td>
              </tr>
              
              <tr>
                  <td class="right">拼团矩形图：</td>
                  <td>
                <input type="text" size="40"  class="input" id="little_img" value="<?php echo $this->_var['goods']['little_img']; ?>" style="color:#aaa;"  name="little_img"/>
               <a href="javascript:;" onclick="winopen('index.php?op=goods&act=get_pic&img_id=little_img','600','500');" class="bnt">选择图片</a>
              <?php if ($this->_var['goods']['little_img']): ?>
                <a href="/<?php echo $this->_var['goods']['little_img']; ?>" target="_blank"><img src="templates/images/yes.gif" border="0" /></a>
              <?php else: ?>
                <img src="templates/images/no.gif" />
              <?php endif; ?> &nbsp;&nbsp;大小建议640像素*400像素   <font style="color:#F00">*</font>
                </td>
              </tr>
              <?php if (0): ?>
              <tr>
            <td class="right">推荐描述：</td>
            <td><textarea name="goods_brief" cols="40" rows="3"><?php echo htmlspecialchars($this->_var['goods']['goods_brief']); ?></textarea></td>
          </tr>
              <tr>
            <td class="right">关键字：</td>
            <td><textarea name="keywords" cols="40" rows="3"><?php echo htmlspecialchars($this->_var['goods']['keywords']); ?></textarea></td>
          </tr>
          <?php endif; ?>
          <input type="hidden" id='desc_num' value='0' />
          
               <tr>
                  <td class="right">详细描述：</td>
                  <td>
              <?php echo $this->_var['FCKeditor']; ?>
              </td>
              </tr>
               <?php if (0): ?>
               <tr>
                  <td class="right">厂家展示：</td>
                  <td>
              <?php echo $this->_var['factory_desc']; ?>&nbsp;&nbsp;如果选择了厂家，可为空
              </td>
              </tr>
               <?php endif; ?>
                    </table>
			</div>
           <div id="show_html2" class="conbox" style="display:none;">
          		<div style="padding:12px 25px">
                 
                <table width="90%"  align="center" class="edittable">
                 <tr>
                     <td>
                     <?php echo $this->_var['img']['img_id']; ?>
              <?php $_from = $this->_var['img_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'img');if (count($_from)):
    foreach ($_from AS $this->_var['img']):
?>
             <div id="gallery_<?php echo $this->_var['img']['img_id']; ?>" style="float:left; text-align:center; border: 1px solid #DADADA; margin: 4px; padding:2px;">
             <a href="javascript:;" onclick="remove_img('<?php echo $this->_var['img']['img_id']; ?>')">[-]</a><br />
             <a href="index.php?op=goods&act=show_image&img_url=<?php echo $this->_var['img']['img_url']; ?>" target="_blank">
                <img src="<?php if ($this->_var['img']['thumb_url']): ?>../<?php echo $this->_var['img']['thumb_url']; ?><?php else: ?><?php echo $this->_var['img']['img_url']; ?><?php endif; ?>" border="0" width="200" height="200" />
                </a><br />
              </div>
              <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                </td>
             </tr>
            </table>
               		<a href="javascript:;" onclick="winopen('index.php?op=goods&act=get_photo','600','500');" class="bnt">选择图片</a>
				</div>
         </div>
        <div class="conbox" style="display:none;" id="show_html3">
		<div style="padding:12px 25px">
                 
        <table width="100%" align="center" class="edittable">
          <tr>
              <td  width="100">商品类型</td>
              <td align="left">
                <select name="goods_type" onchange="getAttrList(<?php if ($this->_var['goods']['goods_id']): ?><?php echo $this->_var['goods']['goods_id']; ?><?php else: ?>0<?php endif; ?>)">
                  <option value="0">请选择商品类型</option>
                  <?php echo $this->_var['goods_type_list']; ?>
                </select>
              </td>
          </tr>
          <tr>
            <td id="tbody-goodsAttr" colspan="2" style="padding:0"><?php echo $this->_var['goods_attr_html']; ?></td>
          </tr>

        </table>
		  </div>
			</div>

<div class="conbox" style="display:none;" id="show_html4">
    <div style="padding:12px 25px">
        <table width="100%" align="center" class="edittable">
          <tr id="spe-0">
            <td class="right">指定区域（省）</td>
            <td>
              
              <div id="area_province"></div>
            </td>
          </tr>
          <tr id="spe-1">
            <td class="right">指定区域（市）</td>
            <td>
              <div id="area_city"></div>
            </td>
          </tr>
          <tr id="spe-2">
            <td class="right">指定区域（区）</td>
            <td>
              <div id="area_region"></div>
            </td>
          </tr>    
          <tr id="spe-3">
            <td class="right">指定快递方式</td>
            <td>
              <select name="default_shipping_id" id="default_shipping_id">
                <!-- <option value="0">用户自选</option> -->
                <?php $_from = $this->_var['shipping_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['item']):
?>
                <option value="<?php echo $this->_var['item']['shipping_id']; ?>" code="<?php echo $this->_var['item']['shipping_code']; ?>"><?php echo $this->_var['item']['shipping_name']; ?></option>
                <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
              </select>
            </td>
          </tr>
          <tr id="spe-8">
              <td class="right">费用计算方式:</td>
              <td>
                <label><input type="radio" checked="true" name="fee_compute_mode" value="by_weight">按重量计算</label>
                <label><input type="radio" name="fee_compute_mode" value="by_number">按商品件数计算</label>
              </td>
           </tr>          
           <!--<tr>
            <td class="right">默认区域运费</td>
            <td>
              <input type="text" name="default_shipping_fee" value="<?php echo $this->_var['goods']['default_shipping_fee']; ?>" size="20" />
            </td>
          </tr>
          <tr>
            <td class="right">默认区域运费超出每次加价</td>
            <td>
              <input type="text" name="default_step_fee" value="<?php echo $this->_var['goods']['default_step_fee']; ?>" size="20" />
            </td>
          </tr> -->                
          <tr id="spe-4">
            <td class="right">指定区域运费</td>
            <td>
              <input type="text" name="spe_shipping_fee" value="<?php echo $this->_var['goods']['spe_shipping_fee']; ?>" size="20" />
            </td>
          </tr>
          <tr id="spe-5">
            <td class="right">指定区域运费超出每次加价</td>
            <td>
              <input type="text" name="spe_step_fee" value="<?php echo $this->_var['goods']['spe_step_fee']; ?>" size="20" />
            </td>
          </tr>
          <tr>
            <td class="right"></td>
            <td>
              <input type="button" id="spe-clear" value="添加" onclick="clearSpeFee()">
              <input type="button" id="spe-6" value="确定" onclick="submitSpeFee()">
              <input type="button" id="spe-7" value="取消" onclick="cancelSpeFee()">
            </td>
          </tr>
          <tr>
            <td class="right"></td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td class="right"></td>
            <td>
              <table width="100%" align="center">
                <thead>
                  <tr>
                    <th width="40%" align="left">配送区域</th>
                    <th width="15%" align="left">快递方式</th>
                    <th width="15%" align="left">运费</th>
                    <th width="15%" align="left">每次加价</th>
                    <th width="15%" align="left">操作</th>
                  </tr>
                </thead>
                <tbody id="express-items"></tbody>
              </table>
            </td>
          </tr>
        </table>
      </div>
      </div>

            <table class="edittable">
				 <tr>
						<td class="right">&nbsp;</td>
						<td>
                        <input name="goods_id" type="hidden" value="<?php echo $this->_var['goods']['goods_id']; ?>" />
						<input name="op" type="hidden" value="goods" />
                        <input name="act" type="hidden" value="<?php echo $this->_var['form_act']; ?>" />
                        <input name="express_items" type="hidden" id="J_express" value="" />

                        <input type="submit" value="保 存" class="btn"></td>
					</tr>
            </table>
          </form>
			<script type="text/javascript" language="javascript"> 
  // 运费模板
  var spe_region   = [<?php echo $this->_var['goods']['spe_region']; ?>];
  var all_province = <?php echo $this->_var['all_province']; ?>;
  var all_citys    = <?php echo $this->_var['all_citys']; ?>;
  var all_regions  = <?php echo $this->_var['all_regions']; ?>;

  var express_items = <?php echo $this->_var['goods']['express']; ?>;

  var method = null;
  var row_id = 0;

  f_createRows();
  f_showhide(0);  

  function clearSpeFee(){
    document.getElementById('spe-clear').style.display='none';
    var val = 1;
    generateIpt(all_province,"area_province",'province-'+val,val,'spe_province[]','setCitys(this);');
    method = 'add';
    f_showhide(1);
  }

  function cancelSpeFee(){
    document.getElementById('spe-clear').style.display = 'block';
    document.getElementById('area_province').innerHTML = '';
    document.getElementById('area_city').innerHTML     = '';
    document.getElementById('area_region').innerHTML   = '';

    method = null;
    f_showhide(0);
  }
  // 创建
  function submitSpeFee(){
    var spe_provinces = document.forms['myform'].elements['spe_province[]'] || [];
    var spe_citys     = document.forms['myform'].elements['spe_city[]'] || [];
    var spe_regions   = document.forms['myform'].elements['spe_region[]'] || [];

    var titles    = [];
    var provinces = [];
    var citys     = [];
    var regions   = [];
    // 处理省
    // 可能会是一个，就不是数组格式
    var len = spe_provinces.length;
    if(typeof len == 'undefined'){
        var ckd = spe_provinces.checked;
        if(ckd)
        {
          provinces.push(parseInt(spe_provinces.value));
        }
    }    
    for (var i = 0; i < len; i++) {
        var ckd = spe_provinces[i].checked;
        if(ckd)
        {
          provinces.push(parseInt(spe_provinces[i].value));
          titles.push(spe_provinces[i].parentNode.innerText);
        }
    }
    if(provinces.length==0){
      alert('请设置省市区等相关信息');
      return;
    }    
    // 处理citys
    // 可能会是一个，就不是数组格式
    var len = spe_citys.length;
    if(typeof len == 'undefined'){
        var ckd = spe_citys.checked;
        if(ckd)
        {
          citys.push(parseInt(spe_citys.value));
        }
    }
    for (var i = 0; i < len; i++) {
        var ckd = spe_citys[i].checked;
        if(ckd)
        {
          citys.push(parseInt(spe_citys[i].value));
        }
    }
    // 处理区域
    // 可能会是一个，就不是数组格式
    var len = spe_regions.length;
    if(typeof len == 'undefined'){
        var ckd = spe_regions.checked;
        if(ckd)
        {
          regions.push(parseInt(spe_regions.value));
        }
    }     
    for (var i = 0; i < len; i++) {
        var ckd = spe_regions[i].checked;
        if(ckd)
        {
          regions.push(parseInt(spe_regions[i].value));
        }
    }


    var title = titles.join(' ');
    var ele          = document.forms['myform'].elements['default_shipping_id'];
    var express_name  = ele.options[ele.selectedIndex].text;
    var express_id   = ele.options[ele.selectedIndex].value;
    var express_code = ele.options[ele.selectedIndex].getAttribute('code');
    var spe_shipping_fee = document.forms['myform'].elements['spe_shipping_fee'].value;
    var spe_step_fee = document.forms['myform'].elements['spe_step_fee'].value;

    var fee_compute_mode = '';
    var ele = document.forms['myform'].elements['fee_compute_mode'];
    for (var i = 0; i < ele.length; i++) {
        var ckd = ele[i].checked;
        if(ckd)
        {
          fee_compute_mode = ele[i].value;
        }
    }
    // 数据到数组
    var row              = {};
    row.title            = title;
    row.spe_shipping_fee = spe_shipping_fee;
    row.spe_step_fee     = spe_step_fee;
    row.express_name     = express_name;
    row.express_id       = express_id;
    row.express_code     = express_code;
    row.fee_compute_mode = fee_compute_mode;
    row.provinces        = provinces;
    row.citys            = citys;
    row.regions          = regions;

    // 添加 OR 编辑
    if(method == 'add'){
      express_items.push(row);
    }
    else{
      express_items[row_id] = row;
    }

    document.forms['myform'].elements['express_items'].value = JSON.stringify(express_items);//express_items.toJSONString();
    // 重新生成行
    f_createRows();
    //隐藏
    cancelSpeFee();
  }
  // 生成数据表格
  function f_createRows(){
    // document.forms['myform'].elements['express_items'].value = express_items.toJSONString();
    var ele = document.getElementById('express-items');
    ele.innerHTML = '';
    for (var i = 0; i < express_items.length; i++) {
      var row = express_items[i];
      var provinces = row.provinces;

      var titles = [];
      for (var n in provinces) {
        titles.push(getRegion(all_province,provinces[n]));
      }
      var title = titles.join(' ');
      // 创建行
      var node = document.createElement('tr');
      var td = document.createElement('td');
      td.innerHTML = title;
      node.appendChild(td);

      var td0 = document.createElement('td');
      td0.innerHTML = row.express_name;
      node.appendChild(td0);

      var td1 = document.createElement('td');
      td1.innerHTML = row.spe_shipping_fee;
      node.appendChild(td1);

      var td2 = document.createElement('td');
      td2.innerHTML = row.spe_step_fee;
      node.appendChild(td2);

      var td3 = document.createElement('td');

      var btn_edit = document.createElement('input');
      btn_edit.setAttribute('type','button');
      btn_edit.setAttribute('value','编辑');
      btn_edit.setAttribute('onclick','f_editRow('+i+')');
      td3.appendChild(btn_edit);
      var btn_del = document.createElement('input');
      btn_del.setAttribute('type','button');
      btn_del.setAttribute('value','删除');
      btn_del.setAttribute('onclick','f_delRow('+i+')');
      td3.appendChild(btn_del);

      node.appendChild(td3);

      ele.appendChild(node);      
    }
  }
  // 编辑行
  function f_editRow(id){
    cancelSpeFee();

    method = 'edit';
    row_id = id;
    var row = express_items[id];

    var provinces = row.provinces;
    var citys     = row.citys;
    var regions   = row.regions;

    var express_id       = row.express_id;
    var spe_shipping_fee = row.spe_shipping_fee;
    var spe_step_fee     = row.spe_step_fee;
    var fee_compute_mode = row.fee_compute_mode;

    var ele = document.forms['myform'].elements['fee_compute_mode'];
    for (var i = 0; i < ele.length; i++) {
        if(fee_compute_mode == ele[i].value)
        {
          ele[i].click();
        }
    }

    // 设置select选中
    var obj = document.getElementById("default_shipping_id");
    for(var i=0;i<obj.length;i++){
      if(obj[i].value == express_id)
        obj[i].selected = true;
    }
    // 设置值
    document.forms['myform'].elements['spe_shipping_fee'].value = spe_shipping_fee;
    document.forms['myform'].elements['spe_step_fee'].value = spe_step_fee;
    // 创建checkbox
    var val = 1;
    generateIpt(all_province,"area_province",'province-'+val,val,'spe_province[]','setCitys(this);'); 

    for (var i = 0; i < provinces.length; i++) {
      val = provinces[i];
      var spe_provinces = document.forms['myform'].elements['spe_province[]'] || [];
      for (var n = 0; n < spe_provinces.length; n++) {
         var obj = spe_provinces[n];
         if(obj.value == val){
          obj.click();
         }
      }
    }
    for (var i = 0; i < citys.length; i++) {
      val = citys[i];
      var spe_citys     = document.forms['myform'].elements['spe_city[]'] || [];
      var len = spe_citys.length;
      if(typeof len == 'undefined'){
          if(spe_citys.value == val)
          {
            spe_citys.click();
          }
      }
      for (var n = 0; n < len; n++) {
         var obj = spe_citys[n];
         if(obj.value == val){
          obj.click();
         }
      }
    }
    for (var i = 0; i < regions.length; i++) {
      val = regions[i];
      var spe_regions   = document.forms['myform'].elements['spe_region[]'] || [];
      var len = spe_regions.length;
      if(typeof len == 'undefined'){
          if(spe_regions.value == val)
          {
            spe_regions.click();
          }
      }      
      for (var n = 0; n < spe_regions.length; n++) {
         var obj = spe_regions[n];
         if(obj.value == val){
          obj.click();
         }
      }
    }
    f_showhide(1);   
  }
  // 删除行
  function f_delRow(id){
    express_items.splice(id, 1);
    document.forms['myform'].elements['express_items'].value = express_items.toJSONString();
    cancelSpeFee();
    f_createRows();
  }
  function f_resetCheckbox(){
    var spe_regions = document.forms['myform'].elements['spe_region[]'];
    for (var i in spe_regions) {
        spe_regions[i].setAttribute('checked',false);
    }
  }

  function f_showhide(val){
    var display = val ? 'table-row' : 'none';
    for (var i = 0; i < 9; i++) {
      document.getElementById('spe-'+i).style.display=display;
    }
    var display = val ? 'none' : 'table-row';
    document.getElementById('spe-clear').style.display=display;
  }
  // 设置要选的城市
  function setCitys(ipt){
    var val = parseInt(ipt.value);
    var strs = '';
    var checked = ipt.checked ? 1 : 0;
    var existed = document.getElementById('city-'+val) == null ? 0 : 1;

    if(checked && !existed){
      generateIpt(all_citys,"area_city",'city-'+val,val,'spe_city[]','setRegion(this);');
    }
    else{
      var obj = document.forms['myform'].elements['spe_city[]'];

      var len = obj.length;
      if(typeof len == 'undefined'){
          if(obj.getAttribute('data-pid') == val && obj.checked)
          {
            obj.click();
          }
      }

      for (var i = 0; i < len; i++) {
        if(obj[i].getAttribute('data-pid') == val && obj[i].checked)
        {
          obj[i].click();
        }
      }

      var node = document.getElementById('city-'+val);
      document.getElementById("area_city").removeChild(node);
    }
  }

  // 设置要选的区域
  function setRegion(ipt){
    var val = parseInt(ipt.value);
    var strs = '';
    var checked = ipt.checked ? 1 : 0;
    var existed = document.getElementById('region-'+val) == null ? 0 : 1;

    if(checked && !existed){
       generateIpt(all_regions,"area_region",'region-'+val,val,'spe_region[]');
    }
    else{
      var node = document.getElementById('region-'+val);
      document.getElementById("area_region").removeChild(node);
    }
  }

  function generateIpt(data,ele,id,pid,ipt_name,fun){
      var node = document.createElement('div');
      node.setAttribute('id',id);
      for (var i = 0; i < data.length; i++) {
        var parent_id = parseInt(data[i].parent_id);
        if( parent_id == pid){
          var label = document.createElement('label');
          var input = document.createElement('input');
          var name  = document.createTextNode(data[i].region_name);

          input.setAttribute('type','checkbox');
          input.setAttribute('name',ipt_name);
          input.setAttribute('value',data[i].region_id);
          input.setAttribute('data-pid',pid);
          if(fun)
            input.setAttribute('onclick',fun);

          label.appendChild(input);
          label.appendChild(name);

          node.appendChild(label);
        }
      }
      document.getElementById(ele).appendChild(node);
  }

  // 从数组中获取region_name
  function getRegion(data,region_id){
    for (var i = 0; i < data.length; i++) {
      if(data[i].region_id == region_id){
        return data[i].region_name;
      }
    }
    return '';
  }
  //选中region
  function handleCheckRegion()
  {
    var spe_regions = document.forms['myform'].elements['spe_region[]'];
    for (var i in spe_regions) {
      var val = spe_regions[i].value;
      if(in_array(val,spe_region))
      {
        spe_regions[i].setAttribute('checked',true);
      }
    }
  }

  function in_array(stringToSearch, arrayToSearch) {
   for (s = 0; s < arrayToSearch.length; s++) {
    thisEntry = arrayToSearch[s].toString();
    if (thisEntry == stringToSearch) {
     return true;
    }
   }
   return false;
  }  
  // 运费模板end
  function getAttrList(goodsId)
  {
      var selGoodsType = document.forms['myform'].elements['goods_type'];
      if (selGoodsType != undefined)
      {
          var goodsType = selGoodsType.options[selGoodsType.selectedIndex].value;
		  Ajax.call('index.php?op=goods&act=get_attr', 'goods_id=' + goodsId + "&goods_type=" + goodsType, setAttrList, "GET", "JSON");
      }
  }
  function setAttrList(result, text_result)
  {
    document.getElementById('tbody-goodsAttr').innerHTML = result.content;
  }
		function hideimg(imgId,imgurl)
		 { 

			   var imgid=document.getElementById(imgId);

			  imgid.style.display='none';

			  var imgurl=document.getElementById(imgurl);

			  imgurl.value="";

		}

       function remove_img(id)
	  {
		getStatusUrl = 'index.php?op=goods&act=del_image&id='+id;
		//getStatusUrl = 'suppliers.php?act=delete_pic&pic='+data+'&id='+id;
		$.ajax(
		{
			  url: getStatusUrl,
			  dataType: 'json',
			  global: false,
			  success: function(data)
			  {
				 $("#gallery_"+id).hide();
				 $("#"+id+"").attr("checked",false);

				//document.getElementById("pic_"+id).style.display = "none";

			  },
			  error: function(XMLHttpRequest,textStatus, errorThrown){

							//alert(XMLHttpRequest.responsetext);

							//alert(textStatus);

							//alert(errorThrown);
			  }

		});	

	 }
  function change_discount_type(value){
    var theForm=document.forms['myform'];
    var team_price=parseFloat(theForm.team_price.value);
    if( isNaN(team_price) || team_price<=0){
      alert('请先填写团购价格');
      theForm.discount_type.value='0';
      theForm.team_price.focus();
      return ;
    } 
    if(value==2){
      document.getElementById('discount_amount').style.display='block';
    }else{
      document.getElementById('discount_amount').style.display='none';
    }  
  }
  function discount_amount_blur(value){
    var theForm=document.forms['myform'];
    var team_price=theForm.team_price.value;
    if(team_price==''){
      alert('请先填写团购价格');
      theForm.discount_type.value='0';
      theForm.team_price.focus();
      return ;
    } 
    if(value==''){
      alert('请先填写优惠价格');
      return ;
    }
    if(parseFloat(value)>=parseFloat(team_price)){
      alert('优惠价格不能大于等于团购价格');
      return ;
    }
    if(parseFloat(value)<=0){
      alert('优惠价格不能小于等于0');
      return ;
    }
  }
			 </script>

            

            <!-- <div id="show_html3" style="width:1000px; height:400px; border:1px solid #000; margin-top:10px;display:none;margin-left:40px;">

         <form action="" method="post"> &nbsp;&nbsp; &nbsp;&nbsp;

          文章标题： &nbsp;&nbsp;<input type="text" name="title">&nbsp;&nbsp;

          <input type="submit" name="subcheck" value="搜素">

          

          <ul style="margin-left:170px;">

          <li style="list-style:none; float:left; padding-right:270px;">可选文章</li>

           <li style="list-style:none; float:left; padding-right:270px;">操作</li>

            <li style="list-style:none; float:left;">跟该商品关联的文章</li>

          </ul>

            </div>-->

		</div>

</div>
 <?php endif; ?>
        <?php if ($this->_var['action'] == 'goods_trash'): ?>    
 <div class="main" id="main">
		<div class="maintop">
			<img src="templates/images/title_goods.png" /><span>商品管理</span>
		</div><div class="maincon">
			<div class="contitlelist">
            	<span>商品回收站</span>
                
            </div>
			<div class="conbox">

				<table cellspacing="0" cellpadding="0" class="listtable">

					<tr>

					

					  <th>货号</th>

					  <th class="left">商品名称</th>

					  <th class="left">商品价格</th>

					
					  <th>操作列</th>
					</tr>
                      <?php $_from = $this->_var['goods_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'goods');if (count($_from)):
    foreach ($_from AS $this->_var['goods']):
?>
					<tr>
					  <td class="middle"><?php echo $this->_var['goods']['goods_sn']; ?></td>
                      <td><?php echo $this->_var['goods']['goods_name']; ?></td>
					  <td><?php echo $this->_var['goods']['shop_price']; ?></td>
                     
              
					  <td class="middle">
                      <!--<a href="/goods.php?id=<?php echo $this->_var['goods']['goods_id']; ?>">预览</a>
                      | -->
                       <a href="?op=goods&act=restore_goods&goods_id=<?php echo $this->_var['goods']['goods_id']; ?>" onclick="return confirm('确定要还原次商品吗');">还原</a>|
                      <a href="?op=goods&act=drop_goods&goods_id=<?php echo $this->_var['goods']['goods_id']; ?>" onclick="return confirm('确定要把该商品删除吗');">删除</a>  
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