<?php

/**
 * 成绩信息模型
 * @project 2018考研初试成绩查询排名系统
 * @author 冰华
 * @since 2018-1-23 16:12:10
 */

namespace app\common\model;

class Achievement extends Base {

    // 数据表名称
    protected $table = "think_achievement";

    /**
     * 保存成绩数据到成绩表
     * @method 调用
     * @param $parameter_arr 成绩信息数组
     * @return false|int 返回成功与否
     */
    public function saveAchievementAllInfo($parameter_arr){
        $query_boolean = $this
            ->saveAll($parameter_arr);
        return $query_boolean;
    }

    /**
     * 储存成绩信息
     * @method 调用
     * @param $parameter_arr
     * @return array|false|int
     */
    public function saveAchievementList($parameter_arr){
        $achievement_info_boolean = $this
            ->data($parameter_arr)
            ->allowField(true)
            ->save();
        if ($achievement_info_boolean){
            $achievement_info_arr = $this->toArray();
            return $achievement_info_arr;
        }
        return $achievement_info_boolean;
    }

    /**
     * 查询当前用户的成绩信息
     * @method 调用
     * @param $parameter_arr 课程id 用户id
     * @return array|false|\PDOStatement|string|\think\Model 成绩信息|false
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function selectUserAchievementInfo($parameter_arr){
        $achievement_info_obj = $this
            ->field(
                "id," .
                "user_id," .
                "fraction_id," .
                "curriculum_id," .
                "fraction"
            )
            ->where($parameter_arr)
            ->select();
        if($achievement_info_obj){
            $achievement_info_arr = $this->forToArray($achievement_info_obj);
            return $achievement_info_arr;
        }
        return $achievement_info_obj;
    }
}