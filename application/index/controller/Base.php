<?php
/**
 * 所有父类控制器
 * @project 2018考研初试成绩查询排名系统
 * @author 冰华
 * @since 2018-1-13 15:05:08
 */
namespace app\index\controller;

use think\Controller;
use think\Session;
use think\Config;

class Base extends Controller {

    public function __construct(){
        parent::__construct();
        $this->is_login();
        $this->is_ranking();
    }

    /**
     * 判断是否登录,
     * 判断当前页面是否是登录页面,
     * 如果未登录,且当前页面不是登录页面,
     * 那么跳转到登录页,
     * 如果未登录,当前页面是登录页则不做处理,
     * 如果登录则不做处理
     * @method 调用
     * @return view 返回登录页
     */
    public function is_login(){
        $request = request();
        $current_path_str = $request->path();
        $is_in_path =
            $current_path_str != Config::get("login_path")
            &&
            $current_path_str != Config::get("login_data_path")
            &&
            $current_path_str != Config::get("register_path")
            &&
            $current_path_str != Config::get("register_data_path")
            &&
            $current_path_str != Config::get("forget_path")
            &&
            $current_path_str != Config::get("forget_data_path")
        ;
        if (Session::has("user_arr.id")!=true && $is_in_path){
            return $this->redirect("/index/index/login.html");
        }
        $this->get_user_info_data();

    }

    /**
     * 如果没有录入成绩数据则跳转到该页面
     * @method 调用
     * @return \think\response\View 排名页面
     */
    public function is_ranking(){
        $request = request();
        $current_path_str = $request->path();

        if ($current_path_str == Config::get("ranking_path")){
            $user_id = $this->get_user_id();
            $parameter_arr = [
                "user_id" => $user_id,
            ];
            $query_boolean_arr = $this->check_fraction_data($parameter_arr);

            if ($query_boolean_arr["status"]){
                return $this->redirect("/index/index/error_is_ranking");
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

    /**
     * 从session中获取用户id
     * @method 调用
     * @return mixed 用户id
     */
    public function get_user_id(){
        $user_id = Session::get("user_arr.id");
        return $user_id;
    }

    /**
     * 从session中获取学校id
     * @method 调用
     * @return mixed 学校id
     */
    public function get_user_code(){
        $code = Session::get("user_arr.code");
        return $code;
    }

    /**
     * 从session中获取学校id
     * @method 调用
     * @return mixed 学校id
     */
    public function get_user_colleges(){
        $colleges_id = Session::get("user_arr.colleges_id");
        return $colleges_id;
    }

    /**
     * 验证数据成绩数据是否存在
     * @param $parameter_arr 需要验证的数据
     * @return array 返回信息
     */
    public function check_fraction_data($parameter_arr){
        foreach ($parameter_arr as $key => $value){
            $choice_check_arr = Config::get("choice_check_arr");
            $check_arr[] = [
                "key" => $key,
                "value" => $value,
                "msg" => "该"
                    .$choice_check_arr[$key]
                    ."已经录入过,请更换"
                    .$choice_check_arr[$key]
                    ."后重试",
            ];
        }
        $query_msg_arr = model("fraction")->selectFractionIsHas($check_arr);
        return $query_msg_arr;
    }

    /**
     * 更新当前session中的用户数据
     */
    public function get_user_info_data(){
        $user_id = $this->get_user_id();

        $where_fraction_info_arr = [
            "user_id" => $user_id,
        ];
        $fraction_arr = model("fraction")
            ->getUserFractionInfo($where_fraction_info_arr);

        if (Session::has("user_arr.colleges_id")!=true){
            Session::set("user_arr.user_name", $fraction_arr["colleges_id"]);
        }
        if (Session::has("user_arr.user_name")!=true){
            Session::set("user_arr.user_name", $fraction_arr["user_name"]);
        }
        if (Session::has("user_arr.code")!=true){
            Session::set("user_arr.code", $fraction_arr["code"]);
        }

    }

    public function test_session(){
        dump(Session::get());
    }

}
