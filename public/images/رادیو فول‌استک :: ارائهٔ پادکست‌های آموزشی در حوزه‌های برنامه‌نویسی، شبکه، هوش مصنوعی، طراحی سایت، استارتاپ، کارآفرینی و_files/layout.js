
$(document).ready(function() {

  $("body").tooltip({
      selector: '[data-toggle="tooltip"]'
  });

  // notifcation scroll bar
  $(".custom-scroll").mCustomScrollbar({
        scrollButtons:{
            scrollButtons:{
                    enable:false
            },
            mouseWheelPixels:150,
            scrollInertia:150,
            mouseWheel:true,
            updateOnContentResize:true
        }
    });

    //random repostabled contents ajax
    $.ajax({
        url: '/api/getter/fetch-repostable-contents',
        type: 'POST',
        success: function(result) {
            var data = JSON.parse(result);
            if (data['status'] === 200) {
                $('#random-repostabled-contents-wrapper').removeClass('hidden');
                var template = '';
                var i = 0;
                for (i = 0; i < Object.keys(data['content']).length; i++) {

                    template +=
                    '<li>' +
                      '<img class="img-responsive" src="' + data['content'][i]['articleImg'] + '" width="36" height="36"/>' +
                      '<a class="logger" data-logger-type="random-contents-left-sidebar" target="_blank" href="' + data['content'][i]['url'] + '"><h3>' + data['content'][i]['articleName'] + '</h3> <span style="display:block; padding-right:46px;"> ' + data['content'][i]['date'] + '</span>' +
                      '<h4>' + data['content'][i]['author'] + '</h4></a>' +
                      '</li>';
                }
                $('#random-repostabled-contents').html(template);
            }
        }
    });

    //logger ajax
    $('body').on('click', 'a.logger', function () {
        var url = window.location.href;
        var moduleName = '';
        if (url.split('/')[3] == '') {
            moduleName = 'homepage';
        } else {
            moduleName = url.split('/')[3];
        }
        var type = $(this).attr('data-logger-type');
        $.ajax({
            url: '/api/setter/log-content-hits',
            type: 'POST',
            data: {
                type: type,
                module_name: moduleName,
            }
        });
    });
    // ads statistics
    $('body').on('click', 'a.ads', function () {
        var id = $(this).attr('data-id');
        $.ajax({
            url: '/api/setter/log-ad-hits',
            type: 'POST',
            data: {
                ad_id: id,
            }
        });
    });
});

// Hide Header on on scroll down
var didScroll;
var lastScrollTop = 0;
var delta = 5;
var navbarHeight = $('.second_nav').outerHeight();

$(window).scroll(function(event) {
    didScroll = true;
});

setInterval(function() {
    if (didScroll) {
	hasScrolled();
	didScroll = false;
    }
}, 250);

function hasScrolled() {
    var st = $(this).scrollTop();

    // Make sure they scroll more than delta
    if (Math.abs(lastScrollTop - st) <= delta)
	return;

    // If they scrolled down and are past the navbar, add class .nav-up.
    // This is necessary so you never see what is "behind" the navbar.
    if (st > lastScrollTop && st > navbarHeight) {
	// Scroll Down
	$('.second_nav').addClass('second_nav_hide');
    } else {
	// Scroll Up
	if (st + $(window).height() < $(document).height()) {
	    $('.second_nav').removeClass('second_nav_hide');
	}
    }

    lastScrollTop = st;
}
