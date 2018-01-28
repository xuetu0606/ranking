<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:98:"D:\workspace\company-www\ranking-lunhui\public/../application/index\view\index\error_is_input.html";i:1516934964;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>跳转</title>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="/static/js/jquery-3.2.1.min.js"></script>
    <script src="/static/js/layer/layer.js"></script>
    <script>
        layer.msg(
            "您已录入过成绩,即将为您跳转到排名页面",
            {
                anim : 2,
                time : 1200
            },
            function (){
                window.location.href = "/index/index/ranking.html"
            }
        );
    </script>
</head>
<body>
</body>
</html>