<!-- $Id: shipping_list.htm 17043 2010-02-26 10:40:02Z sxc_shop $ -->
<?php if ($this->_var['full_page']): ?>
<?php echo $this->fetch('pageheader.htm'); ?>
<?php echo $this->smarty_insert_scripts(array('files'=>'../js/utils.js,listtable.js')); ?>
<!-- start payment list -->
<div class="form-div">
  <form action="javascript:search_ad()" name="searchForm">
    <img src="images/icon_search.gif" width="26" height="22" border="0" alt="SEARCH" />
    类别 <select name="type">
    <option value="">请选择</option>
     
      <option value="1">商家</option>
      <option value="2">自营</option>
     
    </select>
    &nbsp;&nbsp;自提点关键字&nbsp;&nbsp;
  <input name="keywords" type="text" />
  
    <input type="submit" value="<?php echo $this->_var['lang']['button_search']; ?>" class="button" />
  </form>
</div>
<div class="list-div" id="listDiv">
<?php endif; ?>
<table cellspacing='1' cellpadding='3'>
  <tr>
    <th>店铺名称</th>
    <th>所属</th>
    <th>地址</th>
    <th>电话</th>
    <th>自提点管理员微信昵称</th>
    <th><?php echo $this->_var['lang']['handler']; ?></th>
  </tr>
  <?php $_from = $this->_var['point_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['item']):
?>
  <tr>
    <td align="center" nowrap="true" class="first-cell">
      <?php echo $this->_var['item']['shop_name']; ?>
    </td>
    <td align="center"><?php if ($this->_var['item']['suppliers_id']): ?>商家<?php else: ?>自营<?php endif; ?></td>
    <td align="center">
      <?php echo $this->_var['item']['province']; ?><?php echo $this->_var['item']['city']; ?><?php echo $this->_var['item']['district']; ?><?php echo $this->_var['item']['address']; ?>
    </td>
    <td align="center"><?php echo $this->_var['item']['tel']; ?></td>
    <td align="center">&nbsp;</td>
    
    <td align="center" nowrap="true">
      <a href="shipping_point.php?act=edit&id=<?php echo $this->_var['item']['id']; ?>" title="编辑">编辑</a>
     
      <a href="javascript:;" onclick="listTable.remove(<?php echo $this->_var['item']['id']; ?>, '确定要删除吗')" title="删除">删除</a>
    <a href="shipping_point.php?act=join_qr_code&id=<?php echo $this->_var['item']['id']; ?>"  title="绑定自提点管理员微信">绑定自提点管理员微信</a>
    </td>
  </tr>
  <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
</table>
<?php if ($this->_var['full_page']): ?>
</div>
<!-- end payment list -->
<script type="Text/Javascript" language="JavaScript">
<!--


onload = function()
{
    // 开始检查订单
    startCheckOrder();
}

//-->
</script>
<script language="JavaScript">
    function search_ad()
    {
        listTable.filter['type'] = Utils.trim(document.forms['searchForm'].elements['type'].value);
		listTable.filter['keywords'] = Utils.trim(document.forms['searchForm'].elements['keywords'].value);
	
        listTable.loadList();
    }
</script>
<?php echo $this->fetch('pagefooter.htm'); ?>
<?php endif; ?>