<?php

namespace app\admin\controller;
use app\admin\model\Node;
use think\Controller;

class Base extends Controller
{
    public function _initialize()
    {

        if(!session('uid')||!session('username')){
            $this->redirect('login/index');
        }
        
        $auth = new \com\Auth();   
        $module     = strtolower(request()->module());
        $controller = strtolower(request()->controller());
        $action     = strtolower(request()->action());
        $url        = $module."/".$controller."/".$action;

        //跳过检测以及主页权限
        if(session('uid')!=1){
            if(!in_array($url, ['admin/index/index','admin/index/indexpage','admin/upload/upload','admin/index/uploadface'])){
                if(!$auth->check($url,session('uid'))){
                    $this->error('抱歉，您没有操作权限');
                }
            }
        }
        
        $node = new Node();
        $this->assign([
            'username' => session('username'),
            'portrait' => session('portrait'),
            'rolename' => session('rolename'),
            'menu' => $node->getMenu(session('rule'))
        ]);

        $config = cache('db_config_data');

        if(!$config){            
            $config = load_config();                          
            cache('db_config_data',$config);
        }
        config($config); 

        if(config('web_site_close') == 0 && session('uid') !=1 ){
            $this->error('站点已经关闭，请稍后访问~');
        }

        if(config('admin_allow_ip') && session('uid') !=1 ){          
            if(in_array(request()->ip(),explode('#',config('admin_allow_ip')))){
                $this->error('403:禁止访问');
            }
        }

    }

    /**
     * 传入一个参数判断数据是否为true数据,
     * 返回相对应的返回数据
     * @param $boolean 判断参数
     * @param bool $data 返回数据
     * @param $success_msg 正确信息
     * @param $error_msg 错误信息
     * @return mixed|string 返回信息
     */
    protected function response_return_json($boolean, $data = false, $success_msg, $error_msg){
        if ($boolean){
            $success_arr = [
                "code" => 1,
                "msg" => $success_msg,
                "data" => $data,
            ];
            $success_json = json_encode($success_arr);
            return $success_json;
        }
        $error_arr = [
            "code" => 0,
            "msg" => $error_msg,
            "data" => false,
        ];
        $error_json = json_encode($error_arr);
        return $error_json;
    }

}