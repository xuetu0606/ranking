/**
 * 后台学校修改页面js管理
 * @project 2018考研初试排名查询系统
 * @author 冰华
 * @since 2018-1-29 23:14:48
 */
var m = angular.module("ranking_admin_school_edit_application", []);
m.controller(
    "ranking_admin_school_edit_controller",
    [
        "$scope",
        "$http",
        function ($scope, $http){
            /**
             * 获取学校数据方法
             * @method 调用
             */
            $http.get(
                "/admin/school/get_school_edit_info.html"
            ).then(
                function (result){
                    $scope.data = result.data.data;
                },
                function (){
                    layer.msg(
                        "网络错误,请稍后重试",
                        {
                            anim : 2,
                            time : 900
                        },
                        function (){
                            //window.location.reload(true);
                        }
                    );
                }
            );

            /**
             * 修改学校
             * @method 调用
             */
            $scope.submitCollegesInfo = function (){
                $http.post(
                    "/admin/school/school_edit_data",
                    $scope.data
                ).then(
                    function (result){
                        var respone_obj = result.data;
                        layer.msg(
                            respone_obj.msg,
                            {
                                anim : 2,
                                time : 900
                            },
                            function () {
                                if (respone_obj.code==1){
                                    //window.location.reload(true);
                                    return false;
                                }
                            }
                        );
                    },
                    function (){
                        layer.msg(
                            "网络错误,请稍后重试",
                            {
                                anim : 2,
                                time : 900
                            },
                            function (){
                                //window.location.reload(true);
                            }
                        );
                    }
                );
            };

        }
    ]
);