<!-- $Id: articlecat_info.htm 16752 2009-10-20 09:59:38Z wangleisvn $ -->


<?php echo $this->fetch('pageheader.htm'); ?>


<div class="main-div">


<form method="post" action="weixin_menu.php" name="theForm"  onsubmit="return validate()">


<table cellspacing="1" cellpadding="3" width="100%">


  <tr>


    <td class="label">上级菜单</td>


    <td>


      <select name="parent_id" onchange="catChanged()" <?php if ($this->_var['disabled']): ?>disabled="disabled"<?php endif; ?> >


        <option value="0">顶级菜单</option>


        <?php echo $this->_var['cat_select']; ?>


      </select>


    </td>


  </tr>


  <tr>


    <td class="label">菜单名称:</td>


    <td><input type="text" name="cat_name" maxlength="60" size = "30" value="<?php echo htmlspecialchars($this->_var['cat']['cat_name']); ?>" /><span class="require-field">*</span></td>


  </tr>


  <tr>


    <td class="label">排序:</td>


    <td>


      <input type="text" name='sort_order' <?php if ($this->_var['cat']['sort_order']): ?>value='<?php echo $this->_var['cat']['sort_order']; ?>'<?php else: ?> value="50"<?php endif; ?> size="15" />


    </td>


  </tr>


    <tr>


    <td class="label">菜单动作类型:</td>


    <td>


      <input type="radio" name="weixin_type" value="0" <?php if ($this->_var['cat']['weixin_type'] == 0): ?> checked="true"<?php endif; ?>  onClick="show(this)" /> click类型


      <input type="radio" name="weixin_type" value="1" <?php if ($this->_var['cat']['weixin_type'] == 1): ?> checked="true"<?php endif; ?>  onClick="show(this)" /> view类型


    </td>


  </tr>


  <tbody id="weixin_view" <?php if ($this->_var['cat']['weixin_type'] == 1): ?>style="display:none"<?php endif; ?>>


  <tr>


    <td class="label">(关键词)KEY值:</td>


    <td><input type="text" name="weixin_key" maxlength="60" size="50" value="<?php echo htmlspecialchars($this->_var['cat']['weixin_key']); ?>" /></td>


  </tr>


  </tbody>


  <tbody id="weixin_click" <?php if ($this->_var['cat']['weixin_type'] == 0): ?>style="display:none"<?php endif; ?>>


  <tr>


    <td class="label">链接URL:</td>


    <td><input type="text" name="links" size="80" value="<?php echo htmlspecialchars($this->_var['cat']['links']); ?>" /></td>


  </tr>


  </tbody>


  <tr>


    <td colspan="2" align="center"><br />


      <input type="submit" class="button" value="确定" />


      <input type="reset" class="button" value="重置" />


      <input type="hidden" name="act" value="<?php echo $this->_var['form_action']; ?>" />


      <input type="hidden" name="id" value="<?php echo $this->_var['cat']['cat_id']; ?>" />


      <input type="hidden" name="old_catname" value="<?php echo $this->_var['cat']['cat_name']; ?>" />


    </td>


  </tr>


</table>


</form>


</div>


<?php echo $this->smarty_insert_scripts(array('files'=>'../js/utils.js,validator.js')); ?>





<script language="javascript"> 


function show(obj){ 


    if(obj.value=='0'){


    document.getElementById('weixin_view').style.display = ""; 


    document.getElementById('weixin_click').style.display = "none"; 


    }else{


    document.getElementById('weixin_view').style.display = "none"; 


    document.getElementById('weixin_click').style.display = ""; 


    }


} 


</script>


<script language="JavaScript">


<!--


/**


 * 检查表单输入的数据


 */


function validate()


{


    validator = new Validator("theForm");


    validator.required("cat_name",  no_catname);


    return validator.passed();


}





/**


 * 选取上级菜单时判断选定的菜单是不是底层菜单


 */


function catChanged()


{


  var obj = document.forms['theForm'].elements['parent_id'];





  cat_type = obj.options[obj.selectedIndex].getAttribute('cat_type');


  if (cat_type == undefined)


  {


    cat_type = 1;


  }





  if ((obj.selectedIndex > 0) && (cat_type == 2 || cat_type == 3 || cat_type == 5))


  {


    alert(sys_hold);


    obj.selectedIndex = 0;


    return false;


  }





  return true;


}





onload = function()


{


    // 开始检查订单


    startCheckOrder();


}


//-->


</script>





<?php echo $this->fetch('pagefooter.htm'); ?>