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
                        "curriculum_name" : "政治",
                        "fraction" : ""
                    },
                    "curriculum_2" : {
                        "curriculum_name" : "外语",
                        "fraction" : ""
                    },
                    "curriculum_3" : {
                        "curriculum_name" : "业务课一",
                        "fraction" : ""
                    },
                    "curriculum_4" : {
                        "curriculum_name" : "业务课二",
                        "fraction" : ""
                    }
                }
            };
            var colleges_id = $("#colleges_id").val();
            $http.get(
                "/index/index/get_colleges_name/colleges_id/"+colleges_id
            ).then(
                function (result){
                    $scope.colleges_name = result.data;
                },
                function (){
                    layer.msg(
                        "网络错误,请稍后重试",
                        {
                            anim : 2,
                            time : 900
                        },
                        function (){
                            //window.location.reload(true);
                        }
                    );
                }
            );
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