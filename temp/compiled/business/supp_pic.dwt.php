<?php echo $this->fetch('library/header.lbi'); ?>
<body >
<?php echo $this->fetch('library/lift_menu.lbi'); ?>

    <?php if ($this->_var['action'] == 'pic_category_add' || $this->_var['action'] == 'pic_category_edit'): ?>

     <div class="main" id="main">

		<div class="maintop">

			<img src="templates/images/title_pics.png" /><span>相册管理</span>

		</div>

      <div class="maincon">

			<div class="contitleedit"><span><?php if ($this->_var['action'] == 'pic_category_add'): ?>分类添加<?php else: ?>分类编辑<?php endif; ?></span></div>
			<div class="conbox"> 

     

     <form action="index.php" method="post" name="myform" onsubmit="return checkpic_category();">

	<table cellspacing="0" cellpadding="0" class="edittable">

      <tr>

        <td align="right">分类名称：</td>

        <td><input name="cat_name" type="text" class="input" value="<?php echo $this->_var['rows']['cat_name']; ?>" size="40"  />*</td>

      </tr>

     <tr>

    <td align="right">&nbsp;</td>

	<input name="act" type="hidden" value="<?php echo $this->_var['form_act']; ?>" />
    
    <input name="op" type="hidden" value="pic" />
    

	<input name="id" type="hidden" value="<?php echo $this->_var['rows']['id']; ?>" />

    <td><input type="submit" name="Submit" value="提 交"  class="btn"/></td>

  </tr>

</table>



	</form>

     </div>

     </div>

     </div>

    <?php endif; ?>

      <?php if ($this->_var['action'] == 'pic_category'): ?>

      <div class="main" id="main">

		<div class="maintop">

			<img src="templates/images/title_pics.png" /><span>相册管理</span>

		</div>

		<div class="maincon">

			<div class="contitlelist">

				<span>相册分类</span>

				<div class="titleright">

					<a href="?op=pic&act=pic_category_add">新增分类</a>

					<a href="?op=pic&act=pic_list">返回我的相册</a>

				</div>

			</div>

			<div class="conbox">

				<table cellspacing="0" cellpadding="0" class="listtable">

      <tr>

        <th class="left">名称</td>

        <th class="right">操作</td>

      </tr>

      <?php $_from = $this->_var['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['item']):
?>

      <tr>

        <td><?php echo $this->_var['item']['cat_name']; ?></td>

        <td class="right"><a href="index.php?op=pic&act=pic_category_delete&id=<?php echo $this->_var['item']['id']; ?>" onclick="if (!confirm('确定删除吗')) return false;">删除</a>&nbsp;&nbsp;<a href="index.php?op=pic&act=pic_category_edit&id=<?php echo $this->_var['item']['id']; ?>">编辑</a></td>

      </tr>

      <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>

    </table>

                

			</div>

		</div>

</div>

      <?php endif; ?> 

      <?php if ($this->_var['action'] == 'edit_pic'): ?>

            <link href="themes/xaphp2013/style/uploadify.css" rel="stylesheet" type="text/css" />

          <?php echo $this->smarty_insert_scripts(array('files'=>'jquery_common.min.js,jquery.uploadify.min.js')); ?>

      <div class="main" id="main">

		<div class="maintop">

			<img src="templates/images/title_pics.png" /><span>相册管理</span>

		</div>

      <div class="maincon">

			<div class="contitleedit">

				<span>相册更换</span>

				<div class="titleright">

					<a href="/business/index.php?op=pic&act=pic_list">返回我的相册</a>

				</div>

			</div>

			<div class="conbox"> 

     

    <form action="suppliers.php"  enctype="multipart/form-data"  method="post" name="myform" onsubmit="return checkpic_info();">

	<table cellspacing="0" cellpadding="0" class="edittable">

      <tr>

        <td align="right">选择分类：</td>

        <td><select id="cat_id" name="cat_id">

        <option value="">请选择</option>

             <?php $_from = $this->_var['cat_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['item']):
?>

        	<option value="<?php echo $this->_var['item']['id']; ?>" <?php if ($this->_var['item']['id'] == $this->_var['rows']['cat_id']): ?> selected="selected"<?php endif; ?>><?php echo $this->_var['item']['cat_name']; ?></option>

            <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>

        </select>

        *</td>

      </tr>

      <tr>

      	<td align="right">相册：</td>

        <td>

        <img src="<?php echo $this->_var['rows']['pic']; ?>" width="200" height="200">

        <input name="pic" type="file" />

		</td>

     </tr>

     <tr>

		<td align="right">&nbsp;</td>

		<input name="act" type="hidden" value="<?php echo $this->_var['form_act']; ?>" />
		<input name="op" type="hidden" value="pic" />
		<input name="id" type="hidden" value="<?php echo $this->_var['rows']['id']; ?>" />

		<td><input type="submit" name="Submit" value="提 交" class="btn"/></td>

	 </tr>

	</table>

	</form>

     </div>

     </div>

     </div>

    <script>

	function checkpic_info()

	{

		if($("#cat_id").attr("value") =='')

		{

			alert('请选择分类');

			return false;	

		}

	

		return true;

		

	}

	

</script>



      

      <?php endif; ?>

<?php if ($this->_var['action'] == 'pic_add'): ?>
<link href="templates/css/uploadify.css" rel="stylesheet" type="text/css" />
<!-- <script type="text/javascript" src="templates/js/jquery_common.min.js"></script> -->
<script type="text/javascript" src="templates/js/supp.js"></script>
<script type="text/javascript" src="templates/js/jquery.uploadify.min.js"></script>   
       
      <div class="main" id="main">
		<div class="maintop">
			<img src="templates/images/title_pics.png" /><span>相册管理</span>
		</div>
      <div class="maincon">
			<div class="contitleedit">
				<span>相册添加</span>
				<div class="titleright">
					<a href="/business/index.php?op=pic&act=pic_list">返回我的相册</a>
				</div>
			</div>
			<div class="conbox"> 
    <form action="index.php" method="post" name="myform" onsubmit="return checkpic_info();">

	<table cellspacing="0" cellpadding="0" class="edittable">

      <tr>

        <td align="right">选择分类：</td>

        <td><select id="cat_id" name="cat_id" class="input">

        <option value="">请选择</option>

             <?php $_from = $this->_var['cat_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['item']):
?>

        	<option value="<?php echo $this->_var['item']['id']; ?>"><?php echo $this->_var['item']['cat_name']; ?></option>

            <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>

        </select>

        *</td>

      </tr>

      <tr>

      	<td align="right">相册：</td>

        <td><input id="file_upload" name="file_upload" type="file" multiple="true">&nbsp;&nbsp;大小建议600像素*600像素  

           	<div>

				<ul id="url" class="picupload">

                </ul>

            </div>

		</td>

     </tr>

     <tr>

		<td align="right">&nbsp;</td>

		<input name="act" type="hidden" value="<?php echo $this->_var['form_act']; ?>" />
		<input name="op" type="hidden" value="pic" />
		<input name="id" type="hidden" value="<?php echo $this->_var['rows']['id']; ?>" />

		<td><input type="submit" name="Submit" value="提 交" class="btn"/></td>

	 </tr>

	</table>

	</form>

     </div>

     </div>

     </div>

    <script type="text/javascript" language="javascript">
	function checkpic_info()
	{
		if($("#cat_id").attr("value") =='')
		{
			alert('请选择分类');
			return false;	
		}
		if($("input[name='pics[]']").val()=='')
		{
			alert('请选择上传相册');
			return false;	
		}
		return true;
	}
	$(function() {
			$('#file_upload').uploadify({
				//校验数据
				'formData'     	: {
					'timestamp' : '<?php echo $this->_var['timestamp']; ?>',
					'jsessionid' : '<?php echo $this->_var['suppliers_id']; ?>',
					'token'     : '<?php echo $this->_var['unique_salt']; ?>'//声明令牌
				},
				'swf'         	: 'templates/uploadify.swf',			//指定上传控件的主体文件，默认‘uploader.swf’
				'uploader'    	: 'uploadify.php',			//指定服务器端上传处理文件，默认‘upload.php’
				'auto'        	: true,					//手动上传
				'buttonImage' 	: 'templates/images/uploadify-browse.png',	//浏览按钮背景相册
				//'cancelImg'     : '/<?php echo $this->_var['temp_dir']; ?>images/cancel.png',
				'multi'       	: true,					//单文件上传
				'removeCompleted' : true,//是否消失进度
				'fileTypeExts'	: '*.gif; *.jpg; *.png; *.flv',	//允许上传的文件后缀
				'fileSizeLimit'	: '300MB',					//上传文件的大小限制，单位为B, KB, MB, 或 GB
				'successTimeout': 30,						//成功等待时间
				'onUploadSuccess' : function(file, data, response) {//每成功完成一次文件上传时触发一次
				  $('#url').append("<li id=pic_"+file.id+" ><input type=checkbox name=pics[] id='"+file.id+"'  checked value="+data+" class='checkinput'><img src="+data+"><span>名称：</span><input type='text' name='pic_name[]' class='textinput'><a href='javascript:;'  onclick=del_img('"+data+"','"+file.id+"')  >删除</a></li>");
				  console.info(file);
				  console.info(data);
		        },

		        'onUploadError'   : function(file, data, response) {//当上传返回错误时触发

		            $('#url').append("<li>"+data+"</li>");

		        }

			});

		});

		

	function del_img(data,id)

	{

		getStatusUrl = 'index.php?op=pic&act=delete_pic&pic='+data+'&id='+id;

		$.ajax(

		{

			  url: getStatusUrl,

			  dataType: 'json',

			  global: false,

			  success: function(data)

			  {

				 $("#pic_"+id).hide();

				 $("#"+id+"").attr("checked",false);

				//document.getElementById("pic_"+id).style.display = "none";

			  },

			  error: function(XMLHttpRequest,textStatus, errorThrown){

							//alert(XMLHttpRequest.responsetext);

							//alert(textStatus);

							//alert(errorThrown);

			  }

		});		

	}


	

		

		</script>  

      <?php endif; ?>

      

        <?php if ($this->_var['action'] == 'pic_list'): ?>


    <script>
		function search_pic(value)
		{
			window.location.href="index.php?op=pic&act=pic_list&cat_id="+value;
		}
	</script>
        <LINK href="templates/css/jquery.lightbox-0.5.css" type=text/css rel=stylesheet>

    <!--  <script type="text/javascript" src="templates/js/jquery_common.min.js"></script> -->

      <script type="text/javascript" src="templates/js/jquery.lightbox-0.5.min.js"></script>

      <div class="main" id="main">

		<div class="maintop">

			<img src="templates/images/title_pics.png" /><span>相册管理</span>

		</div>

		<div class="maincon">

			<div class="contitlelist">

				<span>我的相册</span>

				<div class="searchdiv">

					<form id="" name="" method="get" action="index.php">

						<div>分类：</div>

						<select id="cat_id" name="cat_id"  onchange="search_pic(this.value);">

        <option value="">请选择</option>
		<?php $_from = $this->_var['cat_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['item']):
?>

        	<option value="<?php echo $this->_var['item']['id']; ?>"><?php echo $this->_var['item']['cat_name']; ?></option>

            <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
        </select>

						<div id="show_cat_list_2"></div>

						<div id="show_cat_list_3"></div>

						<input type="text" value="" placeholder='名称关键字' class="input" name="keywords">
						<input name="op" type="hidden" value="pic" />
						<input name="act" type="hidden" value="pic_list" />

						<input type="submit" class="btn" name="" value="搜索">

					</form>

				</div>

				<div class="titleright">

					<a href="?op=pic&act=pic_add">相册添加</a>

					<a href="?op=pic&act=pic_category">相册分类</a>

				</div>

			</div>

			<div class="conbox">

				<ul class="picbox"  id="photo">

					<?php echo $this->fetch('library/pic_list.lbi'); ?>

               	</ul> 

			</div>

            <div id="pages">

			<?php echo $this->fetch('library/pages.lbi'); ?>

            </div>

		</div>



	</div>

 <script language="JavaScript" >

 function drop_delete_pic(id)
 {

		getStatusUrl = 'index.php?op=pic&act=drop_delete_pic&id='+id;

		$.ajax(

		{

			  url: getStatusUrl,

			  dataType: 'json',

			  global: false,

			  success: function(data)

			  {

				 document.getElementById('photo').innerHTML =data.pic_list;

				 document.getElementById('pages').innerHTML =data.pages;

			  },

			  error: function(XMLHttpRequest,textStatus, errorThrown){

			  }

		});		

 }

(function($){

	$(function()

	{

		$('#photo a.photo').lightBox({fixedNavigation:true});

	});

})(jQuery);

</script>

		<?php endif; ?>


</body>
</html>