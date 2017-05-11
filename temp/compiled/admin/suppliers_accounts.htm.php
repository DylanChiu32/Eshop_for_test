<!-- $Id: agency_list.htm 14216 2008-03-10 02:27:21Z testyang $ -->
<?php if ($this->_var['full_page']): ?>

<?php echo $this->fetch('pageheader.htm'); ?>

<?php echo $this->smarty_insert_scripts(array('files'=>'../js/utils.js,listtable.js,../js/region.js')); ?>
<script language="javascript" type="text/javascript" src="../js/DatePicker/WdatePicker.js"></script>
<div class="form-div">
  <form action="javascript:search_supp()" name="searchForm">
    <img src="images/icon_search.gif" width="26" height="22" border="0" alt="SEARCH" />
    商家： <input type="text" name="suppliers_name" size="15" />
    结算单号： <input type="text" name="settlement_sn" size="15" />  
    结算状态：
    <select name="settlement_status">
    <option value="">请选择</option>
    <?php echo $this->html_options(array('options'=>$this->_var['lang']['account_settlement_status'],'selected'=>$this->_var['filter']['status'])); ?>  
    </select> 
    结算订单起止日期：<input class="Wdate" type="text" name="start_time" readonly onfocus="WdatePicker({dateFmt:'yyyy-M-d HH:mm',maxDate:'%y-%M-%d HH:mm'})"/>
      ~      
      <input class="Wdate" type="text" name="end_time" readonly onfocus="WdatePicker({dateFmt:'yyyy-M-d HH:mm',maxDate:'%y-%M-%d HH:mm'})"/>  
    <input type="submit" value="<?php echo $this->_var['lang']['button_search']; ?>" class="button" />
  </form>
</div>
<form method="post" action="" name="listForm" onsubmit="return confirm(batch_drop_confirm);">
<div class="list-div" id="listDiv">
<?php endif; ?>
  <table cellpadding="3" cellspacing="1">
    <tr>
      <th> <input onclick='listTable.selectAll(this, "checkboxes")' type="checkbox" />
          <a href="javascript:listTable.sort('id'); "><?php echo $this->_var['lang']['record_id']; ?></a><?php echo $this->_var['sort_id']; ?> </th>
      <th>结算单号</th>
      <th><a href="javascript:listTable.sort('suppliers_name'); "><?php echo $this->_var['lang']['suppliers_name']; ?></a><?php echo $this->_var['sort_suppliers_name']; ?></th>
      <th>总金额</th>
      <th>佣金</th>
      <th>分销</th>
      <th>实结金额</th>
      <!-- 
      <th>结算起止时间</th>  -->
      <th>结算时间</th>
      <th>状态</th>  
      <!-- 
      <th>商家反馈</th> 
       -->
      <th><?php echo $this->_var['lang']['handler']; ?></th>
    </tr>

    <?php $_from = $this->_var['suppliers_accounts_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['item']):
?>
    <tr>
      <td align="center"><input type="checkbox" name="checkboxes[]" value="<?php echo $this->_var['item']['id']; ?>" />
        <?php echo $this->_var['item']['id']; ?></td>
      <td align="center"><?php if ($this->_var['item']['settlement_status'] == 5): ?><span style="color:#F00"><?php echo $this->_var['item']['settlement_sn']; ?></span><?php else: ?><?php echo $this->_var['item']['settlement_sn']; ?><?php endif; ?></td>  
      <td align="center" class="first-cell"><span><?php echo htmlspecialchars($this->_var['item']['suppliers_name']); ?></span></td> 
      <td align="center"><?php echo $this->_var['item']['total']; ?></td>
      <td align="center"><?php echo $this->_var['item']['commission']; ?></td>
      <td align="center"><?php echo $this->_var['item']['fenxiao_money']; ?></td>
      <td align="center"><?php echo $this->_var['item']['settlement_amount']; ?></td>
      <!-- 
      <td align="center"><?php echo $this->_var['item']['money']; ?></td>
      <td align="center" ><?php echo $this->_var['item']['start_time']; ?><br /><?php echo $this->_var['item']['end_time']; ?></td> 
      -->
      <td align="center" ><?php echo $this->_var['item']['add_time']; ?></td> 
      <td align="center" ><?php echo $this->_var['lang']['account_settlement_status'][$this->_var['item']['settlement_status']]; ?></td> 
     <!--  
      <td align="center" ><?php echo $this->_var['item']['remark']; ?></td> 
      -->
      <td align="center" class="bnt_a">
      <!-- 
      <?php if ($this->_var['item']['settlement_status'] == 1 || $this->_var['item']['settlement_status'] == 5): ?><?php echo $this->_var['lang']['account_settlement_status'][$this->_var['settlement_status']]; ?><?php endif; ?>        

<?php if ($this->_var['item']['settlement_status'] == 1 || $this->_var['item']['settlement_status'] == 5): ?>待审核<?php endif; ?>        
<?php if ($this->_var['item']['settlement_status'] == 2): ?><a onclick="if(confirm('是否确认付款'))  return true; else return false;" href="suppliers.php?act=pay&id=<?php echo $this->_var['item']['id']; ?>&suppliers_id=<?php echo $this->_var['item']['suppliers_id']; ?>&page=<?php echo $this->_var['filter']['page']; ?>" title="">付款</a><?php endif; ?>
<?php if ($this->_var['item']['settlement_status'] == 3): ?>已付款待确认<?php endif; ?>
<?php if ($this->_var['item']['settlement_status'] == 4): ?>已完成<?php endif; ?> | -->
<a  href="suppliers.php?act=detail&suppliers_accounts_id=<?php echo $this->_var['item']['id']; ?>" title="">明细</a>

</td>
    </tr>

    <?php endforeach; else: ?>

    <tr><td class="no-records" colspan="8"><?php echo $this->_var['lang']['no_records']; ?></td></tr>

    <?php endif; unset($_from); ?><?php $this->pop_vars();; ?>

  </table>

<table id="page-table" cellspacing="0">

  <tr>

    <td>
<!-- 
      <input name="remove" type="submit" id="btnSubmit" value="<?php echo $this->_var['lang']['drop']; ?>" class="button" disabled="true" />

      <input name="act" type="hidden" value="batch" />
 -->
    </td>

    <td align="right" nowrap="true">

    <?php echo $this->fetch('page.htm'); ?>

    </td>

  </tr>

</table>



<?php if ($this->_var['full_page']): ?>

</div>

</form>


<script language="JavaScript">
    function search_supp()
    {
        listTable.filter['suppliers_name'] = Utils.trim(document.forms['searchForm'].elements['suppliers_name'].value);
		listTable.filter['settlement_sn'] = Utils.trim(document.forms['searchForm'].elements['settlement_sn'].value);
		listTable.filter['settlement_status'] = Utils.trim(document.forms['searchForm'].elements['settlement_status'].value);
		listTable.filter['start_time'] = Utils.trim(document.forms['searchForm'].elements['start_time'].value);
		listTable.filter['end_time'] = Utils.trim(document.forms['searchForm'].elements['end_time'].value);

		listTable.filter['page'] = 1;		
        listTable.loadList();
        getDownUrl();
    }
    function getDownUrl()
    {
      var aTags = document.getElementsByTagName('A');
      for (var i = 0; i < aTags.length; i++)
      { 
        if (aTags[i].href.indexOf('download') >= 0)
        {		
	    	suppliers_name = document.forms['searchForm'].elements['suppliers_name'].value;
	       	settlement_sn= document.forms['searchForm'].elements['settlement_sn'].value;
	       	settlement_status = document.forms['searchForm'].elements['settlement_status'].value;             
	       	start_time = document.forms['searchForm'].elements['start_time'].value;
	       	end_time = document.forms['searchForm'].elements['end_time'].value;
            page = 1;
            str="suppliers_name="+suppliers_name+"&settlement_sn="+settlement_sn+"&settlement_status="+settlement_status+
            "&start_time="+start_time+"&end_time="+end_time+"&page="+page;
            aTags[i].href = "suppliers.php?act=account_download&"+str;
            
        }
        if (aTags[i].href.indexOf('print') >= 0)
        {		
	    	suppliers_name = document.forms['searchForm'].elements['suppliers_name'].value;
	       	settlement_sn= document.forms['searchForm'].elements['settlement_sn'].value;
	       	settlement_status = document.forms['searchForm'].elements['settlement_status'].value;             
	       	start_time = document.forms['searchForm'].elements['start_time'].value;
	       	end_time = document.forms['searchForm'].elements['end_time'].value;
            page = 1;
            str="suppliers_name="+suppliers_name+"&settlement_sn="+settlement_sn+"&settlement_status="+settlement_status+
            "&start_time="+start_time+"&end_time="+end_time+"&page="+page;
            aTags[i].href = "suppliers.php?act=account_print&"+str;
            aTags[i].target="_blank";
        }
      }
    }
</script>

<script type="text/javascript" language="javascript">

region.isAdmin = true;

  <!--

  listTable.recordCount = <?php echo $this->_var['record_count']; ?>;

  listTable.pageCount = <?php echo $this->_var['page_count']; ?>;

  listTable.query = "accounts_query";

  <?php $_from = $this->_var['filter']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['item']):
?>

  listTable.filter.<?php echo $this->_var['key']; ?> = '<?php echo $this->_var['item']; ?>';

  <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>

  

  onload = function()

  {

      // 开始检查订单

      startCheckOrder();
      getDownUrl();

  }

  

  //-->

</script>

<?php echo $this->fetch('pagefooter.htm'); ?>

<?php endif; ?>