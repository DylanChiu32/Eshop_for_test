<?php $_from = $this->_var['pic_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['item']):
?>
	<li>
      <a href="javascript:;"  onClick="choice_pic('/business/<?php echo $this->_var['item']['pic']; ?>','<?php echo $this->_var['img_id']; ?>')" class="photo"><img src="<?php echo $this->_var['item']['pic']; ?>" width="100" height="100"></a>

      <a href="javascript:;" onClick="choice_pic('/business/<?php echo $this->_var['item']['pic']; ?>','<?php echo $this->_var['img_id']; ?>')" class="name"><?php echo $this->_var['item']['pic_name']; ?></a>

      <a href="javascript:;" onClick="choice_pic('/business/<?php echo $this->_var['item']['pic']; ?>','<?php echo $this->_var['img_id']; ?>')" class="bnt">选择</a>

	</li>

<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>