<?php $_from = $this->_var['pic_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'item_0_81240800_1438675548');if (count($_from)):
    foreach ($_from AS $this->_var['item_0_81240800_1438675548']):
?>
<li>
     <a href="<?php echo $this->_var['item_0_81240800_1438675548']['pic']; ?>"  target="_blank">  <img src="<?php echo $this->_var['item_0_81240800_1438675548']['pic']; ?>" width="100" height="100"></a>
      <a href="" class="name"><?php echo $this->_var['item_0_81240800_1438675548']['pic_name']; ?></a>
      <input type="checkbox" name="photo[]"  value="/business/<?php echo $this->_var['item_0_81240800_1438675548']['pic']; ?>" /></option>
</li>
<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
<!--li>
      <a href="javascript:;" onClick="choice_photo()">确定</a>
      </li-->
