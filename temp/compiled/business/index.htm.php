<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>商家管理平台</title>
<link href="templates/css/layout.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../js/jquery.js"></script>
<script type="text/javascript" src="../js/haohaios.js"></script>
<script type="text/javascript" src="../js/user.js"></script>
<script type="text/javascript" src="../js/region.js"></script>
<script type="text/javascript" src="../js/utils.js"></script>
<script type="text/javascript" src="templates/js/main.js"></script>
<script type="text/javascript" src="templates/js/supp.js"></script>
<script type="text/javascript" src="../<?php echo $this->_var['admin_path']; ?>/js/listtable.js"></script>
<script language="javascript" type="text/javascript" src="../js/DatePicker/WdatePicker.js"></script>
<script>
var process_request = "<?php echo $this->_var['lang']['process_request']; ?>";
</script>
</head>
<body >



<div class="headcon">
        <h1 title="商家管理平台" style="background:url('<?php echo $this->_var['business_logo']; ?>') 0 center no-repeat;">
      <div class="logo_text">商户管理中心</div>
    </h1>
        <div class="headright">
    <div class="welcome"></div>
            <div class="operate"><a href="?op=login&act=logout">退出登录</a>
            <?php if ($_SESSION['role_id'] == ''): ?>
            <a href="index.php?op=set&act=edit_password" target="mainn">修改密码</a>
            <?php endif; ?>
            <!-- 
            <a href="/store.php?id=<?php echo $this->_var['suppliers_id']; ?>" target="_blank">我的店铺</a>
             -->
            </div>
        </div>
    </div>

<div class="leftcon" >
<div class="menu_top"></div>
        <ul class="menu sideMenu">
      
            <li <?php if ($this->_var['action'] == 'default'): ?>  class="choise"<?php endif; ?>>

      <a href="index.php?op=main&act=default" target="mainn" class="home_welcome"><span>欢迎页</span></a>

            </li>
            <?php if ($this->_var['suppliers_array']['is_check'] == 1): ?>
            
            <li >
                <a href="javascript:;" class="article"><span>商品管理</span></a>

                <div class="second_menu" >

                
                <a href="?op=goods&act=my_goods" target="mainn"  class="goods <?php if ($this->_var['action'] == 'my_goods'): ?>choise<?php endif; ?>"><span><i></i>商品列表</span></a>

                    
                <a href="?op=goods&act=add_goods" target="mainn"  class="goods <?php if ($this->_var['action'] == 'add_goods'): ?>choise<?php endif; ?>"><span><i></i>新增商品</span></a>
                    
                <a href="?op=pic&act=pic_list" target="mainn"  class="goods <?php if ($this->_var['action'] == 'pic_list'): ?>choise<?php endif; ?>"><span><i></i>相册管理</span></a>

                <a href="?op=goods&act=goods_trash" target="mainn"  class="goods <?php if ($this->_var['action'] == 'goods_trash'): ?>choise<?php endif; ?>"><span><i></i>商品回收站</span></a>

                    
                </div>
                <div class="li_bottom"></div>
            </li>
            
                  
                        <li >
                <a href="javascript:;" class="article article2"><span>订单管理</span></a>

                <div class="second_menu" >
           <a href="?op=order&act=goods_order" target="mainn" class="goods  <?php if ($this->_var['action'] == 'goods_order'): ?>choise<?php endif; ?>"><span><i></i>发货订单</span></a>
                   <a href="?op=order&act=goods_order2" target="mainn" class="goods  <?php if ($this->_var['action'] == 'goods_order2'): ?>choise<?php endif; ?>"><span><i></i>自提订单</span></a>
                    <!-- 
                    <a href="?act=delivery" class="goods  <?php if ($this->_var['action'] == 'delivery'): ?>choise<?php endif; ?>"><span><i></i>到店提货</span></a>
                     
                   <a href="?act=delivery_list" class="goods  <?php if ($this->_var['action'] == 'delivery_list'): ?>choise<?php endif; ?>"><span><i></i>提货管理</span></a>
                   -->
              <a href="?op=order&act=shipping_delivery_list" target="mainn" class="goods  <?php if ($this->_var['action'] == 'shipping_delivery_list'): ?>choise<?php endif; ?>"><span><i></i>发货管理</span></a>
                </div>
                <div class="li_bottom"></div>
            </li>
            <li >
                <a href="javascript:;" class="article articl3"><span>结算管理</span></a>
                <div class="second_menu" >
                   <a href="?op=set&act=bank_config" target="mainn"  class="goods  <?php if ($this->_var['action'] == 'bank_config'): ?>choise<?php endif; ?>"><span><i></i>开户行设置</span></a>
                   <a href="?op=account&act=my_order" target="mainn" class="goods  <?php if ($this->_var['action'] == 'my_order'): ?>choise<?php endif; ?>"><span><i></i>订单结算</span></a>
                </div>
                <div class="li_bottom"></div>
            </li>
            
                  
                        <li >
                <a href="javascript:;" class="article article4"><span>商家管理</span></a>

                <div class="second_menu" >

                   <a href="?op=set&act=supp_info" target="mainn" class="goods  <?php if ($this->_var['action'] == 'supp_info'): ?>choise<?php endif; ?>"><span><i></i>店铺设置</span></a>
                   <a href="?op=bonus&act=bonus" target="mainn" class="goods  <?php if ($this->_var['action'] == 'bonus'): ?>choise<?php endif; ?>"><span><i></i>优惠券管理</span></a>
                  <a href="?op=set&act=ad" target="mainn" class="goods  <?php if ($this->_var['action'] == 'ad'): ?>choise<?php endif; ?>"><span><i></i>广告轮播</span></a>
                  <a href="?op=shipping&act=supp_shipping" target="mainn" class="goods  <?php if ($this->_var['action'] == 'supp_shipping'): ?>choise<?php endif; ?>"><span><i></i>配送方式</span></a>
                  <a href="?op=set&act=user_message" target="mainn" class="goods  <?php if ($this->_var['action'] == 'user_message'): ?>choise<?php endif; ?>"><span><i></i>用户评论</span></a>
       </div>
<div class="li_bottom"></div>
            </li>
            <li >
            <a href="javascript:;" class="article article5"><span>系统设置</span></a>
                 <div class="second_menu" >
                <a href="?op=set&act=edit_password" target="mainn" class="goods  <?php if ($this->_var['action'] == 'edit_password'): ?>choise<?php endif; ?>"><span><i></i>密码修改</span></a>
              </div>
<div class="li_bottom"></div>
            </li>
            <li >
            <a href="javascript:;" class="article article6"><span>统计报表</span></a>
                <div class="second_menu" >
                 <a href="?op=statistical&act=order_stats" target="mainn"  class="goods <?php if ($this->_var['action'] == 'order_stats'): ?>choise<?php endif; ?>"><span><i></i>订单统计</span></a>
                  <a href="?op=statistical&act=sale_list" target="mainn"  class="goods  <?php if ($this->_var['action'] == 'sale_list'): ?>choise<?php endif; ?>"><span><i></i>销售明细</span></a>
                  <a href="?op=statistical&act=sale_order" target="mainn"  class="goods  <?php if ($this->_var['action'] == 'sale_order'): ?>choise<?php endif; ?>"><span><i></i>销售排行</span></a>
                </div>
                
            </li>
            <?php else: ?>
                <li >
              <a href="javascript:;" class="goods"><span>店铺管理</span></a>
                <div class="second_menu" <?php if ($this->_var['action'] != ''): ?><?php else: ?> style="display:none;"<?php endif; ?>>
                <a href="?act=supp_info" target="mainn" class="goods choise"><span><i></i>账号设置</span></a>
                </div>

            </li>
            <?php endif; ?>

        </ul>

    </div>
    <!--div>
        <iframe src="index.php?op=main&act=default" id="mainn" name="mainn"   frameborder="0" scrolling="auto" marginheight="0" marginwidth="0" width="100%" >
        </iframe>
    </div-->

<script type="text/javascript">
 /* $(".sideMenu").slide({
      titCell:".article ", //鼠标触发对象
      targetCell:".second_menu", //与titCell一一对应，第n个titCell控制第n个targetCell的显示隐藏
      effect:"slideDown", //targetCell下拉效果
      delayTime:300 , //效果时间
      triggerTime:150, //鼠标延迟触发时间（默认150）
      defaultPlay:true,//默认是否执行效果（默认true）
      returnDefault:false, //鼠标从.sideMen移走后返回默认状态（默认false）
      trigger:"click"
    });*/

</script>

<script type="text/javascript" >
  //iframe高度自适应
   /* function frameresize(){
        var winheight = $(window).height();
        var iframeheight = winheight;
        $('#mainn').css('height', iframeheight + 'px');
    };
                                       
    if(window.attachEvent){
        document.getElementById("mainn").attachEvent('onload', frameresize);
    }
    else{
        document.getElementById("mainn").addEventListener('load', frameresize, false);
    }
                                       
    $(window).resize(frameresize);
    frameresize();*/
</script> 

<script>

function get_cat_list(id,type)

{

  $.ajax({
        url: 'user.php',
        type: 'GET',
        dataType : 'JSON' ,
        data:  'act=get_cat_list&id=' + id+'&type='+type ,
        success: function (data) {
          get_cat_listResponse(data);
        }
      });

}

function get_cat_listResponse(result)

{



    if(document.getElementById('show_cat_list_'+result.type))

    {

        document.getElementById('show_cat_list_'+result.type).innerHTML = result.html;

        //alert(result.html);

    }

}







 /**

   * 鏂板?涓€涓??鏍

   */

  function addSpec(obj)

  {

      var src   = obj.parentNode.parentNode;

      var idx   = rowindex(src);

      var tbl   = document.getElementById('attrTable');

      var row   = tbl.insertRow(idx + 1);

      var cell1 = row.insertCell(-1);

      var cell2 = row.insertCell(-1);

      var regx  = /<a([^>]+)<\/a>/i;



      cell1.className = 'label';

      cell1.innerHTML = src.childNodes[0].innerHTML.replace(/(.*)(addSpec)(.*)(\[)(\+)/i, "$1removeSpec$3$4-");

      cell2.innerHTML = src.childNodes[1].innerHTML.replace(/readOnly([^\s|>]*)/i, '');

  }



  /**

   * 鍒犻櫎瑙勬牸鍊

   */

  function removeSpec(obj)

  {

      var row = rowindex(obj.parentNode.parentNode);

      var tbl = document.getElementById('attrTable');



      tbl.deleteRow(row);

  }

  

  

function checkpic_category()

{

    if(document.myform.cat_name.value=='')

    {

        alert('请输入分类名称');

        return false;

    }

    return true;

}



function editPassword()

{

  var frm              = document.forms['formPassword'];

  var old_password     = frm.elements['old_password'].value;

  var new_password     = frm.elements['new_password'].value;

  var confirm_password = frm.elements['comfirm_password'].value;



  var msg = '';

  var reg = null;



  if (old_password.length == 0)

  {

    msg +=  '旧密码不能为空\n';

  }



  if (new_password.length == 0)

  {

    msg +=  '新密码不能为空\n';

  }



  if (confirm_password.length == 0)

  {

    msg += '确认密码不能为空\n';

  }



  if (new_password.length > 0 && confirm_password.length > 0)

  {

    if (new_password != confirm_password)

    {

      msg +=   '新密码俩次输入不一致\n';

    }

  }
  if (msg.length > 0)
  {
    alert(msg);
    return false;

  }
  else
  {
    return true;
  }
}   
function checkarticle()
{
    if(document.myform.title.value=='')
    {
        alert('请输入标题');
        return false;
    }
    if(document.myform.cat_id.value=='')
    {
        alert('请选择分类');
        return false;
    }
    return true;
}





    

/**

 * 添加图片

**/

  function addImg(obj)

  {

     

      var src  = obj.parentNode.parentNode; 

     

      var idx  = rowindex(src);

      var tbl  = document.getElementById('gallery-table');

      var row  = tbl.insertRow(idx + 1);

    

      //var cell = row.insertCell(-1);

      row.innerHTML = src.innerHTML.replace(/(.*)(addImg)(.*)(\[)(\+)/i, "$1removeImg$3$4-");

      

    

  }

  

  

  function removeImg(obj)

  {

      var row = rowindex(obj.parentNode.parentNode);

      var tbl = document.getElementById('gallery-table');

      tbl.deleteRow(row);

  }





  /**

   * 删除已上传图片

   */

  function dropImg(imgId)

  {

    

    $.ajax({
        url: 'index.php?op=goods&act=drop_image',
        type: 'GET',
        data:  'img_id='+imgId ,
        dataType : 'JSON' ,
        success: function (data) {
          dropImgResponse(data);
        }
      });

  }



  function dropImgResponse(result)

  {

      if (result.error == 0)

      {

          document.getElementById('gallery_' + result.content).style.display = 'none';

      }

  }
//提货单打印
  function de_print()
  {
      window.open("index.php?op=order&act=delivery_info_print&delivery_id=<?php echo $this->_var['delivery_order']['delivery_id']; ?>");
  }
 //切换
  function toggle(obj, act, id)
  {
    var val = (obj.innerHTML.match(/是/i)) ? 0 : 1;
    $.ajax({
        url: 'this.url',
        type: 'POST',
        dataType : 'JSON' ,
        data:  'act='+act+'&val=' + val + '&id=' +id ,
        async:false,
        success: function (res) {
             if (res.message)
              {
                alert(res.message);
              }
              if (res.error == 0)
              {
                obj.innerHTML = (res.content > 0) ? '是' : '否';
              }
        }
      });

   
  }

  function account_detail_sub(){
        var remark=document.getElementById('remark').value;     
        if(remark==''){
            alert('请填写内容');
            return false;
        }
        $.ajax({
              type:"post",//请求类型
              url:"index.php",//服务器页面地址
              data:"remark="+remark+"&act=account_detail_form&id=<?php echo $this->_var['suppliers_accounts_id']; ?>",//参数(可有可无)
              dataType:"json",//服务器返回结果类型(可有可无)
              error:function(data){//错误处理函数(可有可无)
                 alert("ajax出错啦");
              },
              success:function(data){
                  alert(data.content);              
              }
            });
        return false;               
 }
 function account_confirm(id,type)
 {
     
     
     var remark=document.getElementById('accounts_desc').value;     
        $.ajax({
              type:"post",//请求类型
              url:"index.php?op=account",//服务器页面地址
              data:"remark="+remark+"&act="+type+"&id="+id,//参数(可有可无)
              dataType:"json",//服务器返回结果类型(可有可无)
              error:function(data){//错误处理函数(可有可无)
                 alert("ajax出错啦");
              },
              success:function(data){
                  alert('操作成功');
                 window.location.href='index.php?op=account&act=account_detail&suppliers_accounts_id='+id;
                 //account_detail&suppliers_accounts_id=46 my_order
              }
            });
        return false;               
 }
 
</script>
</body>
</html>