var load_more_button_count = 0;
$(window).on("load", function() {
    setTimeout(function() {
        $(".overlay").css({
            display: "none"
        })
    }, 100)
}), $(function() {
    (new WOW).init(), $(".box_content").slice(0, 12).show(), $("#loadMore").on("click", function(e) {
        e.preventDefault(), $(".box_content:hidden").slice(0, 12).slideDown(), 0 == $(".box_content:hidden").length && ($("#loadLess").fadeIn("slow"), $("#loadMore").hide()), $("html,body").animate({
            scrollTop: $(this).offset().top
        }, 1500)
    }), $("#loadLess").on("click", function(e) {
        e.preventDefault(), $(".box_content:not(:lt(12))").fadeOut(), $("#loadMore").fadeIn("slow"), $("#loadLess").hide(), desiredHeight = $(window).height(), $("html,body").animate({
            scrollTop: $(this).offset().top + desiredHeight
        }, 1500)
    })
}), $(document).on("click", "#btnClearall", function() {
    location.reload()
});
var emailExpr = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/,
    MobileExpr = /^(?:(?:\+|0{0,2})91(\s*[\-]\s*)?|[0]?)?[6789]\d{9}$/,
    nameRegex = /^([a-zA-Z]+\s)*[a-zA-Z]+$/,
    emailRegex1 = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/,
    emailRegex2 = /^\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/,
    emailRegex = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/,
    mobileRegex = /^([0|\+[0-9]{1,5})?([6-9][0-9]{9})$/,
    numberRegex = /^[0-9]+$/,
    urlRegex = /^(?:(?:(?:https?|http):)?\/\/)(?:\S+(?::\S*)?@)?(?:(?!(?:10|127)(?:\.\d{1,3}){3})(?!(?:169\.254|192\.168)(?:\.\d{1,3}){2})(?!172\.(?:1[6-9]|2\d|3[0-1])(?:\.\d{1,3}){2})(?:[1-9]\d?|1\d\d|2[01]\d|22[0-3])(?:\.(?:1?\d{1,2}|2[0-4]\d|25[0-5])){2}(?:\.(?:[1-9]\d?|1\d\d|2[0-4]\d|25[0-4]))|(?:(?:[a-z\u00a1-\uffff0-9]-*)*[a-z\u00a1-\uffff0-9]+)(?:\.(?:[a-z\u00a1-\uffff0-9]-*)*[a-z\u00a1-\uffff0-9]+)*(?:\.(?:[a-z\u00a1-\uffff]{2,})))(?::\d{2,5})?(?:[\/?#]\S*)?$/i,
    domainRegex = /^((?:(?:(?:\w[\.\-\+]?)*)\w)+)((?:(?:(?:\w[\.\-\+]?){0,62})\w)+)\.(\w{2,6})$/,
    is_alphaNumeric = /^[a-zA-Z][a-zA-Z0-9\s]+$/,
    is_allow_hypen = /^[a-zA-Z][a-zA-Z0-9-\s]+$/;

function parseJson(e) {
    return $.parseJSON(JSON.stringify(e))
}

function messageDisplay(e, a, t) {
    "" == (t = $.trim(t)) && (t = "error"), "" == $.trim(a) && (a = 1500);
    var n, o = $("#feedbackSection");
    n = "success" == t ? "#4caf50" : "#dc3545", o.attr("style", "background-color:" + n), $("div#feedbackSection span").html(e), o.animate({
        height: 70
    }, 300).show(), -1 != a && setTimeout(function() {
        o.animate({
            height: 0
        }, 300, function() {
            o.hide()
        })
    }, a)
}
window.localStorage, $(document).ready(function() {
    $(".easyzoom").easyZoom().data("easyZoom"), (new WOW).init(), $(".navbar-toggler").on("click", function() {
        $(".my-account, .my-selection, .searchbar-box").toggleClass("hidden"), $(".nav-menu").toggleClass("full-nav")
    }), $(".searchbar-icon").on("click", function() {
        $(".navbar-toggler").toggleClass("d-none"), $(".searchbar").hasClass("d-none") ? $(".searchbar").removeClass("d-none") : $(".searchbar").addClass("d-none"), $(".searchbar").hasClass("d-none") ? $(".searchbar-icon").html('<img src="' + BASE_URL + '/public/assets//images/search.svg">') : $(".searchbar-icon").text("X")
    }), $(".navbar-mainmenu").hover(function() {
        $(this), $(this).addClass("navbar-mainmenu--active"), $(".navbar-submenu").css({
            visibility: "visible",
            opacity: "1",
            transform: "translate(0,0)"
        })
    }, function() {
        $(this), $(this).toggleClass("navbar-mainmenu--active"), $(".navbar-submenu").css({
            visibility: "hidden",
            opacity: "0",
            transform: "translate(0,30px)"
        })
    }), $(".navbar-submenu").hover(function() {
        $(".navbar-submenu").css({
            visibility: "visible",
            opacity: "1",
            transform: "translate(0,0)"
        }), $(this).prev("a").addClass("navbar-mainmenu--active")
    }, function() {
        $(".navbar-submenu").css({
            visibility: "hidden",
            opacity: "0",
            transform: "translate(0,30px)"
        }), $(this).prev("a").removeClass("navbar-mainmenu--active")
    }), $(window).on("scroll", function() {
        $(this).scrollTop() > 50 ? ($("body").addClass("navbar-fixed"), $(".custom-nav").addClass("custom-nav-fix"), $(".account-text").css("display", "none"), $(".account img").css("width", "20px"), $(".flex-fill").css("padding-top", "70px"), $(".navbar-fluid").css({
            position: "fixed",
            height: "90px",
            background: "white",
            "z-index": "2",
            "box-shadow": " 0 .125rem .25rem rgba(0,0,0,.075)"
        }), $(".searchbar-icon").on("click", function() {
            $(".searchbar").hasClass("d-none") ? $(".searchbar-icon").html('<img src="' + BASE_URL + '/public/assets//images/search.svg">') : $(".searchbar-icon").text("X")
        })) : ($("body").removeClass("navbar-fixed"), $(".custom-nav").removeClass("custom-nav-fix"), $(".account-text").css("display", ""), $(".account img").css("width", ""), $(".flex-fill").css("padding-top", ""), $(".logo-image").css("cssText", ""), $(".navbar-fluid").css({
            position: "",
            height: "",
            background: "white",
            "z-index": "",
            "box-shadow": ""
        }))
    })
});
var validateMethods = {
    isValidEmail: function(e) {
        return emailRegex.test(e)
    },
    isValidEmail1: function(e) {
        return emailRegex1.test(e)
    },
    isValidMobile: function(e) {
        return mobileRegex.test(e)
    },
    isValidName: function(e) {
        return nameRegex.test(e)
    },
    isNumber: function(e) {
        return numberRegex.test(e)
    },
    isValidPhoneNumberLength: function(e) {
        return e.length >= 6 && e.length <= 15
    },
    isValidUrl: function(e) {
        return urlRegex.test(e)
    },
    isValidDomain: function(e) {
        return domainRegex.test(e)
    },
    isPublicDomain: function(e) {
        return e = e.toLowerCase(), -1 != PUBLIC_DOMAINS.indexOf(e)
    },
    is_alphaNumeric: function(e) {
        return is_alphaNumeric.test(e)
    },
    is_hypen: function(e) {
        return is_allow_hypen.test(e)
    }
};

function changeDivTextToEdit() {
    $(".title-wrapper").text(function() {
        return $(this).text().replace("add", "edit")
    })
}

function changeDivTextToAdd() {
    $(".title-wrapper").text(function() {
        return $(this).text().replace("edit", "add")
    })
}

function cleanString(e) {
    return e.replace(/<\/?[^>]+(>|$)/g, "")
}

function stringSlug(e) {
    return (e = (e = e.replace(/[\/#+)(&^!@$~%,?`*:;'".\\=\/|]/g, "-")).replace(/\s+/g, "-")).replace(/-+$/g, "")
}

function getRandomColor() {
    for (var e = "#", a = 0; a < 6; a++) e += "0123456789ABCDEF" [Math.floor(16 * Math.random())];
    return e
}
$(document).ready(function() {
    (new WOW).init(), $("#banner-slider").owlCarousel({
        loop: !0,
        autoPlay: !0,
        items: 1,
        smartSpeed: 500,
        pagination: !1,
        dots: !1
    }), $(".first-slider").owlCarousel({
        loop: !0,
        pagination: !1,
        dots: !1,
        responsive: {
            0: {
                items: 2,
                nav: !0
            },
            576: {
                items: 4,
                margin: 10,
                nav: !0
            },
            768: {
                items: 5,
                margin: 10,
                nav: !0
            }
        }
    }), $(".grid-none").parent().addClass("d-none")
}), $(document).on("submit", ".signup_form", function() {
    var e = $(this).attr("action"),
        a = new FormData($(this)[0]);
    return $(this).attr("data-pop"), $(".form_btn").prop("disabled", !0), $.ajax({
        type: "POST",
        url: e,
        data: a,
        contentType: !1,
        processData: !1,
        success: function(e) {
            $(".form_btn").removeAttr("disabled");
            var a = $.parseJSON(e);
            "true" == a.status ? ($(".signup_form").trigger("reset"), $("#registerModal").modal("hide"), $("#feedbackSection").css({
                background: "green",
                height: "80px",
                display: "block"
            }), $("#feedbackSection").html("<span>" + a.message + "</span>"), $("#otp_user_id").val(a.otp), $("#otp_popup").modal("show")) : ("object" == typeof a.message ? (msg = "", $.each(a.message, function(e, a) {
                msg += " " + a
            }), $("#feedbackSection").css({
                background: "red",
                height: "80px",
                display: "block"
            })) : $("#feedbackSection").css({
                background: "red",
                height: "80px",
                display: "block"
            }), $("#feedbackSection").html("<span>" + a.message + "</span>")), setTimeout(function() {
                $("#feedbackSection").css({
                    display: "none"
                })
            }, 3e3)
        }
    }), !1
}), $(document).on("click", "#resend_otp", function() {
    var e = $("#otp_user_id").val();
    $.get(BASE_URL + "/resend_otp/" + e, function(e) {
        $("#feedbackSection").css({
            background: "green",
            height: "80px",
            display: "block"
        }), $("#feedbackSection").html("<span>OTP send on your register mobile number</span>"), setTimeout(function() {
            $("#feedbackSection").css({
                display: "none"
            })
        }, 3e3)
    })
}), $(document).on("submit", ".database_operation_form", function() {
	console.log($("#uniqe_test").val());
	if($("#uniqe_test").val() == 1){
		console.log('in');
		$('form#sale_force_form').submit();
	}
    var e = $(this).attr("action"),
        a = new FormData($(this)[0]),
        t = $(this).attr("data-pop");
    return $(".form_btn").prop("disabled", !0), $.ajax({
        type: "POST",
        url: e,
        data: a,
        contentType: !1,
        processData: !1,
        success: function(e) {
            $(".form_btn").removeAttr("disabled");
            var a = $.parseJSON(e);
            if ("true" == a.status) $("#feedbackSection").css({
                background: "green",
                height: "80px",
                display: "block"
            }), $("#feedbackSection").html("<span>" + a.message + "</span>"), $(t).modal("hide"), 0 == a.reload ? ($(".database_operation_form").trigger("reset"), $(".dataTable").DataTable().ajax.reload()) : 5 == a.reload || ($("a").hasClass("collection_single_page") ? window.location.reload() : window.location.href = a.reload);
            else {
                if ("otp" == a.message) return $("#loginModal").modal("hide"), $("#otp_user_id").val(a.user_id), $("#otp_popup").modal("show"), !1;
                "object" == typeof a.message ? (msg = "", $.each(a.message, function(e, a) {
                    msg += " " + a
                }), $("#feedbackSection").css({
                    background: "red",
                    height: "80px",
                    display: "block"
                }), $("#feedbackSection").html("<span>" + msg + "</span>")) : ($("#feedbackSection").css({
                    background: "red",
                    height: "80px",
                    display: "block"
                }), $("#feedbackSection").html("<span>" + a.message + "</span>"))
            }
        },
        error: function(e) {
            console.log(e)
        }
    }), setTimeout(function() {
        $("#feedbackSection").css({
            display: "none"
        })
    }, 3e3), !1

}), $(document).on("click", ".add_to_fevrate", function() {
    $(this).addClass("remove_to_fevrate"), $(this).removeClass("add_to_fevrate");
    var e = $(this).attr("data-id"),
        a = $(this).attr("data-user");
    a ? $.get(BASE_URL + "/add_to_fevrate/" + e + "/" + a, function(a) {
        var t = $.parseJSON(a);
        "true" == t.status ? ($(".fev_icon_" + e).attr("src", BASE_URL + "/public/assets/images/fav_fill.svg"), $("#feedbackSection").css({
            background: "green",
            height: "80px",
            display: "block"
        }), $("#feedbackSection").html("<span>" + t.message + "</span>")) : ($("#feedbackSection").css({
            background: "red",
            height: "80px",
            display: "block"
        }), $("#feedbackSection").html("<span>" + t.message + "</span>"))
    }) : $("#loginModal").modal("show"), setTimeout(function() {
        $("#feedbackSection").css({
            display: "none"
        })
    }, 3e3)
}), $(document).on("click", ".remove_to_fevrate", function() {
    $(this).addClass("add_to_fevrate"), $(this).removeClass("remove_to_fevrate");
    var e = $(this).attr("data-id"),
        a = $(this).attr("data-user");
    a ? $.get(BASE_URL + "/remove_to_fevrate/" + e + "/" + a, function(a) {
        var t = $.parseJSON(a);
        "true" == t.status ? ($("button").hasClass("remove_fevrate_on_page") && $(".fev_" + e).remove(), $(".fev_icon_" + e).attr("src", BASE_URL + "/public/assets/images/fav.svg"), $("#feedbackSection").css({
            background: "green",
            height: "80px",
            display: "block"
        }), $("#feedbackSection").html("<span>" + t.message + "</span>")) : ($("#feedbackSection").css({
            background: "red",
            height: "80px",
            display: "block"
        }), $("#feedbackSection").html("<span>" + t.message + "</span>"))
    }) : $("#loginModal").modal("show"), setTimeout(function() {
        $("#feedbackSection").css({
            display: "none"
        })
    }, 3e3)
}), $(document).on("change", ".left_filter", function() {
    var e = [],
        a = [],
        t = [],
        n = [],
        o = [];
    $.each($("input[name='collection']:checked"), function() {
        e.push($(this).val())
    }), $.each($("input[name='category']:checked"), function() {
        a.push($(this).val())
    }), $.each($("input[name='occassion']:checked"), function() {
        t.push($(this).val())
    }), $.each($("input[name='gender']:checked"), function() {
        n.push($(this).val())
    }), $.each($("input[name='stone']:checked"), function() {
        o.push($(this).val())
    });
    var s = {
        collection: e,
        categories: a,
        occassions: t,
        gender: n,
        stone: o,
        _token: $("input[name='_token']").val()
    };
    $.post(BASE_URL + "/left_filter", s, function(e) {
        $("#collection_list").html(e)
    })
}), $(document).on("change", ".left_filter_blog", function() {
    var e = [],
        a = [],
        t = [],
        n = [],
        o = [];
    $.each($("input[name='collection']:checked"), function() {
        e.push($(this).val())
    }), $.each($("input[name='category']:checked"), function() {
        a.push($(this).val())
    }), $.each($("input[name='pcategory']:checked"), function() {
        t.push($(this).val())
    }), $.each($("input[name='occassion']:checked"), function() {
        n.push($(this).val())
    }), $.each($("input[name='stone']:checked"), function() {
        o.push($(this).val())
    });
    var s = {
        collection: e,
        categories: a,
        occassions: n,
        pcategories: t,
        stone: o,
        _token: $("input[name='_token']").val()
    };
    $.post(BASE_URL + "/left_filter_blog", s, function(e) {
        $(".show_result").html(e)
    })
}), $(document).on("change", ".left_filter_blog1", function() {
    var e = [],
        a = [],
        t = [],
        n = [],
        o = [];
    $.each($("input[name='collection']:checked"), function() {
        e.push($(this).val())
    }), $.each($("input[name='category']:checked"), function() {
        a.push($(this).val())
    }), $.each($("input[name='pcategory']:checked"), function() {
        t.push($(this).val())
    }), $.each($("input[name='occassion']:checked"), function() {
        n.push($(this).val())
    }), $.each($("input[name='stone']:checked"), function() {
        o.push($(this).val())
    });
    var s = {
        collection: e,
        categories: a,
        occassions: n,
        pcategories: t,
        stone: o,
        _token: $("input[name='_token']").val()
    };
    $.post(BASE_URL + "/left_filter_blog_new", s, function(e) {
        $(".show_result").html(e)
    })
}), $(document).on("click", ".load_more_btn", function() {
	
    var e = [],
        a = [],
        t = [],
        n = [],
        o = [];
    $.each($("input[name='collection']:checked"), function() {
        e.push($(this).val())
    }), $.each($("input[name='category']:checked"), function() {
        a.push($(this).val())
    }), $.each($("input[name='pcategory']:checked"), function() {
        t.push($(this).val())
    }), $.each($("input[name='occassion']:checked"), function() {
        n.push($(this).val())
    }), $.each($("input[name='stone']:checked"), function() {
        o.push($(this).val())
    });
	var limit = $("#blog-load-more-offset").val();
	limit = parseInt(limit);
	$("#blog-load-more-offset").val(limit+10);
    var s = {
        collection: e,
        categories: a,
        occassions: n,
        pcategories: t,
        stone: o,
        limit: limit,
        load_more_button_count: load_more_button_count,
        _token: $("input[name='_token']").val()
    };

	$("#blog-count").remove();
	$(".load_more").remove();
    $.post(BASE_URL + "/left_filter_blog_new", s, function(e) {
		load_more_button_count++;
        $(".load-more-blog").append(e);
		if($("#blog-count").val()<10){
			$(".load_more").addClass("d-none");
		}
    })
}), $(document).on("keyup", "#search_blog", function() {
    var e = $(this).val();
    $.post(BASE_URL + "/blog_search", {
        _token: $("input[name='_token']").val(),
        data: e
    }, function(e) {
        $(".show_result").html(e)
    })
}),  $(document).on("keyup", "#search_blog1", function() {
    var e = $(this).val();
    $.post(BASE_URL + "/blog_search", {
        _token: $("input[name='_token']").val(),
        data: e
    }, function(e) {
        $(".show_result").html(e)
    })
}), $(document).ready(function() {
    $(".carousel.carousel-multi-item.v-2 .carousel-item").each(function() {
        var e = $(this).next();
        e.length || (e = $(this).siblings(":first")), e.children(":first-child").clone().appendTo($(this));
        for (var a = 0; a < 3; a++)(e = e.next()).length || (e = $(this).siblings(":first")), e.children(":first-child").clone().appendTo($(this))
    }), $(".carousel.carousel-multi-item.v-3 .carousel-item").each(function() {
        var e = $(this).next();
        e.length || (e = $(this).siblings(":first")), e.children(":first-child").clone().appendTo($(this));
        for (var a = 0; a < 3; a++)(e = e.next()).length || (e = $(this).siblings(":first")), e.children(":first-child").clone().appendTo($(this))
    })
}), $(document).on("click", "#load-more-product-btn", function() {
    var e = parseInt($(this).attr("data-limit"));
    $(this).attr("data-limit", e + 8), $("body").css("opacity", "0.2"), $.ajax({
        type: "POST",
        url: BASE_URL + "/load_more_products",
        data: {
            limit: e,
            slug: $(this).attr("data-slug"),
            _token: $("input[name='_token']").val()
        },
        success: function(e) {
            console.log(e), e ? $("#add-load-more-product").append(e) : $("#load-more-product-btn").remove(), $("body").css("opacity", "1")
        }
    })
});
var scroll_count = 0;

function scroll_btn() {
    $.ajax({
        type: "POST",
        url: BASE_URL + "/load_more_slider",
        data: {
            _token: $("input[name='_token']").val()
        },
        success: function(e) {
            $("#load-slider").append(e), $(".load-slider").removeAttr("id"), $(".first-slider").owlCarousel({
                loop: !0,
                pagination: !1,
                dots: !1,
                responsive: {
                    0: {
                        items: 2,
                        nav: !0
                    },
                    576: {
                        items: 4,
                        margin: 10,
                        nav: !0
                    },
                    768: {
                        items: 5,
                        margin: 10,
                        nav: !0
                    }
                }
            }) //, // console.clear()
        }
    }), $("#scroll_btn").hide()
}
$(window).scroll(function() {
    scroll_count <= 10 && (console.log(scroll_count), scroll_count++, $(window).scrollTop() >= .7 * ($(document).height() - $(window).height()) && $("#load-slider").length > 0 && $.ajax({
        type: "POST",
        url: BASE_URL + "/load_more_slider",
        data: {
            _token: $("input[name='_token']").val()
        },
        success: function(e) {
            $("#load-slider").append(e), $(".load-slider").removeAttr("id"), $(".first-slider").owlCarousel({
                loop: !0,
                pagination: !1,
                dots: !1,
                responsive: {
                    0: {
                        items: 2,
                        nav: !0
                    },
                    576: {
                        items: 4,
                        margin: 10,
                        nav: !0
                    },
                    768: {
                        items: 5,
                        margin: 10,
                        nav: !0
                    }
                }
            })//, // console.clear()
        }
    }))
}), $(document).on("click", "#submit-contact", function() {
    return $(".remove-validation-form-field").removeClass("border-danger"), $(".remove-validation").remove(), "" == $("#name").val() ? ($("#name").addClass("border-danger"), !1) : "" == $("#mobile_no").val() ? ($("#mobile_no").addClass("border-danger"), !1) : (mobile_no_patt = /^[6-9][0-9]{9}$/, mobile_no_patt.test($("#mobile_no").val()) ? "" == $("#email").val() ? ($("#email").addClass("border-danger"), !1) : (emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/, emailReg.test($("#email").val()) ? "" == $("#message").val() ? ($("#message").addClass("border-danger"), !1) : 0 == grecaptcha.getResponse().length ? ($(".g-recaptcha").after('<span class="text-danger remove-validation float-left">Please check recaptcha.</span>'), !1) : void 0 : ($("#email").after('<span class="text-danger remove-validation">Please enter valid email.</span>'), !1)) : ($("#mobile_no").after('<span class="text-danger remove-validation">Please enter 10 digit valid mobile number.</span>'), !1))
}), $(document).on("click", "#register-form", function() {
    return $(".remove-validation-form-field").removeClass("border-danger"), $(".remove-validation").remove(), "" == $("#r_name").val() ? ($("#r_name").addClass("border-danger"), !1) : "" == $("#r_mobile_no").val() ? ($("#r_mobile_no").addClass("border-danger"), !1) : (mobile_no_patt = /^[6-9][0-9]{9}$/, mobile_no_patt.test($("#r_mobile_no").val()) ? "" == $("#r_email").val() ? ($("#r_email").addClass("border-danger"), !1) : (emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/, emailReg.test($("#r_email").val()) ? "" == $("#r_password").val() ? ($("#r_password").addClass("border-danger"), !1) : 0 == grecaptcha.getResponse().length ? ($(".r-g-recaptcha").after('<span class="text-danger remove-validation float-left">Please check recaptcha.</span>'), !1) : void 0 : ($("#r_email").after('<span class="text-danger remove-validation">Please enter valid email.</span>'), !1)) : ($("#r_mobile_no").after('<span class="text-danger remove-validation">Please enter 10 digit valid mobile number.</span>'), !1))
});
setTimeout(function() {
    console.clear();
}, 2000);
$("#pop_msg").keyup(function(){
  var txt = $("#pop_msg").val();
  $("#sale_comment").val(txt);
});