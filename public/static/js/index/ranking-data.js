/**
 * 成绩录入界面代码
 * @project 2018考研初试排名查询系统
 * @author 冰华
 * @since 2018-1-24 11:32:25
 */
var m = angular.module("ranking_index_ranking_application", []);
m.controller(
    "ranking_index_ranking_controller",
    [
        "$scope",
        "$http",
        function ($scope, $http){
            $scope.last_str = "拼命加载中~";
            $scope.rankingArray = new Array();

            /**
             * 获取当前用户的用户id
             * @method 自动
             */
            $http.get(
                "/index/index/get_user_id"
            ).then(
                function (result){
                    $scope.user_id = result.data;
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
             * 获取当前用户的名次
             */
            $http.get(
                "/index/index/get_user_ranking"
            ).then(
                function (result){
                    $scope.ranking = result.data;
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
             * 获取学校信息
             * @method 自动
             */
            $http.get(
                "/index/index/get_user_colleges_info"
            ).then(
                function (result){
                    $scope.colleges = result.data.data;
                    console.log(result);
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
             * 获取当前用户的成绩信息
             */
            $http.get(
                "/index/index/get_user_ranking_info"
            ).then(
                function (result){
                    $scope.user_ranking_info_arr = result.data.data;
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
             * 获取排名列表数据
             * @method 调用
             */
            $scope.getCollegesData = function (page){
                $http.get(
                    "/index/index/get_ranking_data.html?page="+page
                ).then(
                    function (result){
                        $scope.data = result;
                        var respone_obj = result.data;
                        respone_obj = jsonOrArrayToObject(respone_obj);
                        layer.msg(
                            respone_obj.msg,
                            {
                                anim : 2,
                                time : 900
                            },
                            function (){
                                if (page != 1){
                                    // 循环获取到的数据添加到页面数组里面
                                    angular.forEach($scope.data.data.data.data, function (value, key) {
                                        $scope.rankingArray.push(value);
                                    });
                                }else{
                                    $scope.rankingArray = $scope.data.data.data.data;
                                }
                                if ($scope.data.data.data.last_page <= 1){
                                    $scope.load_str = "已经到底了~";
                                    $scope.add_ranking = true;
                                }
                                // 把数据拉回到 $scope 的作用域里面
                                $scope.$apply(function(){
                                    $scope.load_str;
                                    $scope.add_ranking;
                                    $scope.rankingArray;
                                });
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
                                // window.location.reload(true);
                            }
                        );
                    }
                );

            };

            /**
             * 上拉分页
             * @method 自动
             */
            $(window).scroll(function () {
                var a = $(window).scrollTop()+50;
                var b = $(document).height();
                var c = $(window).height();
                if (a >= b - c) {
                    //上面的代码是判断滚动条滑到底部的代码
                    if ($scope.data.data.data.current_page < $scope.data.data.data.last_page){
                        var page = $scope.data.data.data.current_page+1;
                        $scope.getCollegesData(page);
                        return false;
                    }
                    $scope.load_str = "已经到底了~";
                    $scope.$apply(function (){
                        $scope.load_str;
                    });
                }
            });

            // 首次调用
            $scope.getCollegesData(1);

        }
    ]
);