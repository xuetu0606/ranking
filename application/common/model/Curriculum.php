<?php

/**
 * 课程查询
 * @project 2018考研初试成绩查询排名系统
 * @author 冰华
 * @since 2018-1-23 11:06:29
 */

namespace app\common\model;

class Curriculum extends Base {

    // 数据表名称
    protected $table = "think_curriculum";

    /**
     * 根据传入的参数来进行查询该专业所有的课程信息
     * @param $parameter_arr 数组
     * @return bool|mixed 数组
     */
    public function getCurriculumList($parameter_arr){
        if (!$parameter_arr){
            return false;
        }
        $curriculum_objs = $this
            ->field(
                "id," .
                "curriculum_name," .
                "major_id," .
                "create_time"
            )
            ->where($parameter_arr)
            ->select();
        $curriculum_arrs = $this->forToArray($curriculum_objs);
        return $curriculum_arrs;
    }

    /**
     * 储存课程信息
     * @method 调用
     * @param $parameter_arr
     * @return array|false|int
     */
    public function saveCurriculumInfo($parameter_arr){
        $curriculum_info_boolean = $this::create($parameter_arr);
        if ($curriculum_info_boolean){
            $curriculum_info_arr = $curriculum_info_boolean->toArray();
            return $curriculum_info_arr;
        }
        return $curriculum_info_boolean;
    }

    /**
     * 根据专业id和课程名来查询课程信息是否存在
     * 存在返回数据,不存在返回false
     * @param $parameter_arr 课程名 专业id
     * @return array|false|\PDOStatement|string|\think\Model 当前查询的课程信息
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function selectCurriculumByName($parameter_arr){
        $curriculum_obj = $this
            ->where($parameter_arr)
            ->find();
        if ($curriculum_obj){
            $curriculum_arr = $curriculum_obj->toArray();
            return $curriculum_arr;
        }
        return $curriculum_obj;
    }

    /**
     * 根据课程id查询课程名称
     * @method 调用
     * @param $parameter_arr 传入参数
     * @return mixed string
     */
    public function getCurriculumNameById($parameter_arr){
        $curriculum_name = $this
            ->where($parameter_arr)
            ->value("curriculum_name");
        return $curriculum_name;
    }

    /**
     * 删除一个课程
     * @method 调用
     * @param $parameter_arr
     * @return int
     */
    public function deleteCurriculum($parameter_arr){
        $query_boolean = $this
            ->where($parameter_arr)
            ->delete();
        return $query_boolean;
    }

}