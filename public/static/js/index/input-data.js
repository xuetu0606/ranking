/**
 * 成绩录入界面代码
 * @project 2018考研初试排名查询系统
 * @author 冰华
 * @since 2018-1-23 17:39:02
 */
var m = angular.module("ranking_index_input_application", []);
m.controller(
    "ranking_index_input_controller",
    [
        "$scope",
        "$http",
        function ($scope, $http){

            $scope.data = {
                "user_name" : "",
                "telephone" : "",
                "wechat" : "",
                "qq" : "",
                "faculty" : "",
                "major" : "",
                "code" : "",
                "curriculum_arr" : {
                    "curriculum_1" : {
                        "curriculum_name" : "",
                        "fraction" : ""
                    },
                    "curriculum_2" : {
                        "curriculum_name" : "",
                        "fraction" : ""
                    },
                    "curriculum_3" : {
                        "curriculum_name" : "",
                        "fraction" : ""
                    },
                    "curriculum_4" : {
                        "curriculum_name" : "",
                        "fraction" : ""
                    },
                    "curriculum_5" : {
                        "curriculum_name" : "",
                        "fraction" : ""
                    },
                    "curriculum_6" : {
                        "curriculum_name" : "",
                        "fraction" : ""
                    }
                }
            };

            $scope.submitAchievement = function (){
                $http.post(
                    "/index/index/input_data",
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
                                // window.location.reload(true);
                            }
                        );
                    }
                );
            }
        }
    ]
);