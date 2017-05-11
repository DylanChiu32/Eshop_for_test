<?php if ($this->_var['full_page']): ?>
<?php echo $this->fetch('pageheader.htm'); ?>
<?php echo $this->smarty_insert_scripts(array('files'=>'../js/utils.js,listtable.js,../js/region.js')); ?>
<script language="javascript" type="text/javascript" src="../js/DatePicker/WdatePicker.js"></script>
<!-- 订单搜索 -->
<div class="form-div">
  <form action="javascript:searchOrder()" name="searchForm">
    <img src="images/icon_search.gif" width="26" height="22" border="0" alt="SEARCH" />
    状态
    <select name="team_status" id="team_status">
      <option value="-1"><?php echo $this->_var['lang']['select_please']; ?></option>
      <?php echo $this->html_options(array('options'=>$this->_var['lang']['team_status'])); ?>
    </select>
    <?php if ($this->_var['is_luck'] == 0): ?>
    缺少人数
    <select name="team_lack_num" id="team_lack_num">
      <option value="-1"><?php echo $this->_var['lang']['select_please']; ?></option>
      <option value="1">1人</option>
      <option value="2">2人</option>
      <option value="3">3人</option>
      <option value="4">4人</option>
      <option value="5">5人</option>
      
    </select>
    <?php else: ?>
    <input name="team_lack_num" id="team_lack_num" type="hidden" value="-1">
    <?php endif; ?>
     商品编号<input type="text" name="extension_id" value="">

     <?php if ($this->_var['is_luck'] == 0): ?>团购<?php else: ?>夺宝<?php endif; ?>编号<input type="text" name="team_sign" value="">

    起止时间
    <input class="Wdate" type="text" name="pay_start_time" readonly="readonly" onfocus="WdatePicker({dateFmt:'yyyy-M-d HH:mm'})"/>
      ~       
      <input class="Wdate" type="text" name="pay_end_time" readonly="readonly" onfocus="WdatePicker({dateFmt:'yyyy-M-d HH:mm'})"/>
      
    <!-- 推荐 -->
      区域选择
     <select name="city_id" id="selCities"  onchange="region.changed(this, 3, 'selDistricts')">

          <option value=''>请选择</option>

            <?php $_from = $this->_var['cities']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'region');if (count($_from)):
    foreach ($_from AS $this->_var['region']):
?>

              <option value="<?php echo $this->_var['region']['region_id']; ?>" <?php if ($this->_var['region']['region_id'] == $this->_var['goods']['city_id']): ?>selected="selected"<?php endif; ?>><?php echo $this->_var['region']['region_name']; ?></option>

            <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>

        </select>
         <select name="district_id" id="selDistricts">

				<option value="0">请选择</option>

				<?php $_from = $this->_var['district_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'district');if (count($_from)):
    foreach ($_from AS $this->_var['district']):
?>

				<option value="<?php echo $this->_var['district']['region_id']; ?>" <?php if ($this->_var['district']['region_id'] == $this->_var['goods']['district_id']): ?>selected="selected"<?php endif; ?>  ><?php echo $this->_var['district']['region_name']; ?></option>

				<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>

		</select> 
     <?php if ($this->_var['suppliers_exists'] == 1): ?>    
      <!-- 供货商 -->
      <select name="suppliers_id">
      <option value="-1">请选择</option>
      <option value="0">自营店</option><?php echo $this->html_options(array('options'=>$this->_var['suppliers_list_name'],'selected'=>$_GET['suppliers_id'])); ?></select>
      <?php endif; ?>      
      
      
      
    <input type="submit" value="<?php echo $this->_var['lang']['button_search']; ?>" class="button" /><br/><br/>&nbsp;&nbsp;&nbsp;
  	
  	<a href="order.php?act=team_list<?php if ($this->_var['is_luck'] == 1): ?>&is_luck=1<?php endif; ?>&team_status=1">正在进行中【<?php echo $this->_var['team_num1']; ?>单】</a>&nbsp;&nbsp;
    <a href="order.php?act=team_list<?php if ($this->_var['is_luck'] == 1): ?>&is_luck=1<?php endif; ?>&team_status=2">成功【<?php echo $this->_var['team_num2']; ?>单】</a>&nbsp;&nbsp;
    <a href="order.php?act=team_list<?php if ($this->_var['is_luck'] == 1): ?>&is_luck=1<?php endif; ?>&team_status=3">失败【<?php echo $this->_var['team_num3']; ?>单】</a>
 
  </form>
</div>

<!-- 订单列表 -->
<form method="post" action="order.php?act=batch_operate_post_team" name="listForm" onsubmit="return check()">
  <div class="list-div" id="listDiv"><!-- &operation=refund -->
<?php endif; ?>

<table cellpadding="3" cellspacing="1">
  <tr>
    <th>
      <input onclick='listTable.selectAll(this, "checkboxes")' type="checkbox" /><a href="javascript:listTable.sort('team_sign', 'DESC'); "><?php if ($this->_var['is_luck'] == 0): ?>团购<?php else: ?>夺宝<?php endif; ?>编号</a><?php echo $this->_var['sort_team_sign']; ?>
    </th>
    <th><a href="javascript:listTable.sort('extension_id', 'DESC'); ">商品名称</a><?php echo $this->_var['sort_extension_id']; ?></th>
    <th>商品编号</th>
    <?php if ($this->_var['is_luck'] == 1): ?><th>期数</th><?php endif; ?>
    <th><a href="javascript:listTable.sort('team_status', 'DESC'); ">状态</a><?php echo $this->_var['sort_team_status']; ?></th>
    <th>所需<?php if ($this->_var['is_luck'] == 0): ?>人<?php else: ?>份<?php endif; ?>数</th>
    <th>缺少<?php if ($this->_var['is_luck'] == 0): ?>人<?php else: ?>份<?php endif; ?>数</th>
    <th><?php if ($this->_var['is_luck'] == 0): ?>开团<?php else: ?>开始<?php endif; ?>时间</th>
    <?php if ($this->_var['is_luck'] == 0): ?><th>到期时间</th><?php endif; ?>
    <th>用户名</th>
    <th>授权ID</th>
    <th><?php echo $this->_var['lang']['handler']; ?></th>
  <tr>
  <?php $_from = $this->_var['order_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('okey', 'order');if (count($_from)):
    foreach ($_from AS $this->_var['okey'] => $this->_var['order']):
?>
  <tr>
    <td valign="top" nowrap="nowrap"><input type="checkbox" name="checkboxes" value="<?php echo $this->_var['order']['team_sign']; ?>" /><?php echo $this->_var['order']['team_sign']; ?></td>
    <td><?php echo $this->_var['order']['goods_name']; ?></td>
    <td align="left" valign="top"><?php echo htmlspecialchars($this->_var['order']['extension_id']); ?></td>
    <?php if ($this->_var['is_luck'] == 1): ?><td><?php echo $this->_var['order']['luck_times']; ?></td><?php endif; ?>
    <td align="center" valign="top" nowrap="nowrap"><?php echo $this->_var['lang']['team_status'][$this->_var['order']['team_status']]; ?></td>
    <td align="right" valign="top" nowrap="nowrap"><?php if (is_luck == 1): ?><?php echo $this->_var['order']['goods_number']; ?><?php else: ?><?php echo $this->_var['order']['team_num']; ?><?php endif; ?></td>
    <td align="right" valign="top" nowrap="nowrap"><?php if (is_luck == 1): ?><?php echo $this->_var['order']['goods_team_num']; ?><?php else: ?><?php echo $this->_var['order']['team_lack_num']; ?><?php endif; ?></td>
    <td align="center" valign="top" nowrap="nowrap"><?php if ($this->_var['order']['team_start_date']): ?><?php echo $this->_var['order']['team_start_date']; ?><?php else: ?>暂无<?php endif; ?></td>
    <?php if ($this->_var['is_luck'] == 0): ?><td align="center" valign="top" nowrap="nowrap"><?php if ($this->_var['order']['team_end_date']): ?><?php echo $this->_var['order']['team_end_date']; ?><?php else: ?>暂无<?php endif; ?></td><?php endif; ?>
	<td align="center" valign="top" nowrap="nowrap"><?php echo $this->_var['order']['uname']; ?></td>
	<td align="center" valign="top" nowrap="nowrap"><?php echo $this->_var['order']['openid']; ?></td>

    <td align="center" valign="top" class="bnt_a">
     <a href="order.php?act=teammem_list&team_sign=<?php echo $this->_var['order']['team_sign']; ?>">查看详情</a>
     <!-- 
     <?php if ($this->_var['order']['can_refund'] > 0): ?><a href="refund.php?team_sign=<?php echo $this->_var['order']['team_sign']; ?>" onclick="if(confirm('确定要退款吗')) return true;else return false;">退款</a><?php endif; ?>
 -->
    </td>
  </tr>
  <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
</table>

<!-- 分页 -->
<table id="page-table" cellspacing="0">
  <tr>
    <td align="right" nowrap="true">
    <?php echo $this->fetch('page.htm'); ?>
    </td>
  </tr>
</table>

<?php if ($this->_var['full_page']): ?>
  </div>
  
  <div>
  <!--
    <input name="confirm" type="submit" id="btnSubmit" value="<?php echo $this->_var['lang']['op_confirm']; ?>" class="button" disabled="true" onclick="this.form.target = '_self'" />
    <input name="invalid" type="submit" id="btnSubmit1" value="<?php echo $this->_var['lang']['op_invalid']; ?>" class="button" disabled="true" onclick="this.form.target = '_self'" />
    <input name="cancel" type="submit" id="btnSubmit2" value="<?php echo $this->_var['lang']['op_cancel']; ?>" class="button" disabled="true" onclick="this.form.target = '_self'" />
    <input name="remove" type="submit" id="btnSubmit3" value="<?php echo $this->_var['lang']['remove']; ?>" class="button" disabled="true" onclick="this.form.target = '_self'" />
    <input name="print" type="submit" id="btnSubmit4" value="<?php echo $this->_var['lang']['print_order']; ?>" class="button" disabled="true" onclick="this.form.target = '_blank'" />
    -->
    <?php if ($this->_var['is_luck'] == 0): ?>
    <input name="refund" type="submit" id="btnSubmit" value="批量整团退款" class="button" disabled="true" onclick="this.form.target = '_self';if(confirm('确定要批量退款吗')) return true;else return false;" />
    <input name="team_head_refund" type="submit" id="btnSubmit1" value="批量团长退款" disabled="true" class="button"  onclick="this.form.target = '_self';if(confirm('确定要批量退款吗')) return true;else return false;" />
    <?php endif; ?>
    <input name="batch" type="hidden" value="1" />
    <input name="order_id" type="hidden" value="" />
  </div>
    
</form>
<script language="JavaScript">
listTable.recordCount = <?php echo $this->_var['record_count']; ?>;
listTable.pageCount = <?php echo $this->_var['page_count']; ?>;
region.isAdmin = true;

<?php $_from = $this->_var['filter']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['item']):
?>
listTable.filter.<?php echo $this->_var['key']; ?> = '<?php echo $this->_var['item']; ?>';

<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>

listTable.query = "team_query";

    onload = function()
    {
        // 开始检查订单
        startCheckOrder();
    }

    /**
     * 搜索订单
     */
    function searchOrder()
    {
        listTable.filter['team_status'] = document.forms['searchForm'].elements['team_status'].value;
        listTable.filter['pay_start_time'] = document.forms['searchForm'].elements['pay_start_time'].value;
        listTable.filter['pay_end_time'] = document.forms['searchForm'].elements['pay_end_time'].value;
		listTable.filter['suppliers_id'] = document.forms['searchForm'].elements['suppliers_id'].value;
		listTable.filter['city_id'] = document.forms['searchForm'].elements['city_id'].value;
		listTable.filter['district_id'] = document.forms['searchForm'].elements['district_id'].value;
        listTable.filter['extension_id'] = document.forms['searchForm'].elements['extension_id'].value;
        listTable.filter['team_sign'] = document.forms['searchForm'].elements['team_sign'].value;
        <?php if ($this->_var['is_luck'] == 0): ?>
        listTable.filter['team_lack_num'] = document.forms['searchForm'].elements['team_lack_num'].value;
        <?php endif; ?>
        listTable.filter['page'] = 1;
        listTable.loadList();
    }

    function check()
    {
      var snArray = new Array();
      var eles = document.forms['listForm'].elements;
      for (var i=0; i<eles.length; i++)
      {
        if (eles[i].tagName == 'INPUT' && eles[i].type == 'checkbox' && eles[i].checked && eles[i].value != 'on')
        {
          snArray.push(eles[i].value);
        }
      }
      if (snArray.length == 0)
      {
        return false;
      }
      else
      {
        eles['order_id'].value = snArray.toString();
        return true;
      }
    }
    /**
     * 显示订单商品及缩图
     */
    var show_goods_layer = 'order_goods_layer';
    var goods_hash_table = new Object;
    var timer = new Object;

    /**
     * 绑定订单号事件
     *
     * @return void
     */
    function bind_order_event()
    {
        var order_seq = 0;
        while(true)
        {
            var order_sn = Utils.$('order_'+order_seq);
            if (order_sn)
            {
                order_sn.onmouseover = function(e)
                {
                    try
                    {
                        window.clearTimeout(timer);
                    }
                    catch(e)
                    {
                    }
                    var order_id = Utils.request(this.href, 'order_id');
                    show_order_goods(e, order_id, show_goods_layer);
                }
                order_sn.onmouseout = function(e)
                {
                    hide_order_goods(show_goods_layer)
                }
                order_seq++;
            }
            else
            {
                break;
            }
        }
    }
    listTable.listCallback = function(result, txt) 
    {
        if (result.error > 0) 
        {
            alert(result.message);
        }
        else 
        {
            try 
            {
                document.getElementById('listDiv').innerHTML = result.content;
                bind_order_event();
                if (typeof result.filter == "object") 
                {
                    listTable.filter = result.filter;
                }
                listTable.pageCount = result.page_count;
            }
            catch(e)
            {
                alert(e.message);
            }
        }
    }
    /**
     * 浏览器兼容式绑定Onload事件
     *
     */
    if (Browser.isIE)
    {
        window.attachEvent("onload", bind_order_event);
    }
    else
    {
        window.addEventListener("load", bind_order_event, false);
    }

    /**
     * 建立订单商品显示层
     *
     * @return void
     */
    function create_goods_layer(id)
    {
        if (!Utils.$(id))
        {
            var n_div = document.createElement('DIV');
            n_div.id = id;
            n_div.className = 'order-goods';
            document.body.appendChild(n_div);
            Utils.$(id).onmouseover = function()
            {
                window.clearTimeout(window.timer);
            }
            Utils.$(id).onmouseout = function()
            {
                hide_order_goods(id);
            }
        }
        else
        {
            Utils.$(id).style.display = '';
        }
    }

    /**
     * 显示订单商品数据
     *
     * @return void
     */
    function show_order_goods(e, order_id, layer_id)
    {
        create_goods_layer(layer_id);
        $layer_id = Utils.$(layer_id);
        $layer_id.style.top = (Utils.y(e) + 12) + 'px';
        $layer_id.style.left = (Utils.x(e) + 12) + 'px';
        if (typeof(goods_hash_table[order_id]) == 'object')
        {
            response_goods_info(goods_hash_table[order_id]);
        }
        else
        {
            $layer_id.innerHTML = loading;
            Ajax.call('order.php?is_ajax=1&act=get_goods_info&order_id='+order_id, '', response_goods_info , 'POST', 'JSON');
        }
    }

    /**
     * 隐藏订单商品
     *
     * @return void
     */
    function hide_order_goods(layer_id)
    {
        $layer_id = Utils.$(layer_id);
        window.timer = window.setTimeout('$layer_id.style.display = "none"', 500);
    }

    /**
     * 处理订单商品的Callback
     *
     * @return void
     */
    function response_goods_info(result)
    {
        if (result.error > 0)
        {
            alert(result.message);
            hide_order_goods(show_goods_layer);
            return;
        }
        if (typeof(goods_hash_table[result.content[0].order_id]) == 'undefined')
        {
            goods_hash_table[result.content[0].order_id] = result;
        }
        Utils.$(show_goods_layer).innerHTML = result.content[0].str;
    }
</script>


<?php echo $this->fetch('pagefooter.htm'); ?>
<?php endif; ?>