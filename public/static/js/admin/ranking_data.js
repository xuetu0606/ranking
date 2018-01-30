/**
 * 后台课程页面js管理
 * @project 2018考研初试排名查询系统
 * @author 冰华
 * @since 2018-1-29 23:14:48
 */
var m = angular.module("ranking_admin_ranking_application", []);
m.controller(
    "ranking_admin_ranking_controller",
    [
        "$scope",
        "$http",
        function ($scope, $http){
            $scope.page = 1;
            /**
             * 获取所有的专业课代码
             */
            $http.get(
                "/admin/achievement/get_code_list"
            ).then(
                function (result){
                    $scope.code_arr = result.data.data;
                },
                function (){
                    layer.msg(
                        "网络错误,请稍后重试",
                        {
                            anim : 2,
                            time : 900
                        },
                        function (){
                            // window.location.reload(true);
                        }
                    );
                }
            );

            /**
             * 获取所有的成绩
             */
            $scope.getRankingList = function (page){
                $http.post(
                    "/admin/achievement/get_ranking_data?page="+page,
                    $scope.data
                ).then(
                    function (result){
                        $scope.ranking_arr = result.data.data.data;
                    },
                    function (){
                        layer.msg(
                            "网络错误,请稍后重试",
                            {
                                anim : 2,
                                time : 900
                            },
                            function (){
                                // window.location.reload(true);
                            }
                        );
                    }
                );
            }

            /**
             * 监控code的变化随时获取新数据
             */
            $scope.monitorCode = function (){
                $scope.getRankingList($scope.page);
            }



        }
    ]
);