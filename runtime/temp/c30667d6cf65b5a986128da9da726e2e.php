<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:90:"D:\workspace\company-www\ranking-lunhui\public/../application/index\view\index\choice.html";i:1517364806;}*/ ?>
<!DOCTYPE html>
<html lang="en" ng-app="ranking_index_choice_application">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>学院/年级选择</title>
    <script src="/static/js/rem.js"></script>
    <link rel="stylesheet" href="/static/css/achoice.css">
    <script src="/static/js/jquery-3.2.1.min.js"></script>
    <script src="/static/js/layer/layer.js"></script>
    <script src="/static/js/angular.js"></script>
    <script src="/static/js/function.js"></script>
    <script src="/static/js/index/choice-data.js"></script>
</head>

<body ng-controller="ranking_index_choice_controller">
    <div class="header">
        <div>
            <p>成绩录入</p>
        </div>
        <div onclick="window.location.href='/index/index/index'">
            <img src="/static/img/xiangzuo.png" alt="向左">
        </div>
    </div>
    <div class="message">
        <div class="add">
            <div class="cell-item">
                <div class="cell-left">学校：</div>
                <div class="mySchool" ng-bind="colleges_name"></div>
                <input type="hidden" id="colleges_id" value="<?php echo \think\Request::instance()->get('colleges_id'); ?>"/>
            </div>
            <div class="cell-item">
                <div class="cell-left">姓名：</div>
                <div class="cell-right">
                    <input type="text" class="cell-input" placeholder="请输入您的姓名" autocomplete="off" ng-model="data.user_name">
                </div>
            </div>

            <div class="cell-item">
                <div class="cell-left">手机：</div>
                <div class="cell-right">
                    <input type="text" class="cell-input" placeholder="请输入您的手机号" autocomplete="off" ng-model="data.telephone">
                </div>
            </div>
        </div>
        <div class="biaoti">专业选择</div>
        <div class="add">
            <div>
                <select class="cell-select" ng-options="v.id as v.faculty_name for v in faculty_arr" ng-model="data.faculty_id">
                    <option value="">请选择院校</option>
                </select>
            </div>
            <div>
                <select class="cell-select" name="" ng-options="v.id as v.major_name for v in major_arr" ng-model="data.major_id">
                    <option value="">请选择专业</option>
                </select>
            </div>

        </div>
        <div class="addition">
            <a href="/index/index/input/colleges_id/<?php echo \think\Request::instance()->get('colleges_id'); ?>">如果没有您的专业，点击添加</a>
        </div>
        <div class="none">
            <div class="biaoti">
                成绩录入
            </div>
            <div class="for">
                <div class="cell-item">
                    <div class="cell-left">政治</div>
                    <div class="cell-right">
                        <input type="text" class="cell-input curriculum" id="1" name="1" placeholder="请输入您的成绩" autocomplete="off">
                    </div>
                </div>
                <div class="cell-item">
                    <div class="cell-left">外语</div>
                    <div class="cell-right">
                        <input type="text" class="cell-input curriculum" id="2" name="2" placeholder="请输入您的成绩" autocomplete="off">
                    </div>
                </div>
                <div class="cell-item">
                    <div class="cell-left">业务课一</div>
                    <div class="cell-right">
                        <input type="text" class="cell-input curriculum" id="3" name="3" placeholder="请输入您的成绩" autocomplete="off">
                    </div>
                </div>
                <div class="cell-item">
                    <div class="cell-left">业务课二</div>
                    <div class="cell-right">
                        <input type="text" class="cell-input curriculum" id="4" name="5" placeholder="请输入您的成绩" autocomplete="off">
                    </div>
                </div>
            </div>
        </div>
        <div class="add">
            <div class="cell-item">
                <div class="cell-left">QQ号：</div>
                <div class="cell-right">
                    <input type="text" class="cell-input" placeholder="请输入您的QQ号" autocomplete="off" ng-model="data.qq">
                </div>
            </div>
            <div class="cell-item">
                <div class="cell-left">微信号：</div>
                <div class="cell-right">
                    <input type="text" class="cell-input" placeholder="请输入您的微信号" autocomplete="off" ng-model="data.wechat">
                </div>
            </div>
        </div>
        <div class="buttom">
            <input type="button" value="提交查询" ng-click="submitAchievement();">
        </div>
    </div>

</body>

</html>