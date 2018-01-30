<?php
/**
 * 后台学校课程控制器
 * @project 2018考研初试成绩查询排名系统
 * @author 冰华
 * @since 2018-1-29 23:10:21
 */

namespace app\admin\controller;

use think\Session;
use think\Validate;

class Curriculum extends Base{

    /**
     * 打开课程管理页面
     * @method GET
     * @return \think\response\View
     */
    public function curriculum_list($major_id){
        Session::set("major_id", $major_id);
        return view();
    }

    /**
     * 获取当前学校的课程列表
     * @method GET
     * @return mixed|string json
     */
    public function get_curriculum_data(){
        $parameter_arr["major_id"] = Session::get("major_id");
        $curriculum_arr = model("curriculum")->getCurriculumList($parameter_arr);
        return $this->response_return_json(
            $curriculum_arr,
            $curriculum_arr,
            "获取成功",
            "获取失败"
        );
    }

    /**
     * 删除课程
     * @method GET
     * @return mixed|string json
     */
    public function delete_curriculum($curriculum_id){
        $where_arr = [
            "id" =>$curriculum_id
        ];
        $query_boolean = model("curriculum")->deleteCurriculum($where_arr);
        return $this->response_return_json(
            $query_boolean,
            $query_boolean,
            "删除成功",
            "删除失败"
        );
    }

    /**
     * 添加课程
     * @method POST
     * @return mixed|string json
     */
    public function add_curriculum_info(){
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
            "curriculum_name|课程名称" => "require",
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
            "major_id" => Session::get("major_id"),
            "curriculum_name" => $request_arr["curriculum_name"],
        ];
        $query_boolean = model("curriculum")->saveCurriculumInfo($where_arr);
        return $this->response_return_json(
            $query_boolean,
            $query_boolean,
            "保存成功",
            "保存失败"
        );
    }
}