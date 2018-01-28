<?php
/**
 * 学员管理控制器
 * @project 2018考研初试成绩查询排名系统
 * @author 冰华
 * @since 2018-1-26 16:19:54
 */
namespace app\admin\controller;


class Student extends Base{

    /**
     * 打开学员列表页面
     * @method GET
     * @return \think\response\View 学员列表页面
     */
    public function student_list(){
        return view();
    }

    /**
     * 获取所有的学员列表
     * @method GET
     * @return mixed|string json
     */
    public function student_list_data(){
        $user_arr = model("user")->selectAllUser();
        $user_info_arr = [];
        foreach ($user_arr["data"] as $key => $value){
            $where_fraction_info_arr = [
                "user_id" => $value["id"],
            ];
            $fraction_arr = model("fraction")
                ->getUserFractionInfo($where_fraction_info_arr);

            $user_info_arr[] = [
                "id" => $value["id"],
                "telephone" => $value["telephone"],
                "colleges_id" => $fraction_arr["colleges_id"],
                "user_name" => $fraction_arr["user_name"],
                "total" => $fraction_arr["total"],
                "code" => $fraction_arr["code"],
                "fraction_id" => $fraction_arr["id"],
                "create_time" => $value["create_time"],
            ];
        }
        $user_arr["data"] = $user_info_arr;
        return $this->response_return_json(
            $user_arr,
            $user_arr,
            "获取成功",
            "获取失败"
        );
    }

    /**
     * 获取当前用户的成绩信息
     * @method POST
     * @return mixed|string json
     */
    public function get_user_achievement_details(){
        $request = request();
        if (!$request->isPost()){
            return $this->response_return_json(
                false,
                false,
                "访问成功",
                "访问方法失败"
            );
        }
        $request_arr = $request->post();

        $achievement_details_arr = model("achievement")
            ->selectUserAchievementInfo($request_arr);
        return $this->response_return_json(
            $achievement_details_arr,
            $achievement_details_arr,
            "获取成功",
            "获取失败"
        );
    }

}