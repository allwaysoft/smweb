<?php if (!defined('THINK_PATH')) exit();?>﻿<!-- message ----->
 
    <div class="alert alert-danger" role="alert">
      <div class="media">
        <div class="media-left lead"><i class="fa fa-bell-o " aria-hidden="true"></i> </div>
        <div class="media-body"> 还款提醒:
          <strong>您的贷款：<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>/ <?php echo ($vo["sap_code"]); endforeach; endif; else: echo "" ;endif; ?> 即将到期或已经过期，请及时还款！！</strong>
        </div>
      </div>
    </div>
 
<!-- message ----->