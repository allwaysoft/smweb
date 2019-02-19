{%include file="./header.tpl"%}
{%include file="./breadcrumb.tpl"%}
<!-- container  -->
<div class="container">
  <div class="row"> 
    <!-- main  -->
    <div class="col-xs-12 col-sm-9">
    <!-- panel left -->
    {%if $content%}
        <div class="page-header">
        	<h3>{%$content->title%}</h3> 
        </div>
        {%if $content->article_pic != ''%}
    <!--/*    <div class="col-xs-12 col-sm-4 pull-right">
       		  <img src='{%base_url()%}attachments/article/{%$content->article_pic%}' class="img-rounded img-responsive"  >
          </div>*/-->
         {%/if%}
        <div class="page-content">
        <p>{%$content->content%}</p>
        </div>
         {%else%}
         	请确认访问路径是否正确！！
         {%/if%}
     
       <!-- panel left -->
    </div>
    <!-- main end  --> 
    <!-- right  --> 
     <div class="col-xs-12 col-sm-3">
    <!-- panel right -->
    <div class="menuCenter">
      {%$menuCenter%}
      </div>
       <div class="right-side-page">
       {%include file="./right.tpl"%}
       </div>
       <!-- panel right end -->
    </div>
    <!-- right end  --> 
  </div>
</div>
<!-- container ---> 
 <p>&nbsp;</p>
{%include file="./foot.tpl"%}