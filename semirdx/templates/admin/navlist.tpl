 
 
<nav class="  hidden-print " >
<br />
  <ul class="nav  navList " id="navList" >
    <li class=" {%if $classid==0%}
                            active
                       {%/if%}"> <a href="{%site_url('admin')%}/article" >All contents</a></li>
    {%foreach from=$menuAll item=row%}
    {%if $row->menuTh %}
    <li class=" 
                        {%if  $data['menuThis']->parent_id==$row->id %}
                            active
                       {%/if%}
                      "
                      > <a class=""  data-toggle="collapse"   href="#{%$row->menuUrl%}"  >{%$row->menuName%}<b class="caret"></b></a>
      <ul class="nav  collapse {%if $data['menuThis']->parent_id==$row->id %}
                            in
                       {%/if%}" id="{%$row->menuUrl%}">
        {%foreach from=$row->menuTh item=rowt%}
        <li class=" 
                        {%if $classid==$rowt->id %}
                            active
                       {%/if%}
                      " > <a href="{%site_url()%}admin/{%$rowt->admin_mt_url%}/index/{%$rowt->id%}" > {%$rowt->menuName%}</a>
        {%/foreach%}
      </ul>
      {%else%}
    
    <li class="
                      {%if $classid==$row->id %}
                            active
                       {%/if%}
                      "
                      > {%if (strpos($row->menuUrl, "http://") !== false)%} <a href="{%$row->menuUrl%}" target="_blank" > {%$row->menuName%}</a> {%else%} <a href="{%site_url()%}admin/{%$row->admin_mt_url%}/index/{%$row->id%}" > {%$row->menuName%}</a> {%/if%}
      {%/if%} </li>
    {%/foreach%}
  </ul>
</nav>
