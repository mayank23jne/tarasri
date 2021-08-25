$(document).ready(function () {
    new WOW().init();

    $('#collection-slider').owlCarousel({
        margin: 10,
        dots: false,
        nav: true,
        navText: ["<i class='fas fa-caret-left'></i>", "<i class='fas fa-caret-right'></i>"],
        responsive: {
            0: {
                items: 2
            },
            576: {
                items: 3
            },
            768: {
                items: 3
            },
            992: {
                items: 4
            },
            1200: {
                items: 5
            }
        }
    });

    $(document).on("click",".show-video-jewel",function(){

        var id =$(this).attr("data-id");
        var video_src = $(this).attr("data-src");
        $("#jewelVideosModel #guruVideoModel").html(" ");
        $("#jewelVideosModel #guruVideoModel").append("<video class='main_video embed-responsive-item' autoplay controls >" +
            "<source src='"+video_src+"'>" +
            "</video>");
        $("#jewelVideosModel").modal("show");

    });

    $('body').on("click",".enquire-btn",function(){

        $(".form-control").val('');

    }).on("click", "#enquirySubmitBtn", function () {

        var enquiryUserName = $.trim($("#enquiry-username").val());
        var enquiryUserNumber = $("#enquiry-usernumber").val();
        var enquiryUserEmail = $("#enquiry-useremail").val();
        var enquiryUserMessage = $("#enquiry-msg").val();

        if (enquiryUserName == "" || enquiryUserName == null) {
            $("#enquiry-username").focus();
            messageDisplay("Please enter name", 1500, "error");

            return false;
        }


        if (!validateMethods.isValidName(enquiryUserName)) {
            $("#enquiry-username").focus();
            messageDisplay("Please enter valid name", 1500, "error");

            return false;
        }
        if(enquiryUserName.length < 3){
            $("#enquiry-username").focus();
            messageDisplay("Name should contain atleast 3 characters", 1500, "error");
            return false;
        }

        if (enquiryUserNumber == "" || enquiryUserNumber == null) {
            messageDisplay("Please enter mobile number", 1500, "error");
            $("#enquiry-usernumber").focus();
            return false;
        }



        if (enquiryUserNumber.length < 6) {
            messageDisplay("Please enter valid mobile number", 1500, "error");
            $("#enquiry-usernumber").focus();
            return false;
        }
        if (enquiryUserEmail == "" || enquiryUserEmail == null) {
            messageDisplay("Please enter email", 1500, "error");
            $("#enquiry-useremail").focus();
            return false;
        }


        if (!emailExpr.test(enquiryUserEmail)) {
            messageDisplay("Please enter valid email", 1500, "error");
            $("#enquiry-useremail").focus();
            return false;
        }else if(!enquiryUserEmail.match(/^\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/))
        // /^\w+@[a-zA-Z]+?\.[a-zA-Z]{2,3}$/
        {
            messageDisplay("Enter valid email address",2000);
            $("#enquiry-useremail").focus();
            return false;
        }
        else if(enquiryUserEmail.match(/^_/g) || enquiryUserEmail.match(/^[0-9]/g)){
            messageDisplay("Enter valid email address",2000);
            $("#enquiry-useremail").focus();
            return false;
        }


        var enquiryUserMessage = $.trim($('#enquiry-msg').val());

        if (enquiryUserMessage == "" || enquiryUserMessage == null) {
            messageDisplay("Please enter message", 1500, "error");
            $("#enquiry-msg").focus();
            return false;
        }

        if(cleanString(enquiryUserMessage).length < 10){

            messageDisplay("Message must be more than 10 characters",1500,"error");
            $("#enquiry-msg").focus();
            return false;
        }


        $.post(BASE_URL+"/application/save-enquiry",{name:enquiryUserName,mobile:enquiryUserNumber,email:enquiryUserEmail,message:enquiryUserMessage},function(response){

            if(response.success){
                messageDisplay(response.message,2000,"success");
                $("#enquiryModal").modal("hide");
                $(".modal-backdrop").removeClass("show");
                setTimeout(function(){
                    window.location.reload();
                },1500)

            }else{
                messageDisplay(response.message,2000);
            }

        });


    });
    $('#similar-products-slider').owlCarousel({
        nav: true,
        margin: 15,
        dots: false,
        smartSpeed: 1000,
        navText: ["<img src='images/right-arrow-angle.svg' class='img-fluid' alt='prev-image'>", "<img src='images/right-arrow-angle.svg' class='img-fluid' alt='next-image'>"],
        responsive: {
            0: {
                items: 1
            },
            576: {
                items: 2
            },
            768: {
                items: 3
            },
            992: {
                items: 4
            },
            1200: {
                items: 5
            },
            1600: {
                items: 6
            }
        }
    });

    // Instantiate EasyZoom plugin
    var $easyzoom = $('.easyzoom').easyZoom();
    // Get the instance API
    var api = $easyzoom.data("easyZoom");
    // Add click event listeners to thumbnails
    $("#collection-slider").on("click", "a", function (e) {
        var img = $(this);

        e.preventDefault();

        // Use EasyZoom's `swap` method
        api.swap(img.data("standard"), img.attr("href"));
    });

    $('#collection-slider a').on('click', function () {
        $('#collection-slider a').css('border-color', ' #dadada');
        $(this).css('border-color', ' #959595');
    });
});
