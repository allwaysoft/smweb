<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<title>森马--400客服平台</title>
<meta http-equiv="semir" content="Yes" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="<?php echo RES;?>/public/css/bootstrap.css" rel="stylesheet">
<link href="<?php echo RES;?>/public/js/bootstrap-dialog/css/bootstrap-dialog.css" rel="stylesheet">
 <!-- Loading Flat UI -->
   
<script type="text/javascript" src="<?php echo RES;?>/public/jquery.min1.11.3.js"></script> 

<!-- Loading Bootstrap -->
<script type="text/javascript" src="<?php echo RES;?>/public/js/bootstrap.min.js"></script>

<script type="text/javascript" src="<?php echo RES;?>/public/js/bootstrap-dialog/bootstrap-dialog.min.js"></script>

<script type="text/javascript" src="<?php echo RES;?>/public/js/bootstrap-validator/bootstrapValidator.min.js"></script>
<script type="text/javascript" src="<?php echo RES;?>/public/jquery.form.js"></script><!-- up file blug -->
<link href="<?php echo RES;?>/public/Font-Awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link href="<?php echo RES;?>/public/js/dataTables/dataTables.bootstrap.css" rel="stylesheet" type="text/css">

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
      <script src="//cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="//cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

<link rel="stylesheet" type="text/css" href="<?php echo RES;?>/Index/css/layout.css"  />
</head>
<body>

<a name="top" id="top"></a> 
 <script type="text/javascript" src="<?php echo RES;?>/public/iviewer-master/jqueryui.js" ></script>
<script type="text/javascript" src="<?php echo RES;?>/public/iviewer-master/jquery.mousewheel.js" ></script>
 <script type="text/javascript" src="<?php echo RES;?>/public/iviewer-master/jquery.iviewer.js" ></script>
 <link rel="stylesheet" href="<?php echo RES;?>/public/iviewer-master/style.css" />
  <link rel="stylesheet" href="<?php echo RES;?>/public/iviewer-master/jquery.iviewer.css" />
  
<header> 
    <div class="container-fluid" style="background-color:#223126"> 
    <div class="container">
     <a class="navbar-brand pull-right" href="#"><img src="/<?php echo c('VIEW_PATH');?>Loanpi/Layout/images/logow.png" width="120px"  alt=""/></a> 
    <p style="color:#FFF; padding-top:10px; font-size:20px">400客服-照片鉴定</p>
   
    
    </div>
      
      </div>
    </div>
  
</header>
<div class="container">
  <div id="msgShow"></div>
  <!-- top ----->
  <div class="row">
    <div class="col-xs-12">
      <div class="topRightBut pull-right">  <a href="javascript:closeWin();"  class="btn btn-info  btn-sm"><span class="glyphicon glyphicon-remove-circle"></span> 关闭本窗口</a> </div>
      <h1><span class="glyphicon glyphicon-paperclip"></span> 投诉详细信息 </h1>
    </div>
  </div>
  <!-- top ----->
  <div class="h20"></div>
  <!-- main ----->
  <div class="row">
    <div class="col-sm-12"> 
      <!-- base -->
      <div class="col-sm-2" >
        <p class="lead">基本信息</p>
      </div>
      <div class="col-sm-10" > 
        <!-- item -->
        <p class="pull-right small"><?php echo (date("Y-m-d H:i:s",$info["add_time"])); ?></p>
        <p >投诉编号：<?php echo ($info["com_code"]); ?> </p>
        <p >投 诉 人：<?php echo ($info["agent_code"]); ?>  /   <?php echo ($info["agent_storename"]); ?>  / <?php echo ($info["agent_name"]); ?>  / <?php echo ($info["agent_province"]); ?> / <?php echo ($info["agent_area"]); ?></p>
       
        <hr>
        <div class="row"> 
          <!-- item -->
          <div class="col-sm-4" >
            <p >款 号：<?php echo ($info["style_id"]); ?></p>
             <p > 色号：<?php echo ($info["color_id"]); ?> </p>
            <p > 次品数量：<?php echo ($info["number"]); ?></p>
            <p > 购买时间：<?php echo ($info["sale_time"]); ?></p>
            
          </div>
          <!-- item --> 
          <!-- item -->
          <div class="col-sm-8" >
          
             <p class="text-danger">
              <?php if(($info["com_type"]) == "1"): ?>照片鉴定 <a href="/semir400.php/sales/download/si/<?php echo ($info["id"]); ?>" > 打包下载</a><?php endif; ?> 
            </p>
            <?php if(($info["com_type"]) == "1"): ?><div class="row gallery" >
                  <?php if(is_array($info["com_pic"])): $i = 0; $__LIST__ = $info["com_pic"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="uploadResult col-sm-3"> <a href="<?php echo ($vo); ?>"   class="go" rel="gallery"><img src="<?php echo ($vo); ?>" class="img-responsive previewImage"/> </a> </div><?php endforeach; endif; else: echo "" ;endif; ?>
                
              </div><?php endif; ?>
           
          </div>
          <!-- item --> 
        </div>
        <!-- item -->
        <hr />
        <!-- item -->
        <p >投诉描述： <?php echo ($info["com_contents"]); ?></p>
        <!-- item -->
       
      </div>
      <!-- base --> 
      <!-- follow -->
      <?php if(!empty($follow)): if(is_array($follow)): $i = 0; $__LIST__ = $follow;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if(($vo["com_type"]) == "1"): ?><div class="row">
        <div class="col-sm-12">
          <hr>
          <div class="col-sm-2" >
            <p class="lead">提交图片历史</p>
          </div>
          <div class="col-sm-10" > 
            <!-- item -->
            
            <div class="row">
              <div class="col-sm-12">
                 <p class="pull-right small"><?php echo (date("Y-m-d H:i:s",$vo["add_time"])); ?></p>
                <p class="text-danger">照片鉴定
                </p>
              </div>
              <div class="col-sm-12">
             
               <div class="row gallery" >
                  
                    <?php if(is_array($vo["fol_pic"])): $i = 0; $__LIST__ = $vo["fol_pic"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><div class="uploadResult col-sm-3"> <a href="<?php echo ($v); ?>"  class="go" rel="gallery"><img src="<?php echo ($v); ?>" class="img-responsive previewImage"/> </a> </div><?php endforeach; endif; else: echo "" ;endif; ?>
                 
                  <div class="clearfix"></div>
                </div> 
             
               
            </div>
            <div class="col-sm-12">
              <p> 问题描述：<?php echo ($vo["fol_contents"]); ?> </p>
            </div>
          </div>
          <hr />
         
          <!-- item --> 
        </div>
      </div>
    </div><?php endif; endforeach; endif; else: echo "" ;endif; endif; ?>
    <!-- follow --> 
    <!--tracklist -->
   
    <!--tracklist -->  
    
  </div>
</div>

 <div class="row">
    <div class="col-xs-12">
      <div class="topRightBut pull-right">  <a href="javascript:closeWin();"  class="btn btn-info  btn-sm"><span class="glyphicon glyphicon-remove-circle"></span> 关闭本窗口</a> </div>
      
    </div>
  </div>
  
  
</div>

<!-- -->
 <div id="iviewer">
        <div class="loader"></div>
       
        <div class="viewer" style=""></div>
 
        <ul class="controls">
            <li class="close"> </li>
            <li class="zoomin"></li>
            <li class="zoomout"></li>  
                
        </ul>

	 <div class="info" >            		
	 	<a href="#" id="prevLink" class="go"  ><span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span></a>
		<p id="imageCount"></p>
		<a href="#" id="nextLink" class="go"  ><span class="glyphicon glyphicon-arrow-right" aria-hidden="true"></span></a>       
        </div>        
    </div>
<!-- -->
<script>
 
	(function($) {
    var gallery = new Array();
    function init() {	
        var viewer = $("#iviewer .viewer").
        width($(window).width() - 80).
        height($(window).height()).
        iviewer({
            ui_disabled : true,
            zoom : 'fit',
			
            onFinishLoad : function(ev) {
                $("#iviewer .loader").fadeOut();
                $("#iviewer .viewer").fadeIn();			
            }
        }
        );

        $("#iviewer .zoomin").click(function(e) {
            e.preventDefault();
            viewer.iviewer('zoom_by', 1);
        });

        $("#iviewer .zoomout").click(function(e) {
            e.preventDefault();
            viewer.iviewer('zoom_by', -1);
        });

        /*
         * Populate gallery array.
         * NOTE: In order to add image to gallery, Anchor tag of images that are to be opened in lightbox, should have attribute 'rel' set to 'gallery'.
         */
        $( "a[rel='gallery']" ).each(function( index ) {
            gallery[index] =  $( this ).attr("href");	    
        });
    }

    function open(src) {
        $("#iviewer").fadeIn().trigger('fadein');
        $("#iviewer .loader").show();
        $("#iviewer .viewer").hide();

        var viewer = $("#iviewer .viewer")
        .iviewer('loadImage', src)
        .iviewer('set_zoom', 'fit');
    }

    function close() {
        $("#iviewer").fadeOut().trigger('fadeout');
    }

    $('.go').click(function(e) {
        e.preventDefault();
        var src = $(this).attr('href');
        open(src);
        // Refresh next and prev links
        refreshNextPrevLinks(src);
    });

    $("#iviewer .close").click(function(e) {
        e.preventDefault();
        close();
    });

    $("#iviewer").bind('fadein', function() {
        $(window).keydown(function(e) {
            if (e.which == 27) close();
        });
    });

    /*
    *  refreshNextPrevLinks() refreshes Next and previous links
    */
    function refreshNextPrevLinks(src){
	console.log('RefreshNextPrevLinks called. src: '+src);
        var imageIndex = 0;
        //Iterate over gallery and find the index of current image.
        for (i=0;i<gallery.length;i++)
        {         
	 if(src == gallery[i]){
                imageIndex = i;
            }
        }
	
        //Setting Next link
        var nextLink = document.getElementById('nextLink');
        if(gallery.length > imageIndex+1){
            nextLink.href =  gallery[imageIndex+1];
            nextLink.style.visibility = 'visible';
        }else{
            nextLink.href = "#";
            nextLink.style.visibility = 'hidden';
        }	

        //Setting Prev link
        var prevLink = document.getElementById('prevLink');
        if(imageIndex > 0){
            prevLink.href = gallery[imageIndex-1];
            prevLink.style.visibility = 'visible';
        }else{
            prevLink.setAttribute("href", "#");
            prevLink.style.visibility = 'hidden';
        }	

        document.getElementById('imageCount').innerHTML= "图片: "+ (imageIndex+1) + "/" + gallery.length;	
    }

    //Binding keypress event of left arrow and right arrow button. Image would be changed, if right arrow or left arrow button is pressed.
    $(document).keyup(function(e) {
        //left arrow key
        if (e.keyCode == 37) { 
            if($("#prevLink").attr("href") != "#"){
                $("#prevLink").click();
            }
        }
        //right arrow
        if (e.keyCode == 39) {
            if($("#nextLink").attr("href") != "#"){
                $("#nextLink").click();
            }
        }
    });

    init();
})(jQuery);
  
   
  </script>
 <!-- footer -->
   <div class="h20"></div>
<footer>
 <div class="container">
  <div class="row  footer" > 
    <!-- main  -->
    <div class="col-xs-12 "> 
     <p class="" >  
    
 	  商品售后服务热线：400-8877-588 ,  技术支持专线：0577-85789999<br />
      All Rights Reserved &copy;  <?php echo date('Y');?> 森马</p>
    </div>
     
    </div>
 </div>
</footer>
<!-- footer -->
<script src="/<?php echo c('VIEW_PATH');?>Loanpi/public/js/dataTables/jquery.dataTables.js"></script> 
<script src="/<?php echo c('VIEW_PATH');?>Loanpi/public/js/dataTables/dataTables.bootstrap.js"></script>  
</body>
</html> 
<script>
function closeWin() { 
  window.opener=null;
  window.open('','_self');
  window.close();
}
  $(function(){
	  
  });
  </script>