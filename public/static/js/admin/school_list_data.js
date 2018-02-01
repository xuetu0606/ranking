window.onload = function(){
    document.getElementById("colleges_add_name_input").focus();
};
/**
 * 后台学校页面js管理
 * @project 2018考研初试排名查询系统
 * @author 冰华
 * @since 2018-1-29 23:14:48
 */
var m = angular.module("ranking_admin_school_list_application", []);
m.controller(
    "ranking_admin_school_list_controller",
    [
        "$scope",
        "$http",
        function ($scope, $http){
            $scope.page = 1;
            $scope.spiner_example = true;
            $scope.schoolArray = new Array();
            /**
             * 获取学校数据方法
             * @method 调用
             */
            $scope.getStudentData = function (page){
                $http.get(
                    "/admin/school/school_list_data.html?page="+page
                ).then(
                    function (result){
                        $scope.data = result;
                        if (page != 1){
                            // 循环获取到的数据添加到页面数组里面
                            angular.forEach(
                                $scope.data.data.data.data,
                                function (value, key) {
                                    $scope.schoolArray.push(value);
                                });
                        }else{
                            $scope.schoolArray = $scope.data
                                .data.data.data;
                        }
                        if ($scope.data.data.data.last_page <= 1){
                            $scope.spiner_example = false;
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

            $scope.getStudentData($scope.page);

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
                        $scope.getStudentData($scope.page);
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

            /**
             * 添加学校
             * @method 调用
             */
            $scope.submitCollegesInfo = function (){
                $http.post(
                    "/admin/school/add_school_info",
                    $scope.colleges
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
                                    window.location.reload(true);
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
                                window.location.reload(true);
                            }
                        );
                    }
                );
            };

            /**
             * 删除一个学校
             * @method 调用
             * @param id
             */
            $scope.deleteColleges = function (id){
                $http.get(
                    "/admin/School/delete_colleges/colleges_id/"+id
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
             * 修改学校
             * 弹出层
             */
            $scope.editColleges = function (id){
                window.location.href = "";
            };

        }
    ]
);