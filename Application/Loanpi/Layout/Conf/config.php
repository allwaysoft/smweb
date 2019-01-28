<?php
return array(
     'DEFAULT_CONTROLLER' => 'Register', // 默认控制器名称
    'TMPL_FILE_DEPR' => '_',
    'DEFAULT_THEME' => 'Loanpi/Layout',
        // 显示页面Trace信息
    'SHOW_PAGE_TRACE' =>false, 
    /* 日志设置 */
    'LOG_RECORD'            =>  false,   // 默认不记录日志
    'LOG_TYPE'              =>  'File', // 日志记录类型 默认为文件方式
    'LOG_LEVEL'             =>  'EMERG,ALERT,CRIT,ERR',// 允许记录的日志级别
    'LOG_FILE_SIZE'         =>  2097152,	// 日志文件大小限制
    'LOG_EXCEPTION_RECORD'  =>  false,    // 是否记录异常信息日
);