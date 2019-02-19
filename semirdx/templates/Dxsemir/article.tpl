{%include file="./header.tpl"%}
{%include file="./breadcrumb.tpl"%}
<!-- container  -->
<div class="container">
  <div class="row"> 
    <!-- main  -->
    <div class="col-xs-12 col-sm-9">
    <!-- panel left -->
       
        <div class="page-header">
        	<h3>{%$pageInfo->menuName%}</h3> 
        </div>
         <ul class="article-list">
         {%foreach from=$data['articlestemp'] item=row%}
         <li>
         {%if $row->article_pic != ''%}
         	<div class=" imgshow pull-left" style="width:10%;"><a href='{%site_url("article/{%$pageInfo->menuUrl%}/{%$row->article_id%}")%}'><img src='{%base_url()%}attachments/article/{%$row->article_pic%}' class="img-rounded img-responsive"  ></a></div>
            {%/if%}
         	<div class="title"> <a href='{%site_url("article/{%$pageInfo->menuUrl%}/{%$row->article_id%}")%}'>{%$row->title%}</a></div>
         	<small>{%$row->description%}</small>
            <div class="clearfix"> </div>
         </li>
         {%/foreach%}
         </ul>
       
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

{%include file="./foot.tpl"%}