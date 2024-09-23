$(document).ready(function () {
    $('.checkout__method-cod, .checkout__method-online').on('click', function () {
        $('.checkout__method-cod').css('border', '2px solid rgb(230, 221, 221)');
        $('.checkout__method-online').css('border', '2px solid rgb(230, 221, 221)');
        $(this).css('border', '2px solid red');
    });

    $('.delivery-modal__store-item').on('click', function () {
        $('.delivery-modal__store-item').removeClass('active');
        $(this).addClass('active');
    });
});
