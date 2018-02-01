$(function(){
    $('.click').click(function () {
        $('.none').show();
        $('.input').focus();
    });
    $('.li').click(function () {
        var school = $(this).text();
        var b = this.id;
        var a = $('.input').val();
        $('.click').text(school);
        $('.none').hide();
        a = b;
        console.log(a);
    });

    $('body').click(function (e) {
        var target = $(e.target);
        if (target.is('#click')) {
            $('.none').show();
        } else if (target.is('#input')) {
            $('.none').show();
        } else if (target.is('.none')) {
            $('.none').show();
        } else {
            $('.none').hide();
        }
    });
});