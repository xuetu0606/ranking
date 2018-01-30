<?php
/**
 * 后台学员排名列表控制器
 * @project 2018考研初试成绩查询排名系统
 * @author 冰华
 * @since 2018-1-29 23:10:21
 */

namespace app\admin\controller;

use think\Session;
use think\Validate;

class Achievement extends Base{

    /**
     * 打开当前页面
     * @method GET
     * @return \think\response\View
     */
    public function ranking(){
        return view();
    }

    /**
     * 获取已经录入的所有的专业课代码
     * @method GET
     * @return mixed|string json
     */
    public function get_code_list(){
        $code_arr = model("fraction")->getCodeList();
        return $this->response_return_json(
            $code_arr,
            $code_arr,
            "获取成功",
            "获取失败"
        );
    }

    /**
     * 根据code查询所有的排名信息
     * @method POST
     * @return mixed|string json
     */
    public function get_ranking_data(){
        $request = request();
        $code = $request->post("code");
        $fraction_where_arr = [
            "code" => $code,
        ];
        $fraction_data = model("fraction")
            ->getFractionList($fraction_where_arr);

        $fraction_arr = $this->set_name_in_arr($fraction_data["data"]);
        $fraction_data["data"] = $fraction_arr;
        return $this->response_return_json(
            $fraction_data,
            $fraction_data,
            "查询成功",
            "查询失败,请稍后重试"
        );
    }

    /**
     * 把名字填充进数组
     * @param $parameter_arr
     * @return array
     */
    public function set_name_in_arr($parameter_arr){
        foreach ($parameter_arr as $key=>$value){
            $colleges_name = $this->get_colleges_name($value["colleges_id"]);
            $parameter_arr[$key]["colleges_name"] = $colleges_name;
            $faculty_name = $this->get_faculty_name($value["faculty_id"]);
            $parameter_arr[$key]["faculty_name"] = $faculty_name;
            $major_name = $this->get_major_name($value["major_id"]);
            $parameter_arr[$key]["major_name"] = $major_name;
        }
        return $parameter_arr;
    }

    /**
     * 查询当前名字
     * @method 调用
     * @param $id
     * @return mixed string
     */
    public function get_colleges_name($id){
        $where_arr = [
            "id" => $id,
        ];
        $name = model("colleges")->getNameById($where_arr);
        return $name;
    }

    /**
     * 查询当前名字
     * @method 调用
     * @param $id
     * @return mixed string
     */
    public function get_faculty_name($id){
        $where_arr = [
            "id" => $id,
        ];
        $name = model("faculty")->getNameById($where_arr);
        return $name;
    }

    /**
     * 查询当前名字
     * @method 调用
     * @param $id
     * @return mixed string
     */
    public function get_major_name($id){
        $where_arr = [
            "id" => $id,
        ];
        $name = model("major")->getNameById($where_arr);
        return $name;
    }

}