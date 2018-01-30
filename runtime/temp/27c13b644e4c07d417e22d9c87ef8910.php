<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:76:"D:\workingspace\ranking\public/../application/index\view\index\register.html";i:1517326879;}*/ ?>
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
            2018年考研初试成绩查询排名
        </div>
        <div>
            <p>请牢记登陆密码，准确填写相关信息，才能够查询到准确的成绩排名</p>
        </div>
        <div>
            <label for="number">
                <img src="/static/img/ren.png" alt="手机">
            </label>
            <input type="text" placeholder="手机号" id="number" ng-model="data.telephone">
        </div>
        <div>
            <label for="verify">
                <img src="/static/img/suo.png" alt="验证码">
            </label>
            <input type="text" placeholder="请输入验证码" id="verify" ng-model="data.code">
            <div>
                <img id="captcha_src" src="/captcha.html" onclick="javascript:this.src='/captcha.html?tm='+Math.random();">
            </div>
        </div>
        <div>
            <label for="password">
                <img src="/static/img/suo.png" alt="密码">
            </label>
            <input type="password" placeholder="密码" id="password" ng-model="data.password">
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