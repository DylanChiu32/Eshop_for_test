<?php echo $this->fetch('library/header.lbi'); ?>
<body >
<?php echo $this->fetch('library/lift_menu.lbi'); ?>
<script type="text/javascript" src="templates/js/public_tab.js"></script>
    <style type="text/css">
        .upload-table{
            height:auto;
        }
        .upload-table-tr{
          height:60px;
          padding:10px 0;
        }
        .table-button{
            padding:3px 23px;
            background: #ececec;
            border:1px solid #666;
            color:#333; 
        }
        .table-file-a{
            color:#666;
        }
    </style>

<div class="main" id="main">
    <div class="maintop">

      <img src="templates/images/title_pics.png" /><span>批量发货</span>
    </div>
	<div class="maincon">
        <div class="contitlelist"><span>批量发货</span></div>
		
		<div class="conbox" style="position:relative;">
		
		
      <form enctype="multipart/form-data" action="" method="post" name="theForm" >
        <table width="1000" id="general-table" class="upload-table" align="center">       
          <tr class="upload-table-tr">
            <td class="label" width="50%">上传文件：</td>
            <td width="50%">
              <a href="javascript:;" class="table-file-a">
                <input type="file" name="file" size="35" style="" />  
              </a>
            </td>
          </tr>         
        <tr class="upload-table-tr">
            <td></td>
            <td>
          <input type="submit" name="submit" value=" 确定 " class="button table-button" />
        <!-- <a href="Area/order_temp.csv">模板下载</a></td> -->
        </table>
      </form>
		
		</div>
	</div>
</div>
</body>
</html>