$(document).ready(function() {

    if (liff.isInClient()) {
        window.addEventListener('orientationchange', function () {

            if ($(window).height() < $(window).width()) {
                $("#app").css("display", "none");
                $("#vertical").css('display', 'block');
                $("#vertical").css('background-image', 'url(https://chapayom.com/wp-content/uploads/2017/09/userverti.gif)');
                $("#vertical").css('background-position', 'center center');
                $("#vertical").css('background-repeat', 'no-repeat');
                $("#vertical").css('background-attachment', 'fixed');
                $("#vertical").css('background-size', '60vh 60vh');
            } else {
                $("#app").css("display", "block");
                $("#vertical").css('display', 'none');
                $("#vertical").css('background-image', '');
                $("#vertical").css('background-position', '');
                $("#vertical").css('background-repeat', '');
                $("#vertical").css('background-attachment', '');
                $("#vertical").css('background-size', '');
            }
        });
    }
});
