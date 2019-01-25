<?php if (!defined('THINK_PATH')) exit();?><style></style>
 

<div class="row margin-null" >
<div class="col-sm-12" id="info"> 
    <!-- modal body start -->
    <div class="col-sm-2" >
      <p class="lead">基本信息</p>
    </div>
    <div class="col-sm-10" >
      <p class="pull-right small"><?php echo (date("Y-m-d H:i:s",$info["add_time"])); ?></p>
      <p >投诉编号：<?php echo ($info["com_code"]); ?> </p>
      <p >投 诉 人：<?php echo ($info["agent_code"]); ?>  / <?php echo ($info["agent_storename"]); ?>  /   <?php echo ($info["agent_name"]); ?>  / <?php echo ($info["agent_province"]); ?> / <?php echo ($info["agent_area"]); ?></p>
      <p >联 系 人：<?php echo ($info["agent_person"]); ?>  /  <?php echo ($info["agent_tel"]); ?></p>
      <hr>
      <p >投诉描述：</p>
      <p class=""><?php echo ($info["com_contents"]); ?></p>
    </div> 
</div>
  <!--item --> 
<?php if(!empty($tracklist)): ?><div class="col-sm-12" id="track" >
    <hr>
    <div class="col-sm-2" >
      <p class="lead">客服回复</p>
    </div>
    <div class="col-sm-10" >
      <?php if(is_array($tracklist)): $i = 0; $__LIST__ = $tracklist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><blockquote>
          <p><?php echo ($vo["tra_contents"]); ?></p>
          <footer> <span class="text-danger">
            <?php if(($vo["tra_type"]) == "1"): ?>拒收/驳回<?php endif; ?>
            <?php if(($vo["tra_type"]) == "2"): ?>启动OA<?php endif; ?>
            <?php if(($vo["tra_type"]) == "3"): ?>接收回复<?php endif; ?>
             <?php if(($vo["tra_type"]) == "99"): ?>废弃<?php endif; ?>
            </span> <cite title="Source Title "><?php echo ($vo["com_user"]); ?> / <?php echo (date("Y-m-d H:i:s",$vo["add_time"])); ?></cite> </footer>
        </blockquote><?php endforeach; endif; else: echo "" ;endif; ?>
    </div>
  </div><?php endif; ?>
  <!--item --> 
 
    <!--item --> 
</div>