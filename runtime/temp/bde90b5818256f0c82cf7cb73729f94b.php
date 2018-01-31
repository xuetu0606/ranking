<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:97:"D:\workspace\company-www\ranking-lunhui\public/../application/admin\view\achievement\ranking.html";i:1517391685;s:81:"D:\workspace\company-www\ranking-lunhui\application\admin\view\public\header.html";i:1516956621;s:81:"D:\workspace\company-www\ranking-lunhui\application\admin\view\public\footer.html";i:1516956154;}*/ ?>
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
<script src="/static/js/function.js"></script>
<script src="/static/js/admin/ranking_data.js"></script>
<body class="gray-bg" ng-app="ranking_admin_ranking_application" ng-controller="ranking_admin_ranking_controller">
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>编辑管理员</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                        <a class="dropdown-toggle" data-toggle="dropdown" href="form_basic.html#">
                            <i class="fa fa-wrench"></i>
                        </a>
                        <a class="close-link">
                            <i class="fa fa-times"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content form-horizontal form-inline">
                    <div class="col-sm-12 container">
                        <div class="row">
                            <div class="hr-line-dashed"></div>
                            <div class="col-md-1"></div>
                            <label>请选择学校</label>
                            <div class="input-group col-md-3">
                                <input type="text" class="form-control" placeholder="搜索学校" ng-model="data.colleges_search"/>
                                <select class="form-control m-b" ng-model="data.colleges_id">
                                    <option value="">==请选择学校==</option>
                                    <option ng-repeat="(k, v) in data.colleges_arr" ng-value="v.id" ng-bind="v.colleges_name"></option>
                                </select>
                            </div>
                            <label>请选择院系所</label>
                            <div class="input-group col-md-3">
                                <input type="text" class="form-control" placeholder="搜索院系所" ng-model="data.faculty_search"/>
                                <select class="form-control m-b" ng-model="data.faculty_id">
                                    <option value="">==请选择院系所==</option>
                                    <option ng-repeat="(k, v) in data.faculty_arr" ng-value="v.id" ng-bind="v.faculty_name"></option>
                                </select>
                            </div>
                            <label>请选择专业</label>
                            <div class="input-group col-md-3">
                                <input type="text" class="form-control" placeholder="搜索专业" ng-model="data.major_search"/>
                                <select class="form-control m-b" ng-model="data.major_id">
                                    <option value="">==请选择专业==</option>
                                    <option ng-repeat="(k, v) in data.major_arr" ng-value="v.id" ng-bind="v.major_name"></option>
                                </select>
                            </div>
                            <div class="hr-line-dashed"></div>
                        </div>
                    </div>
                    <div class="example-wrap">
                        <div class="example">
                            <table class="table table-bordered table-hover">
                                <thead>
                                <tr class="long-tr">
                                    <th>名次</th>
                                    <th>姓名</th>
                                    <th>微信</th>
                                    <th>QQ</th>
                                    <th>学校</th>
                                    <th>院系所</th>
                                    <th>专业</th>
                                    <th>手机号</th>
                                    <th>总分</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tr class="long-td" ng-repeat="(k, v) in data.ranking_arr">
                                    <td ng-bind="'第'+(k+1)+'名'"></td>
                                    <td ng-bind="v.user_name"></td>
                                    <td ng-bind="v.wechat"></td>
                                    <td ng-bind="v.qq"></td>
                                    <td ng-bind="v.colleges_name"></td>
                                    <td ng-bind="v.faculty_name"></td>
                                    <td ng-bind="v.major_name"></td>
                                    <td ng-bind="v.telephone"></td>
                                    <td ng-bind="v.total"></td>
                                    <td>
                                        <div class="btn btn-primary btn-outline btn-xs" ng-click="details(v.user_id, v.fraction_id);">
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
                </div>
            </div>

        </div>
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
<script type="text/javascript" src="/static/admin/webupload/webuploader.min.js"></script>
<script type="text/javascript">
    var $list = $('#fileList');
    //上传图片,初始化WebUploader
    var uploader = WebUploader.create({

        auto: true,// 选完文件后，是否自动上传。
        swf: '/static/admin/webupload/Uploader.swf',// swf文件路径
        server: "<?php echo url('Upload/uploadface'); ?>",// 文件接收服务端。
        duplicate :true,// 重复上传图片，true为可重复false为不可重复
        pick: '#imgPicker',// 选择文件的按钮。可选。

        accept: {
            title: 'Images',
            extensions: 'gif,jpg,jpeg,bmp,png',
            mimeTypes: 'image/jpg,image/jpeg,image/png'
        },

        'onUploadSuccess': function(file, data, response) {
            $("#data_photo").val(data._raw);
            $("#img_data").attr('src', '/uploads/face/' + data._raw).show();
        }
    });

    uploader.on( 'fileQueued', function( file ) {
        $list.html( '<div id="' + file.id + '" class="item">' +
            '<h4 class="info">' + file.name + '</h4>' +
            '<p class="state">正在上传...</p>' +
            '</div>' );
    });

    // 文件上传成功
    uploader.on( 'uploadSuccess', function( file ) {
        $( '#'+file.id ).find('p.state').text('上传成功！');
    });

    // 文件上传失败，显示上传出错。
    uploader.on( 'uploadError', function( file ) {
        $( '#'+file.id ).find('p.state').text('上传出错!');
    });

    //提交
    $(function(){
        $('#userEdit').ajaxForm({
            beforeSubmit: checkForm,
            success: complete,
            dataType: 'json'
        });

        function checkForm(){
            if( '' == $.trim($('#username').val())){
                layer.msg('请输入用户名',{icon:2,time:1500,shade: 0.1}, function(index){
                    layer.close(index);
                });
                return false;
            }

            if( '' == $.trim($('#groupid').val())){
                layer.msg('请选择用户角色',{icon:2,time:1500,shade: 0.1}, function(index){
                    layer.close(index);
                });
                return false;
            }

            if( '' == $.trim($('#real_name').val())){
                layer.msg('请输入真实姓名',{icon:2,time:1500,shade: 0.1}, function(index){
                    layer.close(index);
                });
                return false;
            }
        }


        function complete(data){
            if(data.code==1){
                layer.msg(data.msg, {icon: 6,time:1500,shade: 0.1}, function(index){
                    window.location.href="<?php echo url('user/index'); ?>";
                });
            }else{
                layer.msg(data.msg, {icon: 5,time:1500,shade: 0.1});
                return false;
            }
        }

    });



    //IOS开关样式配置
    var elem = document.querySelector('.js-switch');
    var switchery = new Switchery(elem, {
        color: '#1AB394'
    });
    var config = {
        '.chosen-select': {},
    }
    for (var selector in config) {
        $(selector).chosen(config[selector]);
    }

</script>
</body>
</html>