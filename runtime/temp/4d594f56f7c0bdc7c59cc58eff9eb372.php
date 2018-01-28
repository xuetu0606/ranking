<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:92:"D:\workspace\company-www\ranking-lunhui\public/../application/index\view\index\register.html";i:1516988522;}*/ ?>
<!DOCTYPE html>
<html lang="en" ng-app="ranking_index_register_application">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=0" name="viewport">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>注册-「2018考研初试成绩排名系统」</title>
    <link rel="stylesheet" href="/static/css/register.css">
    <script src="/static/js/rem.js"></script>
    <script src="/static/js/jquery-3.2.1.min.js"></script>
    <script src="/static/js/layer/layer.js"></script>
    <script src="/static/js/angular.js"></script>
    <script src="/static/js/function.js"></script>
    <script src="/static/js/index/register-data.js"></script>
</head>

<body ng-controller="ranking_index_register_controller">



    <div class="center">
        <div>
            <img src="/static/img/header.jpg" alt="LOGO">
        </div>
        <div>
            <label for="number">
                <img src="/static/img/ren.png" alt="手机">
            </label>
            <input type="text" placeholder="手机号" id="number" ng-model="data.telephone">
        </div>
        <div>
            <label for="mima">
                <img src="/static/img/suo.png" alt="验证码">
            </label>
            <input type="text" placeholder="请输入验证码" id="mima" ng-model="data.code">
            <div>
                <img id="captcha_src" src="/captcha.html" onclick="javascript:this.src='/captcha.html?tm='+Math.random();">
            </div>
        </div>
        <div>
            <label for="mima">
                <img src="/static/img/suo.png" alt="密码">
            </label>
            <input type="text" placeholder="密码" id="mima" ng-model="data.password">
        </div>
        <div>
            <input type="submit" value="注册" ng-click="register();">
        </div>
        <div>
            <a href="/index/index/login.html">点击登录</a>
        </div>
    </div>
</body>

</html>