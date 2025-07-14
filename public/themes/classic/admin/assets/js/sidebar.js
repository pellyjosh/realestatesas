(function ($) {
    "use strict";

    // sidebar sub menu js
    $(".sidebar-link").append(
        '<div class="according-menu"><i class="fa fa-angle-right"></i></div>'
    );
    $(".sidebar-link").on('click', function () {
        $(".sidebar-link").removeClass("active");
        $(".menu-content").slideUp("normal");
        if ($(this).next().is(":hidden") === true) {
            $(this).addClass("active");
            $(this).next().slideDown("normal");
        }
    });
    $(".menu-content").hide();

    // sidebar active
    $(".main-sidebar").find("a").removeClass("active");
    $(".main-sidebar").find("li").removeClass("active");

    var current = window.location.pathname;

    $(".main-sidebar ul>li a").each(function () {
        var link = $(this).attr("href");
        if (link) {
            try {
                var linkPath = new URL(link, window.location.origin).pathname;
                if (current.startsWith(linkPath)) {
                    $(this).addClass("active");
                    $(this).parents("li").addClass("active");
                    $(this).parents(".menu-content").slideDown("normal");
                }
            } catch (e) {
                console.warn("Invalid link:", link);
            }
        }
    });

    // toggle sidebar
    var $nav = $(".page-sidebar");
    var $header = $(".page-main-header");
    var $toggle_nav_top = $("#sidebar-toggle");
    $toggle_nav_top.on("click", function () {
        $nav = $(".page-sidebar");
        $nav.toggleClass("close_icon");
        $header.toggleClass("close_icon");
    });

    var $back_btn = $(".back-btn");
    $back_btn.on("click", function () {
        $nav = $(".page-sidebar");
        $nav.addClass("close_icon");
        $header.addClass("close_icon");
    });

    $(window).resize(function () {
        $toggle_nav_top.on("click", function () {
            $nav = $(".page-sidebar");
            $nav.toggleClass("close_icon");
            $header.toggleClass("close_icon");
        });
    });

    var $body_part_side = $(".body-part");
    $body_part_side.on("click", function () {
        $toggle_nav_top.attr("checked", false);
        $nav.addClass("close_icon");
        $header.addClass("close_icon");
    });

    // responsive sidebar
    var $window = $(window);
    var widthwindow = $window.width();
    if (widthwindow <= 991) {
        $toggle_nav_top.attr("checked", false);
        $nav.addClass("close_icon");
        $header.addClass("close_icon");
    }
    $(window).resize(function () {
        var widthwindaw = $window.width();
        if (widthwindaw <= 991) {
            $toggle_nav_top.attr("checked", false);
            $nav.addClass("close_icon");
            $header.addClass("close_icon");
        } else {
            $toggle_nav_top.attr("checked", true);
            $nav.removeClass("close_icon");
            $header.removeClass("close_icon");
        }
    });
})(jQuery);