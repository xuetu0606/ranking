<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:90:"D:\workspace\company-www\ranking-lunhui\public/../application/index\view\index\choice.html";i:1517206032;}*/ ?>
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
    <div class="abc">
        <div class="biaoti">
            个人信息
        </div>
        <div class="add">
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
        <div class="biaoti">专业选择</div>
        <div class="add">
            <div>
                <select class="cell-select" ng-options="v.id as v.faculty_name for v in faculty_arr" ng-model="data.faculty_id">
                    <option value="">情选择院校</option>
                </select>
            </div>
            <div>
                <select class="cell-select" name="" ng-options="v.id as v.major_name for v in major_arr" ng-model="data.major_id">
                    <option value="">请选择专业</option>

                </select>
            </div>
        </div>
        <div class="none">
            <div class="biaoti">
                成绩录入
            </div>
            <div class="ade">
                <div class="cell-item" ng-repeat="(k, v) in curriculum_arr">
                    <div class="cell-left" ng-bind="v.curriculum_name"></div>
                    <div class="cell-right">
                        <input type="text" class="cell-input curriculum" id="{{v.id}}" name="{{v.id}}" placeholder="请输入您的成绩" autocomplete="off">
                    </div>
                </div>

                <div class="cell-item">
                    <div class="cell-left">专业科目代码：</div>
                    <div class="cell-right">
                        <input type="text" class="cell-input" placeholder="请输入您的专业科目代码" autocomplete="off" ng-model="data.code">
                    </div>
                </div>
            </div>
        </div>
        <div class="buttom">
            <input type="button" value="提交查询" ng-click="submitAchievement();">
        </div>
    </div>

</body>

</html>