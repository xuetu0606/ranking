<?php
/**
 * 后台学校院系所控制器
 * @project 2018考研初试成绩查询排名系统
 * @author 冰华
 * @since 2018-1-29 23:10:21
 */

namespace app\admin\controller;

use think\Session;
use think\Validate;

class Faculty extends Base{

    /**
     * 打开院系所管理页面
     * @method GET
     * @return \think\response\View
     */
    public function faculty_list($colleges_id){
        Session::set("colleges_id", $colleges_id);
        return view();
    }

    /**
     * 获取当前学校的院系所列表
     * @method GET
     * @return mixed|string json
     */
    public function get_faculty_data(){
        $parameter_arr["colleges_id"] = Session::get("colleges_id");
        $faculty_arr = model("faculty")->getChoiceList($parameter_arr);
        return $this->response_return_json(
            $faculty_arr,
            $faculty_arr,
            "获取成功",
            "获取失败"
        );
    }

    /**
     * 删除院系所
     * @method GET
     * @return mixed|string json
     */
    public function delete_faculty($faculty_id){
        $where_arr = [
            "id" =>$faculty_id
        ];
        $query_boolean = model("faculty")->deleteFaculty($where_arr);
        return $this->response_return_json(
            $query_boolean,
            $query_boolean,
            "删除成功",
            "删除失败"
        );
    }

    /**
     * 添加院系所
     * @method POST
     * @return mixed|string json
     */
    public function add_faculty_info(){
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
            "faculty_name|院系所名称" => "require",
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
            "colleges_id" => Session::get("colleges_id"),
            "faculty_name" => $request_arr["faculty_name"],
        ];
        $query_has_boolean = model("faculty")->selectFacultyByName($where_arr);
        if ($query_has_boolean){
            return $this->response_return_json(
                $query_has_boolean,
                $query_has_boolean,
                "该院系所已存在",
                "保存失败"
            );
        }
        $query_save_boolean = model("faculty")->saveFacultyInfo($where_arr);
        return $this->response_return_json(
            $query_save_boolean,
            $query_save_boolean,
            "保存成功",
            "保存失败"
        );
    }
}