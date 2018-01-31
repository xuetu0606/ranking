<?php
/**
 * 首页控制器
 * @project 2018考研初试成绩查询排名系统
 * @author 冰华
 * @since 2018-1-13 15:05:08
 */
namespace app\index\controller;

use think\Config;
use think\Session;
use think\Validate;

class Index extends Base {

    /**
     * 打开首页页面,
     * 首页选择学校
     * @method GET
     * @return \think\response\View 首页页面
     */
    public function index(){
        $check_arr["user_id"] = $this->get_user_id();
        $boolean_arr = $this->check_fraction_data($check_arr);
        if (
            $boolean_arr["status"] != true
            &&
            $this->check_current_path_is_ranking()
        ){
            return view("error_is_input");
        }
        return view();
    }

    /**
     * 返回当前系统内所有的数据
     * @method GET
     * @return mixed|string json
     */
    public function get_colleges_data(){
        $request = request();
        $request_arr = $request->post();
        $colleges_arrs = model("colleges")->getCollegesList($request_arr);
        return $this->response_return_json(
            $colleges_arrs,
            $colleges_arrs,
            "获取成功",
            "获取失败"
        );
    }

    /**
     * 打开登陆页面
     * @method GET
     * @return \think\response\View 登陆页面
     */
    public function login(){
        return view();
    }

    /**
     * 登陆方法,判断用户数据是否存在
     * @method POST
     * @return mixed|string 返回json字符串
     */
    public function login_data(){
        $request = request();
        $is_post_boolean = $request->isPost();
        if ($is_post_boolean){
            $login_arr = $request->post();

            // 验证数据
            $validate = new Validate([
                "telephone|手机号" => "require|number|/^1[34578]\d{9}$/",
                "password|密码" => "require",
            ]);
            if (!$validate->check($login_arr)) {
                return $this->response_return_json(
                    false,
                    false,
                    "",
                    $validate->getError()
                );
            }

            // 查询该用户是否存在,并且存储用户id到session
            $is_user_boolean = model("user")->selectUserInfo($login_arr);
            if ($is_post_boolean){
                $user_arr["id"] = $is_user_boolean;
                Session::set("user_arr", $user_arr);
            }

            // 返回数据
            $response_arr = [
                "url" => "/index/index/index",
            ];
            return $this->response_return_json(
                $is_user_boolean,
                $response_arr,
                "登陆成功",
                "用户信息填写错误,请确认后重试"
            );
        }
    }

    /**
     * 打开注册页面
     * @method GET
     * @return \think\response\View 注册页面
     */
    public function register(){
        return view();
    }

    /**
     * 储存用户信息到数据库
     * @method POST
     * @return mixed|string json
     */
    public function register_data(){
        $request = request();
        $is_post_boolean = $request->isPost();
        if ($is_post_boolean){
            $register_arr = $request->post();

            // 验证数据
            $validate = new Validate([
                "telephone|手机号" => "require|number|/^1[34578]\d{9}$/",
                "code|验证码" => "require",
                "password|密码" => "require",
            ]);
            if (!$validate->check($register_arr)) {
                return $this->response_return_json(
                    false,
                    false,
                    "",
                    $validate->getError()
                );
            }

            // 通过手机号查询是否被用户使用过
            $where_verification_telephone["telephone"] =
                $register_arr["telephone"];
            $is_user_boolean = model("user")
                ->selectUserInfo($where_verification_telephone);
            if ($is_user_boolean){
                return $this->response_return_json(
                    false,
                    false,
                    "该手机号可以注册",
                    "该手机号已被注册,请更换手机号"
                );
            }

            // 把手机号放置在session中
            Session::set("user_arr.telephone", $register_arr["telephone"]);

            // 判断验证码否正确
            $captcha_boolean = !captcha_check($register_arr["code"]);
            if ($captcha_boolean){
                return $this->response_return_json(
                    false,
                    false,
                    "验证码输入正确",
                    "验证码错误,请重新输入"
                );
            }

            // 储存用户信息到数据库,并且设置用户id到session
            $user_id = model("user")
                ->saveUserInfo($register_arr);
            if ($is_post_boolean){
                Session::set("user_arr.id", $user_id);
            }

            $response_arr = [
                "url" => "/index/index/index"
            ];
            return $this->response_return_json(
                $user_id,
                $response_arr,
                "注册成功",
                "注册失败,请确认信息后重试"
            );

        }
    }

    /**
     * 打开专业成绩录入页面
     * @method GET
     * @param bool $colleges_id 学校id
     * @return mixed|string|\think\response\View 录入成绩页面
     */
    public function choice($colleges_id = false){
        if (!$colleges_id){
            return $this->response_return_json(
                false,
                false,
                "访问成功",
                "缺少指定参数"
            );
        }
        Session::set("user_arr.colleges_id", $colleges_id);
        return view();
    }

    /**
     * 判断当前访问的url是否是排名页面
     * @method 调用
     * @return bool
     */
    public function check_current_path_is_ranking(){
        $request = request();
        $path_str = $request->path();
        if ($path_str == Config::get("ranking_path")){
            return false;
        }
        return true;
    }

    /**
     * 获取当前学校的院系所列表
     * @method GET
     * @return mixed|string json
     */
    public function get_faculty_data($colleges_id = false){
        if ($colleges_id){
            $parameter_arr["colleges_id"] = $colleges_id;
        }else{
            $parameter_arr["colleges_id"] = $this->get_user_colleges();
        }
        $faculty_arr = model("faculty")->getChoiceList($parameter_arr);
        return $this->response_return_json(
            $faculty_arr,
            $faculty_arr,
            "获取成功",
            "获取失败"
        );
    }

    /**
     * 根据院系所id查询所有的专业数据
     * @methdo GET
     * @param bool $faculty_id 院系所id
     * @return mixed|string json
     */
    public function get_major_data($faculty_id = false){
        if (!$faculty_id){
            return $this->response_return_json(
                false,
                false,
                "访问成功",
                "缺少指定参数"
            );
        }
        $parameter_arr["faculty_id"] = $faculty_id;
        $major_arr = model("major")->getMajorList($parameter_arr);
        return $this->response_return_json(
            $major_arr,
            $major_arr,
            "获取成功",
            "获取失败"
        );
    }

    /**
     * 根据专业id查询所有的课程数据
     * @method GET
     * @param bool $major_id 专业id
     * @return mixed|string json
     */
    public function get_curriculum_data($major_id = false){
        if (!$major_id){
            return $this->response_return_json(
                false,
                false,
                "访问成功",
                "缺少指定参数"
            );
        }
        $parameter_arr["major_id"] = $major_id;
        $curriculum_arr = model("curriculum")
            ->getCurriculumList($parameter_arr);
        return $this->response_return_json(
            $curriculum_arr,
            $curriculum_arr,
            "获取成功",
            "获取失败"
        );
    }

    /**
     * 保存成绩到数据库
     * @method POST
     * @return mixed|string json
     */
    public function save_achievement(){
        $request = request();
        $is_post = $request->isPost();
        if (!$is_post){
            return $this->response_return_json(
                false,
                false,
                "访问成功",
                "访问方法错误"
            );
        }
        $user_id = $this->get_user_id();
        $request_arr = $request->post();

        // 验证数据
        $validate = new Validate([
            "faculty_id|院系所" => "require",
            "major_id|专业" => "require",
            "user_name|姓名" => "require",
            "telephone|手机号" => "require|number|/^1[34578]\d{9}$/",
            "code|专业课代码" => "require",
            "wechat|微信" => "require",
            "qq|QQ" => "require",
        ]);
        if (!$validate->check($request_arr)) {
            return $this->response_return_json(
                false,
                false,
                "",
                $validate->getError()
            );
        }

        // 存分数表

        // 获取学校id,并进行判断
        $colleges_id = $this->get_user_colleges();
        if (!$colleges_id){
            $return_arr = [
                "url" => "/index/index/index"
            ];
            return $this->response_return_json(
                false,
                $return_arr,
                "获取成功",
                "获取失败"
            );
        }
        // 计算总分
        $total = $this->get_fraction_total($request_arr["achievement_arr"]);
        // 处理数组
        $fraction_arr = [
            "user_name" => $request_arr["user_name"],
            "telephone" => $request_arr["telephone"],
            "wechat" => $request_arr["wechat"],
            "qq" => $request_arr["qq"],
            "user_id" => $user_id,
            "colleges_id" => $colleges_id,
            "faculty_id" => $request_arr["faculty_id"],
            "major_id" => $request_arr["major_id"],
            "total" => $total,
            "code" => $request_arr["code"],
        ];
        Session::set("user_arr.code", $request_arr["code"]);
        // 验证手机微信QQ是否重复
        $check_arr = [
            "user_id" => $user_id,
            "telephone" => $request_arr["telephone"],
            "wechat" => $request_arr["wechat"],
            "qq" => $request_arr["qq"],
        ];
        $query_msg_arr = $this->check_fraction_data($check_arr);
        if (!$query_msg_arr["status"]){
            return $this->response_return_json(
                false,
                $query_msg_arr,
                $query_msg_arr["msg"],
                $query_msg_arr["msg"]
            );
        }
        // 保存分数表数据
        $is_fraction_save_boolean = model("fraction")
            ->saveFractionInfo($fraction_arr);
        if (!$is_fraction_save_boolean){
            return $this->response_return_json(
                false,
                false,
                "保存分数成功",
                "保存分数出错,请稍后重试"
            );
        }

        // 存成绩表
        $achievement_arr = $this
            ->combination_achievement_arr(
                $request_arr["achievement_arr"],
                3
            );
        $is_achievementa_save_boolean = model("achievement")
            ->saveAchievementAllInfo($achievement_arr);
        if ($is_achievementa_save_boolean!=true){
            return $this->response_return_json(
                false,
                false,
                "保存成绩成功",
                "保存成绩出错,请稍后重试"
            );
        }
        Session::set("user_arr.code", $request_arr["code"]);
        $return_arr = [
            "url" => "/index/index/ranking",
        ];
        return $this->response_return_json(
            true,
            $return_arr,
            "保存成绩成功,正在为您查询排名~",
            "保存成绩出错,请稍后重试"
        );

    }

    /**
     * 传入分数的数组,
     * 然后拼上总分表id
     * @method 调用
     * @param $parameter_arr 成绩数组
     * @return mixed 返回成功与否
     */
    public function combination_achievement_arr($parameter_arr, $fraction_id){
        foreach ($parameter_arr as $key => $value){
            $user_id = $this->get_user_id();
            $parameter_arr[$key]["fraction_id"] = $fraction_id;
            $parameter_arr[$key]["user_id"] = $user_id;
        }
        return $parameter_arr;
    }

    /**
     * 传出成绩的数组,
     * 然后把分数加起来,
     * 返回总数
     * @method 调用
     * @param $parameter_arr 成绩数组
     * @return int 总分数
     */
    public function get_fraction_total($parameter_arr){
        $total = 0;
        foreach ($parameter_arr as $key => $value){
            $total+=$value["fraction"];
        }
        return $total;
    }
    /**
     * 打开排名信息列表的页面
     * @method GET
     * @return \think\response\View 排名页面
     */
    public function ranking(){
        return view();
    }

    /**
     *
     * @method 调用
     * @return \think\response\View 跳转页面
     */
    public function error_is_ranking(){
        return view();
    }

    /**
     * 获取所有的排名列表数据
     * @method GET
     * @return mixed|string json
     */
    public function get_ranking_data(){
        $code = $this->get_user_code();
        $fraction_where_arr = [
            "code" => $code,
        ];
        $fraction_arr = model("fraction")->getFractionList($fraction_where_arr);

        return $this->response_return_json(
            $fraction_arr,
            $fraction_arr,
            "查询成功",
            "查询失败,请稍后重试"
        );
    }

    /**
     * 获取当前用户的用户排名详情信息
     * @method GET
     * @return mixed|string json
     */
    public function get_user_ranking_info(){
        $user_id = $this->get_user_id();
        $code = $this->get_user_code();
        $where_ranking_info_arr = [
            "user_id" => $user_id,
            "code" => $code,
        ];
        $user_ranking_info_arr = model("fraction")
            ->getUserFractionInfo($where_ranking_info_arr);
        return $this->response_return_json(
            $user_ranking_info_arr,
            $user_ranking_info_arr,
            "查询成功",
            "查询失败,请稍后重试"
        );
    }

    /**
     * 获取当前用户的名次
     * @method GET
     * @return mixed int
     */
    public function get_user_ranking(){
        $user_id = $this->get_user_id();
        $code = $this->get_user_code();
        $where_ranking_info_arr = [
            "user_id" => $user_id,
            "code" => $code,
        ];
        $user_pre_ranking = model("fraction")
            ->getUserRanking($where_ranking_info_arr);
        $user_ranking = $user_pre_ranking+1;
        return $user_ranking;
    }

    /**
     * 获取当前用户的学校信息
     * @method GET
     * @return mixed|string json
     */
    public function get_user_colleges_info(){
        $colleges_id = $this->get_user_colleges();
        $where_arr = [
            "id" => $colleges_id
        ];
        $colleges_info_arr = model("colleges")->getUserCollegesInfo($where_arr);
        return $this->response_return_json(
            $colleges_info_arr,
            $colleges_info_arr,
            "查询成功",
            "查询失败,请稍后重试"
        );
    }

    /**
     * 打开忘记密码的页面
     * @method GET
     * @return \think\response\View 忘记密码页面
     */
    public function forget(){
        return view();
    }

    /**
     * 修改用户的密码
     * @method POST
     * @return mixed|string json
     */
    public function forget_data(){
        $request = request();
        $is_post_boolean = $request->isPost();
        if (!$is_post_boolean){
            return $this->response_return_json(
                false,
                false,
                "访问成功",
                "请更换访问方式"
            );
        }
        $request_arr = $request->post();
        // 验证数据
        $validate = new Validate([
            "telephone|手机号" => "require|number|/^1[34578]\d{9}$/",
            "code|验证码" => "require",
            "password|密码" => "require",
            "re_password|确认密码" => "require|confirm:password",
        ]);
        if (!$validate->check($request_arr)) {
            return $this->response_return_json(
                false,
                false,
                "",
                $validate->getError()
            );
        }
        //判断手机号是否正确
        $telephone = Session::get("user_arr.telephone");
        $is_telephone_boolean = $telephone != $request_arr["telephone"];
        if ($is_telephone_boolean){
            return $this->response_return_json(
                false,
                false,
                "手机号正确",
                "手机号错误,请验证后重试"
            );
        }
        // 判断验证码否正确
        $captcha_boolean = !captcha_check($request_arr["code"]);
        if ($captcha_boolean){
            return $this->response_return_json(
                false,
                false,
                "验证码输入正确",
                "验证码错误,请重新输入"
            );
        }
        // 修改用户密码
        $user_id = $this->get_user_id();
        $where_arr = [
            "id" => $user_id,
        ];
        $user_info_arr = [
            "password" => $request_arr["password"],
        ];
        $query_boolean = model("user")->updateUserInfo($user_info_arr, $where_arr);
        $return_arr = [
            "url" => "/index/index/index"
        ];
        return $this->response_return_json(
            $query_boolean,
            $return_arr,
            "密码修改成功,即将自动登录",
            "密码修改错误,请稍后重试"
        );
    }

    /**
     * 保存新学校,
     * 提交框访问
     * @method POST
     * @return mixed|string json
     */
    public function save_colleges(){
        $request = request();
        $is_post_boolean = $request->isPost();
        if (!$is_post_boolean){
            return $this->response_return_json(
                false,
                false,
                "访问成功",
                "请更换访问方式后重试"
            );
        }
        $request_arr = $request->post();
        // 验证数据
        $validate = new Validate([
            "colleges_name|学校名称" => "require",
        ]);
        if (!$validate->check($request_arr)) {
            return $this->response_return_json(
                false,
                false,
                "",
                $validate->getError()
            );
        }
        $where_arr = [
            "colleges_name" => $request_arr["colleges_name"],
        ];
        $query_select_boolean = model("colleges")->getUserCollegesInfo($where_arr);
        if ($query_select_boolean){
            return $this->response_return_json(
                $query_select_boolean,
                $query_select_boolean,
                "该学校已存在,即将跳转至该学校录入界面",
                "学校创建完毕,即将跳转至录入界面"
            );
        }

        $query_creaet_boolean = model("colleges")->createColleges($request_arr);
        return $this->response_return_json(
            $query_creaet_boolean,
            $query_creaet_boolean,
            "学校创建完毕,即将跳转至录入界面",
            "该学校已存在,即将跳转至该学校录入界面"
        );
    }


    /**
     * 没有学校的成绩录入界面
     * @method GET
     * @return \think\response\View 没有学校的成绩录入界面
     */
    public function input($colleges_id){
        if (!$colleges_id){
            return $this->response_return_json(
                false,
                false,
                "访问成功",
                "缺少指定参数"
            );
        }
        $check_arr["user_id"] = $this->get_user_id();
        $boolean_arr = $this->check_fraction_data($check_arr);
        if (
            $boolean_arr["status"] != true
            &&
            $this->check_current_path_is_ranking()
        ){
            return view("error_is_input");
        }
        Session::set("user_arr.colleges_id", $colleges_id);
        return view();
    }

    /**
     * 录入没有学校的成绩代码
     */
    public function input_data(){
        $request = request();
        // 判断是否是post请求
        $is_post = $request->isPost();
        if (!$is_post){
            return $this->response_return_json(
                false,
                false,
                "访问成功",
                "访问方法错误"
            );
        }
        // 获取数据
        $request_arr = $request->post();
        // 验证数据
        $validate = new Validate([
            "user_name|姓名" => "require",
            "telephone|手机号" => "require|number|/^1[34578]\d{9}$/",
            "wechat|微信" => "require",
            "qq|QQ" => "require",
            "faculty|院系所" => "require",
            "major|专业" => "require",
            "code|专业课代码" => "require",
            "curriculum_arr|课程成绩" => "require|array",
        ]);
        if (!$validate->check($request_arr)) {
            return $this->response_return_json(
                false,
                false,
                "",
                $validate->getError()
            );
        }

        // 获取学校id
        $colleges_id = $this->get_user_colleges();

        // 处理院系所是否存在,并且返回院系所id
        $faculty_id = $this->existence_faculty(
            $request_arr["faculty"],
            $colleges_id
        );

        // 处理专业是否存在
        $major_id = $this->existence_major(
            $request_arr["major"],
            $faculty_id
        );

        // 处理课程
        $achievement_arr = $this->handle_curriculum_data(
            $request_arr["curriculum_arr"],
            $major_id
        );

        // 判断手机微信QQ是否重复
        $check_arr = [
            "telephone" => $request_arr["telephone"],
            "wechat" => $request_arr["wechat"],
            "qq" => $request_arr["qq"],
        ];
        $query_msg_arr = $this->check_fraction_data($check_arr);
        if (!$query_msg_arr["status"]){
            return $this->response_return_json(
                false,
                $query_msg_arr,
                $query_msg_arr["msg"],
                $query_msg_arr["msg"]
            );
        }

        $total = $this->get_fraction_total_new($achievement_arr);

        // 保存分数表数据,返回分数表id
        $fraction_id = $this->save_fraction_info(
            $request_arr,
            $faculty_id,
            $major_id,
            $total
        );
        Session::set("user_arr.code", $request_arr["code"]);
        return $this->response_return_json(
            $fraction_id,
            $fraction_id,
            "保存成绩成功,正在为您查询排名~",
            "保存成绩出错,请稍后重试"
        );

    }

    /**
     * 根据院系所的名称返回院系所id,
     * 若没有则创建并返回id
     * @param $faculty_name 院系所名称
     * @return mixed 院系所id
     */
    public function existence_faculty($faculty_name, $colleges_id){
        $where_faculty_arr = [
            "colleges_id" => $colleges_id,
            "faculty_name" => $faculty_name
        ];
        // 判断是否存在
        $existence_faculty_boolean = model("faculty")
            ->selectFacultyByName($where_faculty_arr);
        // 存在返回id
        if ($existence_faculty_boolean){
            return $existence_faculty_boolean["id"];
        }
        // 创建新院系所
        $save_faculty_boolean = model("faculty")
            ->saveFacultyInfo($where_faculty_arr);
        // 返回新院系所id
        if ($save_faculty_boolean){
            return $save_faculty_boolean["id"];
        }
        return false;
    }

    /**
     * 判断专业是否存在并且返回id,
     * 不存在就创建一个然后返回id
     * @param $major_name 专业名称
     * @param $faculty_id 院系所id
     * @return bool 专业id|false
     */
    public function existence_major($major_name, $faculty_id){
        $where_major_arr = [
            "major_name" => $major_name,
            "faculty_id" => $faculty_id
        ];
        // 判断是否存在
        $existence_major_boolean = model("major")
            ->selectMajorByName($where_major_arr);
        // 如果存在则返回id
        if ($existence_major_boolean){
            return $existence_major_boolean["id"];
        }
        // 创建新的专业
        $save_major_boolean = model("major")
            ->saveMajorInfo($where_major_arr);
        if ($save_major_boolean){
            return $save_major_boolean["id"];
        }

        return false;

    }

    /**
     * 验证当前课程数组是否都存在,
     * 不存在创建数组
     * @method 调用
     * @param $curriculum_arr 课程的数组
     * @param $major_id 专业id
     * @return bool|array 返回成绩数组|false
     */
    public function handle_curriculum_data($curriculum_arr, $major_id){
        $achievement_arr = [];
        // 课程表
        foreach ($curriculum_arr as $key => $value){
            if ($value["curriculum_name"]){

                $curriculum_boolean = $this->existence_curriculum(
                    $value["curriculum_name"],
                    $major_id
                );

                $achievement_arr[] = [
                    "curriculum_id" => $curriculum_boolean,
                    "major_id" => $major_id,
                    "fraction" => $value["fraction"]
                ];
            }
        }
        return $achievement_arr;
    }

    /**
     * 验证课程信息是否存在
     * @method 调用
     * @param $curriculum_name 课程名称
     * @param $major_id 专业id
     * @return bool 课程id|false
     */
    public function existence_curriculum($curriculum_name, $major_id){
        if (!$curriculum_name){
            return false;
        }
        $where_curriculum_arr = [
            "major_id" => $major_id,
            "curriculum_name" => $curriculum_name
        ];
        // 判断是否存在
        $existence_curriculum_boolean = model("curriculum")
            ->selectCurriculumByName($where_curriculum_arr);
        // 存在则返回课程id
        if ($existence_curriculum_boolean){
            return $existence_curriculum_boolean["id"];
        }
        // 创建新课程
        $save_curriculum_boolean = model("curriculum")
            ->saveCurriculumInfo($where_curriculum_arr);
        if ($save_curriculum_boolean){
            return $save_curriculum_boolean["id"];
        }

        return false;

    }

    /**
     * 计算总分
     * @param $curriculum_arr
     * @return int
     */
    public function get_fraction_total_new($curriculum_arr){
        $total = 0;
        foreach ($curriculum_arr as $value){
            $total += (float)$value["fraction"];
        }
        return $total;
    }

    /**
     * 添加分数表数据
     * @param $request_arr 客户端请求数据
     * @param $faculty_id 院系所id
     * @param $major_id 专业id
     * @return mixed id|false
     */
    public function save_fraction_info(
        $request_arr,
        $faculty_id,
        $major_id,
        $total
    ){
        $user_id = $this->get_user_id();
        $colleges_id = $this->get_user_colleges();
        $fraction_info_arr = [
            "user_id" => $user_id,
            "user_name" => $request_arr["user_name"],
            "telephone" => $request_arr["telephone"],
            "wechat" => $request_arr["wechat"],
            "colleges_id" => $colleges_id,
            "qq" => $request_arr["qq"],
            "faculty_id" => $faculty_id,
            "major_id" => $major_id,
            "total" => $total,
            "code" => $request_arr["code"],
        ];
        $query_boolean = model("fraction")
            ->saveFractionInfo($fraction_info_arr);
        if ($query_boolean){
            return $query_boolean["id"];
        }
        return $query_boolean;
    }

    /**
     * 退出登录
     */
    public function logout(){
        Session::delete("user_arr");
        return view("/index/login");
    }

}
