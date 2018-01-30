/**
 * 后台专业页面js管理
 * @project 2018考研初试排名查询系统
 * @author 冰华
 * @since 2018-1-29 23:14:48
 */
var m = angular.module("ranking_admin_major_list_application", []);
m.controller(
    "ranking_admin_major_list_controller",
    [
        "$scope",
        "$http",
        function ($scope, $http){
            $http.get(
                "/admin/major/get_major_data"
            ).then(
                function (result){
                    $scope.major_arr = result.data.data;
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
             * 添加专业
             * @method 调用
             */
            $scope.submitMajorInfo = function (){
                $http.post(
                    "/admin/major/add_major_info",
                    $scope.major
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
             * 删除一个专业
             * @method 调用
             * @param id
             */
            $scope.deleteMajor = function (id){
                $http.get(
                    "/admin/major/delete_major/major_id/"+id
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