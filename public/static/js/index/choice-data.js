/**
 * 成绩录入界面代码
 * @project 2018考研初试排名查询系统
 * @author 冰华
 * @since 2018-1-23 17:39:02
 */
var m = angular.module("ranking_index_choice_application", []);
m.controller(
    "ranking_index_choice_controller",
    [
        "$scope",
        "$http",
        function ($scope, $http){

            $scope.data = {
                "telephone" : "",
                "user_name" : "",
                "code" : ""
            };

            $http.get(
                "/index/index/get_faculty_data"
            ).then(
                function (result){
                    $scope.faculty_arr = result.data.data;
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
             * 监视院系所字段
             */
            $scope.$watch(
                "data.faculty_id",
                function(){
                    if (!$scope.data.faculty_id){
                        return false;
                    }
                    $http.get(
                        "/index/index/get_major_data" +
                        "/faculty_id/"+$scope.data.faculty_id
                    ).then(
                        function (result){
                            $scope.major_arr = result.data.data.data;
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
                }
            );
            /**
             * 监视专业字段
             */
            $scope.$watch(
                "data.major_id",
                function(){
                    if (!$scope.data.major_id){
                        return false;
                    }
                    $http.get(
                        "/index/index/get_curriculum_data" +
                        "/major_id/"+$scope.data.major_id
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
                }
            );

            $scope.submitAchievement = function (){
                var curriculum_arr = $(".curriculum");
                $scope.data.achievement_arr = new Array();
                angular.forEach(curriculum_arr, function (value, key){
                    var id = value.id;
                    var value = value.value;
                    var data = {
                        "curriculum_id" : id,
                        "fraction" : value
                    };
                    $scope.data.achievement_arr.push(data);
                });

                $http.post(
                    "/index/index/save_achievement",
                    $scope.data
                ).then(
                    function (result){
                        var respone_obj = result.data;
                        respone_obj = jsonOrArrayToObject(respone_obj);
                        if (
                            respone_obj.code == 1
                            &&
                            respone_obj.data.url != ""
                        ){
                            window.location.href = respone_obj.data.url;
                            return false;
                        }
                        layer.msg(
                            respone_obj.msg,
                            {
                                anim : 2,
                                time : 900
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

            }
        }
    ]
);