/**
 * 学校选择页面
 * @project 2018考研初试成绩查询排名系统
 * @author 冰华
 * @since 2018-1-22 14:28:03
 */
var m = angular.module("ranking_index_index_application", []);
m.controller(
    "ranking_index_index_controller",
    [
        "$scope",
        "$http",
        function ($scope, $http){
            $scope.page = 1;
            $scope.load_str = "正在拼命加载中~";
            $scope.collegesArray = new Array();
            $scope.search = "";
            $scope.add_colleges = false;
            /**
             * 获取学校数据方法
             * @method 调用
             */
            $scope.getCollegesData = function (page, parameter_arr){
                $http.post(
                    "/index/index/get_colleges_data.html?page="+page,
                    parameter_arr
                ).then(
                    function (result){
                        $scope.data = result;
                        var respone_obj = result.data;
                        respone_obj = jsonOrArrayToObject(respone_obj);
                        if (page != 1){
                            // 循环获取到的数据添加到页面数组里面
                            angular.forEach($scope.data.data.data.data, function (value, key) {
                                $scope.collegesArray.push(value);
                            });
                        }else{
                            $scope.collegesArray = $scope.data.data.data.data;
                        }
                        if ($scope.data.data.data.last_page <= 1){
                            $scope.load_str = "已经到底了~";
                            $scope.add_colleges = true;
                        }
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
             * 监控当前页面是否上拉到底,
             * 到底之后调用获取数据的方法
             * @method 自动调用
             */
             $(window).scroll(function () {
                var a = $(window).scrollTop();
                var b = $(document).height();
                var c = $(window).height();
                if (a >= b - c) {
                    //上面的代码是判断滚动条滑到底部的代码
                    //alert("滑到底部了");
                    if ($scope.page < $scope.data.data.data.last_page){
                        $scope.page = $scope.data.data.data.current_page+1;
                        $scope.getCollegesData($scope.page, $scope.parameter_arr);
                        return false;
                    }
                    $scope.load_str = "已经到底了~";
                    $scope.add_colleges = true;
                    // 把数据拉回到 $scope 的作用域里面
                    $scope.$apply(function(){
                        $scope.page;
                        $scope.load_str;
                        $scope.add_colleges;
                    });
                }
            });

            /**
             * 监视搜索字段是否修改,
             * 并根据搜索字段进行搜索学校
             */
            $scope.$watch(
                "search",
                function(){
                    $scope.parameter_arr = {
                        "colleges_name" : $scope.search
                    };
                    if ($scope.search!=""){
                        $scope.getCollegesData(1, $scope.parameter_arr);
                    }
                }
            );

            // 首次调用获取学校数据的方法
            $scope.getCollegesData($scope.page);

            /**
             * 创建新学校
             */
            $scope.create_colleges = {
                "colleges_name" : ""
            };
            $scope.create = function(){
                $http.post(
                    "/index/index/save_colleges",
                    $scope.create_colleges
                ).then(
                    function (result){
                        var respone_obj = result.data;
                        respone_obj = jsonOrArrayToObject(respone_obj);
                        layer.msg(
                            respone_obj.msg,
                            {
                                anim : 2,
                                time : 900
                            },
                            function () {
                                if (respone_obj.data.id){
                                    window.location.href =
                                        "/index/index/input" +
                                        "/colleges_id/"+respone_obj.data.id;
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
                                // window.location.reload(true);
                            }
                        );
                    }
                );
            }
        }
    ]
);