<?php
/**
 * 学校管理控制器
 * @project 2018考研初试成绩查询排名系统
 * @author 冰华
 * @since 2018-1-28 11:21:05
 */

namespace app\admin\controller;

class School extends Base{

    /**
     * 打开学校管理页面
     * @method GET
     * @return \think\response\View
     */
    public function school_list(){
        return view();
    }

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

}