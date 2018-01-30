<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:89:"D:\workspace\company-www\ranking-lunhui\public/../application/index\view\index\index.html";i:1517304360;}*/ ?>
<!DOCTYPE html>
<html lang="en" ng-app="ranking_index_index_application">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=0" name="viewport">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>搜索</title>
    <link rel="stylesheet" href="/static/css/search.css">
    <link rel="stylesheet" href="//at.alicdn.com/t/font_554500_4lgof110xpzoxbt9.css">
    <script src="/static/js/rem.js"></script>
    <script src="/static/js/jquery-3.2.1.min.js"></script>
    <script src="/static/js/search/search.js"></script>
    <script src="/static/js/layer/layer.js"></script>
    <script src="/static/js/angular.js"></script>
    <script src="/static/js/function.js"></script>
    <script src="/static/js/index/index-data.js"></script>
</head>

<body ng-controller="ranking_index_index_controller" ng-cloak class="ng-cloak">
    <div class="isearch">
        <div class="swrap">
            <div class="ssearch">
                <form action="/Index/wlist" method="post">
                    <i class="iconfont icon-sousuo"></i>
                    <input type="search" class="input_text" id="input_text" name="keyword" placeholder="搜索高校" ng-model="search">
                </form>
            </div>
        </div>
    </div>
    <div class="a">
        <div class="center" ng-repeat="v in collegesArray">
            <a href="/index/index/choice/colleges_id/{{v.id}}.html">
                <p ng-bind="v.colleges_name">
                </p>
                <i class="iconfont icon-weibiaoti34"></i>

            </a>
        </div>
        <div class="plus" ng-show="add_colleges">
            <div>
                <input type="text" placeholder="如果没有请输入" ng-model="create_colleges.colleges_name">
            </div>
            <div>
                <input type="button" value="提交" ng-click="create();" />
            </div>
        </div>
        <div class="jiazai" ng-bind="load_str">
            正在拼命加载中~
        </div>
    </div>
    <div class="kong">
    </div>
    <div class="footer">
        <div>
            <div>
                <a href="/index/index/index.html">
                    <div>
                        <span class="iconfont icon-xuexiao"></span>
                    </div>
                    <div>院校</div>
                </a>
            </div>
            <div>
                <a href="/index/index/ranking.html">
                    <div>
                        <span class="iconfont icon-icon--"></span>
                    </div>
                    <div>排名</div>
                </a>
            </div>
            <div>
                <a href="/index/index/logout.html">
                    <div>
                        <span class="iconfont icon-icon-"></span>
                    </div>
                    <div>退出</div>
                </a>
            </div>
        </div>
    </div>
    <script>
        $(function () {
            $('.isearch .ssearch').click(function () {
                $(this).addClass('sactive');
                $(this).find('input').attr('placeholder', '高校名称').focus();
            });
        });
    </script>
</body>

</html>