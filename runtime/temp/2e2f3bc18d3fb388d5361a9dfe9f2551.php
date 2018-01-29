<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:96:"D:\workspace\company-www\ranking-lunhui\public/../application/admin\view\school\school_list.html";i:1517219206;s:81:"D:\workspace\company-www\ranking-lunhui\application\admin\view\public\header.html";i:1516956621;s:81:"D:\workspace\company-www\ranking-lunhui\application\admin\view\public\footer.html";i:1516956154;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo config('WEB_SITE_TITLE'); ?></title>
    <link href="/static/admin/css/bootstrap.min.css?v=3.3.6" rel="stylesheet">
    <link href="/static/admin/css/font-awesome.min.css?v=4.4.0" rel="stylesheet">
    <link href="/static/admin/css/animate.min.css" rel="stylesheet">
    <link href="/static/admin/css/plugins/iCheck/custom.css" rel="stylesheet">
    <link href="/static/admin/css/plugins/chosen/chosen.css" rel="stylesheet">
    <link href="/static/admin/css/plugins/switchery/switchery.css" rel="stylesheet">
    <link href="/static/admin/css/style.min.css?v=4.1.0" rel="stylesheet">
    <link href="/static/admin/css/plugins/sweetalert/sweetalert.css" rel="stylesheet">
    <script src="/static/js/angular.js"></script>
    <style type="text/css">
    .long-tr th{
        text-align: center
    }
    .long-td td{
        text-align: center
    }
    </style>
</head>
<script src="/static/js/admin/school_list_data.js"></script>
<body class="gray-bg" ng-app="ranking_admin_school_list_application" ng-controller="ranking_admin_school_list_controller">
<div class="wrapper wrapper-content animated fadeInRight">
    <!-- Panel Other -->
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5>学校列表</h5>
        </div>
        <div class="ibox-content">
            <!--学校添加框开始-->
            <div class="row">
                <div class="col-sm-12">
                    <div  class="col-sm-2" style="width: 100px">
                        <div class="input-group" >
                            <a href=""><button class="btn btn-outline btn-primary" type="button">添加用户</button></a>
                        </div>
                    </div>
                    <form name="admin_list_sea" class="form-search" method="post" action="">
                        <div class="col-sm-3">
                            <div class="input-group">
                                <input type="text" id="key" class="form-control" name="key" value="" placeholder="输入需查询的用户名" />
                                <span class="input-group-btn">
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> 搜索</button>
                                </span>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!--学校添加框结束-->
            <div class="hr-line-dashed"></div>

            <div class="example-wrap">
                <div class="example">
                    <table class="table table-bordered table-hover">
                        <thead>
                        <tr class="long-tr">
                            <th>ID</th>
                            <th>学校名</th>
                            <th>QQ群</th>
                            <th>添加时间</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                            <tr class="long-td" ng-repeat="(k, v) in schoolArray">
                                <td ng-bind="v.id"></td>
                                <td ng-bind="v.colleges_name"></td>
                                <td ng-bind="v.qq_group"></td>
                                <td ng-bind="v.create_time"></td>
                                <td>
                                    <div class="btn btn-primary btn-outline btn-xs" ng-click="details(v.id, v.fraction_id);">
                                        <i class="fa fa-paste"></i>
                                        查看成绩
                                    </div>
                                </td>
                            </tr>
                        <tbody id="list-content"></tbody>
                    </table>
                    <div id="AjaxPage" style=" text-align: right;"></div>
                    <div id="allpage" style=" text-align: right;"></div>
                </div>
            </div>
            <!-- End Example Pagination -->
        </div>
    </div>
</div>
<!-- End Panel Other -->
</div>

<!-- 加载动画 -->
<div class="spiner-example" ng-show="spiner_example">
    <div class="sk-spinner sk-spinner-three-bounce">
        <div class="sk-bounce1"></div>
        <div class="sk-bounce2"></div>
        <div class="sk-bounce3"></div>
    </div>
</div>

<script src="__JS__/jquery.min.js?v=2.1.4"></script>
<script src="__JS__/bootstrap.min.js?v=3.3.6"></script>
<script src="__JS__/content.min.js?v=1.0.0"></script>
<script src="__JS__/plugins/chosen/chosen.jquery.js"></script>
<script src="__JS__/plugins/iCheck/icheck.min.js"></script>
<script src="__JS__/plugins/layer/laydate/laydate.js"></script>
<script src="__JS__/plugins/switchery/switchery.js"></script><!--IOS开关样式-->
<script src="__JS__/jquery.form.js"></script>
<script src="__JS__/layer/layer.js"></script>
<script src="__JS__/laypage/laypage.js"></script>
<script src="__JS__/laytpl/laytpl.js"></script>
<script src="__JS__/lunhui.js"></script>
<script src="/static/js/angular.js"></script>
<script src="/static/js/admin/student_list_data.js"></script>
<script>
    $(document).ready(function(){$(".i-checks").iCheck({checkboxClass:"icheckbox_square-green",radioClass:"iradio_square-green",})});
</script>
</body>
</html>