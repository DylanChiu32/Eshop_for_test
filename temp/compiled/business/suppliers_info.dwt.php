<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="Generator" content="haohaios v1.0" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>商家管理平台</title>
<link href="templates/css/layout.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../js/common.js"></script>
<script type="text/javascript" src="../js/user.js"></script>
<script type="text/javascript" src="../js/region.js"></script>
<script type="text/javascript" src="../js/utils.js"></script>
<script type="text/javascript" src="../js/jquery.js"></script>
<script type="text/javascript" src="../js/haohaios.js"></script>
<script type="text/javascript" src="templates/js/main.js"></script>
<script type="text/javascript" src="templates/js/supp.js"></script>
<script type="text/javascript" src="../<?php echo $this->_var['admin_path']; ?>/js/listtable.js"></script>


<script>
var process_request = "<?php echo $this->_var['lang']['process_request']; ?>";
</script>
</head>
<body onload="pageheight()">
	<?php echo $this->fetch('library/lift_menu.lbi'); ?>
  <?php if ($this->_var['action'] == 'ad'): ?>
  <div class="main" id="main">
		<div class="maintop">
			<img src="templates/images/title_goods.png" /><span>广告轮播</span>
		</div>
        <div class="maincon">
			<div class="contitlelist">
            	<span>广告列表</span>
                 <div class="titleright"><a href="?act=add_ad">新增广告</a></div>
            </div>
		  <div class="conbox">
<table cellspacing="0" cellpadding="0" class="listtable">
    <tr>
      <th class="left">名称</th>
      <th class="left">图片</th>
      <th class="left">连接</th>
      <th class="left">排序</th>
      <th class="left">操作</th>
    </tr>
    <?php $_from = $this->_var['ad_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'item');$this->_foreach['id'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['id']['total'] > 0):
    foreach ($_from AS $this->_var['item']):
        $this->_foreach['id']['iteration']++;
?>
    <tr>
      <td><?php echo $this->_var['item']['name']; ?></td>
      <td><img src='/<?php echo $this->_var['item']['photo_file']; ?>' width="100" height="50"></td>
      <td><?php echo $this->_var['item']['link']; ?></td>
      <td><?php echo $this->_var['item']['sort_order']; ?></td>
      <td>
       <a href="?act=edit_ad&id=<?php echo $this->_var['item']['photo_id']; ?>">编辑</a> |
    <a href="?act=ad_delete&id=<?php echo $this->_var['item']['photo_id']; ?>" onclick="return confirm('确定要此操作吗');">删除</a> 
      </td>
    </tr>
    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
  </table>
        </div>
       </div>
        </div>
 <?php endif; ?>
 <?php if ($this->_var['action'] == 'edit_ad' || $this->_var['action'] == 'add_ad'): ?>
     <div class="main" id="main">
		<div class="maintop">
			<img src="templates/images/title_article.png" /><span>广告轮播</span>
		</div>
		<div class="maincon">
        		<?php if ($this->_var['action'] == 'edit_ad'): ?>
				<div class="contitlelist"><span>编辑广告</span><div class="titleright"><a href="?act=ad">返回列表</a></div></div>
                <?php else: ?>
                <div class="contitlelist"><span>添加广告</span><div class="titleright"><a href="?act=ad">返回列表</a></div></div>
                <?php endif; ?>
			<div class="conbox">
            <form action="suppliers.php" enctype="multipart/form-data" method="post" name="myform" onsubmit="return checkad();">
           <table cellspacing="0" cellpadding="0" class="edittable">
					<tr>
						<td class="right">名称：</td>
						<td> 
                        <input type="text" name="name" value="<?php echo $this->_var['ad_info']['name']; ?>" class="input" size="35" /></td>
                    	</tr>
                    <tr>
						<td class="right">图片：</td>
						<td> 
                        <input id="photo_file" name="photo_file" type="file" multiple="true">&nbsp;&nbsp;大小970像素*320像素　  
                        <?php if ($this->_var['ad_info']['photo_file']): ?><a href="/<?php echo $this->_var['ad_info']['photo_file']; ?>" target="_blank">查看</a><?php endif; ?>
                        
                        </td>
					</tr>
                    <tr>
						<td class="right">连接：</td>
						<td>
<input type="text" name="link" value="<?php echo $this->_var['ad_info']['link']; ?>" class="input" size="35" />
                        </td> 
					</tr>
                    <tr>
						<td class="right">排序：</td>
						<td>
<input type="text" name="sort_order" value="<?php echo $this->_var['ad_info']['sort_order']; ?>" class="input" size="35" />
                        </td> 
					</tr>
                    <tr>
						<td class="right">&nbsp;</td>
						<td>
                        <input type="hidden" name="suppliers_id" value="<?php echo $this->_var['suppliers_id']; ?>">
                        <input type="hidden" name="photo_id" value="<?php echo $this->_var['ad_info']['photo_id']; ?>">
                        <input type="hidden" name="act"  value="<?php echo $this->_var['status']; ?>">
                		<input type="submit" value="<?php if ($this->_var['action'] == 'edit_ad'): ?>修 改 <?php else: ?>添 加<?php endif; ?>" class="btn" name="subsupp">
                        </td>
					</tr>
                    </table>
                    </form>
             </div>

  </div>

  </div>         

      <?php endif; ?> 
      
    
<?php if ($this->_var['action'] == 'factoryauthorized'): ?>
  <div class="main" id="main">
		<div class="maintop">
			<img src="templates/images/title_goods.png" /><span>厂家授权书</span>
		</div>
        <div class="maincon">
			<div class="contitlelist">
            	<span>授权书</span>
                 <div class="titleright"><a href="?act=add_factoryauthorized">新增授权</a></div>
            </div>
		  <div class="conbox">
<table cellspacing="0" cellpadding="0" class="listtable">
    <tr>
      <th class="left"> 名称</th>
      <th class="left">文件</th>
      <th class="left">上传时间</th>
      <th class="left">状态</th>
      <th class="left">操作</th>
    </tr>
    <?php $_from = $this->_var['ad_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'item');$this->_foreach['id'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['id']['total'] > 0):
    foreach ($_from AS $this->_var['item']):
        $this->_foreach['id']['iteration']++;
?>
    <tr>
      <td><?php echo $this->_var['item']['name']; ?></td>
      <td><img src='/<?php echo $this->_var['item']['pic']; ?>' width="100" height="50"></td>
      <td><?php echo $this->_var['item']['add_time']; ?></td>
      <td><?php if ($this->_var['item']['is_checked'] == 1): ?>已核实<?php else: ?>未核实<?php endif; ?></td>
      <td>
      <?php if ($this->_var['item']['is_checked'] == 1): ?>
      不可修改
      <?php else: ?>
       <a href="?act=edit_factoryauthorized&id=<?php echo $this->_var['item']['id']; ?>">编辑</a> |
    <a href="?act=factoryauthorized_delete&id=<?php echo $this->_var['item']['id']; ?>" onclick="return confirm('确定要此操作吗');">删除</a> 
    <?php endif; ?>
      </td>
    </tr>
    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
  </table>
        </div>
       </div>
        </div>
 <?php endif; ?>
 <?php if ($this->_var['action'] == 'edit_factoryauthorized' || $this->_var['action'] == 'add_factoryauthorized'): ?>
     <div class="main" id="main">
		<div class="maintop">
			<img src="templates/images/title_article.png" /><span>厂家授权书</span>
		</div>
		<div class="maincon">
        		<?php if ($this->_var['action'] == 'edit_factoryauthorized'): ?>
				<div class="contitlelist"><span>编辑授权书</span><div class="titleright"><a href="?act=factoryauthorized">返回列表</a></div></div>
                <?php else: ?>
                <div class="contitlelist"><span>添加授权书</span><div class="titleright"><a href="?act=factoryauthorized">返回列表</a></div></div>
                <?php endif; ?>
			<div class="conbox">
            <form action="suppliers.php" enctype="multipart/form-data" method="post" name="myform" onsubmit="return checkad_factoryauthorized();">
           <table cellspacing="0" cellpadding="0" class="edittable">
					<tr>
						<td class="right">名称：</td>
						<td> 
                        <input type="text" name="name" value="<?php echo $this->_var['ad_info']['name']; ?>" class="input" size="35" /></td>
                    	</tr>
                    <tr>
						<td class="right">授权书：</td>
						<td> 
                        <input id="photo_file" name="photo_file" type="file" multiple="true">&nbsp;&nbsp;大小建议小于1M&nbsp;&nbsp;
                        <?php if ($this->_var['ad_info']['pic']): ?><a href="/<?php echo $this->_var['ad_info']['pic']; ?>" target="_blank">查看</a><?php endif; ?>
                        
                        </td>
					</tr>
                    <tr>
						<td class="right">&nbsp;</td>
						<td>
                        <input type="hidden" name="suppliers_id" value="<?php echo $this->_var['suppliers_id']; ?>">
                        <input type="hidden" name="photo_id" value="<?php echo $this->_var['ad_info']['id']; ?>">
                        <input type="hidden" name="act"  value="<?php echo $this->_var['status']; ?>">
                		<input type="submit" value="<?php if ($this->_var['action'] == 'edit_ad'): ?>修 改 <?php else: ?>添 加<?php endif; ?>" class="btn" name="subsupp">
                        </td>
					</tr>
                    </table>
                    </form>
             </div>
  </div>
  </div>         
      <?php endif; ?> 





<?php if ($this->_var['action'] == 'trademark'): ?>
  <div class="main" id="main">
		<div class="maintop">
			<img src="templates/images/title_goods.png" /><span>商标注册</span>
		</div>
        <div class="maincon">
			<div class="contitlelist">
            	<span>商标</span>
                 <div class="titleright"><a href="?act=add_trademark">新增商标</a></div>
            </div>
		  <div class="conbox">
<table cellspacing="0" cellpadding="0" class="listtable">
    <tr>
      <th class="left">名称</th>
      <th class="left">商标</th>
      <th class="left">上传时间</th>
      <th class="left">状态</th>
      <th class="left">操作</th>
    </tr>
    <?php $_from = $this->_var['ad_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'item');$this->_foreach['id'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['id']['total'] > 0):
    foreach ($_from AS $this->_var['item']):
        $this->_foreach['id']['iteration']++;
?>
    <tr>
      <td><?php echo $this->_var['item']['name']; ?></td>
      <td><img src='/<?php echo $this->_var['item']['pic']; ?>' width="100" height="50"></td>
      <td><?php echo $this->_var['item']['add_time']; ?></td>
      <td><?php if ($this->_var['item']['is_checked'] == 1): ?>已核实<?php else: ?>未核实<?php endif; ?></td>
      <td>
      <?php if ($this->_var['item']['is_checked'] == 1): ?>
      不可修改
      <?php else: ?>
       <a href="?act=edit_trademark&id=<?php echo $this->_var['item']['id']; ?>">编辑</a> |
    <a href="?act=trademark_delete&id=<?php echo $this->_var['item']['id']; ?>" onclick="return confirm('确定要此操作吗');">删除</a> 
    <?php endif; ?>
      </td>
    </tr>
    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
  </table>
        </div>
       </div>
        </div>
 <?php endif; ?>
 <?php if ($this->_var['action'] == 'edit_trademark' || $this->_var['action'] == 'add_trademark'): ?>
     <div class="main" id="main">
		<div class="maintop">
			<img src="templates/images/title_article.png" /><span>商标注册</span>
		</div> 
		<div class="maincon">
        		<?php if ($this->_var['action'] == 'edit_trademark'): ?>
				<div class="contitlelist"><span>编辑商标</span><div class="titleright"><a href="?act=trademark">返回列表</a></div></div>
                <?php else: ?>
                <div class="contitlelist"><span>添加商标</span><div class="titleright"><a href="?act=trademark">返回列表</a></div></div>
                <?php endif; ?>
			<div class="conbox">
            <form action="suppliers.php" enctype="multipart/form-data" method="post" name="myform" onsubmit="return checkad_factoryauthorized();">
           <table cellspacing="0" cellpadding="0" class="edittable">
					<tr>
						<td class="right">名称：</td>
						<td> 
                        <input type="text" name="name" value="<?php echo $this->_var['ad_info']['name']; ?>" class="input" size="35" /></td>
                    	</tr>
                    <tr>
						<td class="right">商标：</td>
						<td> 
                        <input id="photo_file" name="photo_file" type="file" multiple="true">&nbsp;&nbsp;大小建议小于1M&nbsp;&nbsp;
                        <?php if ($this->_var['ad_info']['pic']): ?><a href="/<?php echo $this->_var['ad_info']['pic']; ?>" target="_blank">查看</a><?php endif; ?>
                         
                        </td>
					</tr>
                    <tr>
						<td class="right">&nbsp;</td>
						<td>
                        <input type="hidden" name="suppliers_id" value="<?php echo $this->_var['suppliers_id']; ?>">
                        <input type="hidden" name="photo_id" value="<?php echo $this->_var['ad_info']['id']; ?>">
                        <input type="hidden" name="act"  value="<?php echo $this->_var['status']; ?>">
                		<input type="submit" value="<?php if ($this->_var['action'] == 'edit_ad'): ?>修 改 <?php else: ?>添 加<?php endif; ?>" class="btn" name="subsupp">
                        </td>
					</tr>
                    </table>
                    </form>
             </div>
  </div>
  </div>         
      <?php endif; ?> 
      
      
      <?php if ($this->_var['action'] == 'my_qualification'): ?>
     <div class="main" id="main">
		<div class="maintop">
			<img src="templates/images/title_article.png" /><span>我的资质</span>
		</div> 
		<div class="maincon">
        		<div class="contitlelist"><span>我的资质</span></div>
            <div class="conbox">
            <form action="suppliers.php" enctype="multipart/form-data" method="post" name="myform" onsubmit="return checkad_factoryauthorized();">
           <table cellspacing="0" cellpadding="0" class="edittable" style="font-size:16px">
					<tr>
          <td align="right" width="400" height="100">企业营业执照：</td>
          <td>
          <?php if ($this->_var['supp_list']['business_license']): ?>
          <a href="/<?php echo $this->_var['supp_list']['business_license']; ?>"><img src="/<?php echo $this->_var['supp_list']['business_license']; ?>" width="50" height="50"></a>
          <?php endif; ?>
          </td>
        </tr>
        
        
         <tr>
          <td align="right" height="100">组织机构代码证：</td>
          <td>
          <?php if ($this->_var['supp_list']['business_scope']): ?>
          <a href="/<?php echo $this->_var['supp_list']['business_scope']; ?>"><img src="/<?php echo $this->_var['supp_list']['business_scope']; ?>" width="50" height="50"></a>
          <?php endif; ?>
          </td>
        </tr>
        
         <tr>
          <td align="right" height="100">企业法人身份证：</td>
          <td>
          <?php if ($this->_var['supp_list']['cards']): ?>
          <a href="/<?php echo $this->_var['supp_list']['cards']; ?>"><img src="/<?php echo $this->_var['supp_list']['cards']; ?>" width="50" height="50"></a>
          <?php endif; ?>
          </td>
        </tr>
        
         <tr>
          <td align="right" height="100">税务登记证：</td>
          <td>
          <?php if ($this->_var['supp_list']['certificate']): ?>
          <a href="/<?php echo $this->_var['supp_list']['certificate']; ?>"><img src="/<?php echo $this->_var['supp_list']['certificate']; ?>" width="50" height="50"></a>
          <?php endif; ?>
          </td>
        </tr>
                    </table>
                    </form>
             </div>
  </div>
  </div>         
      <?php endif; ?> 

</body>
<script>
function checkad_factoryauthorized()
{
	if(document.myform.name.value=='')
	{
		alert('请输入名称');
		return false;
	}
}
function checkad()
{
	if(document.myform.name.value=='')
	{
		alert('请输入名称');
		return false;
	}
	if(document.myform.link.value=='')
	{
		alert('请输入广告链接');
		return false;
	}
	return true;
}
</script>
</html>