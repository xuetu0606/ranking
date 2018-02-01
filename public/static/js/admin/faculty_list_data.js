window.onload = function(){
    document.getElementById("faculty_add_name_input").focus();
};
/**
 * 后台院系所页面js管理
 * @project 2018考研初试排名查询系统
 * @author 冰华
 * @since 2018-1-29 23:14:48
 */
var m = angular.module("ranking_admin_faculty_list_application", []);
m.controller(
    "ranking_admin_faculty_list_controller",
    [
        "$scope",
        "$http",
        function ($scope, $http){
            $http.get(
                "/admin/faculty/get_faculty_data"
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
                            // window.location.reload(true);
                        }
                    );
                }
            );

            /**
             * 添加院系所
             * @method 调用
             */
            $scope.submitFacultyInfo = function (){
                $http.post(
                    "/admin/faculty/add_faculty_info",
                    $scope.faculty
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
             * 删除一个院系所
             * @method 调用
             * @param id
             */
            $scope.deleteFaculty = function (id){
                $http.get(
                    "/admin/faculty/delete_faculty/faculty_id/"+id
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

        }
    ]
);