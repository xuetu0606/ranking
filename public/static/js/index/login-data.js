/**
 * 登陆页面数据操作js
 * @project 2018考研初试成绩查询排名系统
 * @author 冰华
 * @since 2018-1-18 09:59:15
 */
var m = angular.module("ranking_index_login_application", []);
m.controller(
    "ranking_index_login_controller",
    [
        "$scope",
        "$http",
        function($scope, $http){
            $scope.data = {
                "telephone" : "",
                "password" : ""
            };
            $scope.login = function (){
                $http.post(
                    "/index/index/login_data",
                    $scope.data
                ).then(
                    function(result){
                        var respone_obj = result.data;
                        respone_obj = jsonOrArrayToObject(respone_obj);
                        if (respone_obj.code == 1){
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
                    function(){
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