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
            $scope.getRankingList = function (page, data){
                $http.post(
                    "/admin/achievement/get_ranking_data?page="+page,
                    data
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
                $scope.getRankingList($scope.page, $scope.data);
            };

            /**
             * 监控当前页面是否上拉到底,
             * 到底之后调用获取数据的方法
             * @method 自动调用
             */
            $(window).scroll(function () {
                var a = $(window).scrollTop()+400;
                var b = $(document).height();
                var c = $(window).height();
                console.log('a==>',a);
                console.log('b==>',b);
                console.log('c==>',c);
                if (a >= b - c) {
                    //上面的代码是判断滚动条滑到底部的代码
                    //alert("滑到底部了");
                    if ($scope.page < $scope.data.last_page){
                        $scope.page = $scope.data.current_page+1;
                        $scope.getRankingList($scope.page, $scope.data);
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