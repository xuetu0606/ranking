<?php

/**
 * 学校院系所查询
 * @project 2018考研初试成绩查询排名系统
 * @author 冰华
 * @since 2018-1-23 08:50:32
 */

namespace app\common\model;

class Faculty extends Base {

    // 数据表名称
    protected $table = "think_faculty";

    /**
     * 根据传入的参数来进行查询该学校所有的院系所信息
     * @param $parameter_arr 数组
     * @return bool|mixed 数组
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function getChoiceList($parameter_arr){
        if (!$parameter_arr){
            return false;
        }
        $choice_objs = $this
            ->field(
                "id," .
                "faculty_name," .
                "colleges_id"
            )
            ->where($parameter_arr)
            ->select();
        $choice_arrs = $this->forToArray($choice_objs);
        return $choice_arrs;
    }

    /**
     * 查询当前院系所是否在指定学校内
     * @param $parameter_arr 参数 院系所名称 院校id
     * @return mixed
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function selectFacultyByName($parameter_arr){
        $faculty_obj = $this
            ->where($parameter_arr)
            ->find();
        if ($faculty_obj){
            $faculty_arr = $faculty_obj->toArray();
            return $faculty_arr;
        }
        return $faculty_obj;
    }

    /**
     * 保存院系所数据
     * @param $parameter_arr
     * @return array|false|int
     */
    public function saveFacultyInfo($parameter_arr){
        $faculty_info_boolean = $this
            ->data($parameter_arr)
            ->allowField(true)
            ->save();
        if ($faculty_info_boolean){
            $faculty_info_arr = $this->toArray();
            return $faculty_info_arr;
        }
        return $faculty_info_boolean;
    }
}