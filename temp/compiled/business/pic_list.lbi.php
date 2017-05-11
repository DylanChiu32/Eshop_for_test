<?php $_from = $this->_var['pic_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['item']):
?>

					<li>

						<a href="<?php echo $this->_var['item']['pic']; ?>"  target="_blank"><img src="<?php echo $this->_var['item']['pic']; ?>" width="200" height="200"></a>

						<a href="" class="name"><?php echo $this->_var['item']['pic_name']; ?></a>

						<div class="r"><!--<a href="?act=edit_pic&id=<?php echo $this->_var['item']['id']; ?>">更换</a>--><a href="javascript:;" onclick="if (confirm('确定要删除吗')) drop_delete_pic('<?php echo $this->_var['item']['id']; ?>')">删除</a></div>

					</li>

					<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>