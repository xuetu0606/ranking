<?php

/**
 * 用户数据模型
 * @project 2018考研初试成绩查询排名系统
 * @author 冰华
 * @since 2018-1-18 11:33:13
 */

namespace app\common\model;

class Colleges extends Base {

    // 数据表名称
    protected $table = "think_colleges";

    /**
     * 获取所有的学校数据,
     * 分页获取,每页十条
     * @method 调用
     * @return mixed|array 数组
     * @throws \think\exception\DbException
     */
    public function getCollegesList($parameter_arr = false){
        $where_arr = [];
        if ($parameter_arr && isset($parameter_arr["colleges_name"])){
            $where_arr["colleges_name"]  = ["like","%".$parameter_arr["colleges_name"]."%"];
        }
        $colleges_objs = $this
            ->field(
                "id," .
                "colleges_name," .
                "qq_group," .
                "create_time"
            )
            ->where($where_arr)
            ->paginate(15);
        $colleges_arrs = $this->forToArray($colleges_objs);
        return $colleges_arrs;
    }

    /**
     * 根据传入参数查询学校信息
     * @method 调用
     * @param $parameter_arr array
     * @return array|false|\PDOStatement|string|\think\Model 学校数据
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function getUserCollegesInfo($parameter_arr){
        $user_cooleges_info_obj = $this
            ->field(
                "id," .
                "colleges_name," .
                "qq_group"
            )
            ->where($parameter_arr)
            ->find()
        ;
        if ($user_cooleges_info_obj){
            $user_cooleges_info_arr = $user_cooleges_info_obj->toArray();
            return $user_cooleges_info_obj;
        }
        return $user_cooleges_info_obj;
    }

    /**
     * 创建一个新学校
     * @method 调用
     * @param $parameter_arr 新学校信息
     * @return false|int 返回值
     */
    public function createColleges($parameter_arr){

        $colleges_info_boolean = $this
            ->data($parameter_arr)
            ->allowField(true)
            ->save();
        if ($colleges_info_boolean){
            $colleges_info_arr = $this->toArray();
            return $colleges_info_arr;
        }
        return $colleges_info_boolean;
    }

    /**
     * 删除一个学校
     * @method 调用
     * @param $parameter_arr
     * @return int
     */
    public function deleteColleges($parameter_arr){
        $query_boolean = $this
            ->where($parameter_arr)
            ->delete();
        return $query_boolean;
    }

    /**
     * 查询当前学校名字
     * @method 调用
     * @param $parameter_arr
     * @return mixed string 学校名
     */
    public function getNameById($parameter_arr){
        $colleges_name = $this
            ->where($parameter_arr)
            ->value("colleges_name");
        return $colleges_name;
    }

}