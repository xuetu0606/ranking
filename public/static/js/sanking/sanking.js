$(".center").scroll(function () {
    var a = $('.N').offset().top;
    if (a < 525) {
        $('.color').hide();
    }
    if (a > 525) {
        $('.color').show();
    }
});
