/**
 * 后台课程页面js管理
 * @project 2018考研初试排名查询系统
 * @author 冰华
 * @since 2018-1-29 23:14:48
 */
var m = angular.module("ranking_admin_curriculum_list_application", []);
m.controller(
    "ranking_admin_curriculum_list_controller",
    [
        "$scope",
        "$http",
        function ($scope, $http){
            $http.get(
                "/admin/curriculum/get_curriculum_data"
            ).then(
                function (result){
                    $scope.curriculum_arr = result.data.data;
                },
                function (){
                    layer.msg(
                        "网络错误,请稍后重试",
                        {
                            anim : 2,
                            time : 900
                        },
                        function (){
                            window.location.reload(true);
                        }
                    );
                }
            );

            /**
             * 添加课程
             * @method 调用
             */
            $scope.submitCurriculumInfo = function (){
                $http.post(
                    "/admin/curriculum/add_curriculum_info",
                    $scope.curriculum
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
                                window.location.reload(true);
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
                                window.location.reload(true);
                            }
                        );
                    }
                );
            };

            /**
             * 删除一个课程
             * @method 调用
             * @param id
             */
            $scope.deleteCurriculum = function (id){
                $http.get(
                    "/admin/curriculum/delete_curriculum/curriculum_id/"+id
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
                                window.location.reload(true);
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
                                window.location.reload(true);
                            }
                        );
                    }
                );
            };

        }
    ]
);