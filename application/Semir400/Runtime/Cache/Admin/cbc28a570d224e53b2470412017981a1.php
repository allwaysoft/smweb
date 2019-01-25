<?php if (!defined('THINK_PATH')) exit();?> <link rel="stylesheet" type="text/css" href="<?php echo RES;?>/public/upload/css/css.css?<?php echo time();?>" /> 
 <link rel="stylesheet"  href="<?php echo RES;?>/public/zoom/css/zoom.css" media="all" />
 <script type="text/javascript">
    $(document).ready(function(){
    
 
});
</script>
<style>
li{list-style-type:none;float:left;}
.zoomed > .container{-webkit-filter:blur(3px);filter:blur(3px);} 
.gallery{list-style-type:none;float:left;background:#ffffff;padding:20px 20px 10px 20px;margin:0;-webkit-box-shadow:0 1px 3px rgba(0,0,0,0.25);-moz-box-shadow:0 1px 3px rgba(0,0,0,0.25);box-shadow:0 1px 3px rgba(0,0,0,0.25);-webkit-border-radius:2px;-moz-border-radius:2px;border-radius:2px;}
.gallery li{float:left;padding:0 10px 10px 0;}
.gallery li:nth-child(6n){padding-right:0;}
.gallery li a,.gallery li img{float:left;}
</style>
<div class="row">
<!-- modal body start -->
<div class="col-sm-12" id="info">
 <!-- base -->
  <div class="col-sm-2" >
    <p class="lead">基本信息</p>
  </div>
  <div class="col-sm-10" > 
    <!-- item -->
    <p class="pull-right small"><?php echo (date("Y-m-d H:i:s",$info["add_time"])); ?></p>
    <p >投诉编号：<?php echo ($info["com_code"]); ?> </p>
    <p >投 诉 人：<?php echo ($info["agent_code"]); ?>  / <?php echo ($info["agent_storename"]); ?>  /   <?php echo ($info["agent_name"]); ?>  / <?php echo ($info["agent_province"]); ?> / <?php echo ($info["agent_area"]); ?></p>
    <p >联 系 人：<?php echo ($info["agent_person"]); ?>  /  <?php echo ($info["agent_tel"]); ?></p>
    <hr>
    <div class="row"> 
      <!-- item -->
      <div class="col-sm-4" >
        <p >款 号：<?php echo ($info["style_id"]); ?></p>
        <p > 色号：<?php echo ($info["color_id"]); ?> </p>
        <p > 次品数量：<?php echo ($info["number"]); ?></p>
        <p > 购买时间：<?php echo ($info["sale_time"]); ?></p>
        <p > 销售类型：
          <?php if(($info["sale_type"]) == "0"): ?>未销售<?php endif; ?>
          <?php if(($info["sale_type"]) == "1"): ?>已销售<?php endif; ?>
        </p>
      </div>
      <!-- item --> 
      <!-- item -->
      <div class="col-sm-8" >
        <p class="text-danger">投诉类别：
          <?php if(($info["com_type"]) == "1"): ?>照片鉴定<?php endif; ?>
          <?php if(($info["com_type"]) == "2"): ?>实物鉴定<?php endif; ?>
        </p>
        <?php if(($info["com_type"]) == "1"): ?><div class="gallery" >
	      <ul>
          <?php if(is_array($info["com_pic"])): $i = 0; $__LIST__ = $info["com_pic"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vp): $mod = ($i % 2 );++$i;?><li class="uploadResult"> 
            	<a href="<?php echo ($vp); ?>"><img src="<?php echo ($vp); ?>" class="previewImage"/> </a>
            </li><?php endforeach; endif; else: echo "" ;endif; ?>
          </ul>
        </div><?php endif; ?>
        <?php if(($info["com_type"]) == "2"): ?><p > 快递公司：<?php echo ($info["com_express"]); ?></p>
          <p > 快递单号：<?php echo ($info["com_express_number"]); ?></p>
          <p > 回寄地址：<?php echo ($info["com_express_address"]); ?></p><?php endif; ?>
      </div>
      <!-- item --> 
    </div>
    <!-- item -->
    <hr />
    <!-- item -->
    <p >投诉描述：</p>
    <p class=""><?php echo ($info["com_contents"]); ?></p>
    <!-- item --> 
    
  </div>
 <!-- base -->
 
<?php if(!empty($follow)): ?><div class="col-sm-2" >
    <p class="lead">信息追加</p>
  </div>
  <div class="col-sm-10" > 
    <?php if(is_array($follow)): $i = 0; $__LIST__ = $follow;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><hr/>
    <div class="row">
    <div class="col-sm-4" >
    <?php echo (date("Y-m-d H:i:s",$vo["add_time"])); ?>
    </div>
         <div class="col-sm-10" >
        <p class="text-danger">投诉类别：
          <?php if(($vo["com_type"]) == "1"): ?>照片鉴定<?php endif; ?>
          <?php if(($vo["com_type"]) == "2"): ?>实物鉴定<?php endif; ?>
        </p>
        <?php if(($vo["com_type"]) == "1"): ?><div class="gallery" >
	      <ul>
          <?php if(is_array($vo["fol_pic"])): $i = 0; $__LIST__ = $vo["fol_pic"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><li class="uploadResult"> 
            	<a href="<?php echo ($v); ?>"><img src="<?php echo ($v); ?>" class="previewImage"/> </a>
            </li><?php endforeach; endif; else: echo "" ;endif; ?>
          </ul>
        </div><?php endif; ?>
        <?php if(($vo["com_type"]) == "2"): ?><p > 快递公司：<?php echo ($vo["fol_express"]); ?></p>
          <p > 快递单号：<?php echo ($vo["fol_express_number"]); ?></p>
          <p > 回寄地址：<?php echo ($vo["fol_express_address"]); ?></p><?php endif; ?>
      </div>
      </div>
      <hr />
    <!-- item -->
    <p >投诉描述：</p>
    <p class=""><?php echo ($vo["fol_contents"]); ?></p>
    <!-- item --><?php endforeach; endif; else: echo "" ;endif; ?>
      </div><?php endif; ?>

 <!--tracklist --> 
 <!--tracklist --> 
<?php if(!empty($tracklist)): ?><div class="col-sm-12" id="track" >
    <hr>
    <div class="col-sm-2" >
      <p class="lead">客服回复 <i class="fa fa-comments-o" aria-hidden="true"></i></p>
    </div>
    <div class="col-sm-10" >
      <?php if(is_array($tracklist)): $i = 0; $__LIST__ = $tracklist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><blockquote>
         <p class="blockquote_title text-primary">
         投诉主题：<?php echo ($vo["com_title"]); ?>  
         &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;季度：<?php echo ($vo["com_quarter"]); ?>   
         
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;保质期内： <?php if(($vo["com_deadline"]) == "1"): ?>是<?php endif; ?>
                 <?php if(($vo["com_deadline"]) == "2"): ?>否<?php endif; ?>
         
         </p>
          <p><?php echo ($vo["tra_contents"]); ?></p>
          <footer> <span class="text-danger">
              <?php if(($vo["tra_type"]) == "1"): ?>不接收<?php endif; ?>
                <?php if(($vo["tra_type"]) == "2"): ?>启动OA<?php endif; ?>
                <?php if(($vo["tra_type"]) == "3"): ?>图片鉴定<?php endif; ?>
                <?php if(($vo["tra_type"]) == "4"): ?>实物鉴定<?php endif; ?>
                <?php if(($vo["tra_type"]) == "5"): ?>接收<?php endif; ?>
                 <?php if(($vo["tra_type"]) == "99"): ?>废弃<?php endif; ?>
            </span> <cite title="Source Title "><?php echo ($vo["com_user"]); ?> / <?php echo (date("Y-m-d H:i:s",$vo["add_time"])); ?></cite> </footer>
        </blockquote><?php endforeach; endif; else: echo "" ;endif; ?>
    </div>
  </div><?php endif; ?>
  <!--tracklist --> 
 
  <!-- modal body start -->
   
  
</div>
 <script type="text/javascript" src="<?php echo RES;?>/public/zoom/js/zoom.min.js"></script>