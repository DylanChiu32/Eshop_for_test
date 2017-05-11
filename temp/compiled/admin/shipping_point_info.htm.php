<!-- $Id: goods_info.htm 17126 2010-04-23 10:30:26Z liuhui $ -->
<?php echo $this->fetch('pageheader.htm'); ?>
<?php echo $this->smarty_insert_scripts(array('files'=>'../js/utils.js')); ?>
<?php echo $this->smarty_insert_scripts(array('files'=>'../js/region.js')); ?>
<div class="tab-div">
      <form enctype="multipart/form-data" action="" method="post" name="theForm" onSubmit="return validate();">

        <table width="100%" id="general-table" align="center">
          <tr>
            <td class="label">店铺名称</td>
            <td><input type="text" name="shop_name" value="<?php echo htmlspecialchars($this->_var['point']['shop_name']); ?>" size="30" />&nbsp;
            <?php echo $this->_var['lang']['require_field']; ?>
            </td>
          </tr>
          <tr>
            <td class="label">选择省份</td>
            <td>
		        <select name="province" id="selProvinces" onChange="region.changed(this, 2, 'selCities')" style="border:1px solid #ccc;">
			        <option value="0">请选择省份</option>
			        <!-- <?php $_from = $this->_var['province_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'province');if (count($_from)):
    foreach ($_from AS $this->_var['province']):
?> -->
			        <option value="<?php echo $this->_var['province']['region_id']; ?>" <?php if ($this->_var['point']['province'] == $this->_var['province']['region_id']): ?>selected<?php endif; ?>><?php echo $this->_var['province']['region_name']; ?></option>
			        <!-- <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?> -->
		      	</select>
               <?php echo $this->_var['lang']['require_field']; ?>
            </td>
          </tr>
          <tr>
            <td class="label">选择城市</td>
            <td>
		        <select name="city" id="selCities" onChange="region.changed(this, 3, 'selDistricts')" style="border:1px solid #ccc;">
			        <option value="0">请选择城市</option>
			        <!-- <?php $_from = $this->_var['city_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'city');if (count($_from)):
    foreach ($_from AS $this->_var['city']):
?> -->
			        <option value="<?php echo $this->_var['city']['region_id']; ?>" <?php if ($this->_var['point']['city'] == $this->_var['city']['region_id']): ?>selected<?php endif; ?>><?php echo $this->_var['city']['region_name']; ?></option>
			        <!-- <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?> -->
			   </select>
               <?php echo $this->_var['lang']['require_field']; ?>
            </td>
          </tr>
          <tr>
            <td class="label">选择区域</td>
            <td>
		        <select name="district" id="selDistricts"  style="border:1px solid #ccc;">
			        <option value="0">请选择区域</option>
			        <!-- <?php $_from = $this->_var['district_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'district');if (count($_from)):
    foreach ($_from AS $this->_var['district']):
?> -->
			        <option value="<?php echo $this->_var['district']['region_id']; ?>" <?php if ($this->_var['point']['district'] == $this->_var['district']['region_id']): ?>selected<?php endif; ?>><?php echo $this->_var['district']['region_name']; ?></option>
			        <!-- <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?> -->  
		        </select> 
               <?php echo $this->_var['lang']['require_field']; ?>
            </td>
          </tr>
          <tr>
            <td class="label">地址</td>
            <td><input type="text" name="address" value="<?php echo htmlspecialchars($this->_var['point']['address']); ?>" size="30" />&nbsp;
            <?php echo $this->_var['lang']['require_field']; ?>
            </td>
          </tr>
          <tr>
            <td class="label">坐标</td>
            <td><input type="text" name="address2" value="<?php echo htmlspecialchars($this->_var['point']['address']); ?>" size="50" /><a href="http://lbs.qq.com/tool/getpoint/index.html" target="_blank">获取坐标</a></td>
          </tr>
           <tr>
            <td class="label">联系电话</td>
            <td><input type="text" name="mobile" value="<?php echo $this->_var['point']['mobile']; ?>" size="30" />&nbsp;
        
            </td>
          </tr>
          <tr>
            <td class="label">开启打印机</td>
            <td>
            <input type="radio" name="has_printer" value="1" <?php if ($this->_var['point']['has_printer'] == 1): ?>checked<?php endif; ?>/>&nbsp;是
            <input type="radio" name="has_printer" value="0" <?php if ($this->_var['point']['has_printer'] != 1): ?>checked<?php endif; ?>/>&nbsp; 否
        
            </td>
          </tr>
          <tr>
            <td class="label">打印机</td>
            <td>
            <input type="radio" name="printer_type" value="feyin" <?php if ($this->_var['point']['printer_type'] == 'feyin'): ?>checked<?php endif; ?>/>&nbsp;飞印
            </td>
          </tr>
          <tr>
            <td class="label">打印机终端编码</td>
            <td>
            <input type="text" name="device_no" value="<?php echo $this->_var['point']['device_no']; ?>" size="60" />&nbsp;
            </td>
          </tr>
          <tr>
            <td class="label">打印机商户代码</td>
            <td>
            <input name="device_code" type="text" id="device_code" value="<?php echo $this->_var['point']['device_code']; ?>" size="60" />&nbsp;登录飞印后在“API集成”->“获取API集成信息”获取
            </td>
          </tr> 
          <tr>
            <td class="label">打印机密钥</td>
            <td>
            <input type="text" name="device_key" value="<?php echo $this->_var['point']['device_key']; ?>" size="60" />&nbsp;同上
            </td>
          </tr>         
        </table>


        <div class="button-div">
          <input type="hidden" name="id" value="<?php echo $this->_var['point']['id']; ?>" />
          <input type="submit" value="<?php echo $this->_var['lang']['button_submit']; ?>" class="button"  />
          <input type="reset" value="<?php echo $this->_var['lang']['button_reset']; ?>" class="button" />
        </div>
        <input type="hidden" name="act" value="<?php echo $this->_var['form_act']; ?>" />
      </form>
    </div>
<?php echo $this->smarty_insert_scripts(array('files'=>'validator.js,tab.js')); ?>
<script language="JavaScript">
region.isAdmin=true;

function validate()
{
    var validator = new Validator('theForm');
    var shop_name  = document.forms['theForm'].elements['shop_name'].value;
    var province  = document.forms['theForm'].elements['province'].value;
    var city  = document.forms['theForm'].elements['city'].value;
    var district  = document.forms['theForm'].elements['district'].value;
    var address  = document.forms['theForm'].elements['address'].value;
    
    
    validator.required('shop_name', '店铺名称不能为空');
    validator.required('province', '省份不能为空');
    validator.required('city', '城市不能为空');
    validator.required('district', '区域不能为空');
    validator.required('address', '地址不能为空');

    return validator.passed();
  
}
</script>
<?php echo $this->fetch('pagefooter.htm'); ?>
