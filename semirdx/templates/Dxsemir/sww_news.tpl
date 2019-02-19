 
<ul class="fadeInRight top_left_cont animated wow newslist">
            {%foreach from=$data['news'] item=row key=key  name=foo%}
            <li  > <a href="/semirdx/index.php/index/get_sww_newInfo/{%$row->id%}" target="_blank"  class="newsLink"> 
              <div class="title" title="{%$row->title%}"><i class="fa fa-angle-right"></i> {%$row->title|mb_substr:0:22:'UTF-8'%}</div>
               </a>
              <div class="time"><i class="fa fa-clock-o"></i> {%$row->time|date_format:'%Y-%m-%d %H:%M:%S'%} </div>
  </li>
    {%/foreach%}
    <li><a href="http://w.semir.cn/index.php/Main/newsindex.html" target="_blank" class="read_more"><span class="glyphicon glyphicon-option-horizontal"></span> 更多信息</a></li>
</ul>
  