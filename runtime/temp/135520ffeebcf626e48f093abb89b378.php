<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:89:"D:\workspace\company-www\ranking-lunhui\public/../application/index\view\index\login.html";i:1517303650;}*/ ?>
<!DOCTYPE html>
<html lang="en" ng-app="ranking_index_login_application">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=0" name="viewport">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>「2018考研初试成绩排名系统」</title>
    <link rel="stylesheet" href="/static/css/sign.css">
    <link rel="stylesheet" href="//at.alicdn.com/t/font_554500_l5e4l7k9mdpiizfr.css">
    <script src="/static/js/rem.js"></script>
    <script src="/static/js/jquery-3.2.1.min.js"></script>
    <script src="/static/js/layer/layer.js"></script>
    <script src="/static/js/angular.js"></script>
    <script src="/static/js/function.js"></script>
    <script src="/static/js/index/login-data.js"></script>
</head>
<body ng-controller="ranking_index_login_controller">
    <div class="center">
        <div>
            <img src="/static/img/header.jpg" alt="">
        </div>
        <div>
            <p>《由于复试通知较晚，为了更加准确的了解到目前自己所处的位置，为自己后期规划做好准备，同时也是保证复试的公平性，圆大家名校梦。名次实时更新，大家转发至相关考研群》</p>
        </div>
        <div>
            <label for="number">
                <img src="/static/img/ren.png" alt="">
            </label>
            <input type="text" placeholder="手机号" id="number" ng-model="data.telephone">
        </div>
        <div>
            <label for="password">
                <img src="/static/img/suo.png" alt="">
            </label>
            <input type="password" placeholder="密码" id="password" ng-model="data.password">
        </div>

        <div>
            <input type="submit" value="登录" ng-click="login();">
        </div>
        <div>
            <a href="/index/index/register.html">点击注册</a>
            <a href="/index/index/forget.html">忘记密码?</a>
        </div>
    </div>
</body>

</html>