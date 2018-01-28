<?php

/**
 * 用户数据模型
 * @project 2018考研初试成绩查询排名系统
 * @author 冰华
 * @since 2018-1-18 11:33:13
 */

namespace app\common\model;

class User extends Base {

    // 数据表名称
    protected $table = "think_student";

    /**
     * 根据用户输入的登陆信息查询该用户是否存在
     * @method 调用
     * @param $parameter_arr 用户输入数据数组
     * @return array 用户信息数组
     */
    public function selectUserInfo($parameter_arr){
        $is_has_password = isset($parameter_arr["password"]);
        if ($is_has_password){
            $parameter_arr["password"] = $this
                ->encrypt($parameter_arr["password"]);
        }
        $user_id = $this
            ->where($parameter_arr)
            ->value("id");
        return $user_id;
    }

    /**
     * 根据用户输入的登陆信息查询该用户是否存在
     * @method 调用
     * @param $parameter_arr 用户输入数据数组
     * @return array 用户信息数组
     */
    public function selectUserInfoFind($parameter_arr){
        $user_obj = $this
            ->field(
                "id," .
                "telephone"
            )
            ->where($parameter_arr)
            ->find();
        $user_arr = $user_obj->toArray();
        return $user_arr;
    }

    /**
     * 储存用户信息的方法
     * @method 调用
     * @param $parameter_arr 用户的信息,账号密码
     * @return false|int 返回储存成功与否的状态
     */
    public function saveUserInfo($parameter_arr){
        $is_has_password = isset($parameter_arr["password"]);
        if ($is_has_password){
            $parameter_arr["password"] = $this
                ->encrypt($parameter_arr["password"]);
        }
        $save_boolean = $this
            ->data($parameter_arr)
            ->allowField(true)
            ->save();
        if ($save_boolean){
            return $this->id;
        }
        return $save_boolean;
    }

    /**
     * 根据传入数据修改用户信息
     * @method 调用
     * @param $parameter_arr 数组(用户信息)
     * @param $user_id int(用户id)
     * @return $this Boolean
     */
    public function updateUserInfo($parameter_arr, $user_where_arr){
        if (isset($parameter_arr["password"])){
            $parameter_arr["password"] = $this
                ->encrypt($parameter_arr["password"]);
        }
        $query_boolean = $this
            ->where($user_where_arr)
            ->update($parameter_arr);
        return $query_boolean;
    }

    /**
     * 获取所有的用户
     * @method 调用
     * @return mixed 数组
     * @throws \think\exception\DbException
     */
    public function selectAllUser(){
        $user_info_objs = $this
            ->field(
                "id," .
                "telephone," .
                "create_time"
            )
            ->paginate(30);
        $user_info_arrs = $user_info_objs->toArray();
        return $user_info_arrs;
    }

}