<?php if (!defined('THINK_PATH')) exit();?> 
 
  <!-- top ----->
  <div><strong>贷款信息：</strong></div>
  <!-- top -----> 
  <div class="">
  贷款编号:<?php echo ($reginfo['sap_code']); ?>, 贷款：<?php echo ($reginfo['reg_amount']); ?> 万元 / <?php echo ($reginfo['sap_cycle']); ?> 天 / <?php echo ($reginfo['sap_start_time']); ?>~<?php echo ($reginfo['sap_end_time']); ?>
  </div>
  <hr />
  <!-- main ----->
   <div><strong>还款记录</strong></div>
  <div class="row">
    <div class="col-xs-12"> 
      <form action="" method=" "> 
        <table  id="listTable" class="table table-condensed table-hover table-striped table-bordered "  cellspacing="0" >
          <thead>
            <tr>
              <th width="39%">还款日期 <span class="sr-only">还款日期</span></th> 
              <th width="34%">还款SAP单号<span class="sr-only">还款单号</span></th>  
              <th width="27%">还款金额(万元)<span class="sr-only">还款金额(元)</span></th>  
             
            </tr>
          </thead>
          <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
            <td><?php echo ($vo["rep_date"]); ?></td> 
            <td><?php echo ($vo["sap_rep_code"]); ?></td>
            <td><?php echo ($vo["rep_amount"]); ?></td>
          </tr><?php endforeach; endif; else: echo "" ;endif; ?>
        </table>
      </form>
    </div>
  </div>
  <!-- main -->