/**
 * 学员页面js管理
 * @project 2018考研初试排名查询系统
 * @author 冰华
 * @since 2018-1-29 23:16:11
 */
var m = angular.module("ranking_admin_student_list_application", []);
m.controller(
    "ranking_admin_student_list_controller",
    [
        "$scope",
        "$http",
        function ($scope, $http){
            $scope.page = 1;
            $scope.spiner_example = true;
            $scope.studentArray = new Array();
            /**
             * 获取学校数据方法
             * @method 调用
             */
            $scope.getStudentData = function (page){
                $http.get(
                    "/admin/student/student_list_data.html?page="+page
                ).then(
                    function (result){
                        $scope.data = result;
                        var respone_obj = result.data;
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
                                        $scope.studentArray.push(value);
                                    });
                                }else{
                                    $scope.studentArray = $scope.data.data.data.data;
                                }
                                if ($scope.data.data.data.last_page <= 1){
                                    $scope.spiner_example = false;
                                }
                                // 把数据拉回到 $scope 的作用域里面
                                $scope.$apply(function(){
                                    $scope.studentArray;
                                    $scope.spiner_example;
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
                    console.log($scope.data.data);
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
                            area: ['420px', '240px'], //宽高
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