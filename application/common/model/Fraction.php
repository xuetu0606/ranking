<?php

/**
 * 分数信息模型
 * @project 2018考研初试成绩查询排名系统
 * @author 冰华
 * @since 2018-1-23 16:12:10
 */

namespace app\common\model;

class Fraction extends Base {

    // 数据表名称
    protected $table = "think_fraction";

    /**
     * 保存分数数据到分数表
     * @method 调用
     * @param $parameter_arr 成绩信息数组
     * @return false|int 返回成功与否
     */
    public function saveFractionInfo($parameter_arr){
        $query_boolean = $this
            ->data($parameter_arr)
            ->allowField(true)
            ->save();
        if ($query_boolean){
            $fraction_info_arr = $this->toArray();
            return $fraction_info_arr;
        }
        return $query_boolean;
    }

    /**
     * 验证当前成绩数据是否重复
     * @param $parameter_arr 传入参数
     * @return array 验证信息
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function selectFractionIsHas($parameter_arr){
        foreach ($parameter_arr as $key => $value){
            $where_arr = [
                $value["key"] => $value["value"],
            ];
            $query_boolean = $this->where($where_arr)->find();
            if ($query_boolean){
                $return_arr = [
                    "status" => false,
                    "msg" => $value["msg"],
                ];
                return $return_arr;
            }
        }
        $return_arr = [
            "status" => true,
            "msg" => "用户信息可以录入",
        ];
        return $return_arr;
    }

    /**
     * 根据传入参数查询所有的成绩列表
     * @method 调用
     * @param $parameter_arr 传入数据
     * @return mixed 数组
     */
    public function getFractionList($parameter_arr){
        $fraction_objs = $this
            ->field(
                "id," .
                "user_id," .
                "user_name," .
                "telephone," .
                "total," .
                "code," .
                "wechat," .
                "qq," .
                "colleges_id," .
                "faculty_id," .
                "major_id"
            )
            ->where($parameter_arr)
            ->order("total desc")
            ->paginate(15);
        $fraction_arrs = $fraction_objs->toArray();
        return $fraction_arrs;
    }

    /**
     * 根据用户id查询当前用户的排名信息
     * @method 调用
     * @param $parameter_arr 传入参数
     * @return array 数组
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function getUserFractionInfo($parameter_arr){
        $user_fraction_info_obj = $this
            ->where($parameter_arr)
            ->field(
                "id," .
                "user_id," .
                "colleges_id," .
                "user_name," .
                "telephone," .
                "total," .
                "code"
            )->find();
        if ($user_fraction_info_obj){
            $user_fraction_info_arr = $user_fraction_info_obj->toArray();
            return $user_fraction_info_arr;
        };
        return $user_fraction_info_obj;
    }

    /**
     * 获取当前用户上一名的排名
     * @method 调用
     * @param $parameter_arr
     * @return int|string
     */
    public function getUserRanking($parameter_arr){
        $user_total = $this
            ->where($parameter_arr)
            ->value("total");
        $where_ranking_arr = [
            "total" => [
                ">",
                $user_total
            ]
        ];
        $user_pre_ranking = $this
            ->where($where_ranking_arr)
            ->count();
        ;
        return $user_pre_ranking;
    }

    /**
     * 获取全部专业课code
     * @method 调用
     * @return mixed array
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function getCodeList(){
        $code_objs = $this->distinct(true)->field("code")->select();
        $code_arrs = $this->forToArray($code_objs);
        return $code_arrs;
    }

}