// jQuery to collapse the navbar on scroll //
$(window).scroll(function() {
    if ($(".navbar").offset().top > 50) {
            $(".navbar-fixed-top").addClass("ease-navbar");
        } else {
            $(".navbar-fixed-top").removeClass("ease-navbar");
        }
});

// Floating Facebook Widget by www.TheBlogWidgets.com START
/*<![CDATA[*/ 
jQuery(document).ready(function() {
    jQuery(".theblogwidgets").hover(function() {
        jQuery(this).stop().animate({right: "0"}, "medium");}, function() {
            jQuery(this).stop().animate({right: "-250"}, "medium");}, 500);}); 
/*]]>*/
