<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:91:"D:\workspace\company-www\ranking-lunhui\public/../application/index\view\index\ranking.html";i:1517301591;}*/ ?>
<!DOCTYPE html>
<html lang="en" ng-app="ranking_index_ranking_application">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=0" name="viewport">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>我的排名</title>
    <script src="/static/js/rem.js"></script>
    <link rel="stylesheet" href="/static/css/ranking.css">
    <script src="/static/js/jquery-3.2.1.min.js"></script>
    <script src="/static/js/layer/layer.js"></script>
    <script src="/static/js/angular.js"></script>
    <script src="/static/js/function.js"></script>
    <script src="/static/js/index/ranking-data.js"></script>
</head>

<body ng-controller="ranking_index_ranking_controller">
    <div class="header">
        <div>
            <p>我的排名</p>
        </div>
        <div onclick="window.location.href='/index/index/index'">
            <img src="/static/img/xiangzuo.png" alt="向左">
        </div>
    </div>
    <div class="kong">
    </div>
    <div class="center" id="paihang">
        <div class="phtop">
            <div class="wode">
                <div class="imgright">
                    <span ng-bind="user_ranking_info_arr.user_name"></span>
                    <p ng-bind="'第'+ranking +'名'"></p>
                </div>
                <em ng-bind="'总分：'+user_ranking_info_arr.total"></em>
            </div>
        </div>
        <div class="phbot">
            <div class="phlist" ng-repeat="(k, v) in rankingArray">
                <span class="name " ng-bind="v.user_name"></span>
                <span class="num" ng-bind="'第'+ (k+1) +'名'"></span>
                <span class="score" ng-bind="'总分 : ' + v.total"></span>
            </div>

            <p ng-bind="last_str">拼命加载中~</p>
        </div>
    </div>
    <script>
       
    </script>
</body>

</html>