<?php if (!defined('THINK_PATH')) exit();?>


<!--  container  -->

<div class="container"> 
  <!-- top ----->
  <div class="row">
    <div class="col-xs-12">
      <div class="topRightBut pull-right">
        <button type="button" name="addBut" class="btn btn-success  btn-sm">ADD</button>
      </div>
      <h1> <a href="../Public_head.html">Register </a></h1>
    </div>
  </div>
  <!-- top ----->
  <div class="h20"></div>
  <!-- main ----->
  <div class="row">
    <div class="col-xs-12">
      <form action="" method=" ">
        <table  id="listTable" class="table table-striped table-bordered "  cellspacing="0" width="100%">
          <thead>
            <tr>
              <th>RegDate <span class="sr-only"></span></th>
              <th>RegCycle <span class="sr-only">申请天数</span></th>
              <th>Amount<span class="sr-only">金额(元</span></th>
              <th>start<span class="sr-only">申请开始</span></th>
              <th>Status<span class="sr-only">状态</span></th>
              <th>Number<span class="sr-only">SAP单号</span></th>
              <th>Cycle<span class="sr-only">贷款周期(天)</span></th>
              <th>start<span class="sr-only">起始日</span></th> 
              <th>End<span class="sr-only">到期</span></th>  
            </tr>
          </thead>
        </table>
      </form>
    </div>
  </div>
  <!-- main --> 
</div>
<!--  container  --> 
<script type="text/javascript">
 
</script>
<script type="text/javascript" src="/<?php echo c('VIEW_PATH');?>Loanpi/Layout/js/register.js"></script>