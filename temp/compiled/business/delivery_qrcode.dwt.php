<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta name="Generator" content="haohaios v1.0" />

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<link href="templates/css/layout.css" rel="stylesheet" type="text/css" />

<title>商家管理</title>

<script type="text/javascript" src="templates/js/jquery_common.min.js"></script>

<script type="text/javascript" src="templates/js/supp.js"></script>

<script type="text/javascript" src="templates/js/jquery.uploadify.min.js"></script>

<LINK href="templates/css/jquery.lightbox-0.5.css" type=text/css rel=stylesheet>
<script type="text/javascript" src="templates/js/jquery.lightbox-0.5.min.js"></script>


</head>

<body style="background:#FBFBFB">

<a href="javascript:;" onclick="myclose();" class="closebtn">关闭</a>




<div  class="popupbox">

   
	<input id="file_upload" name="file_upload" type="file" multiple="true">

       <div>

		<ul id="url" class="picupload">

           </ul>

       </div>


</div>



<script>

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

		'buttonImage' 	: 'templates/images/uploadify-browse.png',	//浏览按钮背景图片

		//'cancelImg'     : '/<?php echo $this->_var['temp_dir']; ?>images/cancel.png',

		'multi'       	: true,					//单文件上传

		'removeCompleted' : true,//是否消失进度

		'fileTypeExts'	: '*.gif; *.jpg; *.png; *.flv',	//允许上传的文件后缀

		'fileSizeLimit'	: '300MB',					//上传文件的大小限制，单位为B, KB, MB, 或 GB

		'successTimeout': 30,						//成功等待时间

		'onUploadSuccess' : function(file, data, response) {//每成功完成一次文件上传时触发一次

				//$("#goods_img_url", parent.document).val('business/'+data);
				$("#<?php echo $this->_var['img_id']; ?>", parent.document).val('business/'+data);
				
				myclose();

		},

		'onUploadError'   : function(file, data, response) {//当上传返回错误时触发

			$('#url').append("<li>"+data+"</li>");

		}

	});
});	
function choice_pic(pic)
{
	$("#goods_img_url", parent.document).val(pic);;
	myclose();
}
</script>
</body>
</html>