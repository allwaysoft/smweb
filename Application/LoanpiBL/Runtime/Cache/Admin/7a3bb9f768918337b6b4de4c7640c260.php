<?php if (!defined('THINK_PATH')) exit();?> 
  <div class="row">
    <div class="col-sm-12">
      <form name="subForm" id="subForm"  class="form-horizontal"  method="post"   enctype='multipart/form-data' action="" role="form">
        <div class="my-form form-horizontal"> 
          <!-- modal body start -->
          <div class="form-group form-group-sm">
            <label class="col-sm-3 control-label" for="">操作日期</label>
            <div class="col-sm-4 ">
               <p class="form-control-static "><?php echo ($data['update']); ?></p>
            </div>
          </div>
          <!--item --> 
          <div class="form-group form-group-sm">
            <label class="col-sm-3 control-label" for="">操作人</label>
            <div class="col-sm-4">
            <p class="form-control-static "><?php echo ($data['user']); ?></p>
            </div>
          </div>
           <!--item --> 
          <div class="form-group form-group-sm">
            <label class="col-sm-3 control-label" for="">操作</label>
            <div class="col-sm-4">
              <p class="form-control-static "><?php echo ($data['title']); ?></p>
            </div> 
          </div>
           <!--item -->
          <!--item -->
          <div class="form-group form-group-sm">
            <label class="col-sm-3 control-label" for="">操作状态</label>
            <div class="col-sm-4">
              <p class="form-control-static "><?php echo ($data['status']); ?></p>
            </div> 
          </div>
           <!--item -->
            <!--item -->
          <div class="form-group form-group-sm">
            <label class="col-sm-3 control-label" for="operating">执行数据</label>
            <div class="col-sm-4">
              <div><p class="form-control-static "><?php echo ($data['operating']); ?></p></div>
            </div> 
          </div>
           <!--item -->
           <!--item -->
        </div>
        
      </form>
    </div>
  </div> 
  <!-- top ----->