<div class="container-full palette-clouds"
{%if $pageInfo->menuPic%}
 style="background:transparent url({%$base_url%}attachments/menu/{%$pageInfo->menuPic%})  no-repeat scroll center top / cover;"
  {%else%}  
     style="background:transparent url({%$base_url%}templates/{%$web_template%}/images/pageb1.jpg)  no-repeat scroll center top / cover;"
     {%/if%}
 >
 <div class="container">
  <ol class="breadcrumb "  >
    <li><a href="{%site_url('/')%}">首页</a></li> 
      {%if ($menuPath)%}
     	 {%foreach from=$menuPath item=foo%} 
      	 <li class="active">{%$foo%}</li>
         {%/foreach%}
        {%else%}  
     <li class="active">{%$pageInfo->menuName%}</li>
     {%/if%}
 
  </ol>
  </div>
</div>
            