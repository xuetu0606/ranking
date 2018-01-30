<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:89:"D:\workspace\company-www\ranking-lunhui\public/../application/index\view\index\input.html";i:1517294938;}*/ ?>
<!DOCTYPE html>
<html lang="en" ng-app="ranking_index_input_application">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>学院/年级选择</title>
    <link rel="stylesheet" href="/static/css/input.css">
    <script src="/static/js/rem.js"></script>
    <script src="/static/js/choice/choice.js"></script>
    <script src="/static/js/jquery-3.2.1.min.js"></script>
    <script src="/static/js/search/search.js"></script>
    <script src="/static/js/layer/layer.js"></script>
    <script src="/static/js/angular.js"></script>
    <script src="/static/js/function.js"></script>
    <script src="/static/js/index/input-data.js"></script>
</head>

<body ng-controller="ranking_index_input_controller">
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
                <div class="cell-left">学校：</div>
                <div>清华大学</div>
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

        <div class="biaoti">
            专业选择
        </div>
        <div class="school">
            <div>
                <input type="text" placeholder="您所在的院系所" ng-model="data.faculty">
            </div>
            <div>
                <input type="text" placeholder="专业" ng-model="data.major">
            </div>

        </div>
        <div class="none">
            <div class="biaoti">
                成绩录入
            </div>
            <div class="ade">
                <div>
                    <div class="adf-left">
                        <input type="text" class="adf-input" placeholder="课目" autocomplete="off" ng-model="data.curriculum_arr.curriculum_1.curriculum_name">
                    </div>
                    <div class="adf-right">
                        <input type="text" class="adf-input" placeholder="请输入您的成绩" autocomplete="off" ng-model="data.curriculum_arr.curriculum_1.fraction">
                    </div>
                </div>
                <div>
                    <div class="adf-left">
                        <input type="text" class="adf-input" placeholder="课目" autocomplete="off" ng-model="data.curriculum_arr.curriculum_2.curriculum_name">
                    </div>
                    <div class="adf-right">
                        <input type="text" class="adf-input" placeholder="请输入您的成绩" autocomplete="off" ng-model="data.curriculum_arr.curriculum_2.fraction">
                    </div>
                </div>
                <div>
                    <div class="adf-left">
                        <input type="text" class="adf-input" placeholder="课目" autocomplete="off" ng-model="data.curriculum_arr.curriculum_3.curriculum_name">
                    </div>
                    <div class="adf-right">
                        <input type="text" class="adf-input" placeholder="请输入您的成绩" autocomplete="off" ng-model="data.curriculum_arr.curriculum_3.fraction">
                    </div>
                </div>
                <div>
                    <div class="adf-left">
                        <input type="text" class="adf-input" placeholder="课目" autocomplete="off" ng-model="data.curriculum_arr.curriculum_4.curriculum_name">
                    </div>
                    <div class="adf-right">
                        <input type="text" class="adf-input" placeholder="请输入您的成绩" autocomplete="off" ng-model="data.curriculum_arr.curriculum_4.fraction">
                    </div>
                </div>
                <div>
                    <div class="adf-left">
                        <input type="text" class="adf-input" placeholder="课目" autocomplete="off" ng-model="data.curriculum_arr.curriculum_5.curriculum_name">
                    </div>
                    <div class="adf-right">
                        <input type="text" class="adf-input" placeholder="请输入您的成绩" autocomplete="off" ng-model="data.curriculum_arr.curriculum_5.fraction">
                    </div>
                </div>
                <div>
                    <div class="adf-left">
                        <input type="text" class="adf-input" placeholder="课目" autocomplete="off" ng-model="data.curriculum_arr.curriculum_6.curriculum_name">
                    </div>
                    <div class="adf-right">
                        <input type="text" class="adf-input" placeholder="请输入您的成绩" autocomplete="off" ng-model="data.curriculum_arr.curriculum_6.fraction">
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