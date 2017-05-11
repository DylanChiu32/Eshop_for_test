<!-- $Id: agency_info.htm 14216 2008-03-10 02:27:21Z testyang $ -->
<?php echo $this->fetch('pageheader.htm'); ?>
<?php echo $this->smarty_insert_scripts(array('files'=>'validator.js,../js/transport.js,../js/region.js')); ?>
<link href="../js/calendar/calendar.css" rel="stylesheet" type="text/css" />
<div class="main-div">
<form method="post" action="suppliers.php" name="theForm" enctype="multipart/form-data" onsubmit="return validate()">
<table cellspacing="1" cellpadding="3" width="100%">

  <tr>
    <td class="label">审核状态：</td>
    <td>
  	<input name="is_check" type="radio" value="2" <?php if ($this->_var['is_check'] == 2): ?> checked<?php endif; ?>>审核中&nbsp;
    <input name="is_check" type="radio" value="1"  <?php if ($this->_var['is_check'] == 1): ?> checked<?php endif; ?>>审核通过&nbsp;
    <input name="is_check" type="radio" value="0"  <?php if ($this->_var['is_check'] == 0): ?> checked<?php endif; ?>>审核未通过&nbsp;
    </td>
  </tr>
    
         <tr>
          <td class="label">备注信息：</td>
          <td>
          <textarea name='check_desc' cols="30" rows="3"><?php echo $this->_var['check_desc']; ?></textarea>
          </td>
    	</tr>
         <tr>
    <td class="label"></td>
    <td>
    <!-- 
  	<input name="is_sms" type="checkbox"  >短信通知&nbsp; -->
    <!-- <input name="is_email" type="checkbox" >邮件通知&nbsp; -->
    </td>
  </tr>
        <tr>
          <td class="label">&nbsp;</td>
          <td>
      <input type="submit" class="button" value="<?php echo $this->_var['lang']['button_submit']; ?>" />
      <!--   <input type="button" class="button" value="<?php echo $this->_var['lang']['button_submit']; ?>" onclick="return validate()" />-->
      <input type="reset" class="button" value="<?php echo $this->_var['lang']['button_reset']; ?>" />
      <input type="hidden" name="act" value="check_act" />
      <input type="hidden" name="id" value="<?php echo $this->_var['id']; ?>" />
      <input type="hidden" name="page" value="<?php echo $this->_var['page']; ?>" />
      
      </td>
        </tr>
</table>

</form>

</div>

<?php echo $this->smarty_insert_scripts(array('files'=>'../js/utils.js,validator.js')); ?>



<script language="JavaScript">
<!--

onload = function()
{
    // 开始检查订单
    startCheckOrder();
}
region.isAdmin = true;
//-->

</script>



<?php echo $this->fetch('pagefooter.htm'); ?>