$('.click').click(function () {
    $('.none').show();
    $('input').focus();
    console.log($('li').text())
});
$('.li').click(function () {
    console.log('1');
    // var a = $(this).html();
    // var b = this.id;
    // $('.click').text(a);
    // $('.none').hide();
    // var a = $('.input').val();
    // a = b;
    // console.log(a);
});