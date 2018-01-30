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
            $scope.spiner_example = true;

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
                        $scope.spiner_example = false;
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
            };

            /**
             * 监控code的变化随时获取新数据
             */
            $scope.monitorCode = function (){
                $scope.getRankingList($scope.page);
            };

            /**
             * 监控当前页面是否上拉到底,
             * 到底之后调用获取数据的方法
             * @method 自动调用
             */
            $(window).scroll(function () {
                var h = $(document).height(); //div可视区域的高度
                var a = $(document).scrollTop();
                var b = $(window).height();
                if (a >= h - b) {
                    //上面的代码是判断滚动条滑到底部的代码
                    //alert("滑到底部了");
                    if ($scope.page < $scope.data.data.data.last_page){
                        $scope.page = $scope.data.data.data.current_page+1;
                        $scope.getRankingList($scope.page);
                        return false;
                    }
                    $scope.spiner_example = false;
                    layer.msg(
                        "已经到底了~",
                        {
                            anim : 2,
                            time : 900
                        }
                    );
                    // 把数据拉回到 $scope 的作用域里面
                    $scope.$apply(function(){
                        $scope.page;
                        $scope.spiner_example;
                    });
                }
            });

        }
    ]
);