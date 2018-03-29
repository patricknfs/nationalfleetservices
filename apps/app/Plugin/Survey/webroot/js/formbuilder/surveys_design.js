$(function(){
    $('input[name="data[Survey][text_or_logo]"],input[name="data[Survey][thankyou]"]').bind('click change', function(){
        $obj = $(this);
        $obj.attr('checked', true);
        $obj.parent().parent().find('span').hide();
        $obj.parent().next('span').show();
    });

    $("#controls-list a").bind('click', {}, function(){
        $obj = $(this);
        $('#frmb-0-control-box').val($obj.attr('ref'));
        $('#frmb-0-control-box').trigger('change');
    });

    $(function() {
        $("#my-form-builder ul").sortable({ opacity: 0.6, cursor: 'move'});
    });


    //first load section break
    $('#frmb-0-control-box').val('section_break');
    $('#frmb-0-control-box').trigger('change');

    // fix sub nav on scroll
    var $win = $(window)
    , $nav = $('.subnav')
    , navTop = $('.subnav').length && $('.subnav').offset().top - 40
    , isFixed = 0

    processScroll()

    // hack sad times - holdover until rewrite for 2.1
    $nav.on('click', function () {
        if (!isFixed) setTimeout(function () {  $win.scrollTop($win.scrollTop() - 47) }, 10)
    })

    $win.on('scroll', processScroll)

    function processScroll() {
        var i, scrollTop = $win.scrollTop()
        if (scrollTop >= navTop && !isFixed) {
            isFixed = 1
            $nav.addClass('subnav-fixed')
        } else if (scrollTop <= navTop && isFixed) {
            isFixed = 0
            $nav.removeClass('subnav-fixed')
        }
    }
});