// jQuery to collapse the navbar on scroll //
$(window).scroll(function() {
    if ($(".navbar").offset().top > 150) {
      $(".navbar-fixed-top").hide();
    }
    else {
      $(".navbar-fixed-top").show();
    }
    if ($(".navbar").offset().top > 500) {
        $(".navbar-fixed-top").show();
        $(".navbar-fixed-top").addClass("top-nav-collapse");
        $(".navbar-fixed-top li").addClass("border-skew");
    } else {
        $(".navbar-fixed-top").removeClass("top-nav-collapse");
        $(".navbar-fixed-top li").removeClass("border-skew");
    }
});

// Floating Facebook Widget by www.TheBlogWidgets.com START
/*<![CDATA[*/ 
jQuery(document).ready(function() {
    jQuery(".theblogwidgets").hover(function() {
        jQuery(this).stop().animate({right: "0"}, "medium");}, function() {
            jQuery(this).stop().animate({right: "-250"}, "medium");}, 500);}); 
/*]]>*/