<?php
/**
 * 后台学校专业控制器
 * @project 2018考研初试成绩查询排名系统
 * @author 冰华
 * @since 2018-1-29 23:10:21
 */

namespace app\admin\controller;

use think\Session;
use think\Validate;

class Major extends Base{

    /**
     * 打开专业管理页面
     * @method GET
     * @return \think\response\View
     */
    public function major_list($faculty_id){
        Session::set("faculty_id", $faculty_id);
        return view();
    }

    /**
     * 获取当前学校的专业列表
     * @method GET
     * @return mixed|string json
     */
    public function get_major_data(){
        $parameter_arr["faculty_id"] = Session::get("faculty_id");
        $major_arr = model("major")->getMajorList($parameter_arr);
        return $this->response_return_json(
            $major_arr,
            $major_arr,
            "获取成功",
            "获取失败"
        );
    }

    /**
     * 删除专业
     * @method GET
     * @return mixed|string json
     */
    public function delete_major($major_id){
        $where_arr = [
            "id" =>$major_id
        ];
        $query_boolean = model("major")->deleteMajor($where_arr);
        return $this->response_return_json(
            $query_boolean,
            $query_boolean,
            "删除成功",
            "删除失败"
        );
    }

    /**
     * 添加专业
     * @method POST
     * @return mixed|string json
     */
    public function add_major_info(){
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
            "major_name|专业名称" => "require",
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
            "faculty_id" => Session::get("faculty_id"),
            "major_name" => $request_arr["major_name"],
        ];
        $query_boolean = model("major")->saveMajorInfo($where_arr);
        return $this->response_return_json(
            $query_boolean,
            $query_boolean,
            "保存成功",
            "保存失败"
        );
    }
}