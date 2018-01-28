<?php

return [

    // +----------------------------------------------------------------------
    // | auth配置
    // +----------------------------------------------------------------------
    'auth_config'  => [
        'auth_on'           => 1, // 权限开关
        'auth_type'         => 1, // 认证方式，1为实时认证；2为登录认证。
        'auth_group'        => 'think_auth_group', // 用户组数据不带前缀表名
        'auth_group_access' => 'think_auth_group_access', // 用户-用户组关系不带前缀表
        'auth_rule'         => 'think_auth_rule', // 权限规则不带前缀表
        'auth_user'         => 'think_admin', // 用户信息不带前缀表
    ],

    // +----------------------------------------------------------------------
    // | 应用设置
    // +----------------------------------------------------------------------
    'url_route_on' => true,     //开启路由功能
    'route_config_file' =>  ['admin'],   // 设置路由配置文件列表

    // +----------------------------------------------------------------------
    // | Trace设置 开启 app_trace 后 有效
    // +----------------------------------------------------------------------
    'app_trace' =>  false,      //开启应用Trace调试
    'trace' => [
        'type' => 'html',       // 在当前Html页面显示Trace信息,显示方式console、html
    ],
    'sql_explain' => false,     // 是否需要进行SQL性能分析  
    'extra_config_list' => ['database', 'route', 'validate'],//各模块公用配置
    'app_debug' => true,
	'default_module' => 'index',//默认模块
    //'default_filter' => ['strip_tags', 'htmlspecialchars'],

    //默认错误跳转对应的模板文件
    'dispatch_error_tmpl' => APP_PATH.'admin/view/public/error.tpl',
    //默认成功跳转对应的模板文件
    'dispatch_success_tmpl' => APP_PATH.'admin/view/public/success.tpl',

    // +----------------------------------------------------------------------
    // | 日志设置
    // +----------------------------------------------------------------------
    'log'       => [       
        'type'  => 'test',// 日志记录方式，内置 file socket 支持扩展      
        'path'  => LOG_PATH,// 日志保存目录      
        'level' => [],// 日志记录级别
    ],


    // +----------------------------------------------------------------------
    // | 缓存设置
    // +----------------------------------------------------------------------
    'cache' => [     
        'type'   => 'file',// 驱动方式        
        'path'   => CACHE_PATH,// 缓存保存目录        
        'prefix' => '',// 缓存前缀       
        'expire' => 0,// 缓存有效期 0表示永久缓存
    ],

    // +----------------------------------------------------------------------
    // | 会话设置
    // +----------------------------------------------------------------------
    'session'            => [
        'id'             => '',
        'var_session_id' => '',// SESSION_ID的提交变量,解决flash上传跨域
        'prefix'         => 'think',// SESSION 前缀
        'type'           => '',// 驱动方式 支持redis memcache memcached
        'auto_start'     => true,// 是否自动开启 SESSION
    ],

    // +----------------------------------------------------------------------
    // | Cookie设置
    // +----------------------------------------------------------------------
    'cookie'        => [      
        'prefix'    => '',// cookie 名称前缀      
        'expire'    => 0,// cookie 保存时间      
        'path'      => '/',// cookie 保存路径      
        'domain'    => '',// cookie 有效域名      
        'secure'    => false,//  cookie 启用安全传输      
        'httponly'  => '',// httponly设置      
        'setcookie' => true,// 是否使用 setcookie
    ],

    //分页配置
    'paginate'               => [
        'type'      => 'bootstrap',
        'var_page'  => 'page',
        'list_rows' => 15,
    ],
    

    // +----------------------------------------------------------------------
    // | 数据库设置
    // +----------------------------------------------------------------------
    'data_backup_path'     => '../data/',   //数据库备份路径必须以 / 结尾；
    'data_backup_part_size' => '20971520',  //该值用于限制压缩后的分卷最大长度。单位：B；建议设置20M
    'data_backup_compress' => '1',          //压缩备份文件需要PHP环境支持gzopen,gzwrite函数        0:不压缩 1:启用压缩
    'data_backup_compress_level' => '9',    //压缩级别   1:普通   4:一般   9:最高


    // +----------------------------------------------------------------------
    // | 验证类型
    // +----------------------------------------------------------------------
    'verify_type' => '0',   //验证码类型：0拖动滑块验证， 1数字验证码
    'auth_key' => 'JUD6FCtZsqrmVXc2apev4TRn3O8gAhxbSlH9wfPN', //默认数据加密KEY
    'pages'    => '10',//分页数 
    'salt'     => 'wZPb~yxvA!ir38&Z',//加密串 
    
    // +----------------------------------------------------------------------
    // | 前台
    // +----------------------------------------------------------------------
    "login_path" => "index/index/login",
    "login_data_path" => "index/index/login_data",
    "register_path" => "index/index/register",
    "register_data_path" => "index/index/register_data",
    "forget_path" => "index/index/forget",
    "forget_data_path" => "index/index/forget_data",
    "ranking_path" => "index/index/ranking",
    "choice_check_arr" => [
        "user_id" => "用户",
        "wechat" => "微信",
        "qq" => "QQ",
        "telephone" => "手机号",
    ],

    // 应用调试模式
    "app_debug" => true,
    // 是否开启路由
    "url_route_on" => true,
    // 是否强制使用路由
    "url_route_must" => false,
    // 应用模式状态
    'app_status' => true,
    // 显示错误信息
    'show_error_msg' => true,

    //验证码配置
    'captcha' => [
        // 验证码字符集合
        'codeSet' => '2345678abcdefhijkmnpqrstuvwxyzABCDEFGHJKLMNPQRTUVWXY',
        // 验证码字体大小(px)
        'fontSize' => 22,
        // 是否画混淆曲线
        'useCurve' => true,
        // 是否添加杂点
        'useNoise' => false,
        // 验证码图片高度
        'imageH' => 50,
        // 验证码图片宽度
        'imageW' => 180,
        // 验证码位数
        'length' => 4,
        // 验证成功后是否重置
        'reset' => true
    ],

];