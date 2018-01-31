<?php

/**
 * 专业数据模型
 * @project 2018考研初试成绩查询排名系统
 * @author 冰华
 * @since 2018-1-23 10:36:31
 */

namespace app\common\model;

class Major extends Base {

    // 数据表名称
    protected $table = "think_major";

    /**
     * 根据传入的参数查询该院系所下属的专业
     * @method 调用
     * @param $parameter_arr 数组
     * @return bool|mixed 数组
     */
    public function getMajorList($parameter_arr){
        if (!$parameter_arr){
            return false;
        }
        if ($parameter_arr && isset($parameter_arr["major_name"])){
            $parameter_arr["major_name"]  = ["like","%".$parameter_arr["major_name"]."%"];
        }
        $major_objs = $this
            ->field(
                "id," .
                "major_name," .
                "faculty_id," .
                "create_time"
            )
            ->where($parameter_arr)
            ->select();
        $major_arrs = $this->forToArray($major_objs);
        return $major_arrs;
    }

    /**
     * 查询当前院系所是否在指定学校内
     * @param $parameter_arr 参数 院系所名称 院校id
     * @return mixed
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function selectMajorByName($parameter_arr){
        $major_obj = $this
            ->where($parameter_arr)
            ->find();
        if ($major_obj){
            $major_qrr = $major_obj->toArray();
            return $major_qrr;
        }
        return $major_obj;
    }

    /**
     * 储存专业信息
     * @method 调用
     * @param $parameter_arr
     * @return array|false|int
     */
    public function saveMajorInfo($parameter_arr){
        $major_info_boolean = $this
            ->data($parameter_arr)
            ->allowField(true)
            ->save();
        if ($major_info_boolean){
            $major_info_arr = $this->toArray();
            return $major_info_arr;
        }
        return $major_info_boolean;
    }

    /**
     * 删除一个专业
     * @method 调用
     * @param $parameter_arr
     * @return int
     */
    public function deleteMajor($parameter_arr){
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
        $major_name = $this
            ->where($parameter_arr)
            ->value("major_name");
        return $major_name;
    }

}