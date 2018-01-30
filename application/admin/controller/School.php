<?php
/**
 * 学校管理控制器
 * @project 2018考研初试成绩查询排名系统
 * @author 冰华
 * @since 2018-1-28 11:21:05
 */

namespace app\admin\controller;

use think\Validate;

class School extends Base{

    /**
     * 打开学校管理页面
     * @method GET
     * @return \think\response\View
     */
    public function school_list(){
        return view();
    }

    /**
     * 添加一个学校
     * @method POST
     * @return mixed|string json
     */
    public function add_school_info(){
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
            "qq_group|QQ群" => "require",
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
                "该学校已存在",
                "学校创建完毕"
            );
        }

        $query_creaet_boolean = model("colleges")->createColleges($request_arr);
        return $this->response_return_json(
            $query_creaet_boolean,
            $query_creaet_boolean,
            "该学校已存在",
            "学校创建完毕"
        );
    }

    /**
     * 获取学校信息
     * @method GET
     * @return mixed|string json
     */
    public function school_list_data(){
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
     * 删除一个学校
     * @method GET
     * @param $colleges_id
     * @return mixed|string json
     */
    public function delete_colleges($colleges_id){
        $where_arr = [
            "id" => $colleges_id
        ];
        $query_boolean = model("colleges")->deleteColleges($where_arr);
        return $this->response_return_json(
            $query_boolean,
            $query_boolean,
            "删除成功",
            "删除失败"
        );
    }

}