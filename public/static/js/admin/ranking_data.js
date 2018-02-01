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

            $scope.data = {
                colleges_search : "",
                colleges_id : "",
                colleges_arr : [],
                faculty_search : "",
                faculty_id : "",
                faculty_arr : [],
                major_search : "",
                major_id : "",
                major_arr : [],
                ranking_arr : [],
                spiner_example : true,
                page : 1
            };

            /**
             * 获取学校数据方法
             * @method 调用
             */
            $scope.getCollegesData = function (page, parameter_arr){
                $http.post(
                    "/admin/achievement/get_colleges_data?page="+page,
                    parameter_arr
                ).then(
                    function (result){
                        $scope.data.colleges_arr = result.data.data.data;
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
            // 首次调用获取学校数据
            $scope.getCollegesData(1);
            /**
             * 监控学校搜索字段的变化
             * @method 自动
             */
            $scope.$watch(
                "data.colleges_search",
                function(){
                    var parameter_arr = {
                        "colleges_name" : $scope.data.colleges_search
                    };
                    $scope.getCollegesData(1, parameter_arr);
                }
            );

            /**
             * 获取院系所数据的方法
             * @method 调用
             */
            $scope.getFacultyData = function (parameter_arr){
                $http.post(
                    "/admin/achievement/get_faculty_data",
                    parameter_arr
                ).then(
                    function (result){
                        $scope.data.faculty_arr = result.data.data;
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
             * 监视学校id的变化
             * @method 自动
             */
            $scope.$watch(
                "data.colleges_id",
                function(){
                    if ($scope.data.colleges_id==false){
                        return false;
                    }
                    var parameter_arr = {
                        "colleges_id" : $scope.data.colleges_id
                    };
                    $scope.getFacultyData(parameter_arr);
                }
            );
            /**
             * 监控院系所搜索字段的变化
             * @method 自动
             */
            $scope.$watch(
                "data.faculty_search",
                function(){
                    var parameter_arr = {
                        "faculty_name" : $scope.data.faculty_search,
                        "colleges_id" : $scope.data.colleges_id
                    };
                    $scope.getFacultyData(parameter_arr);
                }
            );

            /**
             * 获取专业数据的方法
             * @method 调用
             */
            $scope.getMajorData = function (parameter_arr){
                $http.post(
                    "/admin/achievement/get_major_data",
                    parameter_arr
                ).then(
                    function (result){
                        $scope.data.major_arr = result.data.data;
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
             * 监控专业搜索字段的变化
             * @method 自动
             */
            $scope.$watch(
                "data.major_search",
                function(){
                    var parameter_arr = {
                        "major_name" : $scope.data.major_search,
                        "faculty_id" : $scope.data.faculty_id
                    };
                    $scope.getMajorData(parameter_arr);
                }
            );

            /**
             * 监视院系所id的变化
             * @method 自动
             */
            $scope.$watch(
                "data.faculty_id",
                function(){
                    if ($scope.data.faculty_id==false){
                        return false;
                    }
                    var parameter_arr = {
                        "faculty_id" : $scope.data.faculty_id
                    };
                    $scope.getMajorData(parameter_arr);
                }
            );

            /**
             * 获取所有的成绩
             */
            $scope.getRankingList = function (page, parameter_arr){
                $http.post(
                    "/admin/achievement/get_ranking_data?page="+page,
                    parameter_arr
                ).then(
                    function (result){
                        $scope.data.ranking_arr = result.data.data.data;
                        $scope.data.spiner_example = false;
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
             * 监视专业id的变化
             * @method 自动
             */
            $scope.$watch(
                "data.major_id",
                function(){
                    if ($scope.data.major_id==false){
                        return false;
                    }
                    var parameter_arr = {
                        "colleges_id" : $scope.data.colleges_id,
                        "faculty_id" : $scope.data.faculty_id,
                        "major_id" : $scope.data.major_id
                    };
                    $scope.getRankingList($scope.data.page, parameter_arr);
                }
            );

            /**
             * 监控当前页面是否上拉到底,
             * 到底之后调用获取数据的方法
             * @method 自动调用
             */
            $(window).scroll(function () {
                var h = $(document).height(); //div可视区域的高度
                var a = $(document).scrollTop()+360;
                var b = $(window).height();
                if (a >= h - b) {
                    //上面的代码是判断滚动条滑到底部的代码
                    //alert("滑到底部了");
                    if ($scope.data.page < $scope.data.data.data.last_page){
                        $scope.data.page = $scope.data.data.data.current_page+1;
                        $scope.getRankingList($scope.data.page);
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
                        $scope.data.page;
                        $scope.spiner_example;
                    });
                }
            });

            $scope.details = function (user_id, fraction_id){
                var data = {
                    "user_id" : user_id,
                    "fraction_id" : fraction_id
                };
                $http.post(
                    "/admin/student/get_user_achievement_details",
                    data
                ).then(
                    function (result){
                        var result_obj = result.data.data;
                        var str = get_html(result_obj);
                        //页面层
                        layer.open({
                            type: 1,
                            skin: 'layui-layer-rim', //加上边框
                            area: ['420px', '260px'], //宽高
                            content:str
                        });
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
             * 组装课程页面代码
             * @param data
             * @returns {string}
             */
            function get_html(data){
                var str = "<table class=\"table table-bordered table-hover\">\n" +
                    "    <thead>\n" +
                    "    <tr class=\"long-tr\">\n" +
                    "        <th>科目</th>\n" +
                    "        <th>分数</th>\n" +
                    "    </tr>\n" +
                    "    </thead>\n" ;
                for (var i=0; i < data.length; i++) {
                    str+=
                        "        <tr class=\"long-td\">\n" +
                        "            <td>"+data[i].curriculum_name+"</td>\n" +
                        "            <td>"+data[i].fraction+"</td>\n" +
                        "        </tr>\n" ;
                }
                str+=
                    "</table>";
                return str;
            }
        }
    ]
);