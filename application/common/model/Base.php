<?php
/**
 * 所有模型的父类
 * @project 2018考研初试成绩查询排名系统
 * @author 冰华
 * @since 2018-1-18 11:36:18
 */
namespace app\common\model;

use think\Model;
use traits\model\SoftDelete;

class Base extends Model{

    // 是否需要自动写入时间戳 如果设置为字符串 则表示时间字段的类型
    protected $autoWriteTimestamp = "datetime";

    // 使用软删除
    use SoftDelete;
    protected static $deleteTime = 'delete_time';

    /**
     * 传入一个select查询出来的对象数组,
     * 返回一个二维数组
     * @method 调用
     * @param $parameter_arr 数组
     * @return mixed 数组
     */
    public function forToArray($parameter_arr){
        foreach ($parameter_arr as $key => $value) {
            $parameter_arr[$key] = $value->toArray();
        }
        return $parameter_arr;
    }

    /**
     * 对用户的密码进行加密
     * @method 调用
     * @param $parameter_str 用户输入的字符串
     * @return string 字符串
     */
    public function encrypt($parameter_str){
        $password_str = md5("密码" . $parameter_str);
        return $password_str;
    }

    public function updateInfo($parameter_str, $id){
        $where_arr = [
            "id" => $id
        ];
        $query_boolean = $this
            ->where($where_arr)
            ->update($parameter_str)
        ;
        return $query_boolean;
    }

}